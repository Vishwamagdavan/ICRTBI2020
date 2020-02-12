<?php
session_start();
$con=mysqli_connect("localhost","u987684220_fdp","admin@stjose","u987684220_fdp");
// include('./httpful.phar');



if(isset($_POST['submit'])){
	$mtxnid = "STJOSEFDP".mt_rand();
	$name=$_POST['element_1'];
	$designation=$_POST['element_2'];
	$email=$_POST['element_3'];
	$institute=$_POST['element_4'];
	$mobile=$_POST['element_5'];
	$amount=$_POST['element_6'];
	
    	;$query="INSERT into register set name='$name',designation='$designation',email='$email',institute='$institute',mobile='$mobile',amount='$amount',payment_id='$mtxnid'";
    	$query_run=mysqli_query($con,$query);
    	$_SESSION['mtxnid']=$mtxnid;
        
						
		header("Location: https://portal.stjosephstechnology.ac.in/sendPost.jsp?RUrl=https://portal.stjosephstechnology.ac.in/TechProcess?auth=fluffy%26amount=$amount%26user=ICRTET%26custid=$name%26refno=$mtxnid%26returnURL=http://www.stjosephstechnology.ac.in/icrtet2019.php", TRUE, 307);
		
}

?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICRTET2019 Registration</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>

</head>
<body id="main_body" >
	<img id="top" src="top.png" alt="">
	<div id="form_container">

		<h1><a>4th International Conference on Recent Trends in Engineering and Technology</a></h1>
		<form id="form_38599" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form_description">
			<h2>4th International Conference on Recent Trends in Engineering and Technology</h2>
			<p></p>
		</div>
			<ul><li id="li_1" >
		<label class="description" for="element_1">Paper Id</label>
		<div>
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Name</label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Email </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Name of Institute </label>
		<div>
			<input id="element_4" name="element_4" class="element text large" type="text" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Mobile </label>
		<div>
			<input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>
			<li id="li_5" >
		<label class="description" for="element_5">Amount </label>
		<div>
			<input id="element_6" name="element_6" class="element text medium" type="number" maxlength="255" value=""/>
		</div>
		</li>
					<li class="buttons">
			    <input type="hidden" name="form_id" value="38599" />

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Make Payment" />
		</li>
			</ul>
		</form>

<!-- 
<div style="text-align: center;background-color: lightgreen;border: 2px solid green;border-radius: 50px;color: green;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Transaction Sucess</div> -->

<?php



	
if(isset($_GET['msg'])){
    $id=$_SESSION['mtxnid'];
    $message=$_GET['msg'];
	if(strcmp($message,'Transaction Failed')==0){
		$query="UPDATE register set payment_status='failed' WHERE payment_id='$id'";
		$query_run=mysqli_query($con,$query);
		?>
		<div style="text-align: center;background-color:#ff9999 ;border: 2px solid red;border-radius: 50px;color: red;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Payment Failed</div>
<?php
}
	else{
		$query="UPDATE register set payment_status='success' WHERE payment_id='$id'";
		$query_run=mysqli_query($con,$query);?>
		<div style="text-align: center;background-color: lightgreen;border: 2px solid green;border-radius: 50px;color: green;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Payment Sucess</div>

	<?php }
}

?>
	</div>
	</body>
</html>
