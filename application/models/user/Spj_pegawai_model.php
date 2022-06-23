<?php
	class Spj_pegawai_model extends CI_Model{

	public function angka($nilai){
		$nilai=str_replace(',','',$nilai);
		return $nilai;
	}

	public function number($nilai){
		$nilai=str_replace('.','',$nilai);
		$nilai=str_replace(',','.',$nilai);
		return $nilai;
	}

	function angka_format($nilai){

	    if($nilai<0){
	        $lc = '('.number_format(abs($nilai),2,',','.').')';
	    }else{
	        if($nilai==0){
	            $lc ='0,00';
	        }else{
	            $lc = number_format($nilai,2,',','.');
	        }
	    }
	}

	function get_nomor($kd_pegawai)
	{
		$query = $this->db->get_where('get_urut_spj_pegawai', array('kd_pegawai' => $kd_pegawai));
		return $query;
	}



// MULAI
	// get all users for server-side datatable processing (ajax based)
public function get_all_spj(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->select('*,sum(nilai) as total');
			$this->db->from("ci_spj_pegawai");
            $this->db->group_by("no_spj,kd_pegawai");
            $this->db->order_by("kd_pegawai,no_spj");
       		return $this->db->get()->result_array();
		}else if($this->session->userdata('admin_role')=='Direktur Area' || $this->session->userdata('admin_role')=='Kepala Lantor' || $this->session->userdata('admin_role')=='Admin'){
			$this->db->select('*,sum(nilai) as total');
			$this->db->from("ci_spj_pegawai");
			$this->db->where('kd_area',$this->session->userdata('kd_area'));
            $this->db->group_by("no_spj,kd_pegawai");
            $this->db->order_by("kd_pegawai,no_spj");
       		return $this->db->get()->result_array();
		}
		else{
			$this->db->select('*,sum(nilai) as total');
			$this->db->from("ci_spj_pegawai");
			$this->db->where('kd_pegawai',$this->session->userdata('username'));
            $this->db->group_by("no_spj,kd_pegawai");
            $this->db->order_by("kd_pegawai,no_spj");
       		return $this->db->get()->result_array();
		}
	}


	function get_pdo_by_area($area,$jenis_pdo)
	{
		// $query = $this->db->get_where('ci_pendapatan', array('kd_area' => $area, 'status' => 1));

			$this->db->select('ci_pdo.*');
			$this->db->from('ci_pdo');
			$this->db->where('ci_pdo.kd_area', $area);	
			$this->db->where("status_terima", 1);
			$this->db->where("jenis", $jenis_pdo);
			$this->db->where("s_transfer", 1);
			$this->db->group_by("kd_pdo");
			$query=$this->db->get();
		return $query;
	}

	function get_kas($id)
	{	
		$this->db->select("ifnull(nilai,0) as total");
		$this->db->from('get_kas_pegawai');
		$this->db->where('kd_pegawai', $id);		
		$query=$this->db->get();
		return $query;
	}

