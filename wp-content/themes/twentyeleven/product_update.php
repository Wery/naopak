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
	$id_tag=$params['tag_id'];
	$img_array = $_POST['img_array'];
	
		
	//echo "prod_id:$prod_id\n";
	//echo "id_projektant:$id_projektant\n";
	//echo "id_tag:$id_tag\n";
	//echo "\nPARAMS:\n$params\n\n";
	//echo "\nprint_r\n".print_r($params);
	//echo "\n\n";


	//echo print_r($img_array);
	$output = '';
	$tagi = '';
	//$test="   <br>*** tagi na pozycjach= ";
	$end=0;
	while (current($params)) 
	{
		$key = key($params);
		$cur_par = current($params);
		
		//$test.=$key." -- ".$cur_par." == ";
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
			$tagi .= $key." = ".$cur_par.", ";
		}
		
		
	}
	
	$tagi=substr($tagi,0,-2);

	$sql_update_tag_query = "UPDATE s_tag SET ";
	$sql_update_tag_query .= $tagi;
	$sql_update_tag_query .= " WHERE id = ".$id_tag;
	
	$sql_update_product_query = "UPDATE s_produkt SET "; 
	$sql_update_product_query .= $output;
	$sql_update_product_query .= " WHERE s_produkt.prod_id = '".$prod_id."'";


	@mysql_query($sql_update_tag_query);
	@mysql_query($sql_update_product_query);
	
		
	$sql = "UPDATE s_zdjecia SET ";
	$max=count($img_array);
	// uwzglednic warunekt na reszte zdjec...
	for($i=1;$i<=$max;$i++)
    { 
		if($i==$max)
		    $sql .= "zdj".($i)." = '".$img_array[$i-1]."' ";
		else
			$sql .= "zdj".($i)." = '".$img_array[$i-1]."', ";
    }	

	$sql .= " WHERE id_produkt = '".$prod_id."'";
	
	echo "\nFOTO QUERY:\n".$sql;
	
	mysql_query($sql);	
	
	mysql_close($connection); 

	echo "\n\nTAG QUERY:\n".$sql_update_tag_query."\n\nPROD QUERY:\n".$sql_update_product_query;
	

?>