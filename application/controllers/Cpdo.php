<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cpdo extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pq_model', 'pq_model');
		$this->load->model('user/pdo_model', 'pdo_model');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'PDO';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/pdo/list');
		$this->load->view('admin/includes/_footer');
	}

	public function operasional(){
		$data['title'] = 'PDO Operasional';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/pdo/list_operasional');
		$this->load->view('admin/includes/_footer');
	}


	public function datatable_json(){				   					   
		$records['data'] = $this->pdo_model->get_all_pdo();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			if ($row['status_bayar']==1){
				$tombol = '<a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('laporan_pdo/cetak_pdo/'.str_replace("/","",$row['id_pdo'])).'"> <i class="fa fa-print"></i></a>';
			}else{
				$tombol = '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pdo/edit_pdo_project/'.str_replace("/","",$row['id_pdo'])).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('pdo/delete_pdo_project/'.str_replace("/","",$row['id_pdo'])).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('laporan_pdo/cetak_pdo/'.str_replace("/","",$row['id_pdo'])).'" target="_blank"> <i class="fa fa-print"></i></a>';
			}


			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_pdo'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

public function datatable_json_operasional(){				   					   
		$records['data'] = $this->pdo_model->get_all_pdo_operasional();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			if ($row['status_bayar']==1){
				$tombol = '<a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('laporan_pdo/cetak_pdo_operasional/'.str_replace("/","",$row['id_pdo'])).'" target="_blank"> <i class="fa fa-print"></i></a>';
			}else{
				$tombol = '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pdo/edit_pdo_operasional/'.str_replace("/","",$row['id_pdo'])).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('pdo/delete_pdo_operasional/'.str_replace("/","",$row['id_pdo'])).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>
				<a title="Cetak" class="cetak btn btn-sm btn-dark" href="'.base_url('laporan_pdo/cetak_pdo_operasional/'.str_replace("/","",$row['id_pdo'])).'" target="_blank"> <i class="fa fa-print"></i></a>';
			}

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_pdo'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<div class="text-right"><span align="right"><font size="2px">'.number_format($row['nilai'],2,",",".").'</font></span></div>',
				$tombol
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

public function add(){
		$this->rbac->check_operation_access('');
		if($this->input->post('type')==1){
			$data['id_pdo'] 			= $this->input->post('idpdo', TRUE);
			$data['kd_pdo'] 			= $this->input->post('no_pdo', TRUE);
			$data['tgl_pdo']			= $this->input->post('tgl_pdo', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['kd_divisi']			= $this->input->post('divisi', TRUE);
			$data['kd_pqproyek']		= $this->input->post('projek', TRUE);
			$data['kd_project']			= $this->input->post('kodeproject', TRUE);
            $data['no_acc3'] 			= $this->input->post('kd_item', TRUE);
            $data['no_acc'] 			= $this->input->post('kd_item', TRUE);
            $data['jns_tkl'] 			= $this->input->post('jenis_tkl', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['qty']				= $this->input->post('qty', TRUE);
			$data['satuan']				= $this->input->post('satuan', TRUE);
			$data['harga']				= $this->input->post('harga', TRUE);
			$data['nilai']				= $this->input->post('total', TRUE);
			$data['jenis']				= 1; //1 untuk pdo project
			$result = $this->pdo_model->save_pdo($data);
			// $kodearea 					= $this->input->post('area', TRUE);
			// $urutan 					= $this->input->post('nourut', TRUE);
			
			// $data2 = array(
			// 	'no_pdo' => $urutan
			// );

			// $result = $this->pdo_model->update_nomor($data2,$kodearea);

            // if($result){
					// Activity Log 
					// $this->activity_model->add_log(2);
					echo json_encode(array(
							"statusCode"=>200
						));
					// $this->session->set_flashdata('success', 'Data PDO berhasil disimpan!');
					// redirect(base_url('pdo'),'refresh');
				// }else{
				// 	echo json_encode(array(
				// 			"statusCode"=>201
				// 		));
				// }
		}else{
			$data['data_area'] 			= $this->area->get_area();
			$data['data_divisi']		= $this->pdo_model->get_divisi();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pdo/tambah', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

public function add_pdo_project(){
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('kd_pdo', 'Kode PDO', 'trim|required');
			$this->form_validation->set_rules('tgl_pdo', 'Tanggal PDO', 'trim|required');
			$this->form_validation->set_rules('area', 'Area', 'trim|required');
			$this->form_validation->set_rules('projek', 'Proyek', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
			}
			else{
				$kdpdo 		= $this->security->xss_clean($this->input->post('kd_pdo'));
				$keterangan 	= $this->security->xss_clean($this->input->post('keterangan'));
				$this->pdo_model->add_pdo_project($kdpdo);
				$this->pdo_model->update_keterangan($kdpdo, $keterangan);

				$kodearea 					= $this->input->post('area', TRUE);
				$urutan 					= $this->input->post('urut', TRUE);
				
					$data2 = array(
						'no_pdo' => $urutan
					);

				$result = $this->pdo_model->update_nomor($data2,$kodearea);
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'PQ Proyek berhasil ditambahkan!');
					redirect(base_url('cpdo'));
				}else{
					$this->session->set_flashdata('errors', 'PQ Proyek gagal ditambahkan!');
					redirect(base_url('cpdo/add'));
				}
			}
		}
		
	}

public function edit_pdo_keterangan($id='',$jns=''){
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('kd_pdo', 'Kode PDO', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
			}
			else{
				$kdpdo 		= $this->security->xss_clean($this->input->post('kd_pdo'));
				$keterangan 	= $this->security->xss_clean($this->input->post('keterangan'));
				

				$result = $this->pdo_model->update_keterangan($kdpdo, $keterangan);
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'PQ Proyek berhasil diubah!');
					if ($jns=='1'){
						redirect(base_url('cpdo'));
					}else{
						redirect(base_url('cpdo/operasional'));	
					}
					
				}else{
					$this->session->set_flashdata('errors', 'PQ Proyek gagal diubah!');
					redirect(base_url('cpdo/edit_pdo_project/'.$id));
				}
			}
		}
		
	}

