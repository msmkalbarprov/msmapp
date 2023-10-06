<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pdp extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('admin/area_model', 'area');
	
	}

	//-----------------------------------------------------------

	public function index(){
		$data['data_area'] 	= $this->area->get_area_pdp2();
		$data2['title'] 		= 'Register PDP';
		$this->load->view('admin/includes/_header', $data2);
		$this->load->view('user/laporan/register_pdp', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function transfer(){
		$data['data_area'] 	= $this->area->get_area_pdp2();
		$data2['title'] 		= 'Register PDP transfer';
		$this->load->view('admin/includes/_header', $data2);
		$this->load->view('user/laporan/register_pdp_transfer', $data);
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
 
	public function cetak_pdo($id=0)
	{	
		$data['pdo_header'] 		= $this->pdo_model->get_pdo_header($id);
		$data['pdo_detail'] 		= $this->pdo_model->get_pdo_detail($id);
		$data['ttd'] 				= $this->pdo_model->get_ttd($id);
		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan_pdo.pdf";
			    $this->pdf->load_view('user/pdo/cetak_pdo', $data);
                break;
            case 1;
                echo "<title>Cetak PDO</title>";
                echo $this->load->view('user/pdo/cetak_pdo', $data);
               break;
        }

	}


	public function cetak_register_pdp($id=0,$tahun=0,$jenis=0,$bulan=0)
	{	
		$data['register_pdp'] 		= $this->proyek_model->get_register_pdp($id,$tahun,$bulan);
		$data['area'] 				= $this->pdo_model->get_nama_area($id);
		$data['tahun'] 				= $tahun;

		if ($bulan==0){
			$data['bulan'] 				= "";	
		}else{
			$data['bulan'] 				= $this->format_indo($bulan);
		}

		if ($id=='allarea'){
			$filename = 'register_pdp_all';
		}else{
			$filename = 'register_pdp';
		}
		
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan_pdo.pdf";
			    $this->pdf->load_view('user/pencairan/'.$filename, $data);
                break;
            case 0;
				$html = $this->load->view('user/pencairan/'.$filename, $data);
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= register_pdp_$id.xls");
				$html;
               	break;
				
				
				/*  $data['title']= 'Rincian/Realisasi/PDO/PerAkun';
				 $data['filename']= 'Rincian-Realisasi-PDO-PerAkun';
				 $data['html']= $this->load->view('user/pencairan/'.$filename, $data); //$this->laporan_pdo($ctahun,$carea,$cacc,$ctipe);
				 $this->load->view('cetakan/cetakan',$data); */
						
				
             case 2;
				$this->load->view('user/pencairan/'.$filename, $data);
               	break;
        }

	}


	// cetak pdp transfer
	public function cetak_register_pdp_transfer($id=0,$tahun=0,$jenis=0,$bulan=0)
	{	
		$data['register_pdp_transfer'] 		= $this->proyek_model->get_register_pdp_transfer($id,$tahun,$bulan);
		$data['area'] 						= $this->pdo_model->get_nama_area($id);
		$data['tahun'] 						= $tahun;

		if ($bulan==0){
			$data['bulan'] 				= "";	
		}else{
			$data['bulan'] 				= $this->format_indo($bulan);
		}

		if ($id=='allarea'){
			$filename = 'register_pdp_transfer_all';
		}else{
			$filename = 'register_pdp_transfer';
		}
		
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = $filename.".pdf";
			    $this->pdf->load_view('user/pencairan/'.$filename, $data);
                break;
            case 0;
				$html = $this->load->view('user/pencairan/'.$filename, $data);
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= register_pdp_transfer_$id.xls");
				$html;
               	break;
				
				
				/*  $data['title']= 'Rincian/Realisasi/PDO/PerAkun';
				 $data['filename']= 'Rincian-Realisasi-PDO-PerAkun';
				 $data['html']= $this->load->view('user/pencairan/'.$filename, $data); //$this->laporan_pdo($ctahun,$carea,$cacc,$ctipe);
				 $this->load->view('cetakan/cetakan',$data); */
						
				
             case 2;
				$this->load->view('user/pencairan/'.$filename, $data);
               	break;
        }

	}
}

?>