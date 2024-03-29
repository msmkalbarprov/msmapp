<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();

		$this->load->model('user/proyek_model', 'proyek_model');
		$this->load->model('user/pq_model', 'pq_model');
		$this->load->model('admin/saldoawal_model', 'saldoawal_model');
		$this->load->model('admin/admin_model', 'admin');
		$this->load->model('admin/area_model', 'area');
		$this->load->model('admin/subarea_model', 'subarea');
		$this->load->model('admin/jnsproyek_model', 'jnsproyek');
		$this->load->model('admin/jnssubproyek_model', 'jnssubproyek_model');
		$this->load->model('admin/perusahaan_model', 'perusahaan');
		$this->load->model('admin/pagu_model', 'pagu');
		$this->load->model('admin/dinas_model', 'dinas');
		$this->load->model('admin/jnspagu_model', 'jnspagu');
		$this->load->model('admin/tipeproyek_model', 'tipeproyek');
		$this->load->model('admin/activity_model', 'activity_model');
	}

	//-----------------------------------------------------------
	public function index(){
		$data['data_area'] 			= $this->area->get_area();
		$data['title'] = 'Proyek';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/laporan_pq');
		$this->load->view('admin/includes/_footer');
	}
 
	public function cetak_pq_satuan($id=0)
	{	
		$data['pqproyek'] 		= $this->pq_model->get_pq_by_id($id);
		$data['proyek'] 		= $this->pq_model->get_proyek_by_id(str_replace('PQ','',$id));
		$data['hpp'] 			= $this->pq_model->get_cetak_hpp_by_id($id);
		$data['operasional']	= $this->pq_model->get_operasional_by_id($id);
		$data['marketing']		= $this->pq_model->get_marketing_by_id($id);
		$data['pendapatan_area']	= $this->pq_model->get_pendapatanarea($id);
		// $html = $this->load->view('user/pq/pq_view', $data);
		// $cRet = $this->load->view('user/pq/cetak_pq_satuan',$data);
		$jenis= 0;
		switch ($jenis)
        {
            case 0;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'portrait');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/pq/cetak_pq_satuan', $data);
                break;
            case 1;
                echo "<title>Mapping Kode program</title>";
                echo $this->load->view('user/pq/cetak_pq_satuan', $data);
               break;
        }

	}

