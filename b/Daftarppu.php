<?php
include("../app/sk_config.php");
include("../app/sk_database.php");
$datas = sk_Mysql("SELECT a.idPPU as idppu,a.id,a.id_user,b.namaPerusahaan as namaPerusahaan,c.nama as namaSumber,c.kodeCerobong as kodeCerobong,
					e.nama as namaParameter,a.nilaiParameter as nilai
					FROM tbl_monppu a
					JOIN tbl_user b ON a.id_user = b.id_user
					JOIN tbl_sumberemisi c ON a.id = c.id
					JOIN tbl_parameter e ON a.idParameter = e.idParameter
					WHERE a.id_user = '".$_SESSION['UserSession']['id']."'");	
?>
<table class="tabel" border="0" cellspacing="0" cellpading="0" width="100%" id="list_user">
	<thead>
	<tr>
        <th>No</th>
        <th>Perusahaan</th>
        <th>Sumber Emisi</th>
        <th>Kode Cerobong</th>
        <th>Parameter</th>
        <th>Nilai Parameter</th>
        <th>Aksi</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<?php $i = 1; while ($data =mysql_fetch_array($datas)) {?>
                <td><?php echo $i; ?></td>
                <td><?php echo $data['namaPerusahaan']; ?></td>
                <td><?php echo $data['namaSumber']; ?></td>
                <td><?php echo $data['kodeCerobong']; ?></td>
		<td><?php echo $data['namaParameter']; ?></td>
		<td><?php echo $data['nilai']; ?></td>
		<td>
			<a href="<?php echo PATHURL."a/detailPPU?ppuid=".$data['idppu']; ?>" title="Detail Data PPU <?php echo $data['namaPerusahaan']; ?>"><img src="<?php echo PATHURL."images/view.png" ?>" width="20" height="20" /></a>
		</td>
	</tr>
	<?php $i++; }?>
	</tbody>
</table>