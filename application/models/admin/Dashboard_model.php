<?php
	class Dashboard_model extends CI_Model{

		

		public function get_proyek(){

			
				// $this->db->where('thn_anggaran',date("Y"));
				// $this->db->from("get_count_nominal_proyek");
				// $this->db->select("ifnull(sum(nilai),0)as nilai");
				// return $result = $this->db->get()->row_array();

				if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing'){
					$this->db->select("ifnull(sum(nilai),0)as nilai");
					$this->db->from("get_proyek");
					$this->db->group_by('kd_area');
				}else{
					$this->db->select("ifnull(sum(nilai),0)as nilai");
					$this->db->from("get_proyek");
					$this->db->where("kd_area",$this->session->userdata('kd_area'));
					$this->db->group_by('kd_area');
				}
				
				$query = $this->db->get();
				$array = $query->result_array();
				return json_encode(array_column($query->result(), 'nilai'),JSON_NUMERIC_CHECK);
			
		}

		public function get_area(){
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing'){
				$this->db->select("nname");
				$this->db->from("get_proyek_area");
			}else{
				$this->db->select("nname");
				$this->db->from("get_proyek_area");
				$this->db->where("kd_area",$this->session->userdata('kd_area'));
			}


				
				$query = $this->db->get();
				$array = $query->result_array();
				return json_encode(array_column($query->result(), 'nname'),JSON_NUMERIC_CHECK);
			
		}

		public function get_pdp(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing'){
				$this->db->select("nilai");
				$this->db->from("get_proyek_cair");
				$this->db->group_by('kd_area');
			}else{
				$this->db->select("nilai");
				$this->db->from("get_proyek_cair");
				$this->db->where("kd_area",$this->session->userdata('kd_area'));
				$this->db->group_by('kd_area');
				
			}


				
				$query = $this->db->get();
				$array = $query->result_array();
				return json_encode(array_column($query->result(), 'nilai'),JSON_NUMERIC_CHECK);
			
		}

		public function get_spj(){
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing'){
				$this->db->select("nilai");
				$this->db->from("get_proyek_spj");
				$this->db->group_by('kd_area');
			}else{
				$this->db->select("nilai");
				$this->db->from("get_proyek_spj");
				$this->db->where("kd_area",$this->session->userdata('kd_area'));
				$this->db->group_by('kd_area');
				
			}
				$query = $this->db->get();
				$array = $query->result_array();
				return json_encode(array_column($query->result(), 'nilai'),JSON_NUMERIC_CHECK);
			
		}

		public function get_pdo(){

			
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing'){
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				$this->db->from("get_proyek_pdo");
				$this->db->group_by('kd_area');
			}else{
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				$this->db->from("get_proyek_pdo");
				$this->db->where("kd_area",$this->session->userdata('kd_area'));
				$this->db->group_by('kd_area');
				
			}


				
				$query = $this->db->get();
				$array = $query->result_array();
				return json_encode(array_column($query->result(), 'nilai'),JSON_NUMERIC_CHECK);
			
		}


		public function get_all_proyek(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('thn_anggaran',date("Y"));
				$this->db->from("get_count_nominal_proyek");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('thn_anggaran',date("Y"));
				$this->db->from("get_count_nominal_proyek");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_all_proyek_count(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('thn_anggaran',date("Y"));
				$this->db->group_start();
						$this->db->where("batal",0);
						$this->db->or_where("batal",null);
				$this->db->group_end();
				$this->db->from("ci_proyek");
				return $this->db->count_all_results();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->group_start();
						$this->db->where("batal",0);
						$this->db->or_where("batal",null);
				$this->db->group_end();
				$this->db->where('thn_anggaran',date("Y"));
				$this->db->from("ci_proyek");
				return $this->db->count_all_results();
			}

			
		}


		public function get_all_proyek_cair(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('left(kd_proyek,4)',date("Y"));
				$this->db->from("ci_proyek_cair");
				$this->db->select("ifnull(sum(nilai_bruto),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('substring(kd_proyek,6,2)',$this->session->userdata('kd_area'));
				$this->db->where('left(kd_proyek,4)',date("Y"));
				$this->db->from("ci_proyek_cair");
				$this->db->select("ifnull(sum(nilai_bruto),0) nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_all_proyek_cair_count(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				
				$this->db->where('left(kd_proyek,4)',date("Y"));
				$this->db->from("ci_proyek_cair");
				return $this->db->count_all_results();
			}else{
				$this->db->where('substring(kd_proyek,6,2)',$this->session->userdata('kd_area'));
				$this->db->where('left(kd_proyek,4)',date("Y"));
				$this->db->from("ci_proyek_cair");
				return $this->db->count_all_results();
			}

			
		}

		public function get_all_pdo(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('left(tgl_pdo,4)',date("Y"));
				$this->db->from("ci_pdo");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('left(tgl_pdo,4)',date("Y"));
				$this->db->from("ci_pdo");
				$this->db->select("ifnull(sum(nilai),0) nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_all_pdo_count(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				
				$this->db->where('left(tgl_pdo,4)',date("Y"));
				$this->db->from("ci_pdo");
				return $this->db->count_all_results();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('left(tgl_pdo,4)',date("Y"));
				$this->db->from("ci_pdo");
				return $this->db->count_all_results();
			}

			
		}


		public function get_all_spj_count(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('left(tgl_spj,4)',date("Y"));
				$this->db->from("ci_spj");
				return $this->db->count_all_results();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('left(tgl_spj,4)',date("Y"));
				$this->db->from("ci_spj");
				return $this->db->count_all_results();
			}

			
		}

		public function get_all_spj(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('left(tgl_spj,4)',date("Y"));
				$this->db->from("ci_spj");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('left(tgl_spj,4)',date("Y"));
				$this->db->from("ci_spj");
				$this->db->select("ifnull(sum(nilai),0) nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_active_users(){
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('ci_users');
		}
		public function get_deactive_users(){
			$this->db->where('is_active', 0);
			return $this->db->count_all_results('ci_users');
		}
	}

?>
