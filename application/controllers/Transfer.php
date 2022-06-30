<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transfer extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('user/transfer_model', 'transfer_model');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	public function index(){
		$data['title'] = 'Transfer Pencairan';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/transfer/list');
		$this->load->view('admin/includes/_footer');
	}

public function datatable_json(){				   					   
		$records['data'] = $this->transfer_model->get_all_transfer_pencairan();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			if ($row['approve']==1){
				$tombol = '<a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('transfer/cetak_transfer/'.str_replace("/","f58ff891333ec9048109908d5f720903",$row['no_transfer'])).'"> <i class="fa fa-print"></i></a>';
				$status='<span class="badge badge-success">Diterima</span>';
			}else{
				$tombol = '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('transfer/edit/'.str_replace("/","f58ff891333ec9048109908d5f720903",$row['no_transfer'])).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('transfer/delete_transfer/'.str_replace("/","f58ff891333ec9048109908d5f720903",$row['no_transfer'])).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('transfer/cetak_transfer/'.str_replace("/","f58ff891333ec9048109908d5f720903",$row['no_transfer'])).'" target="_blank"> <i class="fa fa-print"></i></a>';
				$status='<span class="badge badge-danger">Belum diterima</span>';
			}


			$data[]= array(
				++$i,
				'<font size="2px">'.$row['no_transfer'].'</font>',
				'<font size="2px">'.$row['tgl_transfer'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<font size="2px">'.$row['nm_rekening'].'</font>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai']-$row['potongan'],2,",",".").'</font></span></div>',
				$status,
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function add(){
		$this->rbac->check_operation_access('');
		if($this->input->post('type')==1){
			$data['no_transfer'] 		= $this->input->post('no_transfer', TRUE);
			$data['no_cair'] 			= $this->input->post('no_cair', TRUE);
			$data['tgl_transfer']		= $this->input->post('tgl_transfer', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['id_proyek']			= $this->input->post('id_proyek', TRUE);
			$data['kd_proyek']			= $this->input->post('kd_proyek', TRUE);
            $data['kd_rekening']		= $this->input->post('item_hpp', TRUE);
			$data['nilai']				= $this->input->post('nilai', TRUE);

			$result = $this->transfer_model->save_transfer($data);
			
					echo json_encode(array(
							"statusCode"=>200
						));
				
		}else{
			$data['data_area'] 			= $this->area->get_area();
			$data['item_hpp'] 			= $this->transfer_model->get_coa_item();
			$data['data_pencairan'] 	= $this->transfer_model->get_pencairan();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/transfer/tambah', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

public function add_transfer(){
		
		if($this->input->post('submit')){

				$nomor_transfer 			= $this->security->xss_clean($this->input->post('nomor'));
				
				$this->transfer_model->add_transfer($nomor_transfer);
				// $this->pdo_model->update_keterangan_gaji($kdpdo, $keterangan, $jenis_transfer,$jnspdo);

				$kodearea 					= $this->input->post('kode_area', TRUE);
				$urutan 					= $this->input->post('urut', TRUE);
				
					$data2 = array(
						'no_transfer' => $urutan
					);

				$result = $this->transfer_model->update_nomor($data2,$kodearea);
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'Transfer berhasil ditambahkan!');
					redirect(base_url('transfer'));
				}else{
					$this->session->set_flashdata('errors', 'Transfer gagal ditambahkan!');
					redirect(base_url('transfer/add'));
				}
			
		}
		
	}



	function get_nomor(){
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->transfer_model->get_nomor_transfer($area)->result();
		echo json_encode($data);
	}

	function get_pq_pencairan_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->transfer_model->get_pq_pencairan_by_area($area)->result();
		echo json_encode($data);
	}

	function get_nilai_cair_netto(){
		$id 		= $this->input->post('id',TRUE);
		$data 		= $this->transfer_model->get_nilai_cair_netto($id)->result();
		echo json_encode($data);
	}

	public function view($id){
  	$id_new 			= str_replace('abcde','/',$id);
    $search 			= $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
    $limit 				= $_POST['length']; // Ambil data limit per page
    $start 				= $_POST['start']; // Ambil data start
    $order_index 	= $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
    $order_field 	= $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_ascdesc 	= $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
    
    $sql_total 		= $this->transfer_model->count_all($id_new); // Panggil fungsi count_all pada SiswaModel
    $sql_data 		= $this->transfer_model->filter($search, $limit, $start, $order_field, $order_ascdesc,$id_new); // Panggil fungsi filter pada SiswaModel
    $sql_filter 	= $this->transfer_model->count_filter($search); // Panggil fungsi count_filter pada SiswaModel
    $callback = array(
        'draw'=>$_POST['draw'], // Ini dari datatablenya
        'recordsTotal'=>$sql_total,
        'recordsFiltered'=>$sql_filter,
        'data'=>$sql_data
    );
    header('Content-Type: application/json');
    echo json_encode($callback); // Convert array $callback ke json
  }

public function edit($no_transfer='')
	{		
			$this->rbac->check_operation_access('');

			if($this->input->post('type')==1){
				$data['no_transfer'] 		= $this->input->post('no_transfer', TRUE);
				$data['no_cair'] 			= $this->input->post('no_cair', TRUE);
				$data['tgl_transfer']		= $this->input->post('tgl_transfer', TRUE);
				$data['kd_area'] 			= $this->input->post('area', TRUE);
				$data['id_proyek']			= $this->input->post('id_proyek', TRUE);
				$data['kd_proyek']			= $this->input->post('kd_proyek', TRUE);
	            $data['kd_rekening']		= $this->input->post('item_hpp', TRUE);
				$data['nilai']				= $this->input->post('nilai', TRUE);
				$result = $this->transfer_model->save_edit_transfer($data);
				
				echo json_encode(array(
						"statusCode"=>200
					));
			}
			else{
				$data2['title'] 				= 'Edit Transfer';
				$data['data_area'] 			= $this->area->get_area();
				$data['item_hpp'] 			= $this->transfer_model->get_coa_item();
				$data['data_transfer'] 		= $this->transfer_model->get_transfer_by_id($no_transfer);
				$this->load->view('admin/includes/_header', $data2);
				$this->load->view('user/transfer/edit', $data);
				$this->load->view('admin/includes/_footer');
			}
		
	}


public function datatable_json_edit($nomor='',$no_cair=''){				
		
		$id_new = str_replace('abcde','/',$nomor);

		$records['data'] = $this->transfer_model->get_transfer_proyek($nomor);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  


				$no_cairs = str_replace("/","f58ff891333ec9048109908d5f720903",$row['no_cair']);

				$data[]= array(
				$row['no_transfer'],
				$row['tgl_transfer'],
				$row['no_cair'],
				number_format($row['nilai'],2,',','.'),
				number_format($row['potongan'],2,',','.'),
				'<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("transfer/delete_transfer_pdp/".$row['id']).'/'.$nomor.'/1'.' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Potongan" class="delete btn btn-sm btn-warning" href='.base_url("transfer/potongan/".$row['id']).'/'.$nomor.'/'.$no_cairs.' ><i class="fa fa-percent"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}


public function datatable_json_transfer_edit($nomor='',$no_cair=''){				
		
		$id_new = str_replace('abcde','/',$nomor);
		$records['data'] = $this->transfer_model->get_transfer_proyek($nomor);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$no_cairs = str_replace("/","f58ff891333ec9048109908d5f720903",$row['no_cair']);

				$data[]= array(
				$row['no_transfer'],
				$row['tgl_transfer'],
				$row['no_cair'],
				number_format($row['nilai'],2,',','.'),
				number_format($row['potongan'],2,',','.'),
				'<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("transfer/delete_transfer_pdp/".$row['id']).'/'.$id_new.' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Potongan" class="delete btn btn-sm btn-warning" href='.base_url("transfer/potongan/".$row['id']).'/'.$nomor.'/'.$no_cairs.' ><i class="fa fa-percent"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

public function delete_transfer_pdp($id = 0, $no_tf = 0)
	{
		$this->rbac->check_operation_access('');
			// $hasil=$this->db->query("SELECT status_bayar as status from ci_pdo a where id_pdo='$id'");
			// 	foreach ($hasil->result_array() as $row){
			// 		$status 	=$row['status']; 
					
			// 	}

			// if ($status==1){
			// 	$this->session->set_flashdata('errors', 'PDO Sudah dicairkan!');
			// 	redirect(base_url('cpdo/'));				
			// }else{
				$this->db->delete('ci_proyek_transfer', array('id' => $id));	
				$this->activity_model->add_log(3);
				$this->session->set_flashdata('success', 'Data berhasil dihapus!');
				redirect(base_url('transfer/edit/'.$no_tf));
			// }
		
	}

public function potongan($id = 0, $nomor= 0, $no_cair=0){

		$nomor_new 	= str_replace('f58ff891333ec9048109908d5f720903','/',$nomor);
		$nocair_new = str_replace('f58ff891333ec9048109908d5f720903','/',$no_cair);
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$data = array(
					'username' 			=> $this->session->userdata('username'),
					'id_cair' 			=> $id,
					'nomor' 			=> $nomor_new,
					'no_cair'			=> $nocair_new,
					'kd_acc'			=> $this->input->post('kd_acc'),
					'nilai'				=> $this->proyek_model->number($this->input->post('nilai')),
					'created_at' 		=> date('Y-m-d : h:m:s'),
				);
				$kd_acc 			= $this->security->xss_clean($this->input->post('kd_acc'));
				
				if ($kd_acc=='5020101'){
					$tgl_spj 		= $this->security->xss_clean($this->input->post('tgl_spj'));
					$keterangan 	= $this->security->xss_clean($this->input->post('keterangan'));
				}else if ($kd_acc=='5020501'){
					$tgl_spj 		= $this->security->xss_clean($this->input->post('tgl_spj'));
					$keterangan 	= $this->security->xss_clean($this->input->post('keterangan'));
				}else{
					$tgl_spj 		= "";
					$keterangan 	= "";
				}
				$nilai				= $this->security->xss_clean($this->proyek_model->number($this->input->post('nilai')));
				$created_at			= date('Y-m-d : h:m:s');
				$username 			= $this->security->xss_clean($this->session->userdata('username'));

				$data 				= $this->security->xss_clean($data);
				$result 			= $this->transfer_model->simpan_cair_potongan($data,$kd_acc,$tgl_spj,$created_at,$username,$nilai,$keterangan,$nomor_new);

				if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					$this->session->set_flashdata('success', 'Potongan berhasil diinput!');
					redirect(base_url('transfer/potongan/'.$id.'/'.$nomor.'/'.$no_cair),'refresh');
				}else{
					$this->session->set_flashdata('errors', 'Potongan gagal diinput!');
					redirect(base_url('transfer/potongan/'.$id.'/'.$nomor.'/'.$no_cair),'refresh');
				}
			
		}
		else{
			$data['transfer'] 		= $this->transfer_model->get_data_transfer($nomor);
			$data['data_rekening']	= $this->pdo_model->get_rekening();
			$data2['title'] 			= 'Potongan transfer';
			// $data['proyek'] 		= $this->transfer_model->get_proyek_by_id($id_proyek);
			$this->load->view('admin/includes/_header', $data2);
			$this->load->view('user/transfer/proyek_potongan', $data);
			$this->load->view('admin/includes/_footer');
		}
	}

public function datatable_json_rincian_potongan($id,$nomor,$no_cair){				   					   
		$records['data'] = $this->transfer_model->get_potongan_transfer_by_id($nomor,$no_cair);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

				$tombol='<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("transfer/delete_potongan/".$id.'/'.$nomor.'/'.$no_cair.'/'.$row['id'].'/'.$row['kd_acc']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';

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

public function delete_potongan($id = 0, $nomor= 0, $no_cair=0, $id_potongan= 0,$kd_acc=0)
	{
		$this->rbac->check_operation_access('');

			$query3 		= "SELECT id_spj,substring(no_cair,10,2)as kd_area from ci_proyek_transfer_potongan where id='$id_potongan'";
			$hasil3 		= $this->db->query($query3);
			$id_spj 		= $hasil3->row('id_spj');
			$kd_area 		= $hasil3->row('kd_area');

			$this->db->delete('ci_spj', array('no_spj' => $id_spj, 'kd_area' => $kd_area));
			
			$this->db->delete('ci_proyek_transfer_potongan', array('id' => $id_potongan));

			$this->activity_model->add_log(3);

			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect(base_url('transfer/potongan/'.$id.'/'.$nomor.'/'.$no_cair));
		
	}

public function delete_transfer($id = 0)
	{
		$this->rbac->check_operation_access('');

			$id_hapus = str_replace("f58ff891333ec9048109908d5f720903","/",$id);

			$hasil=$this->db->query("SELECT approve as status from ci_proyek_transfer a where no_transfer='$id_hapus'");
				foreach ($hasil->result_array() as $row){
					$status 	=$row['status']; 
					
				}

			if ($status==1){
				$this->session->set_flashdata('errors', 'Data Transfer Sudah di approve!');
				redirect(base_url('transfer'));				
			}else{
				$this->db->delete('ci_proyek_transfer', array('no_transfer' => $id_hapus));	
				$this->db->delete('ci_proyek_transfer_potongan', array('nomor' => $id_hapus));	
				$this->activity_model->add_log(3);
				$this->session->set_flashdata('success', 'Data Transfer berhasil dihapus!');
				redirect(base_url('transfer'));
			}
		
	}

public function cetak_transfer($id=0)
	{	
		$id_cetak = str_replace("f58ff891333ec9048109908d5f720903","/",$id);

		$data['transfer_header'] 		= $this->transfer_model->get_transfer_header($id_cetak);
		$data['transfer_detail'] 		= $this->transfer_model->get_transfer_detail($id_cetak);
		$data['ttd'] 					= $this->transfer_model->get_ttd_transfer($id_cetak);

		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan_pdo.pdf";
			    $this->pdf->load_view('user/transfer/cetak_pdp', $data);
                break;
            case 1;
                $this->load->view('user/transfer/cetak_pdp', $data);
               break;
        }

	}

function get_nilai(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->transfer_model->get_nilai($id, $no_acc)->result();
		echo json_encode($data);
	}

function get_realisasi(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->transfer_model->get_realisasi($id, $no_acc)->result();
		echo json_encode($data);
	}


}
?>