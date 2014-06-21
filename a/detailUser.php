<?php
    include("header.php");
    $data = sk_select('tbl_user',"*","WHERE id_user='".GetData('userid')."'");
    $sumber = Sk_Mysql("SELECT COUNT(*) as jumlah FROM tbl_sumberemisi a, tbl_user b
					      	 WHERE a.id_user = b.id_user AND b.id_user='".GetData('userid')."'");
	 $jumlahSumber = mysql_fetch_array($sumber);
?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Detail Data Perusahaan</a></li>
	</ul>
    <div id="tabs-1">
    <div id="judulform">Detail data peusahaan yang dipantau</div>
    
    <?php 
    if($jumlahSumber['jumlah']==0)
    	alert("(".$data[0]['namaPerusahaan'].") Data Sumber Emisi belum diinputkan","error");
    else
    	print("");
    ?>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
        <table class="detail">
				<tr>
					<td>username</td>			
					<td>:</td>		
					<td><?php echo $data[0]['username']; ?></td>
				</tr>
				<tr>
					<td id="td">Nama</td>
					<td>:</td>
					<td><?php echo $data[0]['namaPerusahaan']; ?></td>
				</tr>
				<tr>
					<td id="td">Alamat</td>
					<td>:</td>
					<td><?php echo $data[0]['alamat']; ?></td>
				</tr>
				<tr>
					<td id="td">Telp/Fax</td>
					<td>:</td>
					<td><?php echo $data[0]['telpFax']; ?></td>
				</tr>
				<tr>
					<td id="td">Tahun Berdiri</td>
					<td>:</td>
					<td><?php echo $data[0]['tahunBerdiri']; ?></td>
				</tr>
				<tr>
					<td id="td">Luas Area</td>
					<td>:</td>
					<td><?php echo $data[0]['LuasArea']; ?></td>
				</tr>
				<tr>
					<td id="td">Nama Kontak</td>
					<td>:</td>
					<td><?php echo $data[0]['contactPerson']; ?></td>
				</tr>
				<tr>
					<td id="td">Email</td>
					<td>:</td>
					<td><?php echo $data[0]['email']; ?></td>
				</tr>
				<tr>
					<td id="td">Jumlah Sumber Emisi yang dipantau</td>
					<td>:</td>
					<td><?php echo $jumlahSumber['jumlah']; ?></td>
				</tr>
				<tr>
				<tr>
					<td colspan="3" align="center">
					<?php if($jumlahSumber['jumlah'] == 0){ ?>
						<input type="button" value="Tambah Sumber Emisi" id="tambah">
					<?php }else{ ?>
						<input type="button" value="Kembali" id="kembali">
					<?php } ?>
					</td>
				</tr>
		  </table>
    </div>
</div>
<br />
<script src="<?php echo PATHURL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
      $(function() { 
      $("#tambah").click(function (){
	       location.href='<?php echo PATHURL; ?>a/tambahSumber.php';
      });
      $("#kembali").click(function (){
	       location.href='<?php echo PATHURL; ?>a/DaftarUser.php';
      });
      $( "#main_content" ).tabs({
          selected: 0,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/DaftarUser.php";
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
unset($_SESSION['UserSelect']); 
require_once ('footer.php'); 
?>