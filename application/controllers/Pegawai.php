<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('user/dinas_model', 'dinas');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/pegawai_model', 'pegawai');
		
    }

	//-----------------------------------------------------		 MULAI
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data2['title'] = 'Admin List';

		$this->load->view('admin/includes/_header', $data2);
		$this->load->view('user/pegawai/index');
		$this->load->view('admin/includes/_footer');
	}


	function add(){

		$this->rbac->check_operation_access(); // check opration permission
		$data['data_area'] 			= $this->area->get_area();

		if($this->input->post('submit')){
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pegawai/add'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		=> $this->input->post('area'),
						'kd_pegawai' 	=> $this->input->post('kd_pegawai'),
						'nama' 			=> $this->input->post('nama'),
						'jabatan' 		=> $this->input->post('jabatan'),
						'no_hp' 		=> $this->input->post('nohp'),
						'username' 		=> $this->session->userdata('username'),
						'created_at' 	=> date('Y-m-d : h:m:s'),
						'updated_at' 	=> date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->pegawai->add_pegawai($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Pegawai berhasil ditambahkan!');
						redirect(base_url('pegawai/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pegawai/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	public function datatable_json(){				   					   
		$records['data'] = $this->pegawai->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  

			if ($row['jabatan']=='DU'){
				$jabatan = 'Direktur Utama';
			}else if ($row['jabatan']=='D'){
				$jabatan = 'Direktur';
			}else if ($row['jabatan']=='MK'){
				$jabatan = 'Manager Keuangan';
			}else if ($row['jabatan']=='MSAI'){
				$jabatan = 'Manajer Senior Audit Internal';
			}else if ($row['jabatan']=='MPS'){
				$jabatan = 'Manajer Pengembangan Sistem<';
			}else if ($row['jabatan']=='MJM'){
				$jabatan = 'Manager Junior Multimedia';
			}else if ($row['jabatan']=='AE'){
				$jabatan = 'Asisten Eksekutif';
			}else if ($row['jabatan']=='AMRM'){
				$jabatan = 'AM/RM';
			}else if ($row['jabatan']=='kk'){
				$jabatan = 'Kepala kantor';
			}else if ($row['jabatan']=='adminkantor'){
				$jabatan = 'Admin Kantor';
			}else if ($row['jabatan']=='programer'){
				$jabatan = 'Programer';
			}else if ($row['jabatan']=='akuntan'){
				$jabatan = 'Akuntan';
			}else if ($row['jabatan']=='rc'){
				$jabatan = 'Resident Consultant';
			}else if ($row['jabatan']=='implementator'){
				$jabatan = 'Implementator';
			}else{
				$jabatan = 'Lainnya';
			}

	
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['kd_pegawai'],
				$row['nama'],
				$jabatan,
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pegawai/edit/cf78f9e3bb0b11225084de457d4672bf31a22a6502834033f933df25e570a76bd431bbd7f9112cad60ec5a201a4df5d4253413b44185880ddaccd4be17400581'.$row['id'].'0x0100abbe56e02bdc2d659d105ea8ca83f853e8ae4a65fd8aa0fe').'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pegawai/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission
		if($this->input->post('submit')){
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai', 'Kode Pegawai', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama Pegawai', 'trim|required');
				$this->form_validation->set_rules('jabatan', 'Jabatan', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pegawai/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'kd_area' 		=> $this->input->post('area'),
					'kd_pegawai' 	=> $this->input->post('kd_pegawai'),
					'nama' 			=> $this->input->post('nama'),
					'jabatan' 		=> $this->input->post('jabatan'),
					'no_hp' 		=> $this->input->post('nohp'),
					'username' 		=> $this->session->userdata('username'),
					'created_at' 	=> date('Y-m-d : h:m:s'),
					'updated_at' 	=> date('Y-m-d : h:m:s')
				);
				$kd_area = $this->security->xss_clean($this->input->post('area'));
				$data = $this->security->xss_clean($data);
				$result = $this->pegawai->edit_pegawai($data, $id, $kd_area);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Pegawai berhasil diupdate!');
					redirect(base_url('pegawai/index'));
				}
			}
		}
		else if($id==""){
			redirect('pegawai/index');
		}
		else{
			$data['data_area'] 			= $this->area->get_area();
			$data['data_pegawai'] 		= $this->pegawai->get_pegawai($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pegawai/edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}

	function delete($id=''){
	   
		$this->rbac->check_operation_access(); // check opration permission

		$this->pegawai->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Pegawai berhasil dihapus.');	
		redirect('pegawai/index');
	}

	//--------------------------------------------------		SELESAI

	
	//--------------------------------------------------


	//--------------------------------------------------
	

	//--------------------------------------------------


    //------------------------------------------------------------
	
	
}

?>