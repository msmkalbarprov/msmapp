<?php
	class Transfer_model extends CI_Model{

	public function angka($nilai){
		$nilai=str_replace(',','',$nilai);
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


// MULAI 

public function get_all_transfer_pencairan(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->select('ci_proyek_transfer.*,ci_area.nm_area');
			$this->db->from("ci_proyek_transfer");
			$this->db->join("ci_area", "ci_proyek_transfer.kd_area=ci_area.kd_area","left");
			$this->db->group_by('no_transfer');
       		return $this->db->get()->result_array();
		}
		else{
			$this->db->select('ci_proyek_transfer.*,ci_area.nm_area');
			$this->db->from("ci_proyek_transfer");
			$this->db->join("ci_area", "ci_proyek_transfer.kd_area=ci_area.kd_area","left");
			$this->db->where('kd_area',$this->session->userdata('kd_area'));
			$this->db->group_by('no_transfer');
       		return $this->db->get()->result_array();
		}
	}


function get_coa_item()
	{	
		$this->db->from('ci_coa_msm');
		$this->db->where('no_acc in ("101010102","101010301","101010302","101010303","101010304","101010305","101010306","101010307","101010308","101010309","101010310")');	
		$query=$this->db->get();
		return $query->result_array();
	}


	function get_pencairan()
	{	
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('ci_proyek_cair');
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('ci_proyek_cair');
			$this->db->where('substring(kd_proyek,5,2)',$userarea);
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}

public function get_nomor_transfer($area)
		{
		$query = $this->db->get_where('get_urut_transfer', array('kd_area' => $area));
		return $query;
		}

function get_pq_pencairan_by_area($area)
	{
		
		$this->db->from('ci_proyek_cair');
		$this->db->where("substring(kd_proyek,6,2)",$area);
		$this->db->group_start();
		$this->db->where("nomor not in (select no_cair from ci_proyek_transfer_temp)");
		$this->db->where("nomor not in (select no_cair from ci_proyek_transfer)");
		$this->db->group_end();
		$query = $this->db->get();
		return $query;
	}

	function get_nilai_cair_netto($id)
	{	
		  $this->db->select('kd_proyek,id_proyek,nilai_bruto-(select ifnull(sum(nilai),0) from ci_proyek_cair_potongan where nomor=ci_proyek_cair.nomor) as nilai_netto');
			$this->db->from('ci_proyek_cair');
			$this->db->where('nomor', $id);	
			$query=$this->db->get();
		return $query;
	}

	public function count_all($id){
		$this->db->from('ci_proyek_transfer_temp');
		$this->db->where('no_transfer',$id);
		return $this->db->count_all_results();
  }

   public function filter($search, $limit, $start, $order_field, $order_ascdesc,$id){
    $this->db->select('*')->from('ci_proyek_transfer_temp');
		        $this->db->group_start();
		                $this->db->like('no_cair', $search); // Untuk menambahkan query where LIKE
						$this->db->group_end();
		        $this->db->where('no_transfer', $id);
		        $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
		        $this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
	return  $this->db->get()->result_array();


  }
 public function count_filter($search){
    $this->db->like('no_cair', $search); // Untuk menambahkan query where LIKE
    // $this->db->or_like('nm_acc', $search); // Untuk menambahkan query where OR LIKE
    // $this->db->or_like('uraian', $search); // Untuk menambahkan query where OR LIKE
    $this->db->or_like('nilai', $search); // Untuk menambahkan query where OR LIKE
    return $this->db->get('ci_proyek_transfer_temp')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
  }

public function save_transfer($data){
		$insert_data['id_proyek']						= $data['id_proyek'];
		$insert_data['kd_proyek'] 					= $data['kd_proyek'];
		$insert_data['tgl_transfer'] 				= $data['tgl_transfer'];
		$insert_data['kd_area'] 						= $data['kd_area'];
		$insert_data['no_cair'] 						= $data['no_cair'];
		$insert_data['no_transfer']					= $data['no_transfer'];
		$insert_data['kd_rekening']					= $data['kd_rekening'];
		$insert_data['nilai']								= $data['nilai'];
		$insert_data['username']						= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_proyek_transfer_temp', $insert_data);
}

public function add_transfer($nomor_transfer)
		{	
				$query = $this->db->query("INSERT into ci_proyek_transfer
                           				SELECT * FROM ci_proyek_transfer_temp WHERE no_transfer = '$nomor_transfer'");
			$this->db->delete('ci_proyek_transfer_temp', array('no_transfer' => $nomor_transfer));
			return true;
		} 


public function get_transfer_by_id($id){
				 // $this->db->select('');
				$id_new = str_replace('f58ff891333ec9048109908d5f720903','/',$id);
				 $this->db->from('ci_proyek_transfer');
                 // $this->db->Join('ci_proyek','ci_proyek.kd_proyek=ci_pdo.kd_project', 'left');
                 // $this->db->Join('ci_area','ci_area.kd_area=ci_pdo.kd_area', 'left');
                 // $this->db->Join('ci_projek','ci_projek.kd_projek=ci_pdo.kd_divisi', 'left');
				 $this->db->where('no_transfer', $id_new);
			return $result = $this->db->get()->row_array();
		}

	public function get_transfer_proyek($id){
					$tahun = date("Y");
					$id_new = str_replace('f58ff891333ec9048109908d5f720903','/',$id);
					$this->db->select('*,(select sum(nilai) from ci_proyek_transfer_potongan where id_cair=ci_proyek_transfer.id)as potongan');
					$this->db->from("ci_proyek_transfer");
					$this->db->where('no_transfer',$id_new);
                return $this->db->get()->result_array();
		}

	public function save_edit_transfer($data){
		$insert_data['id_proyek']						= $data['id_proyek'];
		$insert_data['kd_proyek'] 					= $data['kd_proyek'];
		$insert_data['tgl_transfer'] 				= $data['tgl_transfer'];
		$insert_data['kd_area'] 						= $data['kd_area'];
		$insert_data['no_cair'] 						= $data['no_cair'];
		$insert_data['no_transfer']					= $data['no_transfer'];
		$insert_data['kd_rekening']					= $data['kd_rekening'];
		$insert_data['nilai']								= $data['nilai'];
		$insert_data['username']						= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_proyek_transfer', $insert_data);
}

public function simpan_cair_potongan($data){
			$this->db->insert('ci_proyek_transfer_potongan', $data);
			return true;
		}

public function get_potongan_transfer_by_id($id,$no_cair){
				$id_new = str_replace('f58ff891333ec9048109908d5f720903','/',$id);
				$nocair_new = str_replace('f58ff891333ec9048109908d5f720903','/',$no_cair);
				$this->db->select('*');
				$this->db->from("ci_proyek_transfer_potongan");
				$this->db->where('nomor',$id_new);
				$this->db->where('no_cair',$nocair_new);
                return $this->db->get()->result_array();
		}

public function get_transfer_header($id){
			$this->db->select("ci_proyek_transfer.*,sum(ci_proyek_transfer.nilai)-sum(ci_proyek_transfer_potongan.nilai)as nilai_netto,nm_area");
			$this->db->from("ci_proyek_transfer");
			$this->db->join("ci_proyek_transfer_potongan", "ci_proyek_transfer.no_transfer=ci_proyek_transfer_potongan.nomor and ci_proyek_transfer.id=ci_proyek_transfer_potongan.id_cair", "left");
			$this->db->join("ci_area", "ci_proyek_transfer.kd_area=ci_area.kd_area", "left");
			$this->db->where("ci_proyek_transfer.no_transfer", $id);
       		return $result = $this->db->get()->row_array();
		}

public function get_transfer_detail($id){
			$this->db->select("ci_proyek_transfer.*,
								sum(ci_proyek_transfer_potongan.nilai) as potongan
								");
			$this->db->from("ci_proyek_transfer");
			$this->db->join("ci_proyek_transfer_potongan", "ci_proyek_transfer.no_transfer=ci_proyek_transfer_potongan.nomor and ci_proyek_transfer.id=ci_proyek_transfer_potongan.id_cair", "left");
			$this->db->where("ci_proyek_transfer.no_transfer", $id);
			$this->db->group_by("no_cair");
			$this->db->order_by("id");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_ttd_transfer($id){
			$this->db->select("ci_proyek_transfer.kd_area,ci_ttd.*");
			$this->db->from("ci_proyek_transfer");
			$this->db->join("ci_ttd", 'ci_proyek_transfer.kd_area=ci_ttd.kd_area', 'inner');
			$this->db->where("no_transfer",$id);
       		return $result = $this->db->get()->row_array();
		}

// SELESAI

	// get all users for server-side datatable processing (ajax based)
public function get_all_pdo(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->select('*');
			$this->db->from("v_pdo");
       		return $this->db->get()->result_array();
		}
		else{
			$this->db->select('*');
			$this->db->from("v_pdo");
			$this->db->where('kd_area',$this->session->userdata('kd_area'));
       		return $this->db->get()->result_array();
		}
	}

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

function get_nilai($id, $no_acc)
	{	
		if ($no_acc=='50201'){
		    	
		    $query="SELECT persen_pl,ppl from ci_pendapatan where kd_pqproyek='$id'";
					 $hasil     = $this->db->query($query);
					 $persen_pl = $hasil->row('persen_pl');
					 $ppl       = $hasil->row('ppl');
					 
			if ($ppl!=0){
			       $this->db->select('ppl as total');
			}else{
			    $this->db->select('npl as total');
			}
			
			$this->db->from('ci_pendapatan');
			$this->db->where('kd_pqproyek', $id);	
			$query=$this->db->get();
		}else{
			$query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $id, 'kd_item' => $no_acc));	
		}
		
		return $query;
	}

function get_nilai2($id, $no_acc, $jns_tk)
	{
		$query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $id, 'kd_item' => $no_acc, 'jenis_tk' => $jns_tk));
		return $query;
	}

