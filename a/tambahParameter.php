<?php
    include("header.php");
    $datas = sk_Mysql("SELECT id_user as id, namaPerusahaan as nama FROM tbl_user WHERE role='1'");
    $params = sk_select("tbl_standarbm","*");
    
    $result = sk_Mysql("SELECT COUNT(*) as jumlah FROM tbl_standarbm");
    $jml = mysql_fetch_array($result);
    
    if($_POST){
        $jumlahparam = count($_POST["param"]);
        $parameter = array();
        $nourut = "";
        for ($i=0; $i < $jumlahparam; $i++) {
        		  $datanya=$_POST['param'][$i];
	           $addParameter = sk_Mysql("INSERT INTO tbl_parameter values('','{$datanya}','".PostData('parameter')."','".PostData('sumber')."')");
        }
	if(!$addParameter){
		SetMessage("Gagal Menambah Data Parameter!!!");
		redirect(PATHURL."a/tambahParameter.php");
	}else{
		SetMessage("Berhasil Menambah Data Parameter");
		redirect(PATHURL."a/tambahParameter.php");
	}
}
?>
<div id="main_content">
	<ul>
		<li><a href="#">Daftar Parameter</a></li>
		<li><a href="#tabs-1">Tambah Parameter</a></li>
	</ul>
    <div id="tabs-1">
    <div id="judulform">Tambah data Parameter</div>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
    <code>Ceklis Untuk Menambah Parameter yang dipantau</code>
    <form name="tambahUser" method="POST" action="?" id="perusahaan" novalidate="novalidate">
        <table>
                <tr>
				    <td>Perusahaan</td>
				    <td>:</td>
				    <td>
				        <strong><?php echo $_SESSION['userid']['nama']; ?></strong>
				        <input type="hidden" name="parameter" value="<?php echo $_SESSION['userid']['id']; ?>">			
				    </td>        
                </tr>
                <tr>
						<td>Sumber Emisi</td>
						<td>:</td>
						<td>
						<input type="hidden" name="sumber" value="<?php echo $_SESSION['sumber']['idSumber']; ?>">
						<strong><?php echo $_SESSION['sumber']['nama']; ?></strong>
						</td>                
                </tr>
				<tr>
				<?php foreach($params as $param){ ?>				    
				    <td><?php echo $param['nama']; ?></td>
				    <td>:</td>
                    <td>
                         <input type='checkbox' name='param[]' id="param" value='<?php echo $param['nama']; ?>'>&nbsp;(mg/Nm<sup>2</sup>)                                       
                    </td>				
				</tr>
				<?php } ?>
				<tr>
					<td colspan="3" align="center"><input type="submit" name="simpan" value="Submit" id="submit"></td>
				</tr>
		  </table>
		  </form>
    </div>
</div>
<br />
<script src="<?php echo PATHURL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript">
      $(function() { 
      $("#submit").click(function () {
	    if (!$("#param").is(":checked")) {
                alert("Ceklis Terlebih Dahulu Untuk Menambah Data Parameter");
                return false;
            }
        return true;
      });
      $( "#main_content" ).tabs({
          selected: 1,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/parameter.php";
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
require_once ('footer.php'); 
?>