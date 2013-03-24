<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: User Account - add product
 
 */	
	$prod_id = 0;

	// zabezpieczyc przed kilkukrotnym otwarciem strony w tej samej przegladarce
	if(isset($_COOKIE['prod_ID']))
	{	
		//global $prod_id;
		$prod_id = $_COOKIE['prod_ID'];
		//echo "Last prod ID - ". $prod_id."<br />";

	}
	else
	{
		//echo "No COOKIE!<br />";	
 		//global $prod_id;
		$prod_id = uniqid();
		$expDate = 60 * 60 * 24 * 30 + time(); 
		setcookie('prod_ID', $prod_id, $expDate); 
		//echo "NEW COOKIE SET: prod ID - ". $prod_id."<br />";

		// usuwac z sql 
	}
	
	//echo '<BR>$_COOKIE["prod_ID"]= '.$_COOKIE['prod_ID']."<BR>";
	//echo "<BR>prod_id= ".$prod_id."<BR>";	


function add_scripts()
{
	global $prod_id;
	

	/* *********************************** CSS ************************* */
					
	echo '<link href="'.get_bloginfo('template_url').'/js/add_prod/general.css" rel="stylesheet" type="text/css"/>';
	
	echo '<link href="'.get_bloginfo('template_url').'/css/default.css" rel="stylesheet" type="text/css"/>';

	echo '<link href="'.get_bloginfo('template_url').'/css/jquery-ui-1.8.22.custom.css" rel="stylesheet" type="text/css"/>';
	
  	echo '<link href="'.get_bloginfo('template_url').'/js/uploadify2/uploadify.css" rel="stylesheet" type="text/css" />';
		
  	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/js/jcrop/jquery.Jcrop.css" type="text/css" />';
		
	echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/js/jcrop/demos.css" type="text/css" />';



	/* *********************************** JS ************************* */
	
	echo '<script src="'.get_bloginfo('template_url').'/js/jquery-1.7.2.min.js" /></script>';


	echo '<script src="'.get_bloginfo('template_url').'/js/jquery-ui-1.8.22.custom.min.js" /></script>';

	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/skrypt.js"></script>';
	
	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/add_prod/validation.js"></script>';
	
	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery.cookie.js"></script>';
	
	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/uploadify2/swfobject.js"></script>';

	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/uploadify2/jquery.uploadify-3.1.min.js"></script>';
	
  	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jcrop/jquery.Jcrop.min.js"></script>';
		   
	/* ******************************************************************* */
}
add_action('wp_head', 'add_scripts');

get_header();

$thumb_width = "150";
$thumb_height = "150";

function getHeight($image) {
	$size = getimagesize($image);
	$height = $size[1];
	return $height;
}

function getWidth($image) {
	$size = getimagesize($image);
	$width = $size[0];
	return $width;
}
	// global $wpdb;
	$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
	//$row_count = $wpdb->get_row("SHOW TABLE STATUS LIKE 's_produkt'", ARRAY_N);	
	//$id_count = $row_count[10];
	
?>
	<script language="javascript">
	jQuery(document).ready(function(){


	jQuery('.accordionButton, .accordionButtonLink').mouseover(function() {
		jQuery(this).addClass('over');
	}).mouseout(function() {
		jQuery(this).removeClass('over');										
	});

	});
	
	</script>

<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
/*	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
	#sortable li span { position: absolute; margin-left: -1.3em; }*/
	
	
	#sortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; height: 1.5em; }
	html>body #sortable li { height: 1.5em; line-height: 1.2em; }
	.ui-state-highlight { height: 1.5em; line-height: 1.2em; background-color:#FFC; }
	




div.content dd{
	margin-bottom:0px;	
	margin-left:15px;
}

.modal, .croping {
		background-color:#fff;
		display:none;
		width:690px;
		padding:15px;
		text-align:center;
		border:2px solid #333;
		position:absolute;

		opacity:1;
		-moz-border-radius:6px;
		-webkit-border-radius:6px;
		-moz-box-shadow: 0 0 50px #ccc;
		-webkit-box-shadow: 0 0 50px #ccc;
}

	
.modal h2 {
		background:url(/img/global/info.png) 0 50% no-repeat;
		margin:0px;
		padding:10px 0 10px 45px;
		border-bottom:1px solid #333;
		font-size:20px;
}

div.content a.menu{
	text-decoration:none;
	color:black;	
}

div.content .menu{
	text-decoration:none;
	color:black;	
}

div.content a:link.on {color:#1fb5da; text-decoration:none; } /* unvisited link */
div.content a:visited.on {color:#1fb5da; text-decoration:none; } /* visited link */
div.content a:hover.on {color:#1fb5da; text-decoration:none; } /* mouse over link */
div.content a:active.on {color:#1fb5da; text-decoration:none; } /* selected link */

div.content a:link.over {color:#1fb5da; text-decoration:none; } /* unvisited link */
div.content a:visited.over {color:#1fb5da; text-decoration:none; } /* visited link */
div.content a:hover.over {color:#1fb5da; text-decoration:none; } /* mouse over link */
div.content a:active.over {color:#1fb5da; text-decoration:none; } /* selected link */
	
div.content .on{
	/*background: #990000;*/
	color:#1fb5da;
	}
	
div.content .over{
	color: #1fb5da;
	/*background: #CCCCCC;*/
	}	
.li_img{
	float:left;
}
.li_img td{
	vertical-align:top;
	padding-left:5px;
	padding-right:5px;
	padding-top:5px;
}
	
	.preview_container{
				width:100px;
				height:100px;
				overflow:hidden;
				margin-bottom:5px;
			}
			.left{
				float:left;
				padding-left: 10px:
				padding-right: 10px:				
			}
			.right{
			
				float:right;
			}
#add_product_form td
{
	padding-top: 5px;
	padding-bottom: 5px;	
}
#img_list
{
	margin: 0px;		
}
#img_list li{
	display: inline;
 	list-style-type: none;
 	padding-right: 20px;
}

#add_product_form .TBwymiar
{
	width: 40px;
}

#_crop_cancel_bttn {
	margin-left:10px;
}
/*
#add_product_form_table .uploadify:hover .uploadify-button,*/ #add_product_form_table .add_btn:hover {
        color: #000;
		background-color: #F99D31;
		text-shadow:none;
		text-decoration: none;	
}
	
#add_product_form_table .uploadify-button, #add_product_form_table .add_btn{
	border:none;	
	color: #FFFFFF;
	background-color: #CCCCCC;
	text-decoration: none;
	text-align: center;
	border-radius: 0px;
	background-image:none;
	text-shadow:none;	
	font-size:12px;
	border:none;	
	font-weight:normal;
}
#add_product_form_table .add_btn{
	width:135px;
	color:#FFF;
	font-size:12px;
	font-weight:normal;
	padding: 5px;
}

div.content #center_content p { 
margin-top:15px;
color: #000000;
font-family: "Rezland";
font-size: 18px;
margin-bottom: 0px;
margin-left: 10px;
text-decoration: none;
}

.obraz_produktu{
	/*float: left;*/
	margin-right:10px;
	height: 55px;
	width: 55px;
}
/*****************************************************/
#main_contetn{
	min-width:1000px;
	float:left;
	position:relative;
}

#menu_lewe{
	float:left;
	position:relative;
	padding-right:10px;
	margin-left:15px;
}

#center_content{
	float:left;
	margin-left:10px;
	position:relative;
}