// CETAK LAPORAN PQ 
public function cetak_pq($id=0,$tahun=0,$jenis=0)
	{	
		$map1					= $this->pq_model->get_map1($id);
		$marketing				= $this->pq_model->get_operasional_by_area($id, $tahun);
		$pendapatan_area		= $this->pq_model->get_pendapatanarea_by_year($id,$tahun);
		$spkperyear				= $this->pq_model->get_spk_by_year($id,$tahun);
		$tahunlalu				= $this->pq_model->get_tahun_lalu_by_year($id,$tahun);


		$html="";
		$html.='<h4>Informasi Pekerjaan :</h4><table width="100%" border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  ';

  foreach($map1 as $map1){
  	$urut 		= $map1["urut"];
  	$kode 		= $map1["kode"];
  	$kolom 		= $map1["kolom"];
  	$kd_item 	= $map1["kd_item"];
  	
  	if ($kode==2 && $urut==1){
  		$html.='<tr>
    			<td colspan="4">'.$map1["nama_map"].'</td>';
    	
    	$jumlahkolom=0;
    	$i=1;
    	$pagu=0;

    	
    	$proyek = $this->pq_model->get_proyek_by_area($map1["kolom"], $id, $tahun);
    	foreach($proyek as $proyek){
    		$jumlahkolom = $i++;

    		if ($map1["kolom"]=='nilai_pagu'){
    			$pagu = $pagu+$proyek['nilai_pagu'];
    			$html.='<td colspan="2" align="center">'.number_format($proyek[$map1["kolom"]],0,",",".").'</td>';
    		}else if ($map1["kolom"]=='masa_kontrak' || $map1["kolom"]=='lama_pekerjaan'){
    			$html.='<td colspan="2" align="center">'.$proyek[$map1["kolom"]].' Bulan </td>';
    		}else{
    			$html.='<td colspan="2" align="center">'.$proyek[$map1["kolom"]].'</td>';	
    		}
    		
    	}

    	if ($map1["kolom"]=='nilai_pagu'){
    		$html.='<td colspan="2" align="center" style="background: #f6d55c;">'.number_format($pagu,0,",",".").'</td>';
    	}else if($map1["kolom"]=='nm_paket_proyek'){
    		$html.='<td colspan="2" align="center" style="background: #f6d55c;">REKAPITULASI</td>';
    	}else{
    		$html.='<td colspan="2" align="center" style="background: #f6d55c;"></td>';
    	}
  		$html.='</tr>';
  	}

  	if ($kode=='3'){
  		$html .='<tr>
				    <td colspan="4" align="center" style="background: #a7aaad;border-right:white;">
				      '.$map1["nama_map"].'
				    </td>';
			for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: #a7aaad;border-right:white; ">Rp</td>
				    <td align="center" style="background: #a7aaad;border-left:white;">%</td>';
				}
					$html.='<td align="center" style="background: #a7aaad;border-right:white; ">Rp</td>
				    <td align="center" style="background: #a7aaad;border-left:white;">%</td></tr>';
  	}
$colspan1=($jumlahkolom*2)+4+2;
  	if ($kode=='4') {
  		$html .='<tr>
    <td colspan="'.$colspan1.'" >
      '.$map1["nama_map"].'
    </td>
  </tr>';
  	}

  	if ($kode=='4A') {
		  		
		  		$html .='<tr>
		    <td colspan="4">
		      2. PENDAPATAN NETT
		    </td>';
		    $proyek = $this->pq_model->get_proyek_by_area('kd_proyek', $id, $tahun);
    	foreach($proyek as $proyek){
    		$proyek = $proyek['kd_proyek'];

    		$pq = $this->pq_model->get_pq_by_area($kolom, $id, $tahun, $proyek);
    	foreach($pq as $pqproyek){
    		$pendapatan_nett=$pqproyek["pendapatan_nett"];
		    $html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($pqproyek["pendapatan_nett"],0,",",".").'</td>
		    <td align="right" style="background: #a7aaad;border-right:white; "></td>';
		}

    	}
		    
			$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($pendapatan_area["pendapatannetarea"],0,",",".").'</td>
		    <td align="right" style="background: #a7aaad;border-right:white; "></td>';
		  $html.='</tr>';
		  	}


  	if ($kode=='5' && $kolom != ''){
  		$klm='kd_proyek';
  		$html .='<tr>
				    <td width="3%">
				      &nbsp;
				    </td>
				    <td colspan="3">
				      '.$map1["nama_map"].'
				    </td>';

		$proyek = $this->pq_model->get_proyek_by_area('kd_proyek', $id, $tahun);
    	foreach($proyek as $proyek){
    		$proyek = $proyek[$klm];


    		$pq = $this->pq_model->get_pq_by_area('spk', $id, $tahun, $proyek);
	    	$total5_per_item=0;
	    	foreach($pq as $pqproyek){
	    		$spk_perprojek = $pqproyek['spk'];
	    	}


    		$pq = $this->pq_model->get_pq_by_area($kolom, $id, $tahun, $proyek);
	    	$total5_per_item=0;
	    	foreach($pq as $pqproyek){
				if ($kolom=='spk'){
					$spk = $pqproyek[$kolom];
					$html.='<td align="right">'. number_format($pqproyek[$kolom],0,",",".").'</td>
							<td align="right">'. number_format(100,0,",",".").'</td>';	
				}

				if ($kolom=='nilaippl'){

					$pqq = $this->pq_model->get_pq_by_area('pendapatan_nett', $id, $tahun, $proyek);
			    	foreach($pqq as $pqproyekk){
			    		$pen_net=$pqproyekk["pendapatan_nett"];
			    	}


					$total5_per_item=$total5_per_item+$pqproyek[$kolom];

					if($spk_perprojek==0){
						$persen99 = 0;
					}else if($spk_perprojek!=0 && $pqproyek[$kolom]!=0){
						$persen99 = $pqproyek[$kolom]/$pen_net*100;
					}else{
						$persen99 = 100;
					}
					
					$html.='<td align="right" style="color:red">'. number_format($pqproyek[$kolom]*-1,0,",",".").'</td>
							<td align="right">'. number_format($persen99,0,",",".").'</td>';
				}

				if ($kolom=='ppn'){
				
						$total5_per_item=$total5_per_item+$pqproyek[$kolom];

						if($spk_perprojek==0){
							$persen99 = 0;
						}else if($spk_perprojek!=0 && $pqproyek[$kolom]!=0){
							$persen99 = $pqproyek[$kolom]/$spk_perprojek*111/100*100;
						}else{
							$persen99 = 100;
						}
						
						$html.='<td align="right" style="color:red">'. number_format($pqproyek[$kolom]*-1,0,",",".").'</td>
								<td align="right">'. number_format($persen99,0,",",".").'</td>';
					}

				if ($kolom=='pph'){
				
						$total5_per_item=$total5_per_item+$pqproyek[$kolom];
						$jns_pph=$pqproyek['jns_pph'];
						if($spk_perprojek==0){
							$persen99 = 0;
							
						}else if($spk_perprojek!=0 && $pqproyek[$kolom]!=0){
							if ($jns_pph=='21'){

								if ($pqproyek['status_pph']==1){
									$persen99 = $pqproyek[$kolom]/$spk_perprojek*100;
		                          }else if ($pqproyek['status_pph']==2){
		                            $persen99 = $pqproyek[$kolom]/$spk_perprojek*100;
		                          }else if ($pqproyek['status_pph']==3){
		                            $persen99 = $pqproyek[$kolom]/$spk_perprojek*100;
		                          }else{
		                          	$persen99 = 2.5;
		                          }
							}else{
								$persen99 = $pqproyek[$kolom]/$spk_perprojek*111/100*100;
							}
						}else{
							$persen99 = 100;
						}
						
						$html.='<td align="right" style="color:red">'. number_format($pqproyek[$kolom]*-1,0,",",".").'</td>
								<td align="right">'. number_format($persen99,0,",",".").'</td>';
					}

				if ($kolom!='spk' && $kolom!='nilaippl' && $kolom!='ppn' && $kolom!='pph'){
					$total5_per_item=$total5_per_item+$pqproyek[$kolom];

					if($spk_perprojek==0){
						$persen99 = 0;
					}else if($spk_perprojek!=0 && $pqproyek[$kolom]!=0){
						$persen99 = $pqproyek[$kolom]/$spk_perprojek*100;
					}else{
						$persen99 = 100;
					}
					
					$html.='<td align="right" style="color:red">'. number_format($pqproyek[$kolom]*-1,0,",",".").'</td>
							<td align="right">'. number_format($persen99,0,",",".").'</td>';	
				}
			}
    	}


		

		if ($kolom=='spk'){
			$html.='<td align="right" style="background: #f6d55c;">'. number_format($spkperyear['nilai_spk'],0,",",".").'</td>
					<td align="right" style="background: #f6d55c;">'. number_format(100,0,",",".").'</td>';
		}else if ($kolom=='nilaippl'){

			if ($pendapatan_area[$kolom]==0){
				$persenpendapatanarea=0;
			}else if ($pendapatan_area[$kolom]!=0 && $pendapatan_area["pendapatannetarea"]==0){
				$persenpendapatanarea=100;
			}else{
				$persenpendapatanarea=$pendapatan_area[$kolom]/$pendapatan_area["pendapatannetarea"];
			}

			$html.='<td align="right" style="background: #f6d55c;">'. number_format($pendapatan_area[$kolom],0,",",".").'</td>
					<td align="right" style="background: #f6d55c;">'. number_format($persenpendapatanarea*100,0,",",".").'</td>';
		}else{
			if($spkperyear['nilai_spk']!=0){
				$persen5 = $pendapatan_area[$kolom]/$spkperyear['nilai_spk'];
			}else{
				$persen5=0;
			}
			
			$html.='<td align="right" style="color:red;background: #f6d55c;">'. number_format($pendapatan_area[$kolom]*-1,0,",",".").'</td>
					<td align="right" style="background: #f6d55c;">'. number_format($persen5*100,0,",",".").'</td>';
		}


				$html.='</tr>';
	}

	if ($kode=='0'){
		$html.='<tr>
					<td colspan="'.$colspan1.'">&nbsp;</td>
    			</tr>';
	}	

	if ($kode=='3A'){
		$html .='<tr>
			    <td colspan="4" align="center">'.$map1["nama_map"].'</td>';
		

		$proyek = $this->pq_model->get_proyek_by_area('kd_proyek', $id, $tahun);
    	foreach($proyek as $proyek){
    		$proyek = $proyek[$klm];

    		$pq = $this->pq_model->get_pq_by_area('spk', $id, $tahun, $proyek);
	    	$total5_per_item=0;
	    	foreach($pq as $pqproyek){
	    		$spk_perprojek = $pqproyek['spk'];
	    	}


    		$pq = $this->pq_model->get_pq_by_area($kolom, $id, $tahun, $proyek);
    		foreach($pq as $pqproyek){
    		
    		$sub_total_a=$pqproyek[$kolom];

    		if($spk_perprojek==0){
    			$persen98=0;
    		}else if ($sub_total_a!=0 && $spk_perprojek!=0){
    			$persen98 = $sub_total_a/$spk_perprojek*100;
    		}else{
    			$persen98 = 100;
    		}
    		$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'.number_format($sub_total_a,0,',','.').'</td>
			    <td align="right" style="background: #a7aaad;border-right:white; ">'.number_format($persen98,0,',','.').'</td>';
    		}


    	}
		
    	
    	

    	if($spkperyear["nilai_spk"]!=0){
    		$persenpenarea=$pendapatan_area["sub_total_a"]/$spkperyear["nilai_spk"];
    	}else{
    		$persenpenarea=0;
    	}	
    		$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($pendapatan_area["sub_total_a"],0,",",".").'</td>
		    <td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persenpenarea*100,0,",",".").'</td>';
		
			  $html.='</tr>';
	}

	if ($kode=='5' && $kd_item!=''){
		$jenis_tk = $map1["jenis"];
		$html.='<tr>
          			<td width="3%">'.$map1["number"].'</td>
          			<td>'.$map1["nama_map"].'</td>
          			<td colspan="2">'.$map1["jenis"].'</td>';
          

        // looping proyek
        $klm='kd_proyek';
        $proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
        $nilaihppperitem=0;
    	foreach($proyek as $proyek){

    		$kolom1='pendapatan_nett';
    		$proyek = $proyek[$klm];

    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}

    		$hpp 	= $this->pq_model->get_cetak_hpp_by_area($kd_item, $jenis_tk, $id, $proyek);

    		$jumlahhpp=0;
    		foreach($hpp as $hpp){
    			$nilaihppperitem=$nilaihppperitem+$hpp['nilai_hpp'];
    			if ($pendapatan_nett!=0){
    				$persen_pen_hpp = $hpp['nilai_hpp']/$pendapatan_nett*100;
    			}else if($hpp['nilai_hpp']!=0 && $pendapatan_nett!=0){
    			    $persen_pen_hpp = $hpp['nilai_hpp']/$pendapatan_nett*100;
    			} else{
    				$persen_pen_hpp = 0;	
    			}
    			
    			$html.='<td align="right" style="color: red">'. number_format($hpp['nilai_hpp']*-1,0,',','.') .'</td>
          			<td align="right">'. number_format($persen_pen_hpp,0,',','.') .'</td>';
       		}

    	}

    	if($pendapatan_area['pendapatannetarea']!=0){
    		$persenpennett=$nilaihppperitem/$pendapatan_area['pendapatannetarea'];
    	}else{
    		$persenpennett=0;
    	}

    	$html.='<td align="right" style="color: red;background: #f6d55c;">'. number_format($nilaihppperitem*-1,0,',','.') .'</td>
          			<td align="right" style="background: #f6d55c;">'. number_format($persenpennett*100,0,',','.') .'</td>';
        $html.='</tr>';
	}


	if ($kode=='3B'){
  		$html .='<tr>
				    <td colspan="2" align="center" style="background: #a7aaad;border-right:white;">
				      '.$map1["nama_map"].'
				    </td>
				    <td  colspan="2" style="background: #a7aaad;border-right:white;border-left:white; " align="center">Keterangan</td>';
			for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: #a7aaad;border-right:white; ">Rp</td>
				    <td align="center" style="background: #a7aaad;border-left:white;">%</td>';
				}
					$html.='<td align="center" style="background: #a7aaad;border-right:white; ">Rp</td>
				    <td align="center" style="background: #a7aaad;border-left:white;">%</td>';
				  	$html.='</tr>';
  	}

  	if ($kode=='3D'){
  		$html .='<tr>
				    <td colspan="2" align="center" style="background: #a7aaad;border-right:white;">
				      '.$map1["nama_map"].'
				    </td>
				    <td  style="background: #a7aaad;border-right:white;border-left:white; " align="center">Keterangan</td>
				    <td  style="background: #a7aaad;border-right:white;border-left:white; " align="center">HO Area</td>';
			for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: #a7aaad;border-right:white; ">Rp</td>
				    <td align="center" style="background: #a7aaad;border-left:white;">%</td>';
				}
					$html.='<td align="center" style="background: #a7aaad;border-right:white; ">Rp</td>
				    <td align="center" style="background: #a7aaad;border-left:white;">%</td>';
				  $html.='</tr>';
  	}

	

	if ($kode=='3C'){
		$klm='kd_proyek';
		$html.='<tr>
    <td colspan="4" align="center">
      SUB TOTAL B
    </td>';
    $proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
    $nilaihpp=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}
    		$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
    		
    		foreach($tothpp as $tothpp){
    			$nilaihpp=$nilaihpp+$tothpp['nilai_hpp'];
    			if ($tothpp['nilai_hpp']!=0 && $pendapatan_nett!=0){
    			    $persen_sub_total_b = $tothpp['nilai_hpp']*-1/$pendapatan_nett*100;
    			}else if ($tothpp['nilai_hpp']!=0 && $pendapatan_nett== 0){
    			    $persen_sub_total_b = -1*100;
    			}else{
    			    $persen_sub_total_b = 0;
    			}
    			
    			
    			$html.='<td align="right" style="background: #a7aaad;">'. number_format($tothpp['nilai_hpp']*-1,0,',','.').'</td>
    					<td align="right" style="background: #a7aaad;">'. number_format($persen_sub_total_b,0,',','.').'</td>';
    		}
		}

		if($pendapatan_area['pendapatannetarea']!=0){
    		$persen_subtotalb=$nilaihpp*-1/$pendapatan_area['pendapatannetarea'];
    	}else{
    		$persen_subtotalb=0;
    	}

		$html.='<td align="right" style="background: #a7aaad;">'. number_format($nilaihpp*-1,0,',','.').'</td>
    					<td align="right" style="background: #a7aaad;">'. number_format($persen_subtotalb*100,0,',','.').'</td>';
  		$html.='</tr>';
	}


