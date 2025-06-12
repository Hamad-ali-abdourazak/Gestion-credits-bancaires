<?php
	require_once'class.php';
	if(ISSET($_POST['update'])){
		$db=new db_class();
		$borrower_id=$_POST['borrower_id'];
		$firstname=$_POST['firstname'];
		$middlename=$_POST['middlename'];
		$lastname=$_POST['lastname'];
		$contact_no=$_POST['contact_no'];
		$address=$_POST['address'];
		$email=$_POST['email'];
	
		$db->update_borrower($borrower_id,$firstname,$middlename,$lastname,$contact_no,$address,$email);
		echo"<script>alert('emprunteur modifier avec succès')</script>";
		echo"<script>window.location='borrower.php'</script>";
	}
?>