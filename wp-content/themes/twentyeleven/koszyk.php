<?php
/**
 * @package Template For WordPress
 *
 * @author: Wery
 * @url: http://www.CustomWeb.com
 
 Template Name: Koszyk Template
 
 */
  session_start();
  error_reporting(E_ERROR | E_PARSE);
 ?>
<?php

include("koszyk_functions.php");


	if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
		}
	}
	
function add_scripts()
{	

echo '
	<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery.selectbox-0.2.min.js"></script>';
		echo '
	<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/css/jquery.selectbox.css" media="screen" />';
	
	echo '<script language="javascript">
	$(document).ready(function(){
	
		$("select[name*=\'przesylka_producent_\']").selectbox();
		/*{
			onChange: function (val, inst) {
					console.log("val= "+val);//+"  inst= "+inst);
					//console.log(inst);
					console.log("text: "+$(this).text());
				}
		});*/
		
		$("[name=remove]").click( function () {	
			var pid = $(this).attr("alt");
			del(pid);
		});
	
		$("select[name*=\'przesylka_producent_\']").on("change",function () {
			var KWarray = [];
			$(this).parent().next().children().next().text(parseInt($(this).val())+" zł"); 
			var cala_wysylka=0;
			
			$("span[name=\'kw_proj\']").each(function(){				
				var tmpCena = parseInt($(this).text());					
				cala_wysylka+=tmpCena;
			});
			
			var koszt_produktow=0;
			$("span[name=\'kp_proj\']").each(function(){
				var tmpCena = parseInt($(this).text());				
				koszt_produktow+=tmpCena;				
			});
			
			$("select[name*=\'przesylka_producent_\'] :selected").each(function(){
				//var tmpCena = parseInt($(this).text());					
				var tmpCena = $(this).parent().val();
				//console.log(tmpCena);
				var tmpOpis = $(this).text();
				//console.log(tmpOpis);	
				KWarray.push( {\'opis\':tmpOpis, \'cena\':tmpCena } );				
			});
			
			$("select[name*=\'przesylka_producent_\'] :selected").each(function(){
				$(this).attr("elected",false);
			});
			//console.log("tetetetetet");
			
			$.each(KWarray, function(i,item){			
				console.log("i= "+i+"  opis= "+item.opis+"  cena= "+item.cena);				
				$("input[name=\'cena[]\']:eq("+i+")").val(item.cena);										
				$("input[name=\'opis[]\']:eq("+i+")").val(item.opis);							
			});
			
			$(".koszyk_koszt_calkowity").children().next("div:eq(3)").text(cala_wysylka+" zł");
			var caly_koszt = cala_wysylka + koszt_produktow; 
			$(".koszyk_koszt_calkowity").children().next("div:eq(4)").children().next().text(caly_koszt+" zł");
			
			//alert("cala_wysylka: "+cala_wysylka+"  koszt_produktow: "+koszt_produktow);//.css("color","red"); 
			
			
		});
	});
	
	
	function del(pid){
		if(confirm(\'Do you really mean to delete this item\')){
			document.form1.pid.value=pid;
			document.form1.command.value=\'delete\';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm(\'This will empty your shopping cart, continue?\')){
			document.form1.command.value=\'clear\';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value=\'update\';
		document.form1.submit();
	}

</script>';

}
add_action('wp_head', 'add_scripts');

get_header();

?>
<script type="text/javascript">

</script>
<div class="hfeed content">

<form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
</form>

<style>

.koszyk{
	width:1000px;	
}

.koszyk_naglowek{
	font-size:16px;
	font-weight:bold;
	margin-bottom:0px;
}

.koszyk_buttons{
	margin-bottom:15px;
	margin-left:15px;
		margin-top:5px;
}

#clear_basket{
	margin-left:10px;
}

#back_to_shopping {
	margin-right:10px;
}

.koszyk_buttons input{
	font-size:10px;
}
.koszyk_produkt{
	background-color:#E1E1E1;	
	height:70px;
	padding-right:10px;
}
.koszyk_naglowek, .koszyk_buttons{
	clear:both;	
}
.koszyk_produkt_id, .koszyk_produkt_image, .koszyk_produkt_nazwa, .koszyk_produkt_koszty{
	float:left;
}
.koszyk_produkt_id{
	width:20px;
	font-size:12px;
	font-weight:bold;
	padding-left:10px;
	margin-right:20px;
	margin-top:5px;
}

.koszyk_produkt_image{	
	width:80px;
    height: auto;
    line-height: 70px;
    white-space: nowrap;
}
.koszyk_produkt_image img{
	vertical-align:middle;
}

.koszyk_produkt_nazwa{
	width:300px;
	margin-left:20px;
	margin-top: 15px;	
}

.koszyk_produkt_cena{
	clear:both;	
	padding:0px;
	height:auto;	
	line-height:normal;
	margin-top:10px;
}
.koszyk_produkt_cena_liczba{
	min-width: 50px;
	text-align:right;
	display: inline-block;
}
.koszyk_produkt_wysylka{	
	float:right;
	padding:0px;	
	height:auto;
	line-height:normal;
}
.koszyk_produkt_koszty{
	float:right;	
}

.koszyk_projektant, .koszyk_produkt{	
	clear:both;
	width: 982px;
}

.koszyk_projektant_nazwa{
	font-size:14px;	
	font-weight:bold;
	margin-bottom:5px;
}

.koszyk_projektant_sum{
	float:right;	
	clear:both;
	width:400px;
	border-top:1px solid #999;
	margin-top:10px;
}

.koszyk_projektant_sum_cena{
	float:right;	
	clear:both;
	line-height:12px;
	/*margin-right:10px;*/
	margin-top: 5px;
}

.koszyk_projektant_sum_wysylka{
	display:inline-block;
	line-height:12px;
	/*margin-right:10px;*/
	vertical-align: middle;
}

.koszyk_zatwierdz{
	float:right;	
	clear:both;
}

.blue_font{
	color:#1fb5da;
}

.small_font{
	font-size:14px;
	line-height:14px;
}

.big_font{
	font-size:16px;
	line-height:16px;
}

.big_font_20{
	font-size:20px;		
}

.bold_font{
	font-weight:bold;	
}
.right_both{
	/*float:right;*/
	clear:both;	
}
.koszyk_koszt_calkowity{
	width:350px;
	margin-top:35px;
	margin-bottom:30px;
	clear:both;
	padding-right:10px;
}

.left{
	float:left;
}

.right{
	float:right;
}

.clear_right{
	clear:right;	
}
.clear_left{
	clear:left;	
}
.clear{
	clear:both;	
}
.div_border{
	margin-top:5px;
	float:left;
	border-top:1px solid #999;
	width:350px;
}

.button_zatwierdz{
	padding-left:8px;
	padding-right:5px;
	padding-top:5px;
	padding-bottom:5px;
	margin-right:50px;
	margin-bottom:20px;
}

.cena_width{
	width:80px;	
}

.text_align{
	text-align:right;	
}

.margin_bottom{
	margin-bottom:10px;	
}

.margin_top{
	margin-top:10px;
}

.margin_top_5{
	margin-top:5px;
}

div.content a.link{
	color: #1fb5da; 
	text-decoration: none; 
}

.remove_link{
	float:right;
	clear:right;
	margin-top: 5px;
	text-decoration:none;
}

.btn_text{
	background-color:#CCC;	
	font-size:12px;
	padding:5px 7px 5px 7px;
}
div.content .btn_text a{
	color:#FFF;	
	text-decoration: none;
}	

.sbOptions, .sbSelector{
	width:150px;
}
.sbHolder{
	width:150px;
	float:right;
	/*margin-top:10px;*/
}
.przesylkaSB{
	display:inline-block;
	margin-right:10px;
	vertical-align: middle;
}
.przesylkaBox{
	margin-top:5px;
	float:right;
	/*line-height: 50px;*/
}

</style>

<br />
<div class="koszyk">
	<div class="koszyk_naglowek">Twój koszyk</div>
    <div class="koszyk_buttons">
	<!--    
	<form class="back_to_shopping" action="http://naopak.com.pl/lista" method="post">
    	<input type="submit" value="Wróć do zakupów"/>
	</form>
    <form  class="save_cart" action="" method="post">        
        <input type="button" value="Zapisz koszyk"/>
    </form>
    -->
    
    <span id="back_to_shopping" class="btn_text">
		<a href="http://naopak.com.pl/lista2" >Wróć do zakupów</a>
    </span>
    
    <span id="save_basket" class="btn_text">
		<a href="#" >Zapisz koszyk</a>
    </span>
    
    <span id="clear_basket" class="btn_text">
		<a href="#" >Wyczyść koszyk</a>
    </span>
    
    
    </div>
    
<?


function array_push_assoc($array, $key, $value, $key2, $value2, $key3, $value3){
 $array[$key] = $value;
 $array[$key2] = $value2;
 $array[$key3] = $value3;
 return $array;
 }
 
//print_r($_SESSION['cart']);
$max=count($_SESSION['cart']);
//$_SESSION['test']="zmienna sesyjna";
//echo "</br>max = $max</br>";
// pojedynczy projektant

	$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
 
	$przesylka_options = Array();
	$produkty = Array();
	$produkty_producenta='';
	$kwota_produktow_producenta = 0;
	$koszt_wysylki = 0;
	$x=0;
			if(is_array($_SESSION['cart'])){

				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					
					
					$connection = mysql_connect('localhost', 'root', '');
				    $db = mysql_select_db('bollo_naopak', $connection);
					$sql = "SELECT * FROM s_zdjecia WHERE id_produkt = '".$pid."'";
					$id_sql = mysql_query($sql);
					$img_result = mysql_fetch_row($id_sql);
					
					
					$pic = "img/products/$pid/$img_result[2]_t.jpg";
		
					$sql_results = $wpdb->get_row("SELECT s_produkt.id_projektant, s_producenci.nazwa, s_produkt.waga FROM s_produkt INNER JOIN s_producenci ON s_produkt.id_projektant = s_producenci.id WHERE s_produkt.prod_id ='".$pid."'", ARRAY_N);
							
					$actual_producer_id = $sql_results[0];
					$actual_producer_name = $sql_results[1];
					$actual_weight = $sql_results[2];
					//$koszt_przesylki = kosztPrzesylki($pid, $actual_weight);
					//echo "<br />pid= $pid ,  producent: $actual_producer_id<br />";
					$pname = get_product_name($pid);
					//echo "</br>pid = $pid</br>";
					$price = get_price($pid);
					
					$sql = "SELECT id, cena, opis FROM s_koszty_przesylki WHERE prod_id ='".$pid."'";
					//echo $sql."<br />";
					$result = $wpdb->get_results($sql);
					
					$w=0;
					foreach( $result as $results ) {				
						/*$przesylka_options.= '<option value="'.$results->cena.'" >'.$results->opis."</option>";				*/		
						$przesylka_options[$actual_producer_id][$pid][$w]=array_push_assoc($przesylka_options[$actual_producer_id][$pid][$w], 'id', $results->id, 'cena', $results->cena, 'opis', $results->opis);	
					
						//echo "<br />id= ".$results->id."<br />";
						$w++;						
					}
					$koszt_wysylki = $przesylka_options[$actual_producer_id][$pid][0]['cena'];
					
					$x++;
				$produkty_producenta = "   	  
			<div class=\"koszyk_produkt\">
          		<div class=\"koszyk_produkt_id\">$x</div>
            	<div class=\"koszyk_produkt_image\">
					<img src=\"$pic\" width=\"55\" height=\"55\" />
				</div>
            	<div class=\"koszyk_produkt_nazwa blue_font\"><a class=\"link\" href=\"http://naopak.com.pl/item?prod_id=$pid\" >$pname</a></div>
        		<div class=\"koszyk_produkt_koszty\">
            		<div class=\"koszyk_produkt_cena big_font\">
                		<span class=\"blue_font big_font\">Cena produktu:</span>
                    	<span class=\"big_font koszyk_produkt_cena_liczba\">$price zł</span>
                	</div>

        		</div>				
					<a href=\"#\" class=\"remove_link\" name=\"remove\" alt=\"$pid\">usuń</a>
       		</div>";
					
				$produkty[$actual_producer_id][0].=$produkty_producenta;
				$produkty[$actual_producer_id][1]+=get_price($pid);
				$produkty[$actual_producer_id][2]+=$koszt_wysylki;
				$produkty[$actual_producer_id][3]=$przesylka_options[$actual_producer_id];//array_unique($przesylka_options);
					
				// array_push($producenci, $actual_producer_id);
				// $position = array_search($array, $value);
				 				
				}
		
//print_r($przesylka_options);

function in_multi($searchFor, $array) {
	//foreach($array as $key) {
	for($i=0;$i<count($array);$i++)
	{	
		//echo "<br />==key: ".$key['opis']."  == ".$searchFor['opis']."<br />";
		if($array[$i]['opis'] == $searchFor['opis']) {
			//echo "<br />==key: ".$array[$i]['cena']."  == ".$searchFor['cena']."<br />";
			if($array[$i]['cena']<$searchFor['cena'])
				$array[$i]['cena']=$searchFor['cena'];
			return true;
		}
		else {
			if(is_array($value)) if(in_multi($searchFor, $key)) return true;
		}
	}
	return false;
}
function modify_multi($searchFor, $array) {

	
	for($i=0;$i<count($array);$i++)
	{	
		if($array[$i]['opis'] == $searchFor['opis']) {
			if($array[$i]['cena']<$searchFor['cena'])
				$array[$i]['cena']=$searchFor['cena'];
			return $array;
		}
		else {
			if(is_array($value)) if(in_multi($searchFor, $key)) return true;
		}
	}
	return $array;
}	

function checkShipping($array){
	
	$projKW = array();
	$obj = array();
	
	foreach ($array as $produkt) {	
		$x=0;
		foreach($produkt as $p )
		{
			if(isset($p['opis']))
			{	
				//print_r($projKW);
				$obj['opis']=$p['opis'];
				$obj['cena']=$p['cena'];
				$obj['id']=$p['id'];

				if(!in_multi($p,$projKW))
					array_push($projKW,$obj);	
				else
				{
					//echo "<br />";
					//echo "opis: ".$p['opis']." => cena: ".$p['cena'];
					//echo "<br />";					
					$projKW=modify_multi($obj,$projKW);
				}

			}
			$x++;
		}		
	}
	//print_r($projKW);
	return $projKW;
}

//unset($_SESSION['naopak_cart_shipping']);
				$kwForm='';
				foreach($produkty as $id => $value) // $id - id producenta
				{
					//echo "<br /><br />id: $id<br /><br />";
					
					$sql_results = $wpdb->get_row("SELECT nazwa FROM `s_producenci` WHERE id =".$id, ARRAY_N);
					
					$actual_producer_name = $sql_results[0];
					$projektant_kwota = $produkty[$id][1];
					//$projektant_koszt_wysylki = $produkty[$id][2];	


					$a=$produkty[$id][3];
					
					//print_r($a);
					
					//$keys = array_keys($a);

					$tmp=checkShipping($a);
					$keys = array_keys($tmp);
					//print_r($tmp);
					//print_r($keys);
					$kwForm.='<input type="hidden" name="cena[]" value="'.$tmp[0]['cena'].'"/>';
        		    $kwForm.='<input type="hidden" name="opis[]" value="'.$tmp[0]['opis'].'"/>';
					$kwForm.='<input type="hidden" name="pryeszlkaID[]" value="'.$tmp[0]['id'].'"/>';
					$kwForm.='<input type="hidden" name="producentID[]" value="'.$id.'"/>';					
					$kwForm.='<input type="hidden" name="producent[]" value="'.$actual_producer_name.'"/>';									
					
					$projektant_koszt_wysylki = $tmp[0]['cena'];
					$calkowity_koszt_wysylki += $projektant_koszt_wysylki;
					
					/*echo "<br /><br />opis: ".$a[$keys[0]][0]['opis'].
						 "<br />koszt: ".$a[$keys[0]][0]['cena']."<br />";*/
										
					//print_r($a);
					
					$producent_przesylka='';
					foreach($tmp as $pidKW)
					{
						//foreach($pidKW as $kw)
						//{
							$producent_przesylka.="<option value=\"".$pidKW['cena']."\">";
							$producent_przesylka.=$pidKW['opis']."</option>";
						//}
					}
				
					//echo "---".htmlspecialchars($producent_przesylka)."<br />";
					
					$wyswietl_projektanta = '<div class="koszyk_projektant">';
					$wyswietl_projektanta.="<div class=\"koszyk_projektant_nazwa\">$actual_producer_name</div>";
					$wyswietl_projektanta .= $produkty[$id][0];
					$wyswietl_projektanta .= "
					<div class=\"koszyk_projektant_sum\">				
					
						<div class=\"koszyk_projektant_sum_cena\">
            				<span class=\"bold_font blue_font big_font\">Cena produktów:</span>
							<span name=\"kp_proj\" class=\"bold_font big_font margin_right_5\"> $projektant_kwota zł</span>
            			</div>						
					<div class=\"przesylkaBox\">	
					<div class=\"przesylkaSB\" >
						<select  name=\"przesylka_producent_$id\">".$producent_przesylka."</select>
					</div>
            			<div class=\"koszyk_projektant_sum_wysylka\">
                			<span class=\"bold_font blue_font small_font\">koszt wysyłki:</span>
                			<span name=\"kw_proj\" class=\"bold_font small_font\"> $projektant_koszt_wysylki zł</span>
            			</div> 						          
						</div>
        			</div> ";
					$wyswietl_projektanta .= "</div>";
					echo $wyswietl_projektanta;
				}
								
			?>
                <!--<input type="button" value="Clear Cart" onclick="clear_cart()">-->
                <!--<input type="button" value="Place Order" onclick="window.location='http://localhost/wordpress/?page_id=323'"> -->

			<?
            


// koniec

$product_total = get_order_total();
$order_total = $calkowity_koszt_wysylki + $product_total; 
?>    
    <div class="koszyk_koszt_calkowity right">
    	<div class="big_font blue_font clear right margin_bottom">Do zapłaty:</div>
        <div class="small_font bold_font left clear_right text_align margin_bottom">Wartość produktów w koszyku: </div>
        <div class="small_font bold_font right cena_width text_align margin_bottom"><? echo $product_total; ?> zł</div>
        <div class="small_font bold_font left text_align">Wysyłka: </div>
        <div class="small_font bold_font right cena_width text_align"><? echo $calkowity_koszt_wysylki; ?> zł</div>
        <div class="div_border margin_top">
    	    <span class="big_font blue_font left clear margin_top_5">Całkowity koszt do zapłaty:</span>
	        <span class="biger_font bold_font right big_font_20 "><? echo $order_total; ?> zł</span>
        </div>
    </div>
    <div class="koszyk_zatwierdz button_zatwierdz">
	 
      <? 
      $www="";
      if ( is_user_logged_in() ) 
      { 
          $www="http://naopak.com.pl/weryfikacja-zamowienia";
      }
      else
      {
          $www="http://naopak.com.pl/reg-login/";
		  /*<? echo $www; ?>*/
      }
      ?>
             
     <form action="<? echo $www; ?>" id="kwForm" method="post" >
        <? echo $kwForm; ?>             
		<input id="btnKW" class="btnKW" type="submit" value="idz dalej">        
    </form>
        <span id="confirm_basket" class="btn_text">      
			<a href="<? echo $www; ?>" >Zatwierdź (krok 1/2)</a>
    	</span>
    </div>
</div>
<?
			}
			else{
				echo "<br><center><p>Twój koszyk jest pusty!</p></center>";
			}

?>
</div>
<script type="text/javascript" >

		jQuery('#back_to_shopping').hover(function(){
			jQuery('#back_to_shopping.btn_text').css('background-color', '#F99D31');
			jQuery('#back_to_shopping.btn_text a').css('color', '#333');
		},function(){
			jQuery('#back_to_shopping.btn_text').css('background-color', '#CCC');
			jQuery('#back_to_shopping.btn_text a').css('color', '#FFF');
		});
		
		jQuery('#save_basket').hover(function(){
			jQuery('#save_basket.btn_text').css('background-color', '#F99D31');
			jQuery('#save_basket.btn_text a').css('color', '#333');
		},function(){
			jQuery('#save_basket.btn_text').css('background-color', '#CCC');
			jQuery('#save_basket.btn_text a').css('color', '#FFF');
		});
		
		jQuery('#clear_basket').hover(function(){
			jQuery('#clear_basket.btn_text').css('background-color', '#F99D31');
			jQuery('#clear_basket.btn_text a').css('color', '#333');
		},function(){
			jQuery('#clear_basket.btn_text').css('background-color', '#CCC');
			jQuery('#clear_basket.btn_text a').css('color', '#FFF');
		});
		
		jQuery('#clear_basket').click(function() {
			clear_cart();
		});
				
		jQuery('#confirm_basket').hover(function(){
			jQuery('#confirm_basket.btn_text').css('background-color', '#F99D31');
			jQuery('#confirm_basket.btn_text a').css('color', '#333');
		},function(){
			jQuery('#confirm_basket.btn_text').css('background-color', '#CCC');
			jQuery('#confirm_basket.btn_text a').css('color', '#FFF');
		});
</script>

<?php get_footer(); mysql_close($connection); ?>
