<?

date_default_timezone_set('Asia/Manila');

 $now = date('Y-m-d h:i:s a', time());
$con2 = mysql_connect("localhost", "cddcf[,hcdfcdfFCTyTQ,");
if (!$con2) {
	die('Could not connect:' . mysql_error());
}
mysql_select_db("infinity_crm", $con2);
$page_title = "InfinityMeals: Thank you";
////////////////////////getting orders


if (!$_REQUEST['submit']){
 header('Location: http://www.infinitymeals.com/order_online/');
 }else{$counter = 50;

 for ($i=0; $i<$counter; $i++) { 
 $id[] = $_POST[id.$i];
 }
 
 for ($i=0; $i<$counter; $i++) { 
 $name[] = $_POST[name.$i];
 }
 
 for ($i=0; $i<$counter; $i++) { 
 $price[] = $_POST[price.$i];
 }
 
  for ($i=0; $i<$counter; $i++) { 
 $quantity[] = $_POST[quantity.$i];
 }
 
 /* print_r ($id)."orders tes<br>";
 print_r ($name)."orders tes<br>";
 print_r ($price)."orders tes<br>";
// echo $orders[]."orders tes echo";

*/


//////////////////sending to email
 if ($_POST[deliver_pickup] =="pickup")
	  {  $deliver = 0;
	  }else{
	    $deliver = $_POST[sub_total] * .10;
	  }
$ToEmail = 'info@infinitymeals.com,staff@laxa.ca,'.$_POST[email].''; 
$EmailSubject = 'Infinity Order form'; 
$mailheader = "From: Infinitymeals.com \r\n"; 
$mailheader .= "Reply-To: staff@laxa.ca\r\n"; 
$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

$MESSAGE_BODY .='<table width="605" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:1px #CCC solid;">

<tr>
<td>
<img src="http://www.infinitymeals.com/order_online_test/images/header.jpg"/>
</td>
</tr>

<tr>
<td>
<img src="http://www.infinitymeals.com/order_online_test/images/thankyou.jpg"/>
</td>
</tr>

<tr>
<td align="center">';

$MESSAGE_BODY .= "<strong>Name:</strong> ".$_POST["cust_name"]."<br/>"; 
$MESSAGE_BODY .= "<strong>Contact #:</strong> ".$_POST["phone_number"]."<br/>"; 
$MESSAGE_BODY .= "<strong>Email: </strong>".$_POST["email"]."<br/>"; 
$MESSAGE_BODY .= "<strong>Deliver or Pick up:</strong> ".$_POST["deliver_pickup"]."<br/>"; 
$MESSAGE_BODY .= "<strong>Address:</strong> ".$_POST["address"]."<br/>"; 
$MESSAGE_BODY .= "<strong>City:</strong> ".$_POST["city_town"]."<br/>"; 
$MESSAGE_BODY .= "<strong>Province:</strong> ".$_POST["province"]."<br/>"; 

$MESSAGE_BODY .= "<strong>Purchased Item(s)</strong>"."<br/><br/><br/>"; 

$MESSAGE_BODY .=  '<table border="1" cellpadding="5" width="500">
		<tr style="padding:5px;">
       <td><strong>Quantity</strong></td>
      <td><strong>Item</strong></td>
      <td><strong>Price</strong></td>
     </tr>';

for ($i=0; $i<$counter; $i++) { 

if ((empty($name[$i])) and (empty($price[$i]))) {
	}else{
		
		$MESSAGE_BODY .=  '<tr>';
		$MESSAGE_BODY .=   '<td>'.$quantity[$i].'</td>';
		$MESSAGE_BODY .=   '<td>'.$name[$i].'</td>';
		$MESSAGE_BODY .=   '<td>'.$price[$i].'</td>';
 }
 }
      $MESSAGE_BODY .= '</table>';
      $MESSAGE_BODY .= '<br/><br/><strong>Sub Total:</strong> Php. '.$_POST[sub_total].''.'<br/>';
      $MESSAGE_BODY .= '<strong>Delivery:</strong> Php. '.$deliver.''.'<br/>';  
	  $number= $_POST[sub_total] + $deliver;
	  $numbers = number_format($number, 2);
	  $MESSAGE_BODY .= '<strong>Total:</strong> Php.' .$numbers;  
	  $MESSAGE_BODY .= "<br/>If you haven't receive a phone call within next 5 to 10 minutes please contact us at 044 931 1864.<br/><br/><br/>";               
         
         

$MESSAGE_BODY .='</td>
</tr>

<tr>
<td>
<img src="http://www.infinitymeals.com/order_online_test/images/footer.jpg" border="0" usemap="#Map"/>
</td>
</tr>
</table>';



               



mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure"); 



//////////////////adding records to tables

 $query = "INSERT INTO im_orders_order (`order_id`,`user_id`,`first_name`,`last_name`,`contact_no`,`email`,`address`,`city_town`,`state_province`,`cost_delivery`,`cost_total`,`deliver_pickup`,`date_ordered`,`date_delivered`,`date_modified`,`date_stamp`)
VALUES ('','','".$_POST[cust_name]."','','".$_POST[phone_number]."','".$_POST[email]."','".$_POST[address]."','".$_POST[city_town]."','".$_POST[province]."','".$delivery."','".$_POST[sub_total]."','".$_POST[deliver_pickup]."','".$now."','','".$now."','".$now."')";

mysql_query($query);
//echo $query;

$query2 = "SELECT * FROM `im_orders_order` where `first_name` = '".$_POST[cust_name]."' AND `contact_no` = '".$_POST[phone_number]."' ORDER BY `date_ordered` desc";
$result = mysql_query($query2);

	while ($row = mysql_fetch_array($result)) {
	   $field = $row[order_id];
	}
	
	//echo $field;
	
	 for ($i=0; $i<$counter; $i++) { 
	 
	 if ((empty($name[$i])) and (empty($price[$i]))) {
	}else{
 $query3 = "INSERT INTO im_order_items_order (`order_item_id`,`im_orders_order_id`,`quantity`,`name`,`description`,`price`)

VALUES ('','".$field."','".$_POST[quantity.$i]."','".$_POST[name.$i]."','','".$_POST[price.$i]."')";
mysql_query($query3);	
	//echo $query3;
 }
	 }
	
	}

	