function get_realisasi($id, $no_acc)
	{	
		$this->db->select('ifnull(sum(total),0)as total');
		$this->db->from('v_get_realisasi_hpp');
		$this->db->where('kd_pqproyek', $id);	
		$this->db->where('no_acc', $no_acc);	
		$query=$this->db->get();
		return $query;
	}

function get_realisasi2($id, $no_acc, $jns_tk)
	{
		
		$this->db->select('ifnull(sum(total),0)as total');
		$this->db->from('v_get_realisasi_hpp');
		$this->db->where('kd_pqproyek', $id);	
		$this->db->where('no_acc', $no_acc);	
		$this->db->where('jenis_tkl', $jns_tk);	
		$query=$this->db->get();
		return $query;
	}

function get_divisi()
	{	
		
		$this->db->from('ci_projek');
		$query=$this->db->get();
		return $query->result_array();
	}





 



 

  



public function update_keterangan($kdpdo, $keterangan, $jenis_transfer)
		{	
			$this->db->set('keterangan', $keterangan);
			$this->db->set('s_transfer', $jenis_transfer);
			$this->db->where('kd_pdo', $kdpdo);
			$this->db->update('ci_pdo');
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
		$insert_data['kd_pqproyek']					= $data['kd_pqproyek'];
		$insert_data['kd_project']					= $data['kd_project'];
		$insert_data['no_acc3']						= $data['no_acc3'];
		$insert_data['no_acc']						= $data['no_acc'];
		$insert_data['uraian'] 						= $data['uraian'];
		$insert_data['nilai']						= $data['nilai'];
		$insert_data['jenis']						= $data['jenis'];
		$insert_data['qty']							= $data['qty'];
		$insert_data['satuan']						= $data['satuan'];
		$insert_data['harga']						= $data['harga'];

		$insert_data['username']					= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_pdo_temp', $insert_data);
}


