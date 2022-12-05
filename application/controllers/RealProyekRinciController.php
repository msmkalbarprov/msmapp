<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RealProyekRinciController extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/RealProyekRinciModel', 'RealModel');
		$this->load->model('PublicModel');
		
	}



	public function Cetak_real_proyek_pdo_rinci(){
		$data['title'] = 'Rincian_PDO';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_rinci_realisasi_proyek_pdo');
		$this->load->view('admin/includes/_footer');
	}


	public function Cetak_real_proyek_spj_rinci(){
		$data['title'] = 'Rincian_SPJ';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_rinci_realisasi_proyek_spj');
		$this->load->view('admin/includes/_footer');
	}


	public function Cetak_RAP(){
		$data['title'] = 'Realisasi RAP';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_real_RAP');
		$this->load->view('admin/includes/_footer');
	}


	public function list_proyek(){ 
		$ctahun 	= $this->input->post('ctahun');
		$carea		= $this->input->post('carea');
		$data		= $this->RealModel->listProyek($ctahun,$carea);
		echo $data;			
	}

	public function list_acc(){ 
		$ctahun 	= $this->input->post('ctahun');
		$carea		= $this->input->post('carea');
		$data		= $this->RealModel->listAcc($ctahun,$carea);
		echo $data;			
	}


	public function list_area(){ 
		$ctahun 	= $this->input->post('ctahun');
		$data		= $this->RealModel->listArea($ctahun);
		echo $data;			
	}
	
	
	function prev_laporan_pdo(){ 

		$ctahun = $this->input->post('ctahun');	
		$carea = $this->input->post('carea');
		$cacc = $this->input->post('cacc');
		$ctipe = $this->input->post('ctipe');

			$cRet = $this->laporan_pdo($ctahun,$carea,$cacc,$ctipe);
			echo $cRet;
		
	}


	function prev_laporan_spj(){ 

		$ctahun = $this->input->post('ctahun');	
		$carea = $this->input->post('carea');
		$cacc = $this->input->post('cacc');
		$ctipe = $this->input->post('ctipe');

			$cRet = $this->laporan_spj($ctahun,$carea,$cacc,$ctipe);
			echo $cRet;
		
	}


	function prev_laporan_rap(){ 

		$ctahun = $this->input->post('ctahun');	
		$carea = $this->input->post('carea');
		$cproyek = $this->input->post('cproyek');
		$ctipe = $this->input->post('ctipe');

			$cRet = $this->laporan_rap($ctahun,$carea,$cproyek,$ctipe);
			echo $cRet;
		
	}


	function laporan_pdo($ctahun,$carea,$cacc,$ctipe){ 
		$cRet = $this->RealModel->lap_proyek_cair_pdo($ctahun,$carea,$cacc,$ctipe);

		if ($ctipe == 'prev') {
				echo $cRet;
			}else{
				return $cRet;
			}	
		
	}


	function laporan_spj($ctahun,$carea,$cacc,$ctipe){		
		$cRet = $this->RealModel->lap_proyek_cair_spj($ctahun,$carea,$cacc,$ctipe);
		if ($ctipe == 'prev') {
				echo $cRet;
			}else{
				return $cRet;
			}	
		
	}


	function laporan_rap($ctahun,$carea,$cproyek,$ctipe){		
		$cRet = $this->RealModel->lap_rap($ctahun,$carea,$cproyek,$ctipe);
		if ($ctipe == 'prev') {
				echo $cRet;
			}else{
				return $cRet;
			}	
		
	}


	public function pdf_laporan_rap($ctahun='',$carea='',$cproyek='',$ctipe='')
	{
		$header = '';
		$body=$this->laporan_rap($ctahun,$carea,$cproyek,$ctipe);
		$cproyek = str_replace("12345678909", "/", $cproyek);
		$filename = 'Realisasi-RAP-'.$cproyek.'.pdf';
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A3',$filename);

	}
	
	
	public function excel_laporan_rap($ctahun='',$carea='',$cproyek='',$ctipe='')
	{
		 $data['title']= 'Rincian/Realisasi/PDO/PerAkun';
		 $xproyek = str_replace("12345678909", "/", $cproyek);
		 $data['filename']= 'Realisasi-RAP-'.$xproyek;
		 $data['html']= $this->laporan_rap($ctahun,$carea,$cproyek,$ctipe);
		
		 
		 $this->load->view('cetakan/cetakan',$data);
		
	}
	

	public function pdf_laporan_pdo($ctahun='',$carea='',$cacc='',$ctipe='')
	{
		$header = '';
		$body=$this->laporan_pdo($ctahun,$carea,$cacc,$ctipe);
		$filename = 'Rincian-Realisasi-PDO-PerAkun.pdf';
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);

	}
	

	public function pdf_laporan_spj($ctahun='',$carea='',$cacc='',$ctipe='')
	{
		$header = '';
		$body=$this->laporan_spj($ctahun,$carea,$cacc,$ctipe);
		$filename = 'Rincian-Realisasi-SPJ-PerAkun.pdf';
		$this->PublicModel->_mpdf('',$header,$body,10,10,25,10,10,'L',1,true,'A4',$filename);

	}
	

	public function excel_laporan_pdo($ctahun='',$carea='',$cacc='',$ctipe='')
	{
		 $data['title']= 'Rincian/Realisasi/PDO/PerAkun';
		 $data['filename']= 'Rincian-Realisasi-PDO-PerAkun';
		 $data['html']= $this->laporan_pdo($ctahun,$carea,$cacc,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}	


	public function excel_laporan_spj($ctahun='',$carea='',$cacc='',$ctipe='')
	{
		 $data['title']= 'Rincian/Realisasi/SPJ/PerAkun';
		 $data['filename']= 'Rincian-Realisasi-SPJ-PerAkun';
		 $data['html']= $this->laporan_spj($ctahun,$carea,$cacc,$ctipe);
		 $this->load->view('cetakan/cetakan',$data);
		
	}	


}


?>