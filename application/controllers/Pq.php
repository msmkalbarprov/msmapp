<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pq extends MY_Controller {

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
		$this->load->view('user/pq/pq_list');
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
			if($row['revisi']>=1){
				$revisi="Rev ".$row['revisi'];
			}else{
				$revisi="";
			}

			if($row['status']==1){
				$statuspq="<br> <b>Status</b> &nbsp;: <span class='text-success'>Disetujui</span>";
				$tombol='
				<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view/'.$row['id_pqproyek']).'"> <i class="fa fa-eye"></i></a>
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pq/cetak_pq_satuan/'.str_replace("/","",$row['id_pqproyek'])).'" target="_blank" > <i class="fa fa-print"></i></a>';
			}else if($row['status']==2 && $row['status_revisi']==0){
				$statuspq="<br> <b>Status</b> &nbsp;: <span class='text-danger'>".$revisi." (Ditolak)</span>";
				$tombol='
				<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view/'.$row['id_pqproyek']).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit HPP" class="update btn btn-sm btn-success" href="'.base_url('pq/add_hpp/'.str_replace("/","",$row['id_pqproyek'])).'"> <i class="fa fa-list"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit/'.$row['id_pqproyek']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pq/cetak_pq_satuan/'.str_replace("/","",$row['id_pqproyek'])).'" target="_blank" > <i class="fa fa-print"></i></a>
				<a title="Ajukan Revisi" class="update btn btn-outline-success btn-sm" href="'.base_url('pq/revisi/'.str_replace("/","",$row['id_pqproyek'])).'"> <i class="fa fa-upload"></i></a>';
			}else if($row['status']==2 && $row['status_revisi']==1){
				$statuspq="<br> <b>Status</b> &nbsp;: <span class='text-primary'>".$revisi." (Revisi)</span>";
				$tombol='
				<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view/'.$row['id_pqproyek']).'"> <i class="fa fa-eye"></i></a>
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pq/cetak_pq_satuan/'.str_replace("/","",$row['id_pqproyek'])).'" target="_blank" > <i class="fa fa-print"></i></a>
				<a title="Revisi Sudah Diajukan" class="update btn btn-outline-success btn-sm disabled" href="'.base_url('pq/revisi/'.str_replace("/","",$row['id_pqproyek'])).'"> <i class="fa fa-upload"></i></a>';
			}else if($row['status']==3){
				$statuspq="<br> <b>Status</b> &nbsp;: <span class='text-primary'>".$revisi." (Direvisi)</span>";
				$tombol='
				<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view/'.$row['id_pqproyek']).'"> <i class="fa fa-eye"></i></a>
				<a title="Tambah HPP" class="update btn btn-sm btn-success" href="'.base_url('pq/add_hpp/'.str_replace("/","",$row['id_pqproyek'])).'"> <i class="fa fa-list"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit/'.$row['id_pqproyek']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pq/cetak_pq_satuan/'.str_replace("/","",$row['id_pqproyek'])).'" target="_blank" > <i class="fa fa-print"></i></a>';
			}else{
				$statuspq="<br> <b>Status</b> &nbsp;: <span class='text-danger'>Belum disetujui</span>";
				$tombol='
				<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view/'.$row['id_pqproyek']).'"> <i class="fa fa-eye"></i></a>
				<a title="Tambah HPP" class="update btn btn-sm btn-success" href="'.base_url('pq/add_hpp/'.str_replace("/","",$row['id_pqproyek'])).'"> <i class="fa fa-list"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit/'.$row['id_pqproyek']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pq/delete/".$row['id_pqproyek']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pq/cetak_pq_satuan/'.str_replace("/","",$row['id_pqproyek'])).'" target="_blank" > <i class="fa fa-print"></i></a>';
			}

			
			
			$data[]= array(
				'<font size="2px"><b>Kode</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['kd_pqproyek'].'&nbsp;<br> 
				<b>Area</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['area'].'&nbsp;<br>
				<b>Proyek</b> &nbsp;: '.$row['nm_paket_proyek'].$statuspq.'<br><b>Pagu</b>&nbsp; : '.$row['pagu'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['spk'],2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['titipan'],2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($nilai_pl,2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['sub_total_a'],2,",",".").'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['hpp'],2,",",".").'</font></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	// <a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit/'.$row['id_pqproyek']).'"> <i class="fa fa-pencil-square-o"></i></a>

	public function datatable_json_pq_op(){				   					   
		$records['data'] = $this->pq_model->get_all_pq_op();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			
			if($row['status']=='1'){
				$tombol = '<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view_pq_operasional/'.str_replace("/","",$row['kode'])).'"> <i class="fa fa-eye"></i></a>';
			}else{
				$tombol = '<a title="View" class="view btn btn-sm btn-info" href="'.base_url('pq/view_pq_operasional/'.str_replace("/","",$row['kode'])).'"> <i class="fa fa-eye"></i></a>
				<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit_pq_operasional/'.str_replace("/","",$row['kode'])).'"> <i class="fa fa-pencil-square-o"></i></a>';
			}

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kode'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
				$tombol
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

	// <a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("proyek/del/".$row['kode']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>

	public function tambah_pq(){
		
		$this->rbac->check_operation_access('');
		$data['data_mprojek'] 		= $this->proyek_model->get_mprojek();
		$data['data_area'] 			= $this->area->get_area();


		if($this->input->post('submit')){
			$this->form_validation->set_rules('area', 'area', 'trim|required');
			$this->form_validation->set_rules('subarea_1', 'subarea', 'trim|required');
			$this->form_validation->set_rules('projek', 'Proyek', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pq/add'),'refresh');
			}
			else{
				$data = array(
					'id_pqproyek'		=> 'PQ'.str_replace("/","",$this->input->post('projek')),
					'kd_pqproyek'		=> 'PQ/'.$this->input->post('projek'),
					'id_proyek' 		=> $this->input->post('projek'),
					'kd_area' 			=> $this->input->post('area'),
					'kd_sub_area' 		=> $this->input->post('subarea_1'),
					'nm_paket_proyek'	=> $this->input->post('paketproyek'),
					'ppn' 				=> $this->proyek_model->number($this->input->post('nilaippn')),
					'pph'				=> $this->proyek_model->number($this->input->post('nilaipph')),
					'spk_net' 			=> $this->proyek_model->number($this->input->post('nilaipend_nett')),
					'titipan' 			=> $this->proyek_model->number($this->input->post('titipan')),
					'ppntitipan' 		=> $this->proyek_model->number($this->input->post('nilaippntitipan')),
					'pphtitipan' 		=> $this->proyek_model->number($this->input->post('nilaipphtitipan')),
					'titipan_net' 		=> $this->proyek_model->number($this->input->post('titipan_net')),
					'status_titipan' 	=> $this->input->post('s_titip'),
					'status_ppn' 		=> $this->input->post('s_ppn'),
					'status_pph' 		=> $this->input->post('s_pph'),
					'status_infaq' 		=> $this->input->post('s_infaq'),
					'infaq' 			=> $this->proyek_model->number($this->input->post('infaq')),
					'pendapatan_nett'	=> $this->proyek_model->number($this->input->post('nilai_pend_net_s_titipan')),
					'persen_pl' 		=> $this->proyek_model->number($this->input->post('plpersen')),
					'npl' 				=> $this->proyek_model->number($this->input->post('pl')),
					'ppl' 				=> $this->proyek_model->number($this->input->post('pl_bulat')),
					'sub_total_a'		=> $this->proyek_model->number($this->input->post('nilai_pend_net_s_pl')),
					'nalokasi_ho'		=> $this->proyek_model->number($this->input->post('al_ho')),
					'username' 			=> $this->session->userdata('username'),
					'created_at' 		=> date('Y-m-d : h:m:s'),
					'updated_at' 		=> date('Y-m-d : h:m:s'),
				);

				$data 		= $this->security->xss_clean($data);
				$result 	= $this->pq_model->add_pq($data);
				
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'PQ Proyek berhasil ditambahkan!');
					redirect(base_url('pq'));
				}else{
					$this->session->set_flashdata('errors', 'PQ Proyek gagal ditambahkan!');
					redirect(base_url('pq/add'));
				}
			}
		}
		else{
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}


	
	public function add_pq_operasional(){
		
		$this->rbac->check_operation_access('');

		$data['data_jnspagu'] 			= $this->jnspagu->get_jnspagu();
		$data['data_tipeproyek'] 		= $this->tipeproyek->get_tipeproyek();


		if($this->input->post('type')==1){
			$data['kd_area'] 			= $this->input->post('area', TRUE);
            $data['kd_item'] 			= $this->input->post('kd_item', TRUE);
			$data['uraian'] 			= $this->input->post('uraian', TRUE);
			$data['volume'] 			= $this->input->post('volume', TRUE);
			$data['satuan'] 			= $this->input->post('satuan', TRUE);
			$data['harga'] 				= $this->input->post('harga', TRUE);
			$data['total']				= $this->input->post('total', TRUE);

            $this->pq_model->save_pq_proyek_operasional($data);
            echo json_encode(
            	array(
				"statusCode"=>200
			));

	          
		}
		else{
			$data['data_area'] 			= $this->area->get_area();
			$data['item_operasioanl'] = $this->pq_model->get_item_operasioanl();
			$data['data_mprojek'] 		= $this->proyek_model->get_mprojek();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_operasional_add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}


	public function add_hpp($idpqproyek){
		
		$this->rbac->check_operation_access('');

		if($this->input->post('type')==1){
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['id_pqproyek']		= $this->input->post('projek', TRUE);
            $data['kd_item'] 			= $this->input->post('kd_item', TRUE);
            $data['jenis_tk'] 			= $this->input->post('jenis_tk', TRUE);
			$data['keterangan']			= $this->input->post('uraian', TRUE);
			$data['volume'] 			= $this->input->post('volume', TRUE);
			$data['satuan'] 			= $this->input->post('satuan', TRUE);
			$data['periode'] 			= $this->input->post('periode', TRUE);
			$data['harga'] 				= $this->input->post('harga', TRUE);
			$data['total']				= $this->input->post('total', TRUE);

            $this->pq_model->save_pq_hpp($data);

    //         if($result){
				// 	// Activity Log 
				// 	$this->activity_model->add_log(2);

				// 	$this->session->set_flashdata('success', 'Data HPP Berhasil ditambahkan!');
				// 	redirect(base_url('pq/add_hpp/'.$idpqproyek),'refresh');
				// }
            echo json_encode(array(
				"statusCode"=>200
			));

	          
		}
		else{
			$data['data_area'] 			= $this->area->get_area();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek_by_id($idpqproyek);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/hpp/add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
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

public function revisi($id='')
{		
	$data = array(

					'status_revisi' 	=> 1
				);

		$result = $this->pq_model->ajukan_revisi($data, $id);
		if($result){
			
				$this->session->set_flashdata('success', 'PQ berhasil diajukan, silahkan tunggu proses persetujuan BOD!');
				redirect(base_url('pq'), 'refresh');
			
		}
}
	public function ubah_hpp($id = 0,$idpqproyek=0){
		
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$this->form_validation->set_rules('item_hpp', 'Item HPP', 'trim|required');
				$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
				$this->form_validation->set_rules('total', 'Total', 'trim|required');
				$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
				$this->form_validation->set_rules('volume', 'Volume', 'trim|required');
				$this->form_validation->set_rules('projek', 'PQ Proyek', 'trim|required');
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$data = array(

					'kd_item' 			=> $this->input->post('item_hpp'),
					'id_pqproyek' 		=> $this->input->post('idpqproyek'),
					'keterangan'		=> $this->input->post('uraian'),
					'jenis_tk'			=> $this->input->post('jenis_tk'),
					'volume'			=> $this->input->post('volume'),
					'periode'			=> $this->input->post('periode'),
					'satuan' 			=> $this->input->post('satuan'),
					'harga' 			=> $this->proyek_model->number($this->input->post('harga')),
					'total' 			=> $this->proyek_model->number($this->input->post('total')),
					'username'			=> $this->session->userdata('username'),
					'updated_at'		=> date("Y-m-d h:i:s")
				);
				$id 					= $this->input->post('id');
				$id_pqproyek			= $this->input->post('idpqproyek');
				$data = $this->security->xss_clean($data);
				
				$result = $this->pq_model->edit_hpp_item($data, $id, $id_pqproyek);
				if($result){
					
						$this->session->set_flashdata('success', 'Item PQ berhasil diupdate!');
					redirect(base_url('pq/add_hpp/'.$id_pqproyek), 'refresh');
					
				}
		}
		else{
			$data['data_hpp_rinci'] 		= $this->pq_model->get_hpp_by_id($id,$idpqproyek);
			$data['data_area'] 				= $this->area->get_area();
			$data['item_hpp'] 				= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek_by_id($idpqproyek);

			$this->load->view('admin/includes/_header');
			$this->load->view('user/hpp/edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

	public function view_pq_operasional(){
		
		$this->rbac->check_operation_access('');

			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_operasional_view');
			$this->load->view('admin/includes/_footer');
		
	}

	function get_subproyek(){
		$jnsproyek = $this->input->post('id',TRUE);
		$data = $this->jnssubproyek_model->get_subproyek($jnsproyek)->result();
		echo json_encode($data);
	}


	public function edit_pq($id = 0){
		$data['data_area'] 			= $this->area->get_area();
		$data['data_subarea'] 		= $this->subarea->get_subarea();
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
			
				$data = array(
					'status_ppn' 		=> $this->input->post('s_ppn'),
					'ppn' 				=> $this->proyek_model->number($this->input->post('nilaippn')),
					'pph'				=> $this->proyek_model->number($this->input->post('nilaipph')),
					'spk_net' 			=> $this->proyek_model->number($this->input->post('nilaipend_nett')),
					
					'titipan' 			=> $this->proyek_model->number($this->input->post('titipan')),
					'ppntitipan' 		=> $this->proyek_model->number($this->input->post('nilaippntitipan')),
					'pphtitipan' 		=> $this->proyek_model->number($this->input->post('nilaipphtitipan')),
					'titipan_net' 		=> $this->proyek_model->number($this->input->post('titipan_net')),
					
					'status_titipan' 	=> $this->input->post('s_titip'),
					'status_infaq' 		=> $this->input->post('s_infaq'),
					'status_pph' 		=> $this->input->post('s_pph'),
					'infaq' 			=> $this->proyek_model->number($this->input->post('infaq')),
					'pendapatan_nett'	=> $this->proyek_model->number($this->input->post('nilai_pend_net_s_titipan')),

					'persen_pl' 		=> $this->proyek_model->number($this->input->post('plpersen')),
					'npl' 				=> $this->proyek_model->number($this->input->post('pl')),
					'ppl' 				=> $this->proyek_model->number($this->input->post('pl_bulat')),
					'sub_total_a'		=> $this->proyek_model->number($this->input->post('nilai_pend_net_s_pl')),

					'nalokasi_ho'		=> $this->proyek_model->number($this->input->post('al_ho')),

					'username' 			=> $this->session->userdata('username'),
					'created_at' 		=> date('Y-m-d : h:m:s'),
					'updated_at' 		=> date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->pq_model->edit_pq($data, $id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Data PQ berhasil diupdate!');
					redirect(base_url('pq/edit/'.$id),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Data PQ gagal diupdate!');
					redirect(base_url('pq/edit/'.$id),'refresh');
				}
		}
		else{
			$data['pqproyek'] 	= $this->pq_model->get_pq_by_id($id);
			$data['proyek'] 	= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_edit', $data);
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


	public function view_pq($id = 0){
			$this->rbac->check_operation_access(''); // check opration permission
			$data['pqproyek'] 	= $this->pq_model->get_pq_by_id($id);
			$data['proyek'] 	= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pq/pq_view', $data);
			$this->load->view('admin/includes/_footer');
	}

	public function datatable_json_operasional($ids){				   					   
		$records['data'] = $this->pq_model->get_pq_operasional($ids);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				++$i,
				$row['kd_item'],
				$row['nm_item'],
				$row['uraian'],
				$row['volume'],
				$row['satuan'],
				number_format($row['harga'],2,',','.'),
				number_format($row['total'],2,',','.'),
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit_rincian_pq_operasional/'.$row['id_pq_operasional']).'/'.$this->uri->segment(3).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pq/delete_rincian_pq_operasional/".$row['id_pq_operasional']).'/'.$this->uri->segment(3).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
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
				'<font size="2px"><b>Item</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_item'].'<br> <b>Uraian</b> &nbsp;: '.$row['keterangan'].'<br> <b>Jenis</b> &nbsp;: '.$row['jenis_tk'].'</font>',
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


			if($row['kd_item']==5010202){
				$uraian= '<font size="2px"><b>Item</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_item'].'<br> <b>Uraian</b> &nbsp;: '.$row['keterangan'].'<br> <b>Jenis</b> &nbsp;: '.$row['jenis_tk'].'</font>';
			}else{
				$uraian= '<font size="2px"><b>Item</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_item'].'<br> <b>Uraian</b> &nbsp;: '.$row['keterangan'].'</font>';
			}

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_item'].'</font>'.'</font>',
				$uraian,
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





	public function datatable_json_operasional_edit($id='',$url=''){				   					   
		$records['data'] = $this->pq_model->get_pq_operasional($id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_item'].'</font>',
				'<font size="2px">'.$row['nm_item'].'</font>',
				'<font size="2px">'.$row['uraian'].'</font>',
				'<font size="2px">'.$row['volume'].'</font>',
				'<font size="2px">'.$row['satuan'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['harga'],2,',','.').'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['total'],2,',','.').'</font></div>',
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit_rincian_pq_operasional/'.$row['id_pq_operasional']).'/'.$this->uri->segment(4).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pq/delete_rincian_pq_operasional/".$row['id_pq_operasional']).'/'.$this->uri->segment(4).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	public function datatable_json_operasional_view($id=0){				   					   
		$records['data'] = $this->pq_model->get_pq_operasional_view($id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_item'].'</font>',
				'<font size="2px">'.$row['nm_item'].'</font>',
				'<font size="2px">'.$row['uraian'].'</font>',
				'<font size="2px">'.$row['volume'].'</font>',
				'<font size="2px">'.$row['satuan'].'</font>',
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


	function get_proyek_by_area_subarea_edit(){
		$subarea 	= $this->input->post('id',TRUE);
		$area 		= $this->input->post('area',TRUE);
		$id_pqproyek= $this->input->post('id_pqproyek',TRUE);
		$data 		= $this->pq_model->get_proyek_by_area_subarea_edit($subarea,$area,$id_pqproyek)->result();
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


	function get_area_by_pqprojectid(){
		$id 	= $this->input->post('id',TRUE);
		$data 	= $this->pq_model->get_area_by_pqprojectid($id)->result();
		echo json_encode($data);
	}

	public function delete_pq($id = 0)
	{
		$this->rbac->check_operation_access('');

		
			$this->db->delete('ci_pendapatan', array('id_pqproyek' => $id));

			$this->db->delete('ci_hpp', array('id_pqproyek' => $id));	

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pq'));
		
	}


	public function hapus_hpp($id = 0)
	{
			$this->rbac->check_operation_access('');
			$id_pqproyek = $this->uri->segment(4);	
			$this->db->delete('ci_hpp', array('id' => $id));	

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pq/add_hpp/'.$id_pqproyek));
		
	}


	public function delete_rincian_pq_operasional($id = 0)
	{	
		$metod 			= $this->uri->segment(4);
		$id_pqop 	= $this->uri->segment(3);
		$this->rbac->check_operation_access('');
			$this->db->delete('ci_pq_operasional', array('id_pq_operasional' => $id));	
			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pq/'.$metod.'/'.$id_pqop));
		
	}
 
	public function cetak_pq_satuan($id=0)
	{	
		$data['pqproyek'] 		= $this->pq_model->get_pq_by_id($id);
		$data['proyek'] 		= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
		$data['hpp'] 			= $this->pq_model->get_cetak_hpp_by_id($id);
		$data['operasional']	= $this->pq_model->get_operasional_by_id($id);
		$data['marketing']		= $this->pq_model->get_marketing_by_id($id);
		$data['pendapatan_area']	= $this->pq_model->get_pendapatanarea($id);
		// $html = $this->load->view('user/pq/pq_view', $data);
		// $cRet = $this->load->view('user/pq/cetak_pq_satuan',$data);
		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'portrait');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/pq/cetak_pq_satuan', $data);
                break;
            case 1;
                echo "<title>Mapping Kode program</title>";
                echo $this->load->view('user/pq/cetak_pq_satuan', $data);
               break;
        }

	}

	public function cetak_pq($id=0,$tahun=0)
	{	
		$map1					= $this->pq_model->get_map1($id);
		$marketing				= $this->pq_model->get_operasional_by_area($id, $tahun);
		$pendapatan_area		= $this->pq_model->get_pendapatanarea_by_year($id,$tahun);
		$spkperyear				= $this->pq_model->get_spk_by_year($id,$tahun);


		$html="";
		$html.='<h4>Informasi Pekerjaan :</h4><table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  ';

  foreach($map1 as $map1){
  	$urut 		= $map1["urut"];
  	$kode 		= $map1["kode"];
  	$kolom 		= $map1["kolom"];
  	$kd_item 	= $map1["kd_item"];
  	
  	if ($kode==2 && $urut==1){
  		$html.='<tr>
    			<td colspan="4">'.$map1["nama_map"].'</td>';
    	
    	$jumlahkolom=0;
    	$i=1;
    	$pagu=0;
    	$proyek = $this->pq_model->get_proyek_by_area($map1["kolom"], $id);
    	foreach($proyek as $proyek){
    		$jumlahkolom = $i++;

    		if ($map1["kolom"]=='nilai_pagu'){
    			$pagu = $pagu+$proyek['nilai_pagu'];
    			$html.='<td colspan="2" align="center">'.number_format($proyek[$map1["kolom"]],2,",",".").'</td>';
    		}else if ($map1["kolom"]=='masa_kontrak' || $map1["kolom"]=='lama_pekerjaan'){
    			$html.='<td colspan="2" align="center">'.$proyek[$map1["kolom"]].' Bulan </td>';
    		}else{
    			$html.='<td colspan="2" align="center">'.$proyek[$map1["kolom"]].'</td>';	
    		}
    		
    	}

    	if ($map1["kolom"]=='nilai_pagu'){
    		$html.='<td colspan="2" align="center" style="background: yellow;">'.number_format($pagu,2,",",".").'</td>';
    	}else if($map1["kolom"]=='nm_paket_proyek'){
    		$html.='<td colspan="2" align="center" style="background: yellow;">REKAPITULASI</td>';
    	}else{
    		$html.='<td colspan="2" align="center" style="background: yellow;"></td>';
    	}
  		$html.='</tr>';
  	}

  	if ($kode=='3'){
  		$html .='<tr>
				    <td colspan="4" align="center" style="background: black;color: white;border-right:white;">
				      '.$map1["nama_map"].'
				    </td>';
			for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: black;border-right:white; color: white;">Rp</td>
				    <td align="center" style="background: black;border-left:white;color: white;">%</td>';
				}
					$html.='<td align="center" style="background: black;border-right:white; color: white;">Rp</td>
				    <td align="center" style="background: black;border-left:white;color: white;">%</td></tr>';
  	}
$colspan1=($jumlahkolom*2)+4+2;
  	if ($kode=='4') {
  		$html .='<tr>
    <td colspan="'.$colspan1.'" >
      '.$map1["nama_map"].'
    </td>
  </tr>';
  	}

  	if ($kode=='4A') {
		  		
		  		$html .='<tr>
		    <td colspan="4">
		      2. PENDAPATAN NETT
		    </td>';
		    $pq = $this->pq_model->get_pq_by_area($kolom, $id);
    	foreach($pq as $pqproyek){
    		$pendapatan_nett=$pqproyek["pendapatan_nett"];
		    $html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($pqproyek["pendapatan_nett"],2,",",".").'</td>
		    <td align="right" style="background: black;border-right:white; color: white;"></td>';
		}
			$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($pendapatan_area["pendapatannetarea"],2,",",".").'</td>
		    <td align="right" style="background: black;border-right:white; color: white;"></td>';
		  $html.='</tr>';
		  	}


  	if ($kode=='5' && $kolom != ''){
  		$html .='<tr>
				    <td width="3%">
				      &nbsp;
				    </td>
				    <td colspan="3">
				      '.$map1["nama_map"].'
				    </td>';
		$pq = $this->pq_model->get_pq_by_area($kolom, $id);
    	$total5_per_item=0;
    	foreach($pq as $pqproyek){

			if ($kolom=='spk'){
				$spk = $pqproyek['spk'];
				$html.='<td align="right">'. number_format($pqproyek[$kolom],2,",",".").'</td>
						<td align="right">'. number_format(100,2,",",".").'</td>';	
			}
			if ($kolom!='spk'){
				$total5_per_item=$total5_per_item+$pqproyek[$kolom];
				$html.='<td align="right" style="color:red">'. number_format($pqproyek[$kolom]*-1,2,",",".").'</td>
						<td align="right">'. number_format($pqproyek[$kolom]/$spk*100,2,",",".").'</td>';	
			}
		}

		if ($kolom=='spk'){
			$html.='<td align="right" style="background: yellow;">'. number_format($spkperyear['nilai_spk'],2,",",".").'</td>
					<td align="right" style="background: yellow;">'. number_format(100,2,",",".").'</td>';
		}else{
			$html.='<td align="right" style="color:red;background: yellow;">'. number_format($total5_per_item*-1,2,",",".").'</td>
					<td align="right" style="background: yellow;">'. number_format($total5_per_item/$spkperyear['nilai_spk']*100,2,",",".").'</td>';
		}


				$html.='</tr>';
	}

	if ($kode=='0'){
		$html.='<tr>
					<td colspan="'.$colspan1.'">&nbsp;</td>
    			</tr>';
	}	

	if ($kode=='3A'){
		$html .='<tr>
			    <td colspan="4" align="center">'.$map1["nama_map"].'</td>';
		
		$pq = $this->pq_model->get_pq_by_area($kolom, $id);
    	
    	foreach($pq as $pqproyek){
    		$sub_total_a=$pqproyek[$kolom];
    		$html.='<td align="right" style="background: black;border-right:white; color: white;">'.number_format($sub_total_a,2,',','.').'</td>
			    <td align="right" style="background: black;border-right:white; color: white;">'.number_format($sub_total_a/$spk*100,2,',','.').'</td>';
    	}
    		$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($pendapatan_area["sub_total_a"],2,",",".").'</td>
		    <td align="right" style="background: black;border-right:white; color: white;">'. number_format($pendapatan_area["sub_total_a"]/$spkperyear["nilai_spk"]*100,2,",",".").'</td>';
		
			  $html.='</tr>';
	}

	if ($kode=='5' && $kd_item!=''){
		$jenis_tk = $map1["jenis"];
		$html.='<tr>
          			<td width="3%">'.$map1["number"].'</td>
          			<td>'.$map1["nama_map"].'</td>
          			<td colspan="2">'.$map1["jenis"].'</td>';
          

        // looping proyek
        $klm='kd_proyek';
        $proyek = $this->pq_model->get_proyek_by_area($klm, $id);
        $nilaihppperitem=0;
    	foreach($proyek as $proyek){

    		$kolom1='pendapatan_nett';
    		$proyek = $proyek[$klm];

    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}

    		$hpp 	= $this->pq_model->get_cetak_hpp_by_area($kd_item, $jenis_tk, $id, $proyek);

    		$jumlahhpp=0;
    		foreach($hpp as $hpp){
    			$nilaihppperitem=$nilaihppperitem+$hpp['nilai_hpp'];
    			$html.='<td align="right" style="color: red">'. number_format($hpp['nilai_hpp']*-1,2,',','.') .'</td>
          			<td align="right">'. number_format($hpp['nilai_hpp']/$pendapatan_nett*100,2,',','.') .'</td>';
       		}

    	}

    	$html.='<td align="right" style="color: red;background: yellow;">'. number_format($nilaihppperitem*-1,2,',','.') .'</td>
          			<td align="right" style="background: yellow;">'. number_format($nilaihppperitem/$pendapatan_area['pendapatannetarea']*100,2,',','.') .'</td>';
        $html.='</tr>';
	}


	if ($kode=='3B'){
  		$html .='<tr>
				    <td colspan="2" align="center" style="background: black;color: white;border-right:white;">
				      '.$map1["nama_map"].'
				    </td>
				    <td  colspan="2" style="background: black;border-right:white;border-left:white; color: white;" align="center">Keterangan</td>';
			for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: black;border-right:white; color: white;">Rp</td>
				    <td align="center" style="background: black;border-left:white;color: white;">%</td>';
				}
					$html.='<td align="center" style="background: black;border-right:white; color: white;">Rp</td>
				    <td align="center" style="background: black;border-left:white;color: white;">%</td>';
				  	$html.='</tr>';
  	}

  	if ($kode=='3D'){
  		$html .='<tr>
				    <td colspan="2" align="center" style="background: black;color: white;border-right:white;">
				      '.$map1["nama_map"].'
				    </td>
				    <td  style="background: black;border-right:white;border-left:white; color: white;" align="center">Keterangan</td>
				    <td  style="background: black;border-right:white;border-left:white; color: white;" align="center">HO Area</td>';
			for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: black;border-right:white; color: white;">Rp</td>
				    <td align="center" style="background: black;border-left:white;color: white;">%</td>';
				}
					$html.='<td align="center" style="background: black;border-right:white; color: white;">Rp</td>
				    <td align="center" style="background: black;border-left:white;color: white;">%</td>';
				  $html.='</tr>';
  	}

	

	if ($kode=='3C'){
		$klm='kd_proyek';
		$html.='<tr>
    <td colspan="4" align="center">
      SUB TOTAL B
    </td>';
    $proyek = $this->pq_model->get_proyek_by_area($klm, $id);
    $nilaihpp=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}
    		$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
    		
    		foreach($tothpp as $tothpp){
    			$nilaihpp=$nilaihpp+$tothpp['nilai_hpp'];
    			$html.='<td align="right" style="background: black;color: white;">'. number_format($tothpp['nilai_hpp']*-1,2,',','.').'</td>
    					<td align="right" style="background: black;color: white;">'. number_format($tothpp['nilai_hpp']*-1/$pendapatan_nett*100,2,',','.').'</td>';
    		}
		}
		$html.='<td align="right" style="background: black;color: white;">'. number_format($nilaihpp*-1,2,',','.').'</td>
    					<td align="right" style="background: black;color: white;">'. number_format($nilaihpp*-1/$pendapatan_area['pendapatannetarea']*100,2,',','.').'</td>';
  		$html.='</tr>';
	}


if ($kode=='3E'){
		$html.='<tr>
					<td colspan="'.$colspan1.'">'.$map1["nama_map"].'</td>
    			</tr>';
	}

if ($kode=='6'){
		$html.='<tr>
          			<td width="3%">'.$map1["number"].'</td>
          			<td>'.$map1["nama_map"].'</td>';
          
    		$op 	= $this->pq_model->get_op_by_area($kd_item,$id,$tahun);

    		$jumlahops=0;
    		foreach($op as $operasional){

    			$jumlahops=$jumlahops+$operasional['total'];
    			
    			$html.='
    				<td align="center">'.$operasional['keterangan'].'</td>
    				<td align="right" style="color: red">'. number_format($operasional['total']*-1,2,',','.') .'</td>';
       		}
       		for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center"></td>
				    		<td align="center" ></td>';
				}
			foreach($op as $operasional){

    			$jumlahops=$jumlahops+$operasional['total'];
    			
    			$html.='
    				<td align="right" style="color: red;background:yellow">'. number_format($operasional['total']*-1,2,',','.') .'</td>
    				<td align="right" style="background:yellow">'. number_format($operasional['total']/$pendapatan_area['pendapatannetarea']*100,2,',','.') .'</td>';
       		}

        $html.='</tr>';
	}

if ($kode=='6A'){
		$html.='<tr>
          			<td width="3%">'.$map1["number"].'</td>
          			<td>'.$map1["nama_map"].'</td>';
          
    		$op 	= $this->pq_model->get_marketing_by_area($kd_item,$id,$tahun);

    		foreach($op as $operasional){
    			$html.='
    				<td align="center">'.$operasional['keterangan'].'</td>
    				<td align="right" style="color: red">'. number_format($operasional['total']*-1,2,',','.') .'</td>';
       		}
       		for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center"></td>
				    		<td align="center" ></td>';
				}
			foreach($op as $operasional){
    			$html.='
    				<td align="right" style="color: red;background:yellow">'. number_format($operasional['total']*-1,2,',','.') .'</td>
    				<td align="right" style="background: yellow">'. number_format($operasional['total']/$pendapatan_area['pendapatannetarea']*100*-1,2,',','.') .'</td>';
       		}
        $html.='</tr>';
	}

$sub_total_c=$marketing['total']*-1;

if ($kode=='3F'){
	$html.='<tr>
        <td colspan="3" align="center">
          '.$map1["nama_map"].'
        </td>
        <td align="right" style="background: black;color: white;border-right:white;">'. number_format($sub_total_c,2,',','.').'</td>';

        for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: black;color: white;border-right:white;"></td>
				    		<td align="center" style="background: black;color: white;border-right:white;"></td>';
				}

      $html.='	<td align="right" style="background: black;color: white;border-right:white;">'. number_format($sub_total_c,2,',','.').'</td>
      			<td align="right" style="background: black;color: white;border-right:white;">'. number_format(($sub_total_c/$pendapatan_area['pendapatannetarea']),2,',','.').'</td>
      			</tr>';
}



if($kode==7){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="center" style="background: black;color: white;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id);
		$total_lr_operasional=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$lr_operasional = $sub_total_a+$sub_total_b;

	    	$total_lr_operasional=$total_lr_operasional+$lr_operasional;
	    	
	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}
	    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($lr_operasional,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($lr_operasional)/$pendapatan_nett*100,2,',','.').'</td>';

    	}
	

    	
	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_lr_operasional+$sub_total_c,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($total_lr_operasional+$sub_total_c)/$pendapatan_area['pendapatannetarea']*100,2,',','.').'</td>';	
    
  $html.='</tr>';
}