function get_item_by_pdo($pq,$jenis_pdo)
	{	

			$this->db->select('*');
			$this->db->from('ci_pdo');
			if ($jenis_pdo=='2'){
				$this->db->where("left(kd_project,10)", substr($pq,'0','10'));	
			}else{
				$this->db->where('kd_project', $pq);	
			}
			$this->db->where("status_bayar", 1);	
			$query=$this->db->get();
			return $query;
	}

	function get_project_by_pdo($pq,$jenis_pdo)
	{	

			$this->db->select("*, case when jenis='2' then 'Operasional' else (select nm_paket_proyek from ci_proyek where ci_proyek.kd_proyek=ci_pdo.kd_project) end as nm_paket_proyek");
			$this->db->from('ci_pdo');
			$this->db->where('kd_pdo', $pq);	
			$this->db->where("status_bayar", 1);	
			if ($jenis_pdo=='1'){
				$this->db->group_by("kd_project");
			}else{
				$this->db->group_by("left(kd_project,10)");
			}
			
			$query=$this->db->get();
			return $query;
	}

	function get_item_spj($jns_spj,$kd_proyek)
	{		
		$username = $this->session->userdata('username');
		$query="SELECT ifnull(jabatan,'nonstaf')as jabatan from ci_pegawai where kd_pegawai ='$username'";
		$hasil = $this->db->query($query);
		$jabatan = $hasil->row('jabatan');

		if ($jns_spj=='1'){
			$akun = array('5010202','5010205','5020101','5020501');
		}else{
			$akun = array('5040201','5040202','5040203');
		}

		if ($jabatan=='nonstaf'){ //non staff
			if ($jns_spj=='1'){
				$query1 = $this->db->query("SELECT kd_item from ci_hpp where right(kd_pqproyek,14)='$kd_proyek' UNION ALL SELECT no_acc from ci_coa where no_acc in ('5020101','5020501')");
			}else{
				$query1 = $this->db->query("SELECT kd_item from ci_pq_operasional where left(kd_pq_operasional,10)='$kd_proyek'");
			}

			$query1_result = $query1->result();
			$kd_item= array();
			foreach($query1_result as $row){
				$kd_item[] = $row->kd_item;
			}
			$akuns 	= implode(",",$kd_item);
			$akun 		= explode(",", $akuns);

			$this->db->select('*');
			$this->db->from('ci_coa_msm');
			if ($jns_spj=='1'){
				$this->db->where_in('no_acc', $akun);
				$this->db->where('level', 4);
			}else{
				$this->db->where_in('left(no_acc,5)', $akun);
				$this->db->where('level', 4);
			}

		}else if ($jabatan=='programer' || $jabatan=='akuntan' || $jabatan=='rc' || $jabatan=='lainnya'){ //staff
			
			if ($jns_spj=='1'){
				$akun = array('5010202','5010205');
			}else{

				if ($this->session->userdata('username')=='PG04221' || $this->session->userdata('username')=='PG61120' || $this->session->userdata('username')=='PG8533' || $this->session->userdata('username')=='PG21217'){
					$akun = array('50401','50408','50403','50402','50410','50411');
				}else{
					$akun = array('5040201','5040202','5040203');
				}
				
			}
			
			$this->db->select('*');
			$this->db->from('ci_coa_msm');
			if ($jns_spj=='1'){
				$this->db->where_in('no_acc', $akun);
			}else{

				if ($this->session->userdata('username')=='PG04221' || $this->session->userdata('username')=='PG61120' || $this->session->userdata('username')=='PG8533' || $this->session->userdata('username')=='PG21217'){
					$this->db->where_in('left(no_acc,5)', $akun);
					$this->db->where('level', 4);
				}else{
					$this->db->where('level', 4);
					$this->db->where_in('left(no_acc,7)', $akun);
					
				}


				
			}
		
		}else if ($this->session->userdata('admin_role')=='Admin Area'){ //admin kantor
			
			if ($jns_spj=='1'){
				$akun = array('non');
			}else{
				$query1 = $this->db->query("SELECT kd_item from ci_pq_operasional where left(kd_pqproyek,10)='$kd_proyek'");
				$query1_result = $query1->result();
				$kd_item= array();
				foreach($query1_result as $row){
					$kd_item[] = $row->kd_item;
				}
				$akuns 	= implode(",",$kd_item);
				$akun 		= explode(",", $akuns);
			}
			
			$this->db->select('*');
			$this->db->from('ci_coa_msm');
			if ($jns_spj=='1'){
				$this->db->where_in('no_acc', $akun);
				$this->db->where('level', 4);
			}else{
				$this->db->where_in('left(no_acc,5)', $akun);
				$this->db->where('level', 4);
			}
		}else{   //lainnya
			
			if ($jns_spj=='1'){
				$query1 = $this->db->query("SELECT kd_item from ci_hpp where right(kd_pqproyek,14)='$kd_proyek' UNION ALL SELECT no_acc from ci_coa where no_acc in ('5020101','5020501')");
			}else{
				$query1 = $this->db->query("SELECT kd_item from ci_pq_operasional where left(kd_pq_operasional,10)='$kd_proyek'");
			}

			$query1_result = $query1->result();
			$kd_item= array();
			foreach($query1_result as $row){
				$kd_item[] = $row->kd_item;
			}
			$akuns 	= implode(",",$kd_item);
			$akun 		= explode(",", $akuns);
			
			
			$this->db->select('*');
			$this->db->from('ci_coa_msm');
			$this->db->where('level', 4);
			if ($jns_spj=='1'){
				$this->db->where_in('no_acc', $akun);
				$this->db->where('level', 4);
			}else{
				$this->db->where_in('left(no_acc,5)', $akun);
				$this->db->where('level', 4);
			}
			
		}
            
		
            
            
			$query=$this->db->get();
			return $query;
	}





	function get_nilai($id, $no_acc, $jns_spj)
	{		
			if ($jns_spj=='1'){
			  $kodeakun = substr($no_acc,0,7);
			//   if ($jns_tkl == 'programer' || $jns_tkl == 'akuntan' || $jns_tkl == 'rc' || $jns_tkl == 'lainnya'){
			// 	  $this->db->select("sum(total) as nilai");
			// 	  $this->db->from('ci_hpp');
			// 	  $this->db->where('id_pqproyek', $id);	
			// 	  $this->db->where('left(kd_item,7)', $kodeakun);
			// 	  $this->db->where('jenis_tk', $jns_tkl);

			// 	  // $query = $this->db->get_where('ci_hpp', array('id_pqproyek' => $id, 'no_acc' => $no_acc, 'jenis_tk' => $jns_tkl));	
			//   }else{

				if ($no_acc =='5020101'){ //PL
					// '5020101'
					$this->db->select(" sum( case when (ppl = '' OR ppl is null) then npl else ppl end ) as nilai");
					$this->db->from('ci_pendapatan b');
					$this->db->where('b.id_proyek', $id);	
				}else if ($no_acc =='5020501'){ //titipan
					// '5020501');
					$this->db->select(" sum( case when (status_titipan = 1 ) then titipan_net else titipan end ) as nilai");
					$this->db->from('ci_pendapatan b');
					$this->db->where('b.id_proyek', $id);	
				}else{
					$this->db->select("sum(a.total) as nilai");
					$this->db->from('ci_hpp a');
					$this->db->join('ci_pendapatan b ','a.id_pqproyek = b.id_pqproyek', 'inner');
					$this->db->where('b.id_proyek', $id);	
					$this->db->where('left(a.kd_item,7)', $kodeakun);
				}
				  

				  // $query = $this->db->get_where('ci_hpp', array('id_pqproyek' => $id, 'no_acc' => $no_acc));	
			//   }
			  
			}else{
			  $kodeakun = substr($no_acc,0,5);

			  $this->db->select("sum(total) as nilai");
			  $this->db->from('ci_pq_operasional');
			  $this->db->where('left(kd_pq_operasional,10)', $id);	
			  $this->db->where('left(kd_item,5)', $kodeakun);	
			  // $query = $this->db->get_where('ci_pq_operasional', array('left(kd_pq_operasional,10)' => $id, 'no_acc' => $no_acc));	
			}
			$query=$this->db->get();
			return $query;
	}

