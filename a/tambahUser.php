<?php
    include("header.php");
    if($_POST){
			$dataUser = array( 
				"username" 			=> PostData('username'),
				"password" 			=> _encrypt_password(PostData('password')),
				"namaPerusahaan" 	=> PostData('namaPerusahaan'),
				"alamat" 			=> PostData('alamat'),
				"telpFax" 			=> PostData('fax'),
				"tahunBerdiri" 	=> PostData('tahun'),
				"LuasArea" 			=> PostData('luas'),
				"contactPerson" 	=> PostData('contact'),
				"email" 			   => PostData('email'));
			$addUser = sk_Insert("tbl_user",$dataUser);
	if(!$addUser){
		SetMessage("Gagal Menambah Data Perusahaan!!!");
		redirect(PATHURL."a/DaftarUser.php");
	}else{
		SetMessage("Berhasil Menambah Data Perusahaan");
		redirect(PATHURL."a/DaftarUser.php");
	}
}
?>
<div id="main_content">
	<ul>
		<li><a href="#">Daftar Perusahaan</a></li>
		<li><a href="#tabs-1">Tambah Perusahaan</a></li>
	</ul>
    <div id="tabs-1">
    <div id="judulform">Tambah data peusahaan yang akan dipantau</div>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
    <form name="tambahUser" method="POST" action="?" id="perusahaan" novalidate="novalidate">
        <table>
				<tr>
					<td>username</td>			
					<td>:</td>		
					<td><input type="text" name="username" id="username"></td>
				</tr>
				<tr>
					<td id="td">Password</td>
					<td>:</td>
					<td><input type="password" name="password" id="password" /></td>
				</tr>
				<tr>
					<td id="td">Nama</td>
					<td>:</td>
					<td><input type="text" name="namaPerusahaan" id="namaPerusahaan" size="60"/></td>
				</tr>
				<tr>
					<td id="td">Alamat</td>
					<td>:</td>
					<td><textarea name="alamat" id="alamat" ></textarea></td>
				</tr>
				<tr>
					<td id="td">Telp/Fax</td>
					<td>:</td>
					<td><input type="text" name="fax" id="fax" size="40"/></td>
				</tr>
				<tr>
					<td id="td">Tahun Berdiri</td>
					<td>:</td>
					<td><input type="text" name="tahun" id="tahun" /></td>
				</tr>
				<tr>
					<td id="td">Luas Area</td>
					<td>:</td>
					<td><input type="text" name="luas" id="luas" />m<sup>2</sup></td>
				</tr>
				<tr>
					<td id="td">Nama Kontak</td>
					<td>:</td>
					<td><input type="text" name="contact" id="contact" size="30" /></td>
				</tr>
				<tr>
					<td id="td">Email</td>
					<td>:</td>
					<td><input type="text" name="email" id="email" size="30" /></td>
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
                required : true,
                number : true            
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
                required : "Tlp/fax tidak boleh kosong",
                number : "Tlp/fax hanya angka"            
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
          selected: 1,
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
require_once ('footer.php'); 
?>