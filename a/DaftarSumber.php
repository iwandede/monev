<?php  
include("../app/sk_config.php");
include("../app/sk_database.php");
include("script.php");
$datas = sk_Mysql("SELECT * FROM tbl_sumberemisi WHERE id_user='".GetData('q')."'");
$cekData = mysql_num_rows($datas);
if($cekData == 0) {
    $perusahaan = sk_select("tbl_user","id_user,namaPerusahaan","WHERE id_user = '".GetData('q')."'");
    $_SESSION['userid'] =  array("id" =>$perusahaan[0]['id_user'],
                                  "nama" =>$perusahaan[0]['namaPerusahaan']);
	alert("Data Sumber Emisi Belum diinputkan","error");
	echo "<center><a href='".PATHURL."a/tambahSumber.php' class='tombol'>Tambah Sumber Emisi</a></center>";
}else{
?>
<table class="tabel" border="0" cellspacing="0" cellpading="0" id="list_user" width="100%">
	<thead>
	<tr>
	<th>No</th>
        <th>Kode</th>
        <th>Nama</th>
        <th>BBM</th>
        <th>Lokasi</th>
        <th>
        	Waktu Operasi
        	<em>Jam/Tahun</em>
        </th>
        <th>Bentuk</th>
        <th>Status</th>
        <th>Aksi</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<?php $i = 1; while ($data= mysql_fetch_array($datas)) {?>
		<td><?php echo $i; ?></td>
		<td><?php echo $data['kodeCerobong']; ?></td>
		<td><?php echo $data['nama']; ?></td>
		<td><?php echo $data['bbm']; ?></td>
		<td><?php echo $data['lokasi']; ?></td>
		<td><?php echo $data['waktuOperasi']; ?></td>
		<td><?php echo $data['bentuk']; ?></td>
		<td><?php echo $data['dataPemantauan']; ?></td>
		<td>
			<a href="<?php echo PATHURL."a/detailSumber.php?sumberid=".$data['id']; ?>" title="Detail Data <?php echo $data['nama']; ?>"><img src="<?php echo PATHURL."images/view.png" ?>" width="20" height="20" /></a>
			<a href="<?php echo PATHURL."a/UpdateSumber.php?sumberid=".$data['id']; ?>" title="Edit Data"><img src="<?php echo PATHURL."images/edit.png" ?>" width="20" height="20" /></a>
			<a href="javascript:ConfirmDelete(<?php echo $data['id']; ?>,'<?php echo $data['nama']; ?>')" title="Hapus Data" class="show-dialog"><img src="<?php echo PATHURL."images/delete.png" ?>" width="15" height="20" /></a>
		</td>
	</tr>
	<?php $i++; }?>
	</tbody>
</table>
<?php } ?>
<script type="text/javascript" src="<?php echo PATHURL."js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript">
        function ConfirmDelete(id,data){
                var retVal = confirm("Yakin data "+data+" Akan dihapus?");
               if( retVal == true ){
                  window.location="<?php echo PATHURL."a/sumberEmisi.php?act=del&sumberid=";?>"+id;
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