if ($kode=='3E'){
		$html.='<tr>
					<td colspan="'.$colspan1.'">'.$map1["nama_map"].'</td>
    			</tr>';
	}

if ($kode=='6'){
		$html.='<tr>
          			<td width="3%">'.$map1["number"].'</td>
          			<td>'.$map1["nama_map"].'</td>';
          
    		$op 	= $this->pq_model->get_op_by_area($kd_item,$id,$tahun);

    		$jumlahops=0;
    		foreach($op as $operasional){

    			$jumlahops=$jumlahops+$operasional['total'];
    			
    			$html.='
    				<td align="center">'.$operasional['keterangan'].'</td>
    				<td align="right" style="color: red">'. number_format($operasional['total']*-1,0,',','.') .'</td>';
       		}
       		for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center"></td>
				    		<td align="center" ></td>';
				}
			foreach($op as $operasional){

    			$jumlahops=$jumlahops+$operasional['total'];

    			if($pendapatan_area['pendapatannetarea']!=0){
		    		$persenoperasional=$operasional['total']/$pendapatan_area['pendapatannetarea'];
		    	}else{
		    		$persenoperasional=0;
		    	}

    			$html.='
    				<td align="right" style="color: red;background:#f6d55c">'. number_format($operasional['total']*-1,0,',','.') .'</td>
    				<td align="right" style="background:#f6d55c">'. number_format($persenoperasional*100,0,',','.') .'</td>';
       		}

        $html.='</tr>';
	}

