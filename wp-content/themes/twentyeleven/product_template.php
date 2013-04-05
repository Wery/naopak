<?php
/**
 * @package Private Messages For WordPress
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: Product Template
 
 */	
 //error_reporting(E_ERROR | E_PARSE);
?>

<?php

	//include("koszyk_functions.php");
	
	$material = $_GET['material'];
	$kolor = $_GET['kolor'];
	$cena_min = $_GET['cena_min'];
	$cena_max = $_GET['cena_max'];
	$cat = $_GET['cat'];
	$subcat = $_GET['subcat'];
		
		/*echo "<br /><br />
		kolor = $kolor	<br />
		material = $material <br />
		cena_min = $cena_min <br />
		cena_max = $cena_max <br />
		cat = $cat <br />
		subcat = $subcat
		<br /><br /><br />";*/
	
function add_scripts()
{
	echo '
	<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>';
	echo '
	<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />';

	echo '
	<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery.selectbox-0.2.min.js"></script>';

	echo '
	<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/css/jquery.selectbox.css" media="screen" />';

	
	$smode='';
	if(isset($_SESSION["show_method"]))
	{
		$smode = $_SESSION["show_method"];
	}
	else
		$smode = "0";	
	
	$page='';
	if(isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
	else
		$page = "1";
			
echo"
<script type=\"text/javascript\">
/*	header('Cache-Control: no-cache, must-revalidate');
	 header('Expires: Mon, 26 Jul 1997 05:00:00 GMT\n');
	 header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
	 */
jQuery(document).ready(function(){	

	$('#customForm').submit(function() {
		var showMode = ".$smode.";
		var page = ".$page.";
		var cenamin = $(\"input[name='cena_min']\").val();
		var cenamax = $(\"input[name='cena_max']\").val();
		var kolor = $('#kolor option:selected').val();		
		var material = $('#material option:selected').val();		
				
		var url = 'http://naopak.com.pl/lista2?cat=all&subcat=all&show=0&page=1&';
		url += 'cena_max='+cenamax+'&cena_min='+cenamin+'&kolor='+kolor+'&material='+material;
		
		console.log('url:  '+url);
		
		$(location).attr('href',url);
		return false;
	});
/*	
	$('#czysc_filtr_btn').click(function() {
		console.log('czysc_filtr_btn');
		//$('#customForm').get(0).reset();
		$('.cena').val('');
		$('.sbSelector').text('wybierz');
		$('#material').val('-1');		
		$('#kolor').val('-1');
		loadData(1, $(\"input[name='show']\").val());
		return false;
	});
*/
		jQuery('#material').selectbox();
		jQuery('#kolor').selectbox();
		
		jQuery('.kup_teraz_btn').hover(function(){
			jQuery('.kup_teraz_btn').css('background-color', '#F99D31');
			jQuery('.kup_teraz_btn a').css('color', '#333');
		},function(){
			jQuery('.kup_teraz_btn').css('background-color', '#CCC');
			jQuery('.kup_teraz_btn a').css('color', '#FFF');
		});
		
	jQuery('a#single_image').fancybox(); 

    jQuery('a#single_image').live('mouseover', function(){ 
							jQuery(this).fancybox() 							
							});

	jQuery(\".image\").click(function() {
		var image_L = jQuery(this).attr(\"rel2\");
		var image_T = jQuery(this).attr(\"rel\");
		
		jQuery('#image').hide();
		jQuery('#image').fadeIn('slow');
		jQuery('#image').html('<a id=\"single_image\" href=\"' + image_L + '\"><img src=\"' + image_T + '\"/></a>'
		);
    });
	
	
	jQuery(\"#add_produkt\").click(function(){
       var nr = jQuery(this).attr(\"name\");
       jQuery.ajax({
              type: 'POST',
              url: '".get_bloginfo('template_url')."/koszyk_functions.php',
              data: { id: nr, funkcja: 'add' },
              cache: false,
              success: function()
              { 			
				var url = 'http://naopak.com.pl/koszyk';    
				jQuery(location).attr('href',url);
              }
         });
     });

});

</script>";

}
add_action('wp_head', 'add_scripts');
get_header();
//echo "<br />GOT HEADER<br />";
?>

<style>

#product, #galeria, #naglowek_opisu, #nazwa_produktu, #linki, #tagi, #opis{
	float:left;
	position:relative;
}

#naglowek_opisu{
	width:100%;	
}

div.content #opis{
	width:460px;
	margin-top:20px;
	margin-bottom:20px;
	font-size:14px;
	color:black;
	line-height:15px;
}

#product, #inne{
	margin-left:25px;	
}
#inne{
	margin-top:30px;
	margin-right:7px;
}

