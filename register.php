<?php
session_start();

$con = mysqli_connect("localhost", "u987684220_fdp", "admin@stjose", "u987684220_fdp");

//$con = mysqli_connect("localhost", "root", "", "epushserver");
//require('config.php');
// include('./httpful.phar');
$arr = [];
$certificate_array = [];

if (isset($_POST['submit'])) {
	$certica = mt_rand(2, 9999);
	$paper_id = $_POST['element_0'];
	$field_values_array = $_POST['field_name'];

	$field_values_array = str_replace("'", "\'", $field_values_array);

	$field_values_collge = $_POST['college_name'];

	$field_values_collge = str_replace("'", "\'", $field_values_collge);

	$i = count($field_values_array);
	foreach ($field_values_array as $value) {
		array_push($arr, $value);
	}
	foreach ($field_values_collge as $college) {
		array_push($certificate_array, $college);
	}
	for ($j = 0; $j < $i; $j++) {
		$certi_names = $arr[$j];
		$certi_college = $certificate_array[$j];
		$query_certificate = "INSERT INTO icrtbi_certificate (paper_id,certi_names,certificate_num,certi_inst) VALUES ('$paper_id', '$certi_names','$certica','$certi_college')";
		$query_run = mysqli_query($con, $query_certificate);

		if (!$query_run) {
			echo "Error:" . mysqli_errno($con);
		}
	}

	/*foreach($field_values_array as $value){
		$certi_names=$field_values_array[$i/2];

		$certi_college=$field_values_collge[$i/2];
		$query_certificate="INSERT INTO icrtbi_certificate (paper_id,certi_names,certi_inst) VALUES ('$paper_id', '$certi_names', '$certi_college')";
		$query_run = mysqli_query($con, $query_certificate);	
		$arr[$i]=$value;
		$i++;
	}*/
	$mtxnid = "ICRTBI2020" . mt_rand();
	$conf_status = $_POST['sem'];
	// var_dump($conf_status);
	$name = $_POST['element_2'];
	$designation = $_POST['element_1'];
	$email = $_POST['element_3'];
	$institute = $_POST['element_4'];
	$mobile = $_POST['element_5'];
	$ini_amount = $_POST['element_8'];
	//$seminar_status=$_POST['sem']; //Seminar Status DEFUALT 1//
	$discount = $_POST['element_9'];
	//Clean the Inputs for Maria DB

	$name = str_replace("'", "\'", $name);
	$designation = str_replace("'", "\'", $designation);
	$institute = str_replace("'", "\'", $institute);
	//Clean the Inputs ENDS
	if (strcmp($conf_status, "1") == 0) {
		$conf = "yes";
	} else if (strcmp($discount, "STJOSEPHS") == 0) {
		$extra_amount = 1;
		$conf = "yes-DISCOUNT";
	} else {
		$conf = "no";
	}

	$amount = 0;
	if ($ini_amount == 1) {
		$amount = 6000;
	} else if ($ini_amount == 2) {
		$amount = 6500;
	} else if ($ini_amount == 3) {
		$amount = 7000;
	} else {
		$amount = 1500;
	}
	$submited_date = time();

	if ($i == 1) {
		$extra_amount = $amount;
	} else {
		$extra_amount = $amount + 300 * ($i - 1);
	}

	// $extra_amount = 1;  //comment this for DEFAULT TRANSCATIONS


	//NIFT Payment Work Start here //
	$payment_method_value = $_POST['submit'];
	if (strcmp($payment_method_value, "NIRF") == 0) {
		$bank_branch = $_POST['nift-bank'];
		$nift_payment_date = $_POST['nift-payment-date'];
		$nift_ref = $_POST['nift-ref'];
		$nift_amount = $_POST['nift-amount'];
		print_r($bank_branch);
		$sql = "INSERT INTO `icrtbi_register` (`id`, `paper_id`, `name`, `email`, `paper_title`, `org`, `payment`, `payment_status`, `payment_time`, `mobile`, `category`, `conf_status`, `certificate_num`, `submit_date`, `payment_id`) VALUES 
	(NULL, '$paper_id', '$name', '$email', '$designation', " . $institute . ", '$nift_amount', 'no', '$bank_branch', '$mobile', '$ini_amount', '$conf', '$certica', '$nift_payment_date', '$nift_ref')";
		mysqli_query($con, $sql);
	}

	//NIFT Payment Work Ends here//

	else {
		$sql = "INSERT INTO `icrtbi_register` (`id`, `paper_id`, `name`, `email`, `paper_title`, `org`, `payment`, `payment_status`, `payment_time`, `mobile`, `category`, `conf_status`, `certificate_num`, `submit_date`, `payment_id`) VALUES 
	(NULL, '$paper_id', '$name', '$email', '$designation', '$institute', '$extra_amount', 'no', 'no', '$mobile', '$ini_amount', '$conf', '$certica', '$submited_date', '$mtxnid')";
		$re = mysqli_query($con, $sql);
		if (!$re) {
			printf("Error: %s\n", mysqli_error($con));
		}
	}
	if (strcmp($payment_method_value, "NIRF") == 0) {
		header("Location: message.php");
	} else {

		$_SESSION['mtxnid'] = $mtxnid;
		header("Location: http://portal.stjosephstechnology.ac.in/sendPost.jsp?RUrl=http://portal.stjosephstechnology.ac.in/TechProcess?auth=fluffy%26amount=$extra_amount%26user=ICRTET%26custid=$name%26refno=$mtxnid%26returnURL=http://icrtbi2020.stjosephstechnology.ac.in/register.php", TRUE, 307);
	}
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://use.fontawesome.com/87bc9ef760.js"></script>
</head>

<body>
	<div class="container-fluid">
		<div class="row" id="border">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-2">
						<br>
						<center><img src="img/unnamed.png" alt="College Logo" style="width: 90%"></center>
					</div>
					<div class="col-md-8">
						<br>
						<center>
							<h4 style="font-size: 20px;"><strong>5<sup>th</sup> International Conference on Recent Trends in Big Data and IoT
									<br>&</strong><br><strong style="font-size: 15px;">One day Pre Conference Seminar on "Social Impacts of Big Data and IOT
									Applications"</strong></h4>
							<h5>Organised by</h5>
							<!-- <h5 style="font-family: 'Monotype Corsiva';" id="paddown">We Make You Shine</h5> -->
							<h4 id="paddown"><strong>St.Joseph’s Institute of Technology, Chennai, India</strong></h4>
							<h5 id="paddown"></h5>
						</center>
					</div>

					<div class="col-md-2">
						<br>
						<center><img src="img/unnamed2.png" alt="ICBRT-Logo" style="width:90%;"></center>
					</div>
				</div>
			</div>
			<hr style="margin-left: 0px;margin-right: 0px;">
			<div class="col-md-3" style="padding-left: 21px;padding-right: 0px;margin-left: 50px;" id="hideout">
				<br>
				<div class="row">
					<br>
					<div class="col-md-12">
						<h4>
							<center style="color: #236298;"><strong>In Association with</strong></center>
						</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<img src="img/logo/o3_o2.png" alt="" style="width: 280%; padding-bottom : 20px;">
					</div>
					<!-- <div class="col-md-5">
                          <img src="img/logo/o4.jpg" alt="" style="width: 100%">
                        </div> -->
					<!-- <div class="col-md-4">
                            <img src="img/logo/o2.jpg" alt="" style="width: 100%">
                          </div>        -->
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="d-flex justify-content-center">
							<h5 style="background-color:#236298; color: white; padding: 8px; border-radius: 6px;">Conference Date <time><strong>22<sup>nd</sup> to 24<sup>th</sup> July 2020</strong></time></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	</div>
	<br>

	<div class="container">
		<?php
		if (isset($_GET['msg'])) {
			$id = $_SESSION['mtxnid'];
			$message = $_GET['msg'];
			$payment_time = time();
			$ref = $_GET['msg'];
			$ref = json_decode($ref, true);
			$refID = $ref['refno'];
			if (strcmp($message, 'Transaction Failed') == 0) {
				$query = "UPDATE icrtbi_register set payment_status='failed' WHERE payment_id='$id'";
				$query_run = mysqli_query($con, $query);
		?>
				<div class="container">
					<div class="row">
						<div class="col-md-2">

						</div>
						<div class="col-md-8">
							<h1 style="background-color:red; padding:4px; border-radius:5px; text-align:center; color:whitesmoke;">Payment Failed</h1>
							<a href="http://icrtbi2020.stjosephstechnology.ac.in/register.php" style="color:white;">Try Again</a>
						</div>
					</div>
				</div>

			<?php
			} else {
				$query = "UPDATE icrtbi_register set payment_status='success',payment_time='$payment_time' WHERE payment_id='$id'";
				$query_run = mysqli_query($con, $query);
				$query_1 = "SELECT * FROM icrtbi_register WHERE payment_id='$id' AND payment_status='success'"; //Fetch the data from Local DB
				$run_query = mysqli_query($con, $query_1);
				while ($row = mysqli_fetch_array($run_query)) {
					$paper_id = $row['paper_id'];
					$designation = $row['paper_title'];
					$institution = $row['org'];
				}

			?>
				<div class="container">
					<div class="row">
						<div class="col-md-2">

						</div>
						<div class="col-md-8" style="border-radius:3px;">
							<?php
							$query_1 = "SELECT * FROM icrtbi_register WHERE payment_id='$id' AND payment_status='success'"; //Fetch the data from Local DB
							$run_query = mysqli_query($con, $query_1);
							while ($row = mysqli_fetch_array($run_query)) {
								$paper_id = $row['paper_id'];
								$designation = $row['paper_title'];
								$institution = $row['org'];
								$payment = $row['payment_status'];
							}
							?>
							<h3>Payment Success</h3>
							<div class="table">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td>
												<strong>Your Ref Id :</strong>
											</td>
											<td>
												<?php echo $ref['refno']; ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Amount Paid :</strong>
											</td>
											<td>
												<?php echo $ref['amount']; ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Payment Status:</strong>
											</td>
											<td>
												<?php echo $payment; ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Paper ID:</strong>
											</td>
											<td>
												<?php echo $paper_id; ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Paper Title:</strong>
											</td>
											<td><?php echo $designation ?>
											</td>
										</tr>
										<tr>
											<td>
												<strong>Name of Instution:</strong>
											</td>
											<td>
												<?php echo $institution ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<h4>Certificate For:</h4>
							<div class="table">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Institution</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php
											if (mysqli_affected_rows($con) != 0) {
												$query_2 = "SELECT * FROM icrtbi_certificate,icrtbi_register WHERE icrtbi_register.certificate_num=icrtbi_certificate.certificate_num AND  icrtbi_register='$refID'"; //Query for Fetching the Certificates details
												$result = mysqli_query($con, $query_2);
												while ($row1 = mysqli_fetch_array($result)) {
													echo "<td>" . $row1['certi_names'] . "</td>";
													echo "<td>" . $row1['certi_inst'] . "</td>";
													echo "<tr>";
												}
											} else {
												echo "No Data Available!";
											} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>



		<?php }
		}

		?>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-9" style="background-color: #e6e0e0">
				<br>
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active btn btn-primary" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Online Payment Gateway (Credit Card / Debit Card)</a>
						<a class="nav-item nav-link btn btn-primary" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">NEFT / RTGS/ IMPS</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<br>
						<h4>Online Payment Gateway</h4>
						<form id="form_38599" class="appnitro" enctype="multipart/form-data" method="post" action="register.php">
							<div class="form-row">
								<div class="form-group col-md-12">
									<label for="inputEmail4">Paper ID (Easy Chair Paper ID)</label>
									<input type="text" class="form-control" id="element_0" name="element_0" placeholder="Paper" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Paper title</label>
									<input type="text" class="form-control" id="element_1" name="element_1" placeholder="Paper Title" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Corresponding Author Name</label>
									<input type="text" class="form-control" id="element_2" name="element_2" placeholder="Ex: John" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Corresponding Author Email</label>
									<input type="email" class="form-control" id="element_3" name="element_3" placeholder="Ex: example@gmail.com" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Corresponding Author Mobile</label>
									<input type="text" class="form-control" id="element_5" name="element_5" placeholder="Ex: +919898989898" maxlength="255" value="">
									<!-- <label for="inputPassword4">Affliation</label>
							<input type="text" class="form-control" id="element_5" name="element_9" placeholder="" maxlength="255" value="">
							<br> -->
									<br>
									<label for="inputPassword4">Name of Institution/ Organisation</label>
									<input type="text" class="form-control" id="element_4" name="element_4" placeholder="St. Joseph's Institute of Technology" maxlength="255" value="">
									<br>
									<!-- <label for="inputPassword4">Corresponding Author Mobile</label>
							<input type="text" class="form-control" id="element_5" name="element_5" placeholder="Ex: +919898989898" maxlength="255" value="">
							<br> -->
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

									<input type="checkbox" id="sem" name="sem" value="1">I would like to attend One Day Pre-Conference<br>
									<br>
									<label for="inputPassword4">Discount Coupon (Applies only for home institution)</label>
									<input type="text" name="element_9" class="form-control" placeholder="Enter Coupon Code">
									<br>
									<div class="field_wrapper">
										<div class="form-group">
											<label for="">Certificate</label><br>
											<input type="text" name="field_name[]" value="" placeholder="Applicant name" />
											<input type="text" name="college_name[]" placeholder="Institution Name">
											<a href="javascript:void(0);" class="add_button" title="Add field" onclick="check('hidden_div',this)"><i class="fa fa-plus" aria-hidden="true"></i></a>
										</div>
									</div>

									<br>
									<label for="inputPassword4">Price</label>
									<input type="number" name="element_10" class="form-control" id="hidden_div" value=6000 readonly>
									<input type="hidden" name="form_id" value="38599" />
									<br>
									<button type="submit" id="saveForm" name="submit" value="Payment" class="btn btn-primary">Register</button>

								</div>
							</div>

						</form>

					</div>
					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<br>
						<h4>NEFT / RTGS/ IMPS</h4>
						<form id="form_38599" class="appnitro" enctype="multipart/form-data" method="post" action="register.php">
							<div class="form-row">
								<div class="form-group col-md-12">

									<label for="inputEmail4">Paper ID (Easy Chair Paper ID)</label>
									<input type="text" class="form-control" id="element_0" name="element_0" placeholder="Paper" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Paper title</label>
									<input type="text" class="form-control" id="element_1" name="element_1" placeholder="Paper Title" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Corresponding Author Name</label>
									<input type="text" class="form-control" id="element_2" name="element_2" placeholder="Ex: John" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Corresponding Author Email</label>
									<input type="email" class="form-control" id="element_3" name="element_3" placeholder="Ex: example@gmail.com" maxlength="255" value="">
									<br>
									<label for="inputPassword4">Corresponding Author Mobile</label>
									<input type="text" class="form-control" id="element_5" name="element_5" placeholder="Ex: +919898989898" maxlength="255" value="">
									<!-- <label for="inputPassword4">Affliation</label>
							<input type="text" class="form-control" id="element_5" name="element_9" placeholder="" maxlength="255" value="">
							<br> -->
									<br>
									<label for="inputPassword4">Name of Institution/ Organisation</label>
									<input type="text" class="form-control" id="element_4" name="element_4" placeholder="St. Joseph's Institute of Technology" maxlength="255" value="">
									<br>
									<!-- <label for="inputPassword4">Corresponding Author Mobile</label>
							<input type="text" class="form-control" id="element_5" name="element_5" placeholder="Ex: +919898989898" maxlength="255" value="">
							<br> -->
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

									<input type="checkbox" id="sem" name="sem" value="1">I would like to attend One Day Pre-Conference<br>
									<br>
									<label for="inputPassword4">Discount Coupon (Applies only for home institution)</label>
									<input type="text" name="element_9" class="form-control" placeholder="Enter Coupon Code">
									<br>
									<div class="field_wrapper">
										<div class="form-group">
											<label for="">Certificate</label><br>
											<input type="text" name="field_name[]" value="" placeholder="Applicant name" />
											<input type="text" name="college_name[]" placeholder="Institution Name">
											<a href="javascript:void(0);" class="add_button" title="Add field" onclick="check('hidden_div',this)"><i class="fa fa-plus" aria-hidden="true"></i></a>
										</div>
									</div>

									<br>
									<label for="inputPassword4">Price</label>
									<input type="number" name="element_10" class="form-control" id="hidden_div" value=6000 readonly>
									<input type="hidden" name="form_id" value="38599" />
									<br>
									<p style="color: red">Kindly transfer the above mentioned amount in the following account:</p>
									<br>
									<p>
										Account Number: 6493994370 <br>
										Name of Account: ST.JOSEPH&#39;S INSTITUTE OF TECHNOLOGY-RESEARCH AND DEVELOPMENT <br>
										Branch: JEPPIAAR ENGINEERINGCOLLEGE SEMMENCHERR CHENNAI <br>
										IFSC Code: IDIB000J037</p>
									<br>
									<label for="nift-payment-date" id="nift">Date of Payment</label>
									<input type="date" class="form-control" id="nift" style="width: 200px" name="nift-payment-date">
									<br>
									<label for="nift-bank" id="nift">Bank & Branch</label>
									<input type="text" id="nift" placeholder="INDIAN BANK,JEPPIAAR ENGINEERINGCOLLEGE SEMMENCHERR CHENNAI" name="nift-bank" class="form-control">
									<br>
									<label for="nift-ref" id="nift">Ref.no</label>
									<input type="text" id="nift" placeholder="Ref. Number" class="form-control" name="nift-ref">
									<br>
									<label id="nift" for="nift-amount">Amount Paid</label>
									<input id="nift" type="text" placeholder="RS.6000" class="form-control" name="nift-amount">
									<br>
									<button type="submit" id="saveForm" name="submit" value="NIRF" class="btn btn-primary">Register</button>
								</div>


							</div>
					</div>

					</form>
				</div>
			</div>

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

</div>
<script type="text/javascript">
	function showDiv(divId, element) {
		var amount = [6000, 6500, 7000, 1500];
		document.getElementById(divId).value = element.value == 1 ? 0 : amount[element.value - 1];
		document.getElementById(divId).value = element.value == 2 ? 0 : amount[element.value - 1];
		document.getElementById(divId).value = element.value == 3 ? 0 : amount[element.value - 1];
		document.getElementById(divId).value = element.value == 4 ? 0 : amount[element.value - 1];
		var number = document.getElementById(divId).value = element.value == 4 ? 1500 : amount[element.value - 1];
	}
	var count = 5,
		i = 0;

	function check(divId, element) {
		if (i < count) {
			var amt = parseInt(document.getElementById(divId).value);
			document.getElementById(divId).value = amt + 300;
			console.log(amt);
			i++;
		}

	}

	function check_minus() {
		var amt = parseInt(document.getElementById('hidden_div').value);
		document.getElementById('hidden_div').value = amt - 300;

		if (i == 0) {
			i = i;
		} else
			i--;

	}

	$(document).ready(function() {
		var maxField = 5; //Input fields increment limitation
		var addButton = $('.add_button'); //Add button selector
		var wrapper = $('.field_wrapper'); //Input field wrapper 
		var fieldHTML = '<div><input placeholder="Name" type="text" name="field_name[]" value=""/>	<input type="text" name="college_name[]" placeholder="Institution Name"><a href="javascript:void(0);"  class="remove_button" onclick="check_minus()"><i class="fa fa-minus"  aria-hidden="true" style="padding:5px;"></i></a></div>'; //New input field html 
		var x = 1; //Initial field counter is 1

		//Once add button is clicked
		$(addButton).click(function() {
			//Check maximum number of input fields

			if (x < maxField) {
				x++; //Increment field counter
				$(wrapper).append(fieldHTML); //Add field html
			}

		});

		//Once remove button is clicked
		$(wrapper).on('click', '.remove_button', function(e) {
			e.preventDefault();
			$(this).parent('div').remove(); //Remove field html
			x--; //Decrement field counter
		});

		console.log(x);
	});
</script>
</body>

</html>