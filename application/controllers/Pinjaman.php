<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

		$this->load->model('admin/pinjaman_model', 'pinjaman_model');
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
		$data['title'] = 'pinjaman';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/pinjaman/index', $data);
		$this->load->view('admin/includes/_footer');
	}

	//-----------------------------------------------------		
	function pengembalian($subarea=''){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'pinjaman';

		$this->load->view('admin/includes/_header');
		$this->load->view('user/pinjaman/pengembalian', $data);
		$this->load->view('admin/includes/_footer');
	}

	function ambil_tunai(){

		// $this->session->set_userdata('filter_subarea',$subarea);
		$this->session->set_userdata('filter_keyword','');
		$data['title'] = 'Ambil Kas Tunai';
		$this->load->view('admin/includes/_header');
		$this->load->view('user/pinjaman/tunai', $data);
		$this->load->view('admin/includes/_footer');
	}
	//--------------------------------------------------		

public function datatable_json(){				   					   
		$records['data'] = $this->pinjaman_model->get_all();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pinjaman/edit/'.$row['id']).'/'.$row['kd_pegawai'].'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pinjaman/delete/".$row['id']).'/'.$row['kd_pegawai'].' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Potongan" class="update btn btn-sm btn-secondary" href="'.base_url('pinjaman/potongan/'.str_replace("/","",$row['no_bukti'])).'/'.$row['kd_pegawai'].'"> <i class="fa fa-percent"></i></a>';
		
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['tgl_pinjaman'],
				'<b>Asal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> '.$row['nm_pegawai_asal'].'<br> <b>Tujuan :</b> '.$row['nm_pegawai'],
				$row['type'],
                $row['keterangan'],
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
                '<div class="text-right"><span align="right"><font size="2px">'.number_format($row['potongan'],2,",",".").'</font></span></div>',
				$button
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function datatable_json_pengembalian(){				   					   
		$records['data'] = $this->pinjaman_model->get_all_pengembalian();
		$data = array();

		$i=1;
		foreach ($records['data']   as $row) 
		{  
				$button='<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pinjaman/edit/'.$row['id']).'/'.$row['kd_pegawai'].'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pinjaman/delete/".$row['id']).'/'.$row['kd_pegawai'].' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
		
			$data[]= array(
				$i++,
				$row['nm_area'],
				$row['tgl_pengembalian'],
				'<b>Asal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> '.$row['nm_pegawai_asal'].'<br> <b>Tujuan :</b> '.$row['nm_pegawai'],
				$row['type'],
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
            $data['title'] 			= 'Input pinjaman';

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
					redirect(base_url('pinjaman/add'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pinjaman/add'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		    => $this->input->post('area'),
                        'type' 		        => $this->input->post('tipe'),
						'no_bukti' 		    => $this->input->post('no_kas'),
						'jenis' 		    => 'area',
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'kd_pegawai_asal'   => $this->input->post('kd_pegawai_asal'),
						'tgl_pinjaman'      => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$this->pinjaman_model->simpan_pinjaman($data);
						$urutan 					= $this->input->post('no_kas', TRUE);
						$kd_pegawai 				= $this->input->post('kd_pegawai_asal', TRUE);

						$data2 = array(
							'no_spj' => $urutan
						);
						$result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);

					if($result){
						
						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Pinjaman berhasil ditambahkan!');
						redirect(base_url('pinjaman/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pinjaman/add');
        		$this->load->view('admin/includes/_footer');
			}
	}

	function add_pengembalian(){

		$this->rbac->check_operation_access(); // check opration permission

			$data['data_area'] 			= $this->area->get_area();
            $data['title'] 			= 'Input pinjaman';

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
					redirect(base_url('pinjaman/add_pengembalian'),'refresh');
                }
				
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('pinjaman/add_pengembalian'),'refresh');
				}
				else{
					$data = array(
						'kd_area' 		    => $this->input->post('area'),
                        'type' 		        => $this->input->post('tipe'),
						'jenis' 		    => 'area',
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'kd_pegawai_asal'   => $this->input->post('kd_pegawai_asal'),
						'tgl_pengembalian'  => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->pinjaman_model->simpan_pengembalian_pinjaman($data);
						// $urutan 					= $this->input->post('no_kas', TRUE);
						// $kd_pegawai 				= $this->input->post('kd_pegawai_asal', TRUE);

						// $data2 = array(
						// 	'no_spj' => $urutan
						// );
						// $result = $this->spjpegawai_model->update_nomor($data2,$kd_pegawai);

					if($result){
						
						// Activity Log 
						$this->activity_model->add_log(4);

						$this->session->set_flashdata('success', 'Pinjaman berhasil ditambahkan!');
						redirect(base_url('pinjaman/index'));
					}
				}
			}
			else
			{
				$this->load->view('admin/includes/_header', $data);
        		$this->load->view('user/pinjaman/add_pengembalian');
        		$this->load->view('admin/includes/_footer');
			}
	}
	
	function get_pegawai_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pinjaman_model->get_pegawai_by_area($area)->result();
		echo json_encode($data);
	}

	function get_pegawai_kas_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pinjaman_model->get_pegawai_tunai_by_area($area)->result();
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
        $tipe 		= $this->input->post('tipe',TRUE);
        if ($tipe=='TUNAI'){
            $data 		= $this->spjpegawai_model->get_kas_tunai($id)->result();
        }else{
            $data 		= $this->spjpegawai_model->get_kas($id)->result();
        }
		
		echo json_encode($data);
	}

