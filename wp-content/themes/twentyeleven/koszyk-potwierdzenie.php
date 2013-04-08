<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: koszyk potwierdzenie
 
 */	
?>

<?php

  session_start();
  unset($_SESSION['naopak_cart_shipping']);
  
function add_scripts()
{
		echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/css/table_style.css"/>';

	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery.tablesorter.js"></script>';
}
add_action('wp_head', 'add_scripts');

get_header();


?>
	<script language="javascript">
	jQuery(document).ready(function(){
	
	
   jQuery('.submenu_group').each(function(){
		var div = jQuery(this).find('.submenu_active').length;		
		if(div==0)
		{
			jQuery(this).hide();
		}
	});

	// ********************************
	

	//ACCORDION BUTTON ACTION (ON CLICK DO THE FOLLOWING)
		
	jQuery('.accordionButton').click(function() {

		//REMOVE THE ON CLASS FROM ALL BUTTONS
		jQuery('.accordionButton').removeClass('on');
		  
		//NO MATTER WHAT WE CLOSE ALL OPEN SLIDES
	 	jQuery('.accordionContent').slideUp('normal');
   
		//IF THE NEXT SLIDE WASN'T OPEN THEN OPEN IT
		if(jQuery(this).next().is(':hidden') == true) {
			
			//ADD THE ON CLASS TO THE BUTTON
			jQuery(this).addClass('on');
			  
			//OPEN THE SLIDE
			jQuery(this).next().slideDown('normal');
		 } 
		  
	 });
	  
	
	/*** REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	
	//ADDS THE .OVER CLASS FROM THE STYLESHEET ON MOUSEOVER 
	jQuery('.accordionButton').mouseover(function() {
		jQuery(this).addClass('over');
		
	//ON MOUSEOUT REMOVE THE OVER CLASS
	}).mouseout(function() {
		jQuery(this).removeClass('over');										
	});
	
	/*** END REMOVE IF MOUSEOVER IS NOT REQUIRED ***/
	
	
	/********************************************************************************************************************
	CLOSES ALL S ON PAGE LOAD
	********************************************************************************************************************/	
	jQuery('.accordionContent').hide();
	jQuery('.submenu_active').parent().show();	
	jQuery('.submenu_active').parent().prev('.accordionButton').addClass('on');
	
	jQuery('.cat_selected').show();
	
	
	jQuery('#confirm_basket').hover(function(){
		jQuery('#confirm_basket.btn_text').css('background-color', '#F99D31');
		jQuery('#confirm_basket.btn_text a').css('color', '#333');
	},function(){
		jQuery('#confirm_basket.btn_text').css('background-color', '#CCC');
		jQuery('#confirm_basket.btn_text a').css('color', '#FFF');
	});
		
	// extend the default setting to always include the zebra widget. 
    jQuery.tablesorter.defaults.widgets = ['zebra']; 
    // extend the default setting to always sort on the first column 
    jQuery.tablesorter.defaults.sortList = [[0,0]]; 
    // call the tablesorter plugin 
    jQuery("#table_produkty").tablesorter({ 
        // pass the headers argument and assing a object 
        headers: { 
            // assign the secound column (we start counting zero) 
            1: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }
        } 
    }); 
	
	});
	
	</script>

<style>

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
	color:#1fb5da;
	}
	
div.content .over{
	color: #1fb5da;
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
	font-weight:normal;
	width: 170px;
	margin-left:20px;
	float: left;
	_float: none; /* Float works in all browsers but IE6 */
	/*background: #95B1CE;*/
	}
.on {
	/*background: #990000;*/
	color:#1fb5da;
	}
	
.over {
	color: #1fb5da;
	/*background: #CCCCCC;*/
	}
	
#dane_klienta, #zamowione_produkty{	
	margin-top:15px;
}
	
#dane_klienta legend, #zamowione_produkty legend{	
	/*border: 1px solid #1883FF;
	color: #1883FF;
	font-size: 10pt;
	font-weight: 700;
	padding: 0.2em 0.5em;*/
	
	color: #797979;
	display: block;
	font-weight: 700;
	line-height: 1.4em;
	clear:both;
}		
#dane_klienta div, #zamowione_produkty div{
	border: 1px solid #CCC;
	width:400px;

}
#zamowione_produkty{
	margin-bottom:30px;
}

