<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->load->model('admin/perusahaan_model', 'perusahaan');
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
		
		$data['title'] = 'Perusahaan List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/perusahaan/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->perusahaan->get_all();
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$row['id'],
				$row['nama'],
				$row['akronim'],
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('perusahaan/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("perusahaan/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
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
		$data['title'] = 'Perusahaan';
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
				$this->form_validation->set_rules('nama', 'nama perusahaan', 'trim|required');
				$this->form_validation->set_rules('akronim', 'Akronim', 'trim|required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('notelp', 'No. Telp', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('perusahaan/add'),'refresh');
				}
				else{
					$data = array(
						'nama' 			=> $this->input->post('nama'),
						'akronim' 		=> $this->input->post('akronim'),
						'alamat' 		=> $this->input->post('alamat'),
						'no_telp' 		=> $this->input->post('notelp'),
						'create_by' 	=>  $this->session->userdata('username'),
						'create_date' 	=> date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->perusahaan->add_perusahaan($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);
						$this->session->set_flashdata('success', 'Perusahaan berhasil ditambahkan!');
						redirect(base_url('perusahaan'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/perusahaan/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
			$this->form_validation->set_rules('nama', 'nama perusahaan', 'trim|required');
				$this->form_validation->set_rules('akronim', 'Akronim', 'trim|required');
				$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
				$this->form_validation->set_rules('notelp', 'No. Telp', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('perusahaan/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'nama' 			=> $this->input->post('nama'),
					'akronim' 		=> $this->input->post('akronim'),
					'alamat' 		=> $this->input->post('alamat'),
					'no_telp' 		=> $this->input->post('notelp'),
					'update_by' 	=>  $this->session->userdata('username'),
					'update_date' 	=> date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$result = $this->perusahaan->edit_perusahaan($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Perusahaan berhasil diupdate!');
					redirect(base_url('perusahaan'));
				}
			}
		}
		elseif($id==""){
			redirect('perusahaan');
		}
		else{
			$data['perusahaan'] = $this->perusahaan->get_perusahaan_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/perusahaan/edit', $data);
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

		$this->perusahaan->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Perusahaan berhasil dihapus.');	
		redirect('perusahaan');
	}
	
}

?>