dd{
	margin-bottom:0px;	
	margin-left:15px;
}
	
#mapa_listowanie{
	float:left;
	position:relative;
	width:100%;
	margin-bottom:5px;
}
.mapa{
	margin-top:5px;
	float:left;
	font-size:12px;
}
#menu{
	float:left;
	position:relative;
	padding-right:10px;
	/*margin-left:15px;*/
	clear:left;
	width:211px;
}

#filter{
	font-size:10px;
	background-color:#e3e3e3;
	padding: 2px 0px 2px 4px;
}

#right_content_page{
	width: 750px;
	float:right;
	margin-left:10px;
	margin-right:12px;
	position:relative;
}	

#wrapper {
	width: 190px;
	margin-top:15px;
	margin-left: 20px;
	margin-right: auto;
	font-weight:bold;
	font-size:14px;
	}

.accordionButton {	
	width: 190px;
	float: left;
	_float: none;  /* Float works in all browsers but IE6 */
	/*background: #003366;*/
	border-bottom: 1px dashed black;
	cursor: pointer;
	
	}
.accordionButtonLink {	
	width: 190px;
	float: left;
	_float: none;  /* Float works in all browsers but IE6 */
	/*background: #003366;*/
	border-bottom: 1px dashed black;
	cursor: pointer;
	}	
div.content .accordionButtonLink a{
	text-decoration:none;
	color:#000;
}
div.content .accordionButtonLink a:hover{
	text-decoration:none;
	color:#1fb5da;
}


div.accordionContentMenu a.submenu_inactive{
	color: black; 
	text-decoration: none; 
	}
	
div.accordionContentMenu a.submenu_active{
	color: #1fb5da; 
	text-decoration: none; 
	}

.accordionContentMenu {	
	color:#000;
	font-weight:normal;
	width: 170px;
	margin-left:20px;
	float: left;
	_float: none; /* Float works in all browsers but IE6 */
	/*background: #95B1CE;*/
	}
	
.arrows{
	display:none;	
	background: url("http://naopak.com.pl/img/arrows_move2.png") no-repeat transparent;	
	background-position: -55px 0px;
	overflow:hidden;
	height: 55px;
	position: absolute;
	width: 55px;
	opacity:0.75;
}	
#kw_table td{
	padding-left:10px;
	padding-right:10px;
	padding-top:5px;
	padding-bottom:5px;
}
#kw_table th{
	background:#666;
	color:#FFF;
	font-weight:bold;
}
#kw_table td input{
	width:50px;
}
/*th*/
#kw_table tr:nth-child(even) {background: #CCC}
#kw_table tr:nth-child(odd) {background: #FFF}

</style>




<div class="hfeed content">
<div id="main_contetn">
<?php

