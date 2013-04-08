<?php
/**
 * @package Template For WordPress
 *
 * @author: Wery
 * @url: http://www.CustomWeb.com
 
 Template Name: Podsumowanie Zakupow Template
 
 */
 ?>
<?php
session_start();
//$nr_zamowienia = uniqid();
function add_scripts()
{
	
	/*echo '
		<meta http-equiv="refresh" content="5; url=http://localhost/wordpress/?page_id=197">
	';*/
}
add_action('wp_head', 'add_scripts');

get_header();
?>

<?


if ( is_user_logged_in() ) {

		//include("koszyk_functions.php");
		
		$connection = mysql_connect('localhost', 'root', '');
		$db = mysql_select_db('bollo_naopak', $connection);
		mysql_set_charset('utf8',$connection); 
		
		mysql_query('SET character_set_connection=utf8;');
		mysql_query('SET character_set_client=utf8;');
		mysql_query('SET character_set_results=utf8;');
		mysql_query('set names utf8;');

		
		
	
		global $current_user;
		$customerid=$current_user->ID;
		
		echo $_SESSION['test'];
		
		$max=count($_SESSION['cart']);
		//$pid=$_SESSION['cart'][0]['productid'];
		//echo "</br>max = $max</br>id = $pid";
		
		//$result = mysql_query("SELECT MAX(id) FROM `s_zamowienie`");
		//$last_id=mysql_fetch_array($result);
					
		if(isset($_SESSION['naopak_cart_shipping']['nr_zam']))
		{
			$nr_zamowienia = $_SESSION['naopak_cart_shipping']['nr_zam'];
		}
		else
		{
			date_default_timezone_set('Europe/Warsaw');
			$nr_zamowienia = date('mdY', time()).'/'.$customerid."/".rand(0,1000);
		
		}
		
		
		echo "</br>nr_zamowienia = $nr_zamowienia</br>";
		/*
		$projektanci =  array();
		for($i=0;$i<$max;$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$result = mysql_query("SELECT id_projektant FROM `s_produkt` WHERE id ='".$pid."'") or die("select projektant");
			$producent=mysql_fetch_array($result);
			if(!in_array($producent[0], $projektanci))
				array_push($projektanci, $producent[0]);

$_SESSION['naopak_cart_shipping'][0]['id_przesylki'];
$_SESSION['naopak_cart_shipping'][0]['prod_id'];
		}*/
		
		
		$r=0;
		$SQL_ARRAY = array();
		
		$projektanci =  count($_SESSION['naopak_cart_shipping']);
		$projektanci-=1;
		for($i=0;$i<$projektanci;$i++)
		{
			$sql_przesylka = "INSERT INTO s_zamowienie_przesylka (id_zamowienia, id_producent, id_koszt_przesylki) VALUES ('".$nr_zamowienia."', '".$_SESSION['naopak_cart_shipping'][$i]['prod_id']."', '".$_SESSION['naopak_cart_shipping'][$i]['id_przesylki']."');";
			array_push($SQL_ARRAY,$sql_przesylka);
			//echo "<br />$sql_przesylka<br />";
			//$r&=mysql_query($sql_przesylka);// or die("sql_przesylka $i: ".mysql_error());
		}
		
		
		
		//$array_size = count($projektanci);
		//$i = 0;
		//echo "</br>array_size = $array_size</br>";
		//for($i; $i < $array_size ;$i++)
		//{			
				/*mysql_query("INSERT INTO s_zamowienie (nr_zamowienia, data, id_klient, id_przesylka) VALUES ('$nr_zamowienia', NOW(), '$customerid')") or die("insert to zamowienia: ".mysql_error());*/
		$sql_zam="INSERT INTO s_zamowienie (nr_zamowienia, data, id_klient) VALUES ('$nr_zamowienia', NOW(), '$customerid');";
		
		//echo "<br />$sql_zam<br />";
		//$r&=mysql_query($sql_zam);// or die("insert to zamowienia: ".mysql_error());
		array_push($SQL_ARRAY,$sql_zam);
		//}
		//$orderid=mysql_insert_id();								
	
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];	
			$sql_zam_prod ="INSERT INTO s_zamowione_produkty (id_zamowienia, id_produkt) VALUES ('$nr_zamowienia', '$pid');";
			//$r&=mysql_query($sql_zam_prod);// or die("sql_zam_prod: ".mysql_error());
			array_push($SQL_ARRAY,$sql_zam_prod);
			//echo "<br />$sql_zam_prod<br />";
			
			$sql_update="UPDATE s_produkt SET dostepnosc = '0' WHERE s_produkt.prod_id = '".$pid."';";
			//echo "<br />$sql_update<br />";
			//$r&=mysql_query($sql_update);// or die("sql_update: ".mysql_error());		
			array_push($SQL_ARRAY,$sql_update);
		}
		
		$sql_hist = "INSERT INTO s_historia (id_zamowienia, id_status, komentarz, data) VALUES ('$nr_zamowienia', '1', 'realizacja', NOW());";
		//$r&=mysql_query($sql_hist);// or die("sql_hist: ".mysql_error());	
		array_push($SQL_ARRAY,$sql_hist);
		//echo "<br />$sql_hist<br />";

	//unset($_SESSION['cart']);
		
	$temat = "Zamówienie";
	$do = "admin";
	$od = $current_user->user_login;
	$tresc = "Zamówienie nr: ".$nr_zamowienia;
	$data = "NOW()";//current_time('mysql');
		
	$sql_admin_msg = "INSERT INTO s_pm (id, temat, od, do, data, tresc, od_przeczytane, do_przeczytane, od_usuniete, do_usuniete, od_admin, admin_przeczytane, admin_usuniete) VALUES (NULL, '$temat', '$od', '$do', $data, '$tresc', 0, 0, 0, 0, 1, 0, 0);";