if ($kode=='6A'){
		$html.='<tr>
          			<td width="3%">'.$map1["number"].'</td>
          			<td>'.$map1["nama_map"].'</td>';
          
    		$op 	= $this->pq_model->get_marketing_by_area($kd_item,$id,$tahun);

    		foreach($op as $operasional){
    			$html.='
    				<td align="center">'.$operasional['keterangan'].'</td>
    				<td align="right" style="color: red">'. number_format($operasional['total']*-1,0,',','.') .'</td>';
       		}
       		for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center"></td>
				    		<td align="center" ></td>';
				}
			foreach($op as $operasional){
    			
				if($pendapatan_area['pendapatannetarea']!=0){
		    		$persenmarketing=$operasional['total']/$pendapatan_area['pendapatannetarea'];
		    	}else{
		    		$persenmarketing=0;
		    	}

    			$html.='
    				<td align="right" style="color: red;background:#f6d55c">'. number_format($operasional['total']*-1,0,',','.') .'</td>
    				<td align="right" style="background: #f6d55c">'. number_format($persenmarketing*100*-1,0,',','.') .'</td>';
       		}
        $html.='</tr>';
	}

$sub_total_c=$marketing['total']*-1;

if ($kode=='3F'){
	$html.='<tr>
        <td colspan="3" align="center">
          '.$map1["nama_map"].'
        </td>
        <td align="right" style="background: #a7aaad;border-right:white;">'. number_format($sub_total_c,0,',','.').'</td>';

        for ($i=0; $i <$jumlahkolom ; $i++){
				    $html.='<td align="center" style="background: #a7aaad;border-right:white;"></td>
				    		<td align="center" style="background: #a7aaad;border-right:white;"></td>';
				}

		if($pendapatan_area['pendapatannetarea']!=0){
		    		$persensubtotalc=$sub_total_c/$pendapatan_area['pendapatannetarea'];
		    	}else{
		    		$persensubtotalc=0;
		    	}

      $html.='	<td align="right" style="background: #a7aaad;border-right:white;">'. number_format($sub_total_c,0,',','.').'</td>
      			<td align="right" style="background: #a7aaad;border-right:white;">'. number_format($persensubtotalc*100,0,',','.').'</td>
      			</tr>';
}



