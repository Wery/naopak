<?php
session_start();
parse_str($_POST['form'], $params);
//$img_array = $_POST['img_array'];
function trim_text($input, $length, $ellipses = true, $strip_html = true) {
    //strip tags, if desired
    if ($strip_html) {
        $input = strip_tags($input);
    }
  
    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) {
        return $input;
    }
  
    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    $trimmed_text = substr($input, 0, $last_space);
  
    //add ellipses (...)
    if ($ellipses) {
        $trimmed_text .= '...';
    }
  
    return $trimmed_text;
}
$show=0;
if(isset($params['show']))
{
	$show = $params['show'];
	$_SESSION["show_method"] = $show;
	//echo "\nShow mode is set to: ".$show; 
}
else
{
	//echo "\nShow mode is not set to: ".$show."\n"; 
	if(isset($_SESSION["show_method"]))
	{
		$show = $_SESSION["show_method"];
		//echo "\nShow mode session is set, change to: ".$show; 
	}
}

	
	$where_array = Array();
	$array_index=0;
	$tmp_value='';

  	$kolor = $params['kolor'];
	if(isset($kolor))
	{
		if($kolor != "-1")
		{
			$tmp_value = ' s_kolor.nazwa = "'.$kolor.'" ';
			array_push($where_array, $tmp_value);
		}
	}
		
	$subcat_id = "";
	if(isset($params['subcat'])&&$params['subcat']!=="all")
	{
		$subcat_id = $params['subcat'];
		$tmp_value = ' t_subcategory.subID = '.$subcat_id.' ';
		array_push($where_array, $tmp_value);
	}

	
	$cat_id = "";
	if (isset($params['cat'])&&$params['cat']!=="all")
	{ 
		$cat_id = $params['cat'];
		$tmp_value = ' t_subcategory.catID = '.$cat_id.' ';
		array_push($where_array, $tmp_value);
	} 
	
	//$tag_typ =$params['typ_tagu'];
	if (isset($params['typ_tagu']))
	{ 
		$tag_name = $params['nazwa_tagu'];
		
		$tmp_value = ' s_'.$params['typ_tagu'].'.nazwa = \''.$tag_name.'\'';
		array_push($where_array, $tmp_value);
	} 
	
	$cena_min = $params['cena_min'];
	$cena_max = $params['cena_max'];
	if (isset($cena_min) || isset($cena_max))
	{ 
		if($cena_min != "")
		{
			$tmp_value = ' s_produkt.cena >= '.$cena_min.' ';
			array_push($where_array, $tmp_value);
		}
		if($cena_max != "")
		{
			$tmp_value = ' s_produkt.cena <= '.$cena_max.' ';
			array_push($where_array, $tmp_value);
		}
	} 
	
	$material = $params['material'];
	if(isset($material))
	{
		if($material != "-1")
		{
			$tmp_value = ' s_material.nazwa = "'.$material.'" ';
			array_push($where_array, $tmp_value);
		}
	}
      
	 // echo "page = ".$params['page'];
if(isset($params['page'])&&$params['page'])
{
    
$dni = 21;
$data = date("Y-m-d");
	
 //function sql_query_gen($connection){
   
    //include"db.php"; 
	$connection = mysql_connect('localhost', 'root', '');
    $db = mysql_select_db('bollo_naopak', $connection);
	mysql_set_charset('utf8',$connection); 
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	mysql_query('set names utf8;');
	
	$query = "SHOW COLUMNS FROM `s_tag`";
	$sql_tagi = mysql_query($query);
	$number = mysql_num_rows($sql_tagi);	
	//while($row = mysql_fetch_array($result))	
	//{ 
	//}

	$query_lista_g="SELECT s_produkt.prod_id, s_produkt.nazwa AS nazwa_produktu, s_produkt.cena, s_produkt.opis, s_produkt.data_dodania, s_producenci.nazwa AS producent, t_subcategory.nazwa AS sub_nazwa, t_subcategory.catID, ";
	
	$x=0;
	//foreach ( $sql_tagi as $s )
	while($s = mysql_fetch_array($sql_tagi))	
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			if($x < $number-1)
			{
				$query_lista_g .= "s_".$nazwa_tagu.".nazwa AS ".$nazwa_tagu.", "; 
			}
			else
			{
				$query_lista_g .= "s_".$nazwa_tagu.".nazwa AS ".$nazwa_tagu." ";
			}

		}
		$x++;
	}
	
	$query_lista_g .= ' , s_produkt.dostepnosc FROM (';
	
	for($i = 0; $i < $x; $i++)
	{
		$query_lista_g .= '(';
	}
	
	$query_lista_g .= ' s_produkt INNER JOIN s_tag ON s_produkt.id_tag = s_tag.id )';
	
	$x=0;
	mysql_data_seek($sql_tagi,0);
	//foreach ( $sql_tagi as $s )
	while($s = mysql_fetch_array($sql_tagi))
	{
		if($x>0)
		{		
			$nazwa_tagu = substr_replace($s[0], "", 0, 3);
			$query_lista_g .= " INNER JOIN s_".$nazwa_tagu." ON s_tag.id_".$nazwa_tagu." = s_".$nazwa_tagu.".id) "; 
		}
		$x++;
	} 
	
	if(!empty($where_array))
	{
		$where_query = "WHERE s_produkt.dostepnosc = 1 AND ";
///		$where_query_count = "WHERE dostepnosc = 1 AND "
		$xxx = 0;
		
		foreach($where_array as $w)
		{
			if($xxx == 0)
			{
				$where_query .= $w;	
				$xxx = 1;
			}
			else
			{
				$where_query .= " AND".$w;	
			}
		}
	}
	else
	{
		$where_query = "WHERE s_produkt.dostepnosc = 1 ";
	}
	
	$query_lista_g .= ' LEFT JOIN s_producenci ON s_produkt.id_projektant = s_producenci.id) LEFT JOIN t_subcategory ON s_produkt.id_kategoria = t_subcategory.subID '.$where_query.' ORDER BY s_produkt.data_dodania DESC';