?>
 <!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]--><!--[if IE 8 ]><html class="ie8" lang="en"><![endif]--><!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
    <!--<![endif]-->
    <head>
        <title>InfinityMeals: A healthier alternative to your typical fast food.</title>
        <meta name="format-detection" content="telephone=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Seo Meta -->
        <meta name="description" content="">
        <meta name="keywords" content="">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="styles/font-awesome.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/prettyPhoto.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/owl.carousel.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/owl.theme.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="styles/animate.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
        <!-- Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,900,800,700,600,300,200,100,500' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,800' rel='stylesheet' type='text/css'>
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <!---CUFON FONT STYLE-->
        <script type="text/javascript" src="fonts/cufon-yui.js">
        </script>
        <script type="text/javascript" src="fonts/Kavaler_Kursive_italic_400.font.js">
        </script>
        <script type="text/javascript">
            
            Cufon.set('fontFamily', 'Kavaler Kursive');
            
            Cufon.replace('h1.title_banner', {
            
                hover: true
            
            });
        </script>
        <script type="text/javascript" src="fonts/cufon-yui.js">
        </script>
        <script type="text/javascript" src="fonts/Droid_Sans_700.font.js">
        </script>
        <script type="text/javascript">
            
            Cufon.set('fontFamily', 'Droid Sans');
            
            Cufon.replace('#button1, #button2, #button3, .nav-container ul, .extrabold, ul.contact-details, .footer-copyright, .im_am, li#phover, .di, .add_reach, .on', {
            
                hover: true
            
            });
        </script>
        <script type="text/javascript" src="fonts/cufon-yui.js">
        </script>
        <script type="text/javascript" src="fonts/Droid_Sans_400.font.js">
        </script>
        <script type="text/javascript">
            
            Cufon.set('fontFamily', 'Droid Sans');
            
            Cufon.replace('.extraregular, p.welcome_note, p.welcome_content, p.contact_infotxt, .im_menu_name, .im_category p, .im_menu_txt, .form_input, .im_q2', {
            
                hover: true
            
            });
        </script>
        <script type="text/javascript" src="fonts/cufon-yui.js">
        </script>
        <script type="text/javascript" src="fonts/Myriad_Pro_400.font.js">
        </script>
        <script type="text/javascript">
            
            Cufon.set('fontFamily', 'Myriad Pro');
            
            Cufon.replace('.im_p', {
            
                hover: true
            
            });
        </script>
    </head>
    <link rel="stylesheet" type="text/css" href="style_ordering.css" media="screen" />
    <link rel="stylesheet" id="woocommerce-smallscreen-css" href="css/woocommerce-smallscreen.css" type="text/css" media="only screen and (max-width: 768px)">
    <link rel="stylesheet" id="woocommerce-general-css" href="css/woocommerce.css" type="text/css" media="all">
    <body>
        <header id="header">
            <div id="logo" class="text-center animated" data-animation="fadeInUp" data-animation-delay="400">
                <a href="http://www.infinitymeals.com/"><img src="img/logo.png" alt="Logo"></a>
            </div><!-- end logo -->
            <div id="slideshow">
                <ul class="rslides">
                    <li style="background-image: url(images/im_os/banner.png);" class="img-responsive">
                        <img src="images/im_os/banner.png" alt="" class="img-responsive">
                        <div class="slideshow-caption">
                            <!--<h1>Best <span class="highlight">seafood</span> in town</h1>
                            <h3>Prepared by world famous cooks</h3>
                            <h1 class="title_banner">Healthy Meals Prepared and Delivered.</h1>
                            <div class="button" id="button2">
                            <a href="#">Make a reservation</a>-->
                        </div>
                        </div>
                        <!-- end .slideshow-caption -->
                    </li>
                    <!-- end .slideshow item -->
                </ul>
            </div>
            <!-- end slideshow -->
        </header>
        <!--<div class="im_os_nav">
        </div>-->
        <!--im_os_nav--><a href="#" class="scrollup"><i class="fa fa-angle-double-up"></i></a>
        <!-- end .scrollup -->
        <section id="welcome" class="welcome section">
            <div class="container" style="margin-top:0 !important;">
           <h3 style="background:none;margin-bottom:0 !important;text-align:center;"><?= $_POST[deliver_pickup] ?></h3>
            <!--category-->
            <div class="im_menu" style="float: none !important;width: 100% !important;text-align: center;">
            
               <h3 style="background:none;margin-bottom:0 !important;height: auto;"><img src="images/im_ty_img.png" alt="image"></h3>
             
                <strong>Name:</strong> <?= $_POST[cust_name] ?>
                <br/>
                <strong>Phone Number:</strong> <?= $_POST[phone_number] ?>
                <br/>
                <strong>Email:</strong> <?= $_POST[email] ?>
                <br/>
                <strong>Address:</strong> <?= $_POST[address] ?>
                <br/>
                <strong>City:</strong> <?= $_POST[city_town] ?>
                <br/>
      	           <strong>Province:</strong> <?= $_POST[province] ?>
                <br/>
                <h3 style="background:none;margin-bottom:0 !important;height: auto;padding-bottom: 20px;font-size: 18px;">Purchased Item(s)</h3>
              
           <table border="1" cellpadding="5" width="500" style="margin: 0 auto;text-align: left;">
		       <tr style="padding:5px;">
               <td style="padding:5px; background:#EAEAEA;"><strong>Quantity</strong></td>
               <td style="padding:5px; background:#EAEAEA;"><strong>Item</strong></td>
               <td style="padding:5px; background:#EAEAEA;"><strong>Price</strong></td>
               </tr>
               
               
                <?