if($kode==7){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="center" style="background: #a7aaad;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
		$total_lr_operasional=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$lr_operasional = $sub_total_a+$sub_total_b;

	    	$total_lr_operasional=$total_lr_operasional+$lr_operasional;
	    	
	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}
    		
    		if ($lr_operasional!=0 && $pendapatan_nett!=0){
    		    $persenlroperasional= ($lr_operasional)/$pendapatan_nett*100;
    		}else if ($lr_operasional!=0 && $pendapatan_nett==0){
    		    $persenlroperasional= 100;
    		}else{
    		    $persenlroperasional= 0;
    		}
    		
	    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($lr_operasional,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persenlroperasional,0,',','.').'</td>';

    	}
			

			if($pendapatan_area['pendapatannetarea']!=0){
				$persenlr_operasional=($total_lr_operasional+$sub_total_c)/$pendapatan_area['pendapatannetarea'];
			}else{
				$persenlr_operasional=0;
			}
    
    	
	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($total_lr_operasional+$sub_total_c,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persenlr_operasional*100,0,',','.').'</td>';	
    
  $html.='</tr>';
}


if($kode==8){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="center" style="background: #a7aaad;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
	$total_nalokasi_ho=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho=$pqproyek['nalokasi_ho'];
	    		$total_nalokasi_ho=$total_nalokasi_ho+$nalokasi_ho;

	    	}
	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    		foreach($pq as $pqproyek){
    			$pendapatan_nett=$pqproyek["pendapatan_nett"];
    		}
	    	if ($nalokasi_ho !=0 && $pendapatan_nett !=0){
    				$persenalikasiho = $nalokasi_ho/$pendapatan_nett*100*-1;
    			}else if ($nalokasi_ho !=0 && $pendapatan_nett ==0){
    				$persenalikasiho=100*-1;
    			}else{
    				$persenalikasiho=0;
    			}

	    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($nalokasi_ho*-1,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persenalikasiho,0,',','.').'</td>';

    	}

		if($pendapatan_area['pendapatannetarea']!=0){
			$persennalokasi=$total_nalokasi_ho*-1/$pendapatan_area['pendapatannetarea'];
		}else{
			$persennalokasi=0;
		}
		
	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($total_nalokasi_ho*-1,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persennalokasi*100,0,',','.').'</td>';    
  $html.='</tr>';
}


if($kode=='9'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="center" style="background: #a7aaad;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
	$total_lr_setelah_ho=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho 		=$pqproyek['nalokasi_ho']*-1;
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];

	    	}

	    	

	    	$lr_setelah_ho = $sub_total_a+$sub_total_b+$nalokasi_ho;
	        
            if($lr_setelah_ho !=0 && $pendapatan_nett!=0){
                $persenlrsetelahho=($lr_setelah_ho)/$pendapatan_nett*100;
            }else if ($lr_setelah_ho !=0 && $pendapatan_nett==0){
                $persenlrsetelahho=100;
            }else{
                $persenlrsetelahho=0;
            }
        

	    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($lr_setelah_ho,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persenlrsetelahho,0,',','.').'</td>';

    	}
    	
    	$total_lr_setelah_ho = ($total_nalokasi_ho*-1)+$total_lr_operasional+$sub_total_c;
	if($pendapatan_area['pendapatannetarea']!=0){
			$persen_lr_setelah_ho=$total_lr_setelah_ho/$pendapatan_area['pendapatannetarea'];
		}else{
			$persen_lr_setelah_ho=0;
		}

	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($total_lr_setelah_ho+$tahunlalu['tahunlalu'],0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persen_lr_setelah_ho*100,0,',','.').'</td>';    	
	
    
  $html.='</tr>';
}



