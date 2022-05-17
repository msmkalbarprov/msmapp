<?php
	class Dashboard_model extends CI_Model{

		

		public function get_all_proyek(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek')
			{
				$this->db->where('thn_anggaran',date("Y"));
				$this->db->from("ci_proyek");
				return $this->db->count_all_results();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('thn_anggaran',date("Y"));
				$this->db->from("ci_proyek");
				return $this->db->count_all_results();
			}

			
		}


		public function get_all_proyek_cair(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek')
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

		public function get_all_pdo(){

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek')
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
