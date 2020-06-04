<?php
if(isset($_POST['Submit']))
{
$name          = $_POST['name'];
$mobile         = $_POST['mobile'];
$email       = $_POST['email'];
$admission = $_POST['admission'];
$ug = $_POST[UG];
$pg = $_POST['PG'];
$cmark       = $_POST['cmark'];
$address       = $_POST['address'];
$message       = $_POST['message'];

 
$mail="stjosephstechnology@stjosephstechnoloy.ac.in,website@stjosephstechnology.ac.in,admission@stjosephstechnology.ac.in";

$Msg = '<table width="865" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td></td>
  </tr>
 
  <tr>
    <td>Admission From St Josephs Institute Of Technology</td>
  </tr>
 
   <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Name: '.$name.'</td>
  </tr>   
   <tr>
    <td>Mobile: '.$mobile.'</td>
  </tr>
  </tr>   
   <tr>
    <td>Email: '.$email.'</td>
  </tr>
<tr>
    <td>Admission For : '.$admission.' </td>
  </tr>
   <tr>
   <tr>
   
   
    <td>Courses Prefered : '.$ug.'<br>'.$pg.'</td>
  </tr>
 </tr>   
   <tr>
    <td>Cutoff Mark: '.$cmark.'</td>
  </tr>
  
  </tr>   
   <tr>
    <td>Address: '.$address.'</td>
  </tr>
   <tr>
    <td>Message: '.$message.'</td>
  </tr>
      <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>Yours sincerely,<br />
St. Josephs Institute Of Technology - India<br />
http://www.stjosephstechnology.ac.in</td>
  </tr>
</table>';


//echo $mailformat;

//$mailheaders = "Content-type: text/html; charset=iso-8859-1\r\n";
$headers    = "Content-Type: text/html; charset=iso-8859-1\r\n";

$Subjectnew    = "Admission from St Josephs Institute of Technology";

$autoTo = "$email";
$autoreply = "Thanks for your submission! Our Representative will contact you soon. "; //change this to your message

if(mail($mail,$Subjectnew,$Msg,$headers))
{



mail($autoTo, "Auto reply from St Josephs Institute of Technology", $autoreply, 'From: noreply@dstjosephstechnology.ac.in');
    
$Flug = "success";


}    
}
?>
<!doctype html>
<html class="no-js" lang="">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admission - St.Joseph's Institute of Technology</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon (1).png">
    
    <!-- Custom Fonts -->
        <link href="css/fonts.css" rel="stylesheet">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/OwlCarousel/owl.theme.default.min.css">
    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- nivo slider CSS -->
    <link rel="stylesheet" href="vendor/slider/css/nivo-slider.css" type="text/css" />
    <link rel="stylesheet" href="vendor/slider/css/preview.css" type="text/css" media="screen" />
    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <!-- Magic popup CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css/hover-min.css">
    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css/reImageGrid.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="css/ticker.css" rel="stylesheet" type="text/css" media="all" />

    <!-- ticker js -->
  <script src = "js/ticker.js"></script>
    <!-- Modernizr Js -->
    <script src="js/modernizr-2.8.3.min.js"></script>
    
    <script language="JavaScript" type="text/JavaScript">
function  contnew_validate(){

if(document.contactnew.name.value == "")
{
alert("Please enter the name:");
document.contactnew.name.focus();
return false;
}

if(document.contactnew.mobile.value == "")
{
alert("Please enter the Mobile Number:");
document.contactnew.mobile.focus();
return false;
}


if (!validateEmail(document.contactnew.email.value,1,1)) 
    {
        
        document.contactnew.email.focus();
        return false;
    }
    
    



if(document.contactnew.message.value == "")
{
alert("Please enter the message:");
document.contactnew.message.focus();
return false;
}
return true;
}

