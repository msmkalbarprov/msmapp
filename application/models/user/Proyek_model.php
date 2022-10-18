<?php
	class Proyek_model extends CI_Model{

	public function angka($nilai){
		$nilai=str_replace(',','',$nilai);
		return $nilai;
	}


	public function number($nilai){
		$nilai1=str_replace('.','',$nilai);
		$nilai=str_replace(',','.',$nilai1);
		return $nilai;
	}

	public function number2($nilai){
		$nilai1=str_replace('.',',',$nilai);
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

			
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Divisi Finance' || $this->session->userdata('admin_role')=='Admin'){
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

	public function get_subproyek_cair_by_id($id){
				$this->db->select('*,(select ifnull(sum(nilai),0) from ci_proyek_cair_potongan where ci_proyek_cair_potongan.id_cair=ci_proyek_cair.id)as potongan');
				$this->db->from("ci_proyek_cair");
				$this->db->where('id_proyek',$id);
                return $this->db->get()->result_array();
		}

	public function get_potongan_cair_by_id($id,$nomor){
				$this->db->select('*');
				$this->db->from("ci_proyek_cair_potongan");
				$this->db->where('id_proyek',$id);
				$this->db->where('nomor',$nomor);
                return $this->db->get()->result_array();
		}
	function get_dinas($subarea,$area)
	{	
		$query = $this->db->get_where('ci_dinas', array('kd_area' => $area, 'kd_sub_area' => $subarea));
		return $query;
	}

	function get_nilai_cair($nomor)
	{		
			$nomor_new=str_replace('ab56b4d92b40713acc5af89985d4b786','/',$nomor);
			$this->db->select("ifnull(nilai_bruto,0)as nilai_bruto, nomor, id");
			$this->db->from("ci_proyek_cair");
            $this->db->where('nomor', $nomor_new);
			return $result = $this->db->get()->row_array();
	}

function get_nilai_hpp($id, $no_acc)
	{	
		if ($no_acc=='5041405'){
		    $this->db->select('ppn as total');
			$this->db->from('ci_pendapatan');
			$this->db->where('id_proyek', $id);	
			$query=$this->db->get();
		}else if ($no_acc=='5041401'){ // pph 21

			$query="SELECT a.id, a.jns_pph from ci_proyek_rincian a inner join ci_proyek b on a.id_proyek=b.id_proyek where b.kd_proyek='$id' order by a.id desc limit 1";
					 $hasil     		= $this->db->query($query);
					 $jns_pph 			= $hasil->row('jns_pph');
					 $id_rincian		= $hasil->row('id');

		    $this->db->select('pph as total,ci_proyek_rincian.jns_pph');
			$this->db->from('ci_pendapatan');
			$this->db->join('ci_proyek_rincian',"ci_pendapatan.kd_proyek=ci_proyek_rincian.id_proyek","left");
			$this->db->where('ci_pendapatan.id_proyek', $id);	
			$this->db->where('ci_proyek_rincian.jns_pph', 21);	
			$query=$this->db->get();
		}else if ($no_acc=='5041402'){ // pph 22

			$query="SELECT a.id, a.jns_pph from ci_proyek_rincian a inner join ci_proyek b on a.id_proyek=b.id_proyek where b.kd_proyek='$id' order by a.id desc limit 1";
					 $hasil     		= $this->db->query($query);
					 $jns_pph 			= $hasil->row('jns_pph');
					 $id_rincian		= $hasil->row('id');

		    $this->db->select('pph as total,ci_proyek_rincian.jns_pph');
			$this->db->from('ci_pendapatan');
			$this->db->join('ci_proyek_rincian',"ci_pendapatan.kd_proyek=ci_proyek_rincian.id_proyek","left");
			$this->db->where('ci_pendapatan.id_proyek', $id);	
			$this->db->where('ci_proyek_rincian.jns_pph', 22);	
			$query=$this->db->get();
		}else if ($no_acc=='5041403'){ // pph 23

			$query="SELECT a.id, a.jns_pph from ci_proyek_rincian a inner join ci_proyek b on a.id_proyek=b.id_proyek where b.kd_proyek='$id' order by a.id desc limit 1";
					 $hasil     		= $this->db->query($query);
					 $jns_pph 			= $hasil->row('jns_pph');
					 $id_rincian		= $hasil->row('id');

		    $this->db->select('pph as total,ci_proyek_rincian.jns_pph');
			$this->db->from('ci_pendapatan');
			$this->db->join('ci_proyek_rincian',"ci_pendapatan.kd_proyek=ci_proyek_rincian.id_proyek","left");
			$this->db->where('ci_pendapatan.id_proyek', $id);	
			$this->db->where('ci_proyek_rincian.jns_pph', 23);	
			$query=$this->db->get();
		}else if ($no_acc=='5041406'){ // infaq

			$this->db->select('infaq as total');
			$this->db->from('ci_pendapatan');
			$this->db->where('ci_pendapatan.id_proyek', $id);	
			$query=$this->db->get();
		}
		
		return $query;
	}

function get_realisasi_hpp($id, $no_acc)
	{	

		// $query="SELECT b.kd_proyek,(select kd_pqproyek from ci_pendapatan c where b.kd_proyek=c.id_proyek)as kd_pqproyek from ci_proyek_transfer a inner join
		//  			ci_proyek_cair b on a.no_cair=b.nomor
		//  		where a.no_transfer='$id' limit 1";
		// 			 $hasil     = $this->db->query($query);
		// 			 $id_new    = $hasil->row('kd_proyek');
		// 			 $id_pq    	= $hasil->row('kd_pqproyek');


		$this->db->select('ifnull(sum(nilai),0)as total');
		$this->db->from('ci_proyek_cair_potongan');
		$this->db->where('id_proyek', $id);	
		$this->db->where('kd_acc', $no_acc);	
		$query=$this->db->get();
		return $query;
	}

function get_realisasi_hpp2($id)
	{	

		$this->db->select('ifnull(sum(nilai),0)as total');
		$this->db->from('ci_proyek_cair_potongan');
		$this->db->where('id_proyek', $id);
		$query=$this->db->get();
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

public function get_pdp_detail($id,$id_proyek){
			$this->db->select("ci_proyek_cair.*, ci_proyek.nm_paket_proyek, ci_proyek.nm_dinas, 
								case 
									when ci_proyek_cair.jenis_cair='1' then '(Uang Muka/DP)'
									when ci_proyek_cair.jenis_cair='2' then 'Termin 1'
									when ci_proyek_cair.jenis_cair='3' then 'Termin 2'
									when ci_proyek_cair.jenis_cair='4' then 'Termin 3'
									when ci_proyek_cair.jenis_cair='5' then 'Termin 4'
									when ci_proyek_cair.jenis_cair='6' then 'Termin 5'
									when ci_proyek_cair.jenis_cair='7' then 'Termin 6'
									when ci_proyek_cair.jenis_cair='8' then 'Termin 7'
									when ci_proyek_cair.jenis_cair='9' then 'Termin 8'
									when ci_proyek_cair.jenis_cair='10' then 'Termin 9'
									when ci_proyek_cair.jenis_cair='11' then 'Termin 10'
									when ci_proyek_cair.jenis_cair='12' then 'Termin 11'
									when ci_proyek_cair.jenis_cair='13' then 'Termin 12'
									when ci_proyek_cair.jenis_cair='14' then 'Termin 13'
									when ci_proyek_cair.jenis_cair='15' then 'Termin 14'
									when ci_proyek_cair.jenis_cair='16' then 'Termin 15'
									else '(Lunas)'
								end as jns_cair,
								sum( case when ci_proyek_cair_potongan.kd_acc='5041405' then ci_proyek_cair_potongan.nilai else 0 end) as ppn,
								sum( case when ci_proyek_cair_potongan.kd_acc in ('5041401','5041402','5041403') then ci_proyek_cair_potongan.nilai else 0 end) as pph,
								sum( case when ci_proyek_cair_potongan.kd_acc='5020501' then ci_proyek_cair_potongan.nilai else 0 end) as infaq,
								sum( case when ci_proyek_cair_potongan.kd_acc='5041501' then ci_proyek_cair_potongan.nilai else 0 end) as adm
								");
			$this->db->from("ci_proyek_cair");
			$this->db->join("ci_proyek", "ci_proyek_cair.id_proyek=ci_proyek.id_proyek", "left");
			$this->db->join("ci_proyek_cair_potongan", "ci_proyek_cair.id_proyek=ci_proyek_cair_potongan.id_proyek and ci_proyek_cair.id = ci_proyek_cair_potongan.id_cair", "left");
			$this->db->where("ci_proyek_cair.id_proyek", $id_proyek);
			$this->db->where("ci_proyek_cair.id", $id);
			$this->db->order_by("id");
			$query=$this->db->get();
			return $query->result_array();
		}
public function get_pdp_header($id,$id_proyek){
			$this->db->select("ci_proyek.*,nilai_bruto-sum(ci_proyek_cair_potongan.nilai)as nilai,ci_proyek_cair.tgl_cair,ci_proyek_cair.nomor");
			$this->db->from("ci_proyek");
			$this->db->join("ci_proyek_cair", "ci_proyek_cair.id_proyek=ci_proyek.id_proyek", "left");
			$this->db->join("ci_proyek_cair_potongan", "ci_proyek_cair.id_proyek=ci_proyek_cair_potongan.id_proyek", "left");
			$this->db->where("ci_proyek_cair.id_proyek", $id_proyek);
			$this->db->where("ci_proyek_cair.id", $id);
			$this->db->where("ci_proyek.id_proyek",$id_proyek);
       		return $result = $this->db->get()->row_array();
		}

	public function get_detail_pencairan_proyek_by_id($id){
		$query = $this->db->select('*,(SELECT jns_pph from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id DESC LIMIT 1 )as jns_pph,(select nilai from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id DESC LIMIT 1 )as nilai_proyek,(select sum(nilai_bruto) from ci_proyek_cair where ci_proyek_cair.id_proyek=ci_proyek.id_proyek )as realisasi');
			$this->db->from('ci_proyek');
			$this->db->where('ci_proyek.id_proyek',$id);	
		$query=$this->db->get();
		return $query;
	}

	public function get_detail_rincian_proyek_by_id($id){
		$query = $this->db->get_where('ci_proyek_rincian', array('id' =>  $id));
		return $query;
	}

	public function get_detail_rincian_proyek_cair_by_id($id){
		$query = $this->db->get_where('ci_proyek_cair', array('id_proyek' =>  $id));
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

		public function batal($id){
			$this->db->where('id_proyek', $id);
			$this->db->set('batal','1');
			$this->db->update('ci_proyek');
			return true;
		}

		public function cair_proyek($data2, $id_proyek){
			$this->db->where('id_proyek', $id_proyek);
			$this->db->update('ci_pendapatan', $data2);
			return true;
		}

		public function simpan_cair_proyek($data){
			$this->db->insert('ci_proyek_cair', $data);
			return true;
		}

		public function simpan_transfer_proyek($data){
			$this->db->insert('ci_proyek_transfer', $data);
			return true;
		}

		public function simpan_cair_potongan($data,$id_cair){

			// simpan potongan
			$this->db->insert('ci_proyek_cair_potongan', $data);


			$query1 ="SELECT rek_pencairan,nilai_bruto,nomor,(select sum(nilai) from ci_proyek_cair_potongan where id_cair='$id_cair')as potongan  from ci_proyek_cair where id='$id_cair'";
					 $hasil = $this->db->query($query1);
					 $rek_pencairan = $hasil->row('rek_pencairan');
					 $no_cair = $hasil->row('nomor');
					 $nilai_bruto = $hasil->row('nilai_bruto');
					 $potongan = $hasil->row('potongan');

					 $nilai_baru = $nilai_bruto-$potongan;

			// update nilai netto di transfer
			if ($rek_pencairan !='1' || $rek_pencairan !=1){
				
				$this->db->set('nilai',$nilai_baru);
				$this->db->where('no_cair',$no_cair);
				$this->db->update('ci_proyek_transfer');
			}
			
			
			return true;
		}

		public function update_nilai_transfer($id_cair){

			$query1 ="SELECT rek_pencairan,nilai_bruto,nomor,(select sum(nilai) from ci_proyek_cair_potongan where id_cair='$id_cair')as potongan  from ci_proyek_cair where id='$id_cair'";
					 $hasil 		= $this->db->query($query1);
					 $rek_pencairan = $hasil->row('rek_pencairan');
					 $no_cair 		= $hasil->row('nomor');
					 $nilai_bruto 	= $hasil->row('nilai_bruto');
					 $potongan 		= $hasil->row('potongan');
					 $nilai_baru 	= $nilai_bruto-$potongan;

			// update nilai netto di transfer
			if ($rek_pencairan !='1' || $rek_pencairan !=1){
				
				$this->db->set('nilai',$nilai_baru);
				$this->db->where('no_cair',$no_cair);
				$this->db->update('ci_proyek_transfer');
			}
			
			
			return true;
		}

		public function edit_rincian_proyek($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_proyek_rincian', $data);
			return true;
		}

		public function update_status_pencairan($data3, $id){
			$this->db->where('id_proyek', $id);
			$this->db->update('ci_pendapatan', $data3);
			return true;
		}

		public function get_nomor_pdp($area)
		{
		$query = $this->db->get_where('get_urut_pdp', array('kd_area' => $area));
		return $query;
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
		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Divisi Finance' || $this->session->userdata('admin_role')=='Admin'){
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

public function get_register_pdp($id,$tahun,$bulan){
			
			if ($id=='allarea'){
				$this->db->select("*");
			$this->db->from("cetak_register_pdp");
			}else{
				$this->db->select("*");
				$this->db->from("cetak_register_pdp");
				$this->db->where("kd_area", $id);
			}

			if($bulan==0){
				$this->db->where("year(tgl_cair)", $tahun);
			}else{
				$this->db->where("year(tgl_cair)", $tahun);
				$this->db->where("month(tgl_cair)", $bulan);
			}
			$this->db->order_by("kd_area,right(nomor,4)");
			$query=$this->db->get();
			return $query->result_array();
		}


	}

?>