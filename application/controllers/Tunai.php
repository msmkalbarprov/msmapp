<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tunai extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/pelimpahan_model', 'pelimpahan_model');
        $this->load->model('user/spj_pegawai_model', 'spjpegawai_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/spj_model', 'spj_model');
		
    }

	//-----------------------------------------------------		

	function index(){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'Ambil Kas Tunai';
		$this->load->view('admin/includes/_header',$data);
		$this->load->view('user/pelimpahan/tunai', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->pelimpahan_model->get_all_tunai();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('tunai/edit/cf78f9e3bb0b11225084de457d4672bf31a22a6502834033f933df25e570a76bd431bbd7f9112cad60ec5a201a4df5d4253413b44185880ddaccd4be17400581'.$row['id']).'440f2f6dfff3b40dbf4abc7cf6a9569f2914994230a967b17e27491624c71624d2ebc1083334dba2cf4dcffbe2ee3d199b209ed7c81ce31fb9a1229e54ce92de'.'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("tunai/delete/cf78f9e3bb0b11225084de457d4672bf31a22a6502834033f933df25e570a76bd431bbd7f9112cad60ec5a201a4df5d4253413b44185880ddaccd4be17400581".$row['id']).'440f2f6dfff3b40dbf4abc7cf6a9569f2914994230a967b17e27491624c71624d2ebc1083334dba2cf4dcffbe2ee3d199b209ed7c81ce31fb9a1229e54ce92de'.' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
		
			$data[]= array(
				$i++,
                $row['no_kas'],
				$row['nm_area'],
				$row['tgl_kas'],
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
            $data['title'] 			= 'Input Pelimpahan';

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
					redirect(base_url('tunai/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('tunai/add'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'tgl_kas'           => $this->input->post('tanggal'),
                        'no_kas'            => $this->input->post('no_kas'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data                   = $this->security->xss_clean($data);
					$result                 = $this->pelimpahan_model->simpan_ambil_tunai($data);
					if($result){
                        $urutan 					= $this->input->post('no_kas', TRUE);
                        $kd_pegawai 				= $this->input->post('kd_pegawai', TRUE);
				
                            $data2 = array(
                                'no_spj' => $urutan
                            );
                        $result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);
						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Ambil Kas Tunai berhasil ditambahkan!');
						redirect(base_url('tunai/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pelimpahan/add_tunai');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pelimpahan_model->get_pegawai_tunai_by_area($area)->result();
		echo json_encode($data);
	}

    function get_kas(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spjpegawai_model->get_kas($id)->result();
		echo json_encode($data);
	}

    function get_nomor(){
		$kd_pegawai 		= $this->input->post('kd_pegawai',TRUE);
		$data 		= $this->spjpegawai_model->get_nomor($kd_pegawai)->result();
		echo json_encode($data);
	}

	//--------------------------------------------------
	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission
        $id1 = str_replace('440f2f6dfff3b40dbf4abc7cf6a9569f2914994230a967b17e27491624c71624d2ebc1083334dba2cf4dcffbe2ee3d199b209ed7c81ce31fb9a1229e54ce92de','',$id);
	    $id2 = str_replace('cf78f9e3bb0b11225084de457d4672bf31a22a6502834033f933df25e570a76bd431bbd7f9112cad60ec5a201a4df5d4253413b44185880ddaccd4be17400581','',$id1);
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
                redirect(base_url('tunai/add'),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('tunai/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					    'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'tgl_kas'           => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pelimpahan_model->edit_ambil_tunai($data, $id2);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Ambil Kas Tunai berhasil diupdate!');
					redirect(base_url('tunai/index'));
				}
			}
		}
		elseif($id==""){
			redirect('tunai/index');
		}
		else{
			$data2['title'] = "Saldo Awal";
			$data['bank'] = $this->pelimpahan_model->get_kas_tunai_by_id($id2);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pelimpahan/edit_tunai', $data);
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
        $id1 = str_replace('440f2f6dfff3b40dbf4abc7cf6a9569f2914994230a967b17e27491624c71624d2ebc1083334dba2cf4dcffbe2ee3d199b209ed7c81ce31fb9a1229e54ce92de','',$id);
	    $id2 = str_replace('cf78f9e3bb0b11225084de457d4672bf31a22a6502834033f933df25e570a76bd431bbd7f9112cad60ec5a201a4df5d4253413b44185880ddaccd4be17400581','',$id1);
		$this->pelimpahan_model->delete_ambil_tunai($id2);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Ambil Tunai berhasil dihapus.');	
		redirect('tunai/index');
	}
	
}

?>