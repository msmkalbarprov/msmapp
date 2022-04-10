<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ttd extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('user/dinas_model', 'dinas');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		
		$data['data_subarea'] = $this->subarea->get_subarea();
		
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/ttd/index', $data);
		$this->load->view('admin/includes/_footer');
	}


	function penandatangan($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		
		$data['data_subarea'] = $this->subarea->get_subarea();
		
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/ttd/penandatangan', $data);
		$this->load->view('admin/includes/_footer');
	}

	//---------------------------------------------------------
	function filterdata(){

		// $this->session->set_userdata('filter_subarea',$this->input->post('subarea'));
		$this->session->set_userdata('filter_keyword',$this->input->post('keyword'));
	}

	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->subarea->get_ttd();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$i++,
				$row['nm_area'],
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('ttd/edit/'.$row['kd_area']).'"> <i class="fa fa-pencil-square-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

public function datatable_json_ttd(){				   					   
		$records['data'] = $this->subarea->get_ttd_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$i++,
				$row['nama'],
				'<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('ttd/delete/'.$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
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
	function add_ttd(){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('ttd/add_ttd'),'refresh');
				}
				else{
					$data = array(
						'nama' 		=> $this->input->post('nama')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->subarea->add_ttd_new($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Tanda Tangan berhasil ditambahkan!');
						redirect(base_url('ttd/penandatangan'));
					}
				}
			}
			else
			{	
				$data['title'] = 'Tambah tanda tangan';
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/ttd/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission
		if($this->input->post('submit')){
			$this->form_validation->set_rules('area', 'Area', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('ttd/edit/'.$id),'refresh');
			}
			else{
				$data = array(
						'kd_area' 			=> $this->input->post('area'),
						'mengajukan' 		=> $this->input->post('mengajukan'),
						'mengetahui' 		=> $this->input->post('mengetahui'),
						'menyetujui' 		=> $this->input->post('menyetujui'),
						'nm_bank1' 			=> $this->input->post('nm_bank'),
						'rekening1' 		=> $this->input->post('no_rek'),
						'nama_rekening1' 	=> $this->input->post('nm_pemilik')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->subarea->edit_ttd($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Sub Area berhasil diupdate!');
					redirect(base_url('ttd/index'));
				}
			}
		}
		elseif($id==""){
			redirect('ttd/index');
		}
		else{
			$data['tandatangan']		= $this->subarea->get_ttd_by_area($id);
			$data['data_area'] 			= $this->area->get_area();
			$data['data_ttd'] 			= $this->subarea->get_tandatangan();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/ttd/edit', $data);
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

		$this->subarea->delete_ttd($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Sub Area berhasil dihapus.');	
		redirect('ttd/penandatangan');
	}
	
}

?>