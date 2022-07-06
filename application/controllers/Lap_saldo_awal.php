<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_saldo_awal extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pq_model', 'pq_model');
		$this->load->model('admin/saldoawal_model', 'saldoawal_model');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/jnssubproyek_model', 'jnssubproyek_model');
		$this->load->model('admin/perusahaan_model', 'perusahaan');
		$this->load->model('admin/pagu_model', 'pagu');
		$this->load->model('admin/dinas_model', 'dinas');
		$this->load->model('admin/jnspagu_model', 'jnspagu');
		$this->load->model('admin/tipeproyek_model', 'tipeproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}


 


public function cetak_saldo_awal($jenis='',$judul)
	{	
		$data['rincian'] 	= $this->saldoawal_model->get_lap_saldo_awal();
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/laporan/cetak_lap_saldo_awal', $data);
                break;
            case 0;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= $judul.xls");
				$this->load->view('user/laporan/cetak_lap_saldo_awal', $data);
               break;
        }

	}

public function index(){
		$data['rincian'] 	= $this->saldoawal_model->get_lap_saldo_awal();
		$data['data_area'] 			= $this->area->get_area();
		$data['title'] = 'Laporan Saldo Awal';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/lap_saldo_awal',$data);
		$this->load->view('admin/includes/_footer');
	}


}


?>