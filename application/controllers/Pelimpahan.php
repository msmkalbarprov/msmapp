<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelimpahan extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/pelimpahan_model', 'pelimpahan_model');
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
		$data['title'] = 'pelimpahan';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/pelimpahan/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	function ambil_tunai(){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'Ambil Kas Tunai';
		$this->load->view('admin/includes/_header');
		$this->load->view('user/pelimpahan/tunai', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->pelimpahan_model->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pelimpahan/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pelimpahan/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Potongan" class="update btn btn-sm btn-secondary" href="'.base_url('pelimpahan/potongan/'.str_replace("/","",$row['no_bukti'])).'"> <i class="fa fa-percent"></i></a>';
		
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['tgl_pelimpahan'],
				$row['nm_pegawai_asal'],
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
				$this->form_validation->set_rules('kd_pegawai', 'Pegawai Tujuan', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai_asal', 'Pegawai Asal', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

                $nilai = $this->proyek_model->number($this->input->post('nilai'));
                $saldo = $this->proyek_model->number($this->input->post('saldo'));

                if ($nilai>$saldo){
                    $data = array(
						'errors' => 'Saldo anda tidak cukup'
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pelimpahan/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pelimpahan/add'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		    => $this->input->post('area'),
						'no_bukti' 		    => $this->input->post('no_kas'),
						'jenis' 		    => 'area',
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'kd_pegawai_asal'   => $this->input->post('kd_pegawai_asal'),
						'tgl_pelimpahan'    => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$this->pelimpahan_model->simpan_pelimpahan($data);
						$urutan 					= $this->input->post('no_kas', TRUE);
						$kd_pegawai 				= $this->input->post('kd_pegawai_asal', TRUE);

						$data2 = array(
							'no_spj' => $urutan
						);
						$result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);

					if($result){
						
						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Saldo Awal berhasil ditambahkan!');
						redirect(base_url('pelimpahan/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pelimpahan/add');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pelimpahan_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

	function get_pegawai_kas_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pelimpahan_model->get_pegawai_tunai_by_area($area)->result();
		echo json_encode($data);
	}

    function get_kas(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spj_model->get_kas($id)->result();
		echo json_encode($data);
	}
	function get_nomor(){
		$kd_pegawai 		= $this->input->post('kd_pegawai',TRUE);
		$data 		= $this->spjpegawai_model->get_nomor($kd_pegawai)->result();
		echo json_encode($data);
	}
	function get_kas_area(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spjpegawai_model->get_kas($id)->result();
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
			$this->form_validation->set_rules('kd_pegawai_asal', 'Pegawai', 'trim|required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

            $nilai = $this->proyek_model->number($this->input->post('nilai'));
            $saldo = $this->proyek_model->number($this->input->post('saldo'));
			if ($nilai>$saldo){
                $data = array(
                    'errors' => 'Saldo anda tidak cukup'
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('pelimpahan/add'),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pelimpahan/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					    'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'kd_pegawai_asal' 	=> $this->input->post('kd_pegawai_asal'),
						'tgl_pelimpahan'    => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pelimpahan_model->edit_pelimpahan($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Saldo Awal berhasil diupdate!');
					redirect(base_url('pelimpahan/index'));
				}
			}
		}
		elseif($id==""){
			redirect('pelimpahan/index');
		}
		else{
			$data2['title'] = "Pelimpahan";
			$data['bank'] = $this->pelimpahan_model->get_pelimpahan_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pelimpahan/edit', $data);
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
		$query="SELECT no_bukti from ci_pelimpahan where id='$id'";
		$hasil = $this->db->query($query);
		$nomor = $hasil->row('no_bukti');

		$this->db->delete('ci_pelimpahan_potongan', array('no_kas' =>  $nomor, 'no_kas <>' =>  null));

		$this->pelimpahan_model->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Pelimpahan berhasil dihapus.');	
		redirect('pelimpahan/index');
	}

	// POTONGAN
	public function potongan($nomor= 0){

		$nomor_new 	= str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$nocair_new = str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'no_kas' 			=> $this->input->post('no_kas'),
					'rek_asal' 			=> $this->input->post('rek_asal'),
					'no_acc'			=> $this->input->post('no_acc'),
					'uraian'			=> $this->input->post('keterangan'),
					'nilai'				=> $this->proyek_model->number($this->input->post('nilai')),
					'created_at' 		=> date('Y-m-d : h:m:s'),
				);
				
				$data 				= $this->security->xss_clean($data);
				$result 			= $this->pelimpahan_model->simpan_potongan_pelimpahan($data);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Potongan berhasil diinput!');
					redirect(base_url('pelimpahan/potongan/'.$nomor),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Potongan gagal diinput!');
					redirect(base_url('pelimpahan/potongan/'.$nomor),'refresh');
				}
			
		}
		else{
			$data['transfer'] = $this->pelimpahan_model->get_pelimpahan_potongan_by_id($nomor);
			$data2['title'] 		= 'Potongan Pelimpahan';
			// $data['proyek'] 		= $this->pdo_model->get_proyek_by_id($id_proyek);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pelimpahan/potongan', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	public function datatable_json_rincian_potongan($nomor){				   					   
		$records['data'] = $this->pelimpahan_model->get_potongan_pelimpahan_by_id($nomor);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pelimpahan/delete_potongan/".$nomor.'/'.$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

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
			$this->db->delete('ci_pelimpahan_potongan', array('id' => $id, 'no_kas' =>  $nomor));
			$this->activity_model->add_log(3);
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pelimpahan/potongan/'.$nomor));
		
	}
	// POTONGAN


}

?>