if ( is_user_logged_in() ) {

    global $current_user;
	
	$content = 'Welcome, ';
    $content .= 'User first name: ' . $current_user->user_firstname;
    $content .= 'User last name: ' . $current_user->user_lastname;
	$content .= '!<br>';
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
	$content .= '<br>';
	$content .= 'user ID: '.$current_user->ID.'<br>';
	

?>

<div id="mapa_listowanie">
	<div class="mapa">jesteś tutaj: <?php echo $_SERVER['REQUEST_URI']; ?></div>
</div>
<? include "menu.php"; ?>
<div id="right_content_page" >
<!-- TRESC STRONY -->
<p>Dodaj produkt:</p>


<?php



	//echo $content;	

// pobranie zawartosci strony z adminowego formularza
//$my_id = $_GET['page_id'];
//$post_id = get_post($my_id);
//$content2 = $post_id->post_content;
//eval($content2);


$path_to_image_directory = "img/products/"; 
/*
if(!file_exists($path_to_image_directory)) 
{  
  if(!mkdir($path_to_image_directory, 0777, true)) {  
  die("There was a problem. Please try again!");  
  } 
}
*/
function list_dir($directory)
{
 $dir=opendir($directory);
 $file_list="";

 while($file_name=readdir($dir))
     {
          if(($file_name!=".")&&($file_name!=".."))
         {
         $file_list.="<LI>$file_name<br><img width=\"200\" src=\"$directory$file_name\" alt=\"image\" /></li>";
         }
     }

 closedir($dir);
 echo "
 Pliki w $directory:
 $file_list";
}

function rmdirr($dirname)
{

	 // Sanity check
	 if (!file_exists($dirname)) {
	 return false;
	 }
	
	 // Simple delete for a file
	 if (is_file($dirname)) {
	 return unlink($dirname);
	 }
	
	 // Loop through the folder
	 $dir = dir($dirname);
	 while (false !== $entry = $dir->read()) {
	 // Skip pointers
	 if ($entry == '.' || $entry == '..') {
	 continue;
	 }
	
	 // Recurse
	 rmdirr("$dirname/$entry");
	 }
	
	 // Clean up
	 $dir->close();
	 return rmdir($dirname);
}
/*
function file_sort_renamer($dirname, $id)
{
  	
// echo $dirname."  ******<br>";	
 
 $filecount = count(glob($dirname . "*_small_*.jpg"));
// echo $filecount;
 $dir=opendir($dirname);	
 
 $index=0;
 $number=0;
 
 while($old_file_name=readdir($dir))
 { 
    if(($old_file_name!=".")&&($old_file_name!=".."))
    {	
		$number=$index%$filecount;	
		$number = "$number";
		$pattern = "([0-9])";
        $new_file_name = preg_filter($pattern, $number, $old_file_name, 1);
		rename($dirname.$old_file_name, $dirname.$new_file_name);	
	
		echo $new_file_name;
		$index++;
    }
	
 }	
}
*/
if(isset($_POST['prod_id']))
{

	$sql_tagi = $wpdb->get_results("SHOW COLUMNS FROM `s_tag`", ARRAY_N);
	$number = $wpdb->num_rows;
	$output="INSERT INTO s_tag(";

	$x=0;
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			if($x < $number-1)
			{
				$output .= $s[0].", "; 
			}
			else
			{
				$output .= $s[0];
			}

		}
		$x++;
	}
	
	$output .= ') VALUES (';

	$x=0;
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			
			if($x < $number-1)
			{
				$output .= $_POST['tag_'.$nazwa_tagu.''].", "; 
			}
			else
			{
				$output .= $_POST['tag_'.$nazwa_tagu.''];
			}
		}
		$x++;
	}
	
	$output .= ')';
	
	//echo "</br>".$output."</br>";
	
	global $current_user;
	
	$wpdb->query($output);
	
	$id_tag = $wpdb->get_row("SELECT MAX(id) FROM `s_tag`", ARRAY_N);
	
	$projektant_id = $wpdb->get_row("SELECT id FROM s_producenci WHERE id_uzytkownik = ".$current_user->ID, ARRAY_N);
	
	?>
	</br></br><h1>
    <? //echo "projektant o ID ".$current_user->ID.": ".$projektant_id[0]; ?>
    </h1></br></br>
	<?
	    $insert_sql = "INSERT INTO s_produkt (prod_id, nazwa, cena, opis, szerokosc, wysokosc, glebokosc, waga, dostepnosc, id_projektant, id_kategoria, id_tag, data_dodania, promowany) VALUES ('"
		.$_POST['prod_id']."','"
		.$_POST['nazwa_produktu']."',"
		.$_POST['cena'].",'"		
		.nl2br($_POST['opis'])."',"
		.$_POST['szerokosc'].","
        .$_POST['wysokosc'].","
        .$_POST['glebokosc'].","
        .str_replace(',','.',$_POST['waga']).",
        1,
		".$projektant_id[0].","
		.$_POST['kategoria'].","
		.$id_tag[0].", 
		CURDATE() 
		,0)"; 
	
	//echo "<br />".$insert_sql."<br />";

	$wpdb->query($insert_sql);
	
	$insert_kw_sql='';
	$insert_kw_sql = "INSERT INTO s_koszty_przesylki (id_produktu, do1, od1do2, od2do5, od5do10, od10do20, od20, kurier, opis_do1, opis_od1do2, opis_od2do5, opis_od5do10, opis_od10do20, opis_od20, opis_kureir) VALUES ('"
		.$prod_id."','"
		.$_POST['do1']."','"
		.$_POST['od1do2']."','"		
		.$_POST['od2do5']."','"
		.$_POST['od5do10']."','"
        .$_POST['od10do20']."','"
        .$_POST['od20']."','"
        .$_POST['kurier']."','"
        .$_POST['opis_do1']."','"
		.$_POST['opis_od1do2']."','"
		.$_POST['opis_od2do5']."','"
		.$_POST['opis_od5do10']."','"
		.$_POST['opis_od10do20']."','"
		.$_POST['opis_od20']."','"
		.$_POST['opis_kurier']."'"				
		.")"; 

	//echo "<br />".$insert_kw_sql."<br />";

	$wpdb->query($insert_kw_sql);
		