if($kode=='10A'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="left" style="background: #a7aaad;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
	$total_distribusi_ho_area_tiap_projek=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];

	    	}

	    	if ($pendapatan_area['pendapatannetarea']==0){
	    		$distribusi_ho_area_tiap_projek = 0;
	    	}else{
	    		$distribusi_ho_area_tiap_projek = ($pendapatan_nett/$pendapatan_area['pendapatannetarea'])*$sub_total_c;
	    	}
	    	
	    	$total_distribusi_ho_area_tiap_projek=$total_distribusi_ho_area_tiap_projek+$distribusi_ho_area_tiap_projek;
	    	if($distribusi_ho_area_tiap_projek !=0 && $pendapatan_nett!=0){
	    	    $persendistribusihoareatiapprojek= ($distribusi_ho_area_tiap_projek)/$pendapatan_nett*100;
	    	}else if($distribusi_ho_area_tiap_projek !=0 && $pendapatan_nett==0){
	    	    $persendistribusihoareatiapprojek= 100;
	    	}else{
	    	    $persendistribusihoareatiapprojek= 0;    
	    	}
            
            
	    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($distribusi_ho_area_tiap_projek,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persendistribusihoareatiapprojek,0,',','.').'</td>';

    	}
	
    	if($pendapatan_area['pendapatannetarea']!=0){
			$persen_distribusi_ho_area_tiap_projek=($total_distribusi_ho_area_tiap_projek)/$pendapatan_area['pendapatannetarea'];
		}else{
			$persen_distribusi_ho_area_tiap_projek=0;
		}
    	
	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($total_distribusi_ho_area_tiap_projek,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persen_distribusi_ho_area_tiap_projek*100,0,',','.').'</td>';	
    
  $html.='</tr>';
}

if($kode=='10B'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="left" style="background: #a7aaad;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
    	$total_tot_biaya_per_projek=0;
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho 		=$pqproyek['nalokasi_ho']*-1;
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];
	    		$nilai_pl 			=$pqproyek["nilai_pl"]*-1;
	    		

	    	}

	    	if ($pendapatan_area['pendapatannetarea']==0){
	    		$distribusi_ho_area_tiap_projek = 0;
	    	}else{
	    		$distribusi_ho_area_tiap_projek = ($pendapatan_nett/$pendapatan_area['pendapatannetarea'])*$sub_total_c;	
	    	}
	    	

	    	$tot_biaya_per_projek = $distribusi_ho_area_tiap_projek+$nalokasi_ho +$sub_total_b+$nilai_pl;
	    	$total_tot_biaya_per_projek=$total_tot_biaya_per_projek+$tot_biaya_per_projek;
            
            	    	if ($tot_biaya_per_projek !=0 && $pendapatan_nett !=0){
            	    		$persentotbiayaperprojek = ($tot_biaya_per_projek)/$pendapatan_nett*100;
            	    	}else if ($tot_biaya_per_projek!=0 && $pendapatan_nett==0){
            	    		$persentotbiayaperprojek = 100;
            	    	}else{
            	    		$persentotbiayaperprojek = 0;
            	    	}
            
            
            	    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($tot_biaya_per_projek,0,',','.').'</td>
                		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persentotbiayaperprojek,0,',','.').'</td>';

    	}

    	if($pendapatan_area['pendapatannetarea']!=0){
			$persen_biaya_per_projek=($total_tot_biaya_per_projek)/$pendapatan_area['pendapatannetarea'];
		}else{
			$persen_biaya_per_projek=0;
		}

    	if($pendapatan_area['pendapatannetarea']!=0){
			$persen_biaya_per_projek=($total_tot_biaya_per_projek)/$pendapatan_area['pendapatannetarea'];
		}else{
			$persen_biaya_per_projek=0;
		}

    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($total_tot_biaya_per_projek,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persen_biaya_per_projek*100,0,',','.').'</td>';
  $html.='</tr>';
}

