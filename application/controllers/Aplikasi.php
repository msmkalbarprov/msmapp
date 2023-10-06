<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        

		$this->load->model('admin/aplikasi_model', 'aplikasi');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){
		$this->rbac->check_module_access();
		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		
		$data['title'] = 'Aplikasi List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/aplikasi/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->aplikasi->get_all();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$row['kd_subprojek'],
				$row['nm_subprojek'],
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('sub-proyek/edit/'.$row['kd_subprojek']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("sub-proyek/delete/".$row['kd_subprojek']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------
	function change_status(){

		$this->rbac->check_operation_access(); // check opration permission

		$this->admin->change_status();
	}
	
	//--------------------------------------------------
	function add(){
		$data['title'] = 'Add Aplikasi';
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
				$this->form_validation->set_rules('kode', 'Kode Aplikasi', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama Aplikasi', 'trim|required');
				$this->form_validation->set_rules('proyek', 'Proyek', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('sub-proyek/add'),'refresh');
				}
				else{
					$data = array(
						'kd_subprojek' 	=> $this->input->post('kode'),
						'nm_subprojek' 	=> $this->input->post('nama'),
						'kd_projek' 	=> $this->input->post('proyek')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->aplikasi->add_aplikasi($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);
						$this->session->set_flashdata('success', 'Sub Proyek berhasil ditambahkan!');
						redirect(base_url('sub-proyek'));
					}
				}
			}
			else
			{
				$data['data_proyek'] = $this->aplikasi->get_proyek();

				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/aplikasi/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
				$this->form_validation->set_rules('kode', 'Kode Aplikasi', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama Aplikasi', 'trim|required');
				$this->form_validation->set_rules('proyek', 'Proyek', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('sub-proyek/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'kd_subprojek' 	=> $this->input->post('kode'),
					'nm_subprojek' 	=> $this->input->post('nama'),
					'kd_projek' 	=> $this->input->post('proyek')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->aplikasi->edit_aplikasi($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Sub Proyek berhasil diupdate!');
					redirect(base_url('sub-proyek'));
				}
			}
		}
		elseif($id==""){
			redirect('sub-proyek');
		}
		else{
			$data['data_proyek'] = $this->aplikasi->get_proyek();
			$data['aplikasi'] = $this->aplikasi->get_aplikasi_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/aplikasi/edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}



    //------------------------------------------------------------
	function delete($id=''){
	   
		$this->rbac->check_operation_access(); // check opration permission

		$this->aplikasi->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Sub Proyek berhasil dihapus.');	
		redirect('sub-proyek');
	}
	
}

?>