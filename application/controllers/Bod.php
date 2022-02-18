<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bod extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pq_model', 'pq_model');

		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/jnssubproyek_model', 'jnssubproyek_model');
		$this->load->model('admin/perusahaan_model', 'perusahaan');
		$this->load->model('admin/pagu_model', 'pagu');
		$this->load->model('admin/dinas_model', 'dinas');
		$this->load->model('admin/jnspagu_model', 'jnspagu');
		$this->load->model('admin/tipeproyek_model', 'tipeproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/bod/list_pq');
		$this->load->view('admin/includes/_footer');
	}

	
	public function datatable_json(){				   					   
		$records['data'] = $this->pq_model->get_all_pq();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  

			if($row['ppl']==0 || $row['ppl']==0.00){
				$nilai_pl = $row['npl'];
			}else{
				$nilai_pl = $row['ppl'];
			}
			
			$data[]= array(
				'<font size="2px"><b>Kode</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['kd_pqproyek'].'<br> <b>Proyek</b> &nbsp;: '.$row['nm_paket_proyek'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['spk'],2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['titipan'],2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($nilai_pl,2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['sub_total_a'],2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['hpp'],2,",",".").'</font></div>',
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('bod/view/'.$row['id_pqproyek']).'"> <i class="fa fa-eye"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}



public function datatable_json_hpp(){				   					   
		$records['data'] = $this->pq_model->get_all_pq_hpp();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_pqproyek'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<font size="2px">'.$row['nm_paket_proyek'].'</font>',
				'<span align="right"><font size="2px">'.number_format($row['sub_total_a'],2,",",".").'</font></span>',
				'<span align="right"><font size="2px">'.number_format($row['nilai_hpp'],2,",",".").'</font></span>',
				'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view_pq_operasional/'.str_replace("/","",$row['kd_pqproyek'])).'"> <i class="fa fa-eye"></i></a>
				<a title="HPP" class="update btn btn-sm btn-success" href="'.base_url('pq/add_hpp/'.str_replace("/","",$row['kd_pqproyek'])).'"> <i class="fa fa-forward"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}



	public function edit_pq_operasional(){
		
		$this->rbac->check_operation_access('');

		$data['data_jnspagu'] 			= $this->jnspagu->get_jnspagu();
		$data['data_tipeproyek'] 		= $this->tipeproyek->get_tipeproyek();


		if($this->input->post('type')==1){

			$data['kd_proyek'] 			= $this->input->post('kd_proyek', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
            $data['kd_item'] 			= $this->input->post('kd_item', TRUE);
			$data['uraian'] 			= $this->input->post('uraian', TRUE);
			$data['volume'] 			= $this->input->post('volume', TRUE);
			$data['satuan'] 			= $this->input->post('satuan', TRUE);
			$data['harga'] 				= $this->input->post('harga', TRUE);
			$data['total']				= $this->input->post('total', TRUE);

            $this->pq_model->save_pq_proyek_operasional($data);
            echo json_encode(array(
				"statusCode"=>200
			));

	          
		}
		else{
			$data['data_area'] 			= $this->area->get_area();
			$data['item_operasioanl'] = $this->pq_model->get_item_operasioanl();
			$data['data_mprojek'] 		= $this->proyek_model->get_mprojek();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_operasional_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}


	function get_subproyek(){
		$jnsproyek = $this->input->post('id',TRUE);
		$data = $this->jnssubproyek_model->get_subproyek($jnsproyek)->result();
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

			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('proyek/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					'username' 		=> $this->session->userdata('user_id'),
					'kd_sub_area' 	=> $this->input->post('subarea'),
					'jns_proyek' 	=> $this->input->post('jnsproyek'),
					'jns_sub_proyek'=> $this->input->post('jnssubproyek'),
					'kd_perusahaan' => $this->input->post('perusahaan'),
					'kd_dinas' 		=> $this->input->post('dinas'),
					'thn_anggaran' 	=> $this->input->post('thn_ang'),
					'jns_pph' 		=> $this->input->post('jns_pph'),
					'updated_at' 	=> date('Y-m-d : h:m:s'),
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

public function edit_rincian_pq_operasional($id = 0,$metod=0){
		
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$this->form_validation->set_rules('item_op', 'Item PQ', 'trim|required');
				$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
				$this->form_validation->set_rules('total', 'Total', 'trim|required');
				$this->form_validation->set_rules('volume', 'Volume', 'trim|required');
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$data = array(
					'kd_item' 			=> $this->input->post('item_op'),
					'kd_proyek' 		=> $this->input->post('projek'),
					'uraian' 			=> $this->input->post('uraian'),
					'volume'			=> $this->input->post('volume'),
					'harga' 			=> $this->proyek_model->number($this->input->post('harga')),
					'total' 			=> $this->proyek_model->number($this->input->post('total')),
					'satuan' 			=> $this->input->post('satuan'),
					'kd_area'			=> $this->input->post('area'),
					'username'			=> $this->session->userdata('username'),
					'updated_at'		=> date("Y-m-d h:i:s")
				);
				$id 					= $this->input->post('id_pq');
				$metod 					= $this->input->post('metod');
				$data = $this->security->xss_clean($data);
				$result = $this->pq_model->edit_pq_item($data, $id);
				if($result){
					if ($metod=='add_operasional'){
						$this->session->set_flashdata('success', 'Item PQ berhasil diupdate!');
					redirect(base_url('pq/'.$metod), 'refresh');
					}else{
						$this->session->set_flashdata('success', 'Item PQ berhasil diupdate!');
					redirect(base_url('pq/'.$metod.'/'.$id), 'refresh');
					}
					
				}
		}
		else{
			$data['rincian_pq_operasional'] = $this->pq_model->get_item_pq_by_id($id);
			$data['data_area'] 				= $this->area->get_area();
			$data['item_operasioanl'] 		= $this->pq_model->get_item_operasioanl();
			$data['data_mprojek'] 			= $this->proyek_model->get_mprojek();

			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_operasional_rinci_edit', $data);
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
				$data = array(
					'jns_pagu' 			=> $this->input->post('jnspagu'),
					'tipe_proyek' 		=> $this->input->post('tipeproyek'),
					'no_dokumen'		=> $this->input->post('nodpa'),
					'nilai' 			=> $this->proyek_model->angka($this->input->post('nilai')),
					'tanggal' 			=> $this->input->post('tanggal'),
					'tanggal2' 			=> $this->input->post('tanggal2'),
					'nm_paket_proyek' 	=> $this->input->post('paketproyek'),
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


public function setuju(){
		
		$this->rbac->check_operation_access('');
		$id_pqproyek 	= $this->input->post('id_pqproyek', TRUE);
		$catatan 		= $this->input->post('catatan', TRUE);

		if($this->input->post('type')==1){
			$data['catatan'] 			= $this->input->post('catatan', TRUE);
            $data['status'] 			= 1;
			$this->pq_model->save_pqngesahan_pq($data, $id_pqproyek);
            echo json_encode(array(
				"statusCode"=>200
			));
		}

		if($this->input->post('type')==2){
			$data['catatan'] 			= $this->input->post('catatan', TRUE);
            $data['status'] 			= 2;
			$this->pq_model->save_pqngesahan_pq($data, $id_pqproyek);
            echo json_encode(array(
				"statusCode"=>200
			));
		}
	}


	public function view_pq($id = 0){
			$this->rbac->check_operation_access(''); // check opration permission
			$data['pqproyek'] 	= $this->pq_model->get_pq_by_id($id);
			$data['proyek'] 	= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
			$this->load->view('admin/includes/_header');
			$this->load->view('user/bod/view_pq', $data);
			$this->load->view('admin/includes/_footer');
	}

	

public function datatable_json_hpp_rinci(){				   				
		$pqproyek = $this->uri->segment(4);	   
		$records['data'] = $this->pq_model->get_pq_hpp_rinci($pqproyek);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				++$i,
				$row['kd_item'],
				'<font size="2px"><b>Item</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_item'].'<br> <b>Uraian</b> &nbsp;: '.$row['keterangan'].'</font>',
				$row['volume'],
				$row['satuan'],
				$row['periode'],
				'<div class="text-right">'.number_format($row['harga'],2,',','.').'</div>',
				'<div class="text-right">'.number_format($row['total'],2,',','.').'</div>',
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit_hpp/'.$row['id']."/".$row['id_pqproyek']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pq/del_hpp/".$row['id']."/".$row['id_pqproyek']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


public function datatable_json_hpp_rinci_view(){				   				
		$pqproyek = $this->uri->segment(3);	   
		$records['data'] = $this->pq_model->get_pq_hpp_rinci($pqproyek);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_item'].'</font>'.'</font>',
				'<font size="2px"><b>Item</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_item'].'<br> <b>Uraian</b> &nbsp;: '.$row['keterangan'].'</font>',
				$row['volume'].'</font>',
				'<font size="2px">'.$row['satuan'].'</font>',
				'<font size="2px">'.$row['periode'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['harga'],2,',','.').'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['total'],2,',','.').'</font></div>'
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

	function get_data_item_edit(){
		$id = $this->input->post('id',TRUE);
		$data = $this->pq_model->get_detail_item_pq_by_id($id)->result();
		echo json_encode($data);
	}

	function get_data_hpp_edit(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->pq_model->get_detail_hpp_by_id($id)->result();
		echo json_encode($data);
	}

	function get_projek(){
		$area = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_project($area)->result();
		echo json_encode($data);
	}


	function get_proyek_by_area_subarea(){
		$subarea 	= $this->input->post('id',TRUE);
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->pq_model->get_proyek_by_area_subarea($subarea,$area)->result();
		echo json_encode($data);
	}

	function get_pqproyek(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pq_model->get_pqproyek_by($area)->result();
		echo json_encode($data);
	}

	function get_sisapqproyek(){
		$id 	= $this->input->post('id',TRUE);
		$data 	= $this->pq_model->get_sisapqproyek($id)->result();
		echo json_encode($data);
	}



}


?>