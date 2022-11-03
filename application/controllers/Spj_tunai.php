<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spj_tunai extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/Spj_pegawai_model', 'spjpegawai_model');
		$this->load->model('user/pq_model', 'pq_model');
		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('admin/saldoawal_model', 'saldoawal_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('user/proyek_model', 'proyek_model');
		// $this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'SPJ';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/spj_pegawai/tunai');
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json(){				   					   
		$records['data'] = $this->spjpegawai_model->get_all_spj_tunai();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$kode_pegawai = str_replace('-','054d4a4653a16b49c49c49e000075d10',$row['kd_pegawai']);

				if ($row['status']=='1'){
					$tombol = '<a title="Approve" class="approve btn btn-sm btn-success" href="#"><i class="fa fa-check"></i></a>';
				}else{
					$tombol = '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('spj_tunai/edit_spj/'.'054d4a4653a16b49c49c49e000075d10'.$row['no_spj'].'4e9e388e9acfde04d6bd661a6294f8a0/'.$kode_pegawai).'"> <i class="fa fa-pencil-square-o"></i></a>
								<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('spj_tunai/delete_spj_temp/'.'054d4a4653a16b49c49c49e000075d10'.$row['no_spj'].'4e9e388e9acfde04d6bd661a6294f8a0/'.$kode_pegawai).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
				}
				// <a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('spj_pegawai/cetak_spj_pegawai/'.$row['no_spj'].'/'.$row['kd_area'].'/'.$kode_pegawai.'/0').'" target="_blank"> <i class="fa fa-print"></i></a>
			
				// $id=0,$kd_area,$kd_pegawai,$jenis=''

				
				$data[]= array(
				++$i,
				'<font size="2px">'.$row['no_spj'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<font size="2px">'.$row['tgl_bukti'].'</font>',
				'<font size="2px">'.$row['nama'].'</font>',
				'<font size="2px">'.$row['keterangan'].'</font>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['total'],2,",",".").'</font></span></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function simpan_spj_file(){
		$config['upload_path'] 		= './uploads/spj_karyawan/';
		$config['allowed_types']   	= '*';
		$config['max_size']         = '0';
		$config['encrypt_name'] 	= TRUE;
	
		$this->load->library('upload', $config);
	
		    $status = "success";
			$data['no_spj'] 			= $this->input->post('no_spj', TRUE);
			$data['tgl_spj']			= $this->input->post('tgl_spj', TRUE);
			$data['tgl_bukti']			= $this->input->post('tgl_bukti', TRUE);
			$data['kd_area'] 			= $this->input->post('kdarea', TRUE);
			$data['jns_ta'] 			= $this->input->post('jns_ta', TRUE);
			$data['kd_pegawai']			= $this->input->post('kd_pegawai', TRUE);
			$data['kd_sub_area']		= $this->input->post('subarea', TRUE);
			$data['kd_proyek']			= $this->input->post('kd_proyek', TRUE);
         	$data['no_acc']				= $this->input->post('no_acc', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['jns_spj']			= $this->input->post('jns_spj', TRUE);
            $data['tunai']			    = 1;
			$data['nilai']				= $this->spjpegawai_model->number($this->input->post('total', TRUE));
		
		
		if ( ! $this->upload->do_upload('file')){
			$status = "success";
			$data['bukti']				= '';
			$result 					= $this->spjpegawai_model->save_spj_tunai($data);
			$msg = "Data berhasil disimpan tanpa bukti";
		}
		else{
	
			$dataupload = $this->upload->data();
			$data['bukti']				= $dataupload['file_name'];
			$result 					= $this->spjpegawai_model->save_spj_tunai($data);
			$msg = "Data Berhasil disimpan dengan bukti ".$data['bukti'];
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
	}

public function add(){
		$this->rbac->check_operation_access('');
		if($this->input->post('type')==1){
			$data['no_spj'] 			= $this->input->post('no_spj', TRUE);
			$data['tgl_spj']			= $this->input->post('tgl_spj', TRUE);
			$data['tgl_bukti']			= $this->input->post('tgl_bukti', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['kd_pegawai']			= $this->input->post('pegawai', TRUE);
			$data['kd_sub_area']		= $this->input->post('subarea', TRUE);
			$data['kd_proyek']			= $this->input->post('project', TRUE);
         	$data['no_acc']				= $this->input->post('no_akun', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['jns_spj']			= $this->input->post('jns_spj', TRUE);
			$data['nilai']				= $this->input->post('nilai', TRUE);
			$data['tunai']				= 1;
			$result 					= $this->spjpegawai_model->save_spj_tunai($data);
			
					echo json_encode(array(
							"statusCode"=>200
						));

		}else{
			$data2['title'] 			= 'SPJ';
			$data['data_area'] 			= $this->area->get_area_pusat();
			$this->load->view('admin/includes/_header' , $data2);
			$this->load->view('user/spj_pegawai/add_tunai', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}
	
	function get_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_subarea($area)->result();
		echo json_encode($data);
	}

	

	function get_kas(){
		$id 		= $this->input->post('id',TRUE);
    $data 		= $this->spjpegawai_model->get_kas_tunai($id)->result();
		echo json_encode($data);
	}


function get_pq_projek_by_area(){
	$area = $this->input->post('id',TRUE);
	$data = $this->pdo_model->get_pq_projek_by_area($area)->result();
	echo json_encode($data);
}

public function datatable_json_pdo_proyek($id='',$kodepdo=''){				
		
	$id_new = str_replace('abcde','/',$id);
	$records['data'] = $this->pdo_model->get_pdo_proyek($id_new);
	$data = array();

	$i=0;
	foreach ($records['data']   as $row) 
	{  

		$data[]= array(
			++$i,
			$row['no_acc'],
			$row['nm_acc'],
			$row['uraian'],
			number_format($row['nilai'],2,',','.'),
			'<a class="del btn btn-sm btn-danger" href="#" title="Delete" > <i class="fa fa-trash-o"></i></a>'
		);
	}
	$records['data']=$data;
	echo json_encode($records);						   
}

public function add_spj(){
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('tgl_spj', 'Tanggal SPJ', 'trim|required');
			$this->form_validation->set_rules('kd_pegawai', 'kd_pegawai', 'trim|required');
			$this->form_validation->set_rules('no_spj', 'No SPJ', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
			}
			else{
				$nospj 					= $this->security->xss_clean($this->input->post('no_spj'));
				$keterangan 			= $this->security->xss_clean($this->input->post('keterangan'));
				$kd_pegawai				= $this->security->xss_clean($this->input->post('kd_pegawai'));

				$this->spjpegawai_model->simpan_spj($kd_pegawai,$nospj);
				$this->spjpegawai_model->update_keterangan($kd_pegawai, $nospj, $keterangan);
				$urutan 					= $this->input->post('urut', TRUE);
				
					$data2 = array(
						'no_spj' => $urutan
					);

				$result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'SPJ Proyek berhasil ditambahkan!');
					redirect(base_url('spj_tunai'));
				}else{
					$this->session->set_flashdata('errors', 'SPJ Proyek gagal ditambahkan!');
					redirect(base_url('spj_tunai/add'));
				}
			}
		}
		
	}

public function edit_keterangan($id='',$kd_area=''){
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('no_spj', 'No. SPJ', 'trim|required');
			$this->form_validation->set_rules('kd_pegawai', 'kode Pegawai', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
			}
			else{
				$kdpdo 						= $this->security->xss_clean($this->input->post('kd_pegawai'));
				$nospj 						= $this->security->xss_clean($this->input->post('no_spj'));
				$keterangan 				= $this->security->xss_clean($this->input->post('keterangan'));
				$result = $this->spjpegawai_model->update_keterangan($kdpdo, $nospj, $keterangan);
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'SPJ berhasil diubah!');
						redirect(base_url('spj_tunai'));	
					
				}else{
					$this->session->set_flashdata('errors', 'SPJ gagal diubah!');
					redirect(base_url('spj_tunai/edit_spj/'.$id));
				}
			}
		}
		
	}

public function simpan_spj_file2(){
		$config['upload_path'] 		= './uploads/spj_karyawan/';
		$config['allowed_types']   	= '*';
		$config['max_size']         = '0';
		$config['encrypt_name'] 	= TRUE;
	
		$this->load->library('upload', $config);
	
		$status = "success";
			$data['no_spj'] 			= $this->input->post('no_spj', TRUE);
			$data['tgl_spj']			= $this->input->post('tgl_spj', TRUE);
			$data['tgl_bukti']			= $this->input->post('tgl_bukti', TRUE);
			$data['kd_area'] 			= $this->input->post('kd_area', TRUE);
			$data['jns_ta'] 			= $this->input->post('jns_ta', TRUE);
			$data['kd_pegawai']			= $this->input->post('kd_pegawai', TRUE);
			$data['kd_sub_area']		= $this->input->post('kd_sub_area', TRUE);
			$data['kd_proyek']			= $this->input->post('kd_projek', TRUE);
         	$data['no_acc']				= $this->input->post('no_acc', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['jns_spj']			= $this->input->post('jns_spj', TRUE);
            $data['tunai']			    = 1;
			// $data['nilai']				= $this->input->post('nilai', TRUE);
			$data['nilai']				= $this->spjpegawai_model->number($this->input->post('total', TRUE));
		
		
		if ( ! $this->upload->do_upload('file')){
			$status = "success";
			$data['bukti']				= '';
			$result 					= $this->spjpegawai_model->save_edit_spj_tunai($data);
			$msg = "Data berhasil disimpan tanpa bukti";
		}
		else{
	
			$dataupload = $this->upload->data();
			$data['bukti']				= $dataupload['file_name'];
			$result 					= $this->spjpegawai_model->save_edit_spj_tunai($data);
			$msg = "Data Berhasil disimpan dengan bukti ".$data['bukti'];
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
	}


public function edit_spj($nospj='',$kd_pegawai='')

{		
		$this->rbac->check_operation_access('');

		if($this->input->post('type')==1){
			$data['no_spj'] 			= $this->input->post('no_spj', TRUE);
			$data['tgl_spj']			= $this->input->post('tgl_spj', TRUE);
			$data['tgl_bukti']			= $this->input->post('tgl_bukti', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['kd_pegawai']			= $this->input->post('pegawai', TRUE);
			$data['kd_sub_area']		= $this->input->post('subarea', TRUE);
			$data['kd_proyek']			= $this->input->post('project', TRUE);
         	$data['no_acc']				= $this->input->post('no_akun', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['nilai']				= $this->input->post('nilai', TRUE);
			$data['jns_spj']			= $this->input->post('jns_spj', TRUE);
            $data['tunai']			    = 1;
			
			$result = $this->spjpegawai_model->save_edit_spj_tunai($data);
			
					echo json_encode(array(
							"statusCode"=>200
						));
		}
		else{
			$data['data_area'] 			= $this->area->get_area_pusat();
			$data['data_spj'] 			= $this->spjpegawai_model->get_spj_by_id($nospj,$kd_pegawai);
			$data2['title'] 			= 'Edit SPJ';
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/spj_pegawai/edit_tunai', $data);
			$this->load->view('admin/includes/_footer');
		}
	
}






public function datatable_json_spj_edit($id='',$kd_pegawai=''){				
		
		$id_new = '4e9e388e9acfde04d6bd661a6294f8a0'.$id.'054d4a4653a16b49c49c49e000075d10';
		$kode_pegawai = str_replace('-','054d4a4653a16b49c49c49e000075d10',$kd_pegawai);
		
		$records['data'] = $this->spjpegawai_model->get_rincian_spj($id, $kd_pegawai);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			if ($row['bukti']=="" || $row['bukti']==null){
				$anchor='Tidak ada bukti';
			}else{
				$anchor = anchor('uploads/spj_karyawan/'.$row['bukti'], 'preview','target="_blank"');
			}

					if($row['jns_ta']==1){
						$jns_ta="&#x21AA"." - Biaya Transportasi Operasional";
					}else if($row['jns_ta']==2){
						$jns_ta="&#x21AA"." - Biaya Hotel, Penginapan & Akomodasi, Kost";
					}else if($row['jns_ta']==3){
						$jns_ta="&#x21AA"." - Biaya Perdiem/Paket";
					}else if($row['jns_ta']==4){
						$jns_ta="&#x21AA"." - Biaya Service, Perawatan, Sparepart & Perlengkapan";
					}else if($row['jns_ta']==5){
						$jns_ta="&#x21AA"." - BBM, Parkir, Tol";
					}else if($row['jns_ta']==6){
						$jns_ta="&#x21AA"." - Asuransi Kendaraan";
					}else if($row['jns_ta']==7){
						$jns_ta="&#x21AA"." - Biaya Telepon, Internet dan Fax";
					}else if($row['jns_ta']==8){
						$jns_ta="&#x21AA"." - Biaya Pos, Pengiriman";
					}else if($row['jns_ta']==9){
						$jns_ta="&#x21AA"." - Tunjangan Karyawan";
					}else if($row['jns_ta']==10){
						$jns_ta="&#x21AA"." - Pengobatan Medis";
					}else{
						$jns_ta='';
					}

					
				$btnedit = '<a class="list-group-item list-group-item-action showEdit-rincianSPJ" data-nospj="'.$row['no_spj'].'" data-id="'.$row['id'].'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: #F15412"></i> Edit Rincian</a>';
				$btndel = '<a class="list-group-item list-group-item-action hapus-rincian"  href='.base_url("spj_pegawai/delete_spj/".$row['id']).'/'.$id_new.'/'.$kode_pegawai.'/'.$row['bukti'].' title="Delete" onclick="return confirm(\'Do you want to delete ?\')" ><i class="fa fa-trash-o" aria-hidden="true" style="color: #F32424"></i> Hapus Rincian</a>';
	 
				$button3 = '<button style=" background-color: #3FA796; color: #F6F6F6; height:28px; width:28px;" data-toggle="dropdown"  id="btnGroupDrop1" class="btn btn-sm dropdown-toggle" aria-expanded="false"> <i class="fa fa-bars" aria-hidden="true" ></i>';

				$subbutton=$btnedit.$btndel;
 					
					
					
			$data[]= array(
				$row['no_spj'],
				$row['tgl_spj'],
				$row['no_acc'].'<br>'.$row['nm_acc'].'<br>'.$jns_ta,
				$row['uraian'],
				$anchor,
				number_format($row['nilai'],2,',','.'),
				//'<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("spj_pegawai/delete_spj/".$row['id']).'/'.$id_new.'/'.$kode_pegawai.'/'.$row['bukti'].' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			
			'<center>
						<div class="btn-group" align="left" role="group" aria-label="Button group with nested dropdown" >  						  
							'.$button3.'
							</button><ul class="dropdown-menu" >
							<div style="margin-left: 1px;  margin-top: 1px; position: relative;z-index: 99;"  aria-labelledby="Pilihan aksi" ><left>
								  
								  '.$subbutton.'
								
							</div> 
						  </div>
						
					</center>'
			
			
			
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	public function delete_spj_temp2()
	{	
		$this->rbac->check_operation_access('');
		
		if($this->input->post('type')==1){
			$id 		= $this->input->post('id', TRUE);
			$bukti 		= $this->input->post('bukti', TRUE);
			if ($bukti!='' || $bukti!= null){
				unlink('./uploads/spj_karyawan/'.$bukti);
			}

			$result = $this->db->delete('ci_spj_pegawai_temp', array('id' => $id));	
			if($result){
					echo json_encode(array(
						"statusCode"=>200
					));
			}else{
					echo json_encode(array(
						"statusCode"=>201
					));
			}
		}
		
	}


public function delete_spj_temp($no_spj='',$kd_pegawai='')
	{	

		$no_spj_new = str_replace('054d4a4653a16b49c49c49e000075d10','',$no_spj);
		$nospj = str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',$no_spj_new);
		$kdpegawai = str_replace('054d4a4653a16b49c49c49e000075d10','-',$kd_pegawai);

		$this->rbac->check_operation_access('');
		$this->db->delete('ci_spj_pegawai', array('kd_pegawai' => $kdpegawai, 'no_spj' => $nospj));	
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		
			redirect(base_url('spj_pegawai'));	
	}

public function delete_spj($id = 0,$no_spj='',$kd_pegawai='', $bukti='')
	{
		$this->rbac->check_operation_access('');
		$no_spj_new = str_replace('054d4a4653a16b49c49c49e000075d10','',$no_spj);
		$nospj = str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',$no_spj_new);
		$kdpegawai = str_replace('054d4a4653a16b49c49c49e000075d10','-',$kd_pegawai);
		
		if($bukti=='' || $bukti==null){
			unlink('./uploads/spj_karyawan/'.$bukti);
		}

		$this->db->delete('ci_spj_pegawai', array('id' => $id, 'no_spj' => $nospj));	
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		redirect(base_url('spj_pegawai/edit_spj/054d4a4653a16b49c49c49e000075d10'.$no_spj.'4e9e388e9acfde04d6bd661a6294f8a0/'.$kd_pegawai));			
	}


	function get_pdo_by_area(){
		$area 		= $this->input->post('id',TRUE);
		$jenis_pdo 	= $this->input->post('jenis_pdo',TRUE);
		$data 		= $this->spjpegawai_model->get_pdo_by_area($area,$jenis_pdo)->result();
		echo json_encode($data);
	}

	function get_item_by_pdo(){
		$pq = $this->input->post('id',TRUE);
		$jenis_pdo 	= $this->input->post('jenis_pdo',TRUE);
		$data = $this->spjpegawai_model->get_item_by_pdo($pq,$jenis_pdo)->result();
		echo json_encode($data);
	}

	function get_project_by_pdo(){
		$pq 		= $this->input->post('id',TRUE);
		$jenis_pdo 	= $this->input->post('jenis_pdo',TRUE);
		$data 		= $this->spjpegawai_model->get_project_by_pdo($pq,$jenis_pdo)->result();
		echo json_encode($data);
	}

	function get_item_spj(){
		$jns_spj 	= $this->input->post('jns_spj',TRUE);
		$kd_proyek 	= $this->input->post('kd_proyek',TRUE);
		$data = $this->spjpegawai_model->get_item_spj($jns_spj,$kd_proyek)->result();
		echo json_encode($data);
	}

function get_nomor(){
		$kd_pegawai 		= $this->input->post('kd_pegawai',TRUE);
		$data 		= $this->spjpegawai_model->get_nomor($kd_pegawai)->result();
		echo json_encode($data);
	}

function get_nilai(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$jns_spj 	= $this->input->post('jns_spj',TRUE);
		$data 		= $this->spjpegawai_model->get_nilai($id, $no_acc, $jns_spj)->result();
		echo json_encode($data);
	}
function get_realisasi(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$jns_spj 	= $this->input->post('jns_spj',TRUE);
		$data 		= $this->spjpegawai_model->get_realisasi($id, $no_acc,$jns_spj)->result();
		echo json_encode($data);
	}



function get_proyek_by_area_subarea(){
	$subarea 	= $this->input->post('id',TRUE);
	$area 		= $this->input->post('area',TRUE);
	$jns_spj 	= $this->input->post('jns_spj',TRUE);
	$data 		= $this->spjpegawai_model->get_proyek_by_area_subarea($subarea,$area,$jns_spj)->result();
	echo json_encode($data);
}

function get_pegawai_by_area(){
	$area = $this->input->post('id',TRUE);
	$data = $this->spjpegawai_model->get_pegawai_by_area($area)->result();
	echo json_encode($data);
}

function get_pegawai_by_area_cetak(){
	$data = $this->spjpegawai_model->get_pegawai_by_area_cetak()->result();
	echo json_encode($data);
}

function get_area_by_user(){
	$user = $this->input->post('id',TRUE);
	$data = $this->spjpegawai_model->get_area_by_user($user)->result();
	echo json_encode($data);
}

  public function view($id,$kd_pegawai){
  	$kd_pegawai_new			= str_replace('abcde','/',$kd_pegawai);
    $search 			= $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
    $limit 				= $_POST['length']; // Ambil data limit per page
    $start 				= $_POST['start']; // Ambil data start
    $order_index 	= $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
    $order_field 	= $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_ascdesc 	= $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
    
    $sql_total 		= $this->spjpegawai_model->count_all($id,$kd_pegawai_new); // Panggil fungsi count_all pada SiswaModel
    $sql_data 		= $this->spjpegawai_model->filter($search, $limit, $start, $order_field, $order_ascdesc,$id,$kd_pegawai_new); // Panggil fungsi filter pada SiswaModel
    $sql_filter 	= $this->spjpegawai_model->count_filter($search); // Panggil fungsi count_filter pada SiswaModel
    $callback = array(
        'draw'=>$_POST['draw'], // Ini dari datatablenya
        'recordsTotal'=>$sql_total,
        'recordsFiltered'=>$sql_filter,
        'data'=>$sql_data
    );
    header('Content-Type: application/json');
    echo json_encode($callback); // Convert array $callback ke json
  }
  function format_indo($date){
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $bulan = $date;
    $result = $Bulan[(int)$bulan-1];
    return $result;
  }

  public function cetak_spj_pegawai($kd_pegawai,$area,$bulan,$tahun,$jenis='')
	{	
		$data['spj_header'] 		= $this->spjpegawai_model->get_spj_header($area,$kd_pegawai);
		$data['spj_header2'] 		= $this->spjpegawai_model->get_spj_header2($area,$kd_pegawai,$bulan,$tahun);
		$data['spj_header3'] 		= $this->spjpegawai_model->get_spj_header3($area,$kd_pegawai,$bulan,$tahun);
		$data['spj_header4'] 		= $this->spjpegawai_model->get_spj_header4($area,$kd_pegawai,$bulan,$tahun);
		$data['spj_header5'] 		= $this->spjpegawai_model->get_spj_header5($area,$kd_pegawai,$bulan,$tahun);
		$data['pengembalian'] 		= $this->spjpegawai_model->pengembalian_kas($area,$kd_pegawai,$bulan,$tahun);
		$data['rincian_spj'] 		= $this->spjpegawai_model->get_rincian_spj_cetak($area,$kd_pegawai,$bulan,$tahun);
		$data['rincian_penerimaan'] = $this->spjpegawai_model->get_rincian_penerimaan($area,$kd_pegawai,$bulan,$tahun);
		$data['title']	= 'Cetak SPJ';
		// $html = $this->load->view('user/pq/pq_view', $data);
		// $cRet = $this->load->view('user/pq/cetak_pq_satuan',$data);
		// $data['tahun'] 				= $tahun;

		// if ($bulan==0){
		// 	$data['bulan'] 				= "";	
		// }else{
		// 	$data['bulan'] 				= $this->format_indo($bulan);
		// }

		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'Landscape');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/spj_pegawai/cetak_spj_pegawai', $data);
                break;
            case 1;
                $this->load->view('user/spj_pegawai/cetak_spj_pegawai', $data);
               break;
        }

	}


	public function cetak_spj_pegawai_lama($id=0,$kd_area,$kd_pegawai,$jenis='')
	{	
		$data['spj_header'] 		= $this->spjpegawai_model->get_spj_header($id,$kd_area,$kd_pegawai);
		$data['spj_header2'] 		= $this->spjpegawai_model->get_spj_header2($id,$kd_area,$kd_pegawai);
		$data['spj_header3'] 		= $this->spjpegawai_model->get_spj_header3($id,$kd_area,$kd_pegawai);
		$data['spj_header4'] 		= $this->spjpegawai_model->get_spj_header4($id,$kd_area,$kd_pegawai);
		$data['spj_header5'] 		= $this->spjpegawai_model->get_spj_header5($id,$kd_area,$kd_pegawai);
		$data['rincian_spj'] 		= $this->spjpegawai_model->get_rincian_spj($id,$kd_pegawai);
		$data['rincian_penerimaan'] = $this->spjpegawai_model->get_rincian_penerimaan($id,$kd_pegawai);
		$data['title']	= 'Cetak SPJ';
		// $html = $this->load->view('user/pq/pq_view', $data);
		// $cRet = $this->load->view('user/pq/cetak_pq_satuan',$data);
		// $data['tahun'] 				= $tahun;

		// if ($bulan==0){
		// 	$data['bulan'] 				= "";	
		// }else{
		// 	$data['bulan'] 				= $this->format_indo($bulan);
		// }

		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'Landscape');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/spj_pegawai/cetak_spj_pegawai', $data);
                break;
            case 1;
                $this->load->view('user/spj_pegawai/cetak_spj_pegawai', $data);
               break;
        }

	}
	
	
	  	public function get_akunspj(){ 

		$jns_spj 	= $this->input->post('jns_spj',TRUE);
		$kd_proyek  = $this->input->post('kd_proyek',TRUE);
		$data 		= $this->spjpegawai_model->get_akunspj($jns_spj,$kd_proyek);
	
		echo $data;
	}

	public function get_projek(){ 

		$subarea 	= $this->input->post('id',TRUE);
		$area 		= $this->input->post('area',TRUE);
		$jns_spj 	= $this->input->post('jns_spj',TRUE);
		$data 		= $this->spjpegawai_model->get_projek($subarea,$area,$jns_spj);
	
		echo $data;
	}
	
	public function get_rincian(){  
			$cnospj = $this->input->post('cnospj');			
			$cid = $this->input->post('cid');
			
			$data = $this->spjpegawai_model->viewEditRincianSPJ($cnospj,$cid);
			echo $data;
		}		
		
	public function update_rincispj(){
		$config['upload_path'] 		= './uploads/spj_karyawan/';
		$config['allowed_types']   	= '*';
		$config['max_size']         = '0';
		$config['encrypt_name'] 	= TRUE;
	
		$this->load->library('upload', $config);
		
		$status = "success";
			$cnospj 			= $this->input->post('no_spj', TRUE);
			$cid 				= $this->input->post('id', TRUE);
			
			$cjns_spj			= $this->input->post('jns_spj', TRUE);
			$ckd_proyek			= $this->input->post('projek', TRUE);
			$ctgl_bukti 		= $this->input->post('tgl_bukti', TRUE);
			$cno_acc			= $this->input->post('no_acc', TRUE);
			$cjns_ta			= $this->input->post('jns_ta', TRUE);
			$curaian			= $this->input->post('uraian', TRUE);
			$cbuktiawal			= $this->input->post('buktiawal', TRUE);
			$cnilai				= $this->spjpegawai_model->number($this->input->post('total', TRUE)); 
			
			$whereUpdate = array(
				'id' 				=> $cid,
				'no_spj' 			=> $cnospj
			);
			
		
		if ( ! $this->upload->do_upload('file')){
			$status = "success";
			$cbukti	= '';
			
			
			$dataUpdate = array(
					'jns_spj' 				=> $cjns_spj,
					'kd_proyek' 			=> $ckd_proyek,
					'tgl_bukti' 			=> $ctgl_bukti,
					'no_acc' 				=> $cno_acc,
					'jns_ta' 				=> $cjns_ta,
					'uraian' 				=> $curaian,
					'nilai' 				=> $cnilai,
					'bukti' 				=> $cbukti,
					'username'				=> $this->session->userdata('username'),
					'created_at'			=> date("Y-m-d h:i:s")
				);
			
			
			$result 					= $this->spjpegawai_model->update_rincispj($whereUpdate,$dataUpdate);
			
			if($cbuktiawal==''){
				$msg = "Data berhasil diupdate tanpa bukti";
			}else{
				
				$msg = "Data berhasil diupdate";
			}
			
		
		}else{
	
			$dataupload = $this->upload->data();
			$cbukti		= $dataupload['file_name'];
			
			$dataUpdate = array(
					'jns_spj' 				=> $cjns_spj,
					'kd_proyek' 			=> $ckd_proyek,
					'tgl_bukti' 			=> $ctgl_bukti,
					'no_acc' 				=> $cno_acc,
					'jns_ta' 				=> $cjns_ta,
					'uraian' 				=> $curaian,
					'nilai' 				=> $cnilai,
					'bukti' 				=> $cbukti,
					'username'				=> $this->session->userdata('username'),
					'created_at'			=> date("Y-m-d h:i:s")
				);
			
			
				$result = $this->spjpegawai_model->update_rincispj($whereUpdate,$dataUpdate);
				
				
				
				if ($cbuktiawal!=''){
						unlink('./uploads/spj_karyawan/'.$cbuktiawal);
				}		
						$msg = "Data Berhasil diupdate dengan bukti ".$cbukti;	
			
			
		}
	
		$this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
	}


}
?>