$page = $params['page'];
$cur_page = $page;
$page -= 1;
$per_page = 16;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$count_sql = $query_lista_g;
$query_lista_g.=" LIMIT $start, $per_page";

	//echo $query_lista_g;
$query_pag_data = $query_lista_g;//"SELECT msg_id,message from messages LIMIT $start, $per_page";

//$msg = $query_pag_data;
//echo $query_pag_data;
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error: ' . mysql_error());
$msg = "";
//****************************************


    
if($show == 0){
	$id_prod="";
	$nazwa="";
	$cena="";
	$opis="";
	$projektant="";
	$wymiary=""; 
	$kategoria="";
	$data_dodania="";
	$nazwa_projektanta="";
	$dostepnosc=0;
    $tagi="";

	$i=0;
	$j=0;
	$number+=7;
	$galeria = "<table>";	

	
	while($row = mysql_fetch_array($result_pag_data))	
	{ 	

	  $id_prod=$row[0];
	  $nazwa=$row[1];
	  $cena=$row[2];
	  $opis=$row[3];
	  $data_dodania=$row[4];
	  $projektant=$row[5];
	  $kategoria=$row[6];
	  
	  $nazwa = (strlen($nazwa) > 22) ? substr($nazwa,0,22).'...' : $nazwa;
	  
	  for($j=7;$j<$number;$j++)
	  {	
		  $tagi.=$row[$j];
	  }
	  
	  if(($i%4)==0)
	  {
		  $galeria .= "<tr>";
	  }
	  
	  	$projektant_tmp = "brak nazwy";
		if($projektant == "")
		{
			$projektant = $projektant_tmp;
		}
		
		$sql = "SELECT * FROM s_zdjecia WHERE id_produkt = '".$id_prod."'";
		$id_sql = mysql_query($sql);
		$sql_result = mysql_fetch_row($id_sql);

		$pic = "img/products/$id_prod/$sql_result[2]_l.jpg";
		
	  	if (!file_exists($_SERVER['DOCUMENT_ROOT']."/".$pic)) 
		{ 	 
			$pic = "img/no_pic.png"; 
		}
	$pozostalo = (strtotime($data) - strtotime($data_dodania)) / (60*60*24);
	if($pozostalo < $dni)
	{
		$img_tag = "<img src=\"http://naopak.com.pl/img/nowe.png\" alt=\"image\" style=\"display: block; background-image: url(http://naopak.com.pl/$pic); opacity: 1;\" />";
	}
	else
	{
		$img_tag = "<img src=\"http://naopak.com.pl/$pic\" alt=\"image\" />";
	}
		$page=$params['page'];
		$galeria .= "<td><div id=\"produkt\">
		<a class=\"link_css\" href=\"http://naopak.com.pl/item?prod_id=".$id_prod."
&cat=$cat_id&subcat=$subcat_id&page=$page&cena_max=$cena_max&cena_min=$cena_min&kolor=$kolor&material=$material\">		
		<div id=\"obraz_produktu\">$img_tag</div> 
		<div id=\"nazwa_produktu\">$nazwa</div>  
		<div id=\"info_produktu\">
		<div id=\"projektant_produktu\">$projektant</div>
		<div id=\"cena_produktu\">$cena zł</div>
		</div></a>
		</div></td>";

		if(($i%4)==3)
		{
			$galeria .= "</tr>";
		}

		$i++;		
	}

	$galeria .= "</table>";
//	echo $galeria;
    $msg .= $galeria;
}
else if($show == 1)	
{
	
	//************************************** PRINT LIST

	//$sql_results = $wpdb->get_results($query_lista_g, ARRAY_N);

	$id_prod="";
	$nazwa="";
	$cena="";
	$opis="";
	$projektant="";
	$wymiary=""; 
	$kategoria="";
	$data_dodania="";
	$nazwa_projektanta="";
	$tagi="";
	$dostepnosc=0;
	$number+=7;
	$i=0;
	$j=0;
	
	$prod_list = "<table>";
	
	$sql_query = mysql_query("SHOW COLUMNS FROM `s_tag`");
	$nazwy_tagow = array();
	while($tmp = mysql_fetch_array($sql_query)){		
		array_push($nazwy_tagow, $tmp['Field']);
	}
	
	//foreach ( $sql_results as $row )
	while($row = mysql_fetch_array($result_pag_data))		
	{ 	
	
	  $id_prod=$row[0];
	  $nazwa=$row[1];
	  $cena=$row[2];
	  $opis=$row[3];
	  $data_dodania=$row[4];
	  $projektant=$row[5];
	  $kategoria=$row[6];
	  
 	  $nazwa = (strlen($nazwa) > 22) ? substr($nazwa,0,22).'...' : $nazwa;
	  
 	  $dostepnosc=$row[$number];
	  if($dostepnosc == 0)
	  	continue;
		
	 //$opis = substr($opis, 0, 201);
		$prod_list .= "<tr>";
	  
	  	$projektant_tmp = "brak nazwy";
		if($projektant == "")
		{
			$projektant = $projektant_tmp;
		}
		
		$sql = "SELECT * FROM s_zdjecia WHERE id_produkt = '".$id_prod."'";
		$id_sql = mysql_query($sql);
		$sql_result = mysql_fetch_row($id_sql);

		$pic = "img/products/$id_prod/$sql_result[2]_l.jpg";
	
	  	
		if (!file_exists($_SERVER['DOCUMENT_ROOT']."/".$pic)) 
		{ 	 
			$pic = "img/no_pic.png"; 
		}
		
		$pozostalo = (strtotime($data) - strtotime($data_dodania)) / (60*60*24);
		if($pozostalo < $dni)
		{
			$img_tag = "<img src=\"img/nowe.png\" alt=\"image\" style=\"display: block; background-image: url(http://naopak.com.pl/$pic); opacity:1;\" />";
		}
		else
		{
			$img_tag = "<img src=\"http://naopak.com.pl/$pic\" alt=\"image\" />";
		}
		
		$your_desired_width=220;
		if (strlen($opis) > $your_desired_width) 
		{
			$opis = trim_text($opis,$your_desired_width);
		}	
			
		$prod_list .= '<td class="">	
<div class="produkt_lista">
	<div class="zdjecie_lista">
		<a href="http://naopak.com.pl/item?prod_id='.$id_prod.'">			
			'.$img_tag.'</div>
		</a>
	<div class="info_lista">
	    <div class="tytul_lista">
	    	<h3>'.$nazwa.'</h3>        
			<h4>'.$projektant.'</h4>
	    </div>
	    <div class="dane_lista">
	    	<div class="opis_lista">'.$opis.'</div>
       		<div class="tagi_lista">';
	
	  $adres = 'http://naopak.com.pl/lista2';

	  $tagi="";
	  $i=1;
	  for($j=8;$j<$number;$j++)
	  {	
	  	  $nazwa_tagu = substr_replace($nazwy_tagow[$i], "", 0, 3);

     	  $link=$adres."?typ_tagu=".$nazwa_tagu."&nazwa_tagu=".$row[$j];
		  
		  $prod_list.=  $nazwa_tagu . ":
		  <a class=\"tag_nazwa\" href=\"".$link."\">".$row[$j]."</a></br>";
		  $i++;
	  }			
	  

			$prod_list.='</div>
    	</div>
		<div class="cena_lista">'.$cena.' zł</div>
	</div>	
</div>
		</td>';

		$prod_list .= "</tr>";
	}

	$prod_list .= "</table>";
	//echo $prod_list;
    $msg .= $prod_list;
}

//****************************************

/*
while ($row = mysql_fetch_array($result_pag_data)) {
$htmlmsg=htmlentities($row['message']);
    $msg .= "<li><b>" . $row['msg_id'] . "</b> " . $htmlmsg . "</li>";
}
$msg = "<div class='data'><ul>" . $msg . "</ul></div>"; // Content for Data
*/

/* --------------------------------------------- */
//$query_pag_num = "SELECT COUNT(*) AS count FROM s_produkt";
$result_pag_num = mysql_query($count_sql);
//$row = mysql_fetch_array($result_pag_num);
$count = mysql_num_rows($result_pag_num);//$row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>|<</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>|<</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'><</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'><</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:orange;font-weight:bold' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>></li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>></li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>>|</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>>|</li>";
}
$goto = "<input type='button' id='go_btn' class='go_button' value='Go'/><input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;float:right;'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Strona <b>" . $cur_page . "</b> z <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
echo $msg;
}

