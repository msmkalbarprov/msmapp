<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_lain_area extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/Penerimaan_lain_model', 'penerimaan_lain_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/Spj_pegawai_model', 'spjpegawai_model');
		$this->load->model('user/spj_model', 'spj_model');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'Admin List';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/penerimaan_lain_area/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->penerimaan_lain_model->get_all_tlainnya();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('tlain/edit/0b48b04152b78adab02750700dbf0f1bb5fba69c'.$row['id'].'707e6a779d28c9ea4cb463027da57cf23943922e').'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("tlain/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
                
			$data[]= array(
				$i++,
				$row['no_bukti'],
				$row['tgl_bukti'],
				$row['no_acc'].'<br>'.$row['nm_acc'],
                $row['keterangan'],
                $row['jenis'],
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

			$data['data_akun'] 	    = $this->penerimaan_lain_model->get_akun_penerimaan();
            $data['title'] 			= 'Input penerimaan lainnya';

		if($this->input->post('submit')){
				$this->form_validation->set_rules('nobukti', 'No. Bukti', 'trim|required');
				// $this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
                $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
				$this->form_validation->set_rules('no_acc', 'Akun', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai', 'Pegawai', 'trim|required');
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
				
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('penerimaan_lain_area/add'),'refresh');
				}
				else{
					$data = array(
						'no_acc' 		    => $this->input->post('no_acc'),
						'kd_pegawai'	    => $this->input->post('kd_pegawai'),
						'no_bukti'   	    => $this->input->post('nobukti'),
						'tgl_bukti'         => $this->input->post('tanggal'),
						'jenis'         	=> $this->input->post('jenis'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$this->penerimaan_lain_model->simpan_tlainnya($data);
					$urutan 				= $this->input->post('nobukti', TRUE);
					$kd_pegawai 			= $this->input->post('kd_pegawai', TRUE);
					$data2 = array(
						'no_spj' => $urutan
					);

					$result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);

					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);
						$this->session->set_flashdata('success', 'Penerimaan lainnya berhasil ditambahkan!');
						redirect(base_url('tlain'));
					}
				}
			}
			else
			{	
				// $data['data_rekening'] 	= $this->penerimaan_lain_model->get_akun_penerimaan();
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/penerimaan_lain_area/add');
        		$this->load->view('admin/includes/_footer');
			}
	}
    
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->penerimaan_lain_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

    function get_kas(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spj_model->get_kas($id)->result();
		echo json_encode($data);
	}

	//--------------------------------------------------
	function edit($oldid=""){
		$id = str_replace('0b48b04152b78adab02750700dbf0f1bb5fba69c','',(str_replace('707e6a779d28c9ea4cb463027da57cf23943922e','',$oldid)));
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            $this->form_validation->set_rules('nobukti', 'No Bukti', 'trim|required');
            $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
            $this->form_validation->set_rules('no_acc', 'Akun', 'trim|required');
			$this->form_validation->set_rules('kd_pegawai', 'Pegawai', 'trim|required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('penerimaan_lain_area/edit/'.$id),'refresh');
			}
			else{
				$data = array(
                        'no_acc' 		    => $this->input->post('no_acc'),
						'kd_pegawai'	    => $this->input->post('kd_pegawai'),
						'kd_area'	    	=> $this->input->post('kd_area'),
						'jenis'	   	 		=> $this->input->post('jenis'),
                        'no_bukti'   	    => $this->input->post('nobukti'),
                        'tgl_bukti'         => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->penerimaan_lain_model->edit_tlain($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'penerimaan lainnya berhasil diupdate!');
					redirect(base_url('tlain'));
				}
			}
		}
		elseif($id==""){
			redirect('tlain');
		}
		else{
            $data['data_akun'] 	    = $this->penerimaan_lain_model->get_akun_terima();
			$data2['title']     	= "penerimaan lainnya";
			$data['data_plain'] 	= $this->penerimaan_lain_model->get_tlain_by_id($id);
			// $data['data_rekening'] 	= $this->bku_model->get_rekening_kas();
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/penerimaan_lain_area/edit', $data);
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

		$this->penerimaan_lain_model->delete_tlainnya($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','penerimaan lainnya berhasil dihapus.');	
		redirect('tlain');
	}
	
}

?>