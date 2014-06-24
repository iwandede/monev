<?php
require_once ('header.php'); 
$dataPerusahaan = sk_select("tbl_user","id_user,namaPerusahaan","WHERE id_user='".GetData('userid')."'");
$jumlahParam = sk_select("tbl_parameter","COUNT(*) as jumlah","WHERE id_user='".GetData('userid')."'");
$monitoring = sk_Mysql("SELECT c.nama as namaSumber,c.waktuOperasi as waktu, c.diameter as diameter,a.semester as semester
						,a.idParameter as idParam,a.id as idSumber, YEAR(a.tglppu) as tahun
						FROM tbl_monppu a
						JOIN tbl_user b ON a.id_user=b.id_user
						JOIN tbl_sumberemisi c ON a.id=c.id
						JOIN tbl_parameter d ON a.idParameter = d.idParameter
						WHERE a.id_user ='".GetData('userid')."' 
					 ");
if($_POST){
		$jum = count($_POST["beban"]);
		$jumlah = ($jum/2);
		for ($i=0;$i < $jumlah; $i++){
			$waktu = $_POST['waktu'][$i];
			$diameter = $_POST['diameter'][$i];
			$jari = $_POST['jari'][$i];
			$luas = $_POST['luas'][$i];
			$rumus = $_POST['rumus'][$i];
			$konstanta = $_POST['konstanta'][$i];
			$konversi = $_POST['konversi'][$i];
			$beban = $_POST['beban'][$i];
			$sumber = $_POST['idSumber'];
			$user = $_POST['idUser'];
			$param = $_POST['idParam'][$i];
			$tahun = $_POST['tahun'];
			$add = sk_Mysql("INSERT INTO tbl_evaluasi VALUES('','{$user}','{$sumber}','{$param}','{$jari}','{$luas}','{$rumus}','{$konstanta}','{$konversi}','{$beban}','{$tahun}')");
		}
		if(!$add){
			SetMessage("Gagal Menambah User!!!");
			echo "<script>window.history.go(-1)</script>";
			//redirect(PATHURL."c/addEvaluasi.php?userid=".print($_POST['idUser']));
		}else{
			SetMessage("Berhasil Menambah data User");
			echo "<script>window.history.go(-1)</script>";
			sk_Mysql("UPDATE tbl_monppu SET status=1 WHERE YEAR(tglppu)='".$_POST['tahun']."' AND id_user='".$_POST['idUser']."'");
			//redirect(PATHURL."c/addevaluasi.php?userid=".print($_POST['idUser']));
		}
}
?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Evaluasi</a></li>
	</ul>
    <div id="tabs-1">
<div id="judulform">
Form Evaluasi <?php echo $dataPerusahaan[0]['namaPerusahaan']; ?>
</div>
<form action="?" method="post" >
<?php 
$i=0;
$smt1 = sk_select("tbl_monppu","idPPU,semester,nilaiParameter","WHERE id_user='".GetData('userid')."' AND semester=1");
$smt2 = sk_select("tbl_monppu","idPPU,semester,nilaiParameter","WHERE id_user='".GetData('userid')."' AND semester=2");

//ulang nilai semester 1
$sem1 ="";
$sem2 ="";
foreach ($smt1 as $semester1){
	$sem1 .= $semester1['nilaiParameter'].",";
}

foreach ($smt2 as $semester2){
	$sem2 .= $semester2['nilaiParameter'].",";
}
$nilai1 = explode(",", $sem1,-1);
$nilai2 = explode(",", $sem2,-1);

//ulang nilai
while ($data = mysql_fetch_array($monitoring)){ 
	//$smt1 = sk_select("tbl_monppu","idPPU,semester,nilaiParameter","WHERE id_user='".GetData('userid')."' AND semester=1");
	echo "<input type='hidden' name='waktu[]' value='".$data['waktu']."' />";
	echo "<input type='hidden' name='diameter[]' value='".$data['diameter']."' />";
	echo "<input type='hidden' name='idParam[]' value='".$data['idParam']."' />";
	echo "<input type='hidden' name='idSumber' value='".$data['idSumber']."' />";
	echo "<input type='hidden' name='idUser' value='".$dataPerusahaan[0]['id_user']."' />";
	$jari = (int)($data['diameter']/2);
	echo "<input type='hidden' name='jari[]' value='".$jari."' />";
	$luas = (double) 3.14*$jari*$jari;
	echo "<input type='hidden' name='luas[]' value='".$luas."' />";
	$rumus = ((@$nilai1[$i] + @$nilai2[$i])/2)*8*$data['waktu']*$luas;
	echo "<input type='hidden' name='rumus[]' value='".$rumus."' />";
	$konstanta = (double)0.0036;
	echo "<input type='hidden' name='konstanta[]' value='".$konstanta."' />";
	$konversi = (double)0.000001;
	echo "<input type='hidden' name='konversi[]' value='".$konversi."' />";
	$beban = $rumus*$konstanta*$konversi;
	echo "<input type='hidden' name='beban[]' value='".number_format($beban,4)."' />";
	echo "<input type='hidden' name='tahun' value='".$data['tahun']."' />";
	$i++;
} 
if ($jumlahParam[0]['jumlah']==0) {
	echo "<code>Data Pemantauan Belum Tersedia</code>";
}else{
	echo "<code>Klik Tombol Evaluasi Untuk Mengevaluasi Hasil Pemantauan Pencemaran Udara</code>";
}
?>
	<table>
		<tr>
			<td><strong>Perusahaan</strong></td>
			<td>:</td>
			<td>
				<?php echo $dataPerusahaan[0]['namaPerusahaan']; ?>
			</td>
		</tr>
		<tr>
			<td><strong>Jumlah Parameter yang dievaluasi</strong></td>
			<td>:</td>
			<td>
			<?php 
 				echo $jumlahParam[0]['jumlah']; 
 			?>
			</td>
		</tr>
		<tr>
			<td><strong>Tahun</strong></td>
			<td>:</td>
			<td>
			<select name="tahun">
			<option disabled="disabled" selected="selected">-Pilih Tahun-</option>
			<?php 
			$mon = sk_select("tbl_monppu","DISTINCT YEAR(tglppu) as tahun","WHERE status=0"); 
			foreach ($mon as $mons){
				echo "<option value='{$mons['tahun']}'>".$mons['tahun']."</option>";
			}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">
			<?php 
			if ($jumlahParam[0]['jumlah']==0) {
				echo '<input type="submit" value="Evaluasi" disabled="disabled" />';
			}else{
				echo '<input type="submit" value="Evaluasi" >';
			}
			?>
			</td>
		</tr>
	</table>
</form>
</div>
</div>
<br />
<script type="text/javascript" src="<?php echo PATHURL."js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript">
      $(document).ready(function() {  
         $( "#main_content" ).tabs({
          selected: 0,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>b/addppu.php";
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