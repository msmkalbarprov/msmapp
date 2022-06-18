<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>

<?php
function penyebut($nilai) {
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " ". $huruf[$nilai];
  } else if ($nilai <20) {
    $temp = penyebut($nilai - 10). " belas";
  } else if ($nilai < 100) {
    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
  } else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  } else if ($nilai < 1000) {
    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
  } else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  } else if ($nilai < 1000000) {
    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
  } else if ($nilai < 1000000000) {
    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
  } else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
  } else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
  }     
  return $temp;
}

function terbilang($nilai) {
  if($nilai<0) {
    $hasil = "minus ". trim(penyebut($nilai));
  } else {
    $hasil = trim(penyebut($nilai));
  }         
  return $hasil;
}

function format_indo($date){
    $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    $bulan = $date;
    $result = $Bulan[(int)$bulan-1];
    return $result;
  }

?>

<table style="border-collapse:collapse; font-size:12;" width="100%" align="center" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td align="center">
                            <h2><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SURAT PERTANGGUNG JAWABAN (SPJ)</strong></h2>

                        </td>

                    </tr>
					<tr>
					<td colspan="2" align="left" style="font-size:10;border-top:none;border-bottom:none;"></td>
					</tr>
					<tr>
					<td colspan="2" align="left" style="font-size:10;border-top:none;border-bottom:none;"></td>
					</tr>
	
                  </table>


                  <table style="border-collapse:collapse; font-size:10;" width="100%" align="center" border="0" cellspacing="0" cellpadding="2">
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr><tr>
								<td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
					
                                <tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'>Nama Pegawai</td>
								<td width="1%" align='left'>:</td>
								<td width="20%" align='left'> <?= $spj_header['nama']; ?></td>
								
								<td width="5%" align='left'>Bulan</td>
								<td width="1%" align='left'>:</td>
								<td width="10%" align='left'><?= format_indo($spj_header2['bulan']).' '.$spj_header2['tahun']; ?></td>
								<td width="7%" align='left'></td>
								<td width="15%" align='left'></td>
                                </tr>
								<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left' style="border-bottom:solid 1px black;"></td>
								<td width="15%" align='left' style="border-bottom:solid 1px black;">Daerah</td>
								<td width="1%" align='left' style="border-bottom:solid 1px black;">:</td>
								<td width="20%" align='left' style="border-bottom:solid 1px black;"><?= ucwords(strtolower($spj_header['nm_area'])); ?></td>
								
								<td width="5%" align='left' style="border-bottom:solid 1px black;">No.HP</td>
								<td width="1%" align='left' style="border-bottom:solid 1px black;">:</td>
								<td width="10%" align='left' style="border-bottom:solid 1px black;"><?= $spj_header['no_hp']; ?></td>
								<td width="7%" align='left' style="border-bottom:solid 1px black;"></td>
								<td width="15%" align='left' ></td>
                                </tr>
								
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
			  <!-- mulai $Nope -->

							
                                <tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b>I.</td>
								<td width="15%" align='left'><b>Saldo Bulan Lalu</td>
								<td width="1%" align='left'></td>
								<td width="20%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= number_format($spj_header3['terima']-$spj_header5['keluar'],2,',','.'); ?></td>
								<td width="15%" align='left'></td>
                                </tr>
								
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								
								<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b>II.</td>
								<td width="15%" align='left'><b>Penerimaan</td>
								<td width="1%" align='left'></td>
								<td width="20%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'></td>
								<td width="8%" align='left'></td>
								<td width="15%" align='left'></td>
                                </tr>
								
								<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b></td>
								<td width="15%" align='left'>Transfer Penerimaan</td>
								<td width="1%" align='left'></td>
								<td width="20%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'></td>
								<td width="8%" align='left'></td>
								<td width="15%" align='left'></td>
                                </tr>


                                <tr>
							<td colspan='5'></td>
							<td colspan='2' align='left' align='left' ></td>
							<td align='left' colspan='2'>+</td>
							</td></tr>
							
							<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Penerimaan</td>
								
								
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= number_format($spj_header4['terima'],2,',','.'); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							
							<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b>III.</td>
								<td width="15%" align='left'><b>Pengeluaran</td>
								<td width="1%" align='left'></td>
								<td width="20%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'><b></td>
								<td width="8%" align='left'><b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b></td>
								<td width="15%" colspan='3' align='left'>&nbsp;&nbsp;&nbsp;&nbsp;Pengeluaran NON PAKET</td>
								
								
								<td width="5%" align='right'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right' ></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							
							
							<tr>
								<td colspan='5'></td>
								<td width="5%"  align='left'><?= number_format($spj_header2['total'],2,',','.'); ?></td>
								<td width="1%"  align='left'></td>
								<td width="10%" align='right'></td>
								<td colspan='2' align='left'></td>
								</td>
							</tr>
							<tr>
							<td colspan='5'></td>
							<td colspan='2' align='left' align='left' ></td>
							<td align='left' colspan='2'>+</td>
							</td></tr>
							
							<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Pengeluaran</td>
								
								
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= number_format($spj_header2['total'],2,',','.'); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b>IV.</td>
								<td width="15%" colspan='3' align='left'><b>Total Penerimaan - Total Pengeluaran</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'><b><?= number_format($spj_header4['terima']-$spj_header2['total'],2,',','.'); ?></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
							<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'><b>V.</td>
								<td width="15%" colspan='3' align='left'><b>Saldo Akhir</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= number_format($spj_header4['terima']+$spj_header3['terima']-$spj_header5['keluar']-$spj_header2['total'],2,',','.'); ?></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='10'></td></tr>
							<tr><td colspan='10'></td></tr>
			
							<tr><td colspan='9'></td></tr>
							
				  
				  </table>



                  <table style="border-collapse:collapse; font-size:9;" width="100%" align="center" border="0" cellspacing="0" cellpadding="2">
                     
					 
					 <thead>
                        <tr>
							<td bgcolor="#ffffff" width="5%"  align="center" style="border-top:none;border-bottom:none;"></td>
							<td bgcolor="#CCCCCC" width="18%" align="center" style="border-top:solid 2px black;border-left:solid 2px black;border-right:solid 1px black;"><b>Tanggal</b></td>
							<td bgcolor="#CCCCCC" width="40%" align="center" style="border-top:solid 2px black;border-right:solid 1px black;"><b>Akun</b></td>
                            <td bgcolor="#CCCCCC" width="40%" align="center" style="border-top:solid 2px black;border-right:solid 1px black;"><b>Keterangan</b></td>
                            <td bgcolor="#CCCCCC" width="2%" align="center" style="border-top:solid 2px black;border-right:solid 1px black;"><b>Bukti/Nota</b></td>
                            <td bgcolor="#CCCCCC" width="10%" align="center" style="border-top:solid 2px black;border-right:solid 1px black;"><b>Nilai</td>
							<td bgcolor="#ffffff" align="center" width="5%" style="border-top:none;border-bottom:none;"></td>
                        </tr>
                        
                     </thead>
