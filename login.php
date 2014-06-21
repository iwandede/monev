<?php
include('app/sk_config.php');
include('app/sk_database.php');

if($_POST){
	$username = PostData('username');
	$password = _encrypt_password(PostData('password'));
	
	$query = sk_select("tbl_user","id_user,username,password,role","WHERE username='{$username}' AND password='{$password}'",1);
	if(!empty($query)){
		$_SESSION['UserSession'] = array('id' 		=>$query[0]['id_user'],
							 			 'username' =>$query[0]['username'],
							 			 'role' 	=>$query[0]['role'],
							 			 'status' 	=>'on',
										 'ceklogin' =>md5($_SERVER['REMOTE_ADDR']));
		if($_SESSION['UserSession']['role']==2){
			redirect(PATHURL.'a/');
		}else if($_SESSION['UserSession']['role']==3){
			redirect(PATHURL.'c/');
		}else{
			redirect(PATHURL.'b/');
		}
	}else{
		SetMessage("Username dan Password Salah!!!");
		redirect('index.php');
	}
}
?>