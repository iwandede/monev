<?php
include("header.php");
$datas = sk_select('tbl_user',"id_user,namaPerusahaan,alamat,email,status,role","WHERE role=1");

?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Daftar Perusahaan</a></li>
	</ul>
<div id="tabs-1">
<div id="judulform">
Daftar Perusahaan yang dipantau
	</div>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
        <table class="tabel" border="0" cellspacing="0" cellpading="0" id="list_user" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php 
                    $i = 1; 
                    foreach ($datas as $data) {
					      $sumber = Sk_Mysql("SELECT COUNT(*) as jumlah FROM tbl_sumberemisi a, tbl_user b
					      							WHERE a.id_user = b.id_user AND b.id_user='{$data['id_user']}'");
					      $jumlahSumber = mysql_fetch_array($sumber);              	
                    ?>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['namaPerusahaan']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td>
                             <a href="<?php echo PATHURL."c/addEvaluasi.php?userid=".$data['id_user']; ?>" title="Detail Data <?php echo $data['namaPerusahaan']; ?>"><img src="<?php echo PATHURL."images/view.png" ?>" width="20" height="20" /></a>
                        </td>
                </tr>
                <?php $i++; }?>
            </tbody>
        </table>
        </div>
</div>
<br />
<script type="text/javascript" src="<?php echo PATHURL."js/jquery.dataTables.min.js"; ?>"></script>
<script type="text/javascript">
        function ConfirmDelete(id,data){
                var retVal = confirm("Yakin data "+data+" Akan dihapus?");
               if( retVal == true ){
                  window.location="<?php echo PATHURL."a/DaftarUser.php?act=del&userid=";?>"+id;
                      return true;
               }else{
                      return false;
               }
        }
      $(document).ready(function(){ 
      $( "#main_content" ).tabs({
          selected: 0,
            select: function(event, ui) {
                var url = "#";
                if(url) {
                    location.href = url;
                    return false;
                }
                return true;
            }
      });
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
<?php
unset($_SESSION['message']);  
require_once ('footer.php'); 
?>