.btn_text{
	background-color:#CCC;	
	font-size:12px;
	padding:5px 7px 5px 7px;
}
div.content .btn_text a{
	color:#FFF;	
	text-decoration: none;
}	
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
<div id="right_content_page" >
<?

	include("koszyk_functions.php");
	$products='';
	if(is_array($_SESSION['cart'])){

	//$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
	$allKoszt=0;
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
	
		$pid=$_SESSION['cart'][$i]['productid'];																
		
		$sql = "SELECT zdj1 FROM s_zdjecia WHERE id_produkt = '".$pid."'";
		$id_sql = mysql_query($sql);
		$img_result = mysql_fetch_row($id_sql);
		
		
		$pic = "img/products/$pid/$img_result[0]_t.jpg";
		$pname = get_product_name($pid);
		$price = get_price($pid);
		$allKoszt+=$price;
		$products.='<tr>';
		$products.='<td>'.($i+1).'</td>';
		$products.="<td>obraz</td>";
		$products.="<td>$pname</td>";
		$products.="<td>$price</td>";
		$products.='</tr>';
	}
	

	$userId = $current_user->ID;
	$userEmail = $current_user->user_email;
	$userDataTable = '';
	$result = mysql_query("SELECT * FROM s_dane_kontaktowe WHERE id_uzytkownik = '$userId'")
	or die(mysql_error());  
	$num_rows = mysql_num_rows($result);
	if($num_rows != NULL)
	{
		while($row = mysql_fetch_array($result))
		{
			$userDataTable .= "<tr><td>imie i nazwisko:</td><td>".$row['imie']." ".$row['nazwisko']."</td></tr>";
			$userDataTable .= "<tr><td>adres:</td><td>".$row['adres']."</td></tr>";		
			$userDataTable .= "<tr><td>miasto:</td><td>".$row['miejscowosc']."</td></tr>";
			$userDataTable .= "<tr><td>telefon:</td><td>".$row['telefon']."</td></tr>";
			$userDataTable .= "<tr><td>kraj:</td><td>".$row['kraj']."</td></tr>";		
			$userDataTable .= "<tr><td>firma:</td><td>".$row['firma']."</td></tr>";
		}
	}
	date_default_timezone_set('Europe/Warsaw');
	$nr_zamowienia = date('mdY', time()).'/'.$userId."/".rand(0,1000);
	$_SESSION['naopak_cart_shipping']['nr_zam']=$nr_zamowienia;
	
?>



<div id="dane_klienta"><legend>Dane do wysylki:</legend>
<div><table>
<? echo $userDataTable; ?>
<tr><td>e-mail:</td><td><? echo $userEmail; ?></td></tr>
<tr><td>nr zamówienia:</td><td><? echo $nr_zamowienia; ?></td></tr>
</table></div>
</div>

<div id="zamowione_produkty"><legend>Twoje zamówienie:</legend>
<div><table id="table_produkty" class="tablesorter">
<thead> 
<tr>
	<th>Lp.</th>
	<th>gh</th>
	<th>nazwa</th>
	<th>cena</th>
</tr>
</thead>
<? echo $products; ?>
<!--<tr><td>1</td><td>obraz</td><td>jakies krzeslo</td><td>15zl</td></tr>
<tr><td>2</td><td>obraz</td><td>szafa</td><td>44zl</td></tr>-->

</table>
<?
/*
print_r($_POST);
echo "
<br />
<br />
count post: ".count($_POST['opis'])."
<br />
<br />";*/

$maxKW = count($_POST['opis']);
$tmpKW = '<tr><td>koszt przesyłki:</td><td>'.$_POST['producent'][0].' - '.$_POST['opis'][0].'  '.$_POST['cena'][0].' zł</td></tr>';

$_SESSION['naopak_cart_shipping'][0]['id_przesylki']=$_POST['pryeszlkaID'][0];
$_SESSION['naopak_cart_shipping'][0]['prod_id']=$_POST['producentID'][0];

$allKoszt += $_POST['cena'][0];
for($i=1;$i<$maxKW;$i++)
{
	$tmpKW .= '<tr><td></td><td>'.$_POST['producent'][$i].' - '.$_POST['opis'][$i].'  '.$_POST['cena'][$i].' zł</td></tr>';
	$_SESSION['naopak_cart_shipping'][$i]['id_przesylki']=$_POST['pryeszlkaID'][$i];
	$_SESSION['naopak_cart_shipping'][$i]['prod_id']=$_POST['producentID'][$i];
	$allKoszt += $_POST['cena'][$i];
}

//print_r($_SESSION['naopak_cart_shipping']);
?>


<table style="font-size:12px;">
<? echo $tmpKW; ?>
<tr>
	<td>całkowity koszt zamówienia:</td>
	<td><? echo $allKoszt; ?> zł</td>
</tr>
</table>

</div>
</div>
        <span id="confirm_basket" class="btn_text">
        	<? 
				$www="";
				if ( is_user_logged_in() ) 
				{ 
					$www="http://naopak.com.pl/zatwierdzenie-zamowienia/";
				}
				else
				{
					$www="http://naopak.com.pl/reg-login/";
				}
			
			 ?>
        
			<a href="<? echo $www; ?>" >zakończ</a>
    	</span>
</div>

<?
  }else
  {
	  echo "";
  }
  
} else {
    echo 'Welcome, visitor!';
}

?>
</div> <?php // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>
<?php get_footer(); ?>