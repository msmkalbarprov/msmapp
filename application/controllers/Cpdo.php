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
				$tombol = '';
			}else{
				$tombol = '<a title="Edit" class="update btn btn-sm btn-warning" href="'.base_url('pdo/edit_pdo_project/'.str_replace("/","",$row['id_pdo'])).'"> <i class="fa fa-pencil-square-o"></i></a>
				<a title="Delete" class="delete btn btn-sm btn-danger" href='.base_url('pdo/delete_pdo_project/'.str_replace("/","",$row['id_pdo'])).' title="Delete" onclick="return confirm(\'Do you want to delete ?\')"> <i class="fa fa-trash-o"></i></a>';
			}

			if($row['jenis_tkl']<>''){
				$keterangan='<font size="2px">- '.$row['no_acc'].'<br>
								  - '.$row['nm_acc'].'<br>
								  - '.$row['jenis_tkl'].'</font>';
			}else{
				$keterangan='<font size="2px">- '.$row['no_acc'].'<br>
								  - '.$row['nm_acc'].'</font>';
			}

			$data[]= array(
				++$i,
				'<font size="2px">'.$row['kd_pdo'].'</font>',
				'<font size="2px">'.$row['nm_area'].'</font>',
				$keterangan,
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
			$data['nilai']				= $this->input->post('total', TRUE);
			$data['jenis']				= 1; //1 untuk pdo project
			$this->pdo_model->save_pdo($data);
			$kodearea 					= $this->input->post('area', TRUE);
			$urutan 					= $this->input->post('nourut', TRUE);
			
			$data2 = array(
				'no_pdo' => $urutan
			);

			$result = $this->pdo_model->update_nomor($data2,$kodearea);

            if($result){
					// Activity Log 
					$this->activity_model->add_log(2);
					echo json_encode(array(
							"statusCode"=>200
						));
					$this->session->set_flashdata('success', 'Data PDO berhasil disimpan!');
					redirect(base_url('pdo'),'refresh');
				}else{
					echo json_encode(array(
							"statusCode"=>201
						));
				}
		}else{
			$data['data_area'] 			= $this->area->get_area();
			$data['data_divisi']		= $this->pdo_model->get_divisi();
			$data['item_hpp'] 			= $this->pq_model->get_coa_item();
			$data['data_pqproyek'] 		= $this->pq_model->get_pqproyek();
			$this->load->view('admin/includes/_header');
			$this->load->view('user/pdo/add', $data);
			$this->load->view('admin/includes/_footer');
		}
		
	}

public function edit_pdo_project($id_pdo='')
{		
		$this->rbac->check_operation_access('');

		if($this->input->post('submit')){
				$this->form_validation->set_rules('idpdo', 'No PDO', 'trim|required');
				$this->form_validation->set_rules('total', 'Total', 'trim|required');

					// Hitung sisa
					$nilaipdo_baru = $this->proyek_model->number($this->input->post('total'));
					$nilaipdo_lama = $this->input->post('nilai_ini');
					$nilaipdo_sisa = $this->proyek_model->number($this->input->post('sisa'));

					$sisa_sekarang=$nilaipdo_sisa+$nilaipdo_lama-$nilaipdo_baru;

				if($sisa_sekarang<0){
					$this->session->set_flashdata('errors', 'Total Nilai PDO Akun ini Melebihi HPP');
					redirect(base_url('pdo/edit_pdo_project/'.$id_pdo), 'refresh');
				}else{
						$data = array(

						'uraian' 			=> $this->input->post('uraian'),
						'nilai' 			=> $this->proyek_model->number($this->input->post('total')),
						'username'			=> $this->session->userdata('username'),
						'updated_at'		=> date("Y-m-d h:i:s")
					);
					$id_pdo 		= $this->input->post('idpdo');
					$data 			= $this->security->xss_clean($data);
					$result 		= $this->pdo_model->edit_pdo($data, $id_pdo);
					if($result){
						
							$this->session->set_flashdata('success', 'Data PDO berhasil diupdate!');
							redirect(base_url('pdo'), 'refresh');
						
					}
				}
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


	function get_pq_projek_by_area(){
		$area = $this->input->post('id',TRUE);
		$data = $this->pdo_model->get_pq_projek_by_area($area)->result();
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

	

}


?>