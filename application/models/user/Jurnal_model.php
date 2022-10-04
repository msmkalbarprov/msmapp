<?php
	class Jurnal_model extends CI_Model{

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

        public function get_all(){
            if($this->session->userdata('is_supper') || $this->session->userdata('admin_role')=='Direktur Utama' || $this->session->userdata('admin_role')=='Divisi Administrasi Proyek' || $this->session->userdata('admin_role')=='Admin' ){
                $this->db->select("*,sum(kredit)as t_kredit,sum(debet)as t_debet,(select nm_area from ci_area where kd_area = ci_jurnal.kd_area)as nm_area");
                $this->db->from("ci_jurnal");
                $this->db->where("jns_jurnal",2);
                $this->db->group_by("no_voucher,kd_area");
                $this->db->order_by("tgl_voucher,no_voucher,kd_area");
                   return $this->db->get()->result_array();
            }
            else{
                $this->db->select("*,sum(kredit)as t_kredit,sum(debet)as t_debet,(select nm_area from ci_area where kd_area = ci_jurnal.kd_area)as nm_area");
                $this->db->from("ci_jurnal");
                $this->db->where("jns_jurnal",2);
                $this->db->where('kd_area',$this->session->userdata('kd_area'));
                $this->db->group_by("no_voucher,kd_area");
                $this->db->order_by("tgl_voucher,no_voucher,kd_area");
                   return $this->db->get()->result_array();
            }
        }


        function get_akun()
        {	
                $this->db->from('ci_coa');
                $this->db->where('level',4);
                $this->db->order_by('no_acc');
                $query=$this->db->get();
            return $query->result_array();
        }

        public function save_jurnal_umum($data){
            $request = $data;
            $this->db->insert_batch('ci_jurnal', array_map(function ($value) {
					$result = [
						'urut'          => $value['urut'],
						'tgl_voucher'   => $value['tgl_voucher'],
						'no_voucher'    => $value['no_voucher'],
						'kd_area'       => $value['kd_area'],
						'kd_divisi'     => "",
						'kd_project'    => "",
						'no_acc'        => $value['no_acc'],
						'nm_acc'        => $value['nm_acc'],
						'uraian'        => $value['uraian'],
						'debet'         => $this->number($value['debet']),
						'kredit'        => $this->number($value['kredit']),
                        'jns_jurnal'    => $value['jns_jurnal'],
						'username'      => $this->session->userdata('username'),
                        'updated_at'    => date("Y-m-d h:i:s")
					];
					return $result;
				}, $data));
        return true;
            // $query = $this->db->insert_batch('ci_jurnals', $insert_data);
    }

    public function get_jurnal_umum($tahun,$bulan,$jns_jurnal){
        $this->db->select("*,(select nm_area from ci_area where ci_area.kd_area=ci_jurnal.kd_area)as nm_area");
        $this->db->from("ci_jurnal");
    
    if($bulan==0){
        $this->db->where("year(tgl_voucher)>=", $tahun);
    }else{
        $this->db->where("year(tgl_voucher)>=", $tahun);
        $this->db->where("month(tgl_voucher)", $bulan);
    }

    if ($jns_jurnal==1){
        $this->db->where("jns_jurnal", 1);
    }else if ($jns_jurnal==2){
        $this->db->where("jns_jurnal", 2);
    }
        $query=$this->db->get();
    return $query->result_array();
}

public function get_rincian_bb($tahun,$bulan,$area){
    $this->db->select("*,(select nm_area from ci_area where ci_area.kd_area=ci_jurnal.kd_area)as nm_area,CASE 
	WHEN (substr(kd_project,8,4)='/98/' OR right(kd_project,3)='/98') THEN
		(SELECT nm_area from ci_area where kd_area=ci_jurnal.kd_area)
	ELSE
		(SELECT nm_sub_area from ci_proyek where kd_proyek=ci_jurnal.kd_project) END as subarea");
    $this->db->from("ci_jurnal");

if($bulan==0){
    $this->db->where("year(tgl_voucher)>=", $tahun);
}else{
    $this->db->where("year(tgl_voucher)>=", $tahun);
    $this->db->where("month(tgl_voucher)", $bulan);
}

if ($area!=0){
    $this->db->where("kd_area", $area);
}

$this->db->order_by("no_acc,tgl_voucher,no_voucher");

    $query=$this->db->get();
return $query->result();
}

public function get_acc($tahun,$bulan,$area){
    $this->db->select("*,(select nm_area from ci_area where ci_area.kd_area=ci_jurnal.kd_area)as nm_area");
    $this->db->from("ci_jurnal");

if($bulan==0){
    $this->db->where("year(tgl_voucher)>=", $tahun);
}else{
    $this->db->where("year(tgl_voucher)>=", $tahun);
    $this->db->where("month(tgl_voucher)", $bulan);
}

if ($area!=0){
    $this->db->where("kd_area", $area);
}

$this->db->group_by("no_acc");
$this->db->order_by("no_acc");
    $query = $this->db->get();
    return $query->result(); 
}



    public function simpan_jurnal($data){
        $this->db->insert('ci_jurnal', $data);
        return true;
    }

      public function get_jurnal_by_id($id){
        
        $no_voucher= str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',str_replace('054d4a4653a16b49c49c49e000075d10','',str_replace('1a942eab068a2173e66d08c736283cfe22e1c1ed','/',$id)));
        $this->db->from('ci_jurnal');
        $this->db->where('no_voucher', $no_voucher);
        $query=$this->db->get();
		return $query->row_array();
}

public function get_jurnal_by_no_voucher($id){
    $no_voucher= str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',str_replace('054d4a4653a16b49c49c49e000075d10','',str_replace('1a942eab068a2173e66d08c736283cfe22e1c1ed','/',$id)));
    $this->db->select('ci_jurnal.*,(select nm_area from ci_area where ci_area.kd_area=ci_jurnal.kd_area)as nm_area');
    $this->db->from('ci_jurnal');
    $this->db->where('no_voucher', $no_voucher);
    return $this->db->get()->result_array();
}

    }
?>