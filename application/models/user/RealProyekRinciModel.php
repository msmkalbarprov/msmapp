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



	public function lap_rap($ctahun,$carea,$cproyek,$ctipe)
		{
		
		$cproyek = str_replace("12345678909", "/", $cproyek);
		
		$cnmarea	 = $this->PublicModel->get_nama($carea,'nm_area','ci_area','kd_area');	
		
		$query="SELECT*FROM v_get_proyek_pq WHERE kd_area='".$carea."' AND kd_proyek='".$cproyek."' 
				AND thn_anggaran='".$ctahun."'";
		$csql = $this->db->query($query);
		
		$data = $csql->row();
		//$cek2 = $data->jns;
		
		$query="SELECT DISTINCT kd_pdo,tgl_pdo FROM ci_pdo WHERE kd_project='".$cproyek."' ORDER BY tgl_pdo";
		
		
		
		$cRet ="";	
		$cRet .= "<table width=\"100%\"><tr>
							<td width=\"100%\" align=\"center\">
								<h4 style='font-size:18px;'><b>REALISASI RENCANA ANGGARAN PELAKSANAAN (RAP)</b></h4>
								<h4 style='font-size:18px;'><b>$cproyek - ".$data->nm_paket_proyek."</b></h4>
								<h4 style='font-size:18px;'><b>Nilai Pagu  Rp. ".number_format($data->nilai_pagu,0,',','.')." </b></h4>
								<h4 style='font-size:18px;'><b>Nilai SPK Rp. ".number_format($data->nilai_spk,0,',','.')."</b></h4>
								
								
							</td>
							</tr></table><br><br>";
			
							
				$cRet .= "<div style='overflow-x:auto;'>
				
							<div class='col-sm-12' style='font-size:14px;'>
								
							</div>	
				
								<table style=\"border-collapse:collapse;\" style=\"font-size:11\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"5%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>No<b></th>
											<th width=\"20%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Kode Rincian/Item<b></th>
											<th width=\"10%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Volume/Qty<b></th>
											<th width=\"10%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Satuan<b></th>
											<th width=\"10%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Harga <br>Satuan (Rp)<b></th>
											<th width=\"10%\"  style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Jumlah<b></th>";

										$cquery="SELECT DISTINCT nomor nopdp,tgl_cair FROM ci_proyek_cair WHERE 
												 kd_proyek='".$cproyek."' ORDER BY tgl_cair";
										$cdata = $this->db->query($cquery)->result(); 
										
										 $cjmlpdp=0;
										foreach ($cdata as $rows) { 
											$cjmlpdp=$cjmlpdp+1;
											$ctgl_cair=$this->PublicModel->tanggal_indonesia($rows->tgl_cair); 
											$cnopdp=$rows->nopdp; 
											$cRet .= "<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>".$cnopdp." </b><br>".$ctgl_cair."</th>";
											}
										
					$cRet .= "<th style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Jumlah<br> Realisasi</b></th>
							 <th style=\"font-size:8pt;text-align:center;padding:5px\" align=\"center\"><b>Sisa</b></th></tr></thead>";							
							
			
			$sql1 = "select kode,uraian,ifnull(kd_item,'')kd_item from map_rap where kode <=5 order by kode";
			$ddata = $this->db->query($sql1)->result_array();
			
			
			$no=0;
			$cvolume='';
			$csatuan='';
			$charga='';
			$cjumlah=0;
			foreach ($ddata as $value) {
				$ckode=$value['kode'];
				$curaian=$value['uraian'];
				$ckd_item=$value['kd_item'];
				
			//	print_r($curaian);die();
				
					$cquery="SELECT count(*)baris FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
					$cbaris = $this->db->query($cquery)->row()->baris; 
				
				
				if($ckode==8){
					$span=2;
					
				}else{
					$span=1;
					
				}
				
				//--ppn
							
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top;border-bottom:none; \"><b>".$ckode."</b></td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; border-bottom:none;\">".$curaian."</td>";


			if($ckode <= '5'){

					$cquery="SELECT ci_pendapatan.*,(SELECT SUM(total) FROM ci_hpp WHERE ci_hpp.id_pqproyek=ci_pendapatan.id_pqproyek)AS hpp
							FROM ci_pendapatan
							INNER JOIN ci_proyek ON ci_pendapatan.id_proyek=ci_proyek.kd_proyek
							WHERE ci_pendapatan.id_proyek='".$cproyek."'
							AND ci_proyek.batal='0' and ci_pendapatan.kd_area='".$carea."'";
					$cdata = $this->db->query($cquery)->result(); 
					$tjumlah=0;
					foreach ($cdata as $pqrow) {
						$nppn=$pqrow->ppn;
						$npph=$pqrow->pph;
						$ninfaq=$pqrow->infaq;
						$ntitipan=$pqrow->titipan_net;
						$npendapatan=$pqrow->pendapatan_nett;
						
						
						if($ckode==1){
							$charga=$nppn;
							$cjumlah=$nppn;
							
						}else if($ckode==2){
							$charga=$npph;
							$cjumlah=$npph;
							
						}else if($ckode==3){
							$charga=$ninfaq;
							$cjumlah=$ninfaq;
							
						}else if($ckode==4){
							$charga=$ntitipan;
							$cjumlah=$ntitipan;
							
						}else if($ckode==5){
							$charga=$npendapatan*0.15;
							$cjumlah=$npendapatan*0.15;
							
						}
						
						$tjumlah=$tjumlah+$cjumlah;
						
						if($cjumlah==0){
							$cvolume='';
							$csatuan='';
							
						}else{
							$cvolume='1';
							$csatuan='Paket';
							
							
						}
						

						$cRet .= "<td style=\"font-size:8pt;text-align:center; border-bottom:none;\">".$cvolume."</td>";
						$cRet .= "<td style=\"font-size:8pt;text-align:center; border-bottom:none;\">".$csatuan."</td>";
						$cRet .= "<td style=\"font-size:8pt;text-align:right;  border-bottom:none;\">".number_format($charga,0,',','.')."</td>";
						$cRet .= "<td style=\"font-size:8pt;text-align:right; border-bottom:none;\">".number_format($cjumlah,0,',','.')."</td>";	

							if($ckode <= '3'){
								if($cjumlah==0){
													
									for ($i=0; $i < $cjmlpdp; $i++) { 									
											$cRet .= "<td style=\"font-size:8pt;text-align:right;  border-bottom:none;\">".number_format(0,0,',','.')."</td>";	
											
										}

								}
							}

					}
					
				}
					
	
			$cquery="SELECT DISTINCT nomor nopdp,tgl_cair FROM ci_proyek_cair WHERE 
					 kd_proyek='".$cproyek."' ORDER BY tgl_cair";
			$cdata = $this->db->query($cquery)->result(); 
										
					$cnurutpdp=0;
					$jnilai=0;	
					$jho=0;
					
				foreach ($cdata as $rows) {
					$cnurutpdp=$cnurutpdp+1;	
					$ctgl_cair=$this->PublicModel->tanggal_indonesia($rows->tgl_cair); 
					$cnopdp=$rows->nopdp; 
				
				
						if($ckode==1){					
							$cwhere="and a.kd_acc ='5041405'";
							
						}else if($ckode==2){
							
							$cwhere="AND a.kd_acc IN ('5041401', '5041402', '5041403')";					
						}else if($ckode==3){
							
							$cwhere="AND a.kd_acc='5041407'";
						}
				
				

							$cquery="SELECT * FROM ci_proyek_cair_potongan a INNER JOIN ci_pendapatan b ON a.id_proyek=b.kd_proyek
									 WHERE  b.id_proyek='".$cproyek."' and nomor='".$cnopdp."' $cwhere ";
							$cdata = $this->db->query($cquery)->result();											
								$cnomor='';
								foreach ($cdata as $rows) { 
													
											$cnomor=$rows->nomor;
											$cnilai=$rows->nilai;
											$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($cnilai,0,',','.')."</th>";
										
								}
											
									
									

									

								if($ckode==4){
									
										$cquery=" SELECT  a.id_proyek,a.nomor,b.kd_area,b.titipan FROM ci_proyek_cair a
												  INNER JOIN ci_pendapatan b ON a.kd_proyek=b.id_proyek 
												  WHERE b.id_proyek='".$cproyek."' AND a.nomor='".$cnopdp."'";
										$cdata = $this->db->query($cquery)->result(); 
											
											$tnpdo=0;
											
											foreach ($cdata as $rows) { 
												if($cnurutpdp==1){
													$cnilai=$rows->titipan; 
												}else{
													$cnilai=0; 
												}
												
												$jnilai=$jnilai+$cnilai;
												$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($cnilai,0,',','.')."</th>";
									
											}
									}

									if($ckode==5){
									
										$cquery="SELECT nomor,nilai_bruto,pot,(nilai_bruto-pot)net,
												 IFNULL((SELECT titipan FROM ci_pendapatan WHERE id_proyek=z.kd_proyek AND nomor=z.nomor),0)titipan
												 FROM(
												 SELECT a.kd_proyek,a.nomor,a.nilai_bruto,(SELECT SUM(nilai) FROM ci_proyek_cair_potongan WHERE id_proyek=a.id_proyek AND nomor=a.nomor)pot FROM ci_proyek_cair a
												 INNER JOIN ci_pendapatan b ON a.kd_proyek=b.id_proyek WHERE b.id_proyek='".$cproyek."' AND a.nomor='".$cnopdp."' 
												 )z";
												
										$cdata = $this->db->query($cquery)->result(); 
											
											
											foreach ($cdata as $rows) { 
													$cnilai=$rows->net;
													
													if($cnurutpdp==1){
														$ctitipan=$rows->titipan; 
													}else{
														$ctitipan=0; 
													}
												
													$cho=($cnilai-$ctitipan)*0.15;
													
													$jho=$jho+$cho;
												
													$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($cho,0,',','.')."</th>";
									
											}
											
								}

				
				}	
					
					
					
					if($ckode<=3){
									
							$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($tjumlah,0,',','.')."</th>";
							$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($cjumlah-$tjumlah,0,',','.')."</th>";
				
					}
					
					
					
					
					if($ckode==4){
						
						$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($jnilai,0,',','.')."</th>";	
						$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($cjumlah-$jnilai,0,',','.')."</th>";	
									
						
					}else if($ckode==5){
						
						$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($jho,0,',','.')."</th>";
						$cRet .= "<th style=\"font-size:7pt;text-align:right;padding:5px\" align=\"right\">".number_format($cjumlah-$jho,0,',','.')."</th>";
					
					}
					
					
					
					
					
					
					$cRet .= "</tr>";
					
			}		
						
			$cRet .= "</table></div>"; 
			
			
			
			
//---- II




	$cRet .= "<div style='overflow-x:auto;margin-top:80px;'>
				
							<div class='col-sm-12' style='font-size:10px;'>
								
							</div>	
				
								<table style=\"border-collapse:collapse;\" style=\"font-size:7\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
									<thead>
									
										<tr bgcolor=\"#CCCCCC\">
											<th width=\"3%\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>No<b></th>
											<th width=\"9%\"  style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Kode Rincian/Item<b></th>
											<th width=\"9%\"   style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Volume/Qty<b></th>
											<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Satuan<b></th>
											<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Harga <br>Satuan (Rp)<b></th>
											<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Jumlah<b></th>";

										$cquery="SELECT DISTINCT kd_pdo,tgl_pdo,kd_area FROM ci_pdo WHERE status_bayar=1 AND kd_area='".$carea."' 
												AND kd_project='".$cproyek."' ORDER BY tgl_pdo";
										$cdata = $this->db->query($cquery)->result(); 
										
										foreach ($cdata as $rows) { 
											
											$ctgl_pdo=$this->PublicModel->tanggal_indonesia($rows->tgl_pdo); 
											$ckd_pdo=$rows->kd_pdo; 
											$cRet .= "<th style=\"font-size:6pt;text-align:center;padding:5px\" align=\"center\"><b>".$ckd_pdo." </b><br>".$ctgl_pdo."</th>
													  ";
											}
										
			$cRet .= "<th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Jumlah<br> Realisasi</b></th>
					  <th style=\"font-size:7pt;text-align:center;padding:5px\" align=\"center\"><b>Sisa</b></th></tr></thead>";							
					
			
			$sql1 = "select kode,uraian,ifnull(kd_item,'')kd_item from map_rap where kode >=6 order by kode";
			$ddata = $this->db->query($sql1)->result_array();
			
			
			$no=0;
			$cvolume='';
			$csatuan='';
			$charga='';
			$cjumlah='';
			foreach ($ddata as $value) {
				$no=$no+1;
				$ckode=$value['kode'];
				$curaian=$value['uraian'];
				$ckd_item=$value['kd_item'];
				
				
					$cquery="SELECT count(*)baris FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
					$cbaris = $this->db->query($cquery)->row()->baris; 
				
				
				if($ckode==8){
					$span=2;
					
				}else{
					$span=1;
					
				}
				
				//--ppn
							
					$cRet .="<tr>";
					$cRet .= "<td style=\"font-size:8pt;text-align:center;vertical-align: text-top; \"><b>".$no."</b></td>";
					$cRet .= "<td style=\"font-size:8pt;text-align:left;vertical-align: text-top; \">".$curaian."</td>";

					
						if($cbaris>1){
							$cspasi="<tr><td style=\"font-size:8pt;\">&nbsp;</td></tr>";
						}else{
							$cspasi='';
						}
					
					
						if($ckd_item=='5020101'){
							$cquery="SELECT kd_area,volume,satuan,jenis_tk, 
									CASE WHEN ppl !=0 THEN ppl ELSE npl END AS harga, 
									CASE WHEN ppl !=0 THEN ppl ELSE npl END AS total,jenis_tk FROM( 
									SELECT ci_pendapatan.*,1 volume,'Paket' satuan,''jenis_tk FROM ci_pendapatan 
									INNER JOIN ci_proyek ON ci_pendapatan.id_proyek=ci_proyek.kd_proyek 
									WHERE ci_pendapatan.id_proyek ='".$cproyek."' AND ci_proyek.batal =0)z";
							
					
							$cdata = $this->db->query($cquery)->result();
							
						}else{
					
							$cquery="SELECT *FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
							$cdata = $this->db->query($cquery)->result();
							
						}					
							 
					
							$cRet .="<td><table>";
							foreach ($cdata as $pqrow) {
									$cvolume=$pqrow->volume;
									$ctk=$pqrow->jenis_tk;
									$cRet .= "<tr><td style=\"font-size:8pt;text-align:left; \">".$cvolume." ".$ctk."</td></tr>";

								}
							$cRet .= $cspasi;
							$cRet .= $cspasi;
							$cRet .="</table><td>";					


							$cRet .="<table>";
							foreach ($cdata as $pqrow) {
								
									$csatuan=$pqrow->satuan;
									$cRet .= "<tr><td style=\"font-size:8pt;text-align:center; \">".$csatuan."</td></tr>";
									
								}
							$cRet .= $cspasi;
							$cRet .= $cspasi;
							$cRet .="</table>";


							$cRet .="<td><table>";
							foreach ($cdata as $pqrow) {
									$charga=$pqrow->harga;
									$cRet .= "<tr><td style=\"font-size:8pt;text-align:right; \">".number_format($charga,0,',','.')."</td></tr>";
									
								}
							$cRet .= $cspasi;
							$cRet .= $cspasi;
							$cRet .="</table><td>";


							$cRet .="<table>";
							$tjumlah=0;
							foreach ($cdata as $pqrow) {
								
									$cjumlah=$pqrow->total;
									$tjumlah=$tjumlah+$cjumlah;
									$cRet .= "<tr><td style=\"font-size:8pt;text-align:right; \">".number_format($cjumlah,0,',','.')."</td></tr>";	
										
							
								}
								
							if($cbaris>1){	
								$cRet .= "<tr><td style=\"font-size:8pt;text-align:left; \">-----------------+</td></tr>";					
								$cRet .= "<tr><td style=\"font-size:8pt;text-align:right; \">".number_format($tjumlah,0,',','.')."</td></tr>";
							}
							$cRet .="</table>";
			
			
						$cquery="SELECT DISTINCT kd_pdo,tgl_pdo,kd_area FROM ci_pdo WHERE status_bayar=1 AND kd_area='".$carea."' 
								AND kd_project='".$cproyek."' ORDER BY tgl_pdo";
						$cdata = $this->db->query($cquery)->result(); 
							
							$tnpdo=0;
							foreach ($cdata as $rows) { 
								
								$ctgl_pdo=$this->PublicModel->tanggal_indonesia($rows->tgl_pdo);
								$ckd_pdo=$rows->kd_pdo;
								
									if($ckd_item<>''){

											if($ckd_item=='5020101'){
														
														$query="SELECT *FROM ci_pdo WHERE kd_project='".$cproyek."' and kd_pdo='".$ckd_pdo."' and no_acc='".$ckd_item."' AND status_bayar=1"; 
														$cdata = $this->db->query($query)->result();
														$cRet .="<td><table>";
														
														$jnpdo=0;
														foreach ($cdata as $pdorow) {
															$cnpdo=$pdorow->nilai;
															$jnpdo=$jnpdo+$cnpdo;
															$tnpdo=$cnpdo+$tnpdo;
															
															$cRet .= "<tr><td  style=\"font-size:8pt;text-align:right;\">".number_format($cnpdo,0,',','.')."</td></tr>";
														}
														
														$cRet .="</table></td>";	

											}else{
												
														$cquery="SELECT count(*)baris FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
														$cbaris_pdo = $this->db->query($cquery)->row()->baris; 
															
														$cquery="SELECT *FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
														$cdata = $this->db->query($cquery)->result(); 
														
														$cRet .="<td><table>";
														
														$jnpdo=0;
														foreach ($cdata as $pqrow) {
																
															$ctk=$pqrow->jenis_tk;
															
															if($ckd_item=='5010202'){
																$and ='and jenis_tkl="'.$ctk.'"';
															}else{
																$and ='';
																
															}
															
															$query="SELECT ifnull(sum(nilai),0)nilai FROM ci_pdo WHERE status_bayar=1 AND kd_area='".$carea."' 
																	AND kd_project='".$cproyek."' and kd_pdo='".$ckd_pdo."' and no_acc='".$ckd_item."' $and ORDER BY tgl_pdo";
															$cdata = $this->db->query($query)->result();
																
																foreach ($cdata as $pdorow) {
																		$cnpdo=$pdorow->nilai;
																		$jnpdo=$jnpdo+$cnpdo;
																		
																		$tnpdo=$cnpdo+$tnpdo;
																		
																	
																		$cRet .= "<tr><td  style=\"font-size:8pt;text-align:right;\">".number_format($cnpdo,0,',','.')."</td></tr>";
																}
																
																
																	
														}
															
														if($cbaris_pdo>1){	
															$cRet .= "<tr><td style=\"font-size:8pt;text-align:left;\">-----------------+</td></tr>";					
															$cRet .= "<tr><td style=\"font-size:8pt;text-align:right;\">".number_format($jnpdo,0,',','.')."</td></tr>";
														}		
																
														$cRet .="</table></td>";					
														
													}	
										
							}
						
						}
					
					$csisa = $tjumlah-$tnpdo;
					
			//---total		
					
				
					if($ckd_item=='5020101'){
							
							$cRet .= "<td style=\"font-size:8pt;text-align:right; padding:5px;\">".number_format($tnpdo,0,',','.')."</td>";
				
					}else{
							$cquery="SELECT count(*)baris FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
							$cbaris_pdo = $this->db->query($cquery)->row()->baris; 
					
						
							$cquery="SELECT *FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
							$cdata = $this->db->query($cquery)->result(); 
							
							$cRet .="<td><table>";
							
							$jtnpdo=0;
							foreach ($cdata as $pqrow) {
									
								$ctk=$pqrow->jenis_tk;
								
								if($ckd_item=='5010202'){
									$and ='and jenis_tkl="'.$ctk.'"';
								}else{
									$and ='';
									
								}
								
								$query="SELECT ifnull(sum(nilai),0)nilai FROM ci_pdo WHERE status_bayar=1 AND kd_area='".$carea."' 
											AND kd_project='".$cproyek."' and no_acc='".$ckd_item."' $and ";
								$cdata = $this->db->query($query)->result();
									
									foreach ($cdata as $pdorow) {
											$tnpdo=$pdorow->nilai;
											$jtnpdo=$jtnpdo+$tnpdo;
											$cRet .= "<tr><td  style=\"font-size:8pt;text-align:right; \">".number_format($tnpdo,0,',','.')."</td></tr>";
									}
								
							}		
						
								if($cbaris_pdo>1){	
									$cRet .= "<tr><td style=\"font-size:8pt;text-align:left; \">-----------------+</td></tr>";					
									$cRet .= "<tr><td style=\"font-size:8pt;text-align:right; \">".number_format($jtnpdo,0,',','.')."</td></tr>";
								}
					
							$cRet .="</table></td>";	
							
						
						
						}

						if($ckd_item=='5010202'){
								
														$cquery="SELECT count(*)baris FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
														$cbaris_pdo = $this->db->query($cquery)->row()->baris; 
															
														$cquery="SELECT *FROM ci_hpp WHERE kd_area='".$carea."' and kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."'";
														$cdata = $this->db->query($cquery)->result(); 
														
														$cRet .="<td><table>";
														
														$jnpdo=0;
														$tsisa=0;
														foreach ($cdata as $pqrow) {
																
															$ctk=$pqrow->jenis_tk;
															$and ='and jenis_tkl="'.$ctk.'"';
															
															
															$query="SELECT ifnull(sum(nilai),0)nilai,
															(SELECT SUM(total) nilai FROM ci_hpp WHERE kd_area='".$carea."' AND kd_pqproyek='PQ/".$cproyek."' AND kd_item='".$ckd_item."' AND jenis_tk='".$ctk."')cang FROM ci_pdo WHERE status_bayar=1 AND kd_area='".$carea."' 
															 AND kd_project='".$cproyek."' and no_acc='".$ckd_item."' $and ORDER BY tgl_pdo";
															$cdata = $this->db->query($query)->result();
																
																foreach ($cdata as $pdorow) {
																		$cnpdo=$pdorow->nilai;
																		$cang=$pdorow->cang;
																		$csisa=$cang-$cnpdo;
																		
																		$tsisa=$tsisa+$csisa;
																		//$jnpdo=$jnpdo+$cnpdo;
																		
																		//$tnpdo=$cnpdo+$tnpdo;
																		
																	
																		$cRet .= "<tr><td  style=\"font-size:8pt;text-align:right;\">".number_format($csisa,0,',','.')."</td></tr>";
																}
																
																
																	
														}
															
														if($cbaris_pdo>1){	
															$cRet .= "<tr><td style=\"font-size:8pt;text-align:left;\">-----------------+</td></tr>";					
															$cRet .= "<tr><td style=\"font-size:8pt;text-align:right;\">".number_format($tsisa,0,',','.')."</td></tr>";
														}		
																
														$cRet .="</table></td>";	


						}else{
								$cRet .= "<td style=\"font-size:8pt;text-align:right; padding:5px;\">".number_format($csisa,0,',','.')."</td>";	
					
						}
							
						
					$cRet .= "</tr>";
					
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
			

	public function listProyek($ctahun,$carea)
		{

			$sql = "SELECT DISTINCT a.kd_proyek,a.nm_paket_proyek nm_proyek FROM ci_proyek a
					INNER JOIN ci_proyek_rincian b ON a.id_proyek=b.id_proyek 
					WHERE a.thn_anggaran='".$ctahun."' AND a.kd_area='".$carea."'
					AND b.jns_pagu IN ('3','6') order by a.kd_proyek";
			
			$data=$this->db->query($sql);
			$html ='<option value="" disabled selected hidden> Pilih Proyek </option>';
			foreach ($data->result_array() as $value) {
				$html .='<option value="'.$value['kd_proyek'].'"> '.$value['kd_proyek'].' - '.$value['nm_proyek'].'</option>';
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