if($kode=='10C'){


	// looping proyek
	$html.='<tr>
    <td colspan="4" align="left" style="background: #a7aaad;">
      '.$map1["nama_map"].'
    </td>';
	$proyek = $this->pq_model->get_proyek_by_area($klm, $id, $tahun);
    	foreach($proyek as $proyek){
    		$proyek 	= $proyek[$klm];
    		$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$sub_total_a=$pqproyek['sub_total_a'];

	    	}

	    	$tothpp 	= $this->pq_model->get_total_hpp_by_projek($id, $proyek);
	    		foreach($tothpp as $tothpp){

	    			$sub_total_b = $tothpp['nilai_hpp']*-1;
	    		}

	    	$pq = $this->pq_model->get_pq_by_projek($id, $proyek);
    	
	    	foreach($pq as $pqproyek){
	    		$nalokasi_ho 		=$pqproyek['nalokasi_ho']*-1;
	    		$pendapatan_nett 	=$pqproyek["pendapatan_nett"];
	    		$nilai_pl 			=$pqproyek["nilai_pl"]*-1;
	    		

	    	}
	    	if ($pendapatan_area['pendapatannetarea']==0){
	    		$distribusi_ho_area_tiap_projek = 0;
	    	}else{
	    		$distribusi_ho_area_tiap_projek = ($pendapatan_nett/$pendapatan_area['pendapatannetarea'])*$sub_total_c;	
	    	}
	    	

	    	$tot_biaya_per_projek = $distribusi_ho_area_tiap_projek+$nalokasi_ho +$sub_total_b+$nilai_pl;

            if($tot_biaya_per_projek !=0 && $pendapatan_nett !=0){
                $persenakhir = ($tot_biaya_per_projek+$pendapatan_nett)/$pendapatan_nett*100;
            }else if ($tot_biaya_per_projek !=0 && $pendapatan_nett ==0){
                $persenakhir=100;
            }else{
                $persenakhir=0;
            }


	    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($pendapatan_nett+$tot_biaya_per_projek,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persenakhir,0,',','.').'</td>';

    	}

    	if($pendapatan_area['pendapatannetarea']!=0){
			$persen_akhir=($total_tot_biaya_per_projek+$pendapatan_area['pendapatannetarea'])/$pendapatan_area['pendapatannetarea'];
		}else{
			$persen_akhir=0;
		}

    	

    	$html.='<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($pendapatan_area['pendapatannetarea']+$total_tot_biaya_per_projek,0,',','.').'</td>
    		<td align="right" style="background: #a7aaad;border-right:white; ">'. number_format($persen_akhir*100,0,',','.').'</td>';
  $html.='</tr>';
}


  }//end
    
  $html.='</table>';


		
		switch ($jenis)
        {
            case 0;
                header("Cache-Control: no-cache, no-store, must-revalidate");
	            header("Content-Type: application/vnd.ms-excel");
	            header("Content-Disposition: attachment; filename= LAPORAN PQ.xls");
	            echo $html;
                break;
            case 1;
                echo "<title>Laporan PQ</title>";
                echo $html;
                
               break;
        }
    }

   // cetak PQ All

    public function cetak_pq_all($tahun=0,$jenis=0)
	{	
		$map2					= $this->pq_model->get_map2();
		$marketing				= $this->pq_model->get_operasional_all($tahun);
		$pendapatan_area		= $this->pq_model->get_pendapatan_all_by_year($tahun);
		$spkperyear				= $this->pq_model->get_spk_all_by_year($tahun);


		$html="";
		$html.='<h4>Informasi Pekerjaan :</h4><table  border="1" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  ';
    

foreach($map2 as $map2){
  	$urut 		= $map2["urut"];
  	$kode 		= $map2["kode"];
  	$kolom 		= $map2["kolom"];
  	$kd_item 	= $map2["kd_item"];
  	$jenis_tk 	= $map2["jenis"];

  	// GET AREA
  	$area = $this->pq_model->get_area($tahun);
  		
  		if ($kode=='0' || $kode=='4'){
				$i=1;
				
		    	foreach($area as $area){
		    		$colspan1 = $i++;
		    	}	
		    	$html.='<tr>
    					<td colspan="4" width="50%">'.$map2["nama_map"].'</td>';
		    	$html.='<td colspan="'.$colspan1.'">&nbsp;</td>';
		}


    	if ($urut==1){
    			$html.='<tr>
    				<td colspan="4" width="50%">'.$map2["nama_map"].'</td>';
		    	foreach($area as $area){
		    		$html.='<td  align="center" colspan="2" width="10%">'.$area["nm_area"].'</td>';
		    	}	
    	}

    	if ($urut==2){
    			$html.='<tr>
    			<td colspan="4" width="50%">'.$map2["nama_map"].'</td>';
		    	foreach($area as $area){
		    		$html.='<td  align="center" colspan="2" width="10%">'.$tahun.'</td>';
		    	}	
    	}

    	if ($urut==3 || $urut==6 || $urut==7 || $urut==8|| $urut==9|| $urut==10|| $urut==12|| $urut==15|| $urut==16|| $urut==57){
    			
    			if ($urut==6 || $urut==7 || $urut==8|| $urut==9|| $urut==10|| $urut==15){
    				$html.='<tr>
    				<td width="5%"></td>
    				<td colspan="3" width="50%">'.$map2["nama_map"].'</td>';
    			}else{
    				$html.='<tr>
    			<td colspan="4" width="50%">'.$map2["nama_map"].'</td>';	
    			}
    			
    			$nilai_spk=0;
		    	foreach($area as $area){
		    		$kodearea = $area["kd_area"];
		    		$pagu = $this->pq_model->get_pq($kodearea,$tahun);
		    		if ($map2["kolom"]=='pendapatan_nett'){
		    			$pendapatan_nett=$pagu[$map2["kolom"]];
		    		}
		    		if ($map2["kolom"]=='nilai_spk'){
		    			$nilai_spk		=$pagu[$map2["kolom"]];
		    		}

		    		if ($nilai_spk!=0 && $pagu[$map2["kolom"]]!=0){
		    			$persen1 = $pagu[$map2["kolom"]]/$nilai_spk*100;
		    		}else{
		    			$persen1=0;
		    		}

		    		$html.='<td  align="right" width="10%">'.number_format($pagu[$map2["kolom"]],0,",",".").'</td>
		    				<td  align="right" width="10%">'.number_format($persen1,0,",",".").'</td>';
		    	}	
    	}

    	if ($urut>=19 && $urut <=27){
    		$jumlahhpp=0;
    		$nilaihppperitem=0;
    		$html.='<tr>
    			<td colspan="4" width="50%">'.$map2["nama_map"].'</td>';
    		foreach($area as $area){
		    		$kodearea = $area["kd_area"];
		    		$hpp 	= $this->pq_model->get_cetak_hpp_all_by_area($kd_item, $jenis_tk, $kodearea);

		    		foreach($hpp as $hpp){
		    			$nilaihppperitem=$nilaihppperitem+$hpp['nilai_hpp'];
		    			if ($pendapatan_nett!=0){
		    				$persen_pen_hpp = $hpp['nilai_hpp']/$pendapatan_nett*100;
		    			}else if($hpp['nilai_hpp']!=0 && $pendapatan_nett!=0){
		    			    $persen_pen_hpp = $hpp['nilai_hpp']/$pendapatan_nett*100;
		    			} else{
		    				$persen_pen_hpp = 0;	
		    			}
		    			
		    			$html.='<td align="right" style="color: red">'. number_format($hpp['nilai_hpp']*-1,0,',','.') .'</td>
		    					<td align="right" style="color: red">'. number_format($persen_pen_hpp*-1,0,',','.') .'</td>';
		       		}




		    	}


    		

    		
    		

    	}

    	// if ($urut==3){
    	// 	$area = $this->pq_model->get_area($tahun);
		   //  	foreach($area as $area){
		   //  		$kodearea = $area["kd_area"];
		   //  		$pagu = $this->pq_model->get_pagu($kodearea,$tahun);
		    			
		   //  				$html.='<td colspan="2" align="center" width="10%">'.number_format($pagu['nilai_pagu'],0,",",".").'</td>';
		    			

		    		
		   //  	}	
    	// }


    	

    	
    	// // $proyek = $this->pq_model->get_proyek_by_area($map1["kolom"], $id, $tahun);
    	// // foreach($proyek as $proyek){
    	// // 	$jumlahkolom = $i++;

    	// // 	if ($map1["kolom"]=='nilai_pagu'){
    	// // 		$pagu = $pagu+$proyek['nilai_pagu'];
    	// // 		$html.='<td colspan="2" align="center">'.number_format($proyek[$map1["kolom"]],0,",",".").'</td>';
    	// // 	}else if ($map1["kolom"]=='masa_kontrak' || $map1["kolom"]=='lama_pekerjaan'){
    	// // 		$html.='<td colspan="2" align="center">'.$proyek[$map1["kolom"]].' Bulan </td>';
    	// // 	}else{
    	// // 		$html.='<td colspan="2" align="center">'.$proyek[$map1["kolom"]].'</td>';	
    	// // 	}
    		
    	// // }

    	// // if ($map1["kolom"]=='nilai_pagu'){
    	// // 	$html.='<td colspan="2" align="center" style="background: #f6d55c;">'.number_format($pagu,0,",",".").'</td>';
    	// // }else if($map1["kolom"]=='nm_paket_proyek'){
    	// // 	$html.='<td colspan="2" align="center" style="background: #f6d55c;">REKAPITULASI</td>';
    	// // }else{
    	// // 	$html.='<td colspan="2" align="center" style="background: #f6d55c;"></td>';
    	// // }
  		$html.='</tr>';
  	
  


  }

$html.='</table>';		
		switch ($jenis)
        {
            case 0;
                header("Cache-Control: no-cache, no-store, must-revalidate");
	            header("Content-Type: application/vnd.ms-excel");
	            header("Content-Disposition: attachment; filename= LAPORAN PQ.xls");
	            echo $html;
                break;
            case 1;
                echo "<title>Laporan PQ</title>";
                echo $html;
                
               break;
        }
    }




public function cetak_saldo_awal($jenis='',$judul)
	{	
		$data['rincian'] 	= $this->saldoawal_model->get_lap_saldo_awal();
		switch ($jenis)
        {
            case 1;
                $this->load->library('pdf');
			    $this->pdf->setPaper('Legal', 'landscape');
			    $this->pdf->filename = "laporan.pdf";
			    $this->pdf->load_view('user/laporan/cetak_lap_saldo_awal', $data);
                break;
            case 0;
				header("Cache-Control: no-cache, no-store, must-revalidate");
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename= $judul.xls");
				$this->load->view('user/laporan/cetak_lap_saldo_awal', $data);
               break;
        }

	}

public function lap_saldo_awal(){
		$data['rincian'] 	= $this->saldoawal_model->get_lap_saldo_awal();
		$data['data_area'] 			= $this->area->get_area();
		$data['title'] = 'Laporan Saldo Awal';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('user/laporan/lap_saldo_awal',$data);
		$this->load->view('admin/includes/_footer');
	}


}


?>