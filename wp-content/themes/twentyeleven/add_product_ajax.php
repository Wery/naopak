<?
    $connection = @mysql_connect('localhost', 'root', '');
    $db = @mysql_select_db('bollo_naopak', $connection);

	mysql_set_charset('utf8',$connection); 
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	mysql_query('set names utf8;');
	
	parse_str($_POST['form'], $params);
	$prod_id=$params['prod_id'];
	$id_projektant=$params['proj_id'];
	
	if(isset($_POST['img_array'])&&!is_null($_POST['img_array']))
		$img_array = $_POST['img_array'];
	else
		$img_array = NULL;
		
	//print_r($img_array);	
		
	$kwArray = $_POST['kwArray'];
	print_r($kwArray);
	
	mysql_query("SET AUTOCOMMIT=0");
	mysql_query("START TRANSACTION");

	
   	$tagNames=array();
	$tagValues=array();
			
	$output = '';
	$tagi = '';
	$end=0;
	while (current($params)) 
	{
		$key = key($params);
		$cur_par = current($params);
		
		if(next($params) === false)
		{
			$end = 1;	
		}
		
		
		if(strpos($key,'prod_id')!==false)
		{
			continue;
		}
		if(strpos($key,'proj_id')!==false)
		{
			continue;
		}
		if(strpos($key,'tag_id')!==false)
		{
			continue;
		}
		
		if(strpos($key,'tag_')===false)
		{
		    
			if($key==="nazwa_produktu")
				$key='nazwa';

			if($key==="kategoria")
				$key='id_kategoria';
				
			if(!is_numeric($cur_par))
			{
			  $output .= $key." = '".$cur_par."'";
			}
			else
			{
			  $output .= $key." = ".$cur_par;
			}
			
			if(current($params)&&$key!=='id_kategoria')
			{
			  $output .= ", ";
			}	
		}
		else
		{
			$key = str_replace('tag_','id_',$key);
			
   		    array_push($tagNames,$key);
			array_push($tagValues,$cur_par);
		}				
	}
	
	$sql_insert_tag = "INSERT IGNORE INTO s_tag (";
	$tagCunter = count($tagNames);
	for($i=0;$i<$tagCunter;$i++)
	{
		if($i==($tagCunter-1))
			$sql_insert_tag .= $tagNames[$i];
		else
			$sql_insert_tag .= $tagNames[$i]." , ";
	}
	
	$sql_insert_tag .= ")";
	
	
	$sql_insert_tag .= " VALUES (";
	$tagCunter = count($tagNames);
	for($i=0;$i<$tagCunter;$i++)
	{
		if($i==($tagCunter-1))
			$sql_insert_tag .= $tagValues[$i];
		else
			$sql_insert_tag .= $tagValues[$i]." , ";
	}
	
	$sql_insert_tag .= ")";
	
	$r1 = mysql_query($sql_insert_tag);
	echo "\n\n$sql_insert_tag\n\n";
	
	$tagid = mysql_insert_id();
	echo "\ntag id: $tagid\n";
	
	echo "\nimg array size: ".count($img_array)."\n";
	
//	$dirname = '../../../img/products/'.$prod_id.'/';
	$r2=1;
	if(count($img_array)>0)	
	{
			$img_query = "SELECT * FROM s_zdjecia WHERE id_produkt='".$prod_id."' ";
			$result = mysql_query($img_query) or die(mysql_error()); 
			   
			if ( mysql_num_rows($result) )
			{
				$querysql = "UPDATE s_zdjecia SET ";
				$max=count($img_array);
				for($i=1;$i<=7;$i++)
				{ 		
					if($i<=$max)			
					{
						$file=$img_array[$i-1];
						if($max==7)		
							$querysql .= "zdj".($i)." = '".$file."' ";
						else
							$querysql .= "zdj".($i)." = '".$file."', ";
						//delete($dirname, $file);
					}
					else 
					{
						if($i==7)		
							$querysql .= "zdj".($i)." = '' ";		
						else
							$querysql .= "zdj".($i)." = '', ";
					}		
				}	
			
				$querysql .= " WHERE id_produkt = '".$prod_id."'";
				
			}
			else
			{
				/*				
				INSERT INTO s_zdjecia (id_produkt,zdj1,zdj2,zdj3,zdj4,zdj5,zdj6,zdj7)
				VALUES ('qwe', '1', '2', '3', '4', '5', '6', '7');
				*/
				
				$querysql = "INSERT IGNORE INTO s_zdjecia";
				$querysql .= " (id_produkt,zdj1,zdj2,zdj3,zdj4,zdj5,zdj6,zdj7)";
				$querysql .= " VALUES ('".$prod_id."', ";
				
				$max=count($img_array);
				for($i=1;$i<=7;$i++)
				{ 		
					if($i<=$max)			
					{
						$file=$img_array[$i-1];
						if($max==7)		
							$querysql .= "'".$file."' ";
						else
							$querysql .= "'".$file."', ";
						//delete($dirname, $file);
					}
					else 
					{
						if($i==7)		
							$querysql .= "'' ";		
						else
							$querysql .= "'', ";
					}		
				}	
				
				$querysql .= ")";				
			}
			
			echo "\n\nimg query: $querysql\n\n";
			$r2 = mysql_query($querysql);
			
		/* *************************************************************************** */	
		
		echo "\nFOTO QUERY:\n".$querysql;	
	}
	
	$prod_insert_sql = "INSERT IGNORE INTO s_produkt (prod_id, nazwa, cena, opis, szerokosc, wysokosc, glebokosc, waga, dostepnosc, id_projektant, id_kategoria, id_tag, data_dodania, promowany) VALUES ('"
		.$prod_id."','"
		.$params['nazwa_produktu']."',"
		.$params['cena'].",'"		
		.nl2br($params['opis'])."',"
		.$params['szerokosc'].","
        .$params['wysokosc'].","
        .$params['glebokosc'].","
        .str_replace(',','.',$params['waga']).",
		1,".$id_projektant.","
		.$params['kategoria'].","
		.$tagid.", 
		CURDATE() 
		,0)"; 
	
	echo "\n\nprod_insert_sql:\n".$prod_insert_sql;
	$r3 = mysql_query($prod_insert_sql)  or die(mysql_error()); 
	
	echo "\n\n";
	$kwCounter = count($kwArray);
	$r4=0;
	for($i=0;$i<$kwCounter;$i++)
	{
			$kwQuery = "INSERT IGNORE INTO s_koszty_przesylki (prod_id, cena, opis)VALUES ('".$prod_id."', '".$kwArray[$i]['cena']."', '".$kwArray[$i]['opis']."')";
			$r4 = mysql_query($kwQuery) or die(mysql_error()); 
			//echo $kwArray[$i]['cena']."\n";
			//echo $kwArray[$i]['opis']."\n";
			echo "\n$kwQuery\n";
	}
		
	if ($r1 and $r2 and $r3 and $r4) {
		mysql_query("COMMIT");
		echo "\nSUCCES\n";
	} else {
		mysql_query("ROLLBACK");
		echo "\nERROR\n";
	}
	
	mysql_close($connection); 

	//echo "\n\nTAG QUERY:\n".$sql_update_tag_query."\n\nPROD QUERY:\n".$sql_update_product_query;	
	//echo "\n\nkoszt wysylki:\n";
	//print_r($kwArray);
	//echo "\n\nimages:\n";
	//print_r($img_array);
	
	
	

?>