<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/pengembalian_model', 'pengembalian_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/spj_model', 'spj_model');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/pengembalian/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->pengembalian_model->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pengembalian/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pengembalian/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
		
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['tgl_bukti'],
				$row['nm_pegawai'],
                $row['keterangan'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
				$button
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	//-----------------------------------------------------------


	function add(){

		$this->rbac->check_operation_access(); // check opration permission

			$data['data_area'] 			= $this->area->get_area();
            $data['title'] 			= 'Input pengembalian';

		if($this->input->post('submit')){
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
                $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai', 'Pegawai/Rekening', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

                $nilai = $this->proyek_model->number($this->input->post('nilai'));
                $saldo = $this->proyek_model->number($this->input->post('saldo'));

                if ($nilai>$saldo){
                    $data = array(
						'errors' => 'Saldo anda tidak cukup'
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pengembalian/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pengembalian/add'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'tgl_bukti'    => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->pengembalian_model->simpan_pengembalian($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Saldo Awal berhasil ditambahkan!');
						redirect(base_url('pengembalian/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pengembalian/add');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pengembalian_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

    function get_kas(){
		$id 		= $this->input->post('id',TRUE);
        $kd_pegawai	= $this->input->post('kd_pegawai',TRUE);
		$data 		= $this->pengembalian_model->get_kas($id,$kd_pegawai)->result();
		echo json_encode($data);
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            $this->form_validation->set_rules('area', 'Area', 'trim|required');
            $this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
            $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
            $this->form_validation->set_rules('kd_pegawai', 'Pegawai/Rekening', 'trim|required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

            $nilai = $this->proyek_model->number($this->input->post('nilai'));
            $saldo = $this->proyek_model->number($this->input->post('saldo'));
			if ($nilai>$saldo){
                $data = array(
                    'errors' => 'Saldo anda tidak cukup'
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('pengembalian/edit/'.$id),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pengembalian/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					    'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'tgl_bukti'    => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pengembalian_model->edit_pengembalian($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Saldo Awal berhasil diupdate!');
					redirect(base_url('pengembalian/index'));
				}
			}
		}
		elseif($id==""){
			redirect('pengembalian/index');
		}
		else{
			$data2['title'] = "Saldo Awal";
			$data['bank'] = $this->pengembalian_model->get_pengembalian_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pengembalian/edit', $data);
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

		$this->pengembalian_model->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','pengembalian berhasil dihapus.');	
		redirect('pengembalian/index');
	}
	
}

?>