if($kode==8){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="center" style="background: black;color: white;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id);
	$total_nalokasi_ho=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho=$pqproyek['nalokasi_ho'];
	    		$total_nalokasi_ho=$total_nalokasi_ho+$nalokasi_ho;

	    	}
	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}
	    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($nalokasi_ho*-1,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format($nalokasi_ho/$pendapatan_nett*100,2,',','.').'</td>';

    	}
		
	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_nalokasi_ho*-1,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_nalokasi_ho*-1/$pendapatan_area['pendapatannetarea']*100,2,',','.').'</td>';    
  $html.='</tr>';
}


if($kode=='9'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="center" style="background: black;color: white;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id);
	$total_lr_setelah_ho=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho 		=$pqproyek['nalokasi_ho']*-1;
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];

	    	}

	    	

	    	$lr_setelah_ho = $sub_total_a+$sub_total_b+$nalokasi_ho;
	    	$total_lr_setelah_ho=$total_lr_setelah_ho+$lr_setelah_ho;


	    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($lr_setelah_ho,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($lr_setelah_ho)/$pendapatan_nett*100,2,',','.').'</td>';

    	}
	

	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_lr_setelah_ho,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_lr_setelah_ho/$pendapatan_area['pendapatannetarea']*100,2,',','.').'</td>';    	
	
    
  $html.='</tr>';
}



