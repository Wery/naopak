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
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		mysql_query('set names utf8;');

		
		global $current_user;
		$customerid=$current_user->ID;
		
		echo $_SESSION['test'];
		
		$max=count($_SESSION['cart']);
		$pid=$_SESSION['cart'][0]['productid'];
		//echo "</br>max = $max</br>id = $pid";
		
		//$result = mysql_query("SELECT MAX(id) FROM `s_zamowienie`");
		//$last_id=mysql_fetch_array($result);
			
		date_default_timezone_set('Europe/Warsaw');
		$nr_zamowienia = date('mdY', time()).'/'.$customerid."/".rand(0,1000);

		echo "</br>nr_zamowienia = $nr_zamowienia</br>";
		
		$projektanci =  array();
		for($i=0;$i<$max;$i++)
		{
			$pid=$_SESSION['cart'][$i]['productid'];
			$result = mysql_query("SELECT id_projektant FROM `s_produkt` WHERE id ='".$pid."'") or die("select projektant");
			$producent=mysql_fetch_array($result);
			if(!in_array($producent[0], $projektanci))
				array_push($projektanci, $producent[0]);
		}
		
		$array_size = count($projektanci);
		$i = 0;
		//echo "</br>array_size = $array_size</br>";
		//for($i; $i < $array_size ;$i++)
		//{			
				mysql_query("INSERT INTO s_zamowienie (nr_zamowienia, data, id_klient) VALUES ('$nr_zamowienia', NOW(), '$customerid')") or die("insert to zamowienia: ".mysql_error());
		
		//}
		//$orderid=mysql_insert_id();								
	
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];	

			mysql_query("INSERT INTO s_zamowione_produkty (id_zamowienia, id_produkt) VALUES ('$nr_zamowienia', '$pid')") or die("insert to zam prod:  ".mysql_error());		
			mysql_query("UPDATE s_produkt SET dostepnosc = '0' WHERE s_produkt.id = '".$pid."'") or die("updae: ".mysql_error());	
		}
		
		mysql_query("INSERT INTO s_historia (id_zamowienia, id_status, komentarz, data) VALUES ('$nr_zamowienia', '1', 'realizacja', NOW())") or die("historia: ".mysql_error());

		

	//unset($_SESSION['cart']);
		
	$temat = "Zamówienie";
	$do = "admin";
	$od = $current_user->user_login;
	$tresc = "tresc wiadomosci";
	$data = current_time('mysql');

	$result = mysql_query("INSERT INTO s_pm (id, temat, od, do, data, tresc, od_przeczytane, do_przeczytane, od_usuniete, do_usuniete, od_admin, admin_przeczytane, admin_usuniete) VALUES (NULL, '$temat', '$od', '$do', '$data', '$tresc', 0, 0, 0, 0, 1, 0, 0);") or die(mysql_error());  
		
		
 $to = "mwerynowski@gmail.com";//$current_user->user_login;
 $subject = "Potwierdzenie złożenia zamówienia!";
 $body = "Potwierdzenie zamówienia";
 $headers = "From: werycreative@gmail.com";
 $headers .= "Reply-To: jakis@mail.com";
  mail($to, $subject, $body, $headers);

 //header( 'Location: http://naopak.com.pl/' ) ;
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

echo "Dziękujemy za złożenie zamówienia w naszym portalu. Potwierdzenie zamówienia zostało wysłane na Twoją skrzynkę pocztową. </br>Zapraszamy ponownie !</br></br>Za 5 sekund zostaniesz przeniesiony do swojego konta.";
}
?>
</div>
<?php get_footer(); ?>