echo  '<script>location.href = "http://naopak.com.pl/item?prod_id='.$_POST['prod_id'].'"</script>';


}
else
{
	//global $current_user;
	//$user_id = $current_user->ID;
	
/*
<div id="test_div" style="color:red">asdaaaa</div>
*/

//echo "<h1>$prod_id</h1>";
?>
<!--<input name="del_cookie" type="button" id="del_cookie" value="delete COOKIE" />-->
<form id="add_product_form" name="add_product_form" action="http://naopak.com.pl/dodawanie-produktu" method="post" >
<input type="hidden" name="prod_id" id="prod_id" value="<?php echo $prod_id; ?>" />
<table id="add_product_form_table" width="200" border="1">
  <tr>
    <td><label for="nazwa_produktu">nazwa:</label><input name="nazwa_produktu" onSubmit="cleartext();" type="text" id="nazwa_produktu" />
    <br /><span id="nazwa_produktuInfo"></span>
    </td>
  </tr>
  <tr>
    <td><label for="cena">cena:</label><input name="cena" type="text" id="cena" />
    <br /><span id="cenaInfo"></span>
    </td>
  </tr>
  <tr>
    <td><label for="opis">opis:</label><textarea name="opis" rows="10" id="opis"></textarea>
    <br /><span id="opisInfo"></span>
    </td>
  </tr>
    </tr>
    <tr>
    <td>
	  <input type="file" name="file_upload" id="file_upload" />

	<div id="img_list2">
   
    </div>
    </td>
  </tr>
  <tr>  
  <td>
  <label >wymiary:</label>
  <table><tr><td>
  <input id="szerokosc" name="szerokosc" type="text" class="TBwymiar" /> x 
  <input id="wysokosc" name="wysokosc" type="text" class="TBwymiar" /> x 
  <input id="glebokosc" name="glebokosc" type="text" class="TBwymiar" /> cm
  <br /><span id="wymiarInfo"></span>
  </td></tr>
  </table>
  </td>
  </tr>
  <tr>
    <td><label for="waga">waga:</label><input name="waga" type="text" id="waga" />
    <br /><span id="wagaInfo"></span>
    </td>
  </tr>
    <tr>
    <td>
    <input name="koszt_wysylki" type="button" class="add_btn" id="koszt_wysylki" value="Koszt wysylki" />
    <input type="hidden" id="do1" name="do1" val="0" />
    <input type="hidden" id="opis_do1" name="opis_do1" />
	<input type="hidden" id="od1do2" name="od1do2" val="0" />
	<input type="hidden" id="opis_od1do2" name="opis_od1do2" />
	<input type="hidden" id="od2do5" name="od2do5" val="0" />
	<input type="hidden" id="opis_od2do5" name="opis_od2do5" />
	<input type="hidden" id="od5do10" name="od5do10" val="0" />
	<input type="hidden" id="opis_od5do10" name="opis_od5do10" />    
    <input type="hidden" id="od10do20" name="od10do20" val="0" />
    <input type="hidden" id="opis_od10do20" name="opis_od10do20" />
	<input type="hidden" id="od20" name="od20" val="0" />
	<input type="hidden" id="opis_od20" name="opis_od20" />
   	<input type="hidden" id="kurier" name="kurier" val="0" />
    <input type="hidden" id="opis_kurier" name="opis_kurier" />
    </td>
  </tr>
  <tr>
    <td>
    <label for="kategoria">kategoria:</label>
	   <select name="kategoria" id="kategoria"> 
<?php    
	  $sql_cat = $wpdb->get_results("SELECT t_category.id, t_category.nazwa AS cat_nazwa, t_subcategory.subID, t_subcategory.nazwa AS sub_nazwa, t_subcategory.catID FROM `t_category` LEFT JOIN t_subcategory ON t_category.id = t_subcategory.catID", ARRAY_N); 
	   
	  $output = '';
      $x=0;
	  $i=0;
	  $nr=1;
	  $poprzednia_nazwa_kategorii = "";
	  $ooo = "";

	  foreach ( $sql_cat as $s )
      {
		    $aktualna_nazwa_kategorii = $s[1];

			if($aktualna_nazwa_kategorii != $poprzednia_nazwa_kategorii)
			{			 	        
				if($x==1 || $i>0)
				{
					$output .= '</optgroup>';
					$nr++;
					$i=0;
				}
			
              $output .= '<optgroup name="kat_'.$s[2].'" id="kat_'.$s[2].'" label="'.$aktualna_nazwa_kategorii.'">';					
			  $output .= '<option value="'.$s[2].'">'.$s[3].'</option>';

				 $poprzednia_nazwa_kategorii = $aktualna_nazwa_kategorii;
				$x=0;
				$i++;
          }
		  else
		  {
			  $x=1;
			  $i=0;
              $output .= '<option value="'.$s[2].'">'.$s[3].'</option>';			  
		  }		  		 		  
      }

      echo $output;
	 
/* *********************************************************************************  */
?>
    	</select>
    </td>
  </tr>
  
<?php
 
//	$sql_tagi = @mysql_query("SHOW COLUMNS FROM `s_tag`"); 
 	$sql_tagi = $wpdb->get_results("SHOW COLUMNS FROM `s_tag`", ARRAY_N);	 
	 
	$output=""; 
	$x=0;
	//while ($s = mysql_fetch_row($sql_tagi)) 
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			$output .= '<tr><td><label for="tag_'.$nazwa_tagu.'">'.$nazwa_tagu.':</label><select name="tag_'.$nazwa_tagu.'" id="tag_'.$nazwa_tagu.'">';
			
			//$sql_tag = @mysql_query("SELECT * FROM s_".$nazwa_tagu."");			
	 	    $sql_tag = $wpdb->get_results("SELECT * FROM s_".$nazwa_tagu."", ARRAY_N);
			
			//while ($t = mysql_fetch_row($sql_tag)) 
			foreach ( $sql_tag as $t )
			{
				$output .= '<option value="'.$t[0].'">'.$t[1].'</option>';
			}
			echo '</select></td></tr>';
		}
		$x++;
	}
	
	echo $output;
 
   // mysql_close($connection);

?>

  </tr>
  <tr>
  
    <td colspan="2"><input name="btn_dodaj_produkt" class="add_btn" type="submit" id="btn_dodaj_produkt" value="dodaj produkt"/>   
      
      </td>
</table>
</form>  
<?php
echo $ooo;
}
?>
</div>

<?php

echo $ooo;


} else {
    echo 'Welcome, visitor!';
}

?>

<div id="modal_dialog" style="padding-left:10px;" title="Basic modal dialog">
				<div class="right">
					<div id="preview_container" class="preview_container">
						<img id="preview" src="<?php echo 'photos/picture.jpg'.'?'.time(); ?> "></img>
					</div>										
				</div>	
				<div class="left">
					<div id="image_container">
					</div>	
				<form id="cropattrform" action="" method="post" onSubmit="return checkCoords();">
					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />
					<input type="hidden" id="tempfile" name="tempfile" />
					<input type="hidden" class="jq_step" id="step" name="step" value="process" />
				</form>
				</div>
</div>

<div id="error_dialog_size" style="padding-left:10px;" title="Zbyt duży rozmiar!">
<p>Dodałeś maksymalną iloś zdjęć !<br />
Żeby dodać zdjęcie, musisz najpierw usunąć jedno.
</p>
</div>

