<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: User settings
 
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
<?

echo 
/*<table id="myTable" class="tablesorter">*/
'
<table id="myTable"  class="tablesorter" border="0" cellpadding="0" cellspacing="1">
<thead> 
<tr>
	<th class=\'{sorter: false}\'>id</th>
	<th>nazwa</th>
	<th>cena</th>
	<th>kategoria</th>
	<th></th>
</tr>
</thead>
<tbody>';


	$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
	$sql_tagi = $wpdb->get_results("SHOW COLUMNS FROM `s_tag`", ARRAY_N);
	$number = $wpdb->num_rows;

	$query_lista="SELECT s_produkt.prod_id, s_produkt.nazwa AS nazwa_produktu, s_produkt.cena, s_produkt.opis, s_produkt.data_dodania, s_producenci.nazwa AS producent, t_subcategory.nazwa AS sub_nazwa, t_subcategory.catID, ";
	
	$x=0;
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			if($x < $number-1)
			{
				$query_lista .= "s_".$nazwa_tagu.".nazwa AS ".$nazwa_tagu.", "; 
			}
			else
			{
				$query_lista .= "s_".$nazwa_tagu.".nazwa AS ".$nazwa_tagu." ";
			}

		}
		$x++;
	}
	
	$query_lista .= ' FROM (';
	
	for($i = 0; $i < $x; $i++)
	{
		$query_lista .= '(';
	}
	
	$query_lista .= ' s_produkt INNER JOIN s_tag ON s_produkt.id_tag = s_tag.id )';
	
	$x=0;
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			$query_lista .= " INNER JOIN s_".$nazwa_tagu." ON s_tag.id_".$nazwa_tagu." = s_".$nazwa_tagu.".id) "; 
		}
		$x++;
	}
	
	$subcat_id = $_GET['subcat'];

	if (isset($subcat_id))
	{ 
		$where_query = 'WHERE t_subcategory.subID = '.$subcat_id;
	} 
	
		$projektant_id = $wpdb->get_row("SELECT id FROM s_producenci WHERE id_uzytkownik = ".$current_user->ID, ARRAY_N);
		
	$tag_typ = $_GET['typ_tagu'];
	if (isset($tag_typ))
	{ 
		$tag_name = $_GET['nazwa_tagu'];
		$where_query = 'WHERE s_'.$tag_typ.'.nazwa = \''.$tag_name.'\'';
		$where_query .= " AND id_projektant = ".$projektant_id[0];
	} 
	else
	{
		$where_query .= "WHERE id_projektant = ".$projektant_id[0];
	}
	$query_lista .= ' LEFT JOIN s_producenci ON s_produkt.id_projektant = s_producenci.id) LEFT JOIN t_subcategory ON s_produkt.id_kategoria = t_subcategory.subID '.$where_query.' ORDER BY prod_id LIMIT 0 , 30';
	
	//echo $query_lista;
	$sql_results = $wpdb->get_results($query_lista, ARRAY_N);
	
	
	$id_prod="";
	$nazwa="";
	$cena="";
	$opis="";
	$projektant="";
	$wymiary=""; 
	$kategoria="";

	$data_dodania="";
	$nazwa_projektanta="";
	
	$j=0;
	$number+=7;
	$lista = "";	
	foreach ( $sql_results as $row )
	{ 	
	
	  $id_prod=$row[0];
	  $nazwa=$row[1];
	  $cena=$row[2];
	  $opis=$row[3];
	  $data_dodania=$row[4];
	  $projektant=$row[5];
	  $kategoria=$row[6];
	  
	  
	  for($j=7;$j<$number;$j++)
	  {	
		  $tagi.=$row[$j];
	  }

	  $lista .= "<tr>";
	  
	  	$projektant_tmp = "brak nazwy";
		if($projektant == "")
		{
			$projektant = $projektant_tmp;
		}
$pic='';

		$pic = "img/products/$id_prod/id_prod_galery_0_$id_prod.jpg";

	  	if (!file_exists($pic)) 
		{ 	 
			$pic = "img/no_pic.png"; 
		}

		$lista .= "<td>$id_prod</td>
		<td class=\"tab_nazwa\">$nazwa</td>
		<td>$cena</td>
		<td>$kategoria</td>
		<td><a href=\"http://naopak.com.pl/edycja-produktu?prod_id=".$id_prod."\">szczegóły</a></td>";

		$lista .= "</tr>";
	
	}

	$lista .= "</tbody></table>";
	echo $lista;
?>
</div>

<?php
} else {
    echo 'Welcome, visitor!';
}

?>
</div> <?php // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>
<?php get_footer(); ?>