<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posting extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('user/Posting_model', 'posting_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		
		$data['data_posting'] = $this->posting_model->get_last_posting();
		
		$data['title'] = 'Posting Jurnal';

		$this->load->view('admin/includes/_header',$data);
		$this->load->view('user/posting/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	
	//--------------------------------------------------
	function posting(){

					$data = array(
						'posting_jurnal' 	=> date('Y-m-d  H:i:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->posting_model->posting($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Posting jurnal berhasil!');
						redirect(base_url('posting'));
					}
				
			
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		$data['data_dinas'] = $this->dinas->get_all();

		if($this->input->post('submit')){
			$this->form_validation->set_rules('nama_dinas', 'Nama Dinas', 'trim|required');
			$this->form_validation->set_rules('area', 'Area', 'trim|required');
			$this->form_validation->set_rules('subarea', 'Sub Area', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('dinas/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'nama_dinas' 	=> $this->input->post('nama_dinas'),
					'kd_area' 		=> $this->input->post('area'),
					'kd_sub_area' 	=> $this->input->post('subarea'),
					'update_date' 	=> date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->dinas->edit_dinas($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Dinas berhasil diupdate!');
					redirect(base_url('dinas/index'));
				}
			}
		}
		elseif($id==""){
			redirect('dinas/index');
		}
		else{
			$data['dinas'] = $this->dinas->get_dinas_by_id($id);
			$data['data_area'] 			= $this->area->get_area();
			$data['data_subarea'] 		= $this->subarea->get_subarea();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/dinas/edit', $data);
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

		$this->dinas->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Dinas berhasil dihapus.');	
		redirect('dinas/index');
	}
	
}

?>