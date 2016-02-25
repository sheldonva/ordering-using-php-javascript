<?php
$con2 = mysql_connect("localhost", "infinity_crm", "H][,hFCTyTQ,");
if (!$con2) {
	die('Could not connect:' . mysql_error());
}
mysql_select_db("infinity_crm", $con2);

//Login checker
Include  dirname(__FILE__) . '/admin/ASEngine/AS.php';
if( ! $login->isLoggedIn() )
    redirect("login.php");

$user = new ASUser(ASSession::get("user_id"));
$userInfo = $user->getInfo();

ASSession::startSession();

$user_id = $_SESSION['user_id'];
$user_name  = $userInfo['username'];

$menu_fields = array('menu_id','user_id','user_name','date','menu_name','breakfast_id','breakfast_name','breakfast_description','lunch_id','lunch_name','lunch_description','dinner_id','dinner_name','dinner_description','snack_id','snack_name','snack_description','quote_id','quote_name','image','date_modified','date_stamp');


//phpTHUMB

$ServerInfo['gd_string']  = 'unknown';
$ServerInfo['gd_numeric'] = 0;
//ob_start();
if (!include_once('phpThumb-master/phpthumb.functions.php')) {
	//ob_end_flush();
	die('failed to include_once("phpThumb-master/phpthumb.functions.php")');
}
if (!include_once('phpThumb-master/phpthumb.class.php')) {
	//ob_end_flush();
	die('failed to include_once("phpThumb-master/phpthumb.class.php")');
}
//ob_end_clean();
$phpThumb = new phpThumb();
if (include_once('phpThumb-master/phpThumb.config.php')) {
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

//END

if (!empty($_REQUEST['Button'])) {
	
//print_r($_FILES);    // print r is function to show the value of the array


	if (isset($_FILES['image'])){
	$errors = array ();         /*array that has no content  ; can add value in array*/
	$allowed_ext = array('jpg', 'jpeg', 'png', 'gif', ' ');
	
	$file_name = $_FILES ['image'] ['name'];
    $file_ext =  end(explode('.', $file_name));   /*add end +function to make sure the value will print is the last value on the array  end();    explode(); use in putting value in an array the '.' is the indication where it will be cut*/
    $file_ext2 =  explode('.', $file_name);
	$file_size = $_FILES ['image'] ['size'];
	$file_tmp = $_FILES ['image'] ['tmp_name'];
	
	// checking for ext if allowed
	
	if (in_array($file_ext, $allowed_ext)===false){
		$errors[] = 'Extension not Allowed';
		}
	if ($file_size > 2097152){
		$errors[] = 'File name MUST BE UNDER 2MB';
	    }
		
	if (empty($errors)){
	     move_uploaded_file($file_tmp, 'uploads/menu_images/'.$file_name);
		unset ($file_tmp);
		
		 echo 'file has been sent';
		 				
	}else{
	foreach ($errors as $error); {
		print_r ($errors);
		echo '<br/>', $error, '<br/>';
		
	}
	
	}
	
	
}
	
//////////////////////////////////////////////////////////////////////////file upload	
	
	
	
//echo '<h1>button is on</h1><br>';
//echo '<h1>'.$_REQUEST['breakfast_id'].'</h1><br>';
//echo '<h1>'.$_REQUEST['lunch_id'].'</h1><br>';


//////extracting breakfast_id
if (!empty($_REQUEST['breakfast_id'])) {
		$breakfast = explode('-',$_REQUEST['breakfast_id']);
//	
$breakfast_id = $breakfast[0];
$breakfast_description = $breakfast[1];

}
////////////
//////extracting lunch_id
if (!empty($_REQUEST['lunch_id'])) {
		$lunch = explode('-',$_REQUEST['lunch_id']);
//	
$lunch_id = $lunch[0];
$lunch_description = $lunch[1];
}
////////////
//////extracting dinner_id
if (!empty($_REQUEST['dinner_id'])) {
		$dinner = explode('-',$_REQUEST['dinner_id']);
//	
$dinner_id = $dinner[0];
$dinner_description = $dinner[1];
}
////////////
//////extracting snack_id
if (!empty($_REQUEST['snack_id'])) {
		$snack = explode('-',$_REQUEST['snack_id']);
///////////	
$snack_id = $snack[0];
$snack_description = $snack[1];
}
////////////
//echo '<h1>'.$snack_description.'</h1>';


	if ($_REQUEST['menu_id']) {
		
				
		//DELETE IMAGE START//
		$files= $_POST['image2'];
	if ($_POST['image_d']){
       echo "<h1>uploads/menu_images/".$files."</h1>";
		$file = "uploads/menu_images/".$files;
		if (file_exists($file)) {
			unlink($file);
			echo "Deleted '$file'";
		$files ="";
		} else {
			echo "The file '$file' does not exist.";
	
	}
	
	}
	//DELETE END//
	
		$query = 'UPDATE im_menu SET ';
		foreach ($menu_fields as $field) {
			if ($field == 'date_modified') {
				$query .= '`date_modified`=NOW(), ';
			}elseif ($field == 'user_id') {
				$query .= '`' . $field . '`="' . $user_id . '", ';
			}elseif ($field == 'user_name') {
				$query .= '`' . $field . '`="' . $user_name . '", ';
			}elseif ($field == 'breakfast_id') {
				$query .= '`' . $field . '`="' . $breakfast_id . '", ';
			}elseif ($field == 'breakfast_description') {
				if ($breakfast_description){
				$query .= '`' . $field . '`="' . $breakfast_description . '", ';
				}else{
				$query .= '`' . $field . '`="' . $_POST[breakfast_description] . '", ';}
			}elseif ($field == 'lunch_id') {
				$query .= '`' . $field . '`="' . $lunch_id . '", ';
			}elseif ($field == 'lunch_description') {
				if ($lunch_description){
				$query .= '`' . $field . '`="' . $lunch_description . '", ';
				}else{
				$query .= '`' . $field . '`="' . $_POST[lunch_description] . '", ';}
			}elseif ($field == 'dinner_id') {
				$query .= '`' . $field . '`="' . $dinner_id . '", ';
			}elseif ($field == 'dinner_description') {
				if ($dinner_description){
				$query .= '`' . $field . '`="' . $dinner_description . '", ';
				}else{
				$query .= '`' . $field . '`="' . $_POST[dinner_description] . '", ';}
			}elseif ($field == 'snack_id') {
				$query .= '`' . $field . '`="' . $snack_id . '", ';
			}elseif ($field == 'snack_description') {
				if ($snack_description){
				$query .= '`' . $field . '`="' . $snack_description . '", ';
				}else{
				$query .= '`' . $field . '`="' . $_POST[snack_description] . '", ';}
			}elseif ($field == 'image') {
				
				if (($file_name == '') OR (!$file_name)) {
				$query .= '`' . $field . '`="' . $files . '", ';
				}else{
				$query .= '`' . $field . '`="' . $file_name . '", ';
				}
			}elseif ($field != 'date_stamp') {
			$query .= '`' . $field . '`="' . $_POST[$field] . '", ';	
			}
		}

		$query = substr($query, 0, -2);
		$query .= ' WHERE 
		`menu_id`="' . $_POST['menu_id'] . '"';
		mysql_query($query);
		echo ' EDITED: ' . $query . ' ';
		
		//echo '<h1>'.$breakfast_description.'</h1>';

	} else {

		$query = 'INSERT INTO im_menu (';
		foreach ($menu_fields as $field) {
			$query .= '`' . $field . '`, ';
		}
		$query = substr($query, 0, -2);
		$query .= ') VALUES ( ';
		foreach ($menu_fields as $field) {
			if ($field == 'date_stamp') {
				$query .= 'NOW(), ';

			} elseif ($field == 'date_modified') {
				$query .= 'NOW(), ';
			} elseif ($field == 'user_id') {
				$query .= '"'.$user_id.'", ';
			} elseif ($field == 'user_name') {
				$query .= '"'.$user_name.'", ';
			}elseif ($field == 'breakfast_id') {
				$query .= '"'.$breakfast_id.'", ';
			} elseif ($field == 'breakfast_description') {
				$query .= '"'.$breakfast_description.'", ';
			} elseif ($field == 'lunch_id') {
				$query .= '"'.$lunch_id.'", ';
			}elseif ($field == 'lunch_description') {
				$query .= '"'.$lunch_description.'", ';
			}elseif ($field == 'dinner_id') {
				$query .= '"'.$dinner_id.'", ';
			}elseif ($field == 'dinner_description') {
				$query .= '"'.$dinner_description.'", ';
			}elseif ($field == 'snack_id') {
				$query .= '"'.$snack_id.'", ';
			}elseif ($field == 'snack_description') {
				$query .= '"'.$snack_description.'", ';
			}elseif ($field == 'image') {
				$query .= '"'.$file_name.'", ';
			}else {
				$query .= '"' . $_POST[$field] . '", ';
			}

		}

		$query = substr($query, 0, -2);
		$query .= '	)';
		mysql_query($query);
		echo ' ADDED: ' . $query . ' ';
	}
}
if ($_REQUEST['act'] == 'edit') {
	$query = 'SELECT * FROM  im_menu WHERE menu_id="' . $_REQUEST['menu_id'] . '"';
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
		$fields = $row;
	}
} elseif ($_REQUEST['act'] == 'delete') {

	$query = 'DELETE FROM  im_menu WHERE menu_id="' . $_REQUEST['menu_id'] . '"';
	mysql_query($query);
	echo ' Removed order: ' . $query . ' <br />';
}





