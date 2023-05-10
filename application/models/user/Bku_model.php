<?php
	class Bku_model extends CI_Model{

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

	public function get_nama_pegawai($id){
		$this->db->from("ci_pegawai");
		$this->db->where("kd_pegawai",$id);
		   return $result = $this->db->get()->row_array();
	}

public function get_bku($id,$tahun,$bulan){
			
			
				$this->db->select("*");
				$this->db->from("get_bku");
				$this->db->where("kd_area", $id);
			
			if($bulan==0){
				$this->db->where("year(tgl_cair)", $tahun);
			}else{
				$this->db->where("year(tgl_cair)", $tahun);
				$this->db->where("month(tgl_cair)", $bulan);
			}
			$query=$this->db->get();
			return $query->result_array();
		}


		public function get_kas_rekening($id,$tahun,$bulan){
			$this->db->select("*");
			if($id=='1010102'){
				$this->db->from("cetakan_kas_rekening_kasbesar");
			}else{
				$this->db->from("cetakan_kas_rekening");
				$this->db->where("no_rekening", $id);
			}
			
			
		
		if($bulan==0 && $tahun=='2022'){
			$this->db->where("year(tanggal)>=", $tahun);
			$this->db->where("urut <>", 0);
		}else{
			//$this->db->where("year(tanggal)>=", $tahun);
			//$this->db->where("month(tanggal)", $bulan);
			
			$this->db->where("year(tanggal)=", $tahun);
		    $this->db->where("month(tanggal)=", $bulan);
			
		}
		//	$this->db->where("urut <>", 0);
			$query=$this->db->get();
		return $query->result_array();
	}


	public function get_kas_rekening_area($id,$tahun,$bulan){
		$this->db->select("*");
		$this->db->from("cetakan_kas_pegawai");
		$this->db->where("kd_pegawai", $id);
	
	if($bulan==0){
		$this->db->where("year(tanggal)>=", $tahun);
		$this->db->where("urut <>", 0);
	}else{
		
		//$this->db->where("year(tanggal)>=", $tahun);
		//$this->db->where("month(tanggal)", $bulan);
	
		/* $hari='31';
		$bulan=str_pad($bulan,2,"0",STR_PAD_LEFT);
		$ctanggal=$tahun.'-'.$bulan.'-'.$hari; 					
		$this->db->where("tanggal  ", $ctanggal); */
	
		$this->db->where("year(tanggal)=", $tahun);
		$this->db->where("month(tanggal)=", $bulan);
		
	}
	//	$this->db->where("urut <>", 0);
		$query=$this->db->get();
	return $query->result_array();
}

	public function saldo_awal($id,$tahun,$bulan){
			$this->db->select("ifnull(sum(terima),0)-ifnull(sum(keluar),0) as saldo");
			
			
			if($id=='1010102'){
				$this->db->from("cetakan_kas_rekening_kasbesar");
			}else{
				$this->db->from("cetakan_kas_rekening");
				$this->db->where("no_rekening",$id);
			}
			
			
		
		if($bulan==0 && $tahun=='2022'){
			$this->db->where("tanggal ", $tahun.'-01-31');
		}else{
			//$this->db->where("year(tanggal)>=", $tahun);
			//$this->db->where("month(tanggal) < ", $bulan);
						
			$hari='01';
			$bulan=str_pad($bulan,2,"0",STR_PAD_LEFT);
			$ctanggal=$tahun.'-'.$bulan.'-'.$hari; 			
			$this->db->where("tanggal < ", $ctanggal); 		
			// $this->db->where("urut <> ", 7); 
		} 
		   return $result = $this->db->get()->row_array(); 
	}

	public function saldo_awal_area($id,$tahun,$bulan){
		$this->db->select("ifnull(sum(terima),0)-ifnull(sum(keluar),0) as saldo");
		$this->db->from("cetakan_kas_pegawai");
		$this->db->where("kd_pegawai",$id);
	
	if($bulan==0){
		$this->db->where("tanggal ", '2022-01-31');
	}else{
		$hari='01';
		$bulan=str_pad($bulan,2,"0",STR_PAD_LEFT);
		$ctanggal=$tahun.'-'.$bulan.'-'.$hari; 					//print_r($ctanggal);die();
		$this->db->where("tanggal < ", $ctanggal);
		/* $this->db->where("year(tanggal)>=", $tahun);
		$this->db->where("month(tanggal) < ", $bulan); */
		$this->db->where("urut <> ", 8);
	}
	   return $result = $this->db->get()->row_array();
}

	function get_rekening_kas()
	{	
		$rekening = array('1010102','1010301','1010302','1010303','1010304','1010305','1010306','1010307','1010308','1010309','1010310');
			$this->db->select('no_acc as kode, nm_acc as nama');
			$this->db->from('ci_coa');
			$this->db->where_in('no_acc',$rekening);
		$query=$this->db->get();
		return $query->result_array();
	}


	function get_pegawai()
	{	
			$this->db->select('kd_pegawai as kode, nama as nama');
			$this->db->from('ci_pegawai');
			$this->db->where_in('pemegang_kas',1);
		$query=$this->db->get();
		return $query->result_array();
	}


	}

?>