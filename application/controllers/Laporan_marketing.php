<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_marketing extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

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
		$data['data_area'] 			= $this->area->get_area2();
		$data['title'] = 'Marketing';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_marketing');
		$this->load->view('admin/includes/_footer');
	}

	function get_filter1(){
		$area = $this->input->post('id',TRUE);
		$filter1 = $this->input->post('filter1',TRUE);
		$data = $this->pq_model->get_filter1($area,$filter1)->result();
		echo json_encode($data);
	}
 
	public function cetak_marketing($id=0,$tahun=0,$jenis=0,$filter='', $filter2='', $file_name='')
	{	
		ini_set('max_execution_time', -1);
		ini_set('memory_limit',-1);
		$data['proyek']		= $this->pq_model->cetak_marketing($id,$tahun,$filter,$filter2);
		if($id=='allarea'){
			$file = 'laporan_marketing2';
		}else{
			$file = 'laporan_marketing';
		}

		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "$file_name.pdf";
			    $this->pdf->load_view('user/proyek/'.$file, $data);
                break;
            case 0;
                header("Cache-Control: no-cache, no-store, must-revalidate");
	            header("Content-Type: application/vnd.ms-excel");
	            header("Content-Disposition: attachment; filename= $file_name $id.xls");
                $this->load->view('user/proyek/'.$file, $data);
               break;
            case 2;
                $this->load->view('user/proyek/'.$file, $data);
               break;
        }

	}


}


?>