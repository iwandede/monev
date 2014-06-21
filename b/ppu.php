<?php
require_once ('header.php'); 
$datas = sk_Mysql("SELECT a.idPPU as idppu,a.id,a.id_user,b.namaPerusahaan as namaPerusahaan,
						 c.nama as namaSumber,c.kodeCerobong as kodeCerobong,
						 e.nama as namaParameter,a.nilaiParameter as nilai,
						 YEAR(a.tglppu) as tahun,IF(MONTH(a.tglppu) <= 6,'SEMESTER I','SEMESTER II') as semester
					FROM tbl_monppu a
					JOIN tbl_user b ON a.id_user = b.id_user
					JOIN tbl_sumberemisi c ON a.id = c.id
					JOIN tbl_parameter e ON a.idParameter = e.idParameter
					WHERE a.id_user = '{$_SESSION['UserSession']['id']}'");	
?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Daftar PPU</a></li>
		<li><a href="#">Tambah PPU</a></li>
	</ul>
    <div id="tabs-1">
<div id="judulform">
Data Pemantauan <?php echo $_SESSION['UserSession']['username'] ?>
</div>
<table class="tabel" border="0" cellspacing="0" cellpading="0" width="100%" id="list_user">
	<thead>
	<tr>
        <th>No</th>
        <th>Sumber Emisi</th>
        <th>Kode Cerobong</th>
        <th>Parameter</th>
        <th>Nilai Parameter</th>
        <th>Tahun</th>
        <th>Semester</th>
        <th>Aksi</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<?php $i = 1; while ($data =mysql_fetch_array($datas)) {?>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['namaSumber']; ?></td>
                <td><?php echo $data['kodeCerobong']; ?></td>
					 <td><?php echo $data['namaParameter']; ?></td>
					 <td><?php echo $data['nilai']; ?></td>
					 <td><?php echo $data['tahun']; ?></td>
					 <td><?php echo $data['semester']; ?></td>
		<td>
			<a href="<?php echo PATHURL."a/detailPPU?ppuid=".$data['idppu']; ?>" title="Detail Data PPU <?php echo $data['namaPerusahaan']; ?>"><img src="<?php echo PATHURL."images/view.png" ?>" width="20" height="20" /></a>
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