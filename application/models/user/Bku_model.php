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


	}

?>