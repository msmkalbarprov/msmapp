<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pdo extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/pdo_model', 'pdo_model');
	// 	$this->load->model('user/pq_model', 'pq_model');

	// 	$this->load->model('admin/admin_model', 'admin');
	// 	$this->load->model('admin/area_model', 'area');
	// 	$this->load->model('admin/subarea_model', 'subarea');
	// 	$this->load->model('admin/jnsproyek_model', 'jnsproyek');
	// 	$this->load->model('admin/jnssubproyek_model', 'jnssubproyek_model');
	// 	$this->load->model('admin/perusahaan_model', 'perusahaan');
	// 	$this->load->model('admin/pagu_model', 'pagu');
	// 	$this->load->model('admin/dinas_model', 'dinas');
	// 	$this->load->model('admin/jnspagu_model', 'jnspagu');
	// 	$this->load->model('admin/tipeproyek_model', 'tipeproyek');
	// 	$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['data_area'] 			= $this->area->get_area();
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_pq');
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


	public function cetak_pdo_operasional($id=0)
	{	
		$data['pdo_header'] 		= $this->pdo_model->get_pdo_operasional_header($id);
		$data['pdo_detail'] 		= $this->pdo_model->get_pdo_detail($id);
		$data['ttd'] 				= $this->pdo_model->get_ttd_operasional($id);

		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan_pdo.pdf";
			    $this->pdf->load_view('user/pdo/cetak_pdo_operasional', $data);
                break;
            case 1;
                echo "<title>Cetak PDO</title>";
                echo $this->load->view('user/pdo/cetak_pdo_operasional', $data);
               break;
        }

	}

}

?>