//	$r&=mysql_query($sql_admin_msg);// or die("sql_admin_msg: ".mysql_error());
	array_push($SQL_ARRAY,$sql_admin_msg);			
	//echo "<br />$sql_admin_msg<br />";
		
		
 $to = "mwerynowski@gmail.com";//$current_user->user_login;
 $subject = "Potwierdzenie złożenia zamówienia!";
 $body = "Potwierdzenie zamówienia";
 $headers = "From: werycreative@gmail.com";
 $headers .= "Reply-To: jakis@mail.com";
 // mail($to, $subject, $body, $headers);

 //header( 'Location: http://naopak.com.pl/' ) ;
 
// mysql_query("SET AUTOCOMMIT=0");
// mysql_query("START TRANSACTION");
 mysql_query("BEGIN");
 $r=mysql_query($SQL_ARRAY[0]);
 for($i=1;$i<count($SQL_ARRAY);$i++)
 {
	$r&=mysql_query($SQL_ARRAY[$i]);
	echo "<br />".$SQL_ARRAY[$i];
 }
 	if ($r) {
		mysql_query("COMMIT");
		unset($_SESSION['naopak_cart_shipping']);
		unset($_SESSION['cart']);		
		echo "\nSUCCES\n";
	} else {
		mysql_query("ROLLBACK");
		echo "\nERROR:\n".mysql_error();
	}
	
	
}
else
{
	//echo '<script> location.href =
	echo "<center><b>Najpierw sie zaloguj !<b></center><br /><br />";
}
?>

<div class="hfeed content">
<?php
if ( is_user_logged_in() ) {

//echo "Klient o id: $customerid dokonał zamówienia o id: $nr_zamowienia </br>";
/*
echo "Dziękujemy za złożenie zamówienia w naszym portalu. Potwierdzenie zamówienia zostało wysłane na Twoją skrzynkę pocztową. </br>Zapraszamy ponownie !</br></br>Za 5 sekund zostaniesz przeniesiony do swojego konta.";*/
}
?>
</div>
<?php get_footer(); ?>
