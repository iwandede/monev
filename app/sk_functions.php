<?php
function GetData($value){
    $get = AntiInject(@$_GET[$value]);
    return $get;
}
function PostData($value){
    $post = trim(MyTrim(strip_tags(mysql_real_escape_string(@$_POST[$value]))));
    return $post;
}
function AntiInject($kata){
    $kata = trim(MyTrim(htmlentities(addslashes(htmlspecialchars($kata)))));
    $cari = array ("%","@","_","1=1","/","!","<",">","\(","\)",";","-","_","select","delete","update","alter","insert","grant","union","\\","'");
    $ganti = array ("persen","apeoposu!","gbawah","satusatu","garing","seru","lebihkecil","lebihbesar","kurung","kurung","asu","min","minbawah","memilih","menghapus","perbaharui","alternative","masukin","granditubuatapa","bawang","slash","petik");
    $kata = str_replace($cari,$ganti,strtolower($kata));
    return $kata;
}
function MyTrim($str){
    $panjang = strlen($str);
    $spasi   = substr("  ",1,$panjang);
    if($spasi){
        for($i=1;$i<=$panjang;$i++){
            $str = str_replace("  "," ", $str);
        }
    }
    return $str;
}
function valid_email($address){
    $valid = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address);
    if(!$valid){
        $msg = "email tidak valid";
    }  else {
        $msg = "email valid"; 
    }
    return $msg;
}
function redirect($url, $permanent = false) {
        if($permanent) {
            header('HTTP/1.1 301 Moved Permanently');
        }
            header('Location: '.$url);
        exit();
    }
function _encrypt_password($value) {
        $salt = '#*bPlHd!@-*%';
        $result = md5($salt . $value);
        return $result;
    }
function SetMessage($msg){
	$_SESSION['message'] = $msg;
	echo $_SESSION['message'];
}
function alert($text="",$type=""){
	if(empty($type)){
		echo   "	<div class='info ui-corner-all ui-state-highlight'>
							{$text}
					</div>";
	}else{
		 echo  "<div class='info ui-corner-all ui-state-error'>
							{$text}
					</div>";
	}
}

function class_current($header, $current) {
    if ($header == "index" && sizeof($current) <= 1)
        return "current";

    if (in_array("error", $current))
        return "";

    if (in_array($header, $current))
        return "current";

    return "";
} 

function paging($sql,$item_per_page){
   $get = GetData('page');
   $page          =  isset($get) ? $get : 1 ;
   if( ( $page < 1) && (empty( $page)) ){
      $page=1; 
   }
   $query         = mysql_query($sql);
   $jumlah_data   = mysql_num_rows($query);
   $jumlah_hal    = ceil( $jumlah_data/$item_per_page );
   if( $page>$jumlah_hal ){
      $page=$jumlah_hal;
   }
   $lanjut  = $page + 1;
   $sebelum = $page - 1;
   ?>
   Anda ada di halaman <?php echo $page; ?> dari <?php echo $jumlah_hal;?><br />
   <a href="?page=1">&lt;&lt;</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $sebelum; ?>">&lt;&nbsp;sebelumnya</a>&nbsp;&nbsp;&nbsp;
   ||
   &nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $lanjut; ?>">selanjutnya&nbsp;&gt;</a>&nbsp;&nbsp;&nbsp;<a href="?page=<?php echo $jumlah_hal;?>">&gt;&gt;</a>
   <?php 
} 
?>