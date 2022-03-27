<?php
	class Proyek_model extends CI_Model{

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

			
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
				$this->db->select('ci_proyek.*,
					(select nm_jns_pagu from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nm_jns_pagu,
					(select frupiah(nilai) from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nilai,
					(select loc from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as loc,
					ROW_NUMBER() OVER(ORDER BY id ASC) AS row_num ');
				$this->db->from("ci_proyek");
				
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('ci_proyek.*,
					(select nm_jns_pagu from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nm_jns_pagu, 
					(select frupiah(nilai) from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as nilai,
					(select loc from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as loc,
					ROW_NUMBER() OVER(ORDER BY id ASC) AS row_num ');
				$this->db->from("ci_proyek");
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

	function get_project($area)
	{
		$this->db->select('ci_proyek.*,ci_proyek_rincian.jns_pagu,ci_jnspagu.nama as nm_jns_pagu,ci_proyek_rincian.nilai as nilai');
		$this->db->from("ci_proyek");
		$this->db->Join('ci_proyek_rincian','ci_proyek_rincian.id_proyek=ci_proyek.id_proyek', 'inner');
		$this->db->Join('ci_jnspagu','ci_proyek_rincian.jns_pagu=ci_jnspagu.id', 'inner');
		$this->db->where('ci_proyek.kd_proyek', $area);
		$query = $this->db->get();

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

	public function get_detail_pencairan_proyek_by_id($id){
		$query = $this->db->get_where('ci_proyek', array('id_proyek' =>  $id));

			$this->db->select('ci_proyek.*, ci_pendapatan.tgl_cair,ci_pendapatan.status_cair');
			$this->db->from('ci_proyek');
			$this->db->join('ci_pendapatan','ci_pendapatan.id_proyek=ci_proyek.kd_proyek', 'left');
			$this->db->where('ci_proyek.id_proyek',$id);	
		$query=$this->db->get();
		return $query;
	}

	public function get_detail_rincian_proyek_by_id($id){
		$query = $this->db->get_where('ci_proyek_rincian', array('id' =>  $id));
		return $query;
	}


	public function save_proyek_rincian($data){
				$insert_data['dokumen']				= 'uploads/'.$data['pic_file'];
				$insert_data['jns_pagu'] 			= $data['jnspagu'];
				$insert_data['jns_pph'] 			= $data['jns_pph'];
				$insert_data['lama_pekerjaan']		= $data['lama_pekerjaan'];
				$insert_data['id_proyek'] 			= $data['id_proyek'];
				$insert_data['tipe_proyek']			= $data['tipeproyek'];
				$insert_data['no_dokumen'] 			= $data['nodpa'];
				$insert_data['nilai'] 				= $data['nilai'];
				$insert_data['tanggal'] 			= $data['tanggal'];
				$insert_data['tanggal2']			= $data['tanggal2'];
				$insert_data['username']			= $this->session->userdata('username');
				$insert_data['created_at']			= date("Y-m-d h:i:s");
				$query = $this->db->insert('ci_proyek_rincian', $insert_data);
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_proyek($data, $id){
			$this->db->where('id_proyek', $id);
			$this->db->update('ci_proyek', $data);
			return true;
		}

		public function cair_proyek($data, $id_proyek){
			$this->db->where('id_proyek', $id_proyek);
			$this->db->update('ci_pendapatan', $data);
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

	// PQ
	function get_mprojek()
	{	
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek'){
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');
			$this->db->where('thn_anggaran >=',date("Y"));	
		}else{
			$userarea = $this->session->userdata('kd_area');
			$this->db->from('v_get_proyek_pq');
			$this->db->where('kd_area',$userarea);	
			$this->db->where('jns_pagu >','1');	
			$this->db->where('thn_anggaran >=',date("Y"));	
		}
		
		$query=$this->db->get();
		return $query->result_array();
	}

public function cek_proyek($idproyek){

			$query="SELECT kd_proyek FROM ci_proyek WHERE id_proyek ='$idproyek'";
					 $hasil = $this->db->query($query);
					 $proyek_id = $hasil->row('kd_proyek');


			$this->db->select("count(*)as jumlah");
			$this->db->from('ci_pendapatan');
			$this->db->where("id_proyek", $proyek_id);
			return $result = $this->db->get()->row_array();
		}

public function pq_proyek($idproyek){

			$query="SELECT kd_proyek FROM ci_proyek WHERE id_proyek ='$idproyek'";
			$hasil = $this->db->query($query);
		 	$proyek_id = $hasil->row('kd_proyek');

			$this->db->select("*");
			$this->db->from('ci_pendapatan');
			$this->db->where("id_proyek", $proyek_id);
			return $result = $this->db->get()->row_array();
		}

	}

?>