function validateEmail(addr,man,db) {
    if (addr == '' && man) {
       if (db) alert('Email Address Is Mandatory');
       return false;
    }
    var invalidChars = '\/\'\\ ";:?!()[]\   {\}^|';
    for (i=0; i<invalidChars.length; i++) {
       if (addr.indexOf(invalidChars.charAt(i),0) > -1) {
          if (db) alert('Email Address Contains Invalid Characters');
          return false;
       }
    }
    for (i=0; i<addr.length; i++) {
       if (addr.charCodeAt(i)>127) {
          if (db) alert("Email Address Contains Non Ascii Characters.");
          return false;
       }
    }

    var atPos = addr.indexOf('@',0);
    if (atPos == -1) {
       if (db) alert('Email Address Must Contain An @');
       return false;
    }
    if (atPos == 0) {
       if (db) alert('Email Address Must Not Start With @');
       return false;
    }
    if (addr.indexOf('@', atPos + 1) > - 1) {
       if (db) alert('Email Address Must Contain Only One @');
       return false;
    }
    if (addr.indexOf('.', atPos) == -1) {
       if (db) alert('Email Address Must Contain A Period In The Domain Name');
       return false;
    }
    if (addr.indexOf('@.',0) != -1) {
       if (db) alert('Period Must Not Immediately Follow @ In Email Address');
       return false;
    }
    if (addr.indexOf('.@',0) != -1){
       if (db) alert('Period Must Not Immediately Precede @ In Email Address');
       return false;
    }
    if (addr.indexOf('..',0) != -1) {
       if (db) alert('Two Periods Must Not Be Adjacent In Email Address');
       return false;
    }
    var suffix = addr.substring(addr.lastIndexOf('.')+1);
    if (suffix.length != 2 && suffix != 'com' && suffix != 'net' && suffix != 'org' && suffix != 'edu' && suffix != 'int' && suffix != 'mil' && suffix != 'gov' & suffix != 'arpa' && suffix != 'biz' && suffix != 'aero' && suffix != 'name' && suffix != 'coop' && suffix != 'info' && suffix != 'pro' && suffix != 'museum') {
       if (db) alert('Invalid Primary Domain In Email Address');
       return false;
    }
return true;
}
</script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
  <div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header2" class="header4-area">
                <div class="header-top-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12">
                                <div class="header-top-left">
                                    <div class="logo-area">
                                        <a href="index.html"><img class="img-responsive" src="img/logo-new.png" alt="logo"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-9 col-xs-12">
                                <div class="header-top-right">
                                    <ul>
                                        <li><img src="img/nba-accreditation.png" width="320"></li>
                                        <!--<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#">info@academics.com</a></li>-->
                                        <li>
                                            <a class="apply-now-btn2" href="" id="login-button">Login Zone</a>
                                            <div class="login-form btn-4" id="login-form" style="display: none;">
                                                <div class="title-default-left-bold">Login Zone</div>
                                                <a href="https://portal.stjosephstechnology.ac.in" class="default-big-btn"  style="width:100%" target="_blank">Portal Login ( Parents / Student / Staff) </a>
                                                
                                                <a href="https://alumni.stjosephstechnology.ac.in" class="default-big-btn bt2" target="_blank">Alumni Portal Login</a>
                                                <a href="http://mail.stjosephstechnology.ac.in" class="default-big-btn bt3" target="_blank">Mail Login</a>
                                                 
                                            </div>
                                        </li>
                                        <!--<li><a href="#" class="apply-now-btn2">Login Zone</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primary" id="sticker">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <nav id="desktop-nav">
                                    <ul>
                                        <li class="active"><a href="index.html">Home</a> </li>
                                         <li class=""><a href="aboutus.html">About Us</a> </li>                                         
                                         <li><a href="#">Courses</a>
                                            <ul>
                                                <li class="has-child-menu"><a href="cse/index.php"><img src="img/cse.png" style="width:30px;"> Department of CSE</a>
                                                    <ul class="thired-level">
                                                        <li><a href="cse/index.php">B. E. - Computer Science and Engineering</a></li>
                                                      </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="ece_new/index.php"><img src="img/ece.png" style="width:30px;"> Department of ECE</a>
                                                    <ul class="thired-level">
                                                        <li><a href="ece_new/index.php">B. E. – Electronics and Communication Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="eee/index.html"><img src="img/eee.png" style="width:30px;"> Department of EEE</a>
                                                    <ul class="thired-level">
                                                        <li><a href="eee/index.html">B.E – Electrical and Electronics Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>                                                
                                                <li class="has-child-menu"><a href="mech/index.php"><img src="img/mechlogo.gif" style="width:40px; float:left; padding-bottom:30px; padding-right:5px;"> Department of Mechanical Engineering</a>
                                                    <ul class="thired-level">
                                                        <li><a href="mech/index.php">B.E. – Mechanical Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="civil/index.php"><img src="img/civil.png" style="width:40px;float:left;  padding-bottom:30px; padding-right:5px;"> Department of Civil <br>Engineering</a>
                                                    <ul class="thired-level">
                                                        <li><a href="civil/index.php">B. E. – Civil Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>
                                                
                                                <li class="has-child-menu"><a href="it/index.php"><img src="img/it.png" style="width:40px;float:left;  padding-bottom:30px; padding-right:5px;"> Department of Information Technology</a>
                                                    <ul class="thired-level">
                                                        <li><a href="it/index.php">B. Tech. – Information Technology</a></li>
                                                        
                                                    </ul>
                                                </li>                                                
                                                   
                                                <li class=""><a href="sh/index.html"><img src="img/sh.png" style="width:40px;float:left;  padding-bottom:30px; padding-right:5px;"> Department of S&H</a>
                                                    
                                                </li>  
                                               </ul>
                                        </li>                                         
                                       
                                        <li class=""><a href="#">Campus Life</a>
                                            <ul>
                                                <li><a href="infrastruce.html">Infrastructure</a></li>
                                                <li><a href="clibrary.html">Central Library & Book Bank</a></li>
                                                <li><a href="mess.html">Cafeteria & Mess Zone</a></li>
                                                 <li><a href="amenities.html">Amenities and Services</a></li>
                                                
                                              <li class="has-child-menu"><a href="#">Student Activities</a>
                                                    <ul class="thired-level">
                                                        <li><a href="ngo-visit.html">NGO Visit</a></li>
                                                        <li><a href="ieee/index.html">IEEE Student's Chapter</a></li>
                                                        <li><a href="edcell/index.html">EDC</a></li>
                                                        <li><a href="nss.html">NSS and YRC</a></li>
                                                        <li><a href="club-activites.html">Club Activities</a></li>
                                                    </ul>
                                                </li>
                                                
                                                
                                            </ul>
                                        </li>
                                          <li><a href="placements.html">Placements</a> </li>
                                             <li><a href="abhs.html">ABHS</a> </li>
                                        
                                        
                                        <li><a href="#">R & D</a>
                                            <ul>
                                                <li><a href="research-board.html">Research Advisory Board</a></li>
                                                <li><a href="funded-project.html">Funded Projects &amp; Consultancy work</a></li>
                                                <li><a href="journal-publication.html">Journal Publication</a></li>
                                                 <li><a href="mou.html">Memorandum of Understanding</a></li>
                                                
                                              
                                                
                                                
                                            </ul>
                                        </li>
                                      
                                         <li><a href="#">Academy</a>
                                            <ul><li><a href="civil-service.html">St. Joseph's Civil Services Academy </a></li>
                                                <li><a href="defense-academy.html">St. Joseph's Defence Academy</a></li>
                                                <li><a href="sports-academy.html">St. Joseph's Sports Academy </a></li>
                                               
                                            </ul>
                                        </li>
                                     <li><a href="#">Sports</a>
                                             <ul>
                                                <li><a href="facilities.html"> Facilities</a></li>
                                                <li><a href="achievements.html">Achievements</a></li>
                                               
                                                
                                                
                                            </ul>
                                        </li>
                                        <li><a href="feedback.php">Feedback</a> </li>
                                        <li><a href="contact.php">Contact</a> </li>
                                    </ul>
                                </nav>
                            </div>
                            <!--<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                                <div class="header-search">
                                    <form>
                                        <input type="text" class="search-form" placeholder="Search...." required="">
                                        <a href="#" class="search-button" id="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </form>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                    <li class="active"><a href="index.html">Home</a> </li>
                                         <li class=""><a href="aboutus.html">About Us</a> </li>                                         
                                         <li><a href="#">Courses</a>
                                            <ul>
                                                <li class="has-child-menu"><a href="cse/index.php"><img src="img/cse.png" style="width:30px;"> Department of CSE</a>
                                                    <ul class="thired-level">
                                                        <li><a href="cse/index.php">B. E. - Computer Science and Engineering</a></li>
                                                      </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="ece_new/index.php"><img src="img/ece.png" style="width:30px;"> Department of ECE</a>
                                                    <ul class="thired-level">
                                                        <li><a href="ece_new/index.php">B. E. – Electronics and Communication Engineering</a></li>
                                                     
                                                    </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="eee/index.html"><img src="img/eee.png" style="width:30px;"> Department of EEE</a>
                                                    <ul class="thired-level">
                                                        <li><a href="eee/index.html">B.E – Electrical and Electronics Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>                                                
                                                <li class="has-child-menu"><a href="mech/index.php"><img src="img/mechlogo.gif" style="width:40px; float:left; padding-right:5px;"> Department of Mechanical Engineering</a>
                                                    <ul class="thired-level">
                                                        <li><a href="mech/index.php">B.E. – Mechanical Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>
                                                <li class="has-child-menu"><a href="civil/index.php"><img src="img/civil.png" style="width:40px;float:left; padding-right:5px;"> Department of Civil <br>Engineering</a>
                                                    <ul class="thired-level">
                                                        <li><a href="civil/index.php">B. E. – Civil Engineering</a></li>
                                                        
                                                    </ul>
                                                </li>
                                                
                                                <li class="has-child-menu"><a href=""><img src="img/it.png" style="width:40px;float:left; padding-right:5px;"> Department of Information Technology</a>
                                                    <ul class="thired-level">
                                                        <li><a href="it/index.php">B. Tech. – Information Technology</a></li>
                                                        
                                                    </ul>
                                                </li>                                                
                                                   
                                                <li class=""><a href="sh/index.html"><img src="img/sh.png" style="width:40px;float:left; padding-right:5px;"> Department of S&H</a>
                                                    
                                                </li>  
                                               </ul>
                                        </li>                                         
                                       
                                        <li class=""><a href="#">Campus Life</a>
                                            <ul>
                                                <li><a href="infrastruce.html">Infrastructure</a></li>
                                                <li><a href="clibrary.html">Central Library & Book Bank</a></li>
                                                <li><a href="mess.html">Cafeteria & Mess Zone</a></li>
                                                 <li><a href="amenities.html">Amenities and Services</a></li>
                                                
                                              <li class="has-child-menu"><a href="#">Student Activities</a>
                                                    <ul class="thired-level">
                                                        <li><a href="ngo-visit.html">NGO Visit</a></li>
                                                        <li><a href="ieee/index.html">IEEE Student's Chapter</a></li>
                                                        <li><a href="edcell/index.html">EDC</a></li>
                                                        <li><a href="nss.html">NSS and YRC</a></li>
                                                        <li><a href="club-activites.html">Club Activities</a></li>
                                                    </ul>
                                                </li>
                                                
                                                
                                            </ul>
                                        </li>
                                          <li><a href="placements.html">Placements</a> </li>
                                             <li><a href="abhs.html">ABHS</a> </li>
                                        
                                        
                                        <li><a href="#">R & D</a>
                                            <ul>
                                                <li><a href="research-board.html">Research Advisory Board</a></li>
                                                <li><a href="funded-project.html">Funded Projects &amp; Consultancy work</a></li>
                                                <li><a href="journal-publication.html">Journal Publication</a></li>
                                                 <li><a href="mou.html">Memorandum of Understanding</a></li>
                                                
                                              
                                                
                                                
                                            </ul>
                                        </li>
                                      
                                         <li><a href="#">Academy</a>
                                            <ul><li><a href="civil-service.html">St. Joseph's Civil Services Academy </a></li>
                                                <li><a href="defense-academy.html">St. Joseph's Defence Academy</a></li>
                                                <li><a href="sports-academy.html">St. Joseph's Sports Academy </a></li>
                                               
                                            </ul>
                                        </li>
                                     <li><a href="#">Sports</a>
                                             <ul>
                                                <li><a href="facilities.html"> Facilities</a></li>
                                                <li><a href="achievements.html">Achievements</a></li>
                                               
                                                
                                                
                                            </ul>
                                        </li>
                                        <li><a href="feedback.php">Feedback</a> </li>
                                        <li><a href="contact.php">Contact</a> </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>
        <!-- Header Area End Here --> <div class="ticker-container">
        <div class="ticker-caption">
          <p>LATEST NEWS</p>
        </div>
        <ul>
          <div class="ticker-active">
            <a href="http://www.stjosephstechnology.ac.in/web/uploads/circulars/2019_2020/InfrastructreBrochure%202019-20.pdf" target=""> Click here to view Infrastructre Brochure </a> 
          </div>
          <div class="not-active">
           <a href="http://www.stjosephstechnology.ac.in/web/uploads/circulars/2019_2020/RR-2019.pdf"> Click here to view Rules & Regulation 2019 </a> 
          </div>
          <div class="not-active">
           <a href="http://www.stjosephstechnology.ac.in/web/uploads/circulars/2018_2019/I year Orientation schedule and Important details.pdf"> Click here to view First year Orientation schedule and Important details  </a> 
          </div>
          <div class="not-active">
          <a title="" href="http://www.stjosephstechnology.ac.in/web/uploads/circulars/2018_2019/NEET EXAM.pdf" target="_blank" > Neet Exam circular  </a>
          </div>
          </ul>
          <a type="button" class="btn btn-danger btn1" href="admission.php"><b>Admission 2020</b></a>
          </div>
        
          
          
          <div class="inner-page-banner-area" style="background-image: url('img/banner/admission.jpg');">
            <div class="container">
                <div class="pagination-area">
                    <h1>Admission</h1>
                    <ul>
                        <li><a href="index.html">Home</a> -</li>
                        <li>Admission</li>
                    </ul>
                </div>
            </div>
        </div>
                 <!--<div class="inner-banner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-lg-9">
                        <div class="content">
                            <h1>About Us</h1>
                            <p>We Make You Shine</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>-->
        
        <div class="about-page1-area ">
            <div class="container">
                <div class="row about-page1-inner">
                <div class="col-lg-12 text-center">
       <br><br>
                </div>
                <div class="clearfix"></div>
              
                   <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="title-default-left title-bar-high">Submit your Feedbcak</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="contact-form2">
                                <?php
