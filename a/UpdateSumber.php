<?php
    include("header.php");
    $datas = sk_Mysql("SELECT id_user as id, namaPerusahaan as nama FROM tbl_user WHERE role='1'");
    $dataEmisi = sk_select("tbl_sumberemisi a, tbl_user b","*"," WHERE a.id_user=b.id_user AND a.id='".GetData('sumberid')."'");
    if($_POST){
			$dataSumber = array("kodeCerobong" =>PostData('kode'),
                               "nama"        =>PostData('nama'),
                               "kapasitas"   =>PostData('kapasitas'),
                               "bbm"         =>PostData('bbm'),
                               "waktuOperasi" =>PostData('waktu'),
                               "lokasi"      =>PostData('lokasi'),
                               "long"        =>PostData('long'),
                               "lat"         =>PostData('lat'),
                               "bentuk"      =>PostData('bentuk'),
                               "tinggi"      =>PostData('tinggi'),
                               "diameter"    =>PostData('diameter'),
                               "posisi"      =>PostData('posisi'),
                               "dataPemantauan" =>PostData('datapemantauan'),
                               "id_user"    =>PostData('sumberEmisi'),
                               "ket" =>PostData('ket'));
            $idSumber=PostData('Emisi');
			$updateSumber = sk_Update("tbl_sumberemisi",$dataSumber,"id='".GetData('sumberid')."'");
						
	if(!$updateSumber){
		SetMessage("Gagal Mengubah Data Sumber Emisi!!!");
		redirect(PATHURL."a/UpdateSumber.php?sumberid=".$idSumber);
	}else{
		SetMessage("Berhasil Mengubah Data Sumber Emisi");
		redirect(PATHURL."a/UpdateSumber.php?sumberid=".$idSumber);
	}
}
?>
<div id="main_content">
	<ul>
		<li><a href="#">Daftar Sumber Emisi</a></li>
		<li><a href="#tabs-1">Ubah Data Sumber Emisi</a></li>
	</ul>
    <div id="tabs-1">
    <div id="judulform">Tambah data Sumber Emisi</div>
    <?php $_SESSION['message'] = isset($_SESSION['message']) ? alert($_SESSION['message']) : ""; ?>
    <form name="tambahUser" method="POST" action="?" id="perusahaan" novalidate="novalidate">
        <table>
                <tr>
				    <td>Perusahaan</td>
				    <td>:</td>
				    <td>
				        <?php echo $dataEmisi[0]['namaPerusahaan']; ?>
				        <input type="hidden" name="sumberEmisi" value="<?php echo $dataEmisi[0]['id_user']; ?>">
				        <input type="hidden" name="Emisi" value="<?php echo GetData('sumberid'); ?>">			
				    </td>        
                </tr>
				<tr>
					<td>Kode Cerobong</td>			
					<td>:</td>		
					<td><input type="text" name="kode" id="kode" value="<?php echo $dataEmisi[0]['kodeCerobong']?>"></td>
				</tr>
				<tr>
					<td>Nama Cerobong</td>			
					<td>:</td>		
					<td><input type="text" name="nama" id="nama" size="40" value="<?php echo $dataEmisi[0]['nama']?>"></td>
				</tr>
				<tr>
					<td id="td">Kapasitas</td>
					<td>:</td>
					<td><input type="text" name="kapasitas" id="kapasitas" size="40" value="<?php echo $dataEmisi[0]['kapasitas']?>" /></td>
				</tr>
				<tr>
					<td id="td">Bahan Bakar</td>
					<td>:</td>
					<td><input type="text" name="bbm" id="bbm" value="<?php echo $dataEmisi[0]['bbm']?>" /></td>
				</tr>
				<tr>
					<td id="td">Waktu Operasi (Jam/Tahun)</td>
					<td>:</td>
					<td><input type="text" name="waktu" id="waktu" value="<?php echo $dataEmisi[0]['waktuOperasi']?>" /></td>
				</tr>
				<tr>
					<td id="td">Lokasi</td>
					<td>:</td>
					<td><input type="text" name="lokasi" id="lokasi" value="<?php echo $dataEmisi[0]['lokasi']?>" /></td>
				</tr>
				<tr>
					<td id="td">long</td>
					<td>:</td>
					<td><input type="text" name="long" id="long" value="<?php echo $dataEmisi[0]['long']; ?>" /></td>
				</tr>
				<tr>
					<td id="td">lat</td>
					<td>:</td>
					<td><input type="text" name="lat" id="lat" value="<?php echo $dataEmisi[0]['lat']?>" /></td>
				</tr>
				<tr>
					<td id="td">Bentuk Cerobong</td>
					<td>:</td>
					<td>
							<select name="bentuk">
							    <option value="<?php echo $dataEmisi[0]['bentuk'];?>" selected="true"><?php echo $dataEmisi[0]['bentuk']; ?></option>
								<option value="kotak">Kotak</option>
								<option value="silinder">Silinder</option>
								<option value="kerucut">Kerucut</option>							
							</select>					
					</td>
				</tr>
				<tr>
					<td id="td">Tinggi Cerobong</td>
					<td>:</td>
					<td><input type="text" name="tinggi" id="tinggi" value="<?php echo $dataEmisi[0]['tinggi']; ?>" />(mm)</td>
				</tr>
				<tr>
					<td id="td">Diameter Cerobong</td>
					<td>:</td>
					<td><input type="text" name="diameter" id="diameter" value="<?php echo $dataEmisi[0]['diameter']?>" />(mm)</td>
				</tr>
				<tr>
					<td id="td">Posisi Cerobong</td>
					<td>:</td>
					<td><input type="text" name="posisi" id="posisi" value="<?php echo $dataEmisi[0]['posisi']?>" />(mm)</td>
				</tr>
				<tr>
					<td id="td">Data Pemantauan</td>
					<td>:</td>
					<td>
							<select name="datapemantauan">
							     <option value="<?php echo $dataEmisi[0]['dataPemantauan'];?>" selected="true"><?php echo $dataEmisi[0]['dataPemantauan']?></option>
								<option value="dipantau">Dipantau</option>
								<option value="tidak dipantau">Tidak Dipantau</option>			
							</select>					
					</td>
				</tr>
				<tr>
					<td id="td">Keterangan</td>
					<td>:</td>
					<td>
							<textarea name="keterangan" id="keterangan" cols="30" rows="5"><?php echo $dataEmisi[0]['ket']?></textarea>				
					</td>
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
    	  $('select').selectmenu();
      $("#perusahaan").validate({
    
        // Specify the validation rules
        rules: {
            kode: {
                required: true
                },
            nama : {
                required: true
                },
            kapasitas: {
                required: true
            },
            bbm: {
                required: true
            },
            waktu : {
                required: true,
                number : true         
            },
            lokasi : {
                required : true            
            },
            long : {
                required : true         
            },
            lat : {
                required : true         
            },
            luas : {
                required : true,
                number : true            
            },
            tinggi : {
                required : true,
                number : true           
            },
            diameter : {
                required : true,
                number : true        
            },
            posisi : {
					required :true,
					number : true            
            }        
        },
        
        messages: {
            kode: {
                required: "Kode Cerobong tidak Boleh Kosong"
                },
            nama : {
                required: "Kode Cerobong tidak Boleh Kosong"
            },
            kapasitas: {
                required: "Kapasitas tidak Boleh Kosong"
            },
            bbm: {
                required: "Bahan Bakar tidak Boleh Kosong"
            },
            waktu : {
                required: "Waktu Operasi tidak Boleh Kosong",
                number : "Wakru Operasi tidak boleh karakter"         
            },
            lokasi : {
                required : "Lokasi Sumber Emisi tidak Boleh Kosong"            
            },
            long : {
                required : "Log tidak Boleh Kosong"         
            },
            lat : {
                required : "lat tidak Boleh Kosong"         
            },
            luas : {
                required : "Luas Cerobong tidak Boleh Kosong",
                number : "Luas tidak Boleh karakter"            
            },
            tinggi : {
                required : "Tinggi Cerobong tidak Boleh Kosong",
                number : "Tinggi Cerobong tidak Boleh Karakter"           
            },
            diameter : {
                required : "Diameter tidak Boleh Kosong",
                number : "Diameter tidak Boleh Karakter"        
            },
            posisi : {
					required :"Posisi Cerobong tidak Boleh Kosong",
					number : "Posisi Cerobong tidak Boleh Karakter"            
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
      $( "#main_content" ).tabs({
          selected: 1,
            select: function(event, ui) {
                var url = "<?php echo PATHURL; ?>a/sumberEmisi.php";
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