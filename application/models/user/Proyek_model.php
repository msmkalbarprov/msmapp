<?php
	class Proyek_model extends CI_Model{

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

		public function add_proyek($data){
			$this->db->insert('ci_proyek', $data);
			return true;
		}

		public function add_proyek_rincian($data){
			$this->db->insert('ci_proyek_rincian', $data);
			return true;
		}

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_proyek(){

			
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama'){
				$this->db->select('ci_proyek.*,
					(select nm_jns_pagu from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nm_jns_pagu,
					(select frupiah(nilai) from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nilai,
					ROW_NUMBER() OVER(PARTITION BY nm_area) AS row_num ');
				$this->db->from("ci_proyek");
				
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('ci_proyek.*,
					(select nm_jns_pagu from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nm_jns_pagu, 
					(select frupiah(nilai) from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nilai,
					ROW_NUMBER() OVER(PARTITION BY nm_area) AS row_num ');
				$this->db->from("ci_proyek");
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
        		return $this->db->get()->result_array();
				// $this->db->where('area',($this->session->userdata('kd_area')));
				// return $this->db->get('ci_proyek')->result_array();
			}
		}


		// get_subproyek_by_id
	public function get_subproyek_by_id($id){
				$this->db->select('*');
				$this->db->from("ci_proyek_rincian");
				$this->db->where('id_proyek',$id);
                return $this->db->get()->result_array();
		}
	function get_dinas($subarea,$area)
	{	
		$query = $this->db->get_where('ci_dinas', array('kd_area' => $area, 'kd_sub_area' => $subarea));
		return $query;
	}

	function get_subarea($area)
	{
		$query = $this->db->get_where('ci_subarea', array('kd_area' => $area));
		return $query;
	}

		//---------------------------------------------------
		// Get user detial by ID
	public function get_proyek_by_id($id){
				 $this->db->select('ci_proyek.*,ci_proyek_rincian.jns_pagu,ci_jnspagu.nama as nm_jns_pagu');
				 $this->db->from("ci_proyek");
                 $this->db->Join('ci_proyek_rincian','ci_proyek_rincian.id_proyek=ci_proyek.id_proyek', 'inner');
                 $this->db->Join('ci_jnspagu','ci_proyek_rincian.jns_pagu=ci_jnspagu.id', 'inner');
				 $this->db->where('ci_proyek.id_proyek', $id);
			return $result = $this->db->get()->row_array();
		}

	public function get_rincian_proyek_by_id($id){
				 $this->db->select('*');
				 $this->db->from("ci_proyek_rincian");
                 $this->db->where('id', $id);
			return $result = $this->db->get()->row_array();
		}

	

	public function get_detail_proyek_by_id($id){
		$query = $this->db->get_where('ci_proyek', array('id_proyek' =>  $id));
		return $query;
	}

	public function get_detail_rincian_proyek_by_id($id){
		$query = $this->db->get_where('ci_proyek_rincian', array('id' =>  $id));
		return $query;
	}


	public function save_proyek_rincian($data){
				$insert_data['dokumen']				= 'uploads/'.$data['pic_file'];
				$insert_data['jns_pagu'] 			= $data['jnspagu'];
				$insert_data['id_proyek'] 			= $data['id_proyek'];
				$insert_data['tipe_proyek']			= $data['tipeproyek'];
				$insert_data['no_dokumen'] 			= $data['nodpa'];
				$insert_data['nilai'] 				= $data['nilai'];
				$insert_data['tanggal'] 			= $data['tanggal'];
				$insert_data['tanggal2']			= $data['tanggal2'];
				$insert_data['nm_paket_proyek']		= $data['nm_paket_proyek'];
				$insert_data['username']			= $this->session->userdata('username');
				$insert_data['created_at']				= date("Y-m-d h:i:s");
				$query = $this->db->insert('ci_proyek_rincian', $insert_data);
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_proyek($data, $id){
			$this->db->where('id_proyek', $id);
			$this->db->update('ci_proyek', $data);
			return true;
		}

		public function edit_rincian_proyek($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_proyek_rincian', $data);
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

	}

?>