if($Flug == "success")
{
?>
  <span style="color:red;" >Your mail has been sent successfully.<br></span>
  <?php } ?>
  
                                  
<script id="rendered-js">
      $(function () {
  $('#colorselector').change(function () {
    $('.colors').hide();
    $('#' + $(this).val()).show();
  });
});
// [forked from](http://jsfiddle.net/FvMYz/)
// [show-hide-based-on-select-option-jquery)(http://stackoverflow.com/questions/2975521/show-hide-div-based-on-select-option-jquery/2975565#2975565)
      //# sourceURL=pen.js
    </script>
  
  <h3>Submit Enquiry</h3>
                                <form name="contactnew" action="admission.php" method="post"  onsubmit="return contnew_validate();" >
                                    <fieldset>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="Name*" class="form-control" name="name" id="form-name" data-error="Name field is required" required="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="mobile" placeholder="Mobile Number*" class="form-control" name="mobile" id="form-email" data-error="Email field is required" required="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="email" placeholder="Email Address" class="form-control" name="email" id="form-email" data-error="Email field is required" required="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-sm-12">
                                      
                                            <div class="form-group">
                                            <select name="admission" class="form-control" id="colorselector">
                                            <option value="">Admission for</option>
                                            
                  <option value="UG">UG</option>
                <!--  <option value="PG">PG</option> -->
                  
              </select>
                                            
                                            </div>
                                            </div>
                                            
                                            <div class="output">
                                             <div class=" ">
                                       
                                            <div id="UG" class="colors form-group"  style="display:none;">
                                            <select name="UG" class="form-control" multiple="multiple">
                                             <option value="">Select Courses</option> 
                  <option value="B. E. – Computer Science and Engineering">B. E. – Computer Science and Engineering </option>
                  <option value="B.E. – Electronics and Communication and Engineering">B.E. – Electronics and Communication and Engineering </option>
                  <option value="B.E. – Electrical and Electronics Engineering">B.E. – Electrical and Electronics Engineering </option>
                  <option value="B.E. – Mechanical Engineeing">B.E. – Mechanical Engineeing </option>
                  <option value="B.E.- Civil Engineering">B.E.- Civil Engineering </option>
                  <option value="B. Tech – Information Technology">B. Tech – Information Technology</option>
                 
                  
              </select>
                                            
                                            </div>
                                            
                                            <div id="PG" class="colors form-group"  style="display:none;">
                                            <select name="PG" class="form-control">
                                            <option value="">Select Courses</option>
                  <option value="M.E. – Communication and Networking">M.E. – Communication and Networking</option>
               
                  
              </select>
                                            
                                            </div>
                                            </div>    
                                            
                                            
                                             
                                        
                                               </div>                                 
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="number" placeholder="Cutoff Mark *" class="form-control" name="cmark" id="form-email" data-error="Cutoff Mark is required" required="">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea placeholder="Address*" class="textarea form-control" name="address" id="form-message" rows="4" cols="20" data-error="Address field is required" required=""></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea placeholder="Message*" class="textarea form-control" name="message" id="form-message" rows="4" cols="20" data-error="Message field is required" required=""></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-sm-12">
                                            <div class="form-group margin-bottom-none">
                                                <button type="submit" name="Submit" value="Submit" class="default-big-btn disabled">Send Message</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-6 col-sm-12">
                                            <div class="form-response"></div>
                                        </div>
                                    </fieldset>
                                </form>
                                <br><bR><br>
                                
                                


                                
                                
                                
                            </div>
                        </div>
                    </div> 
                    
                    
                      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    
                    
                    
                    <table border="1" cellspacing="0" cellpadding="0" class="table table-bordered table-responsive text-center" width="500">
  <tbody><tr>
    <td width="" colspan="3" valign="top"><strong>UG Courses</strong></td>
  </tr>
  <tr>
    <td width="" valign="top">S.No</td>
    <td width="" valign="top" class="text-left">Department</td>
    <td width="" valign="top">Intake</td>
  </tr>
  <tr>
    <td width="" valign="top">1</td>
    <td width="" valign="top" class="text-left">B.E. - &nbsp;Computer Science and Engineering </td>
    <td width="" valign="top">180 </td>
  </tr>
  <tr>
    <td width="" valign="top">2</td>
    <td width="" valign="top" class="text-left">B.E. -&nbsp;    Electronics &amp; Communication Engineering </td>
    <td width="" valign="top">180  </td>
  </tr>
  <tr>
    <td width="" valign="top">3</td>
    <td width="" valign="top" class="text-left">B.E. - Electrical &amp; Electronics    Engineering </td>
    <td width="" valign="top">60  </td>
  </tr>
  <tr>
    <td width="" valign="top">4</td>
    <td width="" valign="top" class="text-left">B.E. - Mechanical Engineering </td>
    <td width="" valign="top">120  </td>
  </tr>
  <tr>
    <td width="" valign="top">5</td>
    <td width="" valign="top" class="text-left">B.Tech. - Information    Technology </td>
    <td width="" valign="top">120 </td>
  </tr>
  <tr>
    <td width="" valign="top">6</td>
    <td width="" valign="top" class="text-left">B.E. - Civil    Engineering </td>
    <td width="" valign="top">30 </td>
  </tr>