// LIMIT WORDS //
function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}

?>
<html>
	<head>
    <link rel="stylesheet" type="text/css" href="css/style_main.css">	
		<title>InfinityMeals: Menu</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">	
<link rel="stylesheet" type="text/css" href="/css/styles2.css">	
		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" class="init">
			function copyToClipboard(text) {
				window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
			}


			$(document).ready(function() {
				$(document).ready(function() {
					$('#example').dataTable({
						"lengthMenu" : [[50, 100, -1], [50, 100, "All"]]
					});
					$('#example1').dataTable({
						"lengthMenu" : [[50, 100, -1], [50, 100, "All"]]
					});
				});
			});
		</script>
		<script>
			function confirmation(url) {
				if (confirm("Are you sure you want to delete this record?")) {
					//		alert(url);
					window.location = url;
				}
			}
		</script>
        

<script>
  var meals = {
	<?	
	$query = mysql_query("SELECT * from im_meals  ORDER by meals_id ASC");
		//$query = mysql_query("SELECT * from meals ORDER by meals_id ASC");

while($rows = mysql_fetch_array($query)) {

    echo '"'.$rows[meals_id].'-'.preg_replace('/\s{2,}/',' ',$rows[meals_descriptions]).'":'.'"'.$rows[meals_name].'",';
			}
?>
	}

 </script>   


  <script> 
            function ChooseContact(data) {

document.getElementById ("quote_name").value = $("#quote_id").find(":selected").text();
}
</script>     




