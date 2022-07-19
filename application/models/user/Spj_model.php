<?php
	class Spj_model extends CI_Model{

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



// MULAI
	// get all users for server-side datatable processing (ajax based)
public function get_all_spj(){
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Divisi Finance'){
			$this->db->select('*,sum(nilai) as total');
			$this->db->from("ci_spj_kantor");
			$this->db->group_by("no_spj,kd_area");
			$this->db->order_by("kd_area,no_spj");
       		return $this->db->get()->result_array();
		}
		else{
			$this->db->select('*,sum(nilai) as total');
			$this->db->from("ci_spj_kantor");
			$this->db->where('kd_area',$this->session->userdata('kd_area'));
			$this->db->group_by("no_spj,kd_area");
			$this->db->order_by("kd_area,no_spj");
       		return $this->db->get()->result_array();
		}
	}

	public function get_spj_by_id($id,$kd_area){

		$no_spj= str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',str_replace('054d4a4653a16b49c49c49e000075d10','',$id));
		$kd_area = str_replace('054d4a4653a16b49c49c49e000075d10','-',$kd_area);
		 $this->db->select('ci_spj_kantor.*,concat(ci_spj_kantor.kd_pqproyek," - ",ci_pendapatan.nm_paket_proyek) as nm_paket_pekerjaan');
		 $this->db->from('ci_spj_kantor');
		 $this->db->Join('ci_pendapatan','ci_pendapatan.kd_pqproyek=ci_spj_kantor.kd_pqproyek', 'left');
		 $this->db->where('ci_spj_kantor.no_spj', $no_spj);
		 $this->db->where('ci_spj_kantor.kd_area', $kd_area);
	return $result = $this->db->get()->row_array();
}

public function get_rincian_spj($no_spj,$kd_area){
	$this->db->select('*');
	$this->db->from("ci_spj_kantor");
	$this->db->where('kd_area',$kd_area);
	$this->db->where('no_spj',$no_spj);
return $this->db->get()->result_array();
}

