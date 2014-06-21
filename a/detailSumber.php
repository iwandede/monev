<?php
    include("header.php");
    $datas = sk_Mysql("SELECT id_user as id, namaPerusahaan as nama FROM tbl_user WHERE role='1'");
    $dataEmisi = sk_select("tbl_sumberemisi a, tbl_user b","*"," WHERE a.id_user=b.id_user AND a.id='".GetData('sumberid')."'");
    if($_POST){
			$dataSumber = array("kodeCerobong" =>PostData('kode'),
                               "nama"        =>PostData('nama'),
                               "kapasitas"   =>PostData('kapasitas'),
                               "bbm"         =>PostData('bbm'),
                               "waktuOperasi" =>PostData('waktu'),
                               "lokasi"      =>PostData('lokasi'),
                               "long"        =>PostData('long'),
                               "lat"         =>PostData('lat'),
                               "bentuk"      =>PostData('bentuk'),
                               "tinggi"      =>PostData('tinggi'),
                               "diameter"    =>PostData('diameter'),
                               "posisi"      =>PostData('posisi'),
                               "dataPemantauan" =>PostData('datapemantauan'),
                               "id_user"    =>PostData('sumberEmisi'),
                               "ket" =>PostData('ket'));
            $idSumber=PostData('Emisi');
			$updateSumber = sk_Update("tbl_sumberemisi",$dataSumber,"id='".GetData('sumberid')."'");
						
	if(!$updateSumber){
		SetMessage("Gagal Mengubah Data Sumber Emisi!!!");
		redirect(PATHURL."a/UpdateSumber.php?sumberid=".$idSumber);
	}else{
		SetMessage("Berhasil Mengubah Data Sumber Emisi");
		redirect(PATHURL."a/UpdateSumber.php?sumberid=".$idSumber);
	}
}
?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Detail Sumber Emisi</a></li>
	</ul>
    <div id="tabs-1">
    <div id="judulform">Detail data Sumber Emisi</div>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
    <form name="tambahUser" method="POST" action="?" id="perusahaan" novalidate="novalidate">
        <table>
                <tr>
				    <td>Perusahaan</td>
				    <td>:</td>
				    <td>
				        <?php echo $dataEmisi[0]['namaPerusahaan']; ?>		
				    </td>        
                </tr>
				<tr>
					<td>Kode Cerobong</td>			
					<td>:</td>		
					<td><?php echo $dataEmisi[0]['kodeCerobong']?></td>
				</tr>
				<tr>
					<td>Nama Cerobong</td>			
					<td>:</td>		
					<td><?php echo $dataEmisi[0]['nama']?></td>
				</tr>
				<tr>
					<td id="td">Kapasitas</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['kapasitas']?></td>
				</tr>
				<tr>
					<td id="td">Bahan Bakar</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['bbm']?></td>
				</tr>
				<tr>
					<td id="td">Waktu Operasi (Jam/Tahun)</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['waktuOperasi']?></td>
				</tr>
				<tr>
					<td id="td">Lokasi</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['lokasi']?></td>
				</tr>
				<tr>
					<td id="td">long</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['long']; ?></td>
				</tr>
				<tr>
					<td id="td">lat</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['lat']?></td>
				</tr>
				<tr>
					<td id="td">Bentuk Cerobong</td>
					<td>:</td>
					<td>
							<?php echo $dataEmisi[0]['bentuk']; ?>
					</td>
				</tr>
				<tr>
					<td id="td">Tinggi Cerobong</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['tinggi']; ?>(mm)</td>
				</tr>
				<tr>
					<td id="td">Diameter Cerobong</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['diameter']?>(mm)</td>
				</tr>
				<tr>
					<td id="td">Posisi Cerobong</td>
					<td>:</td>
					<td><?php echo $dataEmisi[0]['posisi']?>(mm)</td>
				</tr>
				<tr>
					<td id="td">Data Pemantauan</td>
					<td>:</td>
					<td>
                        <?php echo $dataEmisi[0]['dataPemantauan']?>
					</td>
				</tr>
				<tr>
					<td id="td">Keterangan</td>
					<td>:</td>
					<td>
							<?php echo $dataEmisi[0]['ket']?>		
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center"><input type="button" name="simpan" value="Kembali" id="kembali"></td>
				</tr>
		  </table>
		  </form>
    </div>
</div>
<br />
<script src="<?php echo PATHURL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
      $(function() { 
      $("#kembali").click(function () {
	       location.href = "<?php echo PATHURL; ?>a/sumberEmisi.php";
      });
      $( "#main_content" ).tabs({
          selected: 1,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/sumberEmisi.php";
                if(url) {
                    location.href = url;
                    return false;
                }
                return true;
            }
      });
    });
</script>
<?php
unset($_SESSION['message']);  
require_once ('footer.php'); 
?>