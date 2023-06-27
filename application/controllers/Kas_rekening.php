<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_rekening extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('user/bku_model', 'bku_model');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('admin/area_model', 'area');
	
	}

	//-----------------------------------------------------------

	public function index(){
		$data['data_rekening'] 	= $this->bku_model->get_rekening_kas();
		$data2['title'] 		= 'Kas rekening';
		$this->load->view('admin/includes/_header', $data2);
		$this->load->view('user/bku/cetak_kas_rekening', $data);
		$this->load->view('admin/includes/_footer');
	}

	function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}


  function format_indo($date){
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $bulan = $date;
    $result = $Bulan[(int)$bulan-1];
    return $result;
  }


function terbilang($nilai) {
	if($nilai<0) {
		$hasil = "minus ". trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}     		
	return $hasil;
}
 

	public function cetak_kas_rekening($id=0,$tahun=0,$jenis=0,$bulan=0)
	{	
		$data['list'] 			    = $this->bku_model->get_kas_rekening($id,$tahun,$bulan);
		$data['rekening'] 			= $this->pdo_model->get_nama_rekening($id);
        $data['lalu'] 			    = $this->bku_model->saldo_awal($id,$tahun,$bulan);
		$data['tahun'] 				= $tahun;
		$data['acc'] 				= $id;
		$data['cjenis'] 				= $jenis;

		if ($bulan==0){
			$data['bulan'] 				= "";	
		}else{
			$data['bulan'] 				= $this->format_indo($bulan);
		}

		
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "bku_$id.pdf";
				if($id=='1010102' || $id='1010104'){
						 $this->pdf->load_view('user/bku/kas_rekening_kasbesar', $data);
				}else{
						 $this->pdf->load_view('user/bku/kas_rekening', $data);
				}
			   
                break;
            case 0;
				
				
				if($id=='1010102'){
						 $html = $this->load->view('user/bku/kas_rekening_kasbesar', $data);
				}else{
						 $html = $this->load->view('user/bku/kas_rekening', $data);
				}
				
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= bku_$id.xls");
				$html;
               	break;
             case 2;
				
				
				if($id=='1010102'){
						 $this->load->view('user/bku/kas_rekening_kasbesar', $data);
				}else{
						 $this->load->view('user/bku/kas_rekening', $data);
				}
               	break;
        }

	}
}

?>