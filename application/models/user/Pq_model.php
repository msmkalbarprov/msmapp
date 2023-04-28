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
		$this->db->where('no_acc in ("5010201","5010202","5010203","5010204","5010206","5010205","5010502")');	
		$query=$this->db->get();
		return $query->result_array();
	}


function get_sisapqproyek($id)
	{
		$query = $this->db->get_where('hitung_sisa_pqproyek', array('id_pqproyek' => $id));
		return $query;
	}

function get_area_by_pqprojectid($id)
	{
		$query = $this->db->get_where('ci_pendapatan', array('id_pqproyek' => $id));
		return $query;
	}


	public function get_item_pq_by_id($id){
			 $this->db->select('*');
			 $this->db->from("ci_pq_operasional");
             $this->db->where('id_pq_operasional', $id);
		return $result = $this->db->get()->row_array();
	}


	function get_item_operasioanl()
	{	
		$akun = array('503','504');
		$this->db->from('ci_coa');
		$this->db->where('level','3');
		$this->db->where_in('left(no_acc,3)',$akun);
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_realisasi_spj($id, $no_acc)
	{	
	
			$this->db->select("ifnull(sum(nilai),0) as total");
			$this->db->from('get_realisasi_spj_kantor');
			$this->db->where('kd_pqproyek', $id);
			$this->db->where('left(no_acc,5)', substr($no_acc,0,5));
		
			$query=$this->db->get();
			return $query;
	}

	function get_realisasi_pq($id, $no_acc)
	{		
			$tahun=$this->session->userdata('tahun');
			$this->db->select("ifnull(sum(total),0) as total");
			$this->db->from('ci_pq_operasional');
			$this->db->where('kd_area', $id);
			$this->db->where('left(kd_pq_operasional,4)', $tahun);
			$this->db->where('left(kd_item,5)', substr($no_acc,0,5));
		
			$query=$this->db->get();
			return $query;
	}


	public function get_pq_operasional($id){
			
			$tahun=$this->session->userdata('tahun');
			$kd_area= $id;
				if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('kd_area',$kd_area);
				}else{
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('kd_area',$this->session->userdata('kd_area'));
				}
                return $this->db->get()->result_array();
		}
		public function get_pq_operasional2($id){
			$tahun=$this->session->userdata('tahun');
			
			$kd_area= $id;
				if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('kd_area',substr($kd_area,4,2));
				}else{
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('kd_area',$this->session->userdata('kd_area'));
				}
                return $this->db->get()->result_array();
		}

public function get_pq_hpp_rinci($pqproyek){
					$this->db->select('*');
					$this->db->from("ci_hpp");
					$this->db->where('id_pqproyek',$pqproyek);
                return $this->db->get()->result_array();
		}


