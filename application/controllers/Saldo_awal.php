<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_awal extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/saldoawal_model', 'saldoawal_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('admin/subarea_model', 'subarea');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		
		$data['data_subarea'] = $this->subarea->get_subarea();
		
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/saldo_awal/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->saldoawal_model->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['no_rekening'].'<br>'.$row['nm_rekening'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['saldo'],2,",",".").'</font></span></div>',
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('saldo_awal/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>'
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
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('saldo_awal/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'saldo' 	=> $this->proyek_model->number($this->input->post('saldo'))
				);

				$data = $this->security->xss_clean($data);
				$result = $this->saldoawal_model->edit_saldo($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Saldo Awal berhasil diupdate!');
					redirect(base_url('saldo_awal/index'));
				}
			}
		}
		elseif($id==""){
			redirect('saldo_awal/index');
		}
		else{
			$data2['title'] = "Saldo Awal";
			$data['bank'] = $this->saldoawal_model->get_saldo_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/saldo_awal/edit', $data);
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

		$this->bank->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Perusahaan berhasil dihapus.');	
		redirect('bank/index');
	}
	
}

?>