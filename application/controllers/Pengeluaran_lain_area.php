<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_lain_area extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/Pengeluaran_model_area', 'Pengeluaran_model_area');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/Spj_pegawai_model', 'spjpegawai_model');
		$this->load->model('user/spj_model', 'spj_model');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'Pengeluaran Lain - lain';
		$this->load->view('admin/includes/_header');
		$this->load->view('user/pengeluaran_lain_area/index', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->Pengeluaran_model_area->get_all_plainnya_area();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pengeluaran_lain_area/edit/0b48b04152b78adab02750700dbf0f1bb5fba69c'.$row['id']).'707e6a779d28c9ea4cb463027da57cf23943922e'.'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pengeluaran_lain_area/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
		
			$data[]= array(
				$i++,
				'<div class="text-left"><span align="left"><font size="2px">'.$row['no_bukti'].'</font></span></div>',
				'<div class="text-left"><span align="left"><font size="2px">'.$row['tgl_bukti'].'</font></span></div>',
				'<div class="text-left"><span align="left"><font size="2px">'.$row['no_acc'].'<br>'.$row['nm_acc'].'</font></span></div>',
                '<div class="text-left"><span align="left"><font size="2px">'.$row['keterangan'].'</font></span></div>',
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

			$data['data_akun'] 	    	= $this->Pengeluaran_model_area->get_akun();
			$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
            $data['title'] 				= 'Input Pengeluaran lainnya';

		if($this->input->post('submit')){
				$this->form_validation->set_rules('nobukti', 'No. Bukti', 'trim|required');
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
                $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
				$this->form_validation->set_rules('area', 'area', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai', 'Pegawai', 'trim|required');
				$this->form_validation->set_rules('no_acc', 'Akun', 'trim|required');
				$this->form_validation->set_rules('no_rekening', 'Rekening', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
				
                $nilai 				= $this->proyek_model->number($this->input->post('nilai'));
                $saldo 				= $this->proyek_model->number($this->input->post('saldo'));

                if ($nilai>$saldo){
                    $data = array(
						'errors' => 'Saldo anda tidak cukup'
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pengeluaran_lain_area/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pengeluaran_lain_area/add'),'refresh');
				}
				else{
					$data = array(
						'no_acc' 		    => $this->input->post('no_acc'),
						'divisi' 		    => $this->input->post('divisi'),
						'kd_area'	    	=> $this->input->post('area'),
						'no_bukti'   	    => $this->input->post('nobukti'),
						'kd_pegawai'   	    => $this->input->post('kd_pegawai'),
						'tgl_bukti'         => $this->input->post('tanggal'),
						'no_rekening'	    => $this->input->post('no_rekening'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$this->Pengeluaran_model_area->simpan_plainnya($data);
					$urutan 				= $this->input->post('nobukti', TRUE);
					$kd_pegawai 			= $this->input->post('kd_pegawai', TRUE);
					$data2 = array(
						'no_spj' => $urutan
					);

					$result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);


					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Pengeluaran lainnya berhasil ditambahkan!');
						redirect(base_url('pengeluaran_lain_area'));
					}
				}
			}
			else
			{	
				$data['data_rekening'] 	= $this->Pengeluaran_model_area->get_rekening_kas();
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pengeluaran_lain_area/add');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->Pengeluaran_model_area->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

	function get_nomor(){
		$kd_pegawai 		= $this->input->post('kd_pegawai',TRUE);
		$data 		= $this->spjpegawai_model->get_nomor($kd_pegawai)->result();
		echo json_encode($data);
	}

    function get_kas(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spjpegawai_model->get_kas($id)->result();
		echo json_encode($data);
	}

	function get_akun_pengeluaran(){
		$area = $this->input->post('area',TRUE);
		$divisi = $this->input->post('id',TRUE);
		$data = $this->Pengeluaran_model_area->get_akun_pengeluaran($area,$divisi)->result();
		echo json_encode($data);
	}

	function get_area_pengeluaran(){
		$divisi = $this->input->post('id',TRUE);
		$data = $this->Pengeluaran_model_area->get_area_pengeluaran($divisi)->result();
		echo json_encode($data);
	}

	//--------------------------------------------------
	function edit($oldid=""){

		$id = str_replace('0b48b04152b78adab02750700dbf0f1bb5fba69c','',(str_replace('707e6a779d28c9ea4cb463027da57cf23943922e','',$oldid)));
		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            $this->form_validation->set_rules('nobukti', 'No Bukti', 'trim|required');
            $this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
            $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			$this->form_validation->set_rules('area', 'area', 'trim|required');
            $this->form_validation->set_rules('no_acc', 'Akun', 'trim|required');
			$this->form_validation->set_rules('no_rekening', 'Rekening', 'trim|required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

            $nilai = $this->proyek_model->number($this->input->post('nilai'));
            $saldo = $this->proyek_model->number($this->input->post('saldo'));
			if ($nilai>$saldo){
                $data = array(
                    'errors' => 'Saldo anda tidak cukup'
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('pengeluaran_lain_area/edit/'.$id),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pengeluaran_lain_area/edit/'.$id),'refresh');
			}
			else{
				$data = array(
                        'no_acc' 		    => $this->input->post('no_acc'),
                        'no_bukti'   	    => $this->input->post('nobukti'),
						'divisi' 		    => $this->input->post('divisi'),
						'kd_area' 		    => $this->input->post('area'),
                        'tgl_bukti'         => $this->input->post('tanggal'),
						'no_rekening'	    => $this->input->post('no_rekening'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->Pengeluaran_model_area->edit_plain($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Pengeluaran lainnya berhasil diupdate!');
					redirect(base_url('pengeluaran_lain_area'));
				}
			}
		}
		elseif($id==""){
			redirect('pengeluaran_lain_area');
		}
		else{
			$data['data_rekening'] 	= $this->Pengeluaran_model_area->get_rekening_kas();
			$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
            $data['data_akun'] 	    	= $this->Pengeluaran_model_area->get_akun();
			$data2['title']     		= "Pengeluaran lainnya ";
			$data['data_plain'] = $this->Pengeluaran_model_area->get_plain_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pengeluaran_lain_area/edit', $data);
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
		$this->Pengeluaran_model_area->delete_plainnya($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Pengeluaran lainnya berhasil dihapus.');	
		redirect('pengeluaran_lain_area');
	}

	public function potongan($nomor= 0){

		$nomor_new 	= str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$nocair_new = str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'no_kas' 			=> $this->input->post('no_kas'),
					'no_acc'			=> $this->input->post('no_acc'),
					'uraian'			=> $this->input->post('keterangan'),
					'nilai'				=> $this->proyek_model->number($this->input->post('nilai')),
					'created_at' 		=> date('Y-m-d : h:m:s'),
				);
				
				$data 				= $this->security->xss_clean($data);
				$result 			= $this->Pengeluaran_model_area->simpan_potongan_plain($data);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Potongan berhasil diinput!');
					redirect(base_url('pengeluaran_lain_area/potongan/'.$nomor),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Potongan gagal diinput!');
					redirect(base_url('pengeluaran_lain_area/potongan/'.$nomor),'refresh');
				}
			
		}
		else{
			$data['transfer'] = $this->Pengeluaran_model_area->get_plain_potongan_by_id($nomor);
			$data2['title'] 		= 'Potongan Pemindah Bukuan';
			// $data['proyek'] 		= $this->pdo_model->get_proyek_by_id($id_proyek);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pengeluaran_lain_area/potongan', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	public function datatable_json_rincian_potongan($nomor){				   					   
		$records['data'] = $this->Pengeluaran_model_area->get_potongan_plain_by_id($nomor);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pengeluaran_lain_area/delete_potongan/".$nomor.'/'.$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['no_acc'].'</font>',
				'<font size="2px">'.$row['nm_acc'].'</font>',
				'<font size="2px">'.$row['uraian'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['nilai'],2,',','.').'</font></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function delete_potongan($nomor= 0,$id = 0)
	{
		$this->rbac->check_operation_access('');
			
			$this->db->delete('ci_pengeluaran_lain_potongan', array('id' => $id, 'no_kas' =>  $nomor));

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pengeluaran_lain_area/potongan/'.$nomor));
		
	}
	
}

?>