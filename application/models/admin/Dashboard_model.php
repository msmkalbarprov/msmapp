<?php
	class Dashboard_model extends CI_Model{

		

		public function get_proyek(){

			
				// $this->db->where('thn_anggaran',date("Y"));
				// $this->db->from("get_count_nominal_proyek");
				// $this->db->select("ifnull(sum(nilai),0)as nilai");
				// return $result = $this->db->get()->row_array();
				$tahun = $this->session->userdata('tahun');
				if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing'){
					$this->db->select("
					(select 
					ifnull(sum(zz.nilai),0) AS total 
							from (
							select 
								ci_proyek.thn_anggaran,
								ci_proyek.kd_area AS kd_area,
								(select ci_proyek_rincian.nilai from ci_proyek_rincian where 
									ci_proyek_rincian.id_proyek = ci_proyek.id_proyek order by ci_proyek_rincian.id desc limit 1) AS nilai,
								(select ci_proyek_rincian.jns_pagu from ci_proyek_rincian 
								where ci_proyek_rincian.id_proyek = ci_proyek.id_proyek order by ci_proyek_rincian.id desc limit 1) AS jns_pagu 
							from ci_proyek where (ci_proyek.batal = 0 or ci_proyek.batal is null)
						) zz where zz.kd_area=ci_area.kd_area and thn_anggaran= $tahun )as nilai ");
					$this->db->from("ci_area");
					$this->db->order_by('kd_area');


				}else{
					$this->db->select("kd_area,nm_area, 
					(select 
					ifnull(sum(zz.nilai),0) AS total 
							from (
							select 
								ci_proyek.thn_anggaran,
								ci_proyek.kd_area AS kd_area,
								(select ci_proyek_rincian.nilai from ci_proyek_rincian where 
									ci_proyek_rincian.id_proyek = ci_proyek.id_proyek order by ci_proyek_rincian.id desc limit 1) AS nilai,
								(select ci_proyek_rincian.jns_pagu from ci_proyek_rincian 
								where ci_proyek_rincian.id_proyek = ci_proyek.id_proyek order by ci_proyek_rincian.id desc limit 1) AS jns_pagu 
							from ci_proyek where (ci_proyek.batal = 0 or ci_proyek.batal is null)
						) zz where zz.kd_area=ci_area.kd_area and thn_anggaran= $tahun )as nilai ");
					$this->db->from("ci_area");
					$this->db->order_by('kd_area');
					$this->db->where("kd_area",$this->session->userdata('kd_area'));
					
				}
				
				$query = $this->db->get();
				
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
				$tahun = $this->session->userdata('tahun');
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('thn_anggaran',$tahun);
				$this->db->from("get_count_nominal_proyek");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('thn_anggaran',$tahun);
				$this->db->from("get_count_nominal_proyek");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_all_proyek_count(){

			$tahun = $this->session->userdata('tahun');

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('thn_anggaran',$tahun);
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
				$this->db->where('thn_anggaran',$tahun);
				$this->db->from("ci_proyek");
				return $this->db->count_all_results();
			}

			
		}


		public function get_all_proyek_cair(){
			$tahun = $this->session->userdata('tahun');
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('left(kd_proyek,4)',$tahun);
				$this->db->from("ci_proyek_cair");
				$this->db->select("ifnull(sum(nilai_bruto),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('substring(kd_proyek,6,2)',$this->session->userdata('kd_area'));
				$this->db->where('left(kd_proyek,4)',$tahun);
				$this->db->from("ci_proyek_cair");
				$this->db->select("ifnull(sum(nilai_bruto),0) nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_all_proyek_cair_count(){
			$tahun = $this->session->userdata('tahun');

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				
				$this->db->where('left(kd_proyek,4)',$tahun);
				$this->db->from("ci_proyek_cair");
				return $this->db->count_all_results();
			}else{
				$this->db->where('substring(kd_proyek,6,2)',$this->session->userdata('kd_area'));
				$this->db->where('left(kd_proyek,4)',$tahun);
				$this->db->from("ci_proyek_cair");
				return $this->db->count_all_results();
			}

			
		}

		public function get_all_pdo(){
			$tahun 		= $this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal 	= $tahun.'-02-01';
			$tgl_akhir 	= $tahun_depan.'-02-01';
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('tgl_pdo >=', $tgl_awal);
				$this->db->where('tgl_pdo <', $tgl_akhir);
				$this->db->from("ci_pdo");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('tgl_pdo >=', $tgl_awal);
				$this->db->where('tgl_pdo <', $tgl_akhir);
				$this->db->from("ci_pdo");
				$this->db->select("ifnull(sum(nilai),0) nilai");
				return $result = $this->db->get()->row_array();
			}

			
		}

		public function get_all_pdo_count(){
			$tahun 		= $this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal 	= $tahun.'-02-01';
			$tgl_akhir 	= $tahun_depan.'-02-01';

			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('tgl_pdo >=', $tgl_awal);
				$this->db->where('tgl_pdo <', $tgl_akhir);
				$this->db->from("ci_pdo");
				return $this->db->count_all_results();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('tgl_pdo >=', $tgl_awal);
				$this->db->where('tgl_pdo <', $tgl_akhir);
				$this->db->from("ci_pdo");
				return $this->db->count_all_results();
			}

			
		}


		public function get_all_spj_count(){
			$tahun 		= $this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal 	= $tahun.'-02-01';
			$tgl_akhir 	= $tahun_depan.'-02-01';
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('tgl_spj >=', $tgl_awal);
				$this->db->where('tgl_spj <', $tgl_akhir);
				$this->db->from("ci_spj");
				return $this->db->count_all_results();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('tgl_spj >=', $tgl_awal);
				$this->db->where('tgl_spj <', $tgl_akhir);
				$this->db->from("ci_spj");
				return $this->db->count_all_results();
			}

			
		}

		public function get_all_spj(){

			$tahun 		= $this->session->userdata('tahun');
			$tahun_depan=$tahun+1;
			$tgl_awal 	= $tahun.'-02-01';
			$tgl_akhir 	= $tahun_depan.'-02-01';
			if ($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing')
			{
				$this->db->where('tgl_spj >=', $tgl_awal);
				$this->db->where('tgl_spj <', $tgl_akhir);
				$this->db->from("ci_spj");
				$this->db->select("ifnull(sum(nilai),0)as nilai");
				return $result = $this->db->get()->row_array();
			}else{
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where('tgl_spj >=', $tgl_awal);
				$this->db->where('tgl_spj <', $tgl_akhir);
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
