<?php
    include("header.php");
    $datas = sk_Mysql("SELECT id_user as id, namaPerusahaan as nama FROM tbl_user WHERE role='1'");
    $bm = sk_select("tbl_standarbm","*");
    $params = sk_Mysql("SELECT * FROM tbl_parameter WHERE id_user='".GetData('parameterid')."'");;
        /*
        $parameter = "";
        $jumlahparam = count($_POST["param"]);
        for ($i=0; $i < $jumlahparam; $i++) {
	           $parameter .=$_POST['param'][$i].",";
	           //$addParameter = sk_Mysql("INSERT INTO tbl_parameter values('','{$parameter}','".PostData('parameter')."')");
        }
        
	/*if(!$addParameter){
		SetMessage("Gagal Menambah Data Parameter!!!");
		redirect(PATHURL."a/tambahParameter.php");
	}else{
		SetMessage("Berhasil Menambah Data Parameter");
		redirect(PATHURL."a/tambahParameter.php");
	}*/;

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
				        <?php echo $_SESSION['userid']['nama']; ?>
				        <input type="hidden" name="parameter" value="<?php echo $_SESSION['userid']['id']; ?>">			
				    </td>        
                </tr>
				<tr>
				<?php 
				$i=0; foreach($bm as $param){ 
				$dataParameter = mysql_fetch_array($params);
				?>				    
				    <td><?php echo $param['nama']; ?></td>
				    <td>:</td>
                    <td>
                    <?php if($dataParameter['nama']==$param['nama']){ ?>
                         <input type='checkbox' name='param[]' id="param" value='<?php echo $param['idbm']; ?>' checked="true">&nbsp;(mg/Nm<sup>2</sup>)                                                          
							<?php }else{ ?> 
								<input type='checkbox' name='param[]' id="param" value='<?php echo $param['idbm']; ?>'>&nbsp;(mg/Nm<sup>2</sup>) 
							<?php } ?>                   
                    </td>				
				</tr>
				<?php $i++; } ?>
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