public function add_pdo_operasional(){
		
		if($this->input->post('submit')){
			$this->form_validation->set_rules('kd_pdo', 'Kode PDO', 'trim|required');
			$this->form_validation->set_rules('tgl_pdo', 'Tanggal PDO', 'trim|required');
			$this->form_validation->set_rules('area', 'Area', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
			}
			else{
				$kdpdo 			= $this->security->xss_clean($this->input->post('kd_pdo'));
				$keterangan 	= $this->security->xss_clean($this->input->post('keterangan'));
				$this->pdo_model->add_pdo_project($kdpdo);
				$this->pdo_model->update_keterangan($kdpdo, $keterangan);

				$kodearea 					= $this->input->post('area', TRUE);
				$urutan 					= $this->input->post('urut', TRUE);
				
					$data2 = array(
						'no_pdo' => $urutan
					);

				$result = $this->pdo_model->update_nomor($data2,$kodearea);
				if($result){
					$this->activity_model->add_log(1);
					$this->session->set_flashdata('success', 'PQ Proyek berhasil ditambahkan!');
					redirect(base_url('cpdo/operasional'));
				}else{
					$this->session->set_flashdata('errors', 'PQ Proyek gagal ditambahkan!');
					redirect(base_url('cpdo/add_operasional'));
				}
			}
		}
		
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


public function datatable_json_pdo_operasional($id=''){				
		
		$id_new = str_replace('abcde','/',$id);
		$records['data'] = $this->pdo_model->get_pdo_operasional($id_new);
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


  public function view($id){
  	$id_new = str_replace('abcde','/',$id);
    $search 		= $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
    $limit 			= $_POST['length']; // Ambil data limit per page
    $start 			= $_POST['start']; // Ambil data start
    $order_index 	= $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
    $order_field 	= $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
    $order_ascdesc 	= $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
    
    $sql_total 		= $this->pdo_model->count_all($id_new); // Panggil fungsi count_all pada SiswaModel
    $sql_data 		= $this->pdo_model->filter($search, $limit, $start, $order_field, $order_ascdesc,$id_new); // Panggil fungsi filter pada SiswaModel
    $sql_filter 	= $this->pdo_model->count_filter($search); // Panggil fungsi count_filter pada SiswaModel
    $callback = array(
        'draw'=>$_POST['draw'], // Ini dari datatablenya
        'recordsTotal'=>$sql_total,
        'recordsFiltered'=>$sql_filter,
        'data'=>$sql_data
    );
    header('Content-Type: application/json');
    echo json_encode($callback); // Convert array $callback ke json
  }

public function datatable_json_pdo_proyek_edit($id='',$kodepdo=''){				
		
		$id_new = str_replace('abcde','/',$id);
		$records['data'] = $this->pdo_model->get_pdo_proyek($id_new);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$row['no_acc'],
				$row['nm_acc'],
				$row['qty'],
				$row['satuan'],
				$row['harga'],
				$row['uraian'],
				number_format($row['nilai'],2,',','.'),
				'<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("cpdo/delete_pdo_project_temp/".$row['id']).'/'.$kodepdo.'/1'.' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

public function datatable_json_pdo_operasional_edit($id='',$kodepdo=''){				
		
		$id_new = str_replace('abcde','/',$id);
		$records['data'] = $this->pdo_model->get_pdo_operasional($id_new);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				$row['no_acc'],
				$row['nm_acc'],
				$row['qty'],
				$row['satuan'],
				$row['harga'],
				$row['uraian'],
				number_format($row['nilai'],2,',','.'),
				'<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("cpdo/delete_pdo_project_temp/".$row['id']).'/'.$kodepdo.'/2'.' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

	public function add_operasional(){
		$this->rbac->check_operation_access('');
		if($this->input->post('type')==1){
			$data['id_pdo'] 			= $this->input->post('idpdo', TRUE);
			$data['kd_pdo'] 			= $this->input->post('no_pdo', TRUE);
			$data['tgl_pdo']			= $this->input->post('tgl_pdo', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['kd_pqproyek']		= $this->input->post('projek', TRUE);
			$data['kd_project']			= $this->input->post('kodeproject', TRUE);
            $data['no_acc3'] 			= $this->input->post('kd_item', TRUE);
            $data['no_acc'] 			= $this->input->post('kd_item', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['qty']				= $this->input->post('qty', TRUE);
			$data['satuan']				= $this->input->post('satuan', TRUE);
			$data['harga']				= $this->input->post('harga', TRUE);
			$data['nilai']				= $this->input->post('total', TRUE);
			$data['jenis']				= 2; //1 untuk pdo project
			$result 					= $this->pdo_model->save_pdo_operasional($data);
			// $kodearea 					= $this->input->post('area', TRUE);
			// $urutan 					= $this->input->post('nourut', TRUE);
			
			// $data2 = array(
			// 	'no_pdo' => $urutan
			// );

			// $result = $this->pdo_model->update_nomor($data2,$kodearea);

     //        if($result){
					// // Activity Log 
					// $this->activity_model->add_log(2);
					echo json_encode(array(
							"statusCode"=>200
						));
				// 	$this->session->set_flashdata('success', 'Data PDO berhasil disimpan!');
				// 	redirect(base_url('pdo/operasional'),'refresh');
				// }else{
				// 	echo json_encode(array(
				// 			"statusCode"=>201
				// 		));
				// }
		}else{
			$data['data_area'] 			= $this->area->get_area();
			$data['data_divisi']		= $this->pdo_model->get_divisi();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pdo/add_operasional', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

public function edit_pdo_project($id_pdo='')
{		
		$this->rbac->check_operation_access('');

		if($this->input->post('type')==1){
			$data['id_pdo'] 			= $this->input->post('idpdo', TRUE);
			$data['kd_pdo'] 			= $this->input->post('no_pdo', TRUE);
			$data['tgl_pdo']			= $this->input->post('tgl_pdo', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['kd_divisi']			= $this->input->post('divisi', TRUE);
			$data['qty']				= $this->input->post('qty', TRUE);
			$data['satuan']				= $this->input->post('satuan', TRUE);
			$data['harga']				= $this->input->post('harga', TRUE);
			$data['kd_pqproyek']		= $this->input->post('projek', TRUE);
			$data['kd_project']			= $this->input->post('kodeproject', TRUE);
            $data['no_acc3'] 			= $this->input->post('kd_item', TRUE);
            $data['no_acc'] 			= $this->input->post('kd_item', TRUE);
            $data['jns_tkl'] 			= $this->input->post('jenis_tkl', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['nilai']				= $this->input->post('total', TRUE);
			$data['jenis']				= 1; //1 untuk pdo project
			$result = $this->pdo_model->save_edit_pdo($data);
			
			echo json_encode(array(
					"statusCode"=>200
				));
		}
		else{
			$data['data_area'] 			= $this->area->get_area();
			$data['data_divisi']		= $this->pdo_model->get_divisi();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek();
			$data['data_pdo'] 			= $this->pdo_model->get_pdo_by_id($id_pdo);
			$data['title'] 				= 'Edit PDO';
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pdo/edit', $data);
			$this->load->view('admin/includes/_footer');
		}
	
}


public function edit_pdo_operasional($id_pdo='')
{		
		$this->rbac->check_operation_access('');

		if($this->input->post('type')==1){
			$data['id_pdo'] 			= $this->input->post('idpdo', TRUE);
			$data['kd_pdo'] 			= $this->input->post('no_pdo', TRUE);
			$data['tgl_pdo']			= $this->input->post('tgl_pdo', TRUE);
			$data['kd_area'] 			= $this->input->post('area', TRUE);
			$data['kd_pqproyek']		= $this->input->post('projek', TRUE);
			$data['kd_project']			= $this->input->post('kodeproject', TRUE);
            $data['no_acc3'] 			= $this->input->post('kd_item', TRUE);
            $data['no_acc'] 			= $this->input->post('kd_item', TRUE);
			$data['uraian']				= $this->input->post('uraian', TRUE);
			$data['qty']				= $this->input->post('qty', TRUE);
			$data['satuan']				= $this->input->post('satuan', TRUE);
			$data['harga']				= $this->input->post('harga', TRUE);
			$data['nilai']				= $this->input->post('total', TRUE);
			$data['jenis']				= 2; //1 untuk pdo project
			$result = $this->pdo_model->save_edit_pdo_operasional($data);
			
			echo json_encode(array(
					"statusCode"=>200
				));
		}
		else{
			$data['data_area'] 			= $this->area->get_area();
			$data['data_divisi']		= $this->pdo_model->get_divisi();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek();
			$data['data_pdo'] 			= $this->pdo_model->get_pdo_by_id($id_pdo);
			$data['title'] 				= 'Edit PDO';
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pdo/edit_operasional', $data);
			$this->load->view('admin/includes/_footer');
		}
	
}


function get_nomor(){
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->pdo_model->get_nomor($area)->result();
		echo json_encode($data);
	}


public function datatable_pdo_project($pqproyek,$no_acc, $jenis_tk){				   				
		$jenis = 1;
		$pqproyek = str_replace('Pd0JuhgMsMjKtKlbr','/',$pqproyek);
		$records['data'] = $this->pdo_model->get_pdo_project_rinci($pqproyek,$no_acc,$jenis,$jenis_tk);
		$data = array();

		$i=0;
		foreach ($records['data']   as $row) 
		{  

			$data[]= array(
				++$i,
				$row['no_acc'],
				'<font size="2px"><b>Item</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$row['nm_acc'].'<br> <b>Uraian</b> &nbsp;: '.$row['uraian'].'<br> <b>Jenis</b> &nbsp;: '.$row['jenis_tkl'].'</font>',
				'<div class="text-right">'.number_format($row['nilai'],2,',','.').'</div>',
				'<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pq/edit_hpp/'.$row['id']."/".$row['id_pdo']).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url("pq/del_hpp/".$row['id']."/".$row['id_pdo']).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>'
			);
		}
		$records['data']=$data;
		echo json_encode($records);						   
	}

// Hapus PDO Projek
public function delete_pdo_project($id = 0)
	{
		$this->rbac->check_operation_access('');

			$hasil=$this->db->query("SELECT status_bayar as status from ci_pdo a where id_pdo='$id'");
				foreach ($hasil->result_array() as $row){
					$status 	=$row['status']; 
					
				}

			if ($status==1){
				$this->session->set_flashdata('errors', 'PDO Sudah dicairkan!');
				redirect(base_url('pdo/'));				
			}else{
				$this->db->delete('ci_pdo', array('id_pdo' => $id));	
				$this->activity_model->add_log(3);
				$this->session->set_flashdata('success', 'Data berhasil dihapus!');
				redirect(base_url('pdo/'));
			}
		
	}

public function delete_pdo_project_temp($id = 0,$kodepdo='',$jns='')
	{
		$this->rbac->check_operation_access('');
		$this->db->delete('ci_pdo', array('id' => $id));	
		$this->activity_model->add_log(3);
		$this->session->set_flashdata('success', 'Data berhasil dihapus!');
		if ($jns=='1'){
			redirect(base_url('pdo/edit_pdo_project/'.$kodepdo));
		}else{
			redirect(base_url('pdo/edit_pdo_operasional/'.$kodepdo));	
		}
		
			
		
	}

public function delete_pdo_project_temp2()
	{	
		$this->rbac->check_operation_access('');
		
		if($this->input->post('type')==1){
			$id 	= $this->input->post('id', TRUE);
			$result = $this->db->delete('ci_pdo_temp', array('id' => $id));	
			
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



public function delete_pdo_operasional($id = 0)
	{
		$this->rbac->check_operation_access('');

			$hasil=$this->db->query("SELECT status_bayar as status from ci_pdo a where id_pdo='$id'");
				foreach ($hasil->result_array() as $row){
					$status 	=$row['status']; 
					
				}

			if ($status==1){
				$this->session->set_flashdata('errors', 'PDO Sudah dicairkan!');
				redirect(base_url('pdo/operasional'));				
			}else{
				$this->db->delete('ci_pdo', array('id_pdo' => $id));	
				$this->activity_model->add_log(3);
				$this->session->set_flashdata('success', 'PDO berhasil dihapus!');
				redirect(base_url('pdo/operasional'));
			}
		
	}	


	function get_pq_projek_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pdo_model->get_pq_projek_by_area($area)->result();
		echo json_encode($data);
	}

	public function keranjang_barang(){
		// $this->load->view('admin/includes/_header', $data);
		$this->load->view('user/pdo/keranjang');
		// $this->load->view('admin/includes/_footer');
	}

 // function keranjang_barang(){
	// 	$this->rbac->check_operation_access('');
	// 	$this->load->view('user/pdo/add');
	// }

	function get_pq_operasional_by_area(){
		$area = $this->input->post('id',TRUE);
		$tahun = $this->input->post('tahun',TRUE);
		$data = $this->pdo_model->get_pq_operasional_by_area($area,$tahun)->result();
		echo json_encode($data);
	}


	function get_item_pq_by_pq(){
		$pq = $this->input->post('id',TRUE);
		$data = $this->pdo_model->get_item_pq_by_pq($pq)->result();
		echo json_encode($data);
	}

	function get_jenis_tk(){
		$no_acc 		= $this->input->post('kd_coa',TRUE);
		$kode_pqproyek 	= $this->input->post('kode_pqproyek',TRUE);
		$data 			= $this->pdo_model->get_jenis_tk($kode_pqproyek,$no_acc)->result();
		echo json_encode($data);
	}


	function get_nilai(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->pdo_model->get_nilai($id, $no_acc)->result();
		echo json_encode($data);
	}

	function get_nilai2(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$jns_tk 	= $this->input->post('jns_tk',TRUE);
		$data 		= $this->pdo_model->get_nilai2($id, $no_acc,$jns_tk)->result();
		echo json_encode($data);
	}


	function get_realisasi(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->pdo_model->get_realisasi($id, $no_acc)->result();
		echo json_encode($data);
	}

	function get_realisasi2(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$jns_tk 	= $this->input->post('jns_tk',TRUE);
		$data 		= $this->pdo_model->get_realisasi2($id, $no_acc, $jns_tk)->result();
		echo json_encode($data);
	}



	function get_nilai_op(){
		$kode_pqoperasional 	= $this->input->post('kode_pqoperasional',TRUE);
		$data 					= $this->pdo_model->get_nilai_op($kode_pqoperasional)->result();
		echo json_encode($data);
	}


	function get_realisasi_op(){
		$kode_pqoperasional 	= $this->input->post('kode_pqoperasional',TRUE);
		$data 		= $this->pdo_model->get_realisasi_op($kode_pqoperasional)->result();
		echo json_encode($data);
	}



	

}


?>