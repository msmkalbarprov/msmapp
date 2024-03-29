<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends My_Controller {



	public function __construct(){

		parent::__construct();

		auth_check(); // check login auth

		$this->rbac->check_module_access();

		if($this->uri->segment(3) != '')
		$this->rbac->check_operation_access();

		$this->load->model('admin/dashboard_model', 'dashboard_model');

	}

	//--------------------------------------------------------------------------

	public function index(){

		$data['title'] 					= 'Dashboard';
		$data['all_proyek'] 			= $this->dashboard_model->get_all_proyek();
		$data['all_proyek_count'] 		= $this->dashboard_model->get_all_proyek_count();

		$data['all_proyek_cair'] 		= $this->dashboard_model->get_all_proyek_cair();
		$data['all_proyek_cair_count'] 	= $this->dashboard_model->get_all_proyek_cair_count();

		$data['all_pdo'] 				= $this->dashboard_model->get_all_pdo();
		$data['all_pdo_count'] 			= $this->dashboard_model->get_all_pdo_count();

		$data['all_spj'] 				= $this->dashboard_model->get_all_spj();
		$data['all_spj_count'] 			= $this->dashboard_model->get_all_spj_count();

		$data['deactive_users'] 		= $this->dashboard_model->get_deactive_users();


		$data['proyek'] 				= $this->dashboard_model->get_proyek();
		$data['area'] 					= $this->dashboard_model->get_area();
		$data['pdp'] 					= $this->dashboard_model->get_pdp();
		$data['pdo'] 					= $this->dashboard_model->get_pdo();
		$data['spj'] 					= $this->dashboard_model->get_spj();


		$this->load->view('admin/includes/_header', $data);
		
		if($this->session->userdata('is_supper')){
    		// redirect(base_url('admin/dashboard/general'));
    		$this->load->view('admin/dashboard/index5');
		}
		else if($this->session->userdata('is_supper') && $this->session->userdata('admin_role')=='Direktur Utama'){
    		// redirect(base_url('admin/dashboard/general'));
    		$this->load->view('admin/dashboard/index');
		}else if($this->session->userdata('admin_role')=='karyawan'){
    		redirect(base_url('admin/dashboard'));
    		// $this->load->view('admin/dashboard/index');
		}
		else{
			$this->load->view('admin/dashboard/index');
		}

    	$this->load->view('admin/includes/_footer');

	}

	//--------------------------------------------------------------------------

	public function index_1(){

		
		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header', $data);

    	$this->load->view('admin/dashboard/index', $data);

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_2(){

		$data['title'] = 'Dashboard';


		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index2');

    	$this->load->view('admin/includes/_footer');

	}



	//--------------------------------------------------------------------------

	public function index_3(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index3');

    	$this->load->view('admin/includes/_footer');

	}


	public function index_4(){

		$data['title'] = 'Dashboard';

		$this->load->view('admin/includes/_header');

    	$this->load->view('admin/dashboard/index4');

    	$this->load->view('admin/includes/_footer');

	}


}
?>	