function get_realisasi($id, $no_acc,$jns_spj)
	{	

		if ($jns_spj=='1'){
			$this->db->select("ifnull(sum(nilai),0) as total");
			$this->db->from('get_realisasi_spj_kantor');
			$this->db->where('kd_pqproyek', 'PQ/'.$id);
		
		}else{
			$this->db->select("ifnull(sum(nilai),0) as total");
			$this->db->from('get_realisasi_spj_kantor');
			$this->db->where('kd_pqproyek', $id);
		
		}
		$this->db->where('no_acc', $no_acc);
			
		$query=$this->db->get();
		return $query;
	}




	public function count_all($id,$kd_pegawai){
	$this->db->from('ci_spj_pegawai_temp');
	$this->db->where('no_spj',$id);
	$this->db->where('kd_pegawai',$kd_pegawai);
	return $this->db->count_all_results();

	// echo $count;

  }


  public function filter($search, $limit, $start, $order_field, $order_ascdesc,$id, $kd_pegawai){
    $this->db->select('*,concat(no_acc,"<br>",nm_acc) as akun')->from('ci_spj_pegawai_temp');
		        $this->db->group_start();
		                $this->db->like('no_acc', $search); // Untuk menambahkan query where LIKE
										$this->db->or_like('nm_acc', $search); // Untuk menambahkan query where OR LIKE
										$this->db->or_like('uraian', $search); // Untuk menambahkan query where OR LIKE
										$this->db->or_like('nilai', $search); // Untuk menambahkan query where OR LIKE
		        $this->db->group_end();
		        $this->db->where('no_spj', $id);
		        $this->db->where('kd_pegawai', $kd_pegawai);
		        $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
		        $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
	return  $this->db->get()->result_array();


  }

   public function count_filter($search){
    $this->db->like('no_acc', $search); // Untuk menambahkan query where LIKE
    $this->db->or_like('nm_acc', $search); // Untuk menambahkan query where OR LIKE
    $this->db->or_like('uraian', $search); // Untuk menambahkan query where OR LIKE
    $this->db->or_like('nilai', $search); // Untuk menambahkan query where OR LIKE
    return $this->db->get('ci_spj_pegawai_temp')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

public function get_spj_by_id($id,$kd_pegawai){

				$no_spj= str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',str_replace('054d4a4653a16b49c49c49e000075d10','',$id));
                $kode_pegawai = str_replace('054d4a4653a16b49c49c49e000075d10','-',$kd_pegawai);
				 $this->db->select("ci_spj_pegawai.*,case when jns_spj='1' then concat(ci_spj_pegawai.kd_proyek,' - ',ci_proyek.nm_paket_proyek) else 'Operasional' end  as nm_paket_pekerjaan");
				 $this->db->from('ci_spj_pegawai');
                 $this->db->Join('ci_proyek','ci_proyek.kd_proyek=ci_spj_pegawai.kd_proyek', 'left');
				 $this->db->where('ci_spj_pegawai.no_spj', $no_spj);
				 $this->db->where('ci_spj_pegawai.kd_pegawai', $kode_pegawai);
			return $result = $this->db->get()->row_array();
		}


public function get_rincian_spj_cetak($area,$kd_pegawai,$bulan,$tahun){

	if ($kd_pegawai=='PG24105'){
		$this->db->select('*');
		$this->db->from("ci_spj_pegawai");
		$this->db->where('kd_pegawai',$kd_pegawai);
	}else{
		$this->db->select('*');
		$this->db->from("ci_spj_pegawai");
		$this->db->where('kd_pegawai',$kd_pegawai);
		$this->db->where("kd_area",$area);
	}
					
					$this->db->where('month(tgl_spj)',$bulan);
					$this->db->where('year(tgl_spj)',$tahun);
                return $this->db->get()->result_array();
		}

public function get_rincian_spj($no_spj,$kd_pegawai){
			$this->db->select('*');
			$this->db->from("ci_spj_pegawai");
			$this->db->where('kd_pegawai',$kd_pegawai);
			$this->db->where('no_spj',$no_spj);
		return $this->db->get()->result_array();
}

		public function get_rincian_penerimaan($area,$kd_pegawai,$bulan,$tahun){
			$this->db->select('*');
			$this->db->from("get_penerimaan_spj_pegawai");
			$this->db->where('kd_pegawai',$kd_pegawai);
			$this->db->where("kd_area",$area);
			$this->db->where("month(tanggal)",$bulan);
			$this->db->where("YEAR(tanggal)",$tahun);
		return $this->db->get()->result_array();
}


// SELESAI



public function get_all_pdo_gaji(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->select('*');
			$this->db->from("v_pdo_gaji");
       		return $this->db->get()->result_array();
		}
		else{
			$this->db->select('*');
			$this->db->from("v_pdo_gaji");
			$this->db->where('kd_area',$this->session->userdata('kd_area'));
       		return $this->db->get()->result_array();
		}
	}

public function get_all_pdo_operasional(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->select('*');
			$this->db->from("v_pdo_operasional");
       		return $this->db->get()->result_array();
		}
		else{
			$this->db->select('*');
			$this->db->from("v_pdo_operasional");
			$this->db->where('kd_area',$this->session->userdata('kd_area'));
       		return $this->db->get()->result_array();
		}
	}

function get_rekening()
	{	
			$query=$this->db->get('ci_rekening_bank');
		return $query->result_array();
	}

function get_pq_projek_by_area($area)
	{
		// $query = $this->db->get_where('ci_pendapatan', array('kd_area' => $area, 'status' => 1));

			$this->db->select('ci_pendapatan.*');
			$this->db->from('ci_pendapatan');
			$this->db->join('ci_proyek','ci_proyek.kd_proyek=ci_pendapatan.id_proyek','left');
			$this->db->where('ci_pendapatan.kd_area', $area);	
			$this->db->where("ci_pendapatan.status",1);
			$this->db->where("batal <>",1);
			$query=$this->db->get();
		return $query;
	}

function get_pq_projek_gaji_by_area($area)
	{
		$query = $this->db->get_where('ci_pendapatan', array('kd_area' => $area));
		return $query;
	}

function get_pq_operasional_by_area($area,$tahun)
	{
		$query = $this->db->get_where('ci_pq_operasional', array('kd_area' => $area, 'left(kd_pq_operasional,4)' => $tahun, 'status' => 1));
		return $query;
	}

	function get_pq_operasional_by_area2($area,$tahun)
	{	
		// $this->db->get_where('ci_pq_operasional', array('kd_area' => $area, 'left(kd_pq_operasional,4)' => $tahun, 'status' => 1));

		$this->db->from("ci_pq_operasional");
		$this->db->where('kd_area', $area);
		$this->db->where('left(kd_pq_operasional,4)', $tahun);
		$this->db->where('status',1);
		$this->db->group_by('left(kd_pq_operasional,10)');
		$query=$this->db->get();
		return $query;
	}

	

function get_item_pq_by_pq($pq)
	{	
		// $query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $pq));

		$query1 ="SELECT status_cair  from ci_pendapatan where kd_pqproyek='$pq'";
					 $hasil = $this->db->query($query1);
					 $status_cair = $hasil->row('status_cair');

		if ($status_cair==1){
			$this->db->select('*');
			$this->db->from('vci_hpp');
			$this->db->where("kd_pqproyek in ('1','$pq')");	
			$this->db->where("kd_item not in ('5010202','5010205')");	
			$query=$this->db->get();
			return $query;
		}else{
			$this->db->select('*');
			$this->db->from('ci_hpp');
			$this->db->where('kd_pqproyek', $pq);	
			$this->db->where("kd_item not in ('5010202','5010205')");	
			$query=$this->db->get();
			return $query;
		}

	}


	function get_item_pq_gaji_by_pq($pq,$jnspdo)
	{	
			
			if($jnspdo=='GJ'){
				$akun='5010202';
			}else{
				$akun='5010205';
			}

			$this->db->select('*');
			$this->db->from('ci_hpp');
			$this->db->where('kd_pqproyek', $pq);	
			$this->db->where("kd_item",$akun);
			$query=$this->db->get();
			return $query;

	}

function get_jenis_tk($kode_pqproyek,$no_acc)
	{
		$query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $kode_pqproyek, 'kd_item' => $no_acc));
		return $query;
	}



function get_nilai2($id, $no_acc, $jns_tk)
	{
		$query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $id, 'kd_item' => $no_acc, 'jenis_tk' => $jns_tk));
		return $query;
	}

function get_divisi()
	{	
		
		$this->db->from('ci_projek');
		$query=$this->db->get();
		return $query->result_array();
	}