for ($i=0; $i<$counter; $i++) { 

if ((empty($name[$i])) and (empty($price[$i]))) {
	}else{
		/* echo $name[$i].'price'. $price[$i] .'<br>';*/
		 echo '<tr style="padding:5px;">';
		 echo '<td style="padding:5px; ">'.$quantity[$i].'</td>';
		 echo '<td style="padding:5px; ">'.$name[$i].'</td>';
		 echo '<td style="padding:5px; ">'.$price[$i].'</td>';
		
 }
 
 }

                ?> </table>
               
               <br>


               <? if ($_POST[deliver_pickup] =="pickup"){ ?>
               
                Sub Total: 
                Php <?= $_POST[sub_total] ?><br/>	
                Delivery: 0
                <br/>
                Total: 
                <? $number= $_POST[sub_total];
				 
				echo 'Php '.number_format($number, 2);
				
			   ?>
              
              
               <? }else{?>
               
                 Sub Total: 
                Php. <?= $_POST[sub_total] ?><br/>	
                Delivery: Php. <?= $_POST[sub_total] * .10 ?>
                <br/>
                Total: 
                <? $number= $_POST[sub_total] + $_POST[sub_total] * .10;
				 
				echo 'Php '.number_format($number, 2);
				
			   }?>
               <br><br>

               <p style="font-size: 14px;"> If you haven't receive a phone call within next 5 to 10 minutes<Br>please contact us at <strong>044 931 1864</strong>.</p>
            </div>
           
            <!-- end .container -->
        </section>
        <footer id="footer">
            <div class="footer-container">
                <ul class="socials">
                    <li class="facebook">
                        <a href="https://www.facebook.com/infinitymeals" class="circle-icon" target="_blank"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="instagram">
                        <a href="https://instagram.com/infinitymeals/" class="circle-icon" target="_blank"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
                <h5 class="footer-copyright">
                © Copyright 2015 <span style="color:#C9FF25;">InfinityMeals</span>. All rights reserved</a>
            </h5>
            </div>
        </footer>
        <!-- Scripts -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="scripts/jquery-1.11.0.min.js?ver=1"></script>
        <![endif]-->
        <!--[if (gte IE 9) | (!IE)]><!-->
            <script type="text/javascript" src="scripts/jquery-2.1.0.min.js?ver=1">
            </script>
        <!--<![endif]-->
        <script src="scripts/jquery.easing.js">
        </script>
        <script type="text/javascript" src="scripts/jquery.prettyPhoto.js">
        </script>
        <script type="text/javascript" src="scripts/jquery.tools.min.js">
        </script>
        <script type="text/javascript" src="scripts/owl.carousel.min.js">
        </script>
        <script type="text/javascript" src="scripts/jquery.nav.js">
        </script>
        <script type="text/javascript" src="scripts/jquery.scrollTo.js">
        </script>
        <script type="text/javascript" src="scripts/jquery.sticky.js">
        </script>
        <script type="text/javascript" src="scripts/jquery.appear.js">
        </script>
        <script type="text/javascript" src="scripts/responsiveslides.min.js">
        </script>
        <script type="text/javascript" src="scripts/verge.min.js">
        </script>
        <script type="text/javascript" src="scripts/custom.js">
        </script>
        <!--POP UP IMAGE-->
        <script type="text/javascript" src="js/add-to-cart.min.js">
        </script>
        <script type="text/javascript" src="js/jquery.blockUI.min.js">
        </script>
        <script type="text/javascript">
            
            var woocommerce_params = {
            
                "ajax_url": "\/wp-admin\/admin-ajax.php"
            
            };
        </script>
        <script type="text/javascript" src="js/plugins.js">
        </script>
        <script type="text/javascript" src="js/script.js">
        </script>
        <!--POP UP IMAGE-->
    </body>
    
    
    

</html>