.kwota{
	padding: 0px;
	margin: 0px;
	border-bottom: 2px solid #666;
	text-align: center;
	font-size: 23px;
	font-weight:500;
	display: block;
	height:29px;
	margin-bottom:5px;
}

#cena, #logo, #inne{
	float:right;	
}
#tagi, #stopka_opisu{
	clear:both;
}

#inne, #opis{
	clear:left;
}

#stopka_opisu{
	margin-top:10px;	
	float:left;
	bottom:0px;
	width:460px;		
	bottom: 0px;
	position: absolute;
}

#opis_produktu{
	float:left;
	margin-left:50px;
	min-height:469;
	position:relative;
	width:519px;
}

#tagi{
	color:black;
	font-weight:bold;
	font-size:12px;
}

.thumbs_table td{
	padding-right:2px;
}
#product{
	min-width:960px;
}

#nazwa_produktu{
	font-size:20px;
	color:black;
	font-weight:bold;
	width:370px;
}
#nazwa_produktu h4{
	font-size:14px;
	font-weight:bold;
	color:#666;
	line-height:15px;
	clear:left;
}	latin2_general_ci

#tag_table_wartosc{
	padding-left:10px;
}
#linki a, #tag_table_wartosc a{
	color:#1fb5da;	
}

#ul_linki{
	font-size:14px;
	line-height:15px;
	margin:0px;
}

.kup_teraz_btn{
	background-color:#CCC;	
	font-size:12px;
	padding:3px 8px 3px 8px;
}

div.content .kup_teraz_btn a{
	color:#FFF;	
	text-decoration: none;
}

.inne_projektanta img, .inne_z_kategorii img{
	margin-left:3px;	
}
.inne_projektanta, .inne_z_kategorii{
	font-size:14px;
	font-weight:bold;
}

div.content a.link, div.content a:hover.link, div.content a:focus.link{
	text-decoration:none;
	color:black;
	font-weight:bold;
}

#logo img{
	margin-left:10px;
}

/* TOP FILTER */

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

.b_listy{
	float:right;	
	margin-right:50px;
}

.galeria_lista{
	float:right;
	margin-right:7px;
	height:27px;
}


#kolor{
	float:right;
	clear:both;
	font-size:10px;		
	border: 1px solid #999;
	width:80px;
	margin-left:5px;
	margin-top:5px;
}

.tb_ceny{
	clear:both;
	float:right;	
	padding:0px;
	margin:0px;
}

.filtr_nazwa{
	font-size:10px;		
}
.filtr_nazwa{
	height:16px;
	margin-left: 10px;
	margin-right:5px;
	margin-top:1px;
	float:left;
}

.filtr_koloru, .filtr_materialu{
	float:right;
}

.filtr_listy{
	margin-top:2px;
	margin-right:30px;	
	margin-top:5px;
}

.filtr_listy, .filtr_ceny_od, .filtr_ceny_do{
	float:right;
}

div.content .cena{
	width:30px;
	height:15px;
	font-size:10px;
	background-color:#fff;
	float:right;
	padding:1px 5px 1px 5px;
	color:#FFF;
	background-color:#CCC;
	border:none;
	box-shadow:none;
}