public function save_spj($data){
		$insert_data['no_spj'] 						= $data['no_spj'];
		$insert_data['tgl_spj'] 					= $data['tgl_spj'];
		$insert_data['kd_area'] 					= $data['kd_area'];
		$insert_data['kd_pegawai'] 					= $data['kd_pegawai'];
		$insert_data['kd_proyek']					= $data['kd_proyek'];
		$insert_data['no_acc'] 					    = $data['no_acc'];
		$insert_data['uraian'] 						= $data['uraian'];
		$insert_data['kd_sub_area']					= $data['kd_sub_area'];
		$insert_data['nilai']						= $data['nilai'];
		$insert_data['tgl_bukti']					= $data['tgl_bukti'];
        $insert_data['jns_spj'] 					= $data['jns_spj'];
		$insert_data['jns_ta'] 						= $data['jns_ta'];
		$insert_data['bukti']	 					= $data['bukti'];
		$insert_data['username']					= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_spj_pegawai_temp', $insert_data);
}

public function save_edit_spj($data){
    $insert_data['no_spj'] 						= $data['no_spj'];
    $insert_data['tgl_spj'] 					= $data['tgl_spj'];
    $insert_data['kd_area'] 					= $data['kd_area'];
    $insert_data['kd_pegawai'] 					= $data['kd_pegawai'];
    $insert_data['kd_proyek']					= $data['kd_proyek'];
    $insert_data['no_acc'] 					    = $data['no_acc'];
    $insert_data['uraian'] 						= $data['uraian'];
    $insert_data['kd_sub_area']					= $data['kd_sub_area'];
    $insert_data['nilai']						= $data['nilai'];
    $insert_data['tgl_bukti']					= $data['tgl_bukti'];
    $insert_data['jns_spj'] 					= $data['jns_spj'];
	$insert_data['jns_ta'] 						= $data['jns_ta'];
	$insert_data['bukti']	 					= $data['bukti'];
    $insert_data['username']					= $this->session->userdata('username');
    $insert_data['created_at']					= date("Y-m-d h:i:s");
    $query = $this->db->insert('ci_spj_pegawai', $insert_data);
}


public function simpan_spj($kd_pegawai, $nospj)
		{	
			$query = $this->db->query("INSERT into ci_spj_pegawai (no_spj,tgl_spj,kd_pegawai,nama,kd_area,nm_area,kd_sub_area,nm_sub_area,tgl_bukti,kd_proyek,no_acc,nm_acc,uraian,nilai,jns_spj,bukti,jns_ta,status,username,created_at) 
                           SELECT no_spj,tgl_spj,kd_pegawai,nama,kd_area,nm_area,kd_sub_area,nm_sub_area,tgl_bukti,kd_proyek,no_acc,nm_acc,uraian,nilai,jns_spj,bukti,jns_ta,status,username,created_at FROM ci_spj_pegawai_temp
                           WHERE kd_pegawai = '$kd_pegawai' and no_spj='$nospj'");

			$this->db->delete('ci_spj_pegawai_temp', array('kd_pegawai' => $kd_pegawai,'no_spj' => $nospj));
			return true;
		} 

public function update_keterangan($kd_pegawai, $nospj, $keterangan)
		{	
			$this->db->set('keterangan', $keterangan);
			$this->db->where('kd_pegawai', $kd_pegawai);
			$this->db->where('no_spj', $nospj);
			$this->db->update('ci_spj_pegawai');
			return true;
		} 

public function update_status($kd_pegawai, $nospj, $status)
		{	
			$this->db->set('status', $status);
			$this->db->where('kd_pegawai', $kd_pegawai);
			$this->db->where('no_spj', $nospj);
			$this->db->update('ci_spj_pegawai');
			return true;
		} 

public function update_keterangan_gaji($kdpdo, $keterangan, $jenis_transfer, $jnspdo)
		{	
			$this->db->set('keterangan', $keterangan);
			$this->db->set('s_transfer', $jenis_transfer);
			$this->db->set('jns_pdo', $jnspdo);
			$this->db->where('kd_pdo', $kdpdo);
			$this->db->update('ci_pdo');
			return true;
		} 

public function setuju_pdo($kdpdo, $status)
		{	
			$this->db->set('approve', $status);
			$this->db->where('kd_pdo', $kdpdo);
			$this->db->update('ci_pdo');
			return true;
		} 


public function save_pdo_operasional($data){
		$insert_data['id_pdo']						= $data['id_pdo'];
		$insert_data['kd_pdo'] 						= $data['kd_pdo'];
		$insert_data['tgl_pdo'] 					= $data['tgl_pdo'];
		$insert_data['kd_area'] 					= $data['kd_area'];
		$insert_data['kd_pqproyek']				= $data['kd_pqproyek'];
		$insert_data['kd_project']				= $data['kd_project'];
		$insert_data['no_acc3']						= $data['no_acc3'];
		$insert_data['no_acc']						= $data['no_acc'];
		$insert_data['uraian'] 						= $data['uraian'];
		$insert_data['nilai']							= $data['nilai'];
		$insert_data['jenis']							= $data['jenis'];
		$insert_data['qty']								= $data['qty'];
		$insert_data['satuan']						= $data['satuan'];
		$insert_data['harga']							= $data['harga'];
		$insert_data['no_rekening']				= $data['no_rekening'];
		$insert_data['username']					= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_pdo_temp', $insert_data);
}


public function save_edit_pdo_operasional($data){
		$insert_data['id_pdo']						= $data['id_pdo'];
		$insert_data['kd_pdo'] 						= $data['kd_pdo'];
		$insert_data['tgl_pdo'] 					= $data['tgl_pdo'];
		$insert_data['kd_area'] 					= $data['kd_area'];
		$insert_data['kd_pqproyek']				= $data['kd_pqproyek'];
		$insert_data['kd_project']				= $data['kd_project'];
		$insert_data['no_acc3']						= $data['no_acc3'];
		$insert_data['no_acc']						= $data['no_acc'];
		$insert_data['uraian'] 						= $data['uraian'];
		$insert_data['qty']								= $data['qty'];
		$insert_data['satuan']						= $data['satuan'];
		$insert_data['harga']							= $data['harga'];
		$insert_data['nilai']							= $data['nilai'];
		$insert_data['jenis']							= $data['jenis'];
		$insert_data['no_rekening']				= $data['no_rekening'];
		$insert_data['username']					= $this->session->userdata('username');
		$insert_data['created_at']				= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_pdo', $insert_data);
}






public function update_nomor($data2, $kd_pegawai){

			$this->db->where('kd_pegawai', $kd_pegawai);
			$this->db->update('ci_pegawai', $data2);
			return true;
		}

public function get_pdo_project_rinci($pqproyek,$no_acc,$jenis,$jenis_tk){
					$this->db->select('*');
					$this->db->from("ci_pdo");
					$this->db->where('kd_pqproyek',$pqproyek);
					$this->db->where('jenis',$jenis);
					$this->db->where('jenis_tkl',$jenis_tk);
					$this->db->where('no_acc',$no_acc);
                return $this->db->get()->result_array();
		}

public function edit_pdo($data, $id_pdo){
			$this->db->where('kd_pdo', $id_pdo);
			$this->db->update('ci_pdo', $data);
			return true;
		}




function get_nilai_op($kode_pqoperasional)
	{
		$query = $this->db->get_where('ci_pq_operasional', array('kd_pq_operasional' => $kode_pqoperasional));
		return $query;
	}

function get_realisasi_op($kode_pqoperasional)
	{
		$this->db->select('ifnull(sum(total),0)as total');
		$this->db->from('v_get_realisasi_hpp');
		$this->db->where('kd_pqproyek', $kode_pqoperasional);	
		$query=$this->db->get();
		return $query;
	}

		// --------------------------------------- PDO END

	function get_coa_item()
	{	
		$this->db->from('ci_coa_msm');
		$this->db->where('no_acc in ("5010201","5010202","5010203","5010204","5010206","5010205")');	
		$query=$this->db->get();
		return $query->result_array();
	}





	public function get_item_pq_by_id($id){
			 $this->db->select('*');
			 $this->db->from("ci_pq_operasional");
             $this->db->where('id_pq_operasional', $id);
		return $result = $this->db->get()->row_array();
	}


	function get_item_operasioanl()
	{	
		$this->db->from('ci_coa');
		$this->db->where('level','3');
		$query=$this->db->get();
		return $query->result_array();
	}





	public function get_pdo_operasional($id){
			$tahun = date("Y");
					$this->db->select('*');
					$this->db->from("ci_pdo");
					$this->db->where('kd_pdo',$id);
				return $this->db->get()->result_array();
		}



public function get_pq_operasional_view($id){
			$tahun = date("Y");
				if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('left(id_pq_operasional,10)',$id);
				}else{
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('left(id_pq_operasional,10)',$id);
					$this->db->where('kd_area',$this->session->userdata('kd_area'));
				}
                return $this->db->get()->result_array();
		}

	

		public function add_pq($data){
			$this->db->insert('ci_pendapatan', $data);
			return true;
		}

		public function add_proyek_rincian($data){
			$this->db->insert('ci_proyek_rincian', $data);
			return true;
		}

		//---------------------------------------------------
		