<!----------text ahead---------------------------->

      <!--   <script type="text/javascript" src="/scripts/text_suggest/jquery-1.8.2.min.js"></script>-->
    <script type="text/javascript" src="/scripts/text_suggest/jquery.mockjax.js"></script>
    <script type="text/javascript" src="/scripts/text_suggest/jquery.autocomplete.js"></script>
   <!-- <script type="text/javascript" src="/scriptstext_suggest//countries.js"></script>-->
    <script type="text/javascript" src="demo.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    
    <script type="text/javascript">
function gotoPage(select){
    window.location = select.value;
}
</script>
	</head>
	<body>


<? include ('navigation.php');?>
		<h2><strong>InfinityMeals: Menu</strong></h2>
		<p>
			(<a href="/list_menu.php?act=list">List Menus</a> | <a href="/list_menu.php?act=new">New Menu</a>)
		</p>

		<? if ( $_REQUEST['act'] == 'new' || $_REQUEST['act'] == 'edit') {
			
		?>
<form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
	<p>
	<strong>Menu ID:</strong><?=$fields['menu_id'] ?><br>
	<input type="hidden" name="menu_id" id="menu_id" value="<?=$fields['menu_id'] ?>"><br>
	<strong>User ID:</strong><br>
	[<?=$fields['user_id'] ?>] <?=$fields['user_name'] ?>
</p>

<p>
	<strong>Date:</strong> <?=$_REQUEST[date] ?><br>
   <? if ($_REQUEST[date]){ ?>
   <input type="text" name="date" id="date" value="<?=$_REQUEST[date] ?>" hidden>
   <? }else{?>
	<input type="date" name="date" id="date" value="<?=$fields['date'] ?>">
    <? } ?>
</p>
<p>
	<strong>Menu Name:</strong><br>
	<input type="text" name="menu_name" id="menu_name" value="<?=$fields['menu_name'] ?>">
</p>
<p>
	<strong>Breakfast: </strong><br>
  
<input type="text" name="breakfast_name" id="autocomplete-ajax" style="/*position: absolute;*/ z-index: 2; background: transparent;width:50%;" value="<?=$fields['breakfast_name']?>"/>
            <input type="text" name="breakfast_name" id="autocomplete-ajax-x" disabled="disabled" style="display:none;color: #CCC; position: absolute; background: transparent; z-index: 1;width:50%;""/>
       <!--  <input type="text" name="user_id" id="user_id" disabled="disabled" hidden style="display:none;" />-->
          <input id="breakfast_id" name= "breakfast_id"  style="display:none;" value="<?=$fields['breakfast_id']?> "/> 
    
</p>
<? if ($_REQUEST['act']=='edit') {?>
<p>
	<strong>Breakfast description:</strong> (this field is for edit only)<br>
    <textarea name="breakfast_description" cols="30" rows="4"><?=$fields['breakfast_description'] ?></textarea>
    </p>
<? } ?>
 <p>
      
  <strong>Lunch:</strong><br>
	  
<input type="text" name="lunch_name" id="autocomplete-ajax2" style=" z-index: 2; background: transparent;width:50%;"  value="<?=$fields['lunch_name'] ?>"/>
            <input type="text" name="lunch_name" id="autocomplete-ajax2-x" disabled="disabled" style="display:none;color: #CCC; position: absolute; background: transparent; z-index: 1;width:50%;""/>
       <!--  <input type="text" name="user_id" id="user_id" disabled="disabled" hidden style="display:none;" />-->
          <input id="lunch_id" name= "lunch_id"  style="display:none;" value="<?=$fields['lunch_id']?>"/> 
          
          </p>
    <? if ($_REQUEST['act']=='edit') {?>
 <p>
	<strong>Lunch description:</strong> (this field is for edit only)<br>
    <textarea name="lunch_description" id="lunch_description" cols="30" rows="4"><?=$fields['lunch_description'] ?></textarea>
    
</p>
   
  <? } ?> 

   <p>
            
  <strong>Dinner:</strong><br>
	<input type="text" name="dinner_name" id="autocomplete-ajax3" style="/*position: absolute;*/ z-index: 2; background: transparent;width:50%;"  value="<?=$fields['dinner_name'] ?>"/>
            <input type="text" name="dinner_name" id="autocomplete-ajax3-x" disabled="disabled" style="display:none;color: #CCC; position: absolute; background: transparent; z-index: 1;width:50%;""/>
       <!--  <input type="text" name="user_id" id="user_id" disabled="disabled" hidden style="display:none;" />-->
          <input id="dinner_id" name= "dinner_id"  style="display:none;"  value="<?=$fields['dinner_id']?>" /> 
    
    
    </p>
       
      <? if ($_REQUEST['act']=='edit') {?> 
       <p>
	<strong>Dinner description:</strong> (this field is for edit only)<br>
    <textarea name="dinner_description" id="dinner_description" cols="30" rows="4"><?=$fields['dinner_description'] ?></textarea>
       
</p>
<? } ?>
  <p>          
 <strong>Snack:</strong><br>
   <input type="text" name="snack_name" id= "autocomplete-ajax4" style=" z-index: 2; background: transparent;width:50%;"  value="<?=$fields['snack_name'] ?>"/>
            <input type="text" name="snack_name" id="autocomplete-ajax4-x" disabled="disabled" style="display:none;color: #CCC; position: absolute; background: transparent; z-index: 1;width:50%;""/>
       <!--  <input type="text" name="user_id" id="user_id" disabled="disabled" hidden style="display:none;" />-->
          <input id="snack_id" name= "snack_id"  style="display:none;"  value="<?=$fields['snack_id']?>" /> 

</p>
<? if ($_REQUEST['act']=='edit') {?>
    <p>
	<strong>Snack description:</strong> (this field is for edit only)<br>
    <textarea name="snack_description" id="snack_description" cols="30" rows="4"><?=$fields['snack_description'] ?></textarea>
    
  <? } ?>  
	
</p>



		
 <p>	<strong>Quote:</strong>
				<input id="quote_name" name="quote_name" value="<?=$fields['quote_name'] ?>"/>
				<br>
                
                
                
                
				 <select name="quote_id" id="quote_id" onChange="ChooseContact(this)">
    <option>Choose from the list.</option>
       <?php 

$result = mysql_query("SELECT * from im_quotes  ORDER by quote_id ASC");

while($row = mysql_fetch_array($result)) {

	if ($fields['quote_id'] == $row['quote_id']) {

		echo '<option value="'.$row['quote_id'].'" selected="selected">'.$row['quotes'].'</option>'."\n";

	} else { 

		echo '<option value="'.$row['quote_id'].'">'.$row['quotes'].'</option>'."\n";
	}
}
?>
   
    </select>
				<br>
			</p>  
            
            
            <p>
            <input name="image" id="image" type="file" size="10"> <input type="text" name="image2" id="image2" value="<?=$fields['image'] ?>">
            <br>
				<strong>Would you like to delete this file permanently from the server?</strong>
				<input name="image_d" id="delete_image" role="checkbox" value="delete_image" type="checkbox">
            
            <br>
            </p>         
    

<p>

		<input type="submit" name="Button" id="Button" value="Submit">
			</p>
<!--Date Modified:
			<input type="text" name="date_modified" id="date_modified">
			<br>
			Date Stamp:
			<input type="text" name="date_stamp" id="date_stamp">
			<br>-->
</form>

 <? } elseif  ($_REQUEST ['act']=="list"){ ?>
		<table id="example" class="display" cellspacing="0" width="100%" >
			<thead>
				<tr>
					<td align="center"><strong>Action</strong></td>
                    <td align="center"><strong>ID</strong></td>
					<td align="center"><strong>UserID Assign</strong></td>
					<!--<td align="center"><strong>Menu name</strong></td>-->
					<td align="center"><strong>[ID] Breakfast name</strong></td>
                   <!-- <td align="center"><strong>Breakfast description</strong></td>-->
					<td align="center"><strong>[ID] Lunch name</strong></td>
                    <!--<td align="center"><strong>Lunch description</strong></td>-->
					<td align="center"><strong>[ID] Dinner name</strong></td>
                   <!-- <td align="center"><strong>Dinner description</strong></td>-->
                    <td align="center"><strong>[ID] Snack name</strong></td>
                   <!-- <td align="center"><strong>Snack description</strong></td>-->
                    <td align="center"><strong>[ID] Quote name</strong></td>
                    <td align="center"><strong>Image</strong></td>
                    <td align="center"><strong>Date Modified<br>Date Stamp</strong></td>
				</tr>
			</thead>
		<?php
require_once('phpThumb-master/phpThumb.config.php');
		$result = mysql_query("SELECT * FROM im_menu ORDER BY menu_id DESC");
		while ($row = mysql_fetch_array($result)) {

			echo ' <tr>' . "\n";
			echo ' <td align="center" nowrap="nowrap">';
			echo ' <a href="menu.php?menu_id=' . $row['menu_id'] . '">V</a> | ';
			echo ' <a href="?act=edit&menu_id=' . $row['menu_id'] . '">E</a> | ';
			echo ' <a href="javascript: confirmation(\'?act=delete&menu_id=' . $row['menu_id'] . '\');">D</a> ';
			echo ' </td>' . "\n";
			echo '      <td >'. $row['menu_id'] . '</td>' . "\n";
			echo '      <td >['. $row['user_id'].']'.$row['user_name'].'</td>' . "\n";
			//echo '      <td width="50%;">' . $row['menu_name'] . '</td>' . "\n";
			echo '      <td >[' . $row['breakfast_id'] .']'.$row['breakfast_name']. '</td>' . "\n";
			//echo '      <td width="50%;">' . $row['breakfast_description'] . '</td>' . "\n";
		   	echo '      <td >[' . $row['lunch_id'] .']'.$row['lunch_name']. '</td>' . "\n";
			//echo '      <td width="50%;">' . $row['lunch_description'] . '</td>' . "\n";
			echo '      <td >[' . $row['dinner_id'] .']'.$row['dinner_name']. '</td>' . "\n";
			//echo '      <td width="50%;">' . $row['dinner_description'] . '</td>' . "\n";
			echo '      <td >[' . $row['snack_id'] .']'.$row['snack_name']. '</td>' . "\n";
			//echo '      <td width="50%;">' . $row['snack_description'] . '</td>' . "\n";
			echo '      <td >[' . $row['quote_id'] .']'.limit_words($row['quote_name'],20). '</td>' . "\n";
			
			if ($row['image']){
			echo '      <td ><a href="/uploads/menu_images/' . $row['image'] .'" target="_blank"/> 
			<img src="'.(phpThumbURL('src=/uploads/menu_images/'.$row['image'].'&zc=1&w=300&h=100&hash=c88d6c825a3661469a0e0dad0708173c', '/phpThumb-master/phpThumb.php')).'">
			
			</a></td>' . "\n";
			}else{
			echo '      <td >No image yet</td>' . "\n";}	
			//<img src="/uploads/menu_images/' . $row['image'] .'" width="100" />
			
			echo '      <td style="width: 170px !important;" nowrap>'. date('M j, Y, g:i a', strtotime($row['date_modified'])).'<br>' . date('M j, Y, g:i a', strtotime($row['date_stamp'])) . '</td>' . "\n";
			echo '  </tr>' . "\n";
		}
			?>
		</table>
        
        
        
        
        <? } else { 
		
		if ($_REQUEST[month]){
			$month = $_REQUEST[month];
			}else{
			$month = 8;     //temporary mos. it should be current
			}
		echo '<form name="jump" class="center">';
		echo '<select name="month" id="month"  onchange="gotoPage(this)">';
		
		echo '<option value="" />Please select to sort by Month</option>';
		echo '<option value="/list_menu.php?month=1" />January</option>';
		echo '<option value="/list_menu.php?month=2" />Februay</option>';
		echo '<option value="/list_menu.php?month=3" />March</option>';
		echo '<option value="/list_menu.php?month=4" />April</option>';
		echo '<option value="/list_menu.php?month=5" />May</option>';
		echo '<option value="/list_menu.php?month=6" />June</option>';
		echo '<option value="/list_menu.php?month=7" />July</option>';
		echo '<option value="/list_menu.php?month=8" />August</option>';
		echo '<option value="/list_menu.php?month=9" />September</option>';
		echo '<option value="/list_menu.php?month=10" />October</option>';
		echo '<option value="/list_menu.php?month=11" />November</option>';
		echo '<option value="/list_menu.php?month=12" />December</option>';
		echo '</select>';
		echo '</form>';
		$days_in_mos = cal_days_in_month(CAL_GREGORIAN, $month, 2015); // 31 
		//$dates= date('Y-'.$month.'-01');	 ///m for 08	
		for ($i=1; $i<=$days_in_mos; $i++)
		 {
		$date = date('Y-'.$month.'-'.$i.'', strtotime('+'.$i.'day,'.$dates));
			//echo date('Y-m-'.$i.'').'<br>';
			//echo date('Y-m-d', strtotime('+'.$i.'day,'.$dates));
			
		$query = "SELECT * FROM im_menu Where date ='".$date."'";	
		$result = mysql_query($query);
		//echo $query.'<br />';
		$num_rows = mysql_num_rows($result);
		
		//putting month days to array
			if($num_rows >= 1){
		   while ($row = mysql_fetch_array($result)) {
					$date_all[] = $date;
								}
							}else{
					$date_all[] = $date;	
			               }
						  
			}
		//print_r ($date_all);  shaw all dates
		echo '<h1>Meal summary for the Month of '.date(F, strtotime(date('Y-'.$month.'-d'))).'</h1>';




   echo '<table id="example" class="display" cellspacing="0" width="100%" border="1">';
	$dates_day = date ('Y-'.$month.'-1');
	$date_day = date('l', strtotime($dates_day));
        	
			//echo $date_day;
		        echo '<tr>';
				for ($i=0; $i<=6; $i++){
				//$date_day = date('l', strtotime('+'.$i.'day',$dates_day));
				echo '<td style="font-weight:bold;text-transformation:capital;">'.date('l', strtotime('+'.$i.'day,' .$dates_day)).'</td>';
				}
			echo '</tr>';	
function report($date){
		$query = "SELECT * FROM im_menu Where date ='".$date."'";	
		$result = mysql_query($query);
		//echo $query.'<br />';
		$num_rows = mysql_num_rows($result);
		
		//putting month days to array
			if($num_rows >= 1){
		   while ($row = mysql_fetch_array($result)) {
					
					echo $date.'<br>';
					echo '<strong>B:</strong>'.$row['breakfast_name'].'</strong><br/>';
					echo '<strong>L:</strong>'.$row['lunch_name'].'</strong><br/>';
					echo '<strong>S:</strong>'.$row['snack_name'].'</strong><br/>';
					echo '<strong>D:</strong>'.$row['dinner_name'].'</strong><br/>';
					echo '<br/> <a href="?act=edit&menu_id=' . $row['menu_id'] . '">edit</a> | <a href="menu.php?menu_id='.$row['menu_id'].'">add</a>';	
								}
							}else{
								 if ($date){ 
								echo '<a href="?act=edit&date='.$date.'">';
								echo $date.'<br>';
								echo 'add Menu';
								echo '</a>';  
								}else{///no content
						             }
							   }
	}
	  
	  echo '<tr>';
	  for ($i=0; $i<=6; $i++){
	  echo '<td>';
	  report($date_all[$i]);
	  echo '</td>';
	  }
	  echo '</tr>';
	   
	  echo '<tr>';
	  for ($i=7; $i<=13; $i++){
	  echo '<td>';
	  report($date_all[$i]);
	  echo '</td>';
	  }
	  echo '</tr>';
	  
	  echo '<tr>';
	  for ($i=14; $i<=20; $i++){
	    echo '<td>';
	  report($date_all[$i]);
	  echo '</td>';
	  }
	  echo '</tr>';
	  
	  echo '<tr>';
	  for ($i=21; $i<=27; $i++){
	   echo '<td>';
	  report($date_all[$i]);
	  echo '</td>';
	  }
	  echo '</tr>';
	  
	    echo '<tr>';
	  for ($i=28; $i<=34; $i++){
	   echo '<td>';
	  report($date_all[$i]);
	  echo '</td>';
	  }
	  echo '</tr>';
			
		} ?>

	</body>
</html>

