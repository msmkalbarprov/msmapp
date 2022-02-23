<?php
	class Pq_model extends CI_Model{

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

	function get_coa_item()
	{	
		$this->db->from('ci_coa_msm');
		$this->db->where('no_acc in ("5010201","5010202","5010203","5010204","5010206","5010205")');	
		$query=$this->db->get();
		return $query->result_array();
	}


function get_sisapqproyek($id)
	{
		$query = $this->db->get_where('hitung_sisa_pqproyek', array('id_pqproyek' => $id));
		return $query;
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


	public function get_pq_operasional(){
			$tahun = date("Y");
				if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('kd_area',$this->session->userdata('kd_area'));
				}else{
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
				}
                return $this->db->get()->result_array();
		}

public function get_pq_hpp_rinci($pqproyek){
					$this->db->select('*');
					$this->db->from("ci_hpp");
					$this->db->where('id_pqproyek',$pqproyek);
                return $this->db->get()->result_array();
		}


public function get_pq_operasional_view($id){
			$tahun = date("Y");
				if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('kd_area',$this->session->userdata('kd_area'));
					$this->db->where('left(id_pq_operasional,10)',$id);
				}else{
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('left(id_pq_operasional,10)',$id);
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
		// get all users for server-side datatable processing (ajax based)
		public function get_all_pq(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->select('*,(select nilai from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as spk,(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as hpp');
				$this->db->from("ci_pendapatan");
				$this->db->Join('ci_proyek','ci_pendapatan.id_proyek=ci_proyek.kd_proyek', 'inner');
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*,(select nilai from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as spk,(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as hpp');
				$this->db->from("ci_pendapatan");
				$this->db->Join('ci_proyek','ci_pendapatan.id_proyek=ci_proyek.kd_proyek', 'inner');
				$this->db->where('ci_pendapatan.kd_area',$this->session->userdata('kd_area'));
        		return $this->db->get()->result_array();
			}
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
				$insert_data['volume'] 						= $data['volume'];
				$insert_data['satuan'] 						= $data['satuan'];
				$insert_data['harga']						= $data['harga'];
				$insert_data['periode']						= $data['periode'];
				$insert_data['total']						= $data['total'];
				$insert_data['username']					= $this->session->userdata('username');
				$insert_data['created_at']					= date("Y-m-d h:i:s");
				$query = $this->db->insert('ci_hpp', $insert_data);
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_proyek($data, $id){
			$this->db->where('id_proyek', $id);
			$this->db->update('ci_proyek', $data);
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

		public function edit_hpp_item($data, $id, $idpqproyek){
			$this->db->where('id', $id);
			$this->db->where('id_pqproyek', $idpqproyek);
			$this->db->update('ci_hpp', $data);
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
			$this->db->select("no_acc as kd_item,(select keterangan from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id' order by keterangan desc)as keterangan, (select sum(total) from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id')as nilai_hpp");
			$this->db->from("ci_coa_msm");
			$this->db->where("no_acc in ('5010201','5010202','5010203','5010204','5010206','5010205')");
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_operasional_by_id($id){
			$this->db->select("no_acc as kd_item,(select keterangan from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id' order by keterangan desc)as keterangan, (select sum(total) from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id')as nilai_hpp");
			$this->db->from("ci_coa");
			$this->db->where("level", '3');
			$this->db->where("left(no_acc,3)", '504');
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}

	}
?>