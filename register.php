<link href="payment.css" rel="stylesheet" type="text/css"></link>
<?php
session_start();
$con=mysqli_connect('localhost','root','','payment_db');
//require('config.php');
// include('./httpful.phar');



if(isset($_POST['submit'])){
	$mtxnid = "STJOSEFDP".mt_rand();
	$name=$_POST['element_1'];
	$designation=$_POST['element_2'];
	$email=$_POST['element_3'];
	$institute=$_POST['element_4'];
	$mobile=$_POST['element_5'];
	$amount=$_POST['element_8'];
	
    	$query="INSERT into register set name='$name',designation='$designation',email='$email',institute='$institute',mobile='$mobile',amount='$amount',payment_id='$mtxnid'";
    	$query_run=mysqli_query($con,$query);
    	$_SESSION['mtxnid']=$mtxnid;
        
						
		 header("Location: https://portal.stjosephstechnology.ac.in/sendPost.jsp?RUrl=https://portal.stjosephstechnology.ac.in/TechProcess?auth=fluffy%26amount=$amount%26user=ICRTET%26custid=$name%26refno=$mtxnid%26returnURL=http://www.stjosephstechnology.ac.in/icrtet2019.php", TRUE, 307);
		
}

?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICRTBI2020 Registration</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<style type="text/css">

</style>
</head>
<body id="main_body" >
	<img id="top" src="top.png" alt="">
	<div id="form_container">

		<h1><a>5th International Conference on Recent Trends in Engineering and Technology</a></h1>
		<form id="form_38599" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form_description">
			<h2>5th International Conference on Recent Trends in Engineering and Technology</h2>
			<p></p>
		</div>
			<ul>


<li id="li_1" >
		<label class="description" for="element_1">Paper ID</label>
		<div>
			<input id="element_1" name="element_0" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li><br>

				<li id="li_1" >
		<label class="description" for="element_1">Paper Title</label>
		<div>
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li><br>		<li id="li_2" >
		<label class="description" for="element_2">Corresponding Author Name</label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li><br>		<li id="li_3" >
		<label class="description" for="element_3">Author Email </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li><br>	

		<li id="li_1" >
		<label class="description" for="element_1">Affliation</label>
		<div>
			<input id="element_1" name="element_9" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li><br>


			<li id="li_4" >
		<label class="description" for="element_4">Name of Institution </label>
		<div>
			<input id="element_4" name="element_4" class="element text large" type="text" maxlength="255" value=""/>
		</div>
		</li><br>		<li id="li_5" >
		<label class="description" for="element_5">Author Mobile </label>
		<div>
			<input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li><br>
		<!-- <li id="li_5" >
		<label class="description" for="element_7">Category</label>
		<div>
			<select id="test" name="element_7" onchange="showDiv('hidden_div', this)">
   					<option value="0">Conference</option>
  				 	<option value="1">Conference + Seminar</option>
			</select>
		</div>
		</li><br> -->






		<li id="li_1" >
		<label class="description" for="element_1">Category</label>
		<div>
			<select name="element_8" onchange="showDiv('hidden_div',this)">
					<option value="1">STUDENT</option>
					<option value="2">RESEARCH SCHOLAR</option>
					<option value="3">ACADEMIA / R&D / INDUSTRY</option>
					<option value="4">LISTENER</option>
				</select>
		</div>
		</li>
		<li id="li_1" >
		<div>
			<input type="checkbox" name="sem" value="1" onchange="check('hidden_div',this)">INCLUDE SEMINAR<br>
		</div>
		</li><br>




		<!-- <li id="li_5">
			<div id="hidden_div">
				<label>Amount</label><br>
				<select name="element_8">
					<option value="7000">STUDENT : 7000</option>
					<option value="7500">RESEARCH SCHOLAR : 7500</option>
					<option value="8000">ACADEMIA/R&D/INDUSTRY : 8000</option>
					<option value="2000">LISTENER : 2000</option>
				</select>
			</div>
			<div id="display_div">
				<label>Amount</label><br>
				<select name="element_8">
					<option value="6500">STUDENT : 6500</option>
					<option value="7000">RESEARCH SCHOLAR : 7000</option>
					<option value="7500">ACADEMIA/R&D/INDUSTRY : 7500</option>
					<option value="1500">LISTENER : 1500</option>
				</select>
			</div>
		</li><br> -->
		<li id="li_5">
			<label class="description" for="element_1">Discount Coupon</label>
			<div>
				<input type="text" name="element_9" placeholder="Enter Coupon Code">
			</div>
		</li><br>

		<li id="li_5">
			<label class="description" for="element_1">PRICE</label>
			<div>
				<input type="number" name="element_9" placeholder="Enter Coupon Code" id="hidden_div" value=6500 readonly>
			</div>
		</li><br>

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
    $ref=$_GET['msg'];
    $ref = json_decode($ref, true);
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
		<div style="text-align: center;background-color: lightgreen;border: 2px solid green;border-radius: 50px;color: green;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Payment Sucess<br>
			Your Ref Id : <?php echo $ref['refno']; ?><br>
			Amount Paid : <?php echo $ref['amount']; ?>
		</div>

	<?php }
}

?>
	</div>
	<script type="text/javascript">
		function showDiv(divId, element)
{
	
	var amount=[6500,7000,7500,1500];
    document.getElementById(divId).value = element.value == 1 ? 0:amount[element.value-1] ;
    document.getElementById(divId).value = element.value == 2 ? 0:amount[element.value-1] ;
    document.getElementById(divId).value = element.value == 3 ? 0:amount[element.value-1] ;
    document.getElementById(divId).value = element.value == 4 ? 0:amount[element.value-1] ;
}

function check(divId, element){
	var amt=parseInt(document.getElementById(divId).value);
	if(element.checked){
		document.getElementById(divId).value=amt+500;
	}else{
		document.getElementById(divId).value=amt-500;
	}
}





	</script>
	</body>
</html>
