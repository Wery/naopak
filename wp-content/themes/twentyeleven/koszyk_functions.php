<?
	$connection = mysql_connect('localhost', 'root', '') or die("Demo is not available, please try again later");
	@mysql_select_db('bollo_naopak', $connection) or die("Demo is not available, please try again later");
		mysql_set_charset('utf8',$connection); 
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		mysql_query('set names utf8;');
	session_start();
    
	$id = $_POST['id'];
	$funkcja = $_POST['funkcja'];
	
	switch($funkcja)
	{
		case 'add':
			addtocart($id);
		break;
		
		
	}
	
	//
	//	$connection = mysql_connect('localhost', 'root', '');
				   // $db = mysql_select_db('bollo_naopak', $connection);
					
	function get_product_name($pid){
		$result=mysql_query("select nazwa from s_produkt where prod_id = '".$pid."'");
		$row=mysql_fetch_array($result);
		return $row['nazwa'];
	}
	function get_price($pid){
		$result=mysql_query("select cena from s_produkt where prod_id = '".$pid."'");
		$row=mysql_fetch_array($result);
		return $row['cena'];
	}
	function remove_product($pid){
		//$pid=intval($pid);
		
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		} 
		$_SESSION['cart']=array_values($_SESSION['cart']);
		
		if(count($_SESSION['cart']) == 0)
			unset($_SESSION['cart']);
	}
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			//$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price;
		}
		return $sum;
	}
	function addtocart($pid){
		if($pid<1) return;
		
		if(is_array($_SESSION['cart'])){
		  echo 'in is_array';
			if(product_exists($pid)) return;
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max]['productid']=$pid;
		//	$_SESSION['cart'][$max]['qty']=$q;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$pid;
		//	$_SESSION['cart'][0]['qty']=$q;
		}
	}
	function product_exists($pid){
		//$pid=intval($pid);
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($pid==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>