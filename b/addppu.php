<?php 
require_once("header.php"); 
if($_POST){
$jumlahparam = count($_POST["param"]);
$jmlh 		 = count($_POST["parameter"]);
$id_user 	 = PostData('perusahaan');
$id 		 = PostData('sumberEmisi');
$idSemester  = PostData('smt');
$tahun = date("Y");
$bulan = explode("-",$idSemester);
if($bulan[1] <=6){
	$smt = 1;
}else{
	$smt = 2;
}

for ($i=0; $i < $jmlh; $i++) {
	$nilai=$_POST['parameter'][$i];
	$parameter=$_POST['param'][$i];
	$addUser = sk_Mysql("INSERT INTO tbl_monppu values('','{$id}','{$parameter}','{$id_user}','{$idSemester}','{$nilai}','{$smt}')");
}

if(!$addUser){
		SetMessage("Gagal Menambah User!!!");
		redirect(PATHURL."b/addppu.php");
	}else{
		SetMessage("Berhasil Menambah data User");
		redirect(PATHURL."b/addppu.php");
	}
}
				
?>
<div id="main_content">
	<ul>
		<li><a href="#">Daftar PPU</a></li>
		<li><a href="#tabs-1">Tambah Data PPU</a></li>
	</ul>
<div id="tabs-1">
<div id="judulform">
Daftar Perusahaan yang dipantau
	</div>
	<?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
<form action="?" method="POST" name="updateProfil" id="alumniForm">
	<table>
		<tr>
			<td id="td">Perusahaan</td>
			<td>:</td>
			<td>
			<?php
				$perusahaan = sk_select('tbl_user','id_user,namaPerusahaan',"WHERE id_user='".$_SESSION['UserSession']['id']."'");
			?>
				<label><strong><?php echo $perusahaan[0]['namaPerusahaan']; ?></strong></label>
				<input type="hidden" name="perusahaan" value="<?php echo $perusahaan[0]['id_user']; ?>" />
			</td>
		</tr>
		<tr>
			<td id="td">Sumber Emisi</td>
			<td>:</td>
			<td>
				<?php
				$sumber = sk_select('tbl_sumberemisi','id,kodeCerobong,nama',"WHERE id_user='".$_SESSION['UserSession']['id']."'");
				?>
				<select name="sumberEmisi" id="sumber" onchange="showSumber(this.value)">
					<option disabled="true" selected="selected">-Pilih Seumber Emisi-</option>
					<?php 
					foreach ($sumber as $se) {
						echo "<option value='".$se['id']."'>{$se['nama']}&nbsp;{$se['kodeCerobong']}</option>";
					}
					?>
				</select>				
			</td>
		</tr>
		<tr>
			<td id="td">
				Parameter yang diuji
			</td>
			<td>:</td>
			<td>
				<div id="parameter">Pilih terlebih dahulu Sumber Emisi</div>
			</td>
		</tr>
		<tr>
			<td id="td">Tanggal</td>
			<td>:</td>
			<td>
				<input type="text" name="smt" id="tanggal"/>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right" id="td"><input type="submit" name="ubah" value="Simpan" /></td>
		</tr>
	</table>
</form>
</div>
</div>


<script type="text/javascript">
function showSumber(str) {
		if (str=="") {
			document.getElementById("parameter").innerHTML="";
			return;
		} 
		if (window.XMLHttpRequest) {
			xmlhttp=new XMLHttpRequest();
		} else { 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
				document.getElementById("parameter").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","parameter.php?q="+str,true);
		xmlhttp.send();
}  	
$(document).ready(function() { 
		$("#tanggal").datepicker({ 
			dateFormat: 'yy-m-dd' 
			});
      $( "#main_content" ).tabs({
          selected: 1,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>b/ppu.php";
                if(url) {
                    location.href = url;
                    return false;
                }
                return true;
            }
      });
		$("#alumniForm").validate({
			messages: {
				email: {
					required: "E-mail harus diisi",
					email: "Masukkan E-mail yang valid"
				}
			},
			errorPlacement: function(error, element) {
				error.appendTo(element.parent("td"));
			}
		});
});
</script>
<?php 
unset($_SESSION['message']);
require_once ('footer.php'); ?> 
