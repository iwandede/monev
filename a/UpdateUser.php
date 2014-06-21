<?php
    include("header.php");
    $data = sk_select('tbl_user',"*","WHERE id_user='".GetData('userid')."'");
    $_SESSION['UserSelect']= GetData('userid');
    if($_POST){
			$dataUser = array( 
				"username" 			=> PostData('username'),
				"password" 			=> _encrypt_password(PostData('password')),
				"namaPerusahaan" 	=> PostData('namaPerusahaan'),
				"alamat" 			=> PostData('alamat'),
				"telpFax" 			=> PostData('fax'),
				"tahunBerdiri" 	    => PostData('tahun'),
				"LuasArea" 			=> PostData('luas'),
				"contactPerson" 	=> PostData('contact'),
				"email" 			   => PostData('email'));
			$updateUser = sk_Update("tbl_user",$dataUser,"id_user='".GetData('userid')."'");
	if(!$updateUser){
		SetMessage("Gagal Mengubah Data Perusahaan!!!");
		redirect(PATHURL."a/UpdateUser.php?userid=".$_SESSION['UserSelect']);
	}else{
		SetMessage("Berhasil Mengubah Data Perusahaan");
		redirect(PATHURL."a/UpdateUser.php?userid=".$_SESSION['UserSelect']);
	}
}
?>
<div id="main_content">
	<ul>
		<li><a href="#tabs-1">Ubah Data Perusahaan</a></li>
	</ul>
    <div id="tabs-1">
    <div id="judulform">Ubah data peusahaan yang dipantau</div>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
    <form name="tambahUser" method="POST" action="<?php echo PATHURL; ?>a/UpdateUser.php?userid=<?php echo $data[0]['id_user']; ?>" id="perusahaan" novalidate="novalidate">
        <table>
				<tr>
					<td>username</td>			
					<td>:</td>		
					<td><input type="text" name="username" id="username" value="<?php echo $data[0]['username']; ?>"></td>
				</tr>
				<tr>
					<td id="td">Nama</td>
					<td>:</td>
					<td><input type="text" name="namaPerusahaan" id="namaPerusahaan" size="60" value="<?php echo $data[0]['namaPerusahaan']; ?>"/></td>
				</tr>
				<tr>
					<td id="td">Alamat</td>
					<td>:</td>
					<td><textarea name="alamat" id="alamat" ><?php echo $data[0]['alamat']; ?></textarea></td>
				</tr>
				<tr>
					<td id="td">Telp/Fax</td>
					<td>:</td>
					<td><input type="text" name="fax" id="fax" size="40" value="<?php echo $data[0]['telpFax']; ?>"/></td>
				</tr>
				<tr>
					<td id="td">Tahun Berdiri</td>
					<td>:</td>
					<td><input type="text" name="tahun" id="tahun" value="<?php echo $data[0]['tahunBerdiri']; ?>" /></td>
				</tr>
				<tr>
					<td id="td">Luas Area</td>
					<td>:</td>
					<td><input type="text" name="luas" id="luas" value="<?php echo $data[0]['LuasArea']; ?>" />m<em>2</em></td>
				</tr>
				<tr>
					<td id="td">Nama Kontak</td>
					<td>:</td>
					<td><input type="text" name="contact" id="contact" size="30" value="<?php echo $data[0]['contactPerson']; ?>" /></td>
				</tr>
				<tr>
					<td id="td">Email</td>
					<td>:</td>
					<td><input type="text" name="email" id="email" size="30" value="<?php echo $data[0]['email']; ?>" /></td>
				</tr>
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
      $("#perusahaan").validate({
    
        // Specify the validation rules
        rules: {
            username: {
                required: true,
                minlength : 6
                },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            nama : {
                required: true          
            },
            alamat : {
                required : true            
            },
            fax : {
                required : true           
            },
            tahun : {
                required : true,
                number : true            
            },
            luas : {
                required : true,
                number : true            
            },
            contact : {
                required : true            
            }
        
        },
        
        messages: {
            username: {
                required : "Username tidak boleh kosong",
                minlength : "Username minimal 6 karakter"
                },
            nama : {
                required : "Nama Perusahaan tidak boleh kosong"            
            },
            password: {
                required: "Passwprd tidak boleh kosong",
                minlength: "password minimal 6 karakter"
            },
            email: {
                email : "Format email tidak benar, masukan format email yang benar",
                required : "Email tidak boleh kosong"
            },
            alamat : {
                required : "Alamat tidak boleh kosong"            
            },
            fax : {
                required : "Tlp/fax tidak boleh kosong"
            },
            tahun : {
                required : "Tahun Berdiri tidak boleh kosong",
                number : "Tahun berdiri hanya angka"            
            },
            luas : {
                required : "Luas area idak boleh kosong",
                number : "Luas Area hanya angka"            
            },
            contact : {
                required : "Kontak tidak boleh kosong"            
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
      $( "#main_content" ).tabs({
          selected: 0,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/DaftarUser.php";
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
unset($_SESSION['UserSelect']); 
require_once ('footer.php'); 
?>