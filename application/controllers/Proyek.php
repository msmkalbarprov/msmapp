<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/jnssubproyek_model', 'jnssubproyek_model');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('admin/perusahaan_model', 'perusahaan');
		$this->load->model('admin/pagu_model', 'pagu');
		$this->load->model('admin/dinas_model', 'dinas');
		$this->load->model('user/dinas_model', 'dinas_models');
		$this->load->model('admin/jnspagu_model', 'jnspagu');
		$this->load->model('admin/tipeproyek_model', 'tipeproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/proyek/proyek_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->proyek_model->get_all_proyek();
		// $data = array();

		// $i=0;
		// foreach ($records['data']   as $row) 
		// {  
			
		// 	$data[]= array(
		// 		++$i,
		// 		'<font size="2px"><b>Area</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_area'].'<br> <b>Sub Area</b> &nbsp;&nbsp;: '.$row['nm_sub_area'].'</font>',
		// 		'<font size="2px"><b>proyek</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_jns_proyek'].'<br> <b>Sub Proyek</b> &nbsp;: '.$row['nm_jns_sub_proyek'].'</font>',
		// 		'<font size="2px">'.$row['nm_perusahaan'].'</font>',
		// 		'<font size="2px">'.$row['nm_dinas'].'</font>',
		// 		'<font size="2px">'.$row['nm_jns_pagu'].'</font>',
		// 		'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('proyek/view/'.$row['id_proyek']).'"> <i class="fa fa-eye"></i></a>
		// 		<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('proyek/edit/'.$row['id_proyek']).'"> <i class="fa fa-pencil-square-o"></i></a>
		// 		<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("proyek/del/".$row['id_proyek']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
		// 	);
		// }
		// $records['data']=$data;
		echo json_encode($records);						   
	}

	public function tambah_proyek(){
		
		$this->rbac->check_operation_access('');

		$data['data_area'] 			= $this->area->get_area();
		$data['data_subarea'] 		= $this->subarea->get_subarea();
		$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
		$data['data_perusahaan'] 	= $this->perusahaan->get_perusahaan();
		$data['data_dinas'] 		= $this->dinas->get_dinas();
		$data['data_pagu'] 			= $this->pagu->get_pagu();


		if($this->input->post('submit')){
			$this->form_validation->set_rules('area', 'area', 'trim|required');
			$this->form_validation->set_rules('subarea', 'subarea', 'trim|required');
			$this->form_validation->set_rules('jnsproyek', 'Jenis Proyek', 'trim|required');
			$this->form_validation->set_rules('jnssubproyek', 'Jenis Sub Proyek', 'trim|required');
			$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required');
			$this->form_validation->set_rules('dinas', 'dinas', 'trim|required');
			$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			$this->form_validation->set_rules('jnspagu', 'Jenis Pagu', 'trim|required');
			$this->form_validation->set_rules('thn_ang', 'tahun Anggaran', 'trim|required');
			$this->form_validation->set_rules('jns_pph', 'Jenis PPH', 'trim|required');
			$this->form_validation->set_rules('paketproyek', 'Nama Paket Proyek', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('proyek/add'),'refresh');
			}
			else{
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'id_proyek'			=> $this->input->post('area').''.$this->input->post('subarea').''.$this->input->post('jnsproyek').''.$this->input->post('jnssubproyek').''.$this->input->post('perusahaan').''.$this->input->post('dinas').''.$this->input->post('thn_ang'),
					'kd_area' 			=> $this->input->post('area'),
					'kd_sub_area' 		=> $this->input->post('subarea'),
					'jns_proyek' 		=> $this->input->post('jnsproyek'),
					'jns_sub_proyek'	=> $this->input->post('jnssubproyek'),
					'kd_perusahaan' 	=> $this->input->post('perusahaan'),
					'kd_dinas' 			=> $this->input->post('dinas'),
					'thn_anggaran' 		=> $this->input->post('thn_ang'),
					'jns_pph' 			=> $this->input->post('jns_pph'),
					'loc' 				=> $this->input->post('loc'),
					'nm_paket_proyek' 	=> $this->input->post('paketproyek'),
					'catatan' 			=> $this->input->post('catatan'),
					'created_at' 		=> date('Y-m-d : h:m:s'),
					'updated_at' 		=> date('Y-m-d : h:m:s'),
				);

				$data2 = array(
					'username' 		=> $this->session->userdata('username'),
					'id_proyek'		=> $this->input->post('area').''.$this->input->post('subarea').''.$this->input->post('jnsproyek').''.$this->input->post('jnssubproyek').''.$this->input->post('perusahaan').''.$this->input->post('dinas').''.$this->input->post('thn_ang'),
					'nilai' 		=> $this->proyek_model->angka($this->input->post('nilai')),
					'jns_pagu' 		=> $this->input->post('jnspagu'),
					'created_at' 	=> date('Y-m-d : h:m:s'),
					'updated_at' 	=> date('Y-m-d : h:m:s'),
				);

				$data = $this->security->xss_clean($data);
				$data2 = $this->security->xss_clean($data2);
				$result = $this->proyek_model->add_proyek($data);
				if($result){
					$result2 = $this->proyek_model->add_proyek_rincian($data2);
					if ($result2){
						$this->activity_model->add_log(1);
						$this->session->set_flashdata('success', 'Proyek berhasil ditambahkan!');
						redirect(base_url('proyek'));
					}
					
					$this->session->set_flashdata('errors', 'Detail Proyek gagal ditambahkan!');
					redirect(base_url('proyek/add'));
				}else{
					$this->session->set_flashdata('errors', 'Proyek gagal ditambahkan!');
					redirect(base_url('proyek/add'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('user/proyek/proyek_add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}


	
	public function add_rincian_proyek($id = 0){
		
		$this->rbac->check_operation_access('');

		$data['data_jnspagu'] 			= $this->jnspagu->get_jnspagu();
		$data['data_tipeproyek'] 		= $this->tipeproyek->get_tipeproyek();


		if($this->input->post('submit')){
			$this->form_validation->set_rules('jnspagu', 'Jenis Pagu', 'trim|required');
			if ($this->input->post('jnspagu', TRUE)==2 || $this->input->post('jnspagu', TRUE)==3){
				$this->form_validation->set_rules('nodpa', 'No DPA/DPPA', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'tanggal DPA/DPPA', 'trim|required');
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}else if ($this->input->post('jnspagu', TRUE)==4){
				$this->form_validation->set_rules('tipeproyek', 'Tipe Proyek', 'trim|required');
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}else if ($this->input->post('jnspagu', TRUE)==5){
				$this->form_validation->set_rules('tipeproyek', 'Tipe Proyek', 'trim|required');
				$this->form_validation->set_rules('nodpa', 'No SPK', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'tanggal SPK', 'trim|required');
				$this->form_validation->set_rules('tanggal2', 'tanggal selesai SPK', 'trim|required');
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}else{
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}

			$data['id_proyek'] 		= $this->input->post('id_proyek', TRUE);
			$data['jnspagu'] 		= $this->input->post('jnspagu', TRUE);
            $data['tipeproyek'] 	= $this->input->post('tipeproyek', TRUE);
			$data['nodpa'] 			= $this->input->post('nodpa', TRUE);
			$data['nilai'] 			= $this->proyek_model->angka($this->input->post('nilai', TRUE));
			$data['tanggal'] 		= $this->input->post('tanggal', TRUE);
			$data['tanggal2'] 		= $this->input->post('tanggal2', TRUE);
            //file upload code 
            //set file upload settings 
            $config['upload_path']          = './uploads/';
            $config['allowed_types']        = '*';
            $config['max_size']             = '0';
            $this->load->library('upload', $config);
	            if ( ! $this->upload->do_upload('pic_file')){
	            	 $data['pic_file']='';
	                $this->proyek_model->save_proyek_rincian($data);
	                $this->session->set_flashdata('success','Data Rincian Proyek berhasil ditambahkan');
	               	redirect(base_url('proyek/edit/'.$this->input->post('id_proyek', TRUE)));

	            }else{

	                $upload_data = $this->upload->data();
	                $data['pic_file'] = $upload_data['file_name'];
					$this->proyek_model->save_proyek_rincian($data);
	                $this->session->set_flashdata('success', 'Data Rincian Proyek berhasil ditambahkan');
	                redirect(base_url('proyek/edit/'.$this->input->post('id_proyek', TRUE)));
	            }
		}
		else{

			$data['proyek'] = $this->proyek_model->get_proyek_by_id($id);

			$this->load->view('admin/includes/_header');
			$this->load->view('user/proyek/rincian_proyek_add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

	function get_subproyek(){
		$jnsproyek = $this->input->post('id',TRUE);
		$data = $this->jnssubproyek_model->get_subproyek($jnsproyek)->result();
		echo json_encode($data);
	}

	function get_dinas(){
		$subarea 	= $this->input->post('id',TRUE);
		$data 		= $this->proyek_model->get_dinas($subarea)->result();
		echo json_encode($data);
	}

	public function edit_proyek($id = 0){

		$data['data_area'] 			= $this->area->get_area();
		$data['data_subarea'] 		= $this->subarea->get_subarea();
		$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
		$data['data_perusahaan'] 	= $this->perusahaan->get_perusahaan();
		$data['data_dinas'] 		= $this->dinas->get_dinas();
		$data['data_pagu'] 			= $this->pagu->get_pagu();

		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
			$this->form_validation->set_rules('area', 'area', 'trim|required');
			$this->form_validation->set_rules('subarea', 'subarea', 'trim|required');
			$this->form_validation->set_rules('jnsproyek', 'Jenis Proyek', 'trim|required');
			$this->form_validation->set_rules('jnssubproyek', 'Jenis Sub Proyek', 'trim|required');
			$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required');
			$this->form_validation->set_rules('dinas', 'dinas', 'trim|required');
			$this->form_validation->set_rules('thn_ang', 'tahun Anggaran', 'trim|required');
			$this->form_validation->set_rules('jns_pph', 'Jenis PPH', 'trim|required');
			$this->form_validation->set_rules('paketproyek', 'Nama Paket Proyek', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('proyek/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'username' 			=> $this->session->userdata('user_id'),
					'kd_sub_area' 		=> $this->input->post('subarea'),
					'jns_proyek' 		=> $this->input->post('jnsproyek'),
					'jns_sub_proyek'	=> $this->input->post('jnssubproyek'),
					'kd_perusahaan' 	=> $this->input->post('perusahaan'),
					'kd_dinas' 			=> $this->input->post('dinas'),
					'thn_anggaran' 		=> $this->input->post('thn_ang'),
					'jns_pph' 			=> $this->input->post('jns_pph'),
					'loc' 				=> $this->input->post('loc'),
					'nm_paket_proyek' 	=> $this->input->post('paketproyek'),
					'catatan' 			=> $this->input->post('catatan'),
					'updated_at' 		=> date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->proyek_model->edit_proyek($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Data proyek berhasil diupdate!');
					redirect(base_url('proyek/edit/'.$id),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Data gagal diupdate!');
					redirect(base_url('proyek/edit/'.$id),'refresh');
				}
			}
		}
		else{
			$data['proyek'] = $this->proyek_model->get_proyek_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('user/proyek/proyek_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


public function edit_rincian_proyek($id = 0){

		$data['data_jnspagu'] 			= $this->jnspagu->get_jnspagu();
		$data['data_tipeproyek'] 		= $this->tipeproyek->get_tipeproyek();
		
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$this->form_validation->set_rules('jnspagu', 'Jenis Pagu', 'trim|required');
			if ($this->input->post('jnspagu', TRUE)==2 || $this->input->post('jnspagu', TRUE)==3){
				$this->form_validation->set_rules('nodpa', 'No DPA/DPPA', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'tanggal DPA/DPPA', 'trim|required');
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}else if ($this->input->post('jnspagu', TRUE)==4){
				$this->form_validation->set_rules('tipeproyek', 'Tipe Proyek', 'trim|required');
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}else if ($this->input->post('jnspagu', TRUE)==5){
				$this->form_validation->set_rules('tipeproyek', 'Tipe Proyek', 'trim|required');
				$this->form_validation->set_rules('nodpa', 'No SPK', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'tanggal SPK', 'trim|required');
				$this->form_validation->set_rules('tanggal2', 'tanggal selesai SPK', 'trim|required');
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}else{
				$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			}

			if ($this->input->post('tanggal2')==''){
				$tanggal2=null;
			}
				$data = array(
					'jns_pagu' 			=> $this->input->post('jnspagu'),
					'tipe_proyek' 		=> $this->input->post('tipeproyek'),
					'no_dokumen'		=> $this->input->post('nodpa'),
					'nilai' 			=> $this->proyek_model->angka($this->input->post('nilai')),
					'tanggal' 			=> $this->input->post('tanggal'),
					'tanggal2' 			=> $tanggal2,
					'username'			=> $this->session->userdata('username'),
					'updated_at'		=> date("Y-m-d h:i:s")
				);

				$old_pic_file 	= $this->input->post('old_pic_file');
				$id_proyek 		= $this->input->post('id_proyek');
				$path="uploads/";
				// pic_file
				if(!empty($_FILES['pic_file']['name']))
				{
					$this->functions->delete_file($old_pic_file);

					$result = $this->functions->files_insert($path, 'pic_file', 'files', '9097152');
					if($result['status'] == 1){
						$data['dokumen'] = $path.$result['msg'];
					}
					else{
						$this->session->set_flashdata('error', $result['msg']);
						redirect(base_url('proyek/rincian/edit/'.$id), 'refresh');
					}
				}

				$data = $this->security->xss_clean($data);
				$result = $this->proyek_model->edit_rincian_proyek($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'Rincian proyek berhasil diupdate!');
					redirect(base_url('proyek/edit/'.$id_proyek), 'refresh');
				}
		}
		else{
			$data['rincian_proyek'] = $this->proyek_model->get_rincian_proyek_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('user/proyek/rincian_proyek_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	public function view_proyek($id = 0){
			$this->rbac->check_operation_access(''); // check opration permission
			$data['proyek'] = $this->proyek_model->get_proyek_by_id($id);
			
			$this->load->view('admin/includes/_header');
			$this->load->view('user/proyek/proyek_view', $data);
			$this->load->view('admin/includes/_footer');
	}

	public function datatable_json_rincian($id){				   					   
		$records['data'] = $this->proyek_model->get_subproyek_by_id($id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			if ($row['dokumen']=="" || $row['dokumen']==null){
				$anchor='';
			}else{
				$anchor = anchor($row['dokumen'], 'preview','target="_blank"');
			}
			$data[]= array(
				++$i,
				$row['nm_jns_pagu'],
				$row['nm_tipe_proyek'],
				$row['tanggal'],
				$row['tanggal2'],
				number_format($row['nilai'],2,',','.'),
				$row['no_dokumen'],
				$anchor,
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('proyek/editrincian/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("proyek/deleterincian/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	function get_data_detail_edit(){
		$id = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_detail_proyek_by_id($id)->result();
		echo json_encode($data);
	}

	function get_data_detail_rincian_edit(){
		$id = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_detail_rincian_proyek_by_id($id)->result();
		echo json_encode($data);
	}


	public function delete_proyek($id = 0)
	{
		$this->rbac->check_operation_access('');


		$hasil=$this->db->query("SELECT count(*) as tot from ci_proyek_rincian a where a.jns_pagu <> 1 and id_proyek='$id'");
		foreach ($hasil->result_array() as $row){
			$result=$row['tot']; 
		}
		
		if ($result>0){
			$this->session->set_flashdata('errors', 'Data gagal dihapus');			
			redirect(base_url('proyek'));
		}else{
			$this->db->delete('ci_proyek', array('id_proyek' => $id));

			$this->db->delete('ci_proyek_rincian', array('id_proyek' => $id));	

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('proyek'));
		}
		
	}


	public function delete_rincian_proyek($id = 0)
	{
		$this->rbac->check_operation_access('');

			$hasil=$this->db->query("SELECT dokumen,id_proyek from ci_proyek_rincian a where id='$id'");
				foreach ($hasil->result_array() as $row){
					$dokumen 	=$row['dokumen']; 
					$id_proyek 	=$row['id_proyek']; 
					
				}

			$this->db->delete('ci_proyek_rincian', array('id' => $id));	
			if (strlen($dokumen)>8){
				$this->functions->delete_file($dokumen);	
			}
			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('proyek/edit/'.$id_proyek));
		
	}

}


?>