</div> <?php // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>

	<script language="javascript">	
		
		var img_names = new Array(); 
		
		
		$(document).ready(function(){	
	
		//$('#modal_dialog_2').dialog({ autoOpen: false });
		$("#modal_dialog_2").dialog({ 						
			minWidth : 450,
			autoOpen: false,
			closeOnEscape: false,
			modal: true,
			position:  [ "center", 200 ],
			resizable: false,						
			open: function(event, ui) 
			{ 									
				$(".ui-dialog-titlebar-close").hide(); 
			}							
		});
		
		$('#close_kw').live( 'click',  function(){
			$("#modal_dialog_2:ui-dialog").dialog( "close" );		
			console.log("close kw");
		});
		
		$('#ok_kw').live( 'click',  function(){ 
			console.log("open: koszt wysylki");
			
			$("#do1").val($("#form_do1").val());	
			$("#opis_do1").val($("#form_opis_do1").val());	
			
			$("#od1do2").val($("#form_od1do2").val());
			$("#opis_od1do2").val($("#form_od1do2").val());
			
			$("#od2do5").val($("#form_od2do5").val());
			$("#opis_od2do5").val($("#form_opis_od2do5").val());
			
			$("#od5do10").val($("#form_od5do10").val());
			$("#opis_od5do10").val($("#form_opis_od5do10").val());
			
			$("#od10do20").val($("#form_od10do20").val());
			$("#opis_od10do20").val($("#form_opis_od10do20").val());
			
			$("#od20").val($("#form_od20").val());
			$("#opis_od20").val($("#form_opis_od20").val());
			
			
			$("#kurier").val($("#form_kurier").val());
			$("#opis_kurier").val($("#form_opis_kurier").val());
				
			$("#modal_dialog_2:ui-dialog").dialog( "close" );		
		});
		
		$('#koszt_wysylki').click(function(){
			$("#modal_dialog_2").dialog("open");
			console.log("open: koszt wysylki");
		});		
	
		$('#file_upload').live('mouseover',function(){
			if(!$('#file_upload').children('div').hasClass('disabled'))
			{
				$(this).children('div').css('background-color', '#F99D31');
				$(this).children('div').css('color', '#000');
			}
		});
		
		$('#file_upload').live('mouseout',function(){
			if(!$('#file_upload').children('div').hasClass('disabled'))
			{
				$(this).children('div').css('background-color', '#CCC');
				$(this).children('div').css('color', '#FFF');
			}
		});
		
		$('.obraz_produktu').live( 'mousemove',  
			function(e) // on
			{
					//jQuery(this).css('background-position', '-55px 0px');
					$(this).children("span").css('display', 'inline');
					var offset = $(this).children("span").offset(); 
					var x = e.pageX - offset.left;
					var y = e.pageY - offset.top;
					//console.log("OVER x= "+x+"  y= "+y);
					
					if(x>0 & x<27)
					{
						$(this).children("span").css('background-position', '0px 0px');
						//console.log("LEFT");
					}
					else if(x>27 & x<55)
					{
						$(this).children("span").css('background-position', '-55px 0px');
						//console.log("RIGHT");
					}
			}
		);
		
		$('.obraz_produktu').live("click", function(e) {
				var prod_id = $('#prod_id').val();
				var img_id = $(this).attr("id");
				var nr = $(this).attr('nr');
				
				var offset = $(this).children("span").offset(); 
				var x = e.pageX - offset.left;
				var y = e.pageY - offset.top;

				if(y>=0 & y<14 & x>39 & x<55)
				{
				 	$('#file_upload').uploadify('disable', false);

					console.log('DELETEING!');
				
					var file_to_del = img_id;
					console.log('deleteing file: ' + file_to_del); 	
					
				 	$(this).remove();				
					
					$.ajax({
						type: 'POST',
						url: 'http://naopak.com.pl/wp-content/themes/twentyeleven/delete_file.php',
						data: { 
								//file_number: nr, 
								prod_id: prod_id,
								file_to_del: file_to_del 
							  },
						cache: false,
						success: function(data)
						{ 		
							console.log(data);
						},
						error: function (data, status, e)
						{
						}
					}); 
				}
				else if(x>=0 & x<27)
				{
					console.log("left: ");
					//console.log("prod_id: " + prod_id + "  img_id: " + img_id);

					var first_id = $('.obraz_produktu:first').attr('id');
					//parseInt($('.obraz_produktu:last').attr('id'));
					
					if(img_id!=first_id)
					{
						var alt_prev = 0;
						var alt_current = parseInt($(this).attr("nr"));
						alt_prev = alt_current - 1;
						
						var img_prev = $(".obraz_produktu:eq("+alt_prev+")").attr("id");
						var img_current = img_id;//$(this).attr("xxx");
						
						var tmp_img = img_names[alt_current];
						img_names[alt_current] = img_names[alt_prev];
						img_names[alt_prev] = tmp_img;
						
						console.log('###');
						console.log("img prod id: " + prod_id);
						console.log("img actual id: " + img_current);
						console.log("img last id: " + last_id);
						console.log("img next id: " + img_next);
						console.log("img current nr: " + alt_current);
						console.log("img next nr: " + alt_next);					
						console.log('###');
						
						element1 = $(".obraz_produktu:eq("+alt_current+")");
						element2 = $(".obraz_produktu:eq("+alt_prev+")");//element1.next();
						element2.insertAfter(element1);
					
						element1.attr({ nr: alt_prev });
						element2.attr({ nr: alt_current });

					   $("#loading")
					   .ajaxStart(function(){
						   $(this).show();
					   })
					   .ajaxComplete(function(){
						   $(this).hide();			
					   });
						
						$.ajax({
							type: 'POST',	
							secureuri:false,
							url:'http://naopak.com.pl/wp-content/themes/twentyeleven/rename.php',
							data: { 
									file_number1: alt_prev, 
									file_number2: alt_current,
									img_from: img_prev,
									img_to: img_current,
									prod_id: prod_id
								  },
							cache: false,
							success: function(data)
							{ 		
								console.log(data);				
							},
							error: function(xhr, thrownError)
							{
							  
							  alert(xhr.statusText);
							  alert('error: ' +  thrownError);	
							}
					   });				 
					}	
					else
					{
						console.log('###  ->  LAST ID');
					}
					
				
				}
				else if(x>27 & x<55)
				{
					console.log("move_right: ");

					var last_id = $('.obraz_produktu:last').attr('id');
					
					if(img_id!=last_id)
					{
						var alt_next = 0;
						var alt_current = parseInt($(this).attr("nr"));
						alt_next = alt_current + 1;
						
						var img_next = $(".obraz_produktu:eq("+alt_next+")").attr("id");
						var img_current = img_id;//$(this).attr("xxx");
						
						var tmp_img = img_names[alt_current];
						img_names[alt_current] = img_names[alt_next];
						img_names[alt_next] = tmp_img;
						
						console.log('###');
						console.log("img prod id: " + prod_id);
						console.log("img actual id: " + img_current);
						console.log("img last id: " + last_id);
						console.log("img next id: " + img_next);
						console.log("img current nr: " + alt_current);
						console.log("img next nr: " + alt_next);					
						console.log('###');
	
						element1 = $(".obraz_produktu:eq("+alt_current+")");
						element2 = $(".obraz_produktu:eq("+alt_next+")");//element1.next();
						element2.insertBefore(element1);
					
						element1.attr({ nr: alt_next });
						element2.attr({ nr: alt_current });

					   $("#loading")
					   .ajaxStart(function(){
						   $(this).show();
					   })
					   .ajaxComplete(function(){
						   $(this).hide();			
					   });
						
						$.ajax({
							type: 'POST',	
							secureuri:false,
							url:'http://naopak.com.pl/wp-content/themes/twentyeleven/rename.php',
							data: { 
									file_number1: alt_current, 
									file_number2: alt_next,
									img_from: img_current,
									img_to: img_next,
									prod_id: prod_id
								  },
							cache: false,
							success: function(data)
							{ 		
								console.log(data);				
							},
							error: function(xhr, thrownError)
							{
							  
							  alert(xhr.statusText);
							  alert('error: ' +  thrownError);	
							}
					   });				 
					}	
					else
					{
						console.log('###  ->  LAST ID');
					}
					
				}
			}
		);			
		$(".obraz_produktu").live("mouseleave", function(e) {
  			$(this).children("span").css('display', 'none');
		});

		$( '#_crop_bttn' ).live( 'mouseover',  function() 
							{ 
							jQuery(this).css('background-color', '#F99D31');
							jQuery(this).css('color', '#333'); 
							} )
                           .live( 'mouseout', function() 
						    { 
							jQuery(this).css('background-color', '#CCC');
							jQuery(this).css('color', '#FFF');
							} );
							
		$( '#_crop_cancel_bttn' ).live( 'mouseover',  function() 
							{ 
							jQuery(this).css('background-color', '#F99D31');
							jQuery(this).css('color', '#333'); 
							} )
                           .live( 'mouseout', function() 
						    { 
							jQuery(this).css('background-color', '#CCC');
							jQuery(this).css('color', '#FFF');
							} );
$("#btn_dodaj_produkt").live('click', function () {
	
	$.cookie("prod_ID", null);
//	alert("cookie deleted!");
});
				
				
				// alert("ok1");
				$( "#modal_dialog:ui-dialog" ).dialog( "destroy" );
				$('#modal_dialog').dialog({ autoOpen: false });
				
				$( "#error_dialog_size:ui-dialog" ).dialog( "destroy" );
				$('#error_dialog_size').dialog({ autoOpen: false });
										
		     	var prod_id = jQuery('#prod_id').val();
				var img_nr = $('.obraz_produktu').size();
				
				console.log('prod_id= '+prod_id);
				console.log('img_nr= '+img_nr);	
				var img_id;
				

$("#file_upload").live('click', function () {
	
		
		jQuery('#file_upload').uploadify('disable', true);
	
	      var img_nr = parseInt($('.obraz_produktu').size());
		  console.log('Jest juz ' + img_nr + 'obrazkow !');
		  
		 //if(img_nr == 6) 	  
		 // jQuery('#file_upload').uploadify('disable', true);
		  
		 if(img_nr > 6)
		 {
			$(window).scrollTop(0);
			jQuery("#error_dialog_size").dialog( "destroy" ); 
		  	jQuery("#error_dialog_size").dialog({ 
								modal: true,
								position:  "center",
								resizable: false
								});
		 }
    });


				 $("#file_upload").uploadify({
					"swf"       	   : "<? echo get_bloginfo('template_url'); ?>/js/uploadify2/uploadify.swf",
					"uploader"         : "<? echo get_bloginfo('template_url'); ?>/upload.php",	
					"disable"          : false,			
					"height"		   : 25,
					"width"			   : 135,
					"buttonText"	   : "Dodaj zdjęcie",
					"fileTypeDesc" 	   : "Image Files",
					"fileTypeExts"     : "*.jpg; *.jpeg; *.png",
					"preventCaching"   : true,								
					"fileSizeLimit"    : "1MB",
					"method"           : "POST",
					"formData"         : { "file_nr" : img_nr, "prod_id" : prod_id },					
					'onDialogOpen'     : function() {
					//	alert('adjhasqkjdhkajshdjashdj');
					},
					"onCancel" : function(file) {
						jQuery('#file_upload').uploadify('disable', false);
					},
					"onDialogClose"  : function(queueData) {
						if(queueData.filesQueued==0)
							jQuery('#file_upload').uploadify('disable', false);
						
						//alert(queueData.filesQueued + ' files were queued of ' + queueData.filesSelected + ' selected files. There are ' + queueData.queueLength + ' total files in the queue.');
					},
					"onUploadSuccess"  : function(file, data, response) {
											
											
												$(window).scrollTop(0);
											
												jQuery("#modal_dialog").dialog( "destroy" ); 
												
																   
											  
											
											//var img_nr = $(".obraz_produktu").size();
											//console.log('response: '+respone);
											
											var dataresponse = eval("(" + data + ")");
											//console.log('response: '+response);
											console.log('response: '+data);
											
											if(dataresponse.result == "1"){
												jQuery("#modal_dialog").dialog({ 
																	  minWidth : 536,
																	  autoOpen: false,
																	  closeOnEscape: false,
																	  modal: true,
																	  position:  [ "center", 200 ],
																	  resizable: false,																
																	  open: function(event, ui) 
																	  { 														
																		  jQuery(".ui-dialog-titlebar-close").hide(); 
																		  //jQuery(".ui-widget-header").css("padding-top", "5px");
																	//	  jQuery(".ui-widget-header").css("text-align", "center");
																		 // jQuery(".ui-widget-header").css("height", "20px");
																	  },								
																	  close: function(event, ui) 
																	  {		
																	  	  jQuery("#test_dialog").dialog( "destroy" );																			
																	  }
																   });
																   
												jQuery("#modal_dialog").dialog("open");
												//var filenametmp = (dataresponse.file).substring(0,(dataresponse.file).lastIndexOf("?"));	
                                                var filenametmp = "http://naopak.com.pl/img/products/"+prod_id+"/"+dataresponse.img_id+"_m.jpg";
                                                console.log('filenametmp: '+filenametmp);	
												$("#tempfile").val(filenametmp);
												
												console.log('returned img tmp name: '+filenametmp);												
												/*console.log('returned folder req: '+dataresponse.folder_req);
												console.log('returned folder xxx: '+dataresponse.folder_xxx);
												*/
												
												img_id = dataresponse.img_id;
												console.log('returned img id: '+img_id);
												
												var img = new Image();
                                                console.log('after new img');
									        	$(img).load(function () {
									        	  console.log('in load');
                                                  
										        	$imgpos.width  = dataresponse.imagewidth;
										            $imgpos.height = dataresponse.imageheight;
													$("#cropbox").remove();
										        	$(".jcrop-holder").remove();
										        	$(this).attr("id","cropbox");
										            $(this).hide();
										            $("#image_container").append(this);
										            
										            var w = parseInt(dataresponse.org_img_w);
													var h = parseInt(dataresponse.org_img_h);
													console.log("\n\n\nIMG width: "+w+"\n");
													console.log("IMG width: "+h+"\n\n\n");
													
													var tmp_w = Math.round(400*400/parseInt(w));
													console.log("CROP WIDTH: " +tmp_w);
													
													
										            $(this).fadeIn().Jcrop({
														minSize: [tmp_w,tmp_w],
														onChange: showPreview,
														onSelect: showPreview,
														aspectRatio: 1,
														onSelect: updateCoords,
														setSelect: [ 0, 0, tmp_w, tmp_w ],
														allowSelect: false
													});
													
													
	
										            $("#preview").remove();
										            var _imgprev = $(document.createElement("img")).attr("id","preview").attr("src",filenametmp);
										            $("#preview_container").append(_imgprev);

													if(!$("#_crop_bttn").length){		
										            	var _crop_bttn = $(document.createElement("input")).attr("id","_crop_bttn").attr("type","button").val("zapisz");
										    			var _crop_cancel_bttn = $(document.createElement("input")).attr("id","_crop_cancel_bttn").attr("type","button").val("anuluj");
										    
											        	_crop_cancel_bttn.click(function(){$("#cropattrform input.jq_step").val("cancel");});	
														_crop_bttn.click(function(){$("#cropattrform input.jq_step").val("process");});	
										    
											        	$("#cropattrform").append(_crop_bttn).append(_crop_cancel_bttn);
													}
									        	}).error(function (e) {
                                                        console.log('in load error: ' +e );
                                                }).attr("src", filenametmp);
                                                
                                                console.log('after load img');
                                                
                                               // $("#img_test").load().attr("src", filenametmp);
                                                
											}	
											else
											if(dataresponse.result == "2"){
												alert("Zdjęcie musi mieć wymiare większe niż 400 x 400 pikseli !");		
												var img_nr = $('.obraz_produktu').size();
												console.log("nr img: "+img_nr);
												if(img_nr < 7) 	  
													jQuery('#file_upload').uploadify('disable', false);
													
												$( "#modal_dialog:ui-dialog" ).dialog( "destroy" );																																	
											}
											else
												alert("error");																																			
										},				
					"onError"		 : function(){
											alert("error");
									   }
				}); // END OF: $("#uploadify").uploadify({
				
		
		jQuery('.menu').mouseover(function() {
			jQuery(this).addClass('over');
		}).mouseout(function() {
			jQuery(this).removeClass('over');										
		});
		
		$('#_crop_cancel_bttn').live('click', function(){
		 
		 	var prod_id = $("#prod_id").val();
			var step = $("#step").val();
			
			 console.log('img id in croping: '+img_id);
 			 console.log('prod id in croping: '+prod_id);
			 console.log('step: '+step);
			 
			 $.ajax({
              type: 'POST',
              url: 'http://naopak.com.pl/wp-content/themes/twentyeleven/crop.php',
              dataType: 'json',
			  data: { 
						prod_id: prod_id,
						img_id: img_id,
						step: step
					},
              cache: false,
              success: function(data)
              { 
			  console.log('CANCEL SUKCES !');
			  //console.log('result: ' + data.result);
  			  console.log('files: ' + data.files);
			  
	  				var img_nr = $('.obraz_produktu').size();
					if(img_nr < 7) 	  
						jQuery('#file_upload').uploadify('disable', false);
						
					$( "#modal_dialog:ui-dialog" ).dialog( "destroy" );
			  },
			  error: function(xhr, thrownError)
			  {
				
				console.log(xhr.statusText);
				console.log('error: ' +  thrownError);	
			  }
			 });	
	     		  							
		});
		
		$('#_crop_bttn').live('click', function(){
			
			//updateCoords();
			checkCoords();
			
			var x = $("#x").val();
			var y = $("#y").val();
			var w = $("#w").val();
			var h = $("#h").val();
			var prod_id = $("#prod_id").val();
  		    var img_nr = parseInt($(".obraz_produktu").size());
			var tempfile = $("#tempfile").val();
			var step = $("#step").val();
			
			/*
			$("#loading")
			.ajaxStart(function(){
				$(this).show();
         	})
         	.ajaxComplete(function(){
           	    $(this).hide();			
         	});*/
			
			
			 console.log('img id in croping: '+img_id);
 			 console.log('prod id in croping: '+prod_id);
			 console.log('prod tempfile in croping: '+tempfile);
			 console.log('img nr: '+img_nr);
			 console.log('step: '+step);
			 
			 img_names.push(img_id);
			 
			 //alert(img_names[img_nr]);
			 
			 $.ajax({
              type: 'POST',
              url: 'http://naopak.com.pl/wp-content/themes/twentyeleven/crop.php',
              dataType: 'json',
			  data: { 
			  			crop_x: x,
			  			crop_y: y, 
						crop_w: w, 
						crop_h: h, 
						prod_id: prod_id,
						img_id: img_id,
						step: step,
						img_nr: img_nr
					},
              cache: false,
              success: function(data)
              { 	
 				 // console.log('ajax response: '+data);
				 // var dataresponse = eval("(" + data + ")");
				 
				 var img_nr = $(".obraz_produktu").size();
				  console.log('ajax: result: '+data.result);
 				 // console.log('ajax: step: '+data.step);
				 // console.log("ajax: prod id: "+data.prod_id);
 				 // console.log("ajax: pic id: "+data.pic_id);
				  
			  	  /*$('ul#img_list').append("<li alt=\""+img_nr+"\"><table class=\"li_img\"><tr><td><img src=\"http://naopak.com.pl/img/products/"+prod_id+"/"+img_id+'_t.jpg'+"\" /></td><td><input type=\"button\" class=\"btn_up\" value=\"up\" id=\""+img_nr+"\" xxx=\""+img_id+"\" /><br><input type=\"button\" class=\"btn_delete\" value=\"delete\" id=\""+img_nr+"\" xxx=\""+img_id+"\" /><br><input type=\"button\" class=\"btn_down\" value=\"down\" id=\""+img_nr+"\" xxx=\""+img_id+"\" /></td></tr></table></li>");*/			
			  
			   $('#img_list2').append('<div class="obraz_produktu" id="'+img_id+'" style="display:inline;" nr="'+img_nr+'" ><span class="arrows"></span><img src="http://naopak.com.pl/img/products/'+prod_id+'/'+img_id+'_t.jpg" style="" ></div>');
			  /*
			  <div class="obraz_produktu" id="507d62b3c4d3" style="display:inline;">
      <span class="arrows"></span>
        <img src="http://naopak.com.pl/img/products/507d61b62d285/507d62b3c4d3e_t.jpg" style="" >
    </div>
			  */
//				sortuj($("#img_list"));

				console.log("ajax sukces !");
				
				//jcrop_api = $.Jcrop('#cropbox');
				//var jcrop_api = $('#cropbox').data('Jcrop');
				//jcrop_api.destroy();
				$( "#modal_dialog:ui-dialog" ).dialog( "destroy" );

				$("#x").val(0);
				$("#y").val(0);
				$("#w").val(150);
				$("#h").val(150);
				
				var img_nr = $('.obraz_produktu').size();
				if(img_nr < 7) 	  
		 			jQuery('#file_upload').uploadify('disable', false);
		  
              },
			  error: function(xhr, thrownError)
			  {
				
				alert(xhr.statusText);
				alert('error: ' +  thrownError);	
			  }
         });
			console.log('croping');
		});		
	 });   
			
			
			
			function updateCoords(c)
			{
				console.log("### updateCoords");
				$("#x").val(c.x);
				$("#y").val(c.y);
				$("#w").val(c.w);
				$("#h").val(c.h);
			};
			function checkCoords()
			{
				console.log("### checkCoords");
				if (parseInt($("#w").val())){
					return true;
				}	
				$("#x").val(0);
				$("#y").val(0);
				$("#w").val(150);
				$("#h").val(150);
				return true;
			};
			function showPreview(coords)
			{
				if (parseInt(coords.w) > 0)
				{
					var rx = 100 / coords.w;
					var ry = 100 / coords.h;
					$("#preview").css({
						width: Math.round(rx * $imgpos.width) + "px",
						height: Math.round(ry * $imgpos.height) + "px",
						marginLeft: "-" + Math.round(rx * coords.x) + "px",
						marginTop: "-" + Math.round(ry * coords.y) + "px"
					});
				}
			};	
			$imgpos = {
				    width	: "100",
				    height	: "100"
			};
				 

	</script>

