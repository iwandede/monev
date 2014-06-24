<?php  
include("../app/sk_config.php");
include("../app/sk_database.php");
include("script.php");
$datas = sk_Mysql("SELECT * FROM tbl_parameter WHERE id='".GetData('q')."'");

$cekData = mysql_num_rows($datas);
if($cekData == 0) {
	alert("Data Parameter Belum diinputkan","error");
	$sumberEmisi = sk_select("tbl_sumberemisi","id,nama","WHERE id='".GetData('q')."'");
	$_SESSION['sumber']=array("idSumber"=>$sumberEmisi[0]['id'],"nama"=>$sumberEmisi[0]['nama']);
	echo "<center><a href='".PATHURL."a/tambahParameter.php' class='tombol'>Tambah Parameter</a></center>";
}else{
?>
<table class="tabel" border="0" cellspacing="0" cellpading="0" id="list_user" width="50%">
	<thead>
	<tr>
	    <th>No</th>
        <th>Parameter</th>
        <th>Satuan</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<?php  
	$i =1;
	while($parsing =mysql_fetch_array($datas)) {
	?>
		<td><?php echo $i; ?></td>
		<td><?php echo $parsing['nama']; ?></td>
		<td>mg/Nm<sup>3</sup></td>
	</tr>
	<?php $i++;}?>
	<tr>
        <td colspan="3" align="center">
            <a href="<?php echo PATHURL."a/UpdateParameter.php?parameterid=".GetData('q'); ?>" style="color:blue;">Ubah Data Pemantauan</a>
        </td>	
	</tr>
	</tbody>
</table>
<?php } ?>
<script type="text/javascript" src="<?php echo PATHURL."js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript">
        function ConfirmDelete(id,data){
                var retVal = confirm("Yakin data "+data+" Akan dihapus?");
               if( retVal == true ){
                  window.location="<?php echo PATHURL."a/parameter.php?act=del&parameterid=";?>"+id;
                      return true;
               }else{
                      return false;
               }
        }
      $(document).ready(function(){ 
      $("#list_user").dataTable({
            "sPaginationType": "full_numbers",
            "bSort": true,
            "oLanguage": {
                "sSearch": "Cari:",
                "sLengthMenu": "Menampilkan _MENU_ data per halaman",
                "sZeroRecords": "Maaf, data tidak ditemukan",
                "sInfo": "Menampilkan data _START_ sampai _END_, dari _TOTAL_ data",
                "sInfoEmpty": "Menampilkan data 0 sampai 0, dari 0 data",
                "sInfoFiltered": "(disaring dari _MAX_ total data)",
                "oPaginate" : {
                    "sFirst": "Pertama",
                    "sLast": "Terakhir",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Berikutnya"
                }
            }
        });
    });
</script>