public function get_pq_operasional_view($id){
			//$tahun = date("Y");
			$tahun=$this->session->userdata('tahun');
			
				if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('left(id_pq_operasional,8)',$id);
				}else{
					$this->db->select('*');
					$this->db->from("ci_pq_operasional");
					$this->db->where('left(kd_pq_operasional,4)',$tahun);
					$this->db->where('left(id_pq_operasional,8)',$id);
					$this->db->where('kd_area',$this->session->userdata('kd_area'));
				}
                return $this->db->get()->result_array();
		}

	

		public function add_pq($data){
			$this->db->insert('ci_pendapatan', $data);
			return true;
		}

		public function add_proyek_rincian($data){
			$this->db->insert('ci_proyek_rincian', $data);
			return true;
		}

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_pq(){
			$tahun = $this->session->userdata('tahun');
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
				$this->db->select('*,(select nilai from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as spk,(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as hpp,(select nama from ci_jnspagu where id=ci_pendapatan.jns_pagu) as pagu,(select nm_area from ci_area where kd_area=ci_pendapatan.kd_area)as area');
				$this->db->from("ci_pendapatan");
				$this->db->Join('ci_proyek','ci_pendapatan.id_proyek=ci_proyek.kd_proyek', 'inner');
				$this->db->where('ci_proyek.batal',0);
				$this->db->where('ci_proyek.thn_anggaran',$tahun);
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*,(select nilai from ci_proyek_rincian where ci_proyek_rincian.id_proyek=ci_proyek.id_proyek order by id desc LIMIT 1)as spk,(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as hpp,(select nama from ci_jnspagu where id=ci_pendapatan.jns_pagu) as pagu,(select nm_area from ci_area where kd_area=ci_pendapatan.kd_area)as area');
				$this->db->from("ci_pendapatan");
				$this->db->Join('ci_proyek','ci_pendapatan.id_proyek=ci_proyek.kd_proyek', 'inner');
				$this->db->where('ci_proyek.batal',0);
				$this->db->where('ci_pendapatan.kd_area',$this->session->userdata('kd_area'));
				$this->db->where('ci_proyek.thn_anggaran',$tahun);
        		return $this->db->get()->result_array();
			}
		}


		public function get_all_pq_op(){
			$tahun = $this->session->userdata('tahun');
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
				$this->db->select('*');
				$this->db->from("v_ci_pq_operasional");
				$this->db->where("left(kode,4)",$tahun);
				$this->db->group_by("left(kode,10)");

        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*');
				$this->db->from("v_ci_pq_operasional");
				$this->db->where('kd_area',$this->session->userdata('kd_area'));
				$this->db->where("left(kode,4)",$tahun);
				$this->db->group_by("left(kode,10)");
        		return $this->db->get()->result_array();
			}
		}


		public function get_all_pq_hpp(){
			if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
				$this->db->select('*,
					(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as nilai_hpp,
					(select nm_area from ci_area where ci_area.kd_area=ci_pendapatan.kd_area)as nm_area
					');
				$this->db->from("ci_pendapatan");
        		return $this->db->get()->result_array();
			}
			else{
				$this->db->select('*,
					(select sum(total) from ci_hpp where ci_hpp.kd_pqproyek=ci_pendapatan.kd_pqproyek)as nilai_hpp,
					(select nm_area from ci_area where ci_area.kd_area=ci_pendapatan.kd_area)as nm_area
					');
				$this->db->from("ci_pendapatan");
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


	function get_proyek_by_area_subarea($subarea,$area)
	{	
			$tahun = $this->session->userdata('tahun');
			$query1 = $this->db->query("SELECT id_proyek from ci_pendapatan where left(id_proyek,4)='".$tahun."'");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->id_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');
			$this->db->where('thn_anggaran >=',date("Y")-1);	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where('left(kd_proyek,4)',$tahun);
			$this->db->where_not_in('kd_proyek', $kd_proyek);
		}else{
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');	
			$this->db->where('thn_anggaran >=',date("Y")-1);	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where('left(kd_proyek,4)',$tahun);
			$this->db->where_not_in('kd_proyek', $kd_proyek);
		}
		
		$query=$this->db->get();
		return $query;
	}


	function get_proyek_by_area_subarea_edit($subarea,$area,$id_pqproyek)
	{	

			$query1 = $this->db->query("SELECT id_proyek from ci_pendapatan");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->id_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

		if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');
			$this->db->where('thn_anggaran >=',date("Y"));	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where_in('kd_proyek', $kd_proyek);
			$this->db->where('kd_proyek', $id_pqproyek);
		}else{
			$this->db->from('v_get_proyek_pq');
			$this->db->where('jns_pagu >','1');	
			$this->db->where('thn_anggaran >=',date("Y"));	
			$this->db->where('kd_area =',$area);	
			$this->db->where('kd_sub_area =',$subarea);
			$this->db->where_in('kd_proyek', $kd_proyek);
			$this->db->where('kd_proyek', $id_pqproyek);
		}
		
		$query=$this->db->get();
		return $query;
	}


	function get_subarea($area)
	{
		$query = $this->db->get_where('ci_subarea', array('kd_area' => $area));
		return $query;
	}

		//---------------------------------------------------
		// Get user detial by ID
	public function get_pq_by_id($id){
				$stts_batal = array('0', null, '');
				 $this->db->select('ci_pendapatan.*,(select sum(total) from ci_hpp where ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek)as hpp');
				 $this->db->from("ci_pendapatan");
				 $this->db->join("ci_proyek","ci_pendapatan.id_proyek=ci_proyek.kd_proyek",'inner');
                 $this->db->where('ci_pendapatan.id_pqproyek', $id);
				 $this->db->where_in('ci_proyek.batal', $stts_batal);
			return $result = $this->db->get()->row_array();
		}





	public function get_pencairan_by_id($id){
				 $this->db->select("id_pqproyek, ifnull((SELECT sum(nilai) from ci_proyek_cair_potongan where  `ci_proyek_cair_potongan`.`id_proyek`=`ci_pendapatan`.`kd_proyek` and ci_proyek_cair_potongan.kd_acc='5041405'),0)as ppn,
				 ifnull((SELECT sum(nilai) from ci_proyek_cair_potongan where  `ci_proyek_cair_potongan`.`id_proyek`=`ci_pendapatan`.`kd_proyek` and ci_proyek_cair_potongan.kd_acc in ('5041401', '5041402', '5041403')),0)as pph,
				 ifnull((SELECT sum(nilai) from ci_proyek_cair_potongan where  `ci_proyek_cair_potongan`.`id_proyek`=`ci_pendapatan`.`kd_proyek` and ci_proyek_cair_potongan.kd_acc = '5041407'),0)as infaq,
				 ifnull((SELECT sum(nilai_bruto) from `ci_proyek_cair` where `ci_pendapatan`.`id_proyek`=`ci_proyek_cair`.`kd_proyek` ) 
				 - (SELECT sum(nilai) from ci_proyek_cair_potongan where  `ci_proyek_cair_potongan`.`id_proyek`=`ci_pendapatan`.`kd_proyek`),0)as netto");
				 $this->db->from("ci_pendapatan");
                 $this->db->where('id_pqproyek', $id);
                 $this->db->group_by('id_pqproyek');
			return $result = $this->db->get()->row_array();
		}
		
		
		public function get_pencairan_by_idtahun($id,$tahun){
			/* $query = $this->db->select("
					ifnull(sum( case when ci_proyek_cair_potongan.kd_acc='5041405' then ci_proyek_cair_potongan.nilai else 0 end),0) as ppn,
					ifnull(sum( case when ci_proyek_cair_potongan.kd_acc in ('5041401','5041402','5041403') then ci_proyek_cair_potongan.nilai else 0 end),0) as pph,
					ifnull(sum( case when ci_proyek_cair_potongan.kd_acc='5041407' then ci_proyek_cair_potongan.nilai else 0 end),0) as infaq,
				 	ifnull(sum(ci_proyek_cair.nilai_bruto)-sum(ci_proyek_cair_potongan.nilai),0) as netto");
				 $this->db->from("ci_pendapatan");
				 $this->db->join("ci_proyek","ci_proyek.kd_proyek=ci_pendapatan.id_proyek","inner");
				 $this->db->join("ci_proyek_cair","ci_pendapatan.id_proyek=ci_proyek_cair.kd_proyek","left");
				 $this->db->join("ci_proyek_cair_potongan","ci_proyek_cair_potongan.id_proyek=ci_pendapatan.kd_proyek","left");
                 $this->db->where('ci_proyek.thn_anggaran', $tahun);
				 	$this->db->group_start();
				 		$this->db->where('batal', null);
					 	$this->db->or_where('batal', 0);
					 $this->db->group_end();
                 $this->db->where('ci_pendapatan.kd_area', $id);;
                 $this->db->group_by('ci_pendapatan.kd_area');
				 				 
			return $result = $this->db->get()->row_array();
			 */

			 
			 
			$query=$this->db->query("select sum(ppn)ppn,sum(pph)pph,sum(infaq)infaq,sum(netto)netto from(select
					ifnull(sum( case when ci_proyek_cair_potongan.kd_acc='5041405' then ci_proyek_cair_potongan.nilai else 0 end),0) as ppn,
					ifnull(sum( case when ci_proyek_cair_potongan.kd_acc in ('5041401','5041402','5041403') then ci_proyek_cair_potongan.nilai else 0 end),0) as pph,
					ifnull(sum( case when ci_proyek_cair_potongan.kd_acc='5041407' then ci_proyek_cair_potongan.nilai else 0 end),0) as infaq,
				 	ifnull(sum(ci_proyek_cair.nilai_bruto)-sum(ci_proyek_cair_potongan.nilai),0) as netto
					from ci_pendapatan
					inner join ci_proyek on ci_proyek.kd_proyek=ci_pendapatan.id_proyek
					left join ci_proyek_cair on ci_pendapatan.id_proyek=ci_proyek_cair.kd_proyek
					left join ci_proyek_cair_potongan on ci_proyek_cair_potongan.id_proyek=ci_pendapatan.kd_proyek and ci_proyek_cair.nomor=ci_proyek_cair_potongan.nomor
					where ci_proyek.thn_anggaran=$tahun
					and (batal=null|| batal=0)
					and ci_pendapatan.kd_area='$id'
					group by ci_pendapatan.kd_area
					UNION all
					SELECT 0 ppn,0 pph,0 infaq,0 netto FROM ci_saldo_awal LIMIT 1)z");
					
			return $result = $query->row_array();
			
		
		}

	public function get_titip_pl_by_id($id){
				 $this->db->select("ci_coa.no_acc,ci_coa.nm_acc,
				 	(select ifnull(sum(nilai),0) from ci_pdo where ci_coa.no_acc=ci_pdo.no_acc and replace(ci_pdo.kd_pqproyek,'/','') = '$id' and status_bayar=1 ) as nilai,
					 (select ifnull(sum(nilai),0) from ci_spj_pegawai where ci_coa.no_acc=ci_spj_pegawai.no_acc and concat('PQ',REPLACE(ci_spj_pegawai.kd_proyek,'/','')) = '$id' )+
					 (select ifnull(sum(nilai),0) from ci_spj_kantor where ci_coa.no_acc=ci_spj_kantor.no_acc and REPLACE(ci_spj_kantor.kd_pqproyek,'/','') = '$id' )+
					 (select ifnull(sum(nilai),0) from ci_spj where ci_coa.no_acc=ci_spj.no_acc and replace(ci_spj.kd_pq_proyek,'/','') = '$id' ) 
					 as nilai_spj");
				 $this->db->from("ci_coa");
                 $this->db->where("ci_coa.no_acc in ('5020101','5020501')");
                 $this->db->order_by("ci_coa.no_acc", "DESC");
				$query=$this->db->get();
			return $query->result_array();
		}

	public function get_titip_pl_by_idtahun($id, $tahun){

		$tahun=$this->session->userdata('tahun');
		$tahun_depan=$tahun+1;
		$tgl_awal = $tahun.'-02-01';
		$tgl_akhir = $tahun_depan.'-02-01';

				 $this->db->select("ci_coa.no_acc,ci_coa.nm_acc,
				 		(select ifnull(sum(nilai),0) from ci_pdo where ci_coa.no_acc=ci_pdo.no_acc and kd_area = '$id' and left(kd_project,4)='$tahun' AND status_bayar=1) as nilai,
					 	(select ifnull(sum(nilai),0) from ci_spj_pegawai where ci_coa.no_acc=ci_spj_pegawai.no_acc and kd_area = '$id' and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' )+
						 (select ifnull(sum(nilai),0) from ci_spj_kantor where ci_coa.no_acc=ci_spj_kantor.no_acc and kd_area = '$id' and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' )+
						 (select ifnull(sum(nilai),0) from ci_spj where ci_coa.no_acc=ci_spj.no_acc and kd_area = '$id' and tgl_spj >='$tgl_awal' and tgl_spj <'$tgl_akhir' ) as nilai_spj");
				 $this->db->from("ci_coa");
                 $this->db->where("ci_coa.no_acc in ('5020101','5020501')");
                 $this->db->order_by("ci_coa.no_acc", "DESC");
				$query=$this->db->get();
			return $query->result_array();
		}

		public function get_operasional_header($id,$tahun){
				 $this->db->select('kd_area,(select nm_area from ci_area where ci_area.kd_area=ci_pq_operasional.kd_area)as nm_area, left(kd_pq_operasional,10)as kode');
				 $this->db->from("ci_pq_operasional");
                 $this->db->where('kd_area', $id);
                 $this->db->where('left(kd_pq_operasional,4)',$tahun);
                 $this->db->group_by('kd_pq_operasional');
			return $result = $this->db->get()->row_array();
		}


	public function get_header_pq_pdo($id){
			$this->db->select('kd_area,nm_area');
			$this->db->from("ci_area");
			$this->db->where('kd_area', $id);
	   return $result = $this->db->get()->row_array();
   }

	public function get_rincian_proyek_by_id($id){
				 $this->db->select('*');
				 $this->db->from("ci_proyek_rincian");
                 $this->db->where('id', $id);
			return $result = $this->db->get()->row_array();
		}

	public function get_proyek_by_id($id){
			$this->db->from('v_get_proyek_pq');
			$this->db->where('replace(kd_proyek,"/","")',$id);
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


	public function get_detail_hpp_by_id($id){
		$query = $this->db->get_where('ci_hpp', array('id' =>  $id));
		return $query;
	}


	public function save_pq_proyek_operasional($data){
				$insert_data['id_pq_operasional'] 			= str_replace("/","",date("Y").$data['kd_area'].'98'.$data['kd_item']);
				$insert_data['kd_pq_operasional'] 			= date("Y").'/'.$data['kd_area'].'/98/'.$data['kd_item'];
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


public function save_pq_hpp($data){
				$insert_data['id_pqproyek']					= $data['id_pqproyek'];
				$insert_data['kd_area'] 					= $data['kd_area'];
				$insert_data['kd_item']						= $data['kd_item'];
				$insert_data['jenis_tk']					= $data['jenis_tk'];
				$insert_data['keterangan'] 					= $data['keterangan'];
				$insert_data['volume'] 						= $data['volume'];
				$insert_data['satuan'] 						= $data['satuan'];
				$insert_data['harga']						= $data['harga'];
				$insert_data['periode']						= $data['periode'];
				$insert_data['total']						= $data['total'];
				$insert_data['username']					= $this->session->userdata('username');
				$insert_data['created_at']					= date("Y-m-d h:i:s");
				$query = $this->db->insert('ci_hpp', $insert_data);
		}

// UPDATE nilai PQ dari tambah atau edit Pagu
public function update_nilai_PQ($data2, $idPQproyekedit){
	$this->db->where('id_pqproyek', $idPQproyekedit);
	$this->db->update('ci_pendapatan', $data2);
	return true;
}

		//---------------------------------------------------
		// Edit user Record


public function edit_pq($data, $id){

	$this->db->where('id_pqproyek', $id);
	$this->db->update('ci_pendapatan', $data);
	return true;
}

public function save_pqngesahan_pq($data, $id_pqproyek){
	$this->db->where('id_pqproyek', $id_pqproyek);
	$this->db->update('ci_pendapatan', $data);
	return true;
}

public function edit_pq_item($data, $id){
	$this->db->where('id_pq_operasional', $id);
	$this->db->update('ci_pq_operasional', $data);
	return true;
}

public function edit_hpp_item($data, $id, $idpqproyek){
	$this->db->where('id', $id);
	$this->db->where('id_pqproyek', $idpqproyek);
	$this->db->update('ci_hpp', $data);
	return true;
}

public function ajukan_revisi($data, $id){
	$this->db->where('id_pqproyek', $id);
	$this->db->update('ci_pendapatan', $data);
	return true;
}

//---------------------------------------------------
// Change user status
//-----------------------------------------------------
function change_status()
{		
	$this->db->set('status', $this->input->post('status'));
	$this->db->set('updated_status_at', date("Y-m-d h:i:s"));
	$this->db->where('id_pq_operasional', $this->input->post('id'));
	$this->db->update('ci_pq_operasional');
}


	// PQ
function get_pqproyek()
{	
	if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Marketing' || $this->session->userdata('admin_role')=='Admin'){
		$this->db->from('ci_pendapatan');
	}else{
		$userarea = $this->session->userdata('kd_area');
		$this->db->from('ci_pendapatan');
		$this->db->where('kd_area',$userarea);	
	}
	
	$query=$this->db->get();
	return $query->result_array();
}

function get_pqproyek_by_id($idpqproyek)
	{	
		$this->db->from('ci_pendapatan');
		$this->db->where('id_pqproyek',$idpqproyek);	
		$query=$this->db->get();
		return $query->result_array();
	}

function get_pqproyek_by($area)
	{
		$query = $this->db->get_where('ci_pendapatan', array('kd_area' => $area));
		return $query;
	}

function get_hpp_by_id($id='',$idpqproyek=''){
			 $this->db->select('*');
			 $this->db->from("ci_hpp");
             $this->db->where('id', $id);
             $this->db->where('id_pqproyek', $idpqproyek);
		return $result = $this->db->get()->row_array();
	}

public function get_cetak_hpp_by_id($id){
			$this->db->select("no_acc as kd_item,(select keterangan from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id' order by keterangan desc limit 1)as keterangan, (select sum(total) from ci_hpp where ci_hpp.kd_item=ci_coa_msm.no_acc and id_pqproyek='$id')as nilai_hpp");
			$this->db->from("ci_coa_msm");
			$this->db->where("no_acc in ('5010201','5010202','5010203','5010204','5010206','5010205')");
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_cetak_hpp_pq_pdo_by_id($id){
			$this->db->select("kd_item, nama_map,jenis as keterangan, 
								case 
									when kd_item='5010202' then 
								(select sum(total) from ci_hpp where ci_hpp.kd_item=map_pq_pdo_proyek.kd_item and id_pqproyek='$id' and jenis_tk=map_pq_pdo_proyek.jenis)
								else 
								(select sum(total) from ci_hpp where ci_hpp.kd_item=map_pq_pdo_proyek.kd_item and id_pqproyek='$id')
								end as nilai_hpp,
								case 
									when kd_item='5010202' then 
										(select sum(nilai) from ci_pdo where ci_pdo.no_acc=map_pq_pdo_proyek.kd_item and replace(kd_pqproyek,'/','')='$id' and jenis_tkl=map_pq_pdo_proyek.jenis and status_bayar='1') 
									else (select sum(nilai) from ci_pdo where ci_pdo.no_acc=map_pq_pdo_proyek.kd_item and replace(kd_pqproyek,'/','')='$id' and status_bayar='1') 
								end as pdo, 
								case 
									when kd_item='5010202' then 
										(select ifnull(sum(nilai),0) from ci_spj_pegawai left join ci_pegawai on ci_spj_pegawai.kd_pegawai=ci_pegawai.kd_pegawai where ci_spj_pegawai.no_acc=map_pq_pdo_proyek.kd_item and concat('PQ',REPLACE(ci_spj_pegawai.kd_proyek,'/',''))='$id' and jabatan=map_pq_pdo_proyek.jenis and status='1')+
										(select ifnull(sum(nilai),0) from ci_spj_kantor left join ci_pegawai on ci_spj_kantor.kd_pegawai=ci_pegawai.kd_pegawai where ci_spj_kantor.no_acc=map_pq_pdo_proyek.kd_item and REPLACE(ci_spj_kantor.kd_pqproyek,'/','')='$id' and jabatan=map_pq_pdo_proyek.jenis)+
										(select ifnull(sum(nilai),0) from ci_spj where ci_spj.no_acc=map_pq_pdo_proyek.kd_item and replace(ci_spj.kd_pq_proyek,'/','')='$id' and jns_tkl=map_pq_pdo_proyek.jenis)  
									
										else (select ifnull(sum(nilai),0) from ci_spj_pegawai where ci_spj_pegawai.no_acc=map_pq_pdo_proyek.kd_item and concat('PQ',REPLACE(ci_spj_pegawai.kd_proyek,'/',''))='$id' and status='1')+
											(select ifnull(sum(nilai),0) from ci_spj_kantor where ci_spj_kantor.no_acc=map_pq_pdo_proyek.kd_item and REPLACE(ci_spj_kantor.kd_pqproyek,'/','')='$id')+
											(select ifnull(sum(nilai),0) from ci_spj where ci_spj.no_acc=map_pq_pdo_proyek.kd_item and replace(ci_spj.kd_pq_proyek,'/','')='$id') 
								end as spj
							");
			$this->db->from("map_pq_pdo_proyek");
			$this->db->where("id between 16 and 26");
			$this->db->order_by("id");
			$query=$this->db->get();
			return $query->result_array();
		}
public function get_cetak_hpp_pq_pdo_by_idtahun($id, $tahun){
	$tahun=$this->session->userdata('tahun');
		$tahun_depan=$tahun+1;
		$tgl_awal = $tahun.'-02-01';
		$tgl_akhir = $tahun_depan.'-02-01';
		
			$this->db->select("kd_item, nama_map,jenis as keterangan, 
								case 
									when kd_item='5010202' then 
								(select sum(total) from ci_hpp where ci_hpp.kd_item=map_pq_pdo_proyek.kd_item and kd_area='$id' and substring(kd_pqproyek,4,4) and jenis_tk=map_pq_pdo_proyek.jenis and kd_pqproyek in (select kd_pqproyek from get_proyek_tidak_batal) )
								else 
								(select sum(total) from ci_hpp where ci_hpp.kd_item=map_pq_pdo_proyek.kd_item and kd_area='$id' and substring(kd_pqproyek,4,4) and kd_pqproyek in (select kd_pqproyek from get_proyek_tidak_batal))
								end as nilai_hpp,
								case 
									when kd_item='5010202' then 
										(select sum(nilai) from ci_pdo where ci_pdo.no_acc=map_pq_pdo_proyek.kd_item and kd_area='$id' and left(kd_project,4)='$tahun' and jenis_tkl=map_pq_pdo_proyek.jenis and status_bayar='1') 
									else (select sum(nilai) from ci_pdo where ci_pdo.no_acc=map_pq_pdo_proyek.kd_item and kd_area='$id' and left(kd_project,4)='$tahun' and status_bayar='1') 
								end as pdo,
								case 
									when kd_item='5010202' then 
										(select ifnull(sum(nilai),0) from ci_spj_pegawai left join ci_pegawai on ci_spj_pegawai.kd_pegawai=ci_pegawai.kd_pegawai where ci_spj_pegawai.no_acc=map_pq_pdo_proyek.kd_item and ci_spj_pegawai.kd_area='$id' and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and jabatan=map_pq_pdo_proyek.jenis and status='1')+
										(select ifnull(sum(nilai),0) from ci_spj_kantor left join ci_pegawai on ci_spj_kantor.kd_pegawai=ci_pegawai.kd_pegawai where ci_spj_kantor.no_acc=map_pq_pdo_proyek.kd_item and ci_spj_kantor.kd_area='$id' and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and jabatan=map_pq_pdo_proyek.jenis)+
										(select ifnull(sum(nilai),0) from ci_spj where ci_spj.no_acc=map_pq_pdo_proyek.kd_item and ci_spj.kd_area='$id' and tgl_spj >='$tgl_awal' and tgl_spj <'$tgl_akhir' and jns_tkl=map_pq_pdo_proyek.jenis)  
									
										else (select ifnull(sum(nilai),0) from ci_spj_pegawai where ci_spj_pegawai.no_acc=map_pq_pdo_proyek.kd_item and kd_area='$id' and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and status='1')+
											(select ifnull(sum(nilai),0) from ci_spj_kantor where ci_spj_kantor.no_acc=map_pq_pdo_proyek.kd_item and kd_area='$id' and  tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir')+
											(select ifnull(sum(nilai),0) from ci_spj where ci_spj.no_acc=map_pq_pdo_proyek.kd_item and kd_area='$id' and tgl_spj >='$tgl_awal' and tgl_spj <'$tgl_akhir') 
								end as spj
							");
			$this->db->from("map_pq_pdo_proyek");
			$this->db->where("id between 16 and 26");
			$this->db->order_by("id");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_operasional_by_id($id){
			$query="SELECT left(id_proyek,4) as tahun,kd_area from ci_pendapatan where id_pqproyek='$id'";
					 $hasil = $this->db->query($query);
					 $tahun = $hasil->row('tahun');
					 $area = $hasil->row('kd_area');

			// echo $tahun[0];

			$this->db->select("no_acc as kd_item,(select uraian from ci_pq_operasional where ci_pq_operasional.kd_item=ci_coa.no_acc and left(id_pq_operasional,4)='$tahun' and kd_area='$area' order by uraian desc limit 1)as keterangan, (select sum(total) from ci_pq_operasional where ci_pq_operasional.kd_item=ci_coa.no_acc and left(id_pq_operasional,4)='$tahun' and kd_area='$area')as nilai_op");
			$this->db->from("ci_coa");
			$this->db->where("level", '3');
			$this->db->where("left(no_acc,3)", '504');
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}
public function cetak_operasional_by_area($id,$tahun){
		
	$tahun=$this->session->userdata('tahun');
	$tahun_depan=$tahun+1;
	$tgl_awal = $tahun.'-02-01';
	$tgl_akhir = $tahun_depan.'-02-01';
			$this->db->select("no_acc as kd_item,(select uraian from ci_pq_operasional where ci_pq_operasional.kd_item=ci_coa.no_acc and left(id_pq_operasional,4)='$tahun' and kd_area='$id' order by uraian desc limit 1)as keterangan, 
				(select ifnull(sum(total),0) from ci_pq_operasional where ci_pq_operasional.kd_item=ci_coa.no_acc and left(id_pq_operasional,4)='$tahun' and kd_area='$id')as nilai_op,
				(select ifnull(sum(nilai),0) from ci_pdo where ci_pdo.no_acc=ci_coa.no_acc and left(kd_project,4)='$tahun' and substring(kd_project,6,2)='$id' and status_bayar=1)as nilai_pdo,
				
				(select ifnull(sum(nilai),0) from ci_spj_pegawai where left(ci_spj_pegawai.no_acc,5)=ci_coa.no_acc and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and kd_area='$id' and status=1)+
				(select ifnull(sum(nilai),0) from ci_spj_kantor where left(ci_spj_kantor.no_acc,5)=ci_coa.no_acc and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and kd_area='$id')+
				(select ifnull(sum(nilai),0) from ci_pengeluaran_lain where left(ci_pengeluaran_lain.no_acc,5)=ci_coa.no_acc and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and kd_area='$id')+
				(select ifnull(sum(nilai),0) from ci_spj where left(ci_spj.no_acc,5)=ci_coa.no_acc and tgl_spj >='$tgl_awal' and tgl_spj <'$tgl_akhir' and kd_area='$id')as nilai_spj
				");
			$this->db->from("ci_coa");
			$this->db->where("level", '3');
			$this->db->where("left(no_acc,3)", '504');
			$this->db->order_by("no_acc");
			$query=$this->db->get();
			return $query->result_array();
		}

public function cetak_marketing($id,$tahun,$filter,$filter2){
			ini_set('max_execution_time', -1);
			ini_set('memory_limit',-1);
			if ($id=='all'){
				$this->db->from("cetak_marketing");
				$this->db->where("thn_anggaran", $tahun);
				if ($filter=='subproyek'){
					$this->db->where("kd_sub_projek", $filter2);
				}else if($filter=='perusahaan'){
					$this->db->where("kd_perusahaan", $filter2);
				}
				$this->db->order_by("kd_area");
			}else if ($id=='allarea'){
				$this->db->from("cetak_marketing_all");
				$this->db->where("thn_anggaran", $tahun);
				$this->db->group_by("kd_area");
				$this->db->order_by("kd_area");
			}else{
				$this->db->from("cetak_marketing");
				$this->db->where("kd_area", $id);
				$this->db->where("thn_anggaran", $tahun);
				if ($filter=='subproyek'){
					$this->db->where("kd_sub_projek", $filter2);
				}else if($filter=='perusahaan'){
					$this->db->where("kd_perusahaan", $filter2);
				}
				$this->db->order_by("kd_area");
			}
			
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_marketing_by_id($id){

			$query="SELECT left(id_proyek,4) as tahun,kd_area from ci_pendapatan where id_pqproyek='$id'";
					 $hasil = $this->db->query($query);
					 $tahun = $hasil->row('tahun');
					 $area = $hasil->row('kd_area');

			$this->db->select("sum(total) as nilai_op");
			$this->db->from("ci_pq_operasional");
			$this->db->where("left(id_pq_operasional,4)", $tahun);
			$this->db->where("kd_area", $area);
			$this->db->where("left(kd_item,3)", '503');
			// $this->db->group_by("left(kd_item,3)");
			return $result = $this->db->get()->row_array();
		}

public function cetak_marketing_by_id($area,$tahun){

	$tahun=$this->session->userdata('tahun');
	$tahun_depan=$tahun+1;
	$tgl_awal = $tahun.'-02-01';
	$tgl_akhir = $tahun_depan.'-02-01';

			$this->db->select("sum(total) as nilai_op,
				(select ifnull(sum(nilai),0) from ci_pdo where left(ci_pdo.no_acc,3)='503' and left(kd_project,4)='$tahun' and substring(kd_project,6,2)='$area')as nilai_pdo,
				(select ifnull(sum(nilai),0) from ci_spj_pegawai where left(ci_spj_pegawai.no_acc,3)='503' and tgl_bukti >='$tgl_awal' and tgl_bukti <'$tgl_akhir' and kd_area='$area')as nilai_spj");
			$this->db->from("ci_pq_operasional");
			$this->db->where("left(id_pq_operasional,4)", $tahun);
			$this->db->where("kd_area", $area);
			$this->db->where("left(kd_item,3)", '503');
			// $this->db->group_by("left(kd_item,3)");
			return $result = $this->db->get()->row_array();
		}

public function get_pendapatanarea($id){

			$query="SELECT left(id_proyek,4) as tahun,kd_area from ci_pendapatan where id_pqproyek='$id'";
					 $hasil = $this->db->query($query);
					 $tahun = $hasil->row('tahun');
					 $area = $hasil->row('kd_area');

			$this->db->select("sum(pendapatan_nett) as pendapatannetarea");
			$this->db->from("ci_pendapatan");
			$this->db->where("left(id_proyek,4)", $tahun);
			$this->db->where("kd_area", $area);
			return $result = $this->db->get()->row_array();
		}

// cetak masal per area
public function get_proyek_by_area($kolom, $id, $tahun){
			$this->db->select($kolom);
			$this->db->from('v_get_proyek_pq2');
			$this->db->where('kd_area',$id);
			$this->db->where('thn_anggaran',$tahun);
			$this->db->where('batal',0);
			$this->db->order_by('kd_proyek');
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_area($tahun){
			$this->db->select('kd_area,nm_area');
			$this->db->from('ci_proyek');
			$this->db->where('thn_anggaran',$tahun);
			$this->db->order_by('kd_area');
			$this->db->group_by('kd_area');
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_map1(){
		$this->db->from('map_pq');
		// $this->db->where('urut',1);
		$query=$this->db->get();
		return $query->result_array();
	}

public function get_map2(){
		$this->db->from('map_pq_all');
		// $this->db->where('urut',1);
		$query=$this->db->get();
		return $query->result_array();
	}
public function get_pq_by_area($kolom,$id, $tahun, $proyek){

				
				$this->db->from("v_get_pq");
				$this->db->where('kd_area',$id);
				$this->db->where('left(id_proyek,4)',$tahun);
				$this->db->where('id_proyek',$proyek);
				$this->db->order_by('id_proyek');
			$query=$this->db->get();
		return $query->result_array();
		}
public function get_pq_by_idtahun($id, $tahun){
				 $this->db->select('ifnull(sum(ppn),0) as ppn,ifnull(sum(pph),0)as pph,ifnull(sum(pl),0)as pl,ifnull(sum(p_titipan),0) as titip,ifnull(sum(sub_total_a),0) as sub_total_a,
				 					ifnull(sum(infaq),0) as infaq,ifnull(sum(pendapatan_nett),0) as pendapatan_nett,
				 					ifnull((select sum(total) from ci_hpp where ci_hpp.id_pqproyek=v_pendapatan.id_pqproyek),0)as hpp');
				 $this->db->from("v_pendapatan");
                 $this->db->where('kd_area', $id);
                 $this->db->where('left(id_proyek,4)', $tahun);
			return $result = $this->db->get()->row_array();
		}

public function get_cetak_hpp_by_area($kd_item,$jenis_tk, $id, $proyek){

			$query1 = $this->db->query("SELECT kd_proyek from ci_proyek where kd_area='$id'");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->kd_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

			if ($kd_item=='5010202'){
				$this->db->select("id_proyek,
								'$jenis_tk' as jenis_tk, 
								(select keterangan from ci_hpp where ci_hpp.kd_item='$kd_item' and jenis_tk='$jenis_tk' and kd_area='$id' 
								and ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek
								order by keterangan desc limit 1)as keterangan,
								(select ifnull(sum(total),0) from ci_hpp where ci_hpp.kd_item='$kd_item' and kd_area='$id' and jenis_tk='$jenis_tk' and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			}else{
				$this->db->select("id_proyek,
								'' as jenis_tk, 
								(select keterangan from ci_hpp where ci_hpp.kd_item='$kd_item' and (jenis_tk='$jenis_tk' OR jenis_tk is null) and kd_area='$id' 
								and ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek
								order by keterangan desc limit 1)as keterangan,
								(select ifnull(sum(total),0) from ci_hpp where ci_hpp.kd_item='$kd_item' and kd_area='$id' and (jenis_tk='$jenis_tk' OR jenis_tk is null) and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			}

			
			$this->db->from("ci_pendapatan");
			$this->db->where("id_proyek", $proyek);
			$this->db->where_in('id_proyek', $kd_proyek);
			$this->db->order_by("id_pqproyek");
			$query=$this->db->get();
			return $query->result_array();
		}

public function get_total_hpp_by_projek($id, $proyek){

			$query1 = $this->db->query("SELECT kd_proyek from ci_proyek where kd_area='$id'");
			$query1_result = $query1->result();
			$proyek_id= array();
			foreach($query1_result as $row){
				$proyek_id[] = $row->kd_proyek;
			}
			$proyeks = implode(",",$proyek_id);
			$kd_proyek = explode(",", $proyeks);

			$this->db->select("id_proyek,(select ifnull(sum(total),0) from ci_hpp where kd_area='$id' and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			$this->db->from("ci_pendapatan");
			$this->db->where("id_proyek", $proyek);
			$this->db->where_in('id_proyek', $kd_proyek);
			$this->db->order_by("id_pqproyek");
			$query=$this->db->get();
			return $query->result_array();
		}
public function get_op_by_area($kd_item, $id,$tahun){
			$query= $this->db->query("SELECT z.*,x.uraian as keterangan,x.total from (
							SELECT `map_pq`.`kd_item` FROM `map_pq` WHERE 
							map_pq.kd_item = '$kd_item')z 
							LEFT JOIN 
							(select uraian,kd_item,sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' and kd_area='$id' group by kd_item)x ON `x`.`kd_item`=`z`.`kd_item` 
							ORDER BY kd_item");
			
			return $query->result_array();
		}

public function get_op_all($kd_item, $tahun){
			$query= $this->db->query("SELECT z.*,x.uraian as keterangan,x.total from (
							SELECT `map_pq`.`kd_item` FROM `map_pq` WHERE 
							map_pq.kd_item = '$kd_item')z 
							LEFT JOIN 
							(select uraian,kd_item,sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' group by kd_item)x ON `x`.`kd_item`=`z`.`kd_item` 
							ORDER BY kd_item");
			
			return $query->result_array();
		}

public function get_marketing_by_area($kd_item, $id,$tahun){
			$query= $this->db->query("SELECT z.*,x.uraian as keterangan,x.total from (
							SELECT `map_pq`.`kd_item` FROM `map_pq` WHERE 
							map_pq.kd_item = '$kd_item')z 
							LEFT JOIN 
							(select uraian,kd_item,sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' and kd_area='$id' group by kd_item)x ON left(`x`.`kd_item`,3)=`z`.`kd_item` 
							ORDER BY kd_item");
			
			return $query->result_array();
		}

public function get_marketing_all($kd_item, $tahun){
			$query= $this->db->query("SELECT z.*,x.uraian as keterangan,x.total from (
							SELECT `map_pq`.`kd_item` FROM `map_pq` WHERE 
							map_pq.kd_item = '$kd_item')z 
							LEFT JOIN 
							(select uraian,kd_item,sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' group by kd_item)x ON left(`x`.`kd_item`,3)=`z`.`kd_item` 
							ORDER BY kd_item");
			
			return $query->result_array();
		}

public function get_operasional_by_area($id, $tahun){
			$query= $this->db->query("SELECT sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun' and kd_area='$id'");
			return $result = $query->row_array();
		}
public function get_operasional_all($tahun){
			$query= $this->db->query("SELECT sum(total)as total from `ci_pq_operasional` where 
							left(kd_pq_operasional,4) = '$tahun'");
			return $result = $query->row_array();
		}

public function get_pq_by_projek($id, $proyek){
				$this->db->select('sub_total_a,nalokasi_ho,pendapatan_nett,nilaippl as nilai_pl');
				$this->db->from("v_get_pq");
				$this->db->where('kd_area',$id);
				$this->db->where('id_proyek',$proyek);
				$this->db->order_by('id_proyek');
			$query=$this->db->get();
		return $query->result_array();
		}
public function get_pendapatanarea_by_year($id,$tahun){

			$this->db->select("sum(pendapatan_nett) as pendapatannetarea, sum(sub_total_a)as sub_total_a, sum(ppn)as ppn, sum(pph)as pph, ifnull(sum(infaq),0)as infaq,
			SUM(case when (a.status_titipan='0' OR a.status_titipan is null OR a.status_titipan ='') then  a.titipan else 0 end)+
			SUM(case when a.status_titipan='1' then a.titipan_net else 0 end)as titipan_net,
            sum(case when(ppl=0 OR ppl is null OR ppl='') then npl else ppl end) as nilaippl");
			$this->db->from("ci_pendapatan a");
			$this->db->join("ci_proyek k","a.id_proyek=k.kd_proyek", 'inner');
			$this->db->where("left(a.id_proyek,4)", $tahun);
			$this->db->where("a.kd_area", $id);
			$this->db->group_start();
				$this->db->where("batal", 0);
				$this->db->or_where("batal ", null);
			$this->db->group_end();
			return $result = $this->db->get()->row_array();
		}

public function get_pendapatan_all_by_year($tahun){

			$this->db->select("sum(pendapatan_nett) as pendapatannetarea, sum(sub_total_a)as sub_total_a, sum(ppn)as ppn, sum(pph)as pph, ifnull(sum(infaq),0)as infaq, 
			SUM(case when (a.status_titipan='0' OR a.status_titipan is null OR a.status_titipan ='') then  a.titipan else 0 end)+
			SUM(case when a.status_titipan='1' then a.titipan_net else 0 end)as titipan_net,

(select ifnull(sum(d.npl),0) from ci_pendapatan d where d.kd_area=a.kd_area and left(d.id_proyek,4)=left(a.id_proyek,4) and (d.ppl ='0' OR d.ppl is null))+(select ifnull(sum(e.ppl),0) from ci_pendapatan e where e.kd_area=a.kd_area and left(e.id_proyek,4)=left(a.id_proyek,4)  and e.ppl <>'0')as nilaippl");
			$this->db->from("ci_pendapatan a");
			$this->db->where("left(id_proyek,4)", $tahun);
			return $result = $this->db->get()->row_array();
		}

public function get_spk_by_year($id,$tahun){
			$this->db->select("sum(nilai_spk) as nilai_spk");
			$this->db->from('v_get_proyek_pq2');
			$this->db->where("left(kd_proyek,4)", $tahun);
			$this->db->where("kd_area", $id);
			return $result = $this->db->get()->row_array();
}

public function get_tahun_lalu_by_year($id,$tahun){
	$this->db->select("sum(total) as tahunlalu");
	$this->db->from('ci_hpp');
	$this->db->where("substring(kd_pqproyek,4,4)", $tahun);
	$this->db->where("kd_area", $id);
	$this->db->where("kd_item", '5010502');
	return $result = $this->db->get()->row_array();
}

public function get_spk_all_by_year($tahun){
			$this->db->select("sum(nilai_spk) as nilai_spk");
			$this->db->from('v_get_proyek_pq2');
			$this->db->where("left(kd_proyek,4)", $tahun);
			return $result = $this->db->get()->row_array();
}

public function get_pq($kodearea,$tahun){
			$this->db->select("sum(nilai_pagu) as nilai_pagu,sum(nilai_spk) as nilai_spk,sum(ppn) as ppn,sum(pph) as pph,sum(infaq) as infaq,sum(titipan_net) as titipan_net,sum(pendapatan_nett)as pendapatan_nett,sum(nilaippl) as nilaippl, sum(sub_total_a) as sub_total_a,sum(nalokasi_ho) as nalokasi_ho");
			$this->db->from('v_cetak_pq_all');
			$this->db->where("thn_anggaran", $tahun);
			$this->db->where("kd_area", $kodearea);
			return $result = $this->db->get()->row_array();
}

public function get_cetak_hpp_all_by_area($kd_item,$jenis_tk, $id){
			if ($kd_item=='5010202'){
				$this->db->select("id_proyek,
								'$jenis_tk' as jenis_tk, 
								(select keterangan from ci_hpp where ci_hpp.kd_item='$kd_item' and jenis_tk='$jenis_tk' and kd_area='$id' 
								and ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek
								order by keterangan desc limit 1)as keterangan,
								(select ifnull(sum(total),0) from ci_hpp where ci_hpp.kd_item='$kd_item' and kd_area='$id' and jenis_tk='$jenis_tk' and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			}else{
				$this->db->select("id_proyek,
								'' as jenis_tk, 
								(select keterangan from ci_hpp where ci_hpp.kd_item='$kd_item' and (jenis_tk='$jenis_tk' OR jenis_tk is null) and kd_area='$id' 
								and ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek
								order by keterangan desc limit 1)as keterangan,
								(select ifnull(sum(total),0) from ci_hpp where ci_hpp.kd_item='$kd_item' and kd_area='$id' and (jenis_tk='$jenis_tk' OR jenis_tk is null) and id_pqproyek=ci_pendapatan.id_pqproyek)as nilai_hpp");
			}

			
			$this->db->from("ci_pendapatan");
			$this->db->where("kd_area", $id);
			$this->db->group_by("kd_area");
			$query=$this->db->get();
			return $query->result_array();
		}


// jumlah revisi
public function get_jumlah_revisi($id_pqproyek){
			$this->db->select("revisi as jumlah_revisi");
			$this->db->from('ci_pendapatan');
			$this->db->where("id_pqproyek", $id_pqproyek);
			return $result = $this->db->get()->row_array();
		}

function get_filter1($area=0,$filter1=0)
	{   
		if ($filter1=='subproyek'){
			if ($area=='all'){
				$query = $this->db->get_where('get_sub_proyek_marketing');
			}else if ($area=='allarea'){
				$this->db->select("'none' as kode, 'Laporan tidak tersedia untuk area ini' as nama ");
				$query = $this->db->get();
			}else{
				$query = $this->db->get_where('get_sub_proyek_by_area', array('kd_area' => $area));
			}
			
		}else if ($filter1=='perusahaan'){
			if ($area=='all'){
				$query = $this->db->get_where('get_perusahaan_marketing');
			}else if ($area=='allarea'){
				$this->db->select("'none' as kode, 'Laporan tidak tersedia untuk area ini' as nama ");
				$query = $this->db->get();
			}else{
				$query = $this->db->get_where('get_perusahaan_by_area', array('kd_area' => $area));
			}

			
		}
		return $query;
	}

	public function get_realisasi_proyek(){
				$tahun=$this->session->userdata('tahun');
				$query="SELECT s.* FROM (SELECT @ctahun:='".$tahun."' p) parm , cetakan_proyek_pdo_pdp_spj_pl s order by kd_area asc";
				$data = $this->db->query($query)->result_array();
				return $data;
			
				
			}

	}
?>