.filtruj_btn{
	background-color:#CCC;	
	font-size:10px;
	padding:2px 10px 2px 10px;
	float:right;
	margin-left:15px;
	height:17px;
	color:#FFF;	
	text-decoration: none;
	border:none;	
}
.powrot_btn{
	background-color:#CCC;	
	font-size:10px;
	padding:1px 10px 1px 10px;
	float:right;
	margin-left:15px;
	height:15px;
}

.powrot_btn{
	margin-top:5px;
	background-color:#666;	
	margin-left:0px;
	padding:1px 8px 1px 10px;
}

div.content .filtruj_btn a , div.content .powrot_btn a{
	color:#FFF;	
	text-decoration: none;
}
</style>

<form name="form1">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<div class="hfeed content">

<?
function remove_querystring_var($url, $key) { 
	//$url = preg_replace('/'.$key.'(=[^&]*)?|^'.$key.'(=[^&]*)?&?/i', '$1$2$4', $url . '&'); 
	
	$url = preg_replace('/(?<=&|\?)'.$key.'(=[^&]*)?(&|$)/i','',$url);
	
	if(count($_GET)==1)
		$url = substr($url, 0, -1); 
	
	return $url; 
}

$adres = "http://naopak.com.pl/lista2?" .http_build_query($_GET);
$query = remove_querystring_var($adres,"prod_id");
//echo $query;
?>
<div id="mapa_listowanie">
	<div class="mapa">jesteś tutaj: <?php echo $_SERVER['REQUEST_URI']; ?></div>

    <div class="galeria_lista">    
	  <span class="powrot_btn">
				<a id="powrot" href="<? echo $query; ?>" >< pworót</a>
   		 </span>
	</div>
    	<div class="filtr_listy">
        
   <form id="customForm" method="post" enctype="text/plain" >
   
<!--    <span class="filtruj_btn">
		<a id="filtruj" href="#" >filtruj</a>		
    </span>-->
    
    <span class="filtruj_span">
		<input id="filtruj_btn" class="filtruj_btn" type="submit" value="filtruj">        
    </span>
 
    <span class="filtr_ceny_do"> 
    <span class="filtr_nazwa">do:</span>
    <input name="cena_max" class="cena" type="text"
    <? 
	
		if($cena_max != '')
		{
			echo 'value="'.$cena_max.'"';
		}
	
	?>
    >
    </span>
    
    <span class="filtr_ceny_od"> 
    <span class="filtr_nazwa">od:</span>
    <input name="cena_min" class="cena" type="text" 
    <? 
	
		if($cena_min != '')
		{
			echo 'value="'.$cena_min.'"';
		}
	
	?>
    >
    </span>    
  
  <span class="filtr_koloru">
  <span class="filtr_nazwa">kolor:</span>
  <select name="kolor" id="kolor">
	  <option value="-1">wybierz</option>
	<? 
	$connection = @mysql_connect('localhost', 'root', '') or die("Connection error !");
	$db = @mysql_select_db('bollo_naopak', $connection);
	
	mysql_set_charset('utf8',$connection); 
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	mysql_query('set names utf8;');
	
		$query_kolor="SELECT nazwa FROM s_kolor";
	//$sql_tagi = $wpdb->get_results($query_kolor, ARRAY_N);
 	$sql_kolor = mysql_query($query_kolor);
 
	//foreach ( $sql_tagi as $s )
	while($s = mysql_fetch_array($sql_kolor))
	{
		if($kolor === $s[0])
		{
			$kolory_filtr .= "<option selected=\"selected\" value=\"$s[0]\">$s[0]</option>";
		}
		else
		{
			$kolory_filtr .= "<option value=\"$s[0]\">$s[0]</option>";
		}
	}



	
		echo $kolory_filtr; ?>
  </select>
  </span>

  <span class="filtr_materialu"> 
  <span class="filtr_nazwa">material:</span>
  <select name="material" id="material" class="material">
  	  <option value="-1">wybierz</option>
	<? 		$query_material="SELECT nazwa FROM s_material";
		//$sql_tagi = $wpdb->get_results($query_material, ARRAY_N);
		$sql_mat = mysql_query($query_material);
		//foreach ( $sql_tagi as $s )
		while($s = mysql_fetch_array($sql_mat))		
		{
			if($material === $s[0])
			{
				$material_filtr .= "<option selected=\"selected\" value=\"$s[0]\">$s[0]</option>";
				//$material_filtr2 .= "<span class=\"selectOption\" selected=\"selected\" value=\"$s[0]\">$s[0]</span>";
			}
			else
			{
				$material_filtr .= "<option value=\"$s[0]\">$s[0]</option>";
				//$material_filtr2 .= "<span class=\"selectOption\" value=\"$s[0]\">$s[0]</span>";
			}
		}
		echo $material_filtr; ?>
  </select>
  </span>
    