if($kode=='10A'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="left" style="background: black;color: white;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id);
	$total_distribusi_ho_area_tiap_projek=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];

	    	}

	    	$distribusi_ho_area_tiap_projek = ($pendapatan_nett/$pendapatan_area['pendapatannetarea'])*$sub_total_c;
	    	$total_distribusi_ho_area_tiap_projek=$total_distribusi_ho_area_tiap_projek+$distribusi_ho_area_tiap_projek;

	    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($distribusi_ho_area_tiap_projek,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($distribusi_ho_area_tiap_projek)/$pendapatan_nett*100*-1,2,',','.').'</td>';

    	}
	

    	
	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_distribusi_ho_area_tiap_projek,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($total_distribusi_ho_area_tiap_projek)/$pendapatan_area['pendapatannetarea']*100*-1,2,',','.').'</td>';	
    
  $html.='</tr>';
}

if($kode=='10B'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="left" style="background: black;color: white;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id);
    	$total_tot_biaya_per_projek=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho 		=$pqproyek['nalokasi_ho']*-1;
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];
	    		$nilai_pl 			=$pqproyek["nilai_pl"]*-1;
	    		

	    	}
	    	$distribusi_ho_area_tiap_projek = ($pendapatan_nett/$pendapatan_area['pendapatannetarea'])*$sub_total_c;

	    	$tot_biaya_per_projek = $distribusi_ho_area_tiap_projek+$nalokasi_ho +$sub_total_b+$nilai_pl;
	    	$total_tot_biaya_per_projek=$total_tot_biaya_per_projek+$tot_biaya_per_projek;

	    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($tot_biaya_per_projek,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($tot_biaya_per_projek)/$pendapatan_nett*100*-1,2,',','.').'</td>';

    	}
    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($total_tot_biaya_per_projek,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($total_tot_biaya_per_projek)/$pendapatan_area['pendapatannetarea']*100*-1,2,',','.').'</td>';
  $html.='</tr>';
}

