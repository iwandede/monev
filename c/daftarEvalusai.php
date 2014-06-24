<?php
include("header.php");
$datas = sk_select('tbl_evaluasi',"*","WHERE id_user='".GetData('userid')."' AND id='".GetData('id')."'");

?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Daftar Perusahaan</a></li>
		<li><a href="#">Tambah Data Perusahaan</a></li>
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
                    <th>Level</th>
                    <th>Jumlah Sumber Emisi</th>
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
                        <td><?php $data['role'] = ($data['role'] != 2) ? print("Perusahaan") : print("Admin"); ?></td>
                        <td>
                        <?php 
                        if($jumlahSumber['jumlah']==0){
                        	echo "Sumber Emisi Belum diinputkan";
                        }else{
                        	echo $jumlahSumber['jumlah'];
                        }
                    		
                        ?>
                        </td>
                        <td>
                                <?php if($data['id_user']==1){ ?>
                                    <a href="<?php echo PATHURL."a/user?type=3&userid=".$data['id_user']; ?>" title="Detail Data <?php echo $data['namaPerusahaan']; ?>"><img src="<?php echo PATHURL."images/view.png" ?>" width="20" height="20" /></a>
                                <?php }else{ ?>
                                        <a href="<?php echo PATHURL."a/detailUser.php?userid=".$data['id_user']; ?>" title="Detail Data <?php echo $data['namaPerusahaan']; ?>"><img src="<?php echo PATHURL."images/view.png" ?>" width="20" height="20" /></a>
                                        <a href="<?php echo PATHURL."a/UpdateUser.php?userid=".$data['id_user']; ?>" title="Edit Data"><img src="<?php echo PATHURL."images/edit.png" ?>" width="20" height="20" /></a>
                                        <a href="javascript:ConfirmDelete(<?php echo $data['id_user']; ?>,'<?php echo $data['namaPerusahaan']; ?>')" title="Hapus Data" class="show-dialog"><img src="<?php echo PATHURL."images/delete.png" ?>" width="15" height="20" /></a>
                                <?php } ?>
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
                var url = "<?php echo PATHURL; ?>a/tambahUser.php";
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