</form>
    </div>
</div>
  <?php // skrypt pobierajacy dane z SQL 


	
if (!empty($_GET['prod_id'])) {

$id = $_GET['prod_id'];

if(mysql_num_rows(mysql_query("SELECT id FROM s_produkt WHERE prod_id = '$id'"))){

	
	$output="SELECT s_produkt.prod_id, s_produkt.nazwa AS nazwa_produktu, s_produkt.cena, s_produkt.opis, s_produkt.dostepnosc, s_produkt.id_projektant, s_produkt.data_dodania, s_produkt.id_tag, t_subcategory.subID as kategoria, t_subcategory.nazwa AS sub_nazwa, s_producenci.nazwa AS producent FROM (s_produkt LEFT JOIN t_subcategory ON s_produkt.id_kategoria = t_subcategory.subID) 
LEFT JOIN s_producenci ON s_produkt.id_projektant = s_producenci.id WHERE s_produkt.prod_id='".$id."'";


	//echo $output."</br></br>";
	$mydb = new wpdb('root','','bollo_naopak','localhost');
	//global $mydb;

	$sql_results = $mydb->get_results($output);
	
	$id_prod="";
	$nazwa="";
	$cena="";
	$opis="";
	$dostepnosc=1;
	$id_projektant="";
	$wymiary=""; 
	$kategoria="";
	$data_dodania="";
	$nazwa_projektanta="";
	
	foreach ( $sql_results as $row )
	{ 	
		$id_prod=$row->prod_id;
		$nazwa=$row->nazwa_produktu;
		$cena=$row->cena;
		$opis=$row->opis;
		$dostepnosc=$row->dostepnosc;
		$id_projektant=$row->id_projektant;
		$data_dodania=$row->data_dodania;
		$id_tag=$row->id_tag; 
		$kategoria=$row->kategoria;
		$nazwa_projektanta=$row->producent;
	}
	
	//echo '<br>id_tag='.$id_tag.', data: '.$data_dodania."</br>";
	$sql_tagi = $mydb->get_results("SHOW COLUMNS FROM `s_tag`", ARRAY_N);
	
 	$number = $mydb->num_rows;

	$tag_query="SELECT ";
	$x=0;
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			if($x < $number-1)
			{
				$tag_query .= "s_".$nazwa_tagu.".nazwa AS tag_".$x.", "; 
			}
			else
			{
				$tag_query .= "s_".$nazwa_tagu.".nazwa AS tag_".$x;
			}

		}
		$x++;
	}
		$tag_query .= ' FROM ';
	
	for($i = 0; $i < $x; $i++)
	{
		$tag_query .= '(';
	}
	
	$tag_query .= ' s_produkt INNER JOIN s_tag ON s_produkt.id_tag = s_tag.id )';
	
	$x=0;
	foreach ( $sql_tagi as $s )
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			$tag_query .= " INNER JOIN s_".$nazwa_tagu." ON s_tag.id_".$nazwa_tagu." = s_".$nazwa_tagu.".id) "; 
		}
		$x++;
	}
	
	$tag_query .= ' WHERE s_produkt.id_tag = '.$id_tag;
	//echo $tag_query; // uwzglednic id produktu !!!
	$sql_results = $mydb->get_results($tag_query, ARRAY_N);
	$index = 1;
	$tagi = '<table id="tag_table">';
	$link = 'http://naopak.com.pl/item';
	foreach ( $sql_results as $row )
	{ 		
		for($index; $index<$number;$index++)
		{			
			$nazwa_tagu = substr_replace($sql_tagi[$index][0], "", 0, 3);
			$tagi .= '<tr>';
			$tagi .= "<td>".$nazwa_tagu.": </td>";
			$tagi .= "<td id=\"tag_table_wartosc\"><a href=\"".$link."&typ_tagu=".$nazwa_tagu."&nazwa_tagu=".$row[$index-1]."\">".$row[$index-1]."</a></td>";
			$tagi .= '</tr>';
		}	
	}
	
	$tagi .= '</table>';
	
	/* <?php echo $nazwa; ?> */
	
  ?>
  
