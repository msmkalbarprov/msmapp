<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_bud extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('user/transfer_model', 'transfer_model');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	// public function index(){
	// 	$data['title'] = 'Transfer Pencairan';
	// 	$this->load->view('admin/includes/_header', $data);
	// 	$this->load->view('comming-soon');
	// 	$this->load->view('admin/includes/_footer');
	// }

}
?>