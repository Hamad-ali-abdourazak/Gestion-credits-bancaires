<?php
	require_once'class.php';
	session_start();
	
	if(ISSET($_POST['login'])){
	
		$db=new db_class();
		$username=$_POST['username'];
		$password=$_POST['password'];
		$get_id=$db->login($username, $password);
		
		if($get_id['count'] > 0){
			
			$_SESSION['user_id']=$get_id['user_id'];
			unset($_SESSION['message']);
			echo"<script>alert('connecté avec succès')</script>";
			echo"<script>window.location='home.php'</script>";
		}else{
			$_SESSION['message']="nom utilisateur ou mot de passe incorrect";

			echo"<script>window.location='index.php'</script>";
		}
	}
?>