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

function angka($nilai){

	if($nilai<0){
		$lc = '('.number_format(abs($nilai),2,',','.').')';
	}else{
		if($nilai==0){
			$lc ='0,00';
		}else{
			$lc = number_format($nilai,2,',','.');
		}
	}
	return $lc;
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


                  <table style="border-collapse:collapse; font-size:9;" width="100%" align="center" border="0" cellspacing="0" cellpadding="2">
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
                                <tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
								<tr><td colspan='10'></td></tr>
					
                                <tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'>Nama Pegawai</td>
								<td width="1%" align='left'>:</td>
								<td width="15%" align='left'> <?= $spj_header['nama']; ?></td>
								
								<td width="5%" align='left'>Bulan</td>
								<td width="1%" align='left'>:</td>
								<td width="10%" align='left'><?= format_indo($this->uri->segment(5)).' '.$this->uri->segment(6); ?></td>
								<td width="7%" align='left'></td>
								<td width="15%" align='left'></td>
                                </tr>
								<tr>
								<td width="15%" align='left'></td>
								<td width="1%" align='left' style="border-bottom:solid 1px black;"></td>
								<td width="15%" align='left' style="border-bottom:solid 1px black;">Daerah</td>
								<td width="1%" align='left' style="border-bottom:solid 1px black;">:</td>
								<td width="15%" align='left' style="border-bottom:solid 1px black;"><?= ucwords(strtolower($spj_header['nm_area'])); ?></td>
								
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
                    </table>
                    <table style="border-collapse:collapse; font-size:9;" width="100%" align="center" border="0" cellspacing="0" cellpadding="2">
			  					<tr>
								<td width="5%" align='right'><b>A. </b></td>
                                <td width="15%" align='left'><b>TUNAI</b></td>
								<td width="1%" align='left'><b></td>
								<td width="15%" align='left'><b></td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                                </tr>

                                <tr>
								<td width="5%" align='left'></td>
                                <td width="15" align='right'></td>
								<td width="1%" align='left'><b>1.</td>
								<td width="15%" align='left'><b>Saldo Lalu</td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka($spj_header3_tunai['terima']-$spj_header5_tunai['keluar']); ?></td>
								<td width="15%" align='left'></td>
                                </tr>
								
								<tr><td colspan='11'></td></tr>
								<tr><td colspan='11'></td></tr>
								<tr><td colspan='11'></td></tr>
								<tr><td colspan='11'></td></tr>
								
								<tr>
								<td width="5%" align='left'></td>
                                <td width="15%" align='right'></td>
								<td width="1%" align='left'><b>II.</td>
								<td width="15%" align='left'><b>Penerimaan</td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'></td>
								<td width="8%" align='left'></td>
								<td width="15%" align='left'></td>
                                </tr>

							<?php foreach($rincian_penerimaan_tunai as $rincian_penerimaan_tunai):  ?>
								    
								    <tr>
                                        <td width="10%" align='left'></td>
                                        <td width="5" align='right'></td>
        								<td width="1%" align='left'><b></td>
        								<td colspan="2" align='left'><?= $rincian_penerimaan_tunai['tanggal'].' '.$rincian_penerimaan_tunai['keterangan']; ?></td>
        								
        								
        								<td colspan='2' width="5%" align='right'><?= angka($rincian_penerimaan_tunai['nilai']); ?></td>
        								<td width="1%" align='left'></td>
        								<td width="10%" align='right'></td>
        								<td width="8%" align='right'></td>
        								<td width="15%" align='left'></td>
                                    </tr>
                                    
								<?php endforeach; ?>
								<tr>
							<td colspan='6'></td>
							<td colspan='2' align='left' align='left' ></td>
							<td align='left' colspan='2'>+</td>
							</td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Penerimaan</td>
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= angka($spj_header4_tunai['terima']); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="15%" align='right'></td>
								<td width="1%" align='left'><b>III.</td>
								<td width="15%" align='left'><b>Pengeluaran</td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'><b></td>
								<td width="8%" align='left'><b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr>
								<td colspan='6'></td>
								<td width="5%"  align='left'><?= angka($spj_header2_tunai['total']); ?></td>
								<td width="1%"  align='left'></td>
								<td width="10%" align='right'></td>
								<td colspan='2' align='left'></td>
								</td>
							</tr>
							<tr>
							<td colspan='6'></td>
							<td colspan='2' align='left' align='left' ></td>
							<td align='left' colspan='2'>+</td>
							</td></tr>
							
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Pengeluaran</td>
								
								
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= angka($spj_header2_tunai['total']); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>IV.</td>
								<td width="15%" colspan='3' align='left'><b>Total Penerimaan - Total Pengeluaran</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka($spj_header4_tunai['terima']-$spj_header2_tunai['total']); ?></b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>V.</td>
								<td width="15%" colspan='3' align='left'><b>Pengembalian kas</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'><b></td>
								<td width="8%" align='right'><b><?= angka($pengembalian_tunai['keluar']); ?></b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>VI.</td>
								<td width="15%" colspan='3' align='left'><b>Saldo Akhir</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka($spj_header4_tunai['terima']+$spj_header3_tunai['terima']-$spj_header5_tunai['keluar']-$spj_header2_tunai['total']-$pengembalian_tunai['keluar']); ?></td>
								<td width="15%" align='left'></td>
                            </tr>


							<!-- BANK -->

                            <tr>
                                <td width="5%" align='right'><b>B. </b></td>
                                <td width="15%" align='left'><b>BANK</b></td>
								<td width="1%" align='left'><b></td>
								<td width="15%" align='left'><b></td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>

                                <tr>
								<td width="5%" align='left'></td>
                                <td width="15%" align='right'></td>
								<td width="1%" align='left'><b>I.</td>
								<td width="15%" align='left'><b>Saldo Lalu</td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka($spj_header3_bank['terima']-$spj_header5_bank['keluar']); ?></td>
								<td width="15%" align='left'></td>
                                </tr>
								
								<tr><td colspan='11'></td></tr>
								<tr><td colspan='11'></td></tr>
								<tr><td colspan='11'></td></tr>
								<tr><td colspan='11'></td></tr>
								
								<tr>
								<td width="5%" align='left'></td>
                                <td width="15%" align='right'></td>
								<td width="1%" align='left'><b>II.</td>
								<td width="15%" align='left'><b>Penerimaan</td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'></td>
								<td width="8%" align='left'></td>
								<td width="15%" align='left'></td>
                                </tr>
                                
							<?php foreach($rincian_penerimaan_bank as $rincian_penerimaan_bank):  ?>
								    
								    <tr>
                                        <td width="10%" align='left'></td>
                                        <td width="5" align='right'></td>
        								<td width="1%" align='left'><b></td>
        								<td colspan="2" align='left'><?= $rincian_penerimaan_bank['tanggal'].' '.$rincian_penerimaan_bank['keterangan']; ?></td>
        								
        								
        								<td colspan='2' width="5%" align='right'><?= angka($rincian_penerimaan_bank['nilai']); ?></td>
        								<td width="1%" align='left'></td>
        								<td width="10%" align='right'></td>
        								<td width="8%" align='right'></td>
        								<td width="15%" align='left'></td>
                                    </tr>
                                    
								<?php endforeach; ?>
								<tr>
							<td colspan='6'></td>
							<td colspan='2' align='left' align='left' ></td>
							<td align='left' colspan='2'>+</td>
							</td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Penerimaan</td>
								
								
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= angka($spj_header4_bank['terima']); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="15%" align='right'></td>
								<td width="1%" align='left'><b>III.</td>
								<td width="15%" align='left'><b>Pengeluaran</td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='left'><b></td>
								<td width="8%" align='left'><b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr>
								<td colspan='6'></td>
								<td width="5%"  align='left'><?= angka($spj_header2_bank['total']); ?></td>
								<td width="1%"  align='left'></td>
								<td width="10%" align='right'></td>
								<td colspan='2' align='left'></td>
								</td>
							</tr>
							<tr>
							<td colspan='6'></td>
							<td colspan='2' align='left' align='left' ></td>
							<td align='left' colspan='2'>+</td>
							</td></tr>
							
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Pengeluaran</td>
								
								
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= angka($spj_header2_bank['total']); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
							
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>IV.</td>
								<td width="15%" colspan='3' align='left'><b>Total Penerimaan - Total Pengeluaran</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka($spj_header4_bank['terima']-$spj_header2_bank['total']); ?></b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>V.</td>
								<td width="15%" colspan='3' align='left'><b>Pengembalian kas</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'><b></td>
								<td width="8%" align='right'><b><?= angka($pengembalian_bank['keluar']); ?></b></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr><td colspan='11'></td></tr>
							<tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>VI.</td>
								<td width="15%" colspan='3' align='left'><b>Saldo Akhir</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka($spj_header4_bank['terima']+$spj_header3_bank['terima']-$spj_header5_bank['keluar']-$spj_header2_bank['total']-$pengembalian_bank['keluar']); ?></td>
								<td width="15%" align='left'></td>
                            </tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b>VII.</td>
								<td width="15%" colspan='3' align='left'><b>Saldo Akhir Bank Lainnya</td>
								
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b></td>
								<td width="15%" align='left'></td>
                            </tr>
                            <?php 
                                $saldo_akhir=0;
                                foreach($bank_lainnya as $bank_lainnya):  
                            ?>
								    <?php 
                                        
                                        $saldo_akhir=$saldo_akhir+$bank_lainnya['nilai'];
                                    ?>
								    <tr>
                                        <td width="10%" align='left'></td>
                                        <td width="5" align='right'></td>
        								<td width="1%" align='left'><b></td>
        								<td colspan="2" align='left'><?= $bank_lainnya['nm_acc']; ?></td>
        								
        								
        								<td colspan='2' width="5%" align='right'><?= angka($bank_lainnya['nilai']); ?></td>
        								<td width="1%" align='left'></td>
        								<td width="10%" align='right'></td>
        								<td width="8%" align='right'></td>
        								<td width="15%" align='left'></td>
                                    </tr>
                                    
								<?php endforeach; ?>
                                <tr>
                                <td width="5%" align='left'></td>
                                <td width="10%" align='right'></td>
								<td width="1%" align='left'><b></td>
								<td colspan="2" align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Total Saldo Bank Lainnya</td>
								
								
								<td colspan='2' width="5%" align='right' style="border-top:solid 1px black;"><b><?= angka($saldo_akhir); ?></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'></td>
								<td width="15%" align='left'></td>
                            </tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr>
                                <td width="5%" align='right'><b>C. </b></td>
                                <td width="15%" colspan="3" align='left'><b>TOTAL SALDO AKHIR (A+B+C)</b></td>
								<td width="1%" align='left'></td>
								<td width="15%" align='left'><b></td>
								
								<td width="5%" align='left'></td>
								<td width="1%" align='left'></td>
								<td width="10%" align='right'></td>
								<td width="8%" align='right'><b><?= angka(($spj_header4_tunai['terima']+$spj_header3_tunai['terima']-$spj_header5_tunai['keluar']-$spj_header2_tunai['total']-$pengembalian_tunai['keluar'])+($spj_header4_bank['terima']+$spj_header3_bank['terima']-$spj_header5_bank['keluar']-$spj_header2_bank['total']-$pengembalian_bank['keluar'])+$saldo_akhir); ?></td>
								<td width="15%" align='left'></td>
                            </tr>
							<tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
                            <tr><td colspan='11'></td></tr>
							
				  
				  </table>



                  <table style="border-collapse:collapse; font-size:9;" width="100%" align="center" border="1" cellspacing="0" cellpadding="2">
                     
					 
					 <thead>
                        <tr>
							
							<td bgcolor="#CCCCCC" width="8%" align="center" ><b>Tanggal</b></td>
							<td bgcolor="#CCCCCC" width="15%" align="center" ><b>Sub Area</b></td>
							<td bgcolor="#CCCCCC" width="25%" align="center" ><b>Akun</b></td>
                            <td bgcolor="#CCCCCC" width="35%" align="center" ><b>Keterangan</b></td>
                            <td bgcolor="#CCCCCC" width="2%" align="center" ><b>Bukti/Nota</b></td>
                            <td bgcolor="#CCCCCC" width="2%" align="center" ><b>Sumber Kas</b></td>
                            <td bgcolor="#CCCCCC" width="15%" align="center" ><b>Nilai</td>
							
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

						if($rincian_spj['jns_spj']=='1'){
                            $subarea=$rincian_spj['nm_sub_area'];
                        }else{
                            $subarea=$rincian_spj['nm_area'];
                        }


                        if($rincian_spj['bukti']=='' || $rincian_spj['bukti']==null){
                            $bukti="-";
                        }else{
                            $bukti="Ada";
                        }
                     
                     ?>

                        <tr>
                                
                                <td  align="center"><?= $rincian_spj['tgl_bukti']; ?></td>
								<td  align="left"><?= $subarea; ?></td>
                                <td  align="left"><?= $rincian_spj['nm_acc']; ?></td>
                                <td  align="left"><?= $jns_ta.''.$rincian_spj['uraian']; ?></td>
                                <td  align="center"><?= $bukti; ?></td>
                                <td  align="center"><?= $rincian_spj['jenis']; ?></td>
                                <td  align="right"><?= angka($rincian_spj['nilai']); ?></td>
                                
                        </tr>

                        <?php $total_spj = $total_spj+$rincian_spj['nilai']; ?>


                        <?php endforeach; ?>
<!-- end rincian -->
                            

                                <tr>
									 <td colspan='6' align="center"><b>TOTAL</td>
									 <td  align="right"><b><?= angka($total_spj); ?></td>
								</tr>
                  </table>

                  <table width="100%" border="0" style="border-spacing: -1px;border-collapse: collapse;" cellspacing="2" cellpadding="3">
  <tr>
    <td width="100%" align="center" style="font-size:12px" colspan="3"></td>
  </tr>
  <tr>
    <td width="50%" align="center" style="font-size:12px"> Diketahui oleh
    </td>
    <td width="50%" align="center" style="font-size:12px"> Diajukan oleh
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td align="center" style="font-size:12px" colspan="2">
    </td>
  </tr>
  <tr>
    <td width="50%" align="center" style="font-size:12px">(<?= ucwords(strtolower(str_replace('%20',' ',$ttd))); ?>)
    </td>
    <td width="50%" align="center" style="font-size:12px"> (<?= ucwords(strtolower($spj_header['nama'])); ?>)
    </td>
  </tr>
</table>