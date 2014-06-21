<?php  
include("../app/sk_config.php");
include("../app/sk_database.php");
$datas = sk_Mysql("SELECT id,nama FROM tbl_sumberemisi WHERE id_user='".PostData('q')."'");
$cekData = mysql_num_rows($datas);
echo '<option value="" selected="selected" >-Pilih Dahulu Sumber Emisi </option>';
while ($data= mysql_fetch_array($datas)) {?>
		<option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
<?php } ?>

