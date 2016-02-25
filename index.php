<?php
	

																													$con2 = mysql_connect("localhost", "infdficxfdfsdsgffdnity_crm", "H][,hdsfdsfdFCTyfdsfsdfdfdfafdsTQ,");
																													if (!$con2) {
																														die('Could not connect:' . mysql_error());
																													}
																													mysql_select_db("infinity_crm", $con2);
																													$page_title = "InfinityMeals: Order Details";
																													
																			
																									//phpTHUMB

$ServerInfo['gd_string']  = 'unknown';

$ServerInfo['gd_numeric'] = 0;
		
//ob_start();
if (!include_once('../phpThumb-master/phpthumb.functions.php')) {
	//ob_end_flush();
	die('failed to include_once("phpThumb-master/phpthumb.functions.php")');
}
if (!include_once('../phpThumb-master/phpthumb.class.php')) {
	//ob_end_flush();
	die('failed to include_once("phpThumb-master/phpthumb.class.php")');
}
//ob_end_clean();
$phpThumb = new phpThumb();
if (include_once('../phpThumb-master/phpThumb.config.php')) {
	foreach ($PHPTHUMB_CONFIG as $key => $value) {
		$keyname = 'config_'.$key;
		$phpThumb->setParameter($keyname, $value);
	}
}
$ServerInfo['phpthumb_version'] = $phpThumb->phpthumb_version;
$ServerInfo['im_version']       = $phpThumb->ImageMagickVersion();;
$ServerInfo['gd_string']        = phpthumb_functions::gd_version(true);
$ServerInfo['gd_numeric']       = phpthumb_functions::gd_version(false);
unset($phpThumb);
require_once('../phpThumb-master/phpThumb.config.php');

//END		



																				

