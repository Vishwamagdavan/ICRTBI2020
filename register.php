<?php
session_start();
$con = mysqli_connect("localhost", "u987684220_fdp", "admin@stjose", "u987684220_fdp");
//require('config.php');
// include('./httpful.phar');



if (isset($_POST['submit'])) {
	$mtxnid = "ICRTBI2020" . mt_rand();
	$name = $_POST['element_2'];
	$designation = $_POST['element_2'];
	$email = $_POST['element_3'];
	$institute = $_POST['element_4'];
	$mobile = $_POST['element_5'];
	$ini_amount=$_POST['element_8'];
	$amount=0;
	if($ini_amount==1)
	{
		$amount=5500;
	}
	else if($ini_amount==2)
	{
		$amount=2;
	}
	else if($ini_amount==3)
	{
		$amount=3;
	}
	else
	{
		$amount=4;
	}

	$extra_amount=$amount;
	// if($extra_amount==1)
	// 	$extra_amount=$amount;
	// else
	// 	$extra_amount=$amount+500;
	$query = "INSERT into register set name='$name',designation='$designation',email='$email',institute='$institute',mobile='$mobile',amount='$extra_amount',payment_id='$mtxnid'";
	$query_run = mysqli_query($con, $query);
	
	$_SESSION['mtxnid'] = $mtxnid;


	header("Location: https://portal.stjosephstechnology.ac.in/sendPost.jsp?RUrl=https://portal.stjosephstechnology.ac.in/TechProcess?auth=fluffy%26amount=$extra_amount%26user=ICRTET%26custid=$name%26refno=$mtxnid%26returnURL=http://icrtbi2020.stjosephstechnology.ac.in/register.php", TRUE, 307);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ICRTBI2020 Registration</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="view.js"></script>
</head>

<body>
	<div class="container-fluid" style="background-color:#9999ff; padding:20px;" >
		<center>
			<h1><a>5<sup>th</sup> International Conference on Recent Trends in Engineering and Technology</a></h1>
		</center>
		<center>
			<h2>St. Joseph's Insitute of Technology, Chennai.</h2>
		</center>
	</div>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div style="background-color: #e6e0e0" class="col-md-8">
				<br>
				<h4>Details</h4>
				<form id="form_38599" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="inputEmail4">Paper ID</label>
							<input type="text" class="form-control" id="element_0" name="element_0" placeholder="Paper" maxlength="255" value="">
							<br>
							<label for="inputPassword4">Paper title</label>
							<input type="text" class="form-control" id="element_1" name="element_1" placeholder="Paper Title" maxlength="255" value="">
							<br>
							<label for="inputPassword4">Corresponding Author Name</label>
							<input type="text" class="form-control" id="element_2" name="element_2" placeholder="Ex: John" maxlength="255" value="">
							<br>
							<label for="inputPassword4">Author Email</label>
							<input type="email" class="form-control" id="element_3" name="element_3" placeholder="Ex: example@gmail.com" maxlength="255" value="">
							<br>
							<label for="inputPassword4">Affliation</label>
							<input type="text" class="form-control" id="element_5" name="element_9" placeholder="" maxlength="255" value="">
							<br>
							<label for="inputPassword4">Name of Institution</label>
							<input type="text" class="form-control" id="element_4" name="element_4" placeholder="St. Joseph's Institute of Technology" maxlength="255" value="">
							<br>
							<label for="inputPassword4">Author Mobile</label>
							<input type="text" class="form-control" id="element_5" name="element_5" placeholder="Ex: +919898989898" maxlength="255" value="">
							<br>
							<label for="inputState">Category</label>
							<select id="inputState" class="form-control" name="element_8" onchange="showDiv('hidden_div',this)">
								<option value="1">STUDENT</option>
								<option value="2">RESEARCH SCHOLAR</option>
								<option value="3">ACADEMIA / R&D / INDUSTRY</option>
								<option value="4">LISTENER</option>
							</select>
							<!-- <br>
							<label for="inputState">Category</label>
							<select id="element_10" class="form-control" onchange="debug()" onload="debug()">
								<option value="5500" >STUDENT</option>
								<option value="6000" selected>RESEARCH SCHOLAR</option>
								<option value="6500">ACADEMIA / R&D / INDUSTRY</option>
								<option value="1500">LISTENER</option>
							</select> -->
							<br>
							
							<input type="checkbox" name="sem" value="1">I would like to attend One Day Pre-Conference<br>
							<br>
							<label for="inputPassword4">Discount Coupon</label>
							<input type="text" name="element_9" class="form-control" placeholder="Enter Coupon Code">
							<br>
							<label for="inputPassword4">Price</label>
							<input type="number" name="element_9" class="form-control" id="hidden_div" value=5500 readonly>
							<input type="hidden" name="form_id" value="38599" />
						</div>
					</div>
					<button type="submit" id="saveForm" name="submit" value="Make Payment" class="btn btn-primary">Make Payment</button>
				</form>
			</div>
		</div>
	</div>
</body>

</html>



<!-- <head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>ICRTBI2020 Registration</title>
	<link rel="stylesheet" type="text/css" href="view.css" media="all"> -->
	<!-- <link href="payment.css" rel="stylesheet" type="text/css"></link> -->
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="view.js"></script>
	<style type="text/css">
		#li_1 {
			list-style: none;
		}

		#li_2,
		#li_3,
		#li_4,
		#li_5,
		#li_6,
		#li_7 {
			list-style: none;
		}
	</style>
