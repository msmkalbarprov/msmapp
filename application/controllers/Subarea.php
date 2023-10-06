<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Subarea extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        

		$this->load->model('user/dinas_model', 'dinas');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){
		$this->rbac->check_module_access();
		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		
		$data['data_subarea'] = $this->subarea->get_subarea();
		
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/subarea/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//---------------------------------------------------------
	function filterdata(){

		// $this->session->set_userdata('filter_subarea',$this->input->post('subarea'));
		$this->session->set_userdata('filter_keyword',$this->input->post('keyword'));
	}

	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->subarea->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['nm_subarea'],
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('sub-area/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("sub-area/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
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

		$this->rbac->check_operation_access(); // check opration permission

			$data['data_area'] 			= $this->area->get_area();
			$data['data_kabupaten']		= $this->subarea->get_kabupaten();

		if($this->input->post('submit')){
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('subarea', 'Sub Area', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('sub-area/add'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		=> $this->input->post('area'),
						'kd_subarea' 	=> $this->input->post('area').$this->input->post('subarea'),
						'kd_kabupaten' 	=> $this->input->post('subarea')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->subarea->add_subarea($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Sub Area berhasil ditambahkan!');
						redirect(base_url('subarea'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/subarea/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission
		if($this->input->post('submit')){
			$this->form_validation->set_rules('area', 'Area', 'trim|required');
			$this->form_validation->set_rules('subarea', 'Sub Area', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('sub-area/edit/'.$id),'refresh');
			}
			else{
				$data = array(
						'kd_area' 		=> $this->input->post('area'),
						'kd_subarea' 	=> $this->input->post('area').$this->input->post('subarea'),
						'kd_kabupaten' 	=> $this->input->post('subarea')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->subarea->edit_subarea($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Sub Area berhasil diupdate!');
					redirect(base_url('subarea'));
				}
			}
		}
		elseif($id==""){
			redirect('sub-area');
		}
		else{
			$data['subarea']			= $this->subarea->get_subarea_by_id($id);
			$data['data_area'] 			= $this->area->get_area();
			$data['data_kabupaten'] 	= $this->subarea->get_kabupaten();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/subarea/edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}

	//--------------------------------------------------
	function check_username($id=0){

		$this->db->from('ci_users');
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('user_id !='.$id);
		$query=$this->db->get();
		if($query->num_rows() >0)
			echo 'false';
		else 
	    	echo 'true';
    }

    //------------------------------------------------------------
	function delete($id=''){
	   
		$this->rbac->check_operation_access(); // check opration permission

		$this->subarea->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Sub Area berhasil dihapus.');	
		redirect('sub-area');
	}
	
}

?>