function get_nomor($area)
	{
		$query = $this->db->get_where('get_urut_spj_area', array('kd_area' => $area));
		return $query;
	}

	public function count_all($id,$area){
		$this->db->from('ci_spj_kantor_temp');
		$this->db->where('no_spj',$id);
		$this->db->where('kd_area',$area);
		return $this->db->count_all_results();
	
		// echo $count;
	
	  }

	  function get_nilai($id, $no_acc,$jns_spj,$jns_tkl)
	  {		
		  	if ($jns_spj=='1'){
				$kodeakun = substr($no_acc,0,7);
				if ($jns_tkl == 'programer' || $jns_tkl == 'akuntan' || $jns_tkl == 'rc' || $jns_tkl == 'lainnya'){
					$this->db->select("sum(total) as nilai");
					$this->db->from('ci_hpp');
					$this->db->where('kd_pqproyek', $id);	
					$this->db->where('left(kd_item,7)', $kodeakun);
					$this->db->where('jenis_tk', $jns_tkl);

					// $query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $id, 'no_acc' => $no_acc, 'jenis_tk' => $jns_tkl));	
				}else{
					$this->db->select("sum(total) as nilai");
					$this->db->from('ci_hpp');
					$this->db->where('kd_pqproyek', $id);	
					$this->db->where('left(kd_item,7)', $kodeakun);
					$this->db->where('jenis_tk', $jns_tkl);

					// $query = $this->db->get_where('ci_hpp', array('kd_pqproyek' => $id, 'no_acc' => $no_acc));	
				}
				
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

function get_realisasi($id, $no_acc,$jns_spj,$jns_tkl)
	  {	
		  $this->db->select("ifnull(sum(nilai),0) as total");
		  $this->db->from('get_realisasi_spj_kantor');
		  $this->db->where('kd_pqproyek', $id);
		  $this->db->where('no_acc', $no_acc);

		  if ($jns_tkl == 'programer' || $jns_tkl == 'akuntan' || $jns_tkl == 'rc' || $jns_tkl == 'lainnya'){
			$this->db->where('jns_tkl', $jns_tkl);
		  }
		  	
		  $query=$this->db->get();
		  return $query;
	  }

public function save_spj($data){
		$insert_data['no_spj'] 						= $data['no_spj'];
		$insert_data['tgl_spj'] 					= $data['tgl_spj'];
		$insert_data['kd_area'] 					= $data['kd_area'];
		$insert_data['jns_tkl'] 					= $data['jns_tkl'];
		$insert_data['kd_pqproyek']					= $data['kd_pqproyek'];
		$insert_data['no_acc'] 					    = $data['no_acc'];
		$insert_data['uraian'] 						= $data['uraian'];
		$insert_data['nilai']						= $data['nilai'];
		$insert_data['tgl_bukti']					= $data['tgl_bukti'];
        $insert_data['jns_spj'] 					= $data['jns_spj'];
		$insert_data['bukti'] 						= $data['bukti'];
		$insert_data['username']					= $this->session->userdata('username');
		$insert_data['created_at']					= date("Y-m-d h:i:s");
		$query = $this->db->insert('ci_spj_kantor_temp', $insert_data);
}

public function save_edit_spj($data){
	$insert_data['no_spj'] 						= $data['no_spj'];
	$insert_data['tgl_spj'] 					= $data['tgl_spj'];
	$insert_data['kd_area'] 					= $data['kd_area'];
	$insert_data['jns_tkl'] 					= $data['jns_tkl'];
	$insert_data['kd_pqproyek']					= $data['kd_pqproyek'];
	$insert_data['no_acc'] 					    = $data['no_acc'];
	$insert_data['uraian'] 						= $data['uraian'];
	$insert_data['nilai']						= $data['nilai'];
	$insert_data['tgl_bukti']					= $data['tgl_bukti'];
	$insert_data['jns_spj'] 					= $data['jns_spj'];
	$insert_data['bukti'] 						= $data['bukti'];
	$insert_data['username']					= $this->session->userdata('username');
	$insert_data['created_at']					= date("Y-m-d h:i:s");
	$query = $this->db->insert('ci_spj_kantor', $insert_data);
}



public function simpan_spj($kdarea, $nospj)
		{	
			$query = $this->db->query("INSERT into ci_spj_kantor (no_spj,tgl_spj,kd_pegawai,nama,kd_area,nm_area,kd_sub_area,nm_sub_area,kd_pqproyek,keterangan,tgl_bukti,no_acc,nm_acc,uraian,nilai,jns_spj,jns_tkl,bukti,status,username,created_at) 
                           SELECT no_spj,tgl_spj,kd_pegawai,nama,kd_area,nm_area,kd_sub_area,nm_sub_area,kd_pqproyek,keterangan,tgl_bukti,no_acc,nm_acc,uraian,nilai,jns_spj,jns_tkl,bukti,status,username,created_at FROM ci_spj_kantor_temp
                           WHERE kd_area = '$kdarea' and no_spj='$nospj'");

			$this->db->delete('ci_spj_kantor_temp', array('kd_area' => $kdarea,'no_spj' => $nospj));
			return true;
		} 

public function update_keterangan($kdarea, $nospj, $keterangan)
		{	
			$this->db->set('keterangan', $keterangan);
			$this->db->where('kd_area', $kdarea);
			$this->db->where('no_spj', $nospj);
			$this->db->update('ci_spj_kantor');
			return true;
		} 


 public function filter($search, $limit, $start, $order_field, $order_ascdesc,$id, $area){
		$this->db->select('*,concat(no_acc,"<br>",nm_acc) as akun')->from('ci_spj_kantor_temp');
					$this->db->group_start();
							$this->db->like('no_acc', $search); // Untuk menambahkan query where LIKE
											$this->db->or_like('nm_acc', $search); // Untuk menambahkan query where OR LIKE
											$this->db->or_like('uraian', $search); // Untuk menambahkan query where OR LIKE
											$this->db->or_like('nilai', $search); // Untuk menambahkan query where OR LIKE
					$this->db->group_end();
					$this->db->where('no_spj', $id);
					$this->db->where('kd_area', $area);
					$this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
					$this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
		return  $this->db->get()->result_array();
	
	
	  }
	
	   public function count_filter($search){
		$this->db->like('no_acc', $search); // Untuk menambahkan query where LIKE
		$this->db->or_like('nm_acc', $search); // Untuk menambahkan query where OR LIKE
		$this->db->or_like('uraian', $search); // Untuk menambahkan query where OR LIKE
		$this->db->or_like('nilai', $search); // Untuk menambahkan query where OR LIKE
		return $this->db->get('ci_spj_kantor_temp')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
	  }

function get_pq_by_area($area,$jns_spj)
	  {
		  if ($jns_spj=='1'){
			$this->db->select("ci_hpp.kd_pqproyek,concat(ci_pendapatan.nm_paket_proyek,' ',(select nm_subarea from ci_subarea where kd_subarea = kd_sub_area)) as nm_paket_proyek");
			$this->db->from('ci_hpp');
			$this->db->join("ci_pendapatan","ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek","inner");
			$this->db->where('ci_hpp.kd_area', $area);	
			$this->db->where('ci_pendapatan.status', 1);	
			$this->db->group_by("kd_pqproyek");
		  }else{
			$this->db->select("left(kd_pq_operasional,10) as kd_pqproyek, '' as nm_paket_proyek");
			$this->db->from('ci_pq_operasional');
			$this->db->where('kd_area', $area);	
			$this->db->where('status', 1);	
			$this->db->group_by("left(kd_pq_operasional,10)");
		  }
  
			 
			$query=$this->db->get();
		  	return $query;
	  }

function get_item_spj($no_pq, $jns_spj)
	{	
		if ($jns_spj=='1'){
			$query1 = $this->db->query("SELECT kd_item from ci_hpp where kd_pqproyek='$no_pq'");
		}else{
			$query1 = $this->db->query("SELECT kd_item from ci_pq_operasional where left(kd_pq_operasional,10)='$no_pq'");
		}
		
			$query1_result = $query1->result();
			$kd_item= array();
			foreach($query1_result as $row){
				$kd_item[] = $row->kd_item;
			}
			$kd_items = implode(",",$kd_item);
			$akun = explode(",", $kd_items);
		
		

			$this->db->select('*');
			$this->db->from('ci_coa');
			if ($jns_spj=='1'){
				$this->db->where_in('left(no_acc,7)', $akun);
			}else{
				$this->db->where_in('left(no_acc,5)', $akun);
				$this->db->where_in('level', 4);
			}
			$query=$this->db->get();
			return $query;
	}

function get_kas($id)
	{	
		$this->db->select("ifnull(nilai,0) as total");
		$this->db->from('get_kas_area');
		$this->db->where('kd_area', $id);		
		$query=$this->db->get();
		return $query;
	}

	function get_kas_bud($id)
	{	
		$this->db->select("ifnull(sum(terima), 0)-ifnull(sum(keluar), 0) as total");
		$this->db->from('cetakan_kas_rekening');
		$this->db->where('no_rekening', $id);		
		$query=$this->db->get();
		return $query;
	}

	}
?>