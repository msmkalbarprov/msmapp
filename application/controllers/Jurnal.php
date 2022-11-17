<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
        
        $this->load->model('user/jurnal_model', 'jurnal_model');
		// $this->load->model('user/Spj_pegawai_model', 'spjpegawai_model');
		// $this->load->model('user/pq_model', 'pq_model');
		// $this->load->model('user/pdo_model', 'pdo_model');
		// $this->load->model('admin/saldoawal_model', 'saldoawal_model');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/pelimpahan_model', 'pelimpahan_model');
		// $this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'List Jurnal';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/jurnal/index');
		$this->load->view('admin/includes/_footer');
	}

	public function cetak_jurnal(){
		$data2['title'] 		= 'Cetak Jurnal';
		$this->load->view('admin/includes/_header', $data2);
		$this->load->view('user/jurnal/cetak_jurnal');
		$this->load->view('admin/includes/_footer');
	}

	public function cetak_buku_besar(){
		$data2['title'] 		= 'Cetak Jurnal';
		$data['data_area'] 			= $this->area->get_area();
		$this->load->view('admin/includes/_header', $data2);
		$this->load->view('user/jurnal/cetak_bb', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function cetak_jurnal_umum($tahun=0,$jenis=0,$bulan=0,$jns_jurnal=0)
	{	
		$data['list'] 			    = $this->jurnal_model->get_jurnal_umum($tahun,$bulan,$jns_jurnal);
		$data['tahun'] 				= $tahun;
		$data['cjenis'] 			= $jenis;

		if ($bulan==0){
			$data['bulan'] 				= "";	
		}else{
			$data['bulan'] 				= $this->format_indo($bulan);
		}

		
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "jurnal_umum.pdf";
			    $this->pdf->load_view('user/jurnal/jurnal_umum', $data);
                break;
            case 0;
				$html = $this->load->view('user/jurnal/jurnal_umum', $data);
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= jurnal_umum.xls");
				$html;
               	break;
             case 2;
				$this->load->view('user/jurnal/jurnal_umum', $data);
               	break;
        }

	}

	public function cetak_bb($tahun=0,$jenis=0,$bulan=0,$area=0)
	{	
		$data['list'] 			    = $this->jurnal_model->get_rincian_bb($tahun,$bulan,$area);
		$data['list_acc'] 			= $this->jurnal_model->get_acc($tahun,$bulan,$area);
		$data['tahun'] 				= $tahun;

		if($area=='all'){
			$data['area'] 				= array('kd_area'=>'all');
		}else{
			$data['area'] 				= $this->area->get_area_by_kode($area);	
		}
		

		if ($bulan==0){
			$data['bulan'] 				= "";	
		}else{
			$data['bulan'] 				= $this->format_indo($bulan);
		}

		
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "jurnal_umum.pdf";
			    $this->pdf->load_view('user/jurnal/buku_besar', $data);
                break;
            case 0;
				$html = $this->load->view('user/jurnal/buku_besar', $data);
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= buku_besar.xls");
				$html;
               	break;
             case 2;
				$this->load->view('user/jurnal/buku_besar', $data);
               	break;
        }

	}

    public function datatable_json(){				   					   
		$records['data'] = $this->jurnal_model->get_all();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$data[]= array(
				++$i,
				'<font size="2px">'.$row['no_voucher'].'</font>',
				'<font size="2px">'.$row['tgl_voucher'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<font size="2px">'.$row['uraian'].'</font>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['t_debet'],2,",",".").'</font></span></div>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['t_kredit'],2,",",".").'</font></span></div>',
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('jurnal/edit/'.'054d4a4653a16b49c49c49e000075d10'.str_replace('/','1a942eab068a2173e66d08c736283cfe22e1c1ed',$row['no_voucher']).'4e9e388e9acfde04d6bd661a6294f8a0/').'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('jurnal/delete/'.'054d4a4653a16b49c49c49e000075d10'.str_replace('/','1a942eab068a2173e66d08c736283cfe22e1c1ed',$row['no_voucher']).'4e9e388e9acfde04d6bd661a6294f8a0/').' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

    public function add(){
		$this->rbac->check_operation_access('');
			$data2['title'] 			= 'Tambah Jurnal';
			$data['data_area'] 			= $this->area->get_area_jurnal();
			$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
            $data['data_akun'] 			= $this->jurnal_model->get_akun();
			$this->load->view('admin/includes/_header' , $data2);
			$this->load->view('user/jurnal/add', $data);
			$this->load->view('admin/includes/_footer');
	}

	function get_area_pengeluaran(){
		$divisi = $this->input->post('id',TRUE);
		$data = $this->pelimpahan_model->get_area_pengeluaran($divisi)->result();
		echo json_encode($data);
	}

	function edit($id=""){

		$this->rbac->check_operation_access(); // check opration permission

		if($this->input->post('submit')){
            $this->form_validation->set_rules('no_voucher', 'No Voucher', 'trim|required');
            $this->form_validation->set_rules('tgl_voucher', 'Tanggal voucher', 'trim|required');
			$this->form_validation->set_rules('divisi', 'Divisi', 'trim|required');
            $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');
			$this->form_validation->set_rules('area', 'area', 'trim|required');
            $this->form_validation->set_rules('no_acc', 'Akun', 'trim|required');
			$this->form_validation->set_rules('jns_jurnal', 'jenis jurnal', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('jurnal/edit/'.$id),'refresh');
			}
			else{
				if ($this->input->post('c_kd')){
					$data = array(
                        'no_voucher' 	    => $this->input->post('no_voucher'),
                        'tgl_voucher'  	    => $this->input->post('tgl_voucher'),
						'kd_area' 		    => $this->input->post('area'),
                        'no_acc'         	=> $this->input->post('no_acc'),
						'uraian'	    	=> $this->input->post('uraian'),
						'jns_jurnal'    	=> $this->input->post('jns_jurnal'),
						'kd_divisi'    		=> $this->input->post('divisi'),
						'kredit' 		    => 0,
						'debet' 		    => $this->jurnal_model->number($this->input->post('nilai')),
						'username' 		    =>  $this->session->userdata('username'),
						'updated_at' 	    => date('Y-m-d : h:m:s')
				);
				}else{
					$data = array(
                        'no_voucher' 	    => $this->input->post('no_voucher'),
                        'tgl_voucher'  	    => $this->input->post('tgl_voucher'),
						'kd_area' 		    => $this->input->post('area'),
                        'no_acc'         	=> $this->input->post('no_acc'),
						'uraian'	    	=> $this->input->post('uraian'),
						'jns_jurnal'    	=> $this->input->post('jns_jurnal'),
						'kd_divisi'    		=> $this->input->post('divisi'),
						'kredit' 		    => $this->jurnal_model->number($this->input->post('nilai')),
						'debet' 		    => 0,
						'username' 		    => $this->session->userdata('username'),
						'updated_at' 	    => date('Y-m-d : h:m:s')
				);
				}
				

				$data = $this->security->xss_clean($data);
				$result = $this->jurnal_model->simpan_jurnal($data);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(5);
					$this->session->set_flashdata('success', 'Pengeluaran lainnya berhasil diupdate!');
					redirect(base_url('jurnal/edit/'.$id));
				}
			}
		}
		elseif($id==""){
			redirect('jurnal/index');
		}else{
			$data2['title'] 			= 'Edit Jurnal';
			$data['data_area'] 			= $this->area->get_area_pusat();
			$data['data_jnsproyek'] 	= $this->jnsproyek->get_jnsproyek();
            $data['data_akun'] 			= $this->jurnal_model->get_akun();
			$data['jurnal'] 			= $this->jurnal_model->get_jurnal_by_id($id);
			$this->load->view('admin/includes/_header' , $data2);
			$this->load->view('user/jurnal/edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}

	public function simpan_jurnal_umum(){
		
	

		$data= $this->input->post('datasimpan', TRUE);
		$result 					= $this->jurnal_model->save_jurnal_umum($data);
		if ($result){
			$msg = "Data berhasil disimpan tanpa bukti";
			$status	= 200;
		}else{
			$msg = "Data Gagal disimpan tanpa bukti";
			$status	= 00;
		}
		
	
		echo json_encode(array(
			"statusCode"	=>$status,
			"msg" 			=>$msg
		));
	}

	public function delete($no_voucher='')
	{
		$this->rbac->check_operation_access('');
		$no_voucher_new = str_replace('054d4a4653a16b49c49c49e000075d10','',$no_voucher);
		$nomor = str_replace('1a942eab068a2173e66d08c736283cfe22e1c1ed','/',str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',$no_voucher_new));;

		$this->db->delete('ci_jurnal', array('no_voucher' => $nomor));	
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		redirect(base_url('jurnal'));			
	}

	public function delete_rincian($id='',$no_voucher='')
	{
		$this->rbac->check_operation_access('');
		$no_voucher_new = str_replace('054d4a4653a16b49c49c49e000075d10','',$no_voucher);
		$nomor = str_replace('4e9e388e9acfde04d6bd661a6294f8a0','',$no_voucher_new);

		$this->db->delete('ci_jurnal', array('id' => $id));	
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		redirect(base_url('jurnal/edit/'.$no_voucher));			
	}


	public function view($id){				   					   
		$records['data'] = $this->jurnal_model->get_jurnal_by_no_voucher($id);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("jurnal/delete_rincian/".$row['id']."/".$id).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['no_voucher'].'</font>',
				'<font size="2px">'.$row['tgl_voucher'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<font size="2px">'.$row['kd_divisi'].'</font>',
				'<font size="2px">'.$row['nm_acc'].'</font>',
				'<font size="2px">'.$row['uraian'].'</font>',
				'<div class="text-right"><font size="2px">'.number_format($row['debet'],2,',','.').'</font></div>',
				'<div class="text-right"><font size="2px">'.number_format($row['kredit'],2,',','.').'</font></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}
	
	function format_indo($date){
	  $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
	  $bulan = $date;
	  $result = $Bulan[(int)$bulan-1];
	  return $result;
	}
    
}
?>