function get_kas_pinjaman_area(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->spjpegawai_model->get_kas_pinjaman($id)->result();
		echo json_encode($data);
}
	//--------------------------------------------------
	function edit($id="",$pegawai=''){

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
                redirect(base_url('pinjaman/add'),'refresh');
            }

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('pinjaman/edit/'.$id),'refresh');
			}
			else{
				$data = array(
					    'kd_area' 		    => $this->input->post('area'),
                        'type' 		        => $this->input->post('tipe'),
						'kd_pegawai' 	    => $this->input->post('kd_pegawai'),
						'kd_pegawai_asal' 	=> $this->input->post('kd_pegawai_asal'),
						'tgl_pinjaman'      => $this->input->post('tanggal'),
                        'keterangan'        => $this->input->post('keterangan'),
						'nilai' 		    => $this->proyek_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'created_at' 	    => date('Y-m-d : h:m:s')
				);

				$data = $this->security->xss_clean($data);
				$result = $this->pinjaman_model->edit_pinjaman($data, $id, $pegawai);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);

					$this->session->set_flashdata('success', 'Pinjaman berhasil diupdate!');
					redirect(base_url('pinjaman/index'));
				}
			}
		}
		elseif($id==""){
			redirect('pinjaman/index');
		}
		else{
			$data2['title'] = "pinjaman";
			$data['bank'] = $this->pinjaman_model->get_pinjaman_by_id($id,$pegawai);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pinjaman/edit', $data);
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
		$query="SELECT no_bukti from ci_pinjaman where id='$id'";
		$hasil = $this->db->query($query);
		$nomor = $hasil->row('no_bukti');

		$this->db->delete('ci_pinjaman_potongan', array('no_kas' =>  $nomor, 'no_kas <>' =>  null));

		$this->pinjaman_model->delete($id);

		// Activity Log 
		$this->activity_model->add_log(6);

		$this->session->set_flashdata('success','pinjaman berhasil dihapus.');	
		redirect('pinjaman/index');
	}

	// POTONGAN
	public function potongan($nomor= 0,$pegawai=0){

		$nomor_new 	= str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$nocair_new = str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'no_kas' 			=> $this->input->post('no_kas'),
                    'kd_pegawai'		=> $this->input->post('rek_asal'),
					'rek_asal' 			=> $this->input->post('rek_asal'),
					'no_acc'			=> $this->input->post('no_acc'),
					'uraian'			=> $this->input->post('keterangan'),
					'nilai'				=> $this->proyek_model->number($this->input->post('nilai')),
					'created_at' 		=> date('Y-m-d : h:m:s'),
				);
				
				$data 				= $this->security->xss_clean($data);
				$result 			= $this->pinjaman_model->simpan_potongan_pinjaman($data);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Potongan berhasil diinput!');
					redirect(base_url('pinjaman/potongan/'.$nomor),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Potongan gagal diinput!');
					redirect(base_url('pinjaman/potongan/'.$nomor),'refresh');
				}
			
		}
		else{
			$data['transfer'] = $this->pinjaman_model->get_pinjaman_potongan_by_id($nomor,$pegawai);
			$data2['title'] 		= 'Potongan pinjaman';
			// $data['proyek'] 		= $this->pdo_model->get_proyek_by_id($id_proyek);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/pinjaman/potongan', $data);
			$this->load->view('admin/includes/_footer');
		}
	}


	public function datatable_json_rincian_potongan($nomor){				   					   
		$records['data'] = $this->pinjaman_model->get_potongan_pinjaman_by_id($nomor);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pinjaman/delete_potongan/".$nomor.'/'.$row['id']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

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
			$this->db->delete('ci_pinjaman_potongan', array('id' => $id, 'no_kas' =>  $nomor));
			$this->activity_model->add_log(3);
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('pinjaman/potongan/'.$nomor));
		
	}
	// POTONGAN


}

?>