function query(){
	$result = mysql_query("SELECT * from im_menu_order  WHERE display_order = '1' AND combo = '1' Order by name ASC" );

while($row = mysql_fetch_array($result)) {
 
 		echo '<option value="'.$row['name'].'">'.$row['name'].'</option>'."\n";
	
	}
	
	}

																													
																													function menu($category){	 	
																														
																														if ($category=="Combos"){
																													$query3 = mysql_query('SELECT * FROM im_menu_order_category WHERE category = "'.$category.'" AND display_order="1" order by orderby ASC');
																														 while ($row3 = mysql_fetch_array($query3)) {
																														$fields3=$row3;}
																													
																														   echo '<div id="'.$category.'">';
																														   echo '<p style="color:#000;font-size:24px;margin-bottom: 5px;"><strong>'.$category.'</strong></p>';
																														   if ($fields3[description]){
																															echo '<div class="im_menu_txt" style="line-height:20px;margin-bottom:20px;">'.$fields3[description].'</div>';
																														
																															}
																														 $query = mysql_query('SELECT * FROM im_menu_order WHERE category = "'.$category.'" AND display_order="1" order by orderby ASC');
																														 while ($row = mysql_fetch_array($query)) {
																														$fields=$row;
																													
																															if (empty($fields[size])){
																														   echo '<div class="im_menu_list" style="height:170px;">';
																													
																													if ($fields[image]){
																													 echo '<a href="http://www.infinitymeals.com/control_panel/uploads/menu_images_order/'.$fields[image].'" class="im_hover" rel="prettyPhoto[portfolio-gallery]" style="width: 128px;height: 128px;margin-right: 25px ;overflow:hidden;" title="'.$fields[name].'">
																													<img src="'.(phpThumbURL('src=/control_panel/uploads/menu_images_order/'.$fields['image'].'&zc=1&w=150&h=150&hash=c88d6c825a3661469a0e0dad0708173c', '/phpThumb-master/phpThumb.php')).'"  class="img-responsive" alt="gallery-image"    title="'.$fields[name].'"></a>';
																													}else{
																											
																													echo '<a href="/control_panel/uploads/menu_images_order/im_menu_placement.jpg" class="im_hover" rel="prettyPhoto[portfolio-gallery]" style="width: 128px;height: 128px;margin-right: 25px ;overflow:hidden;" title="NO PHOTO AVAILABLE">

<img  class="img-responsive" alt="gallery-image"   title="NO PHOTO AVAILABLE" src="/control_panel/uploads/menu_images_order/im_menu_placement_28x28.jpg">	
																													 </a>';
 																													}
																															echo '<div class="im_menu_content">';
																															echo '<p class="im_menu_name">'.$fields[name];'</p>';
																															echo '<p class="im_menu_txt">'.$fields[description].'</p>';
																															if ($fields[name]=="2 Items"){
	
echo  '<p> <select name="combos2_1" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_1" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
 query();

 echo   '</select>';

 echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_2" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
 echo   '</select></p>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_3" style="width:100%;" hidden >
       <option value="" style="width:100%;" selected>Choose from the list.</option></select>';	
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_4" style="width:100%;" hidden>
       <option value="" style="width:100%;" selected>Choose from the list.</option></select>';	
 echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_5" style="width:100%;" hidden>
       <option value="" style="width:100%;" selected>Choose from the list.</option></select>';																																}elseif ($fields[name]=="3 Items"){
 echo  '<p> <select name="combos2_1" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_1" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
 query();

 echo   '</select>';

 echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_2" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
 echo   '</select>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_3" style="width:100%;">
          <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
  echo   '</select></p>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_4" style="width:100%;" hidden>
       <option value="" style="width:100%;" selected>Choose from the list.</option></select>';	
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_5" style="width:100%;" hidden>
       <option value="" style="width:100%;" selected>Choose from the list.</option></select>';																																}elseif ($fields[name]=="4 Items"){
																															echo  '<p> <select name="combos2_1" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_1" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
 query();

 echo   '</select>';

 echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_2" style="width:100%;" >
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
 echo   '</select>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_3" style="width:100%;">
          <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
  echo   '</select>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_4" style="width:100%;" >
      <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
  echo   '</select></p>';
   echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_5" style="width:100%;" hidden>
       <option value="" style="width:100%;" selected>Choose from the list.</option></select>';	
																															}elseif ($fields[name]=="5 Items"){
 echo  '<p> <select name="combos2_1" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_1" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
 query();

 echo   '</select>';

 echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_2" style="width:100%;">
       <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
 echo   '</select>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_3" style="width:100%;" >
          <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
  echo   '</select>';
  echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_4" style="width:100%;">
      <option value="" style="width:100%;" selected>Choose from the list.</option>';
  query();
  echo   '</select>';
   echo  '<select name="combos2_2" id="combosid'.$fields[im_menu_order_id].$fields[price].'2_5" style="width:100%;">
    <option value=""style="width:100%;" selected>Choose from the list.</option>';
  query();
  echo   '</select></p>';					}
																															echo '<div class="im_amount">';
																															echo '<span class="im_p" ></span><span class="im_am"><strong>P'.$fields[price].' </strong></span>';
																															echo '<input type="button" id= "id'.$fields[im_menu_order_id].$fields[price].'" style="background: url(images/im_os/plus-sign.png) white;height: 22px;width: 21px;z-index: -9999999999;cursor: pointer;border: none;/* background: white; */ color: #67811a;text-indent:999999999px;" onmousedown="addRow(id)" value="*1~|'.$fields[name].'~b'.$fields[price].'*a'.$fields[im_menu_order_id].'~*" id="'.$fields[im_menu_order_id].'"> <label for="'.$fields[im_menu_order_id].'"></label> </div>';
																															echo '</div>
																																</div>';
																													
																														//	print_r($row);
																													
																															}///////closing size
																															}// while 1 query
																													
																														}else{
																														$query3 = mysql_query('SELECT * FROM im_menu_order_category WHERE category = "'.$category.'" AND display_order="1" order by orderby ASC');
																														 while ($row3 = mysql_fetch_array($query3)) {
																														$fields3=$row3;}
																													
																														   echo '<div id="'.$category.'">';
																														   echo '<p style="color:#000;font-size:24px;margin-bottom: 5px;"><strong>'.$category.'</strong></p>';
																														   if ($fields3[description]){
																															echo '<div class="im_menu_txt" style="line-height:20px;margin-bottom:20px;">'.$fields3[description].'</div>';
																														
																															}
																														 $query = mysql_query('SELECT * FROM im_menu_order WHERE category = "'.$category.'" AND display_order="1" order by orderby ASC');
																														 while ($row = mysql_fetch_array($query)) {
																														$fields=$row;
																													
																															if (empty($fields[size])){
																														   echo '<div class="im_menu_list">';
																													
																													if ($fields[image]){
																													 echo '<a href="http://www.infinitymeals.com/control_panel/uploads/menu_images_order/'.$fields[image].'" class="im_hover" rel="prettyPhoto[portfolio-gallery]" style="width: 128px;height: 128px;margin-right: 25px ;overflow:hidden;" title="'.$fields[name].'">
																													<img src="'.(phpThumbURL('src=/control_panel/uploads/menu_images_order/'.$fields['image'].'&zc=1&w=150&h=250&hash=c88d6c825a3661469a0e0dad0708173c', '/phpThumb-master/phpThumb.php')).'"  class="img-responsive" alt="gallery-image"    title="'.$fields[name].'"></a>';
																							}else{
																													
																													echo '<a href="/control_panel/uploads/menu_images_order/im_menu_placement.jpg" class="im_hover" rel="prettyPhoto[portfolio-gallery]" style="width: 128px;height: 128px;margin-right: 25px ;overflow:hidden;" title="NO PHOTO AVAILABLE">
																													<img  class="img-responsive" alt="gallery-image"   title="NO PHOTO AVAILABLE" src="/control_panel/uploads/menu_images_order/im_menu_placement_28x28.jpg">	
																													 </a>';
																													}
																															echo '<div class="im_menu_content">';
																															echo '<p class="im_menu_name">'.$fields[name];'</p>';
																															echo '<p class="im_menu_txt">'.$fields[description].'</p>';
																															echo '<div class="im_amount">';
																															echo '<span class="im_p" ></span><span class="im_am"><strong>P'.$fields[price].' </strong></span>';
																															echo '<input type="button" style="background: url(images/im_os/plus-sign.png) white;height: 22px;width: 21px;z-index: -9999999999;cursor: pointer;border: none;/* background: white; */ color: #67811a;text-indent:999999999px;" onmouseup="this.disabled=true;" onmousedown="addRow('.$fields[im_menu_order_id].')" value="*1~|'.$fields[name].'~b'.$fields[price].'*a'.$fields[im_menu_order_id].'~*" id="'.$fields[im_menu_order_id].'"> <label for="'.$fields[im_menu_order_id].'"></label> </div>';
																															echo '</div>
																																</div>';
																													
																														//	print_r($row);
																													
																															}///////closing size
																															}// while 1 query
																													
																														}
																															$sizes_menu = array();
																																$query2 = mysql_query('SELECT * FROM im_menu_order where category = "'.$category.'" AND size = "1" AND display_order="1" order by orderby ASC');
																															  while ($row2 = mysql_fetch_array($query2)) {
																																$sizes_menu[] = $row2;
																																		//echo $row2[name].'<br>';
																															   }
																															// print_r($sizes_menu[name].'<br>');
																													//echo $row2[name].'<br>';
																													foreach ($sizes_menu as $menu){
																																	   echo '<div class="im_menu_list">';
																																 if ($menu[image]){
																													 echo '<a href="http://www.infinitymeals.com/control_panel/uploads/menu_images_order/'.$menu[image].'" class="im_hover" rel="prettyPhoto[portfolio-gallery]" style="width: 128px;height: 128px;margin-right: 25px ;overflow:hidden;"  title="'.$menu[name].'">
																													<img src="'.(phpThumbURL('src=/control_panel/uploads/menu_images_order/'.$menu['image'].'&zc=1&w=150&h=250&hash=c88d6c825a3661469a0e0dad0708173c', '/phpThumb-master/phpThumb.php')).'"  class="img-responsive" alt="gallery-image"    title="'.$menu[name].'"></a>';
																													   
																																 }else{
																													
																																echo '<a href="/control_panel/uploads/menu_images_order/im_menu_placement.jpg" class="im_hover" rel="prettyPhoto[portfolio-gallery]" style="width: 128px;height: 128px;margin-right: 25px ;overflow:hidden;" title="NO PHOTO AVAILABLE">
																																<img  class="img-responsive" alt="gallery-image"   title="NO PHOTO AVAILABLE" src="/control_panel/uploads/menu_images_order/im_menu_placement_28x28.jpg">	
																													 </a>';
																													
																															   }
																															echo '<div class="im_menu_content">';
																													
																															echo '<p class="im_menu_name">'.$menu[name];'</p>';
																													
																															echo '<p class="im_menu_txt">'.$menu[description].'</p>';
																													
																															echo '<div class="im_amount">';
																													
																															$query3 = mysql_query('SELECT * FROM im_menu_size_order where im_menu_order_id = "'.$menu[im_menu_order_id].'"');
																													
																															  while ($row3 = mysql_fetch_array($query3)) {
																															echo '<div style="margin-right:35px;float:left;"><span class="im_p" ></span><span class="im_am" style="margin-right:10px;"><strong>P'.$row3[price].' / '.$row3[size].'</strong></span>';
																														   echo '<input type="button" style="background: url(images/im_os/plus-sign.png) white;height: 22px;width: 21px;z-index: -9999999999;cursor: pointer;border: none;/* background: white;*/ color: #67811a;text-indent:999999999px;" onmouseup="this.disabled=true"  onmousedown="addRow('.$row3[im_menu_order_id].'0'.$row3[im_menu_size_order_id].')"value="*1~|'.$row3[name].' ('.$row3[size].')'.'~b'.$row3[price].'*a'.$row3[im_menu_order_id].'~*" id="'.$row3[im_menu_order_id].'0'.$row3[im_menu_size_order_id].'"> <label for="'.$row3[im_menu_order_id].'0'.$row3[im_menu_size_order_id].'"  ></label> </div>';
																													
																															//echo '<a href="#"><img src="images/im_os/plus-sign.png" alt="add sign"></a></div>';
																													
																															   }
																														   echo '</div> </div></div>';
																													 }
																													
																													
																													
																													
																													
																														/////////////////////////////////	
																													
																													echo '</div>';
																													}  // closing function
																															?>
 <!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"><![endif]--><!--[if IE 8 ]><html class="ie8" lang="en"><![endif]--><!--[if IE 9 ]><html class="ie9" lang="en"><![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
    <!--<![endif]-->
    <head>
    <link rel="stylesheet" type="text/css" href="js/message/dialog_box.css" />
    <script type="text/javascript" src="js/message/dialog_box.js"></script>
    
        <title>InfinityMeals: A healthier alternative to your typical fast food.</title>
        <meta property="og:url" content="http://www.infinitymeals.com/order_online/" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Order Online at InfinityMeals, Healthier alternative to your typical fast food." />
        <meta property="og:description" content="Bring home healthier meals.&#8194;&#8194;Share this link to your friends and family and let them know there is a healthier place for fast food." />
        <meta property="og:image" content="http://www.infinitymeals.com/order_online/images/fbimage.jpg" />
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
    
        
 
        
        
        <!----------------------add record -------------->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
        </script>
        <script>
            
            var i = +0;
            
            function addRow(id){
				 
				 
				
            
                var div = document.createElement('div');
                
				
                i++;
                
                div.className = 'im_yo1' + i;
                
				content = '<div class="im_q1">\<div class="im_q2" id="clicks' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" onchange="compute(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ')">1</div><!--im_q2-->\<a style="cursor:pointer" id="minus' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" onClick="minus(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ')"><img src="images/im_os/neg-sign.png" alt="ng" style="margin-right: 4px;"></a>\<a style="cursor:pointer" onClick="plus(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ') "><img src="images/im_os/pos--sign.png" alt="ng" ></a>\</div><!--im_q1-->\ <div class="im_q3"><p class="im_menu_name" style="font-size:14px;margin-left:10px;">' + $("#" + id).val().split("|").pop().split("~").shift() + '<br>' + $("#combos" + id + "2_1").val() + '<br>' + $("#combos" + id + "2_2").val() + '<br>' + $("#combos" + id + "2_3").val() + '<br>' + $("#combos" + id + "2_4").val() + '<br>' + $("#combos" + id + "2_5").val() + '\<input type="hidden" value="' + $("#" + id).val().split("|").pop().split("~").shift() + '" />\</p>\<div class="im_q4">\<span class="im_p"> </span><span class="im_am"><strong>P<input type="text" class="computed2" id="computed' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '"      name="computed' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" onchange="total(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ')"  value=' + $("#" + id).val().split("b").pop().split("*").shift() + ' />\</strong></span>\</div><!--im_q4-->\</div><!--im_q3-->\<input type="hidden" id="id' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="id' + $("#" + i).val().split("a").pop().split("~").shift() + '" value="' + $("#" + id).val().split("a").pop().split("~").shift() + '"/>\<input type="hidden" id="name' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="name' + $("#" + i).val().split("a").pop().split("~").shift() + '" value="' + $("#" + id).val().split("|").pop().split("~").shift() + '<br>' + $("#combos" + id + "2_1").val() + '<br>' + $("#combos" + id + "2_2").val() + '<br>' + $("#combos" + id + "2_3").val() + '<br>' + $("#combos" + id + "2_4").val() + '<br>' + $("#combos" + id + "2_5").val() + '"/>\<input type="hidden" value="' + $("#" + id).val().split("b").pop().split("*").shift() + '" id="price' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="price' + $("#" + i).val().split("a").pop().split("~").shift() + '" class="price' + $("#" + id).val().split("a").pop().split("~").shift() + '" id="price' + $("#" + id).val().split("a").pop().split("~").shift() + '" />\<input type="hidden" value="1" id="quantity' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="quantity' + $("#" + i).val().split("a").pop().split("~").shift() + '" value="' + $("#" + id).val().split("|").pop().split("~").shift() + '"/>\<input type="hidden" id="hidden' + $("#" + id).val().split("a").pop().split("~").shift() + '" onchange="total(this.value)"/>';
                
                if (id == "id101148") {
                 
					var
					 a = document.getElementById ("combosid1011482_1").value;
					 b = document.getElementById ("combosid1011482_2").value;
					 
					 if (a == '' || b == ''){
						         showDialog('Please check your order...','You need to complete your combo to process your ','error',10000);
					 
								 }
							     else if (a == b){
						         showDialog('Please check your order...','We cannot process the same item in one combo.','error',2);
								 }else{
			
                    div.innerHTML = content;
					showDialog('Adding...','Please wait while the system is adding your order.','error',2);
					 document.getElementById('order_summary').appendChild(div);
                
            	    var 
					sub = document.getElementById("sub_total").value;
			 	   sub_total = +sub + +$("#" + id).val().split("b").pop().split("*").shift();
					document.getElementById("sub_total").value = sub_total.toFixed(2);

					document.getElementById ("sub_total2").value= sub_total.toFixed(2);	 
			 
					delivery  =+document.getElementById("sub_total").value *.10; 	
         		   document.getElementById("delivery_price").value = delivery.toFixed(2);	
					total_price = +document.getElementById("sub_total").value + + delivery;
					document.getElementById("total_price").value = total_price.toFixed(2);	
								 }
				}
								 
							

		else if (id == "id100228"){
			
				var
					 c = document.getElementById ("combosid1002282_1").value;
					 d = document.getElementById ("combosid1002282_2").value;
					 e = document.getElementById ("combosid1002282_3").value;
					 
				 if (c == '' || d == '' || e == ''){
						         showDialog('Please check your order...','You need to complete your combo to process your ','error',2);
					 
								 }
							     else if (c == d || c == e || d == e){
						         showDialog('Please check your order...','We cannot process the same item in one combo.','error',2);
								 }else{
			
                    div.innerHTML = content;
					showDialog('Adding...','Please wait while the system is adding your order.','error',2);
					 document.getElementById('order_summary').appendChild(div);
                
            	    var 
					sub = document.getElementById("sub_total").value;
			 	   sub_total = +sub + +$("#" + id).val().split("b").pop().split("*").shift();
					document.getElementById("sub_total").value = sub_total.toFixed(2);

					document.getElementById ("sub_total2").value= sub_total.toFixed(2);	 
			 
					delivery  =+document.getElementById("sub_total").value *.10; 	
         		   document.getElementById("delivery_price").value = delivery.toFixed(2);	
					total_price = +document.getElementById("sub_total").value + + delivery;
					document.getElementById("total_price").value = total_price.toFixed(2);	
								 }
								 	 
		}else if (id == "id62298"){
			
				var
					f = document.getElementById ("combosid622982_1").value;
					 g = document.getElementById ("combosid622982_2").value;
					 h = document.getElementById ("combosid622982_3").value;
					 i = document.getElementById ("combosid622982_4").value;
					 
				 if (f == '' || g == '' || h == '' || i == ''){
						         showDialog('Please check your order...','You need to complete your combo to process your ','error',2);
					 
								 }
							     else if (f == g || h == i || f == h || f == i || g == h || g == i){
						         showDialog('Please check your order...','We cannot process the same item in one combo.','error',2);
								 }else{
			
                    div.innerHTML = content;
					showDialog('Adding...','Please wait while the system is adding your order.','error',2);
					 document.getElementById('order_summary').appendChild(div);
                
            	    var 
					sub = document.getElementById("sub_total").value;
			 	   sub_total = +sub + +$("#" + id).val().split("b").pop().split("*").shift();
					document.getElementById("sub_total").value = sub_total.toFixed(2);

					document.getElementById ("sub_total2").value= sub_total.toFixed(2);	 
			 
					delivery  =+document.getElementById("sub_total").value *.10; 	
         		   document.getElementById("delivery_price").value = delivery.toFixed(2);	
					total_price = +document.getElementById("sub_total").value + + delivery;
					document.getElementById("total_price").value = total_price.toFixed(2);	
								 }
			}else if (id == "id63348"){
			
				var
				      j = document.getElementById ("combosid633482_1").value;
					 k = document.getElementById ("combosid633482_2").value;
					 l = document.getElementById ("combosid633482_3").value;
					 m = document.getElementById ("combosid633482_4").value;
					 n = document.getElementById ("combosid633482_5").value;
					 
				 if (j == '' || k == '' || l == '' || m == '' || n == ''){
						         showDialog('Please check your order...','You need to complete your combo to process your ','error',2);
					 
								 }
							     else if (j == k || n == j || n == k || n == l || n == m || m == j || m == k || m == l || l == j || l == k || k == j){
						         showDialog('Please check your order...','We cannot process the same item in one combo.','error',2);
								 }else{
			
                    div.innerHTML = content;
					showDialog('Adding...','Please wait while the system is adding your order.','error',2);
					 document.getElementById('order_summary').appendChild(div);
                
            	    var 
					sub = document.getElementById("sub_total").value;
			 	   sub_total = +sub + +$("#" + id).val().split("b").pop().split("*").shift();
					document.getElementById("sub_total").value = sub_total.toFixed(2);

					document.getElementById ("sub_total2").value= sub_total.toFixed(2);	 
			 
					delivery  =+document.getElementById("sub_total").value *.10; 	
         		   document.getElementById("delivery_price").value = delivery.toFixed(2);	
					total_price = +document.getElementById("sub_total").value + + delivery;
					document.getElementById("total_price").value = total_price.toFixed(2);	
								 }
      <!--This else is for main condition-->                  
            }else {
                     div.innerHTML = '<div class="im_q1">\<div class="im_q2" id="clicks' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" onchange="compute(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ')">1</div><!--im_q2-->\<a style="cursor:pointer" id="minus' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" onClick="minus(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ')"><img src="images/im_os/neg-sign.png" alt="ng" style="margin-right: 4px;"></a>\<a style="cursor:pointer" onClick="plus(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ') "><img src="images/im_os/pos--sign.png" alt="ng" ></a>\</div><!--im_q1-->\ <div class="im_q3"><p class="im_menu_name" style="font-size:14px;margin-left:10px;">' + $("#" + id).val().split("|").pop().split("~").shift() + '\<input type="hidden" value="' + $("#" + id).val().split("|").pop().split("~").shift() + '" />\</p>\<div class="im_q4">\<span class="im_p"> </span><span class="im_am"><strong>P<input type="text" class="computed2" id="computed' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '"      name="computed' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" onchange="total(' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + ')"  value=' + $("#" + id).val().split("b").pop().split("*").shift() + ' />\</strong></span>\</div><!--im_q4-->\</div><!--im_q3-->\<input type="hidden" id="id' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="id' + $("#" + i).val().split("a").pop().split("~").shift() + '" value="' + $("#" + id).val().split("a").pop().split("~").shift() + '"/>\<input type="hidden" id="name' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="name' + $("#" + i).val().split("a").pop().split("~").shift() + '" value="' + $("#" + id).val().split("|").pop().split("~").shift() + '"/>\<input type="hidden" value="' + $("#" + id).val().split("b").pop().split("*").shift() + '" id="price' + $("#" + id).val().split("a").pop().split("~").shift() + '' + $("#" + id).val().split("b").pop().split("*").shift() + '" name="price' + $("#" + i).val().split("a").pop().split("~").shift() + '" class="price' + $("#" + id).val().split("a").pop().split("~").shift() +'" id="price' + $("#" + id).val().split("a").pop().split("~").shift() + '" />\<input type="hidden" value="1" id="quantity' + $("#" + id).val().split("a").pop().split("~").shift() +'' + $("#" + id).val().split("b").pop().split("*").shift() +'" name="quantity' + $("#" + i).val().split("a").pop().split("~").shift() + '" value="' +$("#" + id).val().split("|").pop().split("~").shift() + '"/>\<input type="hidden" id="hidden' +$("#" + id).val().split("a").pop().split("~").shift() +'" onchange="total(this.value)"/>';
					
					showDialog('Adding...','Please wait while the system is adding your order.','error',2);
					 document.getElementById('order_summary').appendChild(div);
                
                var 
				sub = document.getElementById("sub_total").value;
			    sub_total = +sub + +$("#" + id).val().split("b").pop().split("*").shift();
				document.getElementById("sub_total").value = sub_total.toFixed(2);

				document.getElementById ("sub_total2").value= sub_total.toFixed(2);	 
			 
				delivery  =+document.getElementById("sub_total").value *.10; 	
         	   document.getElementById("delivery_price").value = delivery.toFixed(2);	
				total_price = +document.getElementById("sub_total").value + + delivery;
				document.getElementById("total_price").value = total_price.toFixed(2);	
                }
    
               
			
			
			/*showDialog('Adding...','Please wait while the system is adding your order.','error',2);*/
                
            }
            
            
            
            ////////////////////////////// adding rows
            
            
            
            function removeRow(input){
            
            
            
                document.getElementById('order_summary').removeChild(input.parentNode);
                
                
                
            }

            
        </script>
        <!--***********************-->
        <script type="text/javascript">
            																													
            																																				var clicks = 1;
         																																				function plus(id) {
           																																					clicks ++;
           																																				   /* document.getElementById("clicks" + id).innerHTML = clicks;
            																													
            																																					document.getElementById("quantity" + id).value = clicks;
            																													
            																																					*/  document.getElementById("clicks" + id).innerHTML = +document.getElementById("clicks" + id).innerHTML + +1;
            																													
            																																					document.getElementById("quantity" + id).value = +document.getElementById("quantity" + id).value + +1;
            																													
            																																					<!---------------------computing per add------------->
       																													
            																																				var cal1 = document.getElementById('price'+id).value;	
    cal2 = document.getElementById("clicks"+id).innerHTML;	
    
	document.getElementById ("computed"+id).value= +cal1 * +cal2; 
    document.getElementById("quantity" + id).value = clicks;
    
	var     x= document.getElementById('price'+id).value;	
            y = document.getElementById("sub_total").value;
            z = document.getElementById ("sub_total").value= +x + +y; 																	
           document.getElementById ("sub_total2").value= z.toFixed(2);	 
			
	document.getElementById ("sub_total2").value= sub_total.toFixed(2);	 
			 
			delivery  =+document.getElementById("sub_total").value *.10; 	
            document.getElementById("delivery_price").value = delivery.toFixed(2);	
			total_price = +document.getElementById("sub_total").value + + delivery;
			document.getElementById("total_price").value = total_price.toFixed(2);			
			
			document.getElementById ("sub_total2").value= document.getElementById("sub_total").value;
	
			}
            																													
            																																
            																													
            																																				<!---------------------computing for subtotal------------->
            																													
            																																
            																													
            																																				function totals(id){
            var x= document.getElementById('price'+id).value;	
            y = document.getElementById("sub_total").value;
            document.getElementById ("sub_total").value= +x + +y; 
            }
            function minus(id) {
            var test =  document.getElementById("clicks" + id).innerHTML;
			
			
			
            if 	(test == 0){	
            document.getElementById("minus" + id).innerHTML = disabled;
            }else{
            clicks --;
            /*document.getElementById("clicks" + id).innerHTML = clicks;*/
            document.getElementById("clicks" + id).innerHTML = +document.getElementById("clicks" + id).innerHTML - +1;
            document.getElementById("quantity" + id).value = +document.getElementById("quantity" + id).value - +1;
       
	   
	   
	        																													
            																																					<!---------------------computing per minus------------->
            																													
            																																
            																													
            																																					var cal1 = document.getElementById('price'+id).value;	
               cal2 = document.getElementById("clicks"+id).innerHTML;	
              document.getElementById ("computed"+id).value= +cal1 * +cal2;
            var     x= document.getElementById('price'+id).value;	
            		y = document.getElementById("sub_total").value;
            		z = document.getElementById ("sub_total").value= +y - +x; 	
            																																					   document.getElementById ("sub_total").value= +y - +x; 
   document.getElementById ("sub_total2").value= z.toFixed(2);	
   
   delivery  =+document.getElementById("sub_total").value *.10; 	
            document.getElementById("delivery_price").value = delivery.toFixed(2);	
			total_price = +document.getElementById("sub_total").value + + delivery;
			document.getElementById("total_price").value = total_price.toFixed(2);			
			
																																}
  	          																															};
            																													
            																																

            																													
            																																		
            																													
            																															
        </script>
        <script>
            
            
            
            function validateForm(){
            
                var x = document.getElementById("sub_total").value;
                
                if (x < 300) {
                
                    alert("Ooops the minimum order for deliver is Php. 300.00");
                    
                    return false;
                    
                }else{              
                    return confirm('Your order is being process. Please be adviced that you will be receiving a call from one of our agent for confirmation.');
					
				
				
                  document.oform.reset();
				  
				
                }
                
                
                
                
                
                
                
            }
            
            
            
        </script>
        <!---------hide address/show--------------->
        <script>
            
            function change_display(id){
			document.getElementById("sub_total_text").innerHTML = "Sub Total";
             document.getElementById('id_hide').style.display = "inline";
			 document.getElementById('id_hide2').style.display = "inline";
			 document.getElementById('id_hide3').style.display = "inline";
			 document.getElementById('show').innerHTML = "<span class=im_p style=margin-right: 5px;color:#333333;>Delivery Time:</span><span class=im_am><strong> Approx 45 min.</strong></span>";
			 
			 
	var     sub_total = document.getElementById("sub_total").value;	
	        delivery  =+document.getElementById("sub_total").value *.10; 	
            document.getElementById("delivery_price").value = delivery.toFixed(2);	
			total_price = +document.getElementById("sub_total").value + + delivery;
			document.getElementById("total_price").value = total_price.toFixed(2);	
			document.getElementById ("sub_total2").value= total_price.toFixed(2);
	        }
          
		  
		  
		    function change_hide(id){
		document.getElementById("sub_total_text").innerHTML = "Total";	
           document.getElementById('id_hide').style.display = "none";
		   document.getElementById('id_hide2').style.display = "none";
           document.getElementById('show').innerHTML = "<span class=im_p style=margin-right: 5px;color:#333333;>Preparation Time:</span><span class=im_am><strong> 15 - 30 min.</strong></span>";
		   
		   var  	
	        delivery  = 0; 	
            document.getElementById("delivery_price").value = delivery.toFixed(2);	
			total_price = 0;
			document.getElementById("total_price").value = total_price.toFixed(2);	
			document.getElementById ("sub_total2").value= document.getElementById("sub_total").value;	   	  
		   	
		    }
            
        </script>
        <!---------calculate -- for subtotal------------------>
    </head>
    <link rel="stylesheet" type="text/css" href="style_ordering.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="im_viewmenu_mobile.css" media="screen" />
    <body>
        <header id="header">
            <div id="logo" class="text-center animated" data-animation="fadeInUp" data-animation-delay="400">
                <a href="http://www.infinitymeals.com/"><img src="http://www.infinitymeals.com/menu/img/logo.png" alt="Logo"></a>
            </div><!-- end logo -->
            <div id="slideshow" style="height: 285px;width: 100%;">
                <ul class="rslides">
                    <li>
                        <img src="images/im_os/banner.png" alt="">
                    </li><!-- end .slideshow item -->

                </ul>
            </div><!-- end slideshow -->
        </header><!--im_os_nav--><a href="#" class="scrollup"><i class="fa fa-angle-double-up"></i></a>
        <div class="im_totalorder">
            Sub Total: <input type="text" id="sub_total2" value="0" style="border:none;" autocomplete="off"/>
        </div><!-- end .scrollup -->
        <section id="welcome" class="welcome section">
            <div class="container" id ="content">
                <div class="im_category">
                    <div class="title_nav">
                        Categories
                    </div>
                    <nav id="navigation2">
                        <ul>
                            <? 
																																	 $query = mysql_query('SELECT * FROM im_menu_order_category where display_order="1" order by orderby ASC ');
																																	 while ($row = mysql_fetch_array($query)) {
																														$fields=$row;                
																																	echo	'<li><a href="#'.$fields[category].'">'.$fields[category].'</a></li>';
																																	 }
																																		 ?>
                            <!--<li><a href="#Appetizers">Appetizers</a></li>
                            <li><a href="#Soups">Soups</a></li>
                            <li><a href="#Salads">Salads</a></li>
                            <li><a href="#Sandwiches">Sandwiches</a></li>
                            <li><a href="#Wraps">Wraps</a></li>
                            <li><a href="#Pastas">Pastas</a></li>
                            <li><a href="#Main entrees">Main Entrees</a></li>
                            <li><a href="#Drinks">Drinks</a></li>
                            <li><a href="#Smoothies">Smoothies</a></li>
                            <li><a href="#Desserts">Desserts</a></li>
                            <li><a href="#Group meals">Group meals</a></li>
                            <li><a href="#Combo meals">Combo meals</a></li>
                            <li><a href="#Breakfast">Breakfast</a></li>
                            <li><a href="#Coffee">Coffee</a></li>
                            <li><a href="#Add-ons">Add-ons</a></li>-->
                        </ul>
                    </nav>
                </div>
                <!--category-->



                <nav id="mobile-navigation">
                    <div class="mobile-nav-container">
                        <div id="menu-toggle">
                            <i class="fa fa-bars"></i>
                        </div>
                        <ul class="inactive">
                            <? 
																																	 $query = mysql_query('SELECT * FROM im_menu_order_category where display_order="1" order by orderby ASC ');
																																	 while ($row = mysql_fetch_array($query)) {
																														$fields=$row;                
																																	echo	'<li><a href="#'.$fields[category].'">'.$fields[category].'</a></li>';
																																	 }
																																		 ?>
                        </ul>
                    </div>
                    <!-- end .mobile-nav-container -->
                </nav>
                <div class="holdermenu">
                    <div class="title_nav">
                        Menu
                    </div>
                    <div class="im_menu" >
                        <? 
																																	 $query = mysql_query('SELECT * FROM im_menu_order_category where display_order="1" order by orderby ASC ');
																																	 while ($row = mysql_fetch_array($query)) {
																														$fields=$row;                
																																	menu ($fields[category]);
																																	 }
																																		 ?>
                    </div>
                </div>
                <div>
                    <div class="im_yourorder">
                        <div class="title_nav2">
                            Your Order
                        </div>
                        <p class="di">
                            DELIVERY INFO
                        </p>
                        <form action="submit.php" method="post" onsubmit="return validateForm()" id="oform" name="oform">
                            <input type="text" name="cust_name" placeholder="Name"class="form_input" onfocus="this.value = '';" required><input type="text" name="phone_number" placeholder="Contact #" class="form_input" onfocus="this.value = '';" required><input type="email" name="email" placeholder="Email" class="form_input" onfocus="this.value = '';" ><span class="im_p"> Pickup</span>
                            <input name="deliver_pickup" id="deliver_pickup" type="radio" value="pickup" onclick="change_hide()" required ><span class="im_p"> or Deliver</span>
                            <input id="deliver_pickup" name="deliver_pickup" type="radio" value="deliver" onclick="change_display()" required disabled><span class="im_p">
                                <br>
                                Delivery is not yet available only for pickup
                            </span>
                            <div id="id_hide" style="display:none;">
                                <span class="im_p">
                                    <br/>
                                    Please provide your address
                                </span>
                                <input type="text" name="address" placeholder="Address" class="form_input" onfocus="this.value = '';"><input type="text" name="city_town" placeholder="City / Town" class="form_input" onfocus="this.value = '';"><input type="text" name="province" placeholder="Province" class="form_input" onfocus="this.value = '';">
                            </div>
                            <p class="di" style="margin-top:25px;">
                                YOUR ORDER(s)
                            </p>
                            <div id="order_summary">
                            </div>
                            <!---------temporary hidden
                            <p class="add_reach">Add P318 to reach P500.00</p>
                            --------------->
                            <div class="im_colp2">
                                <span class="im_p" style="margin-right: 43px;" id="sub_total_text">Total</span>
                                <span class="im_am">P<strong><input type="text" id="sub_total" name="sub_total"value="0" style="border:none;width:95px;" autocomplete="off"/></strong></span>
                            </div>
                            
                            <div id="id_hide2" style="display:none;">
                            <div class="im_colp2">
                                <span class="im_p" style="margin-right: 21px;">Delivery Fee</span>
                                <span class="im_am">P<strong><input type="text" id="delivery_price" name="delivery_price"value="0" style="border:none;width:50px;"/></strong></span>
                            </div>
                            
                            <div class="im_colp2">
                                <span class="im_p" style="margin-right: 43px;">Total Fee</span>
                                <span class="im_am">P<strong><input type="text" id="total_price" name="total_price"value="0" style="border:none;width:85px;"/></strong></span>
                            </div></div>
                            <input type="submit" id="submit" name="submit" value="Order Now" class="on"/>
                            
                            <div id="id_hide3" style="display:none;">
                            <span class="im_p" style="margin-right: 5px;color:#333333;">Delivery Fee:</span>
                            <span class="im_am"><strong>10%</strong></span>
                            <br>
                            <span class="im_p" style="margin-right: 5px;color:#333333;">Delivery Minimum:</span>
                            <span class="im_am"><strong>P300</strong></span>
                            <br></div>
                           <div id="show">
                            </div>
                        </form>
                        
                        
                    </div>
                    <!--im_yourorder-->
                </div>
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
                © Copyright <script language="javascript" type="text/javascript">
var today = new Date()
var year = today.getFullYear()
document.write(year)
</script>  <span style="color:#C9FF25;">InfinityMeals</span>. All rights reserved</a>
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