<div id="modal_dialog_2" style="padding-left:10px;" title="Koszt wysylki" >
    <div style="width:400px;text-align:center;clear:both;" >
    	<table id="kw_table" >
          <tr>
            <th>waga:</th>
            <th>cena:</th>
            <th>tekst:<br />(opcjonalnie)</th>
          </tr>
          <tr>
            <td>do 1kg</td>
            <td><input id="form_do1" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_do1" type="text" class="TBwymiar" /></td>
          </tr>
          <tr>
            <td>od 1 kg do 2kg</td>
            <td><input id="form_od1do2" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_od1do2" type="text" class="TBwymiar" /></td>
          </tr>
          <tr>
            <td>od 2 kg do 5kg</td>
            <td><input id="form_od2do5" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_od2do5" type="text" class="TBwymiar" /></td>
          </tr>
          <tr>
            <td>od 5 kg do 10kg</td>
            <td><input id="form_od5do10" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_od5do10" type="text" class="TBwymiar" /></td>
          </tr>
          <tr>
            <td>od 10 kg do 20kg</td>
            <td><input id="form_od10do20" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_od10do20" type="text" class="TBwymiar" /></td>
          </tr>
            <tr>
            <td>powyżej 20kg</td>
            <td><input id="form_od20" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_od20" type="text" class="TBwymiar" /></td>
          </tr>
          <tr>
            <td>kurier</td>
            <td><input id="form_kurier" type="text" class="TBwymiar" value="0" /></td>
            <td><input id="form_opis_kurier" type="text" class="TBwymiar" /></td>
          </tr>
        </table>
    </div>
    <div style="width:400px;text-align:right;" >
        <input name="ok_kw" type="button" class="add_btn" id="ok_kw" value="ok" />
        <input name="close_kw" type="button" class="add_btn" id="close_kw" value="anuluj" />
    </div>
</div>

<?php get_footer(); ?>