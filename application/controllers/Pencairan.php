<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pencairan extends MY_Controller {

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
		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('admin/activity_model', 'activity_model');
		$this->load->model('user/pq_model', 'pq_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/pencairan/proyek_list');
		$this->load->view('admin/includes/_footer');
	}
	
	public function datatable_json(){				   					   
		$records['data'] = $this->proyek_model->get_all_proyek();
		echo json_encode($records);						   
	}

	public function tambah_proyek(){
		$data['title'] = 'Add Proyek';
		$this->rbac->check_operation_access('');

		$data['data_area'] 			= $this->area->get_area();
		$data['data_subarea'] 		= $this->subarea->get_subarea();
		$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
		$data['data_perusahaan'] 	= $this->perusahaan->get_perusahaan();
		$data['data_dinas'] 		= $this->dinas->get_dinas();
		$data['data_pagu'] 			= $this->pagu->get_pagu();


		if($this->input->post('submit')){
			$this->form_validation->set_rules('area', 'area', 'trim|required');
			$this->form_validation->set_rules('subarea1', 'subarea', 'trim|required');
			$this->form_validation->set_rules('jnsproyek', 'Jenis Proyek', 'trim|required');
			$this->form_validation->set_rules('jnssubproyek', 'Jenis Sub Proyek', 'trim|required');
			$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required');
			$this->form_validation->set_rules('dinas', 'dinas', 'trim|required');
			$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			$this->form_validation->set_rules('jnspagu', 'Jenis Pagu', 'trim|required');
			$this->form_validation->set_rules('thn_ang', 'tahun Anggaran', 'trim|required');
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
					'id_proyek'			=> $this->input->post('area').''.$this->input->post('subarea1').''.$this->input->post('jnsproyek').''.$this->input->post('jnssubproyek').''.$this->input->post('perusahaan').''.$this->input->post('dinas').''.$this->input->post('thn_ang'),
					'kd_area' 			=> $this->input->post('area'),
					'kd_sub_area' 		=> $this->input->post('subarea1'),
					'jns_proyek' 		=> $this->input->post('jnsproyek'),
					'jns_sub_proyek'	=> $this->input->post('jnssubproyek'),
					'kd_perusahaan' 	=> $this->input->post('perusahaan'),
					'kd_dinas' 			=> $this->input->post('dinas'),
					'thn_anggaran' 		=> $this->input->post('thn_ang'),
					'nm_paket_proyek' 	=> $this->input->post('paketproyek'),
					'catatan' 			=> $this->input->post('catatan'),
					'created_at' 		=> date('Y-m-d : h:m:s'),
					'updated_at' 		=> date('Y-m-d : h:m:s'),
				);

				$data2 = array(
					'username' 		=> $this->session->userdata('username'),
					'id_proyek'		=> $this->input->post('area').''.$this->input->post('subarea1').''.$this->input->post('jnsproyek').''.$this->input->post('jnssubproyek').''.$this->input->post('perusahaan').''.$this->input->post('dinas').''.$this->input->post('thn_ang'),
					'nilai' 		=> $this->proyek_model->angka($this->input->post('nilai')),
					'jns_pagu' 		=> $this->input->post('jnspagu'),
					'jns_pph' 		=> $this->input->post('jns_pph'),
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
			$data['title'] = 'Add Proyek';
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
			$data['jns_pph'] 		= $this->input->post('jns_pph', TRUE);
			$data['lama_pekerjaan']	= $this->input->post('lama_pekerjaan', TRUE);
            $data['tipeproyek'] 	= $this->input->post('tipeproyek', TRUE);
			$data['nodpa'] 			= $this->input->post('nodpa', TRUE);
			$data['nilai'] 			= $this->proyek_model->angka($this->input->post('nilai', TRUE));
			$data['tanggal'] 		= $this->input->post('tanggal', TRUE);
			$data['tanggal2'] 		= $this->input->post('tanggal2', TRUE);
            //file upload code 


            // update ke PQ kalau proyek ada di PQ get_spk_by_year

            $idproyek 		= $this->input->post('id_proyek', TRUE);
            $cekproyek		= $this->proyek_model->cek_proyek($idproyek);
            $jumlahproyek 	= $cekproyek['jumlah'];

            // echo $jumlahproyek;

            if ($jumlahproyek==1){ //CEK Proyek ada PQ atau tidak START
            	$pqproyek		= $this->proyek_model->pq_proyek($idproyek);
            	$nilaispk 		= $this->proyek_model->angka($this->input->post('nilai', TRUE));
            	$jenispph 		= $this->input->post('jns_pph', TRUE);
            	$jenispagu		= $this->input->post('jnspagu', TRUE);


            	$idPQproyekedit = $pqproyek['id_pqproyek'];

            	if($jenispph==22){
            		$pph = (1.5/100)*((100/110)*$nilaispk);
            		$ppn = (10/100)*((100/110)*$nilaispk);
            	}else if($jenispph==23){
            		$pph = (2/100)*((100/110)*$nilaispk);
            		$ppn = (10/100)*((100/110)*$nilaispk);
            	}else if($jenispph==21){
            		$pph = (50/100)*((5/100)*$nilaispk);
            		$ppn =0;
            	}

            $spk_net = $nilaispk - $pph - $ppn;

            // Infaq
            if($pqproyek['status_infaq']==1){
            	$infaq = 1/100*$nilaispk;
            }else{
            	$infaq = 0;
            }

            // Titipan
            if ($pqproyek['status_titipan']==1){
            	$nilaititipan = $pqproyek['titipan_net'];
            }else{
            	$nilaititipan = $pqproyek['titipan'];
            }

            $pendapatanNett = $spk_net-$infaq-$nilaititipan;

            // PL
            if ($pqproyek['ppl']>0){
            	$nilaiPPL = $pqproyek['ppl'];
            	$nilaiNPL = $pqproyek['npl'];
            	$nilaiPL  = $pqproyek['ppl'];
            }else{
            	
            	$persenPL = $pqproyek['persen_pl'];
            	$nilaiNPL = $persenPL*$pendapatanNett/100;
            	$nilaiPPL = 0;
            	$nilaiPL  = $nilaiNPL;
            }

            // SUBTOTAL A
            $nilaiSubTotalA = $pendapatanNett-$nilaiPL;

            // ALOKASI HO
            $nilaiAHO= 15*$pendapatanNett/100;

            
            // DATA untuk di save
            $data2 = array(
            	'ppn'				=> $ppn,
            	'pph'				=> $pph,
            	'spk_net'			=> $spk_net,
            	'infaq'				=> $infaq,
            	'pendapatan_nett'	=> $pendapatanNett,
            	'npl' 				=> $nilaiNPL,
            	'ppl' 		  		=> $nilaiPPL,
            	'sub_total_a' 		=> $nilaiSubTotalA,
            	'nalokasi_ho' 		=> $nilaiAHO,
            	'jns_pagu' 			=> $jenispagu
            );


            $this->pq_model->update_nilai_PQ($data2,$idPQproyekedit);

            }//CEK Proyek ada PQ atau tidak END
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


	function get_nilai(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->proyek_model->get_nilai_hpp($id, $no_acc)->result();
		echo json_encode($data);
	}

function get_realisasi(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->proyek_model->get_realisasi_hpp($id, $no_acc)->result();
		echo json_encode($data);
	}

	function get_realisasi2(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->proyek_model->get_realisasi_hpp2($id)->result();
		echo json_encode($data);
	}

	function get_subproyek(){
		$jnsproyek = $this->input->post('id',TRUE);
		$data = $this->jnssubproyek_model->get_subproyek($jnsproyek)->result();
		echo json_encode($data);
	}

	function get_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_subarea($area)->result();
		echo json_encode($data);
	}

	function get_dinas(){
		$subarea 	= $this->input->post('id',TRUE);
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->proyek_model->get_dinas($subarea,$area)->result();
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
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'tgl_cair' 			=> $this->input->post('tgl_cair'),
					'nomor' 			=> $this->input->post('nomor'),
					'kd_proyek'			=> $this->input->post('kd_proyek2'),
					'id_proyek'			=> $id,
					'jenis_cair'		=> $this->input->post('jns_pencairan'),
					'rek_pencairan'		=> $this->input->post('rek_pencairan'),
					'nilai_bruto'		=> $this->proyek_model->number($this->input->post('nilai_bruto')),
					'created_at' 		=> date('Y-m-d : h:m:s'),
				);
				$data 		= $this->security->xss_clean($data);
				$id_proyek 	= $this->input->post('kd_proyek2');

				$rek_pencairan = $this->input->post('rek_pencairan');

				// SIMPAN DETAIL PENCAIRAN
				$this->proyek_model->simpan_cair_proyek($data);

				$data3 = array(
					'tgl_cair' 			=> $this->input->post('tgl_cair'),
					'kd_proyek'			=> $this->input->post('kd_proyek2'),
					'updated_cair' 		=> date('Y-m-d : h:m:s'),
				);
				$id_proyek = $this->input->post('kd_proyek2');
				$this->proyek_model->update_status_pencairan($data3,$id_proyek);

				$data2 = array(
					'username' 			=> $this->session->userdata('username'),
					'tgl_transfer'		=> $this->input->post('tgl_cair'),
					'no_transfer' 		=> str_replace('PDP','TF',$this->input->post('nomor')),
					'no_cair' 			=> $this->input->post('nomor'),
					'kd_proyek'			=> $this->input->post('kd_proyek2'),
					'id_proyek'			=> $id,
					'kd_area'			=> substr($id,0,2),
					'jenis_cair'		=> $this->input->post('jns_pencairan'),
					'kd_rekening'		=> $this->input->post('rek_pencairan'),
					'nilai'				=> $this->proyek_model->number($this->input->post('nilai_bruto')),
					'created_at' 		=> date('Y-m-d  h:m:s'),
				);
				$data2 		= $this->security->xss_clean($data2);

				if ($rek_pencairan !='1'){
					$this->proyek_model->simpan_transfer_proyek($data2);
				}

				

				$kodearea 					= $this->input->post('areas', TRUE);
				$urutan 					= $this->input->post('urut', TRUE);
				
					$data2 = array(
						'no_pdp' => $urutan
					);

				$result = $this->pdo_model->update_nomor($data2,$kodearea);

				// UPDATE STATUS PENCAIRAN
				$data2 = array(
					'tgl_cair' 			=> $this->input->post('tgl_cair'),
					'status_cair'		=> 1,
					'updated_cair' 		=> date('Y-m-d  h:m:s')
				);
				$data2 		= $this->security->xss_clean($data2);
				$result 	= $this->proyek_model->cair_proyek($data2, $id_proyek);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Data proyek berhasil dicairkan!');
					redirect(base_url('pencairan/detail/'.$id),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'proyek gagal dicairkan!');
					redirect(base_url('pencairan/detail/'.$id),'refresh');
				}
			
		}
		else{
			$data['title'] = 'Pencairan Proyek';
			$data['proyek'] = $this->proyek_model->get_proyek_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pencairan/proyek_edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	public function potongan($id = 0, $id_proyek= 0, $nomor= 0){

		$nomor_new = str_replace('ab56b4d92b40713acc5af89985d4b786','/',$nomor);
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'id_cair' 			=> $id,
					'nomor' 			=> $nomor_new,
					'id_proyek'			=> $id_proyek,
					'kd_acc'			=> $this->input->post('kd_acc'),
					'nm_acc'			=> $this->input->post('nm_acc'),
					'nilai'				=> $this->proyek_model->number($this->input->post('nilai')),
					'created_at' 		=> date('Y-m-d : h:m:s'),
				);
				$data 		= $this->security->xss_clean($data);
				$result 	= $this->proyek_model->simpan_cair_potongan($data,$id);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Potongan berhasil diinput!');
					redirect(base_url('pencairan/potongan/'.$id.'/'.$id_proyek.'/'.$nomor),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Potongan gagal diinput!');
					redirect(base_url('pencairan/potongan/'.$id.'/'.$id_proyek.'/'.$nomor),'refresh');
				}
			
		}
		else{
			$data['pencairan'] 		= $this->proyek_model->get_nilai_cair($nomor);
			$data['title'] 			= 'Potongan Pencairan';
			$data['proyek'] 		= $this->proyek_model->get_proyek_by_id($id_proyek);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pencairan/proyek_potongan', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	function get_nomor(){
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->proyek_model->get_nomor_pdp($area)->result();
		echo json_encode($data);
	}


	public function batal($id = 0){

		$data['data_area'] 			= $this->area->get_area();
		$data['data_subarea'] 		= $this->subarea->get_subarea();
		$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
		$data['data_perusahaan'] 	= $this->perusahaan->get_perusahaan();
		$data['data_dinas'] 		= $this->dinas->get_dinas();
		$data['data_pagu'] 			= $this->pagu->get_pagu();

		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$data = array(
					'username_cair' 	=> $this->session->userdata('username'),
					'tgl_cair' 			=> null,
					'status_cair'		=> 0,
					'updated_cair' 		=> date('Y-m-d : h:m:s'),
				);
				$data 		= $this->security->xss_clean($data);
				$id_proyek 	= $this->input->post('kd_proyek');
				$result 	= $this->proyek_model->cair_proyek($data, $id_proyek);
				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);

					$this->session->set_flashdata('success', 'Data proyek berhasil dibatalcairkan!');
					redirect(base_url('pencairan'),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'proyek gagal dibatalcairkan!');
					redirect(base_url('pencairan/edit/'.$id),'refresh');
				}
			
		}
		else{
			$data['title'] = 'Edit Proyek';
			$data['proyek'] = $this->proyek_model->get_proyek_by_id($id);
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pencairan/proyek_batal', $data);
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
			}else{
				$tanggal2=$this->input->post('tanggal2');
			}
				$data = array(
					'jns_pagu' 			=> $this->input->post('jnspagu'),
					'jns_pph' 			=> $this->input->post('jns_pph'),
					'lama_pekerjaan'	=> $this->input->post('lama_pekerjaan'),
					'tipe_proyek' 		=> $this->input->post('tipeproyek'),
					'no_dokumen'		=> $this->input->post('nodpa'),
					'nilai' 			=> $this->proyek_model->angka($this->input->post('nilai')),
					'tanggal' 			=> $this->input->post('tanggal'),
					'tanggal2' 			=> $tanggal2,
					'username'			=> $this->session->userdata('username'),
					'updated_at'		=> date("Y-m-d h:i:s")
				);


				// update ke PQ kalau proyek ada di PQ get_spk_by_year

            $idproyek 		= $this->input->post('id_proyek', TRUE);
            $cekproyek		= $this->proyek_model->cek_proyek($idproyek);
            $jumlahproyek 	= $cekproyek['jumlah'];

            // echo $jumlahproyek;

            if ($jumlahproyek==1){ //CEK Proyek ada PQ atau tidak START
            	$pqproyek		= $this->proyek_model->pq_proyek($idproyek);
            	$nilaispk 		= $this->proyek_model->angka($this->input->post('nilai', TRUE));
            	$jenispph 		= $this->input->post('jns_pph', TRUE);

            	$jenispagu 		= $this->input->post('jnspagu');


            	$idPQproyekedit = $pqproyek['id_pqproyek'];

            	if($jenispph==22){
            		$pph = (1.5/100)*((100/110)*$nilaispk);
            		$ppn = (11/100)*((100/110)*$nilaispk);
            	}else if($jenispph==23){
            		$pph = (2/100)*((100/110)*$nilaispk);
            		$ppn = (11/100)*((100/110)*$nilaispk);
            	}else if($jenispph==21){
            		$pph = (50/100)*((5/100)*$nilaispk);
            		$ppn =0;
            	}

            $spk_net = $nilaispk - $pph - $ppn;

            // Infaq
            if($pqproyek['status_infaq']==1){
            	$infaq = 1/100*$nilaispk;
            }else{
            	$infaq = 0;
            }

            // Titipan
            if ($pqproyek['status_titipan']==1){
            	$nilaititipan = $pqproyek['titipan_net'];
            }else{
            	$nilaititipan = $pqproyek['titipan'];
            }

            $pendapatanNett = $spk_net-$infaq-$nilaititipan;

            // PL
            if ($pqproyek['ppl']>0){
            	$nilaiPPL = $pqproyek['ppl'];
            	$nilaiNPL = $pqproyek['npl'];
            	$nilaiPL  = $pqproyek['ppl'];
            }else{
            	
            	$persenPL = $pqproyek['persen_pl'];
            	$nilaiNPL = $persenPL*$pendapatanNett/100;
            	$nilaiPPL = 0;
            	$nilaiPL  = $nilaiNPL;
            }

            // SUBTOTAL A
            $nilaiSubTotalA = $pendapatanNett-$nilaiPL;

            // ALOKASI HO
            $nilaiAHO= 15*$pendapatanNett/100;

            
            // DATA untuk di save
            $data2 = array(
            	'ppn'				=> $ppn,
            	'pph'				=> $pph,
            	'spk_net'			=> $spk_net,
            	'infaq'				=> $infaq,
            	'pendapatan_nett'	=> $pendapatanNett,
            	'npl' 				=> $nilaiNPL,
            	'ppl' 		  		=> $nilaiPPL,
            	'sub_total_a' 		=> $nilaiSubTotalA,
            	'nalokasi_ho' 		=> $nilaiAHO,
            	'jns_pagu'			=> $jenispagu
            );


            $this->pq_model->update_nilai_PQ($data2,$idPQproyekedit);

            }//CEK Proyek ada PQ atau tidak END

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

			if ($row['no_dokumen']=="" || $row['no_dokumen']==null){
				$anchor='';
			}else{
				$anchor = anchor($row['dokumen'], 'preview','target="_blank"');
			}
			$data[]= array(
				++$i,
				'<font size="2px">'.$row['nm_jns_pagu'].'</font>',
				'<font size="2px">'.$row['jns_pph'].'</font>',
				'<font size="2px">'.$row['nm_tipe_proyek'].'</font>',
				'<font size="2px">'.$row['tanggal'].'</font>',
				'<font size="2px">'.$row['tanggal2'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['nilai'],2,',','.').'</font></div>',
				'<font size="2px">'.$row['no_dokumen'].'</font>',
				'<font size="2px">'.$anchor.'</font>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	public function datatable_json_rincian_cair($id){				   					   
		$records['data'] = $this->proyek_model->get_subproyek_cair_by_id($id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			if ($row['jenis_cair']=='1'){
				$jenis_cair ='Uang Muka';
			}else if ($row['jenis_cair']=='2'){
				$jenis_cair ='Termin I';
			}else if ($row['jenis_cair']=='3'){
				$jenis_cair ='Termin II';
			}else if ($row['jenis_cair']>=4 && $row['jenis_cair']<=15){
				$jenis_cair ='Termin III';
			}else{
				$jenis_cair ='Lunas';
			}


			if ($row['rek_pencairan']=='1'){
				$rek_pencairan ='Rekening Lokal';
			}else if ($row['rek_pencairan']=='1010301'){
				$rek_pencairan ='Bank BRI MSM - Veteran Rek. 10302';
			}else if ($row['rek_pencairan']=='1010302'){
				$rek_pencairan ='Bank BRI UMI - Veteran Rek. 12304';
			}else if ($row['rek_pencairan']=='1010303'){
				$rek_pencairan ='Bank BRI RUB - Tanah Abang Rek. 23305';
			}else if ($row['rek_pencairan']=='1010304'){
				$rek_pencairan ='Bank BRI PSK - Tanah Abang Rek. 24308';
			}else if ($row['rek_pencairan']=='1010305'){
				$rek_pencairan ='Bank BRI MSM - Veteran 42152';
			}else if ($row['rek_pencairan']=='1010306'){
				$rek_pencairan ='Bank BRI RUB - Veteran Rek. 87303';
			}else if ($row['rek_pencairan']=='1010307'){
				$rek_pencairan ='Bank Rekening Pandawa 81304';
			}else if ($row['rek_pencairan']=='1010308'){
				$rek_pencairan ='Bank BCA MSM Harmoni Plaza';
			}else if ($row['rek_pencairan']=='1010309'){
				$rek_pencairan ='BRI umi veteran rek 032901003618309';
			}else if ($row['rek_pencairan']=='1010310'){
				$rek_pencairan ='BPD Papua PT UMI';
			}else{
				$rek_pencairan='-';
			}


			$nomor = str_replace('/','ab56b4d92b40713acc5af89985d4b786',$row['nomor']);

			if($row['status_terima']=='1'){
				$tombol = '
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pencairan/cetak_pdp/'.$row['id'].'/'.$id).'" target="_blank" > <i class="fa fa-print"></i></a>';
			}else{
				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pencairan/delete_cair/".$row['id']."/".$id."/".$nomor).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Potongan" class="potongan btn btn-sm btn-warning" href='.base_url("pencairan/potongan/".$row['id']."/".$id."/".$nomor).' title="Potongan"> <i class="fa fa-percent"></i></a>
				<a title="Cetak" class="update btn btn-sm btn-dark" href="'.base_url('pencairan/cetak_pdp/'.$row['id'].'/'.$id).'" target="_blank" > <i class="fa fa-print"></i></a>';
			}



			$data[]= array(
				++$i,
				'<font size="2px">'.$row['nomor'].'</font>',
				'<font size="2px">'.$row['tgl_cair'].'<br>'.$jenis_cair.'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['nilai_bruto'],2,',','.').'</font></div>',
				'<font size="2px">'.$rek_pencairan.'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['potongan'],2,',','.').'</font></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	public function datatable_json_rincian_potongan($id,$id_proyek,$nomor){				 

		$nomor_new = str_replace('ab56b4d92b40713acc5af89985d4b786','/',$nomor);  					   
		$records['data'] = $this->proyek_model->get_potongan_cair_by_id($id_proyek,$nomor_new);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pencairan/delete_potongan/".$id.'/'.$id_proyek.'/'.$nomor.'/'.$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_acc'].'</font>',
				'<font size="2px">'.$row['nm_acc'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['nilai'],2,',','.').'</font></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


	function get_data_detail_edit(){
		$id = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_detail_pencairan_proyek_by_id($id)->result();
		echo json_encode($data);
	}

	function get_data_detail_rincian_edit(){
		$id = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_detail_rincian_proyek_by_id($id)->result();
		echo json_encode($data);
	}

	function get_data_detail_rincian_cair_edit(){
		$id = $this->input->post('id',TRUE);
		$data = $this->proyek_model->get_detail_rincian_proyek_cair_by_id($id)->result();
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


	public function delete_cair($id = 0, $id_proyek= 0, $nopdp=0)
	{
		$this->rbac->check_operation_access('');

		$nomor = str_replace('ab56b4d92b40713acc5af89985d4b786','/', $nopdp);

			$this->db->delete('ci_proyek_cair', array('id_proyek' => $id_proyek, 'id' => $id,));
			$this->db->delete('ci_proyek_cair_potongan', array('id_proyek' => $id_proyek, 'id_cair' => $id,));

			$this->db->delete('ci_proyek_transfer', array('no_cair' => $nomor));

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pencairan/detail/'.$id_proyek));
		
	}

	public function delete_potongan($id = 0, $id_proyek= 0, $nomor=0, $id_potongan= 0)
	{
		$this->rbac->check_operation_access('');

			$this->db->delete('ci_proyek_cair_potongan', array('id' => $id_potongan));

			$result = $this->proyek_model->update_nilai_transfer($id);

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pencairan/potongan/'.$id.'/'.$id_proyek.'/'.$nomor));
		
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

	public function cetak_pdp($id=0,$id_proyek=0)
	{	
		$data['pdp_header'] 		= $this->proyek_model->get_pdp_header($id,$id_proyek);
		$data['pdp_detail'] 		= $this->proyek_model->get_pdp_detail($id,$id_proyek);
		$data['ttd'] 				= $this->pdo_model->get_ttd_pdp($id_proyek);

		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan_pdo.pdf";
			    $this->pdf->load_view('user/pencairan/cetak_pdp', $data);
                break;
            case 1;
                echo "<title>Cetak PDO</title>";
                echo $this->load->view('user/pencairan/cetak_pdp', $data);
               break;
        }

	}


	

}


?>