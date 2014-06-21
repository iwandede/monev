<?php 
require_once ('header.php'); 
$_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : "";
$datas = sk_Mysql("SELECT id_user as id, namaPerusahaan as nama FROM tbl_user WHERE role='1'");
if(GetData('act')=="del") {
    $hapus = sk_Delete("tbl_sumberemisi","id='".GetData('sumberid')."'");
    if(!$hapus) {
        SetMessage("Data Sumber Emisi gagal dihapus");
        redirect(PATHURL."a/sumberEmisi.php");
    }else {
        SetMessage("Data Sumber Emisi berhasil dihapus");
        redirect(PATHURL."a/sumberEmisi.php");
    }
}
?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Daftar Sumber Emisi</a></li>
	</ul>
<div id="tabs-1">
<div id="judulform1">
Data Sumber Emisi
	<select name="sumberEmisi" onchange="showSumber(this.value)" style="font-size: 12px;">
	<option value="">Pilih Perusahaan</option>
	<?php while($data=mysql_fetch_array($datas)){ ?>
		<option value="<?php echo $data['id'] ?>"><?php echo $data['nama']; ?></option>
	<?php }?>
	</select>
	</div>
	<div id="txtHint"><b>Pilih Perusahaan terlebih dahulu untuk menampilkan data Sumber Emisi</b></div>
</div>
</div>
<br />

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
		function showSumber(str) {
  			if (str=="") {
    			document.getElementById("txtHint").innerHTML="";
    			return;
  			} 
  			if (window.XMLHttpRequest) {
    			xmlhttp=new XMLHttpRequest();
  			} else { 
    			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
  			xmlhttp.onreadystatechange=function() {
    				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    				}
  			}
  			xmlhttp.open("GET","DaftarSumber.php?q="+str,true);
  			xmlhttp.send();
		}
      $(document).ready(function() { 
      
      $( "#main_content" ).tabs({
          selected: 0,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/tambahSumber.php";
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

<br />
<?php
unset($_SESSION['message']);
unset($_SESSION['userid']);
require_once ('footer.php'); 
?>