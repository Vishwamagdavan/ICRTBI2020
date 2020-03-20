<?php

ob_start();

$strNo = time()+rand(1,1000000);

date_default_timezone_set('Asia/Calcutta');

//echo date_default_timezone_get();

$strCurDate = date('d-m-Y');

require_once 'TransactionRequestBean.php';
require_once 'TransactionResponseBean.php';

session_start();
$dbhost = 'localhost';
$dbuser = 'u460207256_pay';
$dbpass = 'pay123';
if($_GET && isset($_GET['submit'])){

  $val = $_GET;

  $_SESSION['key'] = "5874459521SRRHRM";
  $_SESSION['iv']   = "5313757151SEXMSL";
  $_SESSION['Name'] = $_GET['name'];
  $_SESSION['Amount'] = $_GET['amount'];
  $_SESSION['Purpose'] = $_GET['purpose'];
  
  
  if(isset($val['redirectURL']))
    $_SESSION['redirectURL']=$val['redirectURL'];

  $transactionRequestBean = new TransactionRequestBean();

    //Setting all values here
  $transactionRequestBean->setMerchantCode("L187757");
    // L187757
  $transactionRequestBean->setRequestType($val['reqType']);
  $transactionRequestBean->setMerchantTxnRefNumber($val['mrctTxtID']);
  $transactionRequestBean->setAmount($val['amount']);
  $transactionRequestBean->setCurrencyCode("INR");
  $transactionRequestBean->setReturnURL("https://".$_SERVER["HTTP_HOST"].$_SERVER['SCRIPT_NAME']);
  if ($val['user'] == 'ieee') {
    $reqDetails="Ieee_".$val['amount']."_0.0";
  } else {
    $reqDetails="Core_".$val['amount']."_0.0";
  }
  $transactionRequestBean->setShoppingCartDetails($reqDetails);
  $transactionRequestBean->setTxnDate($strCurDate);
  
  $transactionRequestBean->setCustId($val['custID']);

  $transactionRequestBean->setKey($_SESSION['key']);
  $transactionRequestBean->setIv($_SESSION['iv']);

  $transactionRequestBean->setWebServiceLocator("https://www.tpsl-india.in/PaymentGateway/TransactionDetailsNew.wsdl");


   // $url = $transactionRequestBean->getTransactionToken();

  $responseDetails = $transactionRequestBean->getTransactionToken();
  $responseDetails = (array)$responseDetails;


  $conn=mysqli_connect($dbhost,"u460207256_pay","pay123","u460207256_pay");

  if(! $conn ) {
    die('Could not connect: ' . mysqli_connect_error());
  } 
//   else {
//     echo "Connected Successfully";
//   }


  $sql = 'INSERT INTO techprocess '.
  '(sno,name,email, purpose,mobile,mrctTxtID) '.
  'VALUES ( null, "'.$val['custID'].'", "'.$val['email'].'","'.$val['purpose'].'","'.$val['mobile'].'" ,"'.$val['mrctTxtID'].'" )';

  if($val['reqType']=="T"){
//   mysql_select_db('u460207256_pay');
    $retval = mysqli_query( $conn, $sql );

    if(! $retval ) {
      die('Could not enter data: ' . mysqli_error());
    }

  // echo "Entered data successfully\n";

    mysqli_close($conn);
  }

  $response = $responseDetails[0];

  if(is_string($response) && preg_match('/^msg=/',$response)){
      
      
 
    $outputStr = str_replace('msg=', '', $response);
    $outputArr = explode('&', $outputStr);
    $str = $outputArr[0];

    $transactionResponseBean = new TransactionResponseBean();
    $transactionResponseBean->setResponsePayload($str);
    $transactionResponseBean->setKey($val['key']);
    $transactionResponseBean->setIv($val['iv']);

    $response = $transactionResponseBean->getResponsePayload();
    echo "<pre>";
    print_r($response);
    exit;
  }elseif(is_string($response) && preg_match('/^txn_status=/',$response)){
      
    echo "<pre>";
    print_r($response);
    exit;
  }

  echo "<script>window.location = '".$response."'</script>";
  ob_flush();

}else if($_POST){


  $response = $_POST;

  if(is_array($response)){
    $str = $response['msg'];
  }else if(is_string($response) && strstr($response, 'msg=')){
    $outputStr = str_replace('msg=', '', $response);
    $outputArr = explode('&', $outputStr);
    $str = $outputArr[0];
  }else {
    $str = $response;
  }

  $transactionResponseBean = new TransactionResponseBean();

  $transactionResponseBean->setResponsePayload($str);
  $transactionResponseBean->setKey($_SESSION['key']);
  $transactionResponseBean->setIv($_SESSION['iv']);
  $response = $transactionResponseBean->getResponsePayload();




  $conn=mysqli_connect($dbhost,"u460207256_pay","pay123","u460207256_pay");

   if(! $conn ) {
    die('Could not connect: ' . mysqli_connect_error());
  } 
//   else {
//     echo "Connected Successfully";
//   }

  $sql = 'UPDATE techprocess set ';


  echo "<pre>";



  $splited =  explode("|", $response);
   print_r($response);
     echo "\n\n";
     echo $splited[0][1];
     echo "\n\n";
  
  echo "PAYMENT DETAILS";
   echo "<br><br>";
   echo "Shri/Smt";
   echo $_SESSION['Name'];
   echo "paid a sum of Rs:";
   echo $val['amount'];
   echo "only for the purpose of";
   echo $val['purpose'];
   echo "with the following transaction details";
   echo "<br><br>";
   
   

  foreach ($splited as  $value) {
   print_r( explode('=',$value)[0].'   '.explode('=',$value)[1].'<br>'); 
   $sql=$sql.explode('=',$value)[0].'="'.explode('=',$value)[1].'",';   
   
   
   
   
   
 }

 $sql=  substr($sql, 0, -1);

 $sql=$sql.' where mrctTxtID="'.explode('=',$splited[3])[1].'"';
//  mysql_select_db('u460207256_pay');
 $retval = mysqli_query( $conn, $sql );

 if(! $retval ) {
  die('Could not enter data in post: ' . mysqli_error($conn));
}



mysqli_close($conn);

if(isset( $_SESSION['redirectURL'])){
  header("Location: ".$_SESSION['redirectURL']."?msg=".$response);
  die();
}


if(explode("=", $splited[0])[1]=='300')
  echo "<script>alert('Transaction Successful');</script>";
    //print_r($response);
    //exit;
echo "<br><br><br><br>";
session_destroy();?>

<a href='<?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER['SCRIPT_NAME'];?>'></a>

<?php
exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ICASISET 2020 | Register</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Conference project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	
	<!-- <link rel="stylesheet" type="text/css" href="styles/responsive.css"> -->
	<link rel="stylesheet" type="text/css" href="styles/speakers.css">
	<link rel="stylesheet" type="text/css" href="styles/speakers_responsive.css">
	<!-- <link rel="stylesheet" type="text/css" href="styles/main_styles.css"> -->
</head>
<body>

	<div class="super_container">

		<!-- Menu -->

		<div class="menu trans_500">
			<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
				<div class="menu_close_container"><div class="menu_close"></div></div>
				<div class="logo menu_logo">
					<a href="#">
						<div class="logo_container d-flex flex-row align-items-start justify-content-start">
							<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
							<div class="logo_content">
								<div class="logo_text logo_text_not_ie">ICASISET 2020</div>
								<div class="logo_sub">March 27<sup>th</sup> & 28<sup>th</sup>, 2020</div>
							</div>
						</div>
					</a>
				</div>
				
			</div>
		</div>

		<!-- Home -->

		<div class="home">
			<!-- <div class="home_background" style="background-image: url(images/index.jpg)"></div> -->
			<!-- 			<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/finalheaderlogo.png" data-speed="0.8"></div> -->

			
			<!--<img src = "images/finalheaderlogo.png">
			 Header -->

			<header class="header" id="header">

				<div>
					
					<div class="header_top">
						
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="header_top_content d-flex flex-row align-items-center justify-content-start">
										<div>
											<a href="index.html">
												<div class="logo_container d-flex flex-row align-items-start justify-content-start">
													<div class="logo_image"><div><img src="images/logo1.png" alt=""></div></div>
													<div class="logo_content">
														<div class="logo_text logo_text_not_ie">ICASISET 2020</div>
														<div class="logo_sub">March 27<sup>th</sup> & 28<sup>th</sup>, 2020</div>
													</div>
												</div>
											</a>	
										</div>
										<!-- <img src="images/bharathlogo.png" alt="" width="400" height="80" style="margin-left: 500px !important; margin-right: -50px !important;"> -->
										<div class="header_social ml-auto">
											<h3 style="font-size: 22px;"><strong> 3<sup>rd</sup> INTERNATIONAL CONFERENCE ON ADVANCED SCIENTIFIC <br> INNOVATION IN SCIENCE, ENGINEERING AND TECHNOLOGY 2020</strong></h3>
										</div>
										<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
									</div>
								</div>
							</div>

						</div>
						<img src = "images/finalheaderlogo.png" style="width: 100%; height: 127px;">
					</div>
				</div>
			<!-- <div class="home_content_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_content d-flex flex-row align-items-end justify-content-start">
								<div class="current_page">Committee</div>
								<div class="breadcrumbs ml-auto">
									<ul>
										<li><a href="committee.html">Home</a></li>
										<li>Committee</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		
						<div>
                            <form method="get">
                              <input type="hidden" name="reqType" value="T"/>
                              <input type="hidden" name="mrctTxtID" value="<?php echo $strNo; ?>"/>

                              <table width="300" height="263" cellspacing="0" cellpadding="0" border="0" align="left" class="formtable">
                                <tr>
                                  <td align="left"><span class="forminput"><b>Name</b><span style="color:red">*</span></span></td>
                                  <td align="left"><span class="forminput">
                                    <input type="text" name="custID" value=""/>
                                  </span></td>
                                </tr>
                                <tr>
                                  <td align="left"><span class="forminput"><b>Email</b><span style="color:red">*</span></span></td>
                                  <td align="left"><span class="forminput">
                                    <input type="text" name="email" value=""/>
                                  </span></td>
                                </tr>
                                <tr>
                                  <td align="left"><span class="forminput"><b>Mobile</b><span style="color:red">*</span></span></td>
                                  <td align="left"><span class="forminput">
                                    <input type="text" name="mobile" value=""/>
                                  </span></td>
                                </tr>
                                <tr>
                                  <td align="left"><span class="forminput"><b>Purpose</b><span style="color:red">*</span></span></td>
                                  <td align="left"><span class="forminput">
                                    <input type="text" name="purpose" value=""/>
                                  </span></td>
                                </tr>


                                <tr>
                                  <td align="left"><span class="forminput"><b>Amount</b><span style="color:red">*</span></span></td>
                                  <td align="left"><span class="forminput">
                                    <input type="text" name="amount" value="1.00"/>
                                  </span></td>
                                </tr>

                                <tr>
                                  <td align="left"><span class="forminput"></span></td>
                                  <td><span class="forminput"><a style="color: gray" href="terms.pdf">Terms & Conditions</a>
                                  </span></td>
                                </tr>

                                <tr>
                                  <td>&nbsp;</td>
                                  <td  valign="top">  <input type="submit" name="submit" value="Submit" class="submit">&nbsp;&nbsp;</td>
                                </tr>
                              </table>
                            </form>


                        </div>
                       
                      

	<!-- Footer

	<footer class="footer">

		<div class="footer_extra">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 footer_col" style="padding-top: 45px;">
						<div class="footer_about">
							<div>
								<a href="#">
									<div class="logo_container d-flex flex-row align-items-start justify-content-start">
										<div class="logo_image"><div><img src="images/logo1.png" alt=""></div></div>
										<div class="logo_content">
											<div id="logo_text" class="logo_text logo_text_not_ie">ICASISET 2020</div>
											<div class="logo_sub">March 27<sup>th</sup> & 28<sup>th</sup>, 2020</div>
										</div>
									</div>
								</a>	
							</div>
						</div>
					</div>
					<div class="col">
						<div class="footer_extra_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
							<div class="footer_extra_right ml-lg-auto text-lg-right">
								<div class="footer_extra_links">
									<ul>
										<li><a href="index.html">Home</a></li>
										<li><a href="">Register </a></li>
										<li><a href="https://easychair.org/conferences/?conf=icasiset2020"> Upload Paper</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div>
								<div class="copyright">
									Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | ICASISET 2020
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div> -->

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>