<?php


	
function get_logo($prod_id)
{
	$path = "img/user_logo/";

	$rand = rand(100,999);

	$logo = '<img src="img/user_logo/logo_'.$prod_id.'.jpg?'.$rand.'" alt="logo" />';

	echo $logo;
}
function list_img($prod_id, $filecount)
{
	$rand = rand(100,999);
	
	$file_list='<table id="thumbs_table" class="thumbs_table"><tr>';
	
	$sql = "SELECT * FROM s_zdjecia WHERE id_produkt = '".$prod_id."'";
	$id_sql = mysql_query($sql);
	$sql_result = mysql_fetch_row($id_sql);
	
	
	for($i=0; $i<7; $i++)
	{		
		//if($i<$filecount)
		if($sql_result[$i+2]!='')
		{
			/*
			$file_list.="<td><a class=\"image\" rel=\"img/products/".$prod_id."/id_prod_medium_".$i."_".$prod_id.".jpg\" rel2=\"img/products/".$prod_id."/id_prod_big_".$i."_".$prod_id.".jpg\"><img src=\"img/products/".$prod_id."/id_prod_small_".$i."_".$prod_id.".jpg?".$rand."\" alt=\"image\" class=\"thumb\" /></a></td>";
			*/
			$file_list.="<td><a class=\"image\" rel=\"img/products/".$prod_id."/".$sql_result[$i+2]."_b.jpg\" rel2=\"img/products/".$prod_id."/".$sql_result[$i+2]."_n.jpg\"><img src=\"img/products/".$prod_id."/".$sql_result[$i+2]."_t.jpg?".$rand."\" alt=\"image\" class=\"thumb\" /></a></td>";
		}
		else
		{
			$file_list.="<td><img src=\"img/mini_gray.jpg\" alt=\"image\" /></td>";
		}
	} 
	
	$file_list.='</tr></table>';
	echo $file_list;
}
$rand = rand(100,999);

	
	$sql = "SELECT * FROM s_zdjecia WHERE id_produkt = '".$id_prod."'";
	$id_sql = mysql_query($sql);
	$sql_result = mysql_fetch_row($id_sql);
	//print_r($sql_result);
	$img_nr_0 = $sql_result[2];
	
	//echo "<br />img nr 1: ".$img_nr_0."<br />";
?>

