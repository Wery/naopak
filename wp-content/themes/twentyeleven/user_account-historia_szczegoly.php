<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: User Account - historia szczegoly
 
 */	
?>

<?php
function add_scripts()
{
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/css/table_style.css"/>';
    echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery-latest.js"></script>';
	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery.tablesorter.js"></script>';
	echo '
	<script language="javascript">
	jQuery(document).ready(function(){
	
	jQuery.tablesorter.defaults.widgets = [\'zebra\'];   	
	jQuery("#myTable").tablesorter();
	jQuery("#myTable2").tablesorter();
		
	jQuery(\'.menu\').mouseover(function() {
		jQuery(this).addClass(\'over\');
	}).mouseout(function() {
		jQuery(this).removeClass(\'over\');										
	});
	
	});
	
	</script>';
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
		
</style>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url') ?>/pm/general.css" type="text/css"/>



<div class="hfeed content">
<div id="main_contetn">
<?php

if ( is_user_logged_in() ) {
?>

<div id="mapa_listowanie">
	<div class="mapa">jesteś tutaj: <?php echo $_SERVER['REQUEST_URI']; ?></div>
</div>
<? include "menu.php"; ?>
<div id="right_content_page" >
<?
    global $current_user;
	//global $wpdb;
	$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
    
	$id_zamowienia = $_GET['id_zam'];
	echo "<br />id_zam = $id_zamowienia<br />";
	//$content = 'Welcome, ';
    //$content .= 'User first name: ' . $current_user->user_firstname;
    //$content .= 'User last name: ' . $current_user->user_lastname;
	//$content .= '!<br>';
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);



	$lista="";
	$query_lista_prod = "
	SELECT s_produkt.nazwa AS produkt_nazwa, s_produkt.cena, s_producenci.nazwa AS projektant
	FROM s_zamowione_produkty
	INNER JOIN s_produkt ON s_produkt.prod_id = s_zamowione_produkty.id_produkt
	LEFT JOIN s_producenci ON s_producenci.id = s_produkt.id_projektant
	WHERE  s_zamowione_produkty.id_zamowienia =  '".$id_zamowienia."'";
	$sql_results = $wpdb->get_results($query_lista_prod, ARRAY_N);
	
	$lista = 'Pozycje zamówienia</br><table id="myTable"  class="tablesorter" border="0" cellpadding="0" cellspacing="1">
<thead> 
<tr>
	<th class=\'{sorter: false}\'>Nazwa produktu</th>
	<th>Cena</th>
	<th>Projektant</th>
</tr>
</thead>
<tbody>';

	$nazwa="";
	$cena="";
	$projektant="";

		
	foreach ( $sql_results as $row )
	{ 	
	  $nazwa=$row[0];
	  $cena=$row[1];
	  $projektant=$row[2];
	  
		$lista .= "<tr>
		<td>$nazwa</td>
		<td>$cena zł</td>
		<td>$projektant</td>
		</tr>";	
	}

	$lista .= "</tbody></table>";

	/* ******************* */
	
		$query_przesylka = "
	SELECT s_koszty_przesylki.opis, s_koszty_przesylki.cena, s_producenci.nazwa
FROM s_koszty_przesylki
INNER JOIN s_zamowienie_przesylka ON s_zamowienie_przesylka.id_koszt_przesylki = s_koszty_przesylki.id
INNER JOIN s_producenci ON s_zamowienie_przesylka.id_producent = s_producenci.id
WHERE s_zamowienie_przesylka.id_zamowienia = '".$id_zamowienia."'";
	$sql_results = $wpdb->get_results($query_przesylka, ARRAY_N);


$przesylkaTable = 'Koszt przesyłki:</br><table id="kp"  class="tablesorter" border="0" cellpadding="0" cellspacing="1">
<thead> 
<tr>
	<th>Nazwa</th>
	<th>Cena</th>
</tr>
</thead>
<tbody>';

	$opis="";
	$cena="";
	$projektant="";
		
	foreach ( $sql_results as $row )
	{ 	
	  $opis=$row[0];
	  $cena=$row[1];
	  $projektant=$row[2];
	  
		$przesylkaTable .= "<tr>
		<td>$projektant - $opis</td>
		<td>$cena zł</td>
		</tr>";	
	}

	$przesylkaTable .= "</tbody></table>";
?>
<div id="center_content">
<?php
	echo $lista;	
	echo $przesylkaTable;
?>
</br>Historia zamówienia:</br>
<?	
	$lista="";
	$query_lista_prod = "
	SELECT s_historia.data, s_status_zamowienia.nazwa, s_historia.komentarz
	FROM s_historia
	INNER JOIN s_status_zamowienia ON s_status_zamowienia.id = s_historia.id_status
	WHERE s_historia.id_zamowienia =  '".$id_zamowienia."'";

	$sql_results = $wpdb->get_results($query_lista_prod, ARRAY_N);
	
	$lista = '<table id="myTable2"  class="tablesorter" border="0" cellpadding="0" cellspacing="1">
<thead> 
<tr>
	<th class=\'{sorter: false}\'>Data aktualizacji</th>
	<th>Status</th>
	<th>Uwagi</th>
</tr>
</thead>
<tbody>';

	$data="";
	$status="";
	$uwagi="";

		
	foreach ( $sql_results as $row )
	{ 	
	  $data=$row[0];
	  $status=$row[1];
	  $uwagi=$row[2];
	  
		$lista .= "<tr>
		<td>$data</td>
		<td>$status</td>
		<td>$uwagi</td>
		</tr>";	
	}

	$lista .= "</tbody></table>";

	echo $lista;
	if ( $current_user->user_login == 'admin' ) 
	{ 
		$query_statusy = "SELECT nazwa FROM s_status_zamowienia";
		$sql_statusy = $wpdb->get_results($query_statusy, ARRAY_N);
		//print_r ($sql_statusy);
		//foreach ( $sql_statusy as $row ) 
		//{ 
		//	echo '<option value="'. $row[0] . '>' . $row[0] . '</option>';
		//}
	
?>
<form id="customForm" action="<?php the_permalink(); ?>" method="post">
    <div>
        <label for="status">Status zamówienia</label>
        <select name="status" size="1" id="status">
		<?php 
		print_r ($sql_statusy);
		foreach ( $sql_statusy as $row ) 
		{ 
			echo '<option value="'. $row[0] . '">' . $row[0] . '</option>';
		}
		?>
        </select>
    </div>
    <div>
        <label for="comment">Komentarz</label> <textarea rows="" cols="" id="tresc" name="tresc">Treść komentarza...</textarea> <span id="commentInfo"> </span>
    </div>
    <div>
        <input id="submit" type="submit" name="submit" value="Wyślij" style="width:115px;" /> <input id="send" type="reset" name="anuluj" value="Anuluj" style="width:115px;" />
    </div>
</form>
</div>
<?php 
}
?>
<?php
} else {
    echo 'Welcome, visitor!';
}
?>
</div> <?php // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>
<?php get_footer(); ?>