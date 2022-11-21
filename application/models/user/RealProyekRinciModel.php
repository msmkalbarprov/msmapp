<?php
	class RealProyekRinciModel extends CI_Model{

	public function angka($nilai){
		$nilai=str_replace(',','',$nilai);
		return $nilai;
	}

	function angka_format($nilai){

	    if($nilai<0){
	        $lc = '('.number_format(abs($nilai),2,',','.').')';
	    }else{
	        if($nilai==0){
	            $lc ='0,00';
	        }else{
	            $lc = number_format($nilai,2,',','.');
	        }
	    }
	}


	
	public function lap_proyek_cair_pdo($ctahun,$carea,$cacc,$ctipe)
		{
		
		$cnmarea	 = $this->PublicModel->get_nama($carea,'nm_area','ci_area','kd_area');	
		$cnmacc	 = $this->PublicModel->get_nama($cacc,'nm_acc','ci_coa','no_acc');
		
		$cRet ="";	
		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
								<h4><b>RINCIAN REALISASI PROYEK CAIR PDO</b></h4>
								<h4><b>AREA $cnmarea</b></h4>
								<h4><b>Tahun $ctahun</b></h4>
								
							</td>
							</tr></table><br><br>";
			
							
				$cRet .= "<div style='overflow-x:auto;'>
				
							<div class='col-sm-12' style='font-size:14px;'>
								<b>AKUN  : $cacc - $cnmacc </b>
							</div>	
				
								<table style=\"border-collapse:collapse;\" style=\"font-size:11\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"5%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NO<b></th>
											<th width=\"12%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>KODE <br>PROYEK<b></th>
											<th width=\"12%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NO PDO<b></th>
											<th width=\"10%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>TANGGAL <br>PDO<b></th>
											<th width=\"48%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN<b></th>
											<th width=\"15%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NILAI</b></th>
												
										</tr>
										
									</thead>";							
							
			$sql1 = 'CALL sp_RinciPDO('.$ctahun.',"'.$carea.'","'.$cacc.'");';
			$cdata = $this->db->query($sql1)->result_array();
			$this->db->close();
			
			$no=0;
			foreach ($cdata as $value) {
				
				$clevel=$value['clevel'];
				$carea=$value['kd_area'];
				$cproyek=$value['kd_proyek'];
				$cpdo=$value['kd_pdo'];
				$ctglpdo=$this->PublicModel->tanggal_indonesia($value['tgl_pdo']);
				$cacc=$value['no_acc'];
				$curaian=$value['uraian'];
				$cqty=$value['qty'];
				$csatuan=$value['satuan'];
				$charga=$value['harga'];
				$cnpdo=$value['npdo'];
				
				$cno='';
				
				if($clevel==1){
					$cjumlah=$cnpdo;
				}else{
					
					$cjumlah==0;
				}
			
			  if($clevel==2){
					$no++;
					$abold='<b>';
					$nbold='<b>';				
					$ckdpro=$cproyek;
					$ckdpdo='';
					$ctglpdo='';
					$curaian='PROYEK : '.$curaian;
					$cno=$no;
					
					
				}else if($clevel==3){
					
					$abold='<b><i>';
					$nbold='</i></b>';
					$ckdpro='';
					$ckdpdo=$cpdo;
					$cno='';
					
					
				}else if($clevel==4){
					
					$abold='';
					$nbold='';
					$ckdpro='';
					$ctglpdo='';
					$ckdpdo='';
					$ctglpdo='';
					$cno='';
					$curaian= $curaian.' ( '.$cqty.' '.$csatuan.' x '.number_format($charga,0,',','.').' )';
					
					
				}
						
				
				
				if($clevel==4){
					
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$cno."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ckdpro."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ckdpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ctglpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;border-top:none;padding-left:30px;\">".$abold."".$curaian."".$nbold."</td>";
					
					if($ctipe=='excel'){
						$cRet .= "<td style=\"font-size:8pt;text-align:right; border-bottom:none;border-top:none;\">".$abold."".$cnpdo."".$nbold."</td>";				
						
					}else{
						$cRet .= "<td style=\"font-size:8pt;text-align:right; border-bottom:none;border-top:none;\">".$abold."".number_format($cnpdo,0,',','.')."".$nbold."</td>";				
						
					}
					
					
				}else if($clevel==3){ // style=\"border-top:none;border-bottom:none;\"
					 
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top;border-bottom:none;border-top:none; \">".$cno."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ckdpro."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ckdpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ctglpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;padding-left:20px;\">".$abold."".$curaian."".$nbold."</td>";
					
					if($ctipe=='excel'){
							$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".$cnpdo."".$nbold."</td>";				

					}else{
							$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".number_format($cnpdo,0,',','.')."".$nbold."</td>";										
					}
									
				}else if($clevel==2){ // style=\"border-top:none;border-bottom:none;\"
					 
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top;border-bottom:none; \"><b>".$cno."</b></td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ckdpro."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center-;vertical-align: text-top; border-bottom:none;\">".$abold."".$ckdpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ctglpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;\">".$abold."".$curaian."".$nbold."</td>";
					if($ctipe=='excel'){
						$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".$cnpdo."".$nbold."</td>";				
					}else{
						$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".number_format($cnpdo,0,',','.')."".$nbold."</td>";				
						
					}
				}

					$cRet .= "</tr>";
					
				}		
					

			$cRet .="<tr>";
			$cRet .= "<td colspan=\"5\" style=\"font-size:9pt;text-align:right;vertical-align: text-top;\"><b>JUMLAH</b></td>";
			
			if($ctipe=='excel'){
				$cRet .= "<td style=\"font-size:9pt;text-align:right;\"><b>".$cjumlah."</b></td></tr>";
			}else{
				$cRet .= "<td style=\"font-size:9pt;text-align:right;\"><b>".number_format($cjumlah,0,',','.')."</b></td></tr>";
			}
			
						
			$cRet .= "</table></div>"; 

						
			return $cRet;
			
			
		}

	
	public function lap_proyek_cair_spj($ctahun,$carea,$cacc,$ctipe)
		{
		
		$cnmarea	 = $this->PublicModel->get_nama($carea,'nm_area','ci_area','kd_area');	
		$cnmacc	 = $this->PublicModel->get_nama($cacc,'nm_acc','ci_coa','no_acc');
		
		$cRet ="";	
		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
								<h4><b>RINCIAN REALISASI PROYEK CAIR SPJ</b></h4>
								<h4><b>AREA $cnmarea</b></h4>
								<h4><b>Tahun $ctahun</b></h4>
								
							</td>
							</tr></table><br><br>";
			
							
				$cRet .= "<div style='overflow-x:auto;'>
				
							<div class='col-sm-12' style='font-size:14px;'>
								<b>AKUN  : $cacc - $cnmacc </b>
							</div>	
				
								<table style=\"border-collapse:collapse;\" style=\"font-size:11\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"5%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NO<b></th>
											<th width=\"12%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>KODE <br>PROYEK<b></th>
											<th width=\"12%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NO PDO<b></th>
											<th width=\"12%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NO SPJ<b></th>
											<th width=\"10%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>TANGGAL <br>SPJ<b></th>
											<th width=\"38%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>URAIAN<b></th>
											<th width=\"15%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>NILAI</b></th>
												
										</tr>
										
									</thead>";							
							
			$sql1 = 'CALL sp_RinciSPJAkun('.$ctahun.',"'.$carea.'","'.$cacc.'");';
			$cdata = $this->db->query($sql1)->result_array();
			$this->db->close();
			
			$no=0;
			$cjumlah=0;
			foreach ($cdata as $value) {
				
				$clevel=$value['clevel'];
				$carea=$value['kd_area'];
				$cproyek=$value['kd_proyek'];
				$cpdo=$value['kd_pdo'];
				$cnospj=$value['no_spj'];
				$ctglspj=$this->PublicModel->tanggal_indonesia($value['tgl_spj']);
				$cacc=$value['no_acc'];
				$cnmacc=$value['nm_acc'];
				$curaian=$value['keterangan'];
				$cnilai=$value['nilai'];
				
				$cno='';
				
				if($clevel==1){
					$cjumlah=$cjumlah+$cnilai;
					
					
					$no++;
					$abold='<b>';
					$nbold='</b>';				
					$ckdpro=$cproyek;
					$ckdpdo='';
					$ctglpdo='';
					$curaian='PROYEK : '.$curaian;
					$cno=$no;
					
					
					
				}else{
					
					$cjumlah==0;
				}
			
			  if($clevel==2){
					
					$abold='<b><i>';
					$nbold='</i></b>';				
					$ckdpro='';
					$ckdpdo=$cpdo;
					$ctglpdo='';
					$curaian=$curaian;
					$cno='';
					
					
				}else if($clevel==3){
					
					$abold='';
					$nbold='';
					$ckdpro='';
					$ckdpdo='';
					$cno='';
					
					
				}
						
				
				
			 if($clevel==3){ // style=\"border-top:none;border-bottom:none;\"
					 
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top;border-bottom:none;border-top:none; \">".$cno."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ckdpro."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ckdpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$cnospj."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ctglspj."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;padding-left:20px;\">".$abold."".$curaian."".$nbold."</td>";
					
					if($ctipe=='excel'){
						$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".$cnilai."".$nbold."</td>";				
						
					}else{
						$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".number_format($cnilai,0,',','.')."".$nbold."</td>";				
						
					}
					
				}else if($clevel==2){ // style=\"border-top:none;border-bottom:none;\"
					 
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top;border-bottom:none;border-top:none; \"><b>".$cno."</b></td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;border-top:none;\">".$abold."".$ckdpro."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center-;vertical-align: text-top; border-bottom:none;\">".$abold."".$ckdpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center-;vertical-align: text-top; border-bottom:none;\">".$abold."".$cnospj."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ctglpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;\">".$abold."".$curaian."".$nbold."</td>";
					if($ctipe=='excel'){
						$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".$cnilai."".$nbold."</td>";				
						
					}else{
						$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".number_format($cnilai,0,',','.')."".$nbold."</td>";				
					
					}
					
				}else if($clevel==1){ // style=\"border-top:none;border-bottom:none;\"
					 
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top;border-bottom:none; \"><b>".$cno."</b></td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ckdpro."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center-;vertical-align: text-top; border-bottom:none;\">".$abold."".$ckdpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center-;vertical-align: text-top; border-bottom:none;\">".$abold."".$cnospj."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; border-bottom:none;\">".$abold."".$ctglpdo."".$nbold."</td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;\">".$abold."".$curaian."".$nbold."</td>";
						if($ctipe=='excel'){
							$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".$cnilai."".$nbold."</td>";				
							
						}else{
							$cRet .= "<td style=\"font-size:9pt;text-align:right; border-bottom:none;\">".$abold."".number_format($cnilai,0,',','.')."".$nbold."</td>";				
							
						}
					
				}

					$cRet .= "</tr>";
					
				}		
					

			$cRet .="<tr>";
			$cRet .= "<td colspan=\"6\" style=\"font-size:9pt;text-align:right;vertical-align: text-top;\"><b>JUMLAH</b></td>";
			if($ctipe=='excel'){
				$cRet .= "<td style=\"font-size:9pt;text-align:right;\"><b>".$cjumlah."</b></td></tr>";
			}else{
				$cRet .= "<td style=\"font-size:9pt;text-align:right;\"><b>".number_format($cjumlah,0,',','.')."</b></td></tr>";
			}
			
						
			$cRet .= "</table></div>"; 

						
			return $cRet;
			
			
		}



	public function listAcc($ctahun,$carea)
		{

			$sql = "SELECT DISTINCT a.no_acc,a.nm_acc FROM ci_pdo a 
					LEFT JOIN
					 (SELECT DISTINCT b.kd_area,b.id_proyek,b.kd_proyek FROM ci_proyek b 
					INNER JOIN ci_proyek_rincian c ON  b.id_proyek = c.id_proyek  
					WHERE b.thn_anggaran='".$ctahun."' and (b.batal IS NULL OR b.batal = 0) AND  c.jns_pagu IN ('3','6')
					)bb
					ON a.kd_area=bb.kd_area AND a.kd_project=bb.kd_proyek 
					WHERE  a.status_bayar=1 and a.kd_area='".$carea."'  AND nm_acc IS NOT NULL";
			
			
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Akun </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['no_acc'].'"> '.$value['no_acc'].' - '.$value['nm_acc'].'</option>';
			}

			return $html;
			
			
		}			
			


	function listArea($ctahun)
		{

			$sql = "SELECT DISTINCT b.kd_area AS kd_area,b.nm_area AS nm_area
					FROM (ci_proyek b JOIN ci_proyek_rincian a ON(b.id_proyek = a.id_proyek)) WHERE b.thn_anggaran='".$ctahun."'  AND (b.batal IS NULL OR b.batal = 0) 
					AND a.jns_pagu IN ('3','6') GROUP BY b.kd_area";

			$data=$this->db->query($sql);
			$html ='<option value=""> Pilih Area </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_area'].'"> '.$value['kd_area'].' - '.$value['nm_area'].'</option>';
			}

			return $html;
			
			
		}			






	} 
?>