</head> -->
<!-- 
<body id="main_body">
	<img id="top" src="top.png" alt="">
	<div id="form_container">
		<form id="form_38599" class="appnitro" enctype="multipart/form-data" method="post" action="">
			<div class="form_description">
				<p></p>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<ul>


							<li id="li_1">
								<label class="description" for="element_1">Paper ID</label>
								<div>
									<input id="element_1" name="element_0" class="element text medium" type="text" maxlength="255" value="" />
								</div>
							</li><br>

							<li id="li_1">
								<label class="description" for="element_1">Paper Title</label>
								<div>
									<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="" />
								</div>
							</li><br>
							<li id="li_2">
								<label class="description" for="element_2">Corresponding Author Name</label>
								<div>
									<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="" />
								</div>
							</li><br>
							<li id="li_3">
								<label class="description" for="element_3">Author Email </label>
								<div>
									<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="" />
								</div>
							</li><br>

							<li id="li_1">
								<label class="description" for="element_1">Affliation</label>
								<div>
									<input id="element_1" name="element_9" class="element text medium" type="text" maxlength="255" value="" />
								</div>
							</li><br>


							<li id="li_4">
								<label class="description" for="element_4">Name of Institution </label>
								<div>
									<input id="element_4" name="element_4" class="element text large" type="text" maxlength="255" value="" />
								</div>
							</li><br>
							<li id="li_5">
								<label class="description" for="element_5">Author Mobile </label>
								<div>
									<input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value="" />
								</div>
							</li><br> -->
							<!-- <li id="li_5" >
		<label class="description" for="element_7">Category</label>
		<div>
			<select id="test" name="element_7" onchange="showDiv('hidden_div', this)">
   					<option value="0">Conference</option>
  				 	<option value="1">Conference + Seminar</option>
			</select>
		</div>
		</li><br> -->

<!-- 




							<li id="li_1">
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
							<li id="li_1">
								<div>
									<input type="checkbox" name="sem" value="1" onchange="check('hidden_div',this)">INCLUDE SEMINAR<br>
								</div>
							</li><br>

 -->


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
							<!-- <li id="li_5">
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

							<li class="buttons" id="li_5">
								<input type="hidden" name="form_id" value="38599" />

								<input id="saveForm" class="button_text" type="submit" name="submit" value="Make Payment" />
							</li>
						</ul>
					</div>
					<div class="col-md-3">

					</div>
				</div>
			</div>

		</form> -->

		<!-- 
<div style="text-align: center;background-color: lightgreen;border: 2px solid green;border-radius: 50px;color: green;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Transaction Sucess</div> -->

		<?php




		if (isset($_GET['msg'])) {
			$id = $_SESSION['mtxnid'];
			$message = $_GET['msg'];
			$ref = $_GET['msg'];
			$ref = json_decode($ref, true);
			if (strcmp($message, 'Transaction Failed') == 0) {
				$query = "UPDATE register set payment_status='failed' WHERE payment_id='$id'";
				$query_run = mysqli_query($con, $query);
		?>
				<div style="text-align: center;background-color:#ff9999 ;border: 2px solid red;border-radius: 50px;color: red;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Payment Failed</div>
			<?php
			} else {
				$query = "UPDATE register set payment_status='success' WHERE payment_id='$id'";
				$query_run = mysqli_query($con, $query); ?>
				<div style="text-align: center;background-color: lightgreen;border: 2px solid green;border-radius: 50px;color: green;font-weight: bold;font-size: 20px;padding: 20px;margin: 10px">Payment Sucess<br>
					Your Ref Id : <?php echo $ref['refno']; ?><br>
					Amount Paid : <?php echo $ref['amount']; ?>
				</div>

		<?php }
		}

		?>
	</div>
	<script type="text/javascript">
		// function debug()
		// {
		// 	var e = document.getElementById("element_10");
		// var result = e.options[e.selectedIndex].text;
		// console.log(result);
		// document.getElementById("element_9").value=0;
		// }

		function showDiv(divId, element) {
			console.log(element.value);
			var amount = [5500, 6000, 6500,1500];
			document.getElementById(divId).value = element.value == 1 ? 0 : amount[element.value - 1];
			document.getElementById(divId).value = element.value == 2 ? 0 : amount[element.value - 1];
			document.getElementById(divId).value = element.value == 3 ? 0 : amount[element.value - 1];
			document.getElementById(divId).value = element.value == 4 ? 0 : amount[element.value - 1];
			var number=document.getElementById(divId).value = element.value == 4 ? 1500 : amount[element.value -1];
			console.log(number);
		}

		// function check(divId, element) {
		// 	var amt = parseInt(document.getElementById(divId).value);
		// 	console.log(amt); 
		// 	if (element.checked) {
		// 		document.getElementById(divId).value = amt + 500;
		// 	} else {
		// 		document.getElementById(divId).value = amt - 500;
		// 	}
		// }
	</script>
</body>

</html>