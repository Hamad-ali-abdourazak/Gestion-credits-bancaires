<?php
	require_once'class.php';
	if(ISSET($_POST['save'])){
		$db=new db_class();
		$firstname=$_POST['firstname'];
		$middlename=$_POST['middlename'];
		$lastname=$_POST['lastname'];
		$contact_no=$_POST['contact_no'];
		$address=$_POST['address'];
		$email=$_POST['email'];
		
		
		$db->save_borrower($firstname,$middlename,$lastname,$contact_no,$address,$email);
		echo"<script>alert('Emprunteur ajouté avec succès')</script>";

		header("location: borrower.php");
	}
?>