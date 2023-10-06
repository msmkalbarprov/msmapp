<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pq extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pq_model', 'pq_model');

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

	//-----------------------------------------------------------
	public function index(){
		$this->rbac->check_module_access();
		$data['data_area'] 			= $this->area->get_area();
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_pq_pdo');
		$this->load->view('admin/includes/_footer');
	}

	public function operasional(){
		$this->rbac->check_module_access();
		$data['data_area'] 			= $this->area->get_area();
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_pq_pdo_operasional');
		$this->load->view('admin/includes/_footer');
	}

	public function lap_realisasi_proyek(){
		$this->rbac->check_module_access();
		$data['data_area'] 		= $this->area->get_area();
		$data['title'] 			= 'Proyek VS PDO VS PDP VS SPJ';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_realisasi_proyek_perarea');
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json($bulan){				   					   
		$records['data'] = $this->pq_model->get_realisasi_proyek_bulan($bulan);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$data[]= array(
				++$i,
				$row['nm_area'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['apbd'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['spk'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['pdp'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format(($row['spk']-$row['pdp']),2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['pdo'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['pdo_pl'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['spj'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['spj_pl'],2,",",".").'</font></span></div>'

			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
 
	public function cetak_pq_pdo_proyek($id=0,$tahun='',$jenis='', $titlecetak='')
	{	
		$data['pqproyek'] 		= $this->pq_model->get_pq_by_id($id);
		$data['pencairan'] 		= $this->pq_model->get_pencairan_by_id($id);
		$data['titip_pl'] 		= $this->pq_model->get_titip_pl_by_id($id);
		$data['proyek'] 		= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
		$data['hpp'] 			= $this->pq_model->get_cetak_hpp_pq_pdo_by_id($id);
		$data['operasional']	= $this->pq_model->get_operasional_by_id($id);
		$data['marketing']		= $this->pq_model->get_marketing_by_id($id);
		$data['pendapatan_area']	= $this->pq_model->get_pendapatanarea($id);
		// $html = $this->load->view('user/pq/pq_view', $data);
		// $cRet = $this->load->view('user/pq/cetak_pq_satuan',$data);
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'portrait');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/pq/cetak_pq_pdo_proyek', $data);
                break;
				
            case 1;
                $this->load->view('user/pq/cetak_pq_pdo_proyek', $data);
               break;
        }

	}



	public function cetak_pq_pdo_operasional($id=0,$tahun=0)
	{	
		
		$data['operasional']		= $this->pq_model->cetak_operasional_by_area($id,$tahun);
		$data['header_operasional']	= $this->pq_model->get_operasional_header($id,$tahun);
		$data['marketing']			= $this->pq_model->cetak_marketing_by_id($id,$tahun);
		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'portrait');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/pq/cetak_pq_pdo_operasional', $data);
                break;
            case 1;
                $this->load->view('user/pq/cetak_pq_pdo_operasional', $data);
               break;
        }

	}


	public function cetak_pq_pdo_all($id=0,$tahun=0,$jenis='')
	{	
		$data['pqproyek'] 		= $this->pq_model->get_pq_by_idtahun($id, $tahun);
		$data['pencairan'] 		= $this->pq_model->get_pencairan_by_idtahun($id, $tahun);
		$data['titip_pl'] 		= $this->pq_model->get_titip_pl_by_idtahun($id, $tahun);
		$data['proyek'] 		= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
		$data['hpp'] 			= $this->pq_model->get_cetak_hpp_pq_pdo_by_idtahun($id, $tahun);
		// $data['operasional']	= $this->pq_model->get_operasional_by_id($id);
		$data['marketing']		= $this->pq_model->get_marketing_by_id($id);
		$data['pendapatan_area']	= $this->pq_model->get_pendapatanarea($id);

		$data['operasional']		= $this->pq_model->cetak_operasional_by_area($id,$tahun);
		$data['header_operasional']	= $this->pq_model->get_operasional_header($id,$tahun);
		$data['header_pq_pdo']	= $this->pq_model->get_header_pq_pdo($id);		
		$data['marketing']			= $this->pq_model->cetak_marketing_by_id($id,$tahun);
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'portrait');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/pq/cetak_pq_pdo_all', $data);
                break;
            case 0;
			header("Cache-Control: no-cache, no-store, must-revalidate");
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename= LAPORAN PQ PDO SPJ.xls");
			$this->load->view('user/pq/cetak_pq_pdo_all', $data);
		   break;
        }

	}

	public function cetak_pq_pdo_spj_per_area($jenis='',$judul)
	{	
		$data['rincian'] 		= $this->pq_model->get_realisasi_proyek();
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/laporan/lap_realisasi_proyek', $data);
                break;
            case 0;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= LAPORAN PQ.xls");
				$this->load->view('user/laporan/lap_realisasi_proyek_xls', $data);
               break;
        }

	}


}


?>