<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer_bud extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/pelimpahan_model', 'pelimpahan_model');
		$this->load->model('user/pdo_model', 'pdo_model');
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
		$this->load->view('user/transfer_bud/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->pelimpahan_model->get_all_tf_bud();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('transfer_bud/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("transfer_bud/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
		
			$data[]= array(
				$i++,
				$row['rek_asal'],
				$row['nm_rek_asal'],
				$row['tgl_transfer'],
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

			$data['data_rekening']	= $this->pelimpahan_model->get_rekening_transfer();
            $data['title'] 			= 'Input Transfer';

		if($this->input->post('submit')){
				$this->form_validation->set_rules('rek_asal', 'Rekening Asal', 'trim|required');
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
                $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
				$nomor				= $this->pelimpahan_model->get_nomor_kb();
                $nilai = $this->proyek_model->number($this->input->post('nilai'));
                $saldo = $this->proyek_model->number($this->input->post('saldo'));

                if ($nilai>$saldo){
                    $data = array(
						'errors' => 'Saldo anda tidak cukup'
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('transfer_bud/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('transfer_bud/add'),'refresh');
				}


				else{


					


					$data = array(
						'rek_asal' 		    => $this->input->post('rek_asal'),
						'no_bukti' 		    => $nomor['nomor'],
						'tgl_transfer'    	=> $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->pelimpahan_model->simpan_transfer_bud($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Transfer berhasil ditambahkan!');
						redirect(base_url('transfer_bud/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/transfer_bud/add');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pelimpahan_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

    function get_kas_rekening(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->pelimpahan_model->get_kas_rekening($id)->result();
		echo json_encode($data);
	}

	function get_nomor_bud(){
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->pdo_model->get_nomor_bud($area)->result();
		echo json_encode($data);
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            	$this->form_validation->set_rules('rek_asal', 'Rekening Asal', 'trim|required');
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
                $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

            $nilai = $this->proyek_model->number($this->input->post('nilai'));
            $saldo = $this->proyek_model->number($this->input->post('saldo'));
			if ($nilai>$saldo){
                $data = array(
                    'errors' => 'Saldo anda tidak cukup'
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('transfer_bud/add'),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('transfer_bud/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'tgl_transfer'    	=> $this->input->post('tanggal'),
					'keterangan'        => $this->input->post('keterangan'),
					'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
					'username' 		    =>  $this->session->userdata('username'),
					'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pelimpahan_model->edit_transfer_bud($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Transfer berhasil diupdate!');
					redirect(base_url('transfer_bud/index'));
				}
			}
		}
		elseif($id==""){
			redirect('transfer_bud/index');
		}
		else{
			$data2['title'] = "Transfer";
			$data['transfer'] = $this->pelimpahan_model->get_transferbud_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/transfer_bud/edit', $data);
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

		$this->pelimpahan_model->delete_transfer($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Transfer berhasil dihapus.');	
		redirect('transfer_bud/index');
	}
	
}

?>