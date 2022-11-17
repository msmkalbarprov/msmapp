<?php
	class PublicModel extends CI_Model{
		
		
		
		//get nama dari master
		public function get_nama($kode='',$hasil='',$tabel='',$field='')
		{
			$this->db->select($hasil);
			$this->db->where($field, $kode);
			$q = $this->db->get($tabel);
			$data  = $q->result_array();
			$baris = $q->num_rows();
			return $data[0][$hasil];
		}

		public function getNamaDaerah($id_daerah)
		{
			$sql = "SELECT id_daerah as id, nm_daerah as nama, ket as jenis from ms_daerah where id_daerah = ".$id_daerah.";";		
			return $this->db->query($sql)->result();
		}

		public function getNamaInstansi($id_daerah)
		{
			$sql = "SELECT id_instansi as id, nm_instansi as nama, 'INSTANSI' as jenis from ms_instansi_kemendagri where id_instansi = ".$id_daerah.";";		
			return $this->db->query($sql)->result();
		}

		public function daftar_fokus_bpk($jenis = '')
	    {
	    	$tahun = $this->session->userdata('year_selected');
			$query = 'SELECT * FROM ms_jenis_audit where tahun = '.$tahun.' AND (jenis = "" OR jenis is NULL OR jenis = "'.$jenis.'")';
			
	    	$sql = $this->db->query($query)->result_array();
	    	return $sql;
	    }

	    public function viewNotif($id = 0)
	    {
	    	$where = array('id'=>$id);
	    	$data = array('status'=>'DILIHAT');
	    	$this->db->where($where);
	    	$this->db->update('tr_history_tlhp',$data);
	    }

	    public function viewNotifKemendagri($id = 0)
	    {
	    	$where = array('id'=>$id);
	    	$data = array('status'=>'DILIHAT');
	    	$this->db->where($where);
	    	$this->db->update('tr_history_tlhp_kemendagri',$data);
	    }

	    public function viewNotifPemda($id = 0)
	    {
	    	$where = array('id'=>$id);
	    	$data = array('status'=>'DILIHAT');
	    	$this->db->where($where);
	    	$this->db->update('tr_history_tlhp_pemda',$data);
	    }

	    public function add_history($tbl,$aksi,$noreg,$no_lhp,$kd_temuan,$kd_rekomendasi,$kd_tl,$kd_lamp,$menu,$submenu,$routes,$uraian)
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	    	$ses = $this->session->userdata();
	    	$user_date = date('Y-m-d H:i:s');
	    	$user_type = $ses['is_admin'];
	    	$user_id = $ses['user_id'];
			$satker = explode('-', $noreg);
			$instansi = $satker[1];
			$dataHistory = array(
					'aksi'=>$aksi,'uraian'=>$uraian,'user_id'=>$user_id,'user_type'=>$user_type,'user_date'=>$user_date,'status'=>'BELUM DILIHAT',
					'instansi'=>$instansi,'noreg' => $noreg,'no_lhp' => $no_lhp,'kd_rekomendasi' => $kd_rek,'kd_temuan' => $kd_temuan,'kd_rekomendasi'=>$kd_rekomendasi,
					'kd_tl'=>$kd_tl,'kd_lamp'=>$kd_lamp,'menu'=>$menu,'submenu'=>$submenu,'routes'=>$routes
				);
			$dataHistory = $this->security->xss_clean($dataHistory);
			$result2 = $this->db->insert($tbl, $dataHistory);

			return true;
	    }

	    public function add_history_bpk($tbl,$aksi,$noreg,$no_lhp,$id_aspek,$kd_temuan,$kd_rekomendasi,$kd_tl,$kd_lamp,$menu,$submenu,$routes,$uraian)
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	    	$ses = $this->session->userdata();
	    	$user_date = date('Y-m-d H:i:s');
	    	$user_type = $ses['is_admin'];
	    	$user_id = $ses['user_id'];
			$satker = explode('-', $noreg);
			$instansi = $satker[1];
			$dataHistory = array(
					'aksi'=>$aksi,'uraian'=>$uraian,'user_id'=>$user_id,'user_type'=>$user_type,'user_date'=>$user_date,'status'=>'BELUM DILIHAT',
					'instansi'=>$instansi,'noreg' => $noreg,'no_lhp' => $no_lhp,'id_aspek' => $id_aspek,'kd_rekomendasi' => $kd_rek,'kd_temuan' => $kd_temuan,'kd_rekomendasi'=>$kd_rekomendasi,
					'kd_tl'=>$kd_tl,'kd_lamp'=>$kd_lamp,'menu'=>$menu,'submenu'=>$submenu,'routes'=>$routes
				);
			$dataHistory = $this->security->xss_clean($dataHistory);
			$result2 = $this->db->insert($tbl, $dataHistory);
			
			return true;
	    }

	    public function add_history_kemendagri($tbl,$aksi,$noreg,$no_lhp,$id_aspek,$kd_temuan,$kd_rekomendasi,$kd_tl,$kd_lamp,$menu,$submenu,$routes,$uraian)
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	    	$ses = $this->session->userdata();
	    	$user_date = date('Y-m-d H:i:s');
	    	$user_type = $ses['is_admin'];
	    	$user_id = $ses['user_id'];
			$satker = explode('-', $noreg);
			$instansi = $satker[1];
			$dataHistory = array(
					'aksi'=>$aksi,'uraian'=>$uraian,'user_id'=>$user_id,'user_type'=>$user_type,'user_date'=>$user_date,'status'=>'BELUM DILIHAT',
					'instansi'=>$instansi,'noreg' => $noreg,'no_lhp' => $no_lhp,'id_aspek' => $id_aspek,'kd_rekomendasi' => $kd_rek,'kd_temuan' => $kd_temuan,'kd_rekomendasi'=>$kd_rekomendasi,
					'kd_tl'=>$kd_tl,'kd_lamp'=>$kd_lamp,'menu'=>$menu,'submenu'=>$submenu,'routes'=>$routes
				);
			$dataHistory = $this->security->xss_clean($dataHistory);
			$result2 = $this->db->insert($tbl, $dataHistory);
			
			return true;
	    }

		public function daftar_lhp()
	    {
	    	$tahun = $this->session->userdata('year_selected');
			$query = 'SELECT * FROM ms_lhp';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }

	    public function getUser($id = '')
	    {
			$query = 'SELECT * FROM ms_user where id_user = "'.$id.'"';
	    	$sql = $this->db->query($query)->row();
	    	return $sql;
	    }

	     public function getInstansiFromId($id = '')
	    {
			$query = 'SELECT * FROM ms_instansi_kemendagri where id_instansi = "'.$id.'"';
	    	$sql = $this->db->query($query)->row();
	    	$instansi = $sql->nm_instansi;
	    	return $instansi;
	    }


		public function getInstansi()
	    {
			$instansi = $this->session->userdata('id_instansi');
			$akses = $this->session->userdata('is_admin');
		
			if($akses==3){
				$where="where kd_apip='".$instansi."'";
			}else{
				$where='';
			}
		 
			$query = "SELECT * FROM ms_apip ".$where ;
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }


	    public function daftar_lhp_lk()
	    {
	    	$tahun = $this->session->userdata('year_selected');
			$query = 'SELECT * FROM ms_lhp where jenis = "LK" AND tahun = '.$tahun;
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }
	    public function daftar_lhp_kinerja()
	    {
	    	$tahun = $this->session->userdata('year_selected');
			$query = 'SELECT * FROM ms_lhp where jenis = "KINERJA" AND tahun = '.$tahun;
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }
	    public function daftar_lhp_dtt()
	    {
	    	$tahun = $this->session->userdata('year_selected');
			$query = 'SELECT * FROM ms_lhp where jenis = "DTT" AND tahun = '.$tahun;

	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }
	    public function daftar_lhp_pemda_thn()
	    {
	    	$thn = $this->session->userdata('year_selected');
	    	$akses = $this->session->userdata('is_admin');
	    	if($akses == 1){
				$where = '';
			}else if($akses == 2){
				$daerah = $this->session->userdata('id_pemda');
				$where  = ' and id_daerah in ('.$daerah.') ';
			}else if($akses == 4){
				$id_prov = $this->session->userdata('id_prov');
				$where  = ' and id_daerah = '.$id_prov.' ';
			}else if($akses == 5){
				$id_prov = $this->session->userdata('id_kab');
				$where  = ' and id_daerah = '.$id_prov.' ';
			}else if($akses == 6){
				$apip = $this->session->userdata('id_ins');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->pemda;
				$where  = ' and id_daerah in ('.$daerah.') ';
				
			}
			if ($thn>=2021 && $akses <> 1) {
				$where  .= ' AND (SELECT sts_posting FROM tbl_posting_pemda where p.no_lhp = no_lhp AND p.tahun = tahun) = "y" ';
			}

			$query = 'SELECT *,(SELECT nm_daerah from ms_daerah where id_daerah = p.id_daerah) as nm_daerah 
						FROM ms_lhp_pemda p where tahun = '.$thn.' '.$where.' order by p.no_lhp asc';
			// print_r($query);die();
		
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }

	    public function getInfoSisaWaktu($posting)
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	    	// $posting = '2021-06-09';
	    	$hariini = date('Y-m-d');
			$postingCon = strtotime($posting);
			
	    	$i = 0;
	    	$html='';
	    	$tglDeadline = '';
	    	$sisaWaktu 	= 0;
	    	while($i <= 60) {
	    		if (date('w', $postingCon) !== '0' && date('w', $postingCon) !== '6') {
	    			$resLibur = $this->db->get_where('ms_hari_libur',array('tanggal'=>date('Y-m-d', $postingCon)))->result();
	    			if (count($resLibur)>0) {
	    				$html.="<p style='color:red;'>$i :LIBUR</p><br>";
			        	$sabtuminggu[] = $i;
	    			}else{
	    				if (date('Y-m-d', $postingCon)>=$hariini) {
	    					$sisaWaktu++;
	    				}
			        	$hariKerja[] = $i;
			  			$i++;
			   			$html.="<p style=''>$i :".date('Y-m-d', $postingCon)."</p><br>";
	    			}
			    } else {
			    	$html.="<p style='color:red;'>$i :LIBUR</p><br>";
			        $sabtuminggu[] = $i;
			    }
			   $postingCon += (60 * 60 * 24);
			   $tglDeadline = date('Y-m-d', $postingCon);
			} 
			if ($tglDeadline <> '') {
				$data['tglDeadline'] = $tglDeadline;
				$data['sisaWaktu'] = $sisaWaktu;
			}else{
				$data['tglDeadline'] = '';
				$data['sisaWaktu'] = '';
			}
			return $data;
	    }

	    public function getInfoPenyelesaian($posting,$risalah)
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	    	// $posting = '2021-06-09';
	    	$hariini = date('Y-m-d',strtotime($risalah));
			$postingCon = strtotime($posting);
			
	    	$i = 0;
	    	$html='';
	    	$tglDeadline = '';
	    	$sisaWaktu 	= 0;
	    	while($tglDeadline <= $hariini) {
	    		if (date('w', $postingCon) !== '0' && date('w', $postingCon) !== '6') {
	    			$resLibur = $this->db->get_where('ms_hari_libur',array('tanggal'=>date('Y-m-d', $postingCon)))->result();
	    			if (count($resLibur)>0) {
	    				$html.="<p style='color:red;'>$i :LIBUR</p><br>";
			        	$sabtuminggu[] = $i;
	    			}else{
	    				if (date('Y-m-d', $postingCon)<=$hariini) {
	    					$sisaWaktu++;
	    				}
			        	$hariKerja[] = $i;
			  			$i++;
			   			$html.="<p style=''>$i :".date('Y-m-d', $postingCon)."</p><br>";
	    			}
			    } else {
			    	$html.="<p style='color:red;'>$i :LIBUR</p><br>";
			        $sabtuminggu[] = $i;
			    }
			   $postingCon += (60 * 60 * 24);
			   $tglDeadline = date('Y-m-d', $postingCon);

			} 
			if ($tglDeadline <> '') {
				$data['tglDeadline'] = $tglDeadline;
				$data['waktu'] = $sisaWaktu;
			}else{
				$data['tglDeadline'] = '';
				$data['waktu'] = '';
			}
			return $data;
	    }

	    public function daftar_lhp_pemda()
	    {
	    	$thn = $this->session->userdata('year_selected');
			$query = 'SELECT *,(SELECT nm_daerah from ms_daerah where id_daerah = p.id_daerah) as nm_daerah FROM ms_lhp_pemda p order by p.no_lhp asc';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }

	    public function daftar_ttd()
	    {
			$query = 'SELECT * FROM ms_pejabat WHERE jns = 5';
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }

	    public function daftar_lhp_kemendagri($kode = '')
	    {	
	    	$thn = $this->session->userdata('year_selected');
	    	$where = '';
	    	if ($kode <> '') {
	    		$where .= ' AND LEFT(jns_bentuk_was,1) = "'.$kode.'"';
	    	}
			$query = 'SELECT *,(SELECT nm_instansi from ms_instansi_kemendagri where id_instansi = p.id_daerah) as nm_daerah FROM ms_lhp_kemendagri p where tahun = '.$thn.' '.$where.' order by p.no_lhp asc';
			
	    	$sql = $this->db->query($query)->result();
	    	return $sql;
	    }


	    public function getcombokemendagri($kode)
		{
			
			$akses = $this->session->userdata('is_admin');
			if($akses == 1){
				$this->db->select('*');
				$this->db->from('ms_instansi_kemendagri');
				if ($kode == 'BNPP' || $kode == 'DKPP') {
					$this->db->where('nm_group', $kode);
				}else{
					$this->db->where_not_in('nm_group', array('BNPP','DKPP'));
				}
				$this->db->order_by('id_instansi', 'asc');
				$query = $this->db->get();
				
				$result = $query->result_array();
			}else if($akses == 2){
				$daerah = $this->session->userdata('id_kemendagri');
				$arrayDaerah = str_replace(', ', '","', $daerah);
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$arrayDaerah.") order by id_instansi";	

				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 4){
				$id_prov = $this->session->userdata('id_prov');
				
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$id_prov.") order by id_instansi";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 5){
				$id_prov = $this->session->userdata('id_prov');
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$id_prov.") order by id_instansi";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if ($akses == 6) {
				$apip = $this->session->userdata('id_ins');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$daerah.") order by id_instansi";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}

			
			
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($i == 0 && count($result) > 1) {
					$html .='<option selected value="'.$row['id_instansi'].'">'.$row['id_instansi'].' || '.$row['nm_instansi'].'</option>';
				}else{
					$html .='<option value="'.$row['id_instansi'].'">'.$row['id_instansi'].' || '.$row['nm_instansi'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		 public function getcombokemendagri_old($kode)
		{
			
			$akses = $this->session->userdata('is_admin');
			if($akses == 1){
				$this->db->select('*');
				$this->db->from('ms_instansi_kemendagri');
				if ($kode == 'BNPP' || $kode == 'DKPP') {
					$this->db->where('nm_group', $kode);
				}else{
					$this->db->where_not_in('nm_group', array('BNPP','DKPP'));
				}
				$this->db->order_by('id_instansi', 'asc');
				$query = $this->db->get();
				
				$result = $query->result_array();
			}else if($akses == 2){
				$apip = $this->session->userdata('id_prov');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$daerah.") order by id_instansi";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 4){
				$id_prov = $this->session->userdata('id_prov');
				
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$id_prov.") order by id_instansi";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}else if($akses == 5){
				$id_prov = $this->session->userdata('id_prov');
				$sqlDaerah = "SELECT * FROM ms_instansi_kemendagri where id_instansi in (".$id_prov.") order by id_instansi";	
				$result = $this->db->query($sqlDaerah)->result_array();
			}

			
			
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($i == 0 && count($result) > 1) {
					$html .='<option selected value="'.$row['id_instansi'].'">'.$row['id_instansi'].' || '.$row['nm_instansi'].'</option>';
				}else{
					$html .='<option value="'.$row['id_instansi'].'">'.$row['id_instansi'].' || '.$row['nm_instansi'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		

		public function getcombojenis($kode)
		{

			if ($kode =='R') {
				$jenis = 'REVIU';
			}else if ($kode =='M') {
				$jenis = 'MONITORING';
			}else if ($kode =='E') {
				$jenis = 'EVALUASI';
			}else if ($kode =='P') {
				$jenis = 'PEMERIKSAAN';
			}else if ($kode =='L') {
				$jenis = 'PENGAWASAN LAINNYA';
			}else{
				$jenis = '';
			}
			$thn = $this->session->userdata('year_selected');
			$akses = $this->session->userdata('is_admin');
			if($akses == 1 || $akses == 2){

				$this->db->select('*');
				$this->db->where('tahun', $thn);
				$this->db->where('jenis', $jenis);
				$this->db->from('ms_bentuk_pengawasan');
				$query = $this->db->get();
				$result = $query->result_array();
			
			}
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
					$html .='<option value="'.$row['kode'].'">'.$row['uraian'].'</option>';	
					$i++;
			}
			return $html;
		}

		public function get_aspek_lhp()
		{
			$thn = $this->session->userdata('year_selected');
			$akses = $this->session->userdata('is_admin');
			if($akses == 1 || $akses == 2){

				$this->db->select('*');
				$this->db->where_in('tahun', array($thn,'ALL'));
				$this->db->where('level<', 2);
				$this->db->from('view_afs_pemda');
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get();
				$result = $query->result_array();
			
			}
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($row['level'] == 0) {
					if($i<>0){
						$html .= "</optgroup>";
					}
					$html .='<optgroup label="'.$row['text'].'" style="font-weight:bold;">';
				}else{
					$html .='<option value="'.$row['id'].'">&#149; '.$row['text'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		public function get_fokus_lhp($aspek)
		{
			$thn = $this->session->userdata('year_selected');
			$akses = $this->session->userdata('is_admin');
			$jmlAspek = count($aspek);
			$where ='';
			$whereCustom ='';
			if ($jmlAspek>0) {
				for ($i=0; $i < $jmlAspek; $i++) { 
					if ($i > 0) {
						$where .="','";
					}
					$where .= $aspek[$i];
				}
				$whereCustom .= " (header in ('".$where."') OR id in ('".$where."'))"; 
			}
			if($akses == 1 || $akses == 2){

				$this->db->select('*');
				$this->db->where_in('tahun', array($thn,'ALL'));
				$this->db->where('level<', 3);
				$this->db->where($whereCustom);
				
				$this->db->from('view_afs_pemda');
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get();
				$result = $query->result_array();
			
			}
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($row['level'] <= 1) {
					if($i<>0){
						$html .= "</optgroup>";
					}
					$html .='<optgroup label="'.$row['text'].'" style="font-weight:bold;">';
				}else{
					$html .='<option value="'.$row['id'].'">&#186; '.$row['text'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		public function get_sasaran_lhp($aspek,$fokus)
		{
			$thn = $this->session->userdata('year_selected');
			$akses = $this->session->userdata('is_admin');
			$jmlFokus = count($fokus);
			$where ='';
			$whereCustom ='';
			if ($jmlFokus>0) {
				for ($i=0; $i < $jmlFokus; $i++) { 
					if ($i > 0) {
						$where .="','";
					}
					$where .= $fokus[$i];
				}
				$whereCustom .= " (header in ('".$where."') OR id in ('".$where."'))"; 
			}
			if($akses == 1 || $akses == 2){

				$this->db->select('*');
				$this->db->where_in('tahun', array($thn,'ALL'));
				$this->db->where('level<', 4);
				$this->db->where($whereCustom);
				$this->db->from('view_afs_pemda');
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get();

				$result = $query->result_array();
			
			}
			$html = '';
			$html .='<option value=""></option>';
			$i = 0;
			foreach($result as $row){
				if ($row['level'] <= 2) {
					if($i<>0){
						$html .= "</optgroup>";
					}
					$html .='<optgroup label="'.$row['text'].'" style="font-weight:bold;">';
				}else{
					$html .='<option value="'.$row['id'].'">&#187; '.$row['text'].'</option>';	
				}
				$i++;
			}
			return $html;
		}

		public function listAfs($aspek,$fokus,$sasaran)
		{
			$was =  array(1,2);
			$jmlAspek = count($aspek);
			$jmlFokus = count($fokus);
			$jmlSasaran = count($sasaran);
			$where = array(0=>1,1=>2);
			if ($jmlAspek>0) {
				for ($i=0; $i < $jmlAspek; $i++) { 
					$where[] = $aspek[$i];
				}
			}
			if ($jmlFokus>0) {
				for ($i=0; $i < $jmlFokus; $i++) { 
					$where[] = $fokus[$i];
				}
			}
			if ($jmlSasaran>0) {
				for ($i=0; $i < $jmlSasaran; $i++) { 
					$where[] = $sasaran[$i];
				}
			}
			
			
			$thn = $this->session->userdata('year_selected');
			$akses = $this->session->userdata('is_admin');
			if($akses == 1 || $akses == 2){

				$this->db->select('*');
				$this->db->where_in('tahun', array($thn,'ALL'));
				$this->db->where_in('id', $where);
				$this->db->from('view_afs_pemda');
				$this->db->order_by('id', 'ASC');
				$query = $this->db->get();
				$result = $query->result_array();
			
			}
			$html = '';
			$html .='<ul class="list-group">';
			$i = 0;
			foreach($result as $row){
				if ($row['level']==0) {
					$html.='<li class="list-group-item"><b>'.$row["text"].'</b></li>';
				}elseif ($row['level']==1) {
					$html.='<li class="list-group-item">&nbsp;&nbsp;&#149; '.$row["text"].'</li>';
				}elseif($row['level']==2){
					$html.='<li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&#186; '.$row["text"].'</li>';
				}else{
					$html.='<li class="list-group-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187; '.$row["text"].'</li>';
				}
			}
			$html .='</ul>';
			return $html;
		}

		public function getFokusKemendagri($fokus='',$tahun = 0)
		{
			$sql = "SELECT * from ms_afs_kemendagri where tahun = ".$tahun." and id_parameter = '".$fokus."' LIMIT 1;";
			$res = $this->db->query($sql)->row();
			return $res->nm_parameter;
		}

		function tgl_indo($tanggal){
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			
			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun
		 
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}

		function tgl_jam_indo($tanggal){
			 $bulan = array (
			        0 => '-',
			        'Januari',
			        'Februari',
			        'Maret',
			        'April',
			        'Mei',
			        'Juni',
			        'Juli',
			        'Agustus',
			        'September',
			        'Oktober',
			        'November',
			        'Desember'
			    );
			    $tgljam = explode(' ', $tanggal);
			    $pecahkan = explode('-', $tgljam[0]);
			    if($tanggal <> ''){
			        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' '  ;
			    }
			    else
			    {
			        return '';
			    }
		}

		function tgl_jam($tanggal){
			 $bulan = array (
			        0 => '-',
			        'Januari',
			        'Februari',
			        'Maret',
			        'April',
			        'Mei',
			        'Juni',
			        'Juli',
			        'Agustus',
			        'September',
			        'Oktober',
			        'November',
			        'Desember'
			    );
			    $tgljam = explode(' ', $tanggal);
			    $pecahkan = explode('-', $tgljam[0]);
			    if($tanggal <> ''){
			        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' ' .$tgljam[1] ;
			    }
			    else
			    {
			        return '';
			    }
		}

		function tes($value='')
		{
			echo "string";
		}

		function get_combo_prov2($apip)
		{
			$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
			$daerah = $this->db->query($sql)->row()->pemda;
			$sqlDaerah = "SELECT * FROM ms_daerah where id_daerah in (".$daerah.")";	
			$resCombo = $this->db->query($sqlDaerah)->result_array();
			return $resCombo;

		}

		 public function _mpdf($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
	// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         //   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
   			$stylesheet = file_get_contents("assets/css/mpdf.css");
			//$mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			$mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
			if($chalaman=='true'){
				 $mpdf->pdf->SetFooter(' Halaman {PAGENO}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			}
            
           // $mpdf->pdf->AddPage($orientasi)
			
		if ($halaman==0){
             $xhal=1;
         } else {       
             $xhal=$halaman;
         }
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->Output($filename,'I');
               
        }

        public function _mpdfPemda($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
	// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         //   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
   			$stylesheet = file_get_contents("assets/css/mpdf.css");
			$mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			// $mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
            
           // $mpdf->pdf->AddPage($orientasi)
			
		if ($halaman==0){
             $xhal=1;
         } else {       
             $xhal=$halaman;
         }
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($header);       

            $mpdf->pdf->AddPage('L','',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->Output($filename,'I');
               
        }

         public function _mpdfRisalah($judul,$header,$body,$table,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
			// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         	//   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
   			$stylesheet = file_get_contents("assets/css/mpdf.css");
			$mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			// $mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
			// if($chalaman=='true'){
			// 	 $mpdf->pdf->SetFooter(' Halaman {PAGENO}');				
			// }else{
			// 	$mpdf->pdf->SetFooter('');				
			// }
            
           // $mpdf->pdf->AddPage($orientasi)
			
			if ($halaman==0){
             $xhal=1;
         	} else {       
             $xhal=$halaman;
         	}
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->AddPage('L','',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            $mpdf->pdf->WriteHTML($table);         
            $mpdf->pdf->Output($filename,'I');
               
        }


        public function satker_bpk()
	    {
	 		$is_admin = $this->session->userdata('is_admin');
	 			$is_satker = $this->session->userdata('id_kab');
	 		if ($is_admin == 3) {
	 			$this->db->where(array('id_instansi'=>$is_satker));
	 		}
	 		$res = $this->db->get('ms_instansi_kemendagri');
	    	$sql = $res->result();
	    	return $sql;
	    }

	    public function satker_kemendagri()
	    {
	 		$is_admin = $this->session->userdata('is_admin');
	 		if ($is_admin == 3) {
	 			$is_satker = $this->session->userdata('id_kab');
	 			$this->db->where(array('id_instansi'=>$is_satker));
	 		}else if($is_admin == 2){
				$daerah = $this->session->userdata('id_kemendagri');
				$arrayDaerah = explode(', ',$daerah);
				$this->db->where_in('id_instansi',$arrayDaerah);
			}
			else if($is_admin == 6){
				$apip = $this->session->userdata('id_ins');
				$sql = "SELECT * FROM ms_inspektorat where id_inspektorat = ".$apip;	
				$daerah = $this->db->query($sql)->row()->kemendagri;
				$arrayDaerah = explode(',',$daerah); 
				$this->db->where_in('id_instansi',$arrayDaerah);
			}
	 		$res = $this->db->get('ms_instansi_kemendagri');
	    	$sql = $res->result();
	    	return $sql;
	    }

	    public function jenis_bentuk_pengawasan($jenis='')
	    {
	 		$is_admin = $this->session->userdata('is_admin');
	 		$tahun = $this->session->userdata('year_selected');
	 		$is_satker = $this->session->userdata('id_kab');

	 		$this->db->where(array('tahun'=>$tahun));
	 		$this->db->where(array('jenis'=>$jenis));
	 		$res = $this->db->get('ms_bentuk_pengawasan');
	    	$sql = $res->result();
	    	return $sql;
	    }

        public function _mpdf2($judul,$header,$body,$lMargin,$rMargin,$tMargin,$bMargin,$font,$orientasi,$halaman,$chalaman,$ckertas,$filename){
			
	// ini_set("memory_limit","-1");
            // $mpdf->showImageErrors = true;
            $this->load->library('M_pdf');
         //   $mpdf = new m_pdf('', 'Letter-L');
		    $mpdf = new m_pdf('', $ckertas);
            $pdfFilePath = $filename;
            $mpdf->pdf->SetTitle($filename);
            // $stylesheet = file_get_contents(base_url("assets/css/mpdfstyletables.css"));
			// $mpdf->pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
			// $mpdf->pdf->SetHTMLHeader($header);
			// $mpdf->pdf->SetHTMLHeader($headerEven, 'E');
			/* if($chalaman=='true'){
				 $mpdf->pdf->SetFooter('{PAGENO} / {nb}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			} */
			if($chalaman=='true'){
				 $mpdf->pdf->SetFooter(' Halaman {PAGENO}');				
			}else{
				$mpdf->pdf->SetFooter('');				
			}
            
           // $mpdf->pdf->AddPage($orientasi)
			
		if ($halaman==0){
             $xhal=1;
         } else {       
             $xhal=$halaman;
         }
		    
			
			$mpdf->pdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin,$tMargin,$bMargin);
            if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
            $mpdf->pdf->WriteHTML($body);         
            $mpdf->pdf->Output($filename,'I');
               
        }



 	/* function _mpdf($judul,$isi,$lMargin,$rMargin,$font,$orientasi,$halaman,$chalaman) {
   		
		ini_set("memory_limit","-1");
		ini_set("max_execution_time","600");

		$this->load->library('mpdf');

		$this->mpdf->defaultheaderfontsize = 6;	// in pts 
		$this->mpdf->defaultheaderfontstyle = BI;	// blank, B, I, or BI 
		$this->mpdf->defaultheaderline = 1; 	// 1 to include line below header/above footer 

		$this->mpdf->defaultfooterfontsize = 8;	// in pts 
		$this->mpdf->defaultfooterfontstyle = BI;	// blank, B, I, or BI 
		$this->mpdf->defaultfooterline = 0; 
		$this->mpdf->SetLeftMargin = $lMargin;
		$this->mpdf->SetRightMargin = $rMargin; 		 
	
 		if ($halaman==''){
             $xhal=1;
         } else {       
             $xhal=$halaman+1;
         }
		    
		if($halaman<>''){
			$this->mpdf->Setfooter('printed by SIMAKDA||Halaman {PAGENO}');
		}			
				 
 		$this->mpdf->AddPage($orientasi,'',$xhal,'','',$lMargin,$rMargin);
				
         if (!empty($judul)) $this->mpdf->writeHTML($judul);
         $this->mpdf->writeHTML($isi);         
         $this->mpdf->Output();
              
    
 } */


	function  tanggal_indonesia($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan  = substr($tgl,5,2);
		$tahun  =  substr($tgl,0,4);
		return  $tanggal.'-'.$bulan.'-'.$tahun;
	}


	function  tanggal_waktu_indonesia($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan  = substr($tgl,5,2);
		$tahun  =  substr($tgl,0,4);
		$jam	=  substr($tgl,11,8);
		return  $tanggal.'-'.$bulan.'-'.$tahun.' '.$jam.' (WIB)';
	}


	function getHariText($hari){
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}

	function  tanggal_balik($tgl){
		$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;
		}


        public function  tanggal_format_indonesia($tgl){
            $tanggal  =  substr($tgl,8,2);
            $bulan  = $this-> getBulan(substr($tgl,5,2));
            $tahun  =  substr($tgl,0,4);
            return  $tanggal.' '.$bulan.' '.$tahun;
        }

        public function  getBulan($bln){
            switch  ($bln){
            case  1:
            return  "Januari";
            break;
            case  2:
            return  "Februari";
            break;
            case  3:
            return  "Maret";
            break;
            case  4:
            return  "April";
            break;
            case  5:
            return  "Mei";
            break;
            case  6:
            return  "Juni";
            break;
            case  7:
            return  "Juli";
            break;
            case  8:
            return  "Agustus";
            break;
            case  9:
            return  "September";
            break;
            case  10:
            return  "Oktober";
            break;
            case  11:
            return  "November";
            break;
            case  12:
            return  "Desember";
            break;
            }
        }

        function frmDate($date,$code){
			$explode = explode("-",$date);
			$year  = $explode[0];
			(substr($explode[1],0,1)=="0")?$month=str_replace("0","",$explode[1]):$month=is_string($explode[1]);
			$dated = $explode[2];
			$explode_time = explode(" ",$dated);
			$dates = $explode_time[0];		
			
			switch($code){
				// Per Object
				case 4: $format = $dates; break;															// 01
				case 5: $format = $month; break;															// 01
				case 6: $format = $year; break;																// 2011
			}		
			return $format;
		}	
		function now($code=1){
			switch($code){
				case 1: $date = date("Y-m-d H:i:s"); break;
				case 2: $date = date("Y-m-d"); break;
				case 3: $date = date("H:i:s"); break;
			}
			return $date;
		}
		function nmonth($month){
			$thn_kabisat = date("Y") % 4;
			($thn_kabisat==0)?$feb=29:$feb=28;
			$init_month = array(1=>31,	// Januari [current]
								2=>$feb,	// Feb
								3=>31,	// Mar
								4=>30,	// Apr
								5=>31,	// Mei
								6=>30,	// Juni
								7=>31,	// Juli
								8=>31,	// Aug
								9=>30,	// Sep
								10=>31,	// Oct	
								11=>30,	// Nov
								12=>31);// Des
			$nmonth = $init_month[$month];
			return $nmonth;
		}
		function dateRange($start,$end){
			$xdate	=$this->frmDate($start,4);
			$ydate	=$this->frmDate($end,4);
			$xmonth	=$this->frmDate($start,5);
			$ymonth	=$this->frmDate($end,5);
			$xyear	=$this->frmDate($start,6);
			$yyear	=$this->frmDate($end,6);
			if($xyear==$yyear){
				if($xmonth==$ymonth){
					$nday=$ydate+1-$xdate;
				} else {
					$r2=NULL;
					$nmonth = $ymonth-$xmonth;			
					$r1 = $this->nmonth($xmonth)-$xdate+1;
					for($i=$xmonth+1;$i<$ymonth;$i++){
						$r2 = $r2+$this->nmonth($i);
					}
					$r3 = $ydate;
					$nday = $r1+$r2+$r3;
				}
			} else {
				// Last Year
				//get_nDay
				$r2=NULL; $r3=NULL;
				$r1=$this->nmonth($xmonth)-$xdate+1;
				//get_nMonth
				for($i=$xmonth+1;$i<13;$i++){
					$r2 = $r2+$this->nmonth($i);
				}
				// Current Year
				for($i=1;$i<$ymonth;$i++){
					$r3 = $r3+$this->nmonth($i);
				}
				$r4 = $ydate;
				$nday = $r1+$r2+$r3+$r4;
			}			
			return $nday." Hari";
		}
	
	function deadline($date){
			$now = $this->now();
			$yDate = $this->frmDate($date,6);
			$mDate = $this->frmDate($date,5);
			$dDate = $this->frmDate($date,4);
			$yNow = $this->frmDate($now,6);
			$mNow = $this->frmDate($now,5);
			$dNow = $this->frmDate($now,4);
			$deadmsg = "Telah lewat";
			// cek tahun
			if($yDate>$yNow){
				return $this->dateRange($now,$date);
			} elseif($yDate==$yNow){
				// cek bulan
				if($mDate>$mNow){
					return $this->dateRange($now,$date);
				} elseif($mDate==$mNow){
					// cek hari
					if($dDate>=$dNow){
						return $this->dateRange($now,$date);
					} else {
						return $deadmsg;
					}
				} else {
					return $deadmsg;
				}
			} else {
				return $deadmsg;
			}
		}	
		
		

	}

?>