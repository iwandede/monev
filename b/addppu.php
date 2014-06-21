<?php 
require_once("header.php"); 
if($_POST){
$jumlahparam = count($_POST["param"]);
$jmlh 		 = count($_POST["parameter"]);

$id_user 			= PostData('perusahaan');
$id 				= PostData('sumberEmisi');
$idSemester 		= PostData('smt');
$peraturan			= PostData('peraturanBM');	

for ($i=0; $i < $jmlh; $i++) {
	$nilai=$_POST['parameter'][$i];
	$parameter=$_POST['param'][$i];
	$addUser = sk_Mysql("INSERT INTO tbl_monppu values('','{$id}','{$parameter}','{$nilai}','{$idSemester}','{$id_user}','{$peraturan}')");
}

if(!$addUser){
		SetMessage("Gagal Menambah User!!!");
		redirect(PATHURL."b/addppu");
	}else{
		SetMessage("Berhasil Menambah data User");
		redirect(PATHURL."b/addppu");
	}

}

$_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : "";				
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
<form action="<?php echo PATHURL."b/addppu?act=post"; ?>" method="POST" name="updateProfil" id="alumniForm">
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
				$sumber = sk_select('tbl_sumberemisi','id,nama');
				?>
				<select name="sumberEmisi" id="sumber" onchange="showSumber(this.value)">
					<option disabled="true" selected="selected">-Pilih Seumber Emisi-</option>
					<?php 
					foreach ($sumber as $se) {
						echo "<option value='".$se['id']."'>{$se['nama']}</option>";
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
				<div id="parameter">test</div>
			</td>
		</tr>
		<tr>
			<td id="td">Semester</td>
			<td>:</td>
			<td>
				<input type="text" id="tanggal"/>
			</td>
		</tr>
		<tr>
			<td id="td">Peraturan Baku Mutu</td>
			<td>:</td>
			<td><textarea name="peraturanBM"></textarea></td>
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
			dateFormat: 'dd-mm-yy' 
			});
      $( "#main_content" ).tabs({
          selected: 1,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/Daftarppu.php";
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