public function get_pdo_header($id){
			$this->db->from("v_pdo");
			$this->db->where("id_pdo",$id);
       		return $result = $this->db->get()->row_array();
		}

public function get_pdo_header_gaji($id){
			$this->db->from("v_pdo_gaji");
			$this->db->where("id_pdo",$id);
       		return $result = $this->db->get()->row_array();
		}

public function get_pdo_operasional_header($id){
			$this->db->from("v_pdo_operasional");
			$this->db->where("id_pdo",$id);
       		return $result = $this->db->get()->row_array();
		}
public function get_ttd($id){
			$this->db->select("v_pdo.kd_area,ci_ttd.*");
			$this->db->from("v_pdo");
			$this->db->join("ci_ttd", 'v_pdo.kd_area=ci_ttd.kd_area', 'inner');
			$this->db->where("id_pdo",$id);
       		return $result = $this->db->get()->row_array();
		}
public function get_ttd_pdp($id){
			$this->db->select("ci_proyek.kd_area,ci_ttd.*");
			$this->db->from("ci_proyek");
			$this->db->join("ci_ttd", 'ci_proyek.kd_area=ci_ttd.kd_area', 'inner');
			$this->db->where("id_proyek",$id);
       		return $result = $this->db->get()->row_array();
		}

public function get_ttd_gj($id){
			$this->db->select("v_pdo_gaji.kd_area,ci_ttd.*");
			$this->db->from("v_pdo_gaji");
			$this->db->join("ci_ttd", 'v_pdo_gaji.kd_area=ci_ttd.kd_area', 'inner');
			$this->db->where("id_pdo",$id);
       		return $result = $this->db->get()->row_array();
		}

public function get_ttd_operasional($id){
			$this->db->select("v_pdo_operasional.kd_area,ci_ttd.*");
			$this->db->from("v_pdo_operasional");
			$this->db->join("ci_ttd", 'v_pdo_operasional.kd_area=ci_ttd.kd_area', 'inner');
			$this->db->where("id_pdo",$id);
       		return $result = $this->db->get()->row_array();
		}

public function get_pdo_detail($id){
			$this->db->select("*");
			$this->db->from("ci_pdo");
			$this->db->where("id_pdo", $id);
			$this->db->order_by("id");
			$query=$this->db->get();
			return $query->result_array();
		}

		public function get_all_pq_op(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->select('*');
				$this->db->from("v_ci_pq_operasional");
				$this->db->group_by("left(kode,10)");

        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*');
				$this->db->from("v_ci_pq_operasional");
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->group_by("left(kode,10)");
        		return $this->db->get()->result_array();
			}
		}


		public function get_all_pq_hpp(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->select('*,
					(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as nilai_hpp,
					(select nm_area from ci_area where ci_area.kd_area=ci_pendapatan.kd_area)as nm_area
					');
				$this->db->from("ci_pendapatan");
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*,
					(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as nilai_hpp,
					(select nm_area from ci_area where ci_area.kd_area=ci_pendapatan.kd_area)as nm_area
					');
				$this->db->from("ci_pendapatan");
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
        		return $this->db->get()->result_array();
			}
		}


		// get_subproyek_by_id
	public function get_subproyek_by_id($id){
				$this->db->select('*');
				$this->db->from("ci_proyek_rincian");
				$this->db->where('id_proyek',$id);
                return $this->db->get()->result_array();
		}


	function get_proyek_by_area_subarea($subarea,$area,$jns_spj)
	{	

        if ($jns_spj=='1'){
           
            $query1 = $this->db->query("SELECT id_proyek from ci_pendapatan");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->id_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

            if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
                $this->db->from('v_get_proyek_pq');
                $this->db->where('jns_pagu >','1');
                $this->db->where('thn_anggaran >=',date("Y"));	
                $this->db->where('kd_area =',$area);	
                $this->db->where('kd_sub_area =',$subarea);
                $this->db->where_in('kd_proyek', $kd_proyek);
            }else{
                $this->db->from('v_get_proyek_pq');
                $this->db->where('jns_pagu >','1');	
                $this->db->where('thn_anggaran >=',date("Y"));	
                $this->db->where('kd_area =',$area);	
                $this->db->where('kd_sub_area =',$subarea);
                $this->db->where_in('kd_proyek', $kd_proyek);
            }
		
		       
        }else{
            if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
                $this->db->select("left(kd_pq_operasional,10) as kd_proyek,concat('Operasional tahun ',left(kd_pq_operasional,4)) as nm_paket_proyek");
                $this->db->from('ci_pq_operasional');
                $this->db->where('status','1');
                $this->db->where('kd_area =',$area);		
                $this->db->group_by('left(kd_pq_operasional,10)');
            }else{
                $this->db->select("left(kd_pq_operasional,10) as kd_proyek,'' as nm_paket_proyek");
                $this->db->from('ci_pq_operasional');
                $this->db->where('status','1');	
                $this->db->where('kd_area =',$area);	
                $this->db->group_by('left(kd_pq_operasional,10)');
            }
        }

        $query=$this->db->get();
		return $query;
	}

    function get_pegawai_by_area($area)
	{   

        if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Direktur Area' || $this->session->userdata('admin_role')=='Kepala Lantor' || $this->session->userdata('admin_role')=='Admin' || $this->session->userdata('admin_role')=='Kepala Kantor' || $this->session->userdata('admin_role')=='Admin Area'){
			$query = $this->db->get_where('get_pegawai', array('kd_area' => $area));
		    return $query;
		}else if($this->session->userdata('admin_role')=='AE' ){
			$query = $this->db->get_where('get_pegawai', array('jabatan' => 'AE'));
		    return $query;
		}
		else{
			$query = $this->db->get_where('get_pegawai', array('kd_area' => $area, 'kd_pegawai' => $this->session->userdata('username')));
		    return $query;
		}		
	}