<div id="product">


      <div id="galeria">
            <div id="image">
           	 <a id="single_image" href="img/products/<? echo $id_prod.'/'.$img_nr_0; ?>_n.jpg<? echo "?$rand"; ?>"><img src="img/products/<? echo $id_prod.'/'.$img_nr_0; ?>_b.jpg<? echo "?$rand"; ?>" alt="" border="0"/></a>
            </div>
	  <?php 
	  	$path = "img/products/".$id_prod."/";
		//$filecount = count(glob($path . "*_small_*.jpg"));
	  	list_img($id_prod, $filecount);
		?></div>
      <div id="opis_produktu">
          <div id="naglowek_opisu">
              <div id="nazwa_produktu"><?php echo $nazwa;?><h4><?php echo $nazwa_projektanta;?></h4></div>
              <div id="cena"><span class="kwota" ><?php echo $cena."zł"; ?></span>
              
              <?php  
			  
			  if($dostepnosc == 0)  
			  {
			  
              	echo "<h6>sprzedany</h6>";
               
			  }else if($dostepnosc == 1)
			  {
			  ?>
              <span class="kup_teraz_btn">
	              <a id="add_produkt" href="#" name="<?php echo $id_prod; ?>">do koszyka</a>
              </span>
              <?php 
			  }
			  ?>
              </div>
          </div>
          <div id="opis"><?php echo $opis; ?></div>
          <div id="tagi"><?php echo $tagi; ?></div>
          <div id="stopka_opisu">
	          <div id="logo">
				  <a class="link" id="gallery" href="#" name="<?php echo $id_prod; ?>">galeria</a> | 
				  <a class="link" id="kontakt" href="#" name="<?php echo $id_prod; ?>">kontakt</a> | 
				  <a class="link" id="add_fav" href="#" name="<?php echo $id_prod; ?>">dodaj do ulubionych</a>
				  <?php get_logo($id_projektant); ?>
              <br /></div>
          </div>
      </div>
  </div>
  <div id="inne">
<?

$query_id_premium = "SELECT prod_id FROM s_produkt WHERE dostepnosc = 1 AND id_projektant = ".$id_projektant." ORDER BY RAND() LIMIT 5";
$sql_results = $mydb->get_results($query_id_premium, ARRAY_N);

$inne_projektanta = "Inne przedmioty tego projektanta:<br>";

foreach($sql_results as $s)
{
	
	$query_foto= "SELECT zdj1 FROM s_zdjecia WHERE id_produkt = '".$s[0]."'";
	$sql_results = $mydb->get_row($query_foto, ARRAY_A);

	$inne_projektanta .= '
	<a href="http://naopak.com.pl/item?prod_id='.$s[0].'">
	<img src="img/products/'.$s[0].'/'.$sql_results['zdj1'].'_t.jpg?'.$rand.'" />
	</a>
	';
}

$query_id_premium = "SELECT prod_id FROM s_produkt WHERE dostepnosc = 1 AND id_kategoria = ".$kategoria." ORDER BY RAND() LIMIT 5";
$sql_results = $mydb->get_results($query_id_premium, ARRAY_N);

$inne_kategoria = "Inne przedmioty z tej kategorii:<br>";

foreach($sql_results as $s)
{
	/*$inne_kategoria .= 
	'
	<a href="http://naopak.com.pl/item?prod_id='.$s[0].'">
	<img src="img/products/'.$s[0].'/id_prod_inne_0_'.$s[0].'.jpg?'.$rand.'" />
	</a>
	';*/
	
	$query_foto= "SELECT zdj1 FROM s_zdjecia WHERE id_produkt = '".$s[0]."'";
	$sql_results = $mydb->get_row($query_foto, ARRAY_A);

	$inne_kategoria .= '
	<a href="http://naopak.com.pl/item?prod_id='.$s[0].'">
	<img src="img/products/'.$s[0].'/'.$sql_results['zdj1'].'_t.jpg?'.$rand.'" />
	</a>
	';
}
?>  
  
	  <div class="inne_projektanta"><?php echo $inne_projektanta; ?></div>
      <div class="inne_z_kategorii"><?php echo $inne_kategoria; ?></div>
  </div>
<? 
}else{
?>
<center><h1>Produkt nie istnieje lub podano błędne dane !</h1></center>
<?
} 
}
else
{
?>
<center><h1>Produkt nie istnieje lub podano błędne dane !</h1></center>
<?	
}
?>
</div> <?php // closeing <div class="hfeed content"> ?>
<? mysql_close($connection); ?>
<?php get_footer(); ?>