</tbody></table>
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
        </div>
        
        

        
        
        
        
        
       
    
       
       
        
        <!-- Footer Area Start Here -->
        <footer>
            <div class="footer-area-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                            <div class="footer-box">
                                <a href="index.html"><img class="img-responsive" src="img/f-logo.png" alt="logo"></a>
                                <div class="footer-about">
                                    <p>At St. Joseph's we live by our holy grail which is to provide students with the best of all the resources and skills they need to clinch the dream job of theirs. How do we do this? We build a victory road to reach their career by focusing on the 3S – Survival, Sustainability and Success.

</p>
                                </div>
                                <!--<ul class="footer-social">
                                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                </ul>-->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-box">
                                <h3>Featured Links</h3>
                                <ul class="featured-links">
                                    <li>
                                        <ul>
                                            <li><a href="infrastruce.html">Infrastructure </a></li>
                                            <li><a href="our-gallery.html">Gallery</a></li>
                                            <li><a href="achievements.html">Achievements</a></li>
                                            <li><a href="#">ABHS</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><a href="placements.html">Placement</a></li>
                                             <li><a href="video-gallery.html">Video Gallery</a></li>
                                            <li><a href="feedback.php">Feedback</a></li>
                                            <li><a href="news.html">Paper News</a></li>
                                          
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-box">
                                <h3>Contact Us:</h3>
                                <ul class="corporate-address">
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> Old Mamallapuram Road, Semmancheri,	Chennai, Tamil Nadu 600119</li>
                                    <li><i class="fa fa-phone" aria-hidden="true"></i><a href="Phone:044 2450 3132"> 044 2450 3132</a></li>
                                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i>stjosephstechnology@stjosephstechnoloy.ac.in</li>
                                </ul>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="footer-area-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <p>&copy; 2019 St Joseph's Institute of Technology All Rights Reserved. &nbsp; </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Area End Here -->
    </div>
    <!-- Main Body Area End Here -->
    <!-- jquery-->
    
    
    <script src="js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
   
    <!-- WOW JS -->
    <script src="js/wow.min.js"></script>
    <!-- Nivo slider js -->
    <script src="vendor/slider/js/jquery.nivo.slider.js" type="text/javascript"></script>
    <script src="vendor/slider/home.js" type="text/javascript"></script>
    <!-- Owl Cauosel JS -->
    <script src="vendor/OwlCarousel/owl.carousel.min.js" type="text/javascript"></script>
    <!-- Meanmenu Js -->
    <script src="js/jquery.meanmenu.min.js" type="text/javascript"></script>
    <!-- Srollup js -->
    <script src="js/jquery.scrollUp.min.js" type="text/javascript"></script>
    <!-- jquery.counterup js -->
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <!-- Countdown js -->
    <script src="js/jquery.countdown.min.js" type="text/javascript"></script>
    <!-- Isotope js -->
    <script src="js/isotope.pkgd.min.js" type="text/javascript"></script>
    <!-- Magic Popup js -->
    <script src="js/jquery.magnific-popup.min.js" type="text/javascript"></script>
    <!-- Gridrotator js -->
    <script src="js/jquery.gridrotator.js" type="text/javascript"></script>
    <script src="js/matchHeight-min.js" type="text/javascript"></script>
    
    
    <!-- Custom Js -->
    <script src="js/main.js" type="text/javascript"></script>
</body>


</html>
