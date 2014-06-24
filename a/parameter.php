<?php 
require_once ('header.php'); 
$_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : "";
$datas = sk_Mysql("SELECT id_user as id, namaPerusahaan as nama FROM tbl_user WHERE role='1'");
if(GetData('act')=="del") {
    $hapus = sk_Delete("tbl_sumberemisi","id='".GetData('parameterid')."'");
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
		<li><a href="#tabs-1">Daftar Parameter</a></li>
		<!-- li><a href="#">Ubah data Parameter</a></li-->
	</ul>
<div id="tabs-1">
<div id="judulform1">
Daftar Parameter yang diuji
	<select name="sumberEmisi" id="sumberEmisi"" >
	<option value="">Pilih Perusahaan</option>
	<?php 
		while($data=mysql_fetch_array($datas)){ 
	?>
		<option value="<?php echo $data['id'] ?>"><?php echo $data['nama']; ?></option>
	<?php } ?>
	</select>
	<select id="txtHint" name="txtHint" onchange="showSumber(this.value)">
		<option value="" selected="selected" >-Pilih Dahulu Sumber Emisi </option>
	</select>
	</div>
	<div id="hasil"><b>Pilih Perusahaan terlebih dahulu untuk menampilkan data Parameter yang diuji</b></div>
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
    			document.getElementById("hasil").innerHTML="";
    			return;
  			} 
  			if (window.XMLHttpRequest) {
    			xmlhttp=new XMLHttpRequest();
  			} else { 
    			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  			}
  			xmlhttp.onreadystatechange=function() {
    				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      				document.getElementById("hasil").innerHTML=xmlhttp.responseText;
    				}
  			}
  			xmlhttp.open("GET","DaftarParameter.php?q="+str,true);
  			xmlhttp.send();
		}  	
      $(document).ready(function() {
    	  $("#sumberEmisi").change(function(){
              var country=$("#sumberEmisi").val();
              $.ajax({
                 type:"POST",
                 url:"selectSumber.php",
                 data:"q="+country,
                 success:function(data){
                       $("#txtHint").html(data);
                       //console.log(data);
                 }
              });
        }); 
      $( "#main_content").tabs({
          selected: 0,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/tambahParameter.php";
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
unset($_SESSION['sumber']);
require_once ('footer.php'); 
?>