public function save_edit_pdo_operasional($data){
		$insert_data['id_pdo']						= $data['id_pdo'];
		$insert_data['kd_pdo'] 						= $data['kd_pdo'];
		$insert_data['tgl_pdo'] 					= $data['tgl_pdo'];
		$insert_data['kd_area'] 					= $data['kd_area'];
		$insert_data['kd_pqproyek']					= $data['kd_pqproyek'];
		$insert_data['kd_project']					= $data['kd_project'];
		$insert_data['no_acc3']						= $data['no_acc3'];
		$insert_data['no_acc']						= $data['no_acc'];
		$insert_data['uraian'] 						= $data['uraian'];
		$insert_data['qty']							= $data['qty'];
		$insert_data['satuan']						= $data['satuan'];
		$insert_data['harga']						= $data['harga'];
		$insert_data['nilai']						= $data['nilai'];
		$insert_data['jenis']						= $data['jenis'];
		$insert_data['username']					= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_pdo', $insert_data);
}




function get_nomor($area)
	{
		$query = $this->db->get_where('get_urut_pdo', array('kd_area' => $area));
		return $query;
	}

public function update_nomor($data2, $kodearea){

			$this->db->where('kd_area', $kodearea);
			$this->db->update('ci_nomor_pdo', $data2);
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


	function get_proyek_by_area_subarea($subarea,$area)
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
			$this->db->where_not_in('kd_proyek', $kd_proyek);
		}else{
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');	
			$this->db->where('thn_anggaran >=',date("Y"));	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where_not_in('kd_proyek', $kd_proyek);
		}
		
		$query=$this->db->get();
		return $query;
	}




	function get_data_transfer($nomor)
	{		
			$nomor_new=str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
			
			$this->db->select("ifnull(nilai,0)as nilai, no_transfer, id, tgl_transfer");
			$this->db->from("ci_proyek_transfer");
            $this->db->where('no_transfer', $nomor_new);
			return $result = $this->db->get()->row_array();
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