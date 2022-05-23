<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SPJ extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/spj_model', 'spj_model');
		$this->load->model('user/pq_model', 'pq_model');
		$this->load->model('user/pdo_model', 'pdo_model');
		// $this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		// $this->load->model('admin/subarea_model', 'subarea');
		// $this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['title'] = 'SPJ';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/spj/list');
		$this->load->view('admin/includes/_footer');
	}

	public function datatable_json(){				   					   
		$records['data'] = $this->spj_model->get_all_spj();
		$data = array();
		$i=0;
		foreach ($records['data']   as $row) 
		{  
			$data[]= array(
				++$i,
				'<font size="2px">'.$row['no_spj'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				'<font size="2px">'.$row['tgl_spj'].'</font>',
				'<font size="2px">'.$row['keterangan'].'</font>',
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
			$data['no_rekening']		= $this->input->post('no_rekening', TRUE);
			$data['jenis']				= 1; //1 untuk pdo project
			$result = $this->pdo_model->save_pdo($data);
			
					echo json_encode(array(
							"statusCode"=>200
						));

		}else{
			$data2['title'] 			= 'SPJ';
			$data['data_area'] 			= $this->area->get_area();
			$data['data_rekening']		= $this->pdo_model->get_rekening();
			$data['data_divisi']		= $this->pdo_model->get_divisi();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek();
			$this->load->view('admin/includes/_header' , $data2);
			$this->load->view('user/spj/add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

	function get_pdo_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->spj_model->get_pdo_by_area($area)->result();
		echo json_encode($data);
	}

	function get_item_by_pdo(){
		$pq = $this->input->post('id',TRUE);
		$data = $this->spj_model->get_item_by_pdo($pq)->result();
		echo json_encode($data);
	}

	function get_item_spj_by_pdo(){
		$pq = $this->input->post('id',TRUE);
		$data = $this->spj_model->get_item_spj_by_pdo($pq)->result();
		echo json_encode($data);
	}

function get_nomor(){
		$area 		= $this->input->post('area',TRUE);
		$data 		= $this->spj_model->get_nomor($area)->result();
		echo json_encode($data);
	}

function get_nilai(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->spj_model->get_nilai($id, $no_acc)->result();
		echo json_encode($data);
	}
function get_realisasi(){
		$id 		= $this->input->post('id',TRUE);
		$no_acc 	= $this->input->post('no_acc',TRUE);
		$data 		= $this->spj_model->get_realisasi($id, $no_acc)->result();
		echo json_encode($data);
	}

}
?>