<!-- rincian -->
                     <?php 
                     $total_spj=0;
                     foreach($rincian_spj as $rincian_spj): 
                     

                        if($rincian_spj['jns_ta']==1){
                            $jns_ta="Biaya Transportasi Operasional<br>  - ";
                        }else if($rincian_spj['jns_ta']==2){
                            $jns_ta="Biaya Hotel, Penginapan & Akomodasi, Kost<br>  - ";
                        }else if($rincian_spj['jns_ta']==3){
                            $jns_ta="Biaya Perdiem/Paket<br>  - ";
                        }else if($rincian_spj['jns_ta']==4){
                            $jns_ta="Biaya Service, Perawatan, Sparepart & Perlengkapan<br>  - ";
                        }else if($rincian_spj['jns_ta']==5){
                            $jns_ta="BBM, Parkir, Tol<br>  - ";
                        }else if($rincian_spj['jns_ta']==6){
                            $jns_ta="Asuransi Kendaraan<br>  - ";
                        }else if($rincian_spj['jns_ta']==7){
                            $jns_ta="Biaya Telepon, Internet dan Fax<br>  - ";
                        }else if($rincian_spj['jns_ta']==8){
                            $jns_ta="Biaya Pos, Pengiriman <br>  - ";
                        }else{
                            $jns_ta='';
                        }


                        if($rincian_spj['bukti']=='' || $rincian_spj['bukti']==null){
                            $bukti="-";
                        }else{
                            $bukti="Ada";
                        }
                     
                     ?>

                        <tr>
                                <td style="vertical-align:top;border-top: none;border-bottom: none;" align="center"></td>
                                <td style="vertical-align:top;border-top: 1px solid black;border-bottom: 1px solid black;border-left:2px solid black;" align="center"><?= $rincian_spj['tgl_bukti']; ?></td>
                                <td style="vertical-align:top;border-top: 1px solid black;border-left: 1px solid black;" align="left"><?= $rincian_spj['nm_acc']; ?></td>
                                <td style="vertical-align:top;border-top: 1px solid black;border-left: 1px solid black;" align="left"><?= $jns_ta.''.$rincian_spj['uraian']; ?></td>
                                <td style="vertical-align:top;border-top: 1px solid black;border-left: 1px solid black;" align="center"><?= $bukti; ?></td>
                                <td style="vertical-align:top;border-top: 1px solid black;border-left: 1px solid black;" align="right"><?= number_format($rincian_spj['nilai'],2,',','.'); ?></td>
                                <td style="border-left:none;border-top:none;border-bottom:none;border-left:2px solid black;"></td>
                        </tr>

                        <?php $total_spj = $total_spj+$rincian_spj['nilai']; ?>


                        <?php endforeach; ?>
<!-- end rincian -->
                            

                                <tr>
									 <td style="vertical-align:top;border-top: none;border-bottom: none;" align="center"></td>
									 <td colspan='4' style="vertical-align:top;border-top: 1px solid black;border-bottom: 2px solid black;border-left:2px solid black;" align="center"><b>TOTAL</td>
                                     
									 <td style="vertical-align:top;border-top: 1px solid black;border-left: 1px solid black;border-bottom: 2px solid black;" align="right"><b><?= number_format($total_spj,2,',','.'); ?></td>
									 <td style="border-left:none;border-top:none;border-bottom:none;border-left:2px solid black;"></td>
								</tr>
                  </table>