if($kode=='10C'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="left" style="background: black;color: white;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id);
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho 		=$pqproyek['nalokasi_ho']*-1;
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];
	    		$nilai_pl 			=$pqproyek["nilai_pl"]*-1;
	    		

	    	}
	    	$distribusi_ho_area_tiap_projek = ($pendapatan_nett/$pendapatan_area['pendapatannetarea'])*$sub_total_c;

	    	$tot_biaya_per_projek = $distribusi_ho_area_tiap_projek+$nalokasi_ho +$sub_total_b+$nilai_pl;




	    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($pendapatan_nett+$tot_biaya_per_projek,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($tot_biaya_per_projek+$pendapatan_nett)/$pendapatan_nett*100*-1,2,',','.').'</td>';

    	}
    	$html.='<td align="right" style="background: black;border-right:white; color: white;">'. number_format($pendapatan_area['pendapatannetarea']+$total_tot_biaya_per_projek,2,',','.').'</td>
    		<td align="right" style="background: black;border-right:white; color: white;">'. number_format(($total_tot_biaya_per_projek+$pendapatan_area['pendapatannetarea'])/$pendapatan_area['pendapatannetarea']*100*-1,2,',','.').'</td>';
  $html.='</tr>';
}


  }//end
    
  $html.='</table>';


		$jenis= 1;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'portrait');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/pq/cetak_pq');
                break;
            case 1;
                echo "<title>Laporan PQ</title>";
                echo $html;
                
               break;
        }
    }


}


?>