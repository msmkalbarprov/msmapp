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

	public function get_item_pq_by_id($id){
			 $this->db->select('*');
			 $this->db->from("ci_pq_operasional");
             $this->db->where('id_pq_operasional', $id);
		return $result = $this->db->get()->row_array();
	}


	function get_item_operasioanl()
	{	
		$this->db->from('ci_coa_msm');
		$this->db->where('tipe_acc', 'BIAYA-BIAYA');	
		$this->db->where('level', '4');	
		$this->db->where('left(no_acc,3) !=', '501');	
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
		public function get_all_pq(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->select('*');
				$this->db->from("ci_hpqproyek");
				$this->db->Join('ci_proyek','ci_hpqproyek.id_proyek=ci_proyek.id_proyek', 'inner');
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*');
				$this->db->from("ci_hpqproyek");
				$this->db->Join('ci_proyek','ci_hpqproyek.id_proyek=ci_proyek.id_proyek', 'inner');
				$this->db->where('ci_hpqproyek.kd_area',$this->session->userdata('kd_area'));
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

	public function get_detail_item_pq_by_id($id){
		$query = $this->db->get_where('ci_pq_operasional', array('kd_pq_operasional' =>  $id));
		return $query;
	}


	public function save_pq_proyek_operasional($data){
				$insert_data['id_pq_operasional'] 			= str_replace("/","",date("Y").'9800'.$data['kd_area'].$data['kd_item'].$data['kd_proyek']);
				$insert_data['kd_pq_operasional'] 			= date("Y").'/98/00/'.$data['kd_area'].'/'.$data['kd_item'];
				$insert_data['kd_proyek'] 					= $data['kd_proyek'];
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

		//---------------------------------------------------
		// Edit user Record
		public function edit_proyek($data, $id){
			$this->db->where('id_proyek', $id);
			$this->db->update('ci_proyek', $data);
			return true;
		}

		public function edit_pq_item($data, $id){
			$this->db->where('id_pq_operasional', $id);
			$this->db->update('ci_pq_operasional', $data);
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