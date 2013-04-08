<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: admin - historia zamowien
 
 */	
?>

<?php
function add_scripts()
{
/*	echo '
	<script language="javascript">
	jQuery(document).ready(function(){
	
	jQuery(\'.menu\').mouseover(function() {
		jQuery(this).addClass(\'over\');
	}).mouseout(function() {
		jQuery(this).removeClass(\'over\');										
	});
	
	});
	
	</script>
	';
	*/
	
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
	
	 // extend the default setting to always include the zebra widget. 
    jQuery.tablesorter.defaults.widgets = ['zebra']; 
    // extend the default setting to always sort on the first column 
    jQuery.tablesorter.defaults.sortList = [[0,0]]; 
    // call the tablesorter plugin 
    jQuery("table").tablesorter(); 
	
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

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url') ?>/pm/tabela.css" type="text/css" />
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url') ?>/pm/general.css"type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_url') ?>/css/table_style.css"/>


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
<?    global $current_user;
	$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

	$lista="";
	$query_historia = "SELECT zam.nr_zamowienia AS nr_zamowienia, zam.data AS data_zamowienia, hist1.data AS data_aktualizacji, s_status_zamowienia.nazwa AS status_nazwa, SUM( s_produkt.cena ) AS wartosc
FROM s_zamowienie zam
INNER JOIN s_historia hist1 ON hist1.id_zamowienia = nr_zamowienia
INNER JOIN s_status_zamowienia ON hist1.id_status = s_status_zamowienia.id
INNER JOIN s_zamowione_produkty ON s_zamowione_produkty.id_zamowienia = nr_zamowienia
INNER JOIN s_produkt ON s_zamowione_produkty.id_produkt = s_produkt.prod_id
WHERE hist1.data = ( 
SELECT MAX( data ) 
FROM s_historia h2
WHERE h2.id_zamowienia = hist1.id_zamowienia ) 
AND zam.id_klient = ".$current_user->ID."
GROUP BY nr_zamowienia
LIMIT 0 , 30";

	
//echo "<br />$query_historia<br />";

	$sql_results = $wpdb->get_results($query_historia, ARRAY_N);
	
	$lista = '<table id="myTable"  class="tablesorter" border="0" cellpadding="0" cellspacing="1">
<thead> 
<tr>
	<th class=\'{sorter: false}\'>Zamówienie numer</th>
	<th>Zamówienie złożono</th>
	<th>Status zamówienia</th>
	<th>Data aktualizacji</th>
	<th>Wartość zamówienia</th>
	<th></th>
</tr>
</thead>
<tbody>';

	$id_zam="";
	$data_zam="";
	$status="";
	$data_aktualizacji="";
	$wartosc=""; 
		
	foreach ( $sql_results as $row )
	{ 	
	  $id_zam=$row[0];
	  $data_zam=$row[1];
	  $status=$row[3];
	  $data_aktualizacji=$row[2];
	  $wartosc=$row[4]; 
	  $wartosc = number_format($wartosc, 2, ",", " ");	
	 // $lista .= "<tr>";
	  
		$lista .= "<tr>
		<td>$id_zam</td>
		<td>$data_zam</td>
		<td>$status</td>
		<td>$data_aktualizacji</td>
		<td>$wartosc zł</td>
		<td><a href=\"http://naopak.com.pl/szczegoly-zamowienia?id_zam=".$id_zam."\" >szczegóły</a>	
		</td>
		</tr>";

		//$lista .= "</tr>";
	
	}

	$lista .= "</tbody></table>";

	echo $lista;	

} else {
    echo 'Welcome, visitor!';
}

?>
</div> <?php // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>
<?php get_footer(); ?>