<?
	function delete_directory($dirname) {
			 if (is_dir($dirname))
			   $dir_handle = opendir($dirname);
		 if (!$dir_handle)
			  return false;
		 while($file = readdir($dir_handle)) {
			   if ($file != "." && $file != "..") {
					if (!is_dir($dirname."/".$file))
						 unlink($dirname."/".$file);
					else
						 delete_directory($dirname.'/'.$file);
			   }
		 }
		 closedir($dir_handle);
		 rmdir($dirname);
		 return true;
	}

    $connection = @mysql_connect('localhost', 'root', '');
    $db = @mysql_select_db('bollo_naopak', $connection);
	
	$sql = "SELECT id_produkt
			FROM s_zdjecia z
			WHERE NOT 
			EXISTS (
			SELECT prod_id
			FROM s_produkt p
			WHERE z.id_produkt = p.prod_id
			)";
			
	$result = mysql_query($sql) or die(mysql_error()); 
	
	while($row = mysql_fetch_array($result)){
		echo "<br>deleteing: ".$_SERVER['DOCUMENT_ROOT']."/img/products/".$d;
		
		delete_directory($_SERVER['DOCUMENT_ROOT']."/img/products/".$d);	
		
		mysql_query("DELETE FROM s_zdjecia WHERE id_produkt ='".$row['id_produkt']."'") 
		or die(mysql_error());  
	}	
	
	//echo $_SERVER['DOCUMENT_ROOT'];
	$dirs = array_filter(glob($_SERVER['DOCUMENT_ROOT']."/img/products/*"), 'is_dir');
	//print_r( $dirs);
	
	//foreach($dirs as $d)
		//echo "<br>- $d";
	
	$i=0;
	foreach($dirs as $d)
	{
		$id = basename($d);
			
		$sql = "SELECT z.id_produkt, p.prod_id
				FROM s_zdjecia z
				INNER JOIN s_produkt p ON z.id_produkt = p.prod_id
				WHERE z.id_produkt = '$id'	";

		$result = mysql_query($sql) or die(mysql_error());	
		
		if(mysql_num_rows($result) > 0)
		{			
			echo "<br>folder jest poprawny: $id";
		}	
		else
		{
			echo "<br>Ten folder nie wystepuje w bazie: $id";
			echo "<br>usuwam...";
			delete_directory($d);
		}
		$i++;
	}

	$sql = "SELECT id_produkt FROM s_zdjecia";
	$result = mysql_query($sql) or die(mysql_error());	
	$zdjeciaCounter = mysql_num_rows($result);
	
	$sql = "SELECT prod_id FROM s_produkt";
	$result = mysql_query($sql) or die(mysql_error());	
	$produktyCounter = mysql_num_rows($result);

	echo "<br> ilosc zdjec: $zdjeciaCounter";	
	echo "<br> ilosc produktow: $produktyCounter";
		
	mysql_close($connection);
?>