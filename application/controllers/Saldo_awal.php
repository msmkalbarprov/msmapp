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

			if ($row['kd_area']!='01'){
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('saldo_awal/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("saldo_awal/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}else{
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('saldo_awal/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
';
			}

			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['no_rekening'].'<br>'.$row['nm_rekening'],
				$row['pemilik'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['saldo'],2,",",".").'</font></span></div>',
				$button
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


	function add(){

		$this->rbac->check_operation_access(); // check opration permission

			$data['data_area'] 			= $this->area->get_area();
			$data['data_subarea'] 		= $this->subarea->get_subarea();

		if($this->input->post('submit')){
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
				$this->form_validation->set_rules('rekening', 'Pegawai/Rekening', 'trim|required');
				$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('saldo_awal/add'),'refresh');
				}
				else{

					if ($this->input->post('area')=='01'){
						$rekening=$this->input->post('rekening');
					}else{
						$rekening='1010105';
					}
					$minus = $this->input->post('minus');
					if ($minus=='1'){
						$saldo=$this->proyek_model->number($this->input->post('saldo'))*-1;
					}else{
						$saldo=$this->proyek_model->number($this->input->post('saldo'));
					}

					$data = array(
						'kd_area' 		=> $this->input->post('area'),
						'no_rekening' 	=> $rekening,
						'kd_pegawai' 	=> $this->input->post('rekening'),
						'pemilik' 		=> $this->input->post('pemilik'),
						'saldo' 		=> $this->proyek_model->number($saldo),
						'username' 		=>  $this->session->userdata('username'),
						'created_at' 	=> date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->saldoawal_model->add_saldoawal($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Saldo Awal berhasil ditambahkan!');
						redirect(base_url('saldo_awal/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/saldo_awal/add');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->saldoawal_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
				$this->form_validation->set_rules('pemilik', 'Pemilik', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('saldo_awal/edit/'.$id),'refresh');
			}
			else{

				$minus = $this->input->post('minus');
				if ($minus=='1'){
					$saldo=$this->proyek_model->number($this->input->post('saldo'))*-1;
				}else{
					$saldo=$this->proyek_model->number($this->input->post('saldo'));
				}


				$data = array(
					'saldo' 	=> $saldo,
					'pemilik' 	=> $this->input->post('pemilik')
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

		$this->saldoawal_model->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Saldo Awal berhasil dihapus.');	
		redirect('saldo_awal/index');
	}
	
}

?>