function get_pegawai_by_area_cetak()
	{   

        if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin'){
			$query = $this->db->get('get_pegawai');
		    return $query;
		}else if($this->session->userdata('admin_role')=='Direktur Area' || $this->session->userdata('admin_role')=='Admin' || $this->session->userdata('admin_role')=='Kepala Kantor' || $this->session->userdata('admin_role')=='Admin Area'){
			$query = $this->db->get_where('get_pegawai', array('kd_area' => $this->session->userdata('kd_area')));
		    return $query;
		}
		else{
			$query = $this->db->get_where('get_pegawai', array('kd_pegawai' => $this->session->userdata('username')));
		    return $query;
		}		
	}

	function get_area_by_user($user =0)
	{   

        if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Direktur Area' || $this->session->userdata('admin_role')=='Kepala Lantor' || $this->session->userdata('admin_role')=='Admin' || $this->session->userdata('admin_role')=='Kepala Kantor' || $this->session->userdata('admin_role')=='Admin Area'){
			$query = $this->db->get_where('get_area_by_user', array('kd_pegawai' => $user));
		    return $query;
		}
		else{
			$query = $this->db->get_where('get_area_by_user', array('kd_pegawai' => $this->session->userdata('username')));
		    return $query;
		}		
	}


	function get_proyek_by_area_subarea_edit($subarea,$area,$id_pqproyek)
	{	

			$query1 = $this->db->query("SELECT id_proyek from ci_pendapatan");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->id_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');
			$this->db->where('thn_anggaran >=',date("Y"));	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where_in('kd_proyek', $kd_proyek);
			$this->db->where('kd_proyek', $id_pqproyek);
		}else{
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');	
			$this->db->where('thn_anggaran >=',date("Y"));	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where_in('kd_proyek', $kd_proyek);
			$this->db->where('kd_proyek', $id_pqproyek);
		}
		
		$query=$this->db->get();
		return $query;
	}


	function get_subarea($area)
	{
		$query = $this->db->get_where('ci_subarea', array('kd_area' => $area));
		return $query;
	}

		//---------------------------------------------------
		// Get user detial by ID
	public function get_pq_by_id($id){
				 $this->db->select('*,(select sum(total) from ci_hpp where ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek)as hpp');
				 $this->db->from("ci_pendapatan");
                 $this->db->where('id_pqproyek', $id);
			return $result = $this->db->get()->row_array();
		}

	public function get_rincian_proyek_by_id($id){
				 $this->db->select('*');
				 $this->db->from("ci_proyek_rincian");
                 $this->db->where('id', $id);
			return $result = $this->db->get()->row_array();
		}

	public function get_proyek_by_id($id){
			$this->db->from('v_get_proyek_pq');
			$this->db->where('replace(kd_proyek,"/","")',$id);
			return $result = $this->db->get()->row_array();
		}



	public function get_detail_proyek_by_id($id){
		$query = $this->db->get_where('ci_proyek', array('id_proyek' =>  $id));
		return $query;
	}

	public function get_detail_item_pq_by_id($id){
		$query = $this->db->get_where('ci_pq_operasional', array('kd_pq_operasional' =>  $id));
		return $query;
	}


	public function get_detail_hpp_by_id($id){
		$query = $this->db->get_where('ci_hpp', array('id' =>  $id));
		return $query;
	}


	public function save_pq_proyek_operasional($data){
				$insert_data['id_pq_operasional'] 			= str_replace("/","",date("Y").'9800'.$data['kd_area'].$data['kd_item']);
				$insert_data['kd_pq_operasional'] 			= date("Y").'/'.$data['kd_area'].'/98/'.$data['kd_area'].'/'.$data['kd_item'];
				$insert_data['kd_area'] 					= $data['kd_area'];
				$insert_data['kd_item']						= $data['kd_item'];
				$insert_data['uraian'] 						= $data['uraian'];
				$insert_data['volume'] 						= $data['volume'];
				$insert_data['satuan'] 						= $data['satuan'];
				$insert_data['harga']						= $data['harga'];
				$insert_data['total']						= $data['total'];
				$insert_data['username']					= $this->session->userdata('username');
				$insert_data['created_at']					= date("Y-m-d h:i:s");
				$query = $this->db->insert('ci_pq_operasional', $insert_data);
		}


public function save_pq_hpp($data){
				$insert_data['id_pqproyek']					= $data['id_pqproyek'];
				$insert_data['kd_area'] 					= $data['kd_area'];
				$insert_data['kd_item']						= $data['kd_item'];
				$insert_data['keterangan'] 					= $data['keterangan'];
				$insert_data['total']						= $data['total'];
				$insert_data['username']					= $this->session->userdata('username');
				$insert_data['created_at']					= date("Y-m-d h:i:s");
				$query = $this->db->insert('ci_pdo', $insert_data);
		}

		//---------------------------------------------------
		// Edit user Record


		public function edit_pq($data, $id){

			$this->db->where('id_pqproyek', $id);
			$this->db->update('ci_pendapatan', $data);
			return true;
		}

		public function save_pqngesahan_pq($data, $id_pqproyek){
			$this->db->where('id_pqproyek', $id_pqproyek);
			$this->db->update('ci_pendapatan', $data);
			return true;
		}

		public function edit_pq_item($data, $id){
			$this->db->where('id_pq_operasional', $id);
			$this->db->update('ci_pq_operasional', $data);
			return true;
		}

		public function ajukan_revisi($data, $id){
			$this->db->where('id_pqproyek', $id);
			$this->db->update('ci_pendapatan', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('user_id', $this->input->post('id'));
			$this->db->update('ci_users');
		}


		// PQ
	function get_pqproyek()
	{	
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('ci_pendapatan');
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('ci_pendapatan');
			$this->db->where('kd_area',$userarea);	
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}

function get_pqproyek_by_id($idpqproyek)
	{	
		$this->db->from('ci_pendapatan');
		$this->db->where('id_pqproyek',$idpqproyek);	
		$query=$this->db->get();
		return $query->result_array();
	}

function get_pqproyek_by($area)
	{
		$query = $this->db->get_where('ci_pendapatan', array('kd_area' => $area));
		return $query;
	}

function get_hpp_by_id($id='',$idpqproyek=''){
			 $this->db->select('*');
			 $this->db->from("ci_hpp");
             $this->db->where('id', $id);
             $this->db->where('id_pqproyek', $idpqproyek);
		return $result = $this->db->get()->row_array();
	}

public function get_cetak_hpp_by_id($id){
			$this->db->select("no_acc as kd_item,(select keterangan from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id' order by keterangan desc limit 1)as keterangan, (select sum(total) from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id')as nilai_hpp");
			$this->db->from("ci_coa_msm");
			$this->db->where("no_acc in ('5010201','5010202','5010203','5010204','5010206','5010205')");
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_operasional_by_id($id){
			$query="SELECT left(id_proyek,4) as tahun,kd_area from ci_pendapatan where id_pqproyek='$id'";
					 $hasil = $this->db->query($query);
					 $tahun = $hasil->row('tahun');
					 $area = $hasil->row('kd_area');

			// echo $tahun[0];

			$this->db->select("no_acc as kd_item,(select uraian from ci_pq_operasional where ci_pq_operasional.kd_item=ci_coa.no_acc and left(id_pq_operasional,4)='$tahun' and kd_area='$area' order by uraian desc limit 1)as keterangan, (select sum(total) from ci_pq_operasional where ci_pq_operasional.kd_item=ci_coa.no_acc and left(id_pq_operasional,4)='$tahun' and kd_area='$area')as nilai_op");
			$this->db->from("ci_coa");
			$this->db->where("level", '3');
			$this->db->where("left(no_acc,3)", '504');
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_marketing_by_id($id){

			$query="SELECT left(id_proyek,4) as tahun,kd_area from ci_pendapatan where id_pqproyek='$id'";
					 $hasil = $this->db->query($query);
					 $tahun = $hasil->row('tahun');
					 $area = $hasil->row('kd_area');

			$this->db->select("sum(total) as nilai_op");
			$this->db->from("ci_pq_operasional");
			$this->db->where("left(id_pq_operasional,4)", $tahun);
			$this->db->where("kd_area", $area);
			$this->db->where("left(kd_item,3)", '503');
			$this->db->group_by("left(kd_item,3)");
			return $result = $this->db->get()->row_array();
		}

public function get_pendapatanarea($id){

			$query="SELECT left(id_proyek,4) as tahun,kd_area from ci_pendapatan where id_pqproyek='$id'";
					 $hasil = $this->db->query($query);
					 $tahun = $hasil->row('tahun');
					 $area = $hasil->row('kd_area');

			$this->db->select("sum(pendapatan_nett) as pendapatannetarea");
			$this->db->from("ci_pendapatan");
			$this->db->where("left(id_proyek,4)", $tahun);
			$this->db->where("kd_area", $area);
			return $result = $this->db->get()->row_array();
		}

	public function get_spj_header($area,$kd_pegawai){
			$this->db->select("*,'$area' as kd_area,(select nm_area from ci_area where kd_area='$area') as nm_area");
			$this->db->from("h_spj");
			$this->db->where("kd_pegawai",$kd_pegawai);
       		return $result = $this->db->get()->row_array();
		}

	public function get_spj_header2($area,$kd_pegawai,$bulan,$tahun){
			// $this->db->select("sum(nilai) as total, month(tgl_spj) as bulan, year(tgl_spj) as tahun");
			// $this->db->from("ci_spj_pegawai");
			// $this->db->where("YEAR(tgl_spj)",$tahun);
			// $this->db->where("MONTH(tgl_spj)",$bulan);
			// $this->db->where("kd_pegawai",$kd_pegawai);
			// $this->db->group_by("no_spj");
			if ($kd_pegawai=='PG24105'){
				$this->db->select("kd_pegawai,'$bulan' as bulan,'$tahun' as tahun, (select sum(nilai) as total from ci_spj_pegawai where MONtH(tgl_spj)='$bulan' and YEAR(tgl_spj)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as total");
			}else{
				$this->db->select("kd_pegawai,'$bulan' as bulan,'$tahun' as tahun, (select sum(nilai) as total from ci_spj_pegawai where MONtH(tgl_spj)='$bulan' and YEAR(tgl_spj)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as total");
			}
			
					$this->db->from("ci_pegawai");
					$this->db->where("kd_pegawai",$kd_pegawai);
					$this->db->group_by("kd_pegawai");
					$this->db->group_by("no_spj");
       		return $result = $this->db->get()->row_array();
		}

	public function get_spj_header3($area,$kd_pegawai,$bulan,$tahun){

		// get nilai 
		// $this->db->select("ifnull(sum(terima),0) as terima, ifnull(sum(keluar),0) as keluar");
		// 	$this->db->from("get_saldo_spj_cetak");
		// 	$this->db->where("month(tanggal) <",$bulan);
		// 	$this->db->where("kd_pegawai",$kd_pegawai);
		// 	$this->db->group_by("kd_pegawai");
		if ($kd_pegawai=='PG24105'){
			$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
					(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as keluar");
		}else{
			$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
					(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as keluar");
		}
			
					$this->db->from("ci_pegawai");
					$this->db->where("kd_pegawai",$kd_pegawai);
					$this->db->group_by("kd_pegawai");


       		return $result = $this->db->get()->row_array();
		}

		public function get_spj_header4($area,$kd_pegawai,$bulan,$tahun){
	
			// get nilai 
			if ($kd_pegawai=='PG24105'){
				$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
					(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as keluar");
			}else{
				$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
					(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as keluar");
			}
			
					$this->db->from("ci_pegawai");
					$this->db->where("kd_pegawai",$kd_pegawai);
					$this->db->group_by("kd_pegawai");
				   return $result = $this->db->get()->row_array();
			}

			public function get_spj_header5($area,$kd_pegawai,$bulan,$tahun){

				if ($kd_pegawai=='PG24105'){
					$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
					(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as keluar");
				}else{
					$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
					(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)<'$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as keluar");
				}
		
				// get nilai 
					
					$this->db->from("ci_pegawai");
					$this->db->where("kd_pegawai",$kd_pegawai);
					$this->db->group_by("kd_pegawai");
					   return $result = $this->db->get()->row_array();
				
				
				
					}

					public function pengembalian_kas($area,$kd_pegawai,$bulan,$tahun){

						if ($kd_pegawai=='PG24105'){
							$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
							(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_pegawai=ci_pegawai.kd_pegawai and identitas='pengembalian') as keluar");
						}else{
							$this->db->select("kd_pegawai,(select ifnull(sum(terima),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai) as terima, 
							(select ifnull(sum(keluar),0) from get_saldo_spj_cetak where MONtH(tanggal)='$bulan' and YEAR(tanggal)='$tahun' and kd_area = '$area' and kd_pegawai=ci_pegawai.kd_pegawai and identitas='pengembalian') as keluar");
						}
				
						// get nilai 
							
							$this->db->from("ci_pegawai");
							$this->db->where("kd_pegawai",$kd_pegawai);
							$this->db->group_by("kd_pegawai");
							   return $result = $this->db->get()->row_array();
						
					}


// cetak masal per area
public function get_proyek_by_area($kolom, $id, $tahun){
			$this->db->select($kolom);
			$this->db->from('v_get_proyek_pq2');
			$this->db->where('kd_area',$id);
			$this->db->where('thn_anggaran',$tahun);
			$this->db->order_by('kd_proyek');
			$query=$this->db->get();
			return $query->result_array();
		}
public function get_map1(){
		$this->db->from('map_pq');
		// $this->db->where('urut',1);
		$query=$this->db->get();
		return $query->result_array();
	}
public function get_pq_by_area($kolom,$id, $tahun, $proyek){

				$this->db->select($kolom);
				$this->db->from("v_get_pq");
				$this->db->where('kd_area',$id);
				$this->db->where('left(id_proyek,4)',$tahun);
				$this->db->where('id_proyek',$proyek);
				$this->db->order_by('id_proyek');
			$query=$this->db->get();
		return $query->result_array();
		}

public function get_cetak_hpp_by_area($kd_item,$jenis_tk, $id, $proyek){

			$query1 = $this->db->query("SELECT kd_proyek from ci_proyek where kd_area='$id'");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->kd_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

			if ($kd_item=='5010202'){
				$this->db->select("id_proyek,
								'$jenis_tk' as jenis_tk, 
								(select keterangan from ci_hpp where ci_hpp.kd_item='$kd_item' and jenis_tk='$jenis_tk' and kd_area='$id' 
								and ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek
								order by keterangan desc limit 1)as keterangan,
								(select ifnull(sum(total),0) from ci_hpp where ci_hpp.kd_item='$kd_item' and kd_area='$id' and jenis_tk='$jenis_tk' and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			}else{
				$this->db->select("id_proyek,
								'' as jenis_tk, 
								(select keterangan from ci_hpp where ci_hpp.kd_item='$kd_item' and (jenis_tk='$jenis_tk' OR jenis_tk is null) and kd_area='$id' 
								and ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek
								order by keterangan desc limit 1)as keterangan,
								(select ifnull(sum(total),0) from ci_hpp where ci_hpp.kd_item='$kd_item' and kd_area='$id' and (jenis_tk='$jenis_tk' OR jenis_tk is null) and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			}

			
			$this->db->from("ci_pendapatan");
			$this->db->where("id_proyek", $proyek);
			$this->db->where_in('id_proyek', $kd_proyek);
			$this->db->order_by("id_pqproyek");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_total_hpp_by_projek($id, $proyek){

			$query1 = $this->db->query("SELECT kd_proyek from ci_proyek where kd_area='$id'");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->kd_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

			$this->db->select("id_proyek,(select ifnull(sum(total),0) from ci_hpp where kd_area='$id' and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			$this->db->from("ci_pendapatan");
			$this->db->where("id_proyek", $proyek);
			$this->db->where_in('id_proyek', $kd_proyek);
			$this->db->order_by("id_pqproyek");
			$query=$this->db->get();
			return $query->result_array();
		}
public function get_op_by_area($kd_item, $id,$tahun){
			$query= $this->db->query("SELECT z.*,x.uraian as keterangan,x.total from (
							SELECT `map_pq`.`kd_item` FROM `map_pq` WHERE 
							map_pq.kd_item = '$kd_item')z 
							LEFT JOIN 
							(select uraian,kd_item,sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' and kd_area='$id' group by kd_item)x ON `x`.`kd_item`=`z`.`kd_item` 
							ORDER BY kd_item");
			
			return $query->result_array();
		}

public function get_marketing_by_area($kd_item, $id,$tahun){
			$query= $this->db->query("SELECT z.*,x.uraian as keterangan,x.total from (
							SELECT `map_pq`.`kd_item` FROM `map_pq` WHERE 
							map_pq.kd_item = '$kd_item')z 
							LEFT JOIN 
							(select uraian,kd_item,sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' and kd_area='$id' group by kd_item)x ON left(`x`.`kd_item`,3)=`z`.`kd_item` 
							ORDER BY kd_item");
			
			return $query->result_array();
		}

public function get_operasional_by_area($id, $tahun){
			$query= $this->db->query("SELECT sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' and kd_area='$id'");
			return $result = $query->row_array();
		}

public function get_pq_by_projek($id, $proyek){
				$this->db->select('sub_total_a,nalokasi_ho,pendapatan_nett,nilaippl as nilai_pl');
				$this->db->from("v_get_pq");
				$this->db->where('kd_area',$id);
				$this->db->where('id_proyek',$proyek);
				$this->db->order_by('id_proyek');
			$query=$this->db->get();
		return $query->result_array();
		}
public function get_pendapatanarea_by_year($id,$tahun){

			$this->db->select("sum(pendapatan_nett) as pendapatannetarea, sum(sub_total_a)as sub_total_a");
			$this->db->from("ci_pendapatan");
			$this->db->where("left(id_proyek,4)", $tahun);
			$this->db->where("kd_area", $id);
			return $result = $this->db->get()->row_array();
		}

public function get_spk_by_year($id,$tahun){
			$this->db->select("sum(nilai_spk) as nilai_spk");
			$this->db->from('v_get_proyek_pq2');
			$this->db->where("left(kd_proyek,4)", $tahun);
			$this->db->where("kd_area", $id);
			return $result = $this->db->get()->row_array();
		}
// jumlah revisi
public function get_jumlah_revisi($id_pqproyek){
			$this->db->select("revisi as jumlah_revisi");
			$this->db->from('ci_pendapatan');
			$this->db->where("id_pqproyek", $id_pqproyek);
			return $result = $this->db->get()->row_array();
		}


	}
?>