<?php defined('BASEPATH') OR exit('No direct script access allowed');

class pembayaranTahunLalu extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        // $this->rbac->check_module_access();
		$this->load->model('admin/pelimpahan_model', 'pelimpahan_model');
		$this->load->model('admin/pembayarantahunlalu_model', 'pembayarantahunlalu_model');
		$this->load->model('admin/Activity_model', 'activity_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/Spj_pegawai_model', 'spjpegawai_model');
		$this->load->model('user/spj_model', 'spj_model');
		
    }

	//-----------------------------------------------------		
	function index($subarea=''){
		$this->rbac->check_module_access();
		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'pembayaran Tahun Lalu';

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/pembayarantahunlalu/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------		
	function list_terima($subarea=''){
		$this->rbac->check_module_access();
		// $this->rbac->check_operation_access();
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'pembayaran Tahun Lalu';

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/pembayarantahunlalu/terima', $data);
		$this->load->view('admin/includes/_footer');
	}

	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->pembayarantahunlalu_model->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  		
			if($row['status_terima']==1){
				$button='<p class="text-success">Diterima</p>';
			}else{
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pembayaran_hutang_tahun_lalu/edit/'.$row['id']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pembayaran_hutang_tahun_lalu/delete/".$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Potongan" class="update btn btn-sm btn-secondary" href="'.base_url('pembayaran_hutang_tahun_lalu/potongan/'.str_replace("/","",$row['no_bukti']).'/'.$row['kd_pegawai_asal']).'"> <i class="fa fa-percent"></i></a>';
			}
				
		
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['tgl_bayar'],
				$row['nm_pegawai'],
                $row['keterangan'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['potongan'],2,",",".").'</font></span></div>',
				$button
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function datatable_json_terima(){				   					   
		$records['data'] = $this->pembayarantahunlalu_model->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  		
			if($row['status_terima']==1){
				$button='<a title="Batal" class="update btn btn-sm btn-success" href="'.base_url('penerimaan_pembayaran_hutang_tahun_lalu/terima/'.$row['id']).'"> <i class="fa fa-check-square-o"></i></a>';
			}else{
				$button='<a title="Terima" class="update btn btn-sm btn-danger" href="'.base_url('penerimaan_pembayaran_hutang_tahun_lalu/terima/'.$row['id']).'"> <i class="fa fa-list"></i></a>';
			}
				
		
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['tgl_bayar'],
				$row['nm_pegawai'],
                $row['keterangan'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['potongan'],2,",",".").'</font></span></div>',
				$button
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	function add(){
		// $this->rbac->check_module_access();
		$this->rbac->check_operation_access(); // check opration permission

			$data['data_area'] 			= $this->area->get_area();
            $data['title'] 			= 'Input Pembayaran Tahun Lalu';

		if($this->input->post('submit')){
				$this->form_validation->set_rules('area', 'Area', 'trim|required');
				$this->form_validation->set_rules('saldo', 'Saldo', 'trim|required');
                $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
				$this->form_validation->set_rules('kd_pegawai', 'Pegawai/Rekening', 'trim|required');
				$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
				
				$nomor				= $this->pelimpahan_model->get_nomor_kb();
                $nilai = $this->proyek_model->number($this->input->post('nilai'));
                $saldo = $this->proyek_model->number($this->input->post('saldo'));

                if ($nilai>$saldo){
                    $data = array(
						'errors' => 'Saldo anda tidak cukup'
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pembayarantahunlalu/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pembayarantahunlalu/add'),'refresh');
				}
				else{
					$data = array(
						'no_bukti' 		    => $nomor['nomor'],
						'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'tgl_bayar'    => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'jenis'        		=> 'tahunlalu',
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->pembayarantahunlalu_model->simpan($data);
					if($result){

						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Pembayaran  berhasil ditambahkan!');
						redirect(base_url('pembayaran_hutang_tahun_lalu'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pembayarantahunlalu/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	//-----------------------------------------------------------


	
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pelimpahan_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

	function get_rek_kas(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pembayarantahunlalu_model->get_pegawai_tunai_by_area()->result();
		echo json_encode($data);
	}

    function get_kas(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spj_model->get_kas($id)->result();
		echo json_encode($data);
	}
	function get_nomor(){
		$kd_pegawai 		= $this->input->post('kd_pegawai',TRUE);
		$data 		= $this->spjpegawai_model->get_nomor_pelimpahan($kd_pegawai)->result();
		echo json_encode($data);
	}
	function get_kas_area(){
		$id 		= $this->input->post('id',TRUE);
        $jns_kas 		= $this->input->post('jns_kas',TRUE);
        if ($jns_kas=='TUNAI'){
            $data 		= $this->spjpegawai_model->get_kas_tunai($id)->result();
        }else{
            $data 		= $this->spjpegawai_model->get_kas($id)->result();
        }
		
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
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');

            $nilai = $this->proyek_model->number($this->input->post('nilai'));
            $saldo = $this->proyek_model->number($this->input->post('saldo'));
			if ($nilai>$saldo){
                $data = array(
                    'errors' => 'Saldo anda tidak cukup'
                );
                $this->session->set_flashdata('errors', $data['errors']);
                redirect(base_url('pembayarantahunlalu/add'),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pembayarantahunlalu/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					    'kd_area' 		    => $this->input->post('area'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'tgl_bayar'    => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pembayarantahunlalu_model->edit_pembayarantahunlalu($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Pembayaran berhasil diupdate!');
					redirect(base_url('pembayaran_hutang_tahun_lalu'));
				}
			}
		}
		elseif($id==""){
			redirect('pembayaran_hutang_tahun_lalu');
		}
		else{
			$data2['title'] = "Pembayaran Tahun Lalu";
			$data['bank'] = $this->pembayarantahunlalu_model->get_pembayarantahunlalu_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pembayarantahunlalu/edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}

	function terima($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            $this->form_validation->set_rules('no_kas', 'No Kas', 'trim|required');
            $this->form_validation->set_rules('tanggal_terima', 'Tanggal terima', 'trim|required');

            $nilai = $this->proyek_model->number($this->input->post('nilai'));
            $saldo = $this->proyek_model->number($this->input->post('saldo'));
			
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('penerimaan_pembayaran_hutang_tahun_lalu/terima/'.$id),'refresh');
			}
			else{
				if($this->input->post('status_terima')==1){
					$data = array(
					    'no_terima' 		    => $this->input->post('no_kas'),
						'tgl_terima'   		 	=> $this->input->post('tanggal_terima'),
						'status_terima'   		 => $this->input->post('status_terima')
				);
				}else{
					$data = array(
					    'no_terima' 		    => '',
						'tgl_terima'   		 	=> '',
						'status_terima'   		 => $this->input->post('status_terima')
				);
				}
				

				$data = $this->security->xss_clean($data);
				$result = $this->pembayarantahunlalu_model->edit_pembayarantahunlalu($data, $id);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Pembayaran berhasil diupdate!');
					redirect(base_url('penerimaan_pembayaran_hutang_tahun_lalu'));
				}
			}
		}
		elseif($id==""){
			redirect('penerimaan_pembayaran_hutang_tahun_lalu');
		}
		else{
			$data2['title'] = "Pembayaran Tahun Lalu";
			$data['bank'] = $this->pembayarantahunlalu_model->get_pembayarantahunlalu_by_id($id);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pembayarantahunlalu/edit_terima', $data);
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
		$query="SELECT no_bukti from ci_pembayaran_tahun_lalu where id='$id'";
		$hasil = $this->db->query($query);
		$nomor = $hasil->row('no_bukti');

		$this->db->delete('ci_pembayaran_tahun_lalu_potongan', array('no_kas' =>  $nomor, 'no_kas <>' =>  null));

		$this->pembayarantahunlalu_model->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','Pembayaran berhasil dihapus.');	
		redirect('pembayaran_hutang_tahun_lalu');
	}

	// POTONGAN
	public function potongan($nomor= 0){
		$this->rbac->check_operation_access();
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
				$result 			= $this->pembayarantahunlalu_model->simpan_potongan($data);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Potongan berhasil diinput!');
					redirect(base_url('pembayaran_hutang_tahun_lalu/potongan/'.$nomor),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Potongan gagal diinput!');
					redirect(base_url('pembayaran_hutang_tahun_lalu/potongan/'.$nomor),'refresh');
				}
			
		}
		else{
			$data['transfer'] = $this->pembayarantahunlalu_model->get_potongan_by_id($nomor);
			$data2['title'] 		= 'Potongan Pembayaran';
			// $data['proyek'] 		= $this->pdo_model->get_proyek_by_id($id_proyek);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pembayarantahunlalu/potongan', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	public function datatable_json_rincian_potongan($nomor){				   					   
		$records['data'] = $this->pembayarantahunlalu_model->get_potongan_pembayarantahunlalu_by_id($nomor);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pembayaran_hutang_tahun_lalu/delete_potongan/".$nomor.'/'.$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

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
			$this->db->delete('ci_pembayaran_tahun_lalu_potongan', array('id' => $id, 'no_kas' =>  $nomor));
			$this->activity_model->add_log(3);
			$this->session->set_flashdata('success', 'Potongan berhasil dihapus!');
			redirect(base_url('pembayaran_hutang_tahun_lalu/potongan/'.$nomor));
		
	}
	// POTONGAN


}

?>