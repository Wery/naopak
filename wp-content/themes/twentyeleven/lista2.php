<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: Lista Template2
 
 */	
 

// global $wpdb;
session_start();



//******************************************************************** WHERE QUERY
//********************************************************************	

	//$material = $_GET['material'];
	if(isset($_GET['material'])) $material = $_GET['material']; else $material = "";
	if(isset($_GET['kolor'])) $kolor = $_GET['kolor']; else $kolor = "";
	//$cena_min = $_GET['cena_min'];
	if(isset($_GET['cena_min'])) $cena_min = $_GET['cena_min']; else $cena_min = "";
	if(isset($_GET['cena_max'])) $cena_max = $_GET['cena_max']; else $cena_max = "";
	//$cena_max = $_GET['cena_max'];
	//$cat = $_GET['cat'];
	if(isset($_GET['cat'])) $cat = $_GET['cat']; else $cat = "";
	if(isset($_GET['subcat'])) $subcat = $_GET['subcat']; else $subcat = "";
	//$subcat = $_GET['subcat'];
	if(isset($_GET['page'])) $page = $_GET['page']; else $page = "1";

/*
	$where_array = Array();
	$array_index=0;
	$tmp_value='';

	$kolor = $_GET['kolor'];
	if(isset($kolor))
	{
		if($kolor != "-1")
		{
			$tmp_value = ' s_kolor.nazwa = "'.$kolor.'" ';
			array_push($where_array, $tmp_value);
		}
	}
		
	if(isset($_GET['subcat']))
	{
		$subcat_id = $_GET['subcat'];
		$tmp_value = ' t_subcategory.subID = '.$subcat_id.' ';
		array_push($where_array, $tmp_value);
	}

	
	
	if (isset($_GET['cat']))
	{ 
		$cat_id = $_GET['cat'];
		$tmp_value = ' t_subcategory.catID = '.$cat_id.' ';
		array_push($where_array, $tmp_value);
	} 
	
	$tag_typ =$_GET['typ_tagu'];
	if (isset($tag_typ))
	{ 
		$tag_name = $_GET['nazwa_tagu'];
		
		$tmp_value = ' s_'.$tag_typ.'.nazwa = \''.$tag_name.'\'';
		array_push($where_array, $tmp_value);
	} 
	
	$cena_min = $_GET['cena_min'];
	$cena_max = $_GET['cena_max'];
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
	
	$material = $_GET['material'];
	if(isset($material))
	{
		if($material != "-1")
		{
			$tmp_value = ' s_material.nazwa = "'.$material.'" ';
			array_push($where_array, $tmp_value);
		}
	}
*/
//print_r($where_array);
//********************************************************************
//********************************************************************


?>

<?php
function add_scripts()
{
	echo '
	<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/query.js"></script>';

	echo '
	<script type="text/javascript" src="'.get_bloginfo('template_url').'/js/jquery.selectbox-0.2.min.js"></script>';

	echo '
	<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_url').'/css/jquery.selectbox.css" media="screen" />';
}
add_action('wp_head', 'add_scripts');

get_header();
?>

<style>

/* ****************** MENU *************************** */
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
	
div.accordionContent a.submenu_inactive{
	color: black; 
	text-decoration: none; 
	}
	
div.accordionContent a.submenu_active{
	color: #1fb5da; 
	text-decoration: none; 
	}

.accordionContent {	
	font-weight:normal;
	width: 170px;
	margin-left:20px;
	float: left;
	_float: none; /* Float works in all browsers but IE6 */
	/*background: #95B1CE;*/
	}
	
/***********************************************************************************************************************
 EXTRA STYLES ADDED FOR MOUSEOVER / ACTIVE EVENTS
************************************************************************************************************************/

.on {
	/*background: #990000;*/
	color:#1fb5da !important;
	}
	
.over {
	color: #1fb5da !important;
	/*background: #CCCCCC;*/
	}
/* *********************************************** */

#main_contetn{
	min-width:1000px;
	float:left;
	position:relative;
}

#menu_produktow{
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

#filtr_LB{
	font-size:10px;		
	border: 1px solid #999;
	width:80px;
	margin-left:8px;
}

#menu{
	font-size:12px;
}

#menu td{
	border-bottom:1px dashed black;	
}

#lista_produktow{
	width: 750px;
	float:right;
	margin-left:10px;
	margin-right:12px;
	position:relative;
}

#produkt{
	border-style:solid;
	border-width:1px;
	border-color:#E9E9E9;
	padding:4px;
	margin:5px;
	background-color:#FFF;
	
}

#obraz_produktu{
	float:left;
	width:170px;
	height:170px;
}

#nazwa_produktu{
	clear:left;
	position:relative;
	font-size:13px;
	color:black;
	text-decoration: none;
}

#info_produktu{
	font-size:12px;
	clear:left;	
}

#projektant_produktu{
	display:inline;
	color:#8D8D8D;
}

#cena_produktu{
	display:inline;
	color:#1fb5da;
	position:relative;
	float:right;
	clear:none;
}

a:link {text-decoration: none; }
a:active {text-decoration: none; }
a:visited {text-decoration: none; }
a:hover {text-decoration: none; }

.produkt_lista{
/*	width:740px;*/
	width:100%;
	padding-left:10px;
	padding-right:10px;
	padding-bottom:10px;
	padding-top:10px;
	float:left;
	position:relative;
	border-bottom-style:solid;
	border-bottom-color:#CCC;
	border-bottom-width:1px;
}

.zdjecie_lista{
	float:left;
}

.info_lista{
	float:left;
}

.tytul_lista{
	float:left;
	margin-left:15px;
	font-size:13px;
}

.tytul_lista h3{
	font-weight:bold;
	font-size:14px;
}

.tytul_lista h4{
	clear:left;
	font-size:12px;
}

.dane_lista{
	float:left;
	clear:left;
	margin:15px;
	font-size:12px;
}

.opis_lista{
	float:left;
	width:450px;
}

.tagi_lista{
	float:left;
	clear:left;
	margin-top:10px;
}

.cena_lista{
	float:left;
	font-size: 18px;
	font-weight: 700;
}

div.tagi_lista a.tag_nazwa{
	color:#1fb5da;	
	text-decoration:none;
}

.border_bottom{
	border-bottom-style:solid;
	border-bottom-color:#CCC;
	border-bottom-width:1px;
	padding-top:10px;
	width:100%;
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



#lista_produktow div.pagination {
	/*padding: 3px;*/
	margin: 3px;
	border:none;
}

#lista_produktow div.pagination a {
	border:none;
	padding:3px 2px 2px 2px;
	text-decoration: none; /* no underline */
	margin: 2px;
	font-weight: 700;
	color: #000;
}

#lista_produktow div.pagination img {
	padding: 2px;
	margin: 2px;
}

div.pagination a:hover, div.pagination a:active {
	border:none;
	background-color: #FFF;
	color: #000;
	font-weight: bold;
}

#lista_produktow div.pagination span.current {
	padding: 3px 2px 2px 2px;
	background-color: #FFF;	
	border:none;
	margin: 2px;	
	font-weight: bold;
	color:#F90;
}
#lista_produktow div.pagination span.disabled {
	border:none;
	margin: 2px;
/*	border: 1px solid #EEE;	*/
	color: #000;
	padding: 3px 2px 2px 2px;
	float:left;
	font-weight: 700;
}
	
.no_result{
	width: 750px;
	text-align:center;
	color:#1FB5DA;
	font-size:14px;
	font-weight:bold;
	margin-top: 100px;
	margin-bottom: 50px;
}

div.content /* a:focus, div.content a:hover, div.content a:active */
a.link_all{
	text-decoration: none;
	color:#373737;	
}

div.content a:hover.link_all{
	color: #1fb5da; 
	text-decoration: none; 
}
.filtruj_btn, .czysc_filtr_btn{
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
/*.filtruj_btn .input{
	background-color:#CCC;	
	font-size:10px;
	padding:1px 10px 1px 10px;
	float:right;
	margin-left:15px;
	height:15px;
	color:#FFF;	
	text-decoration: none;
}*/
/*div.content .filtruj_btn a{
	color:#FFF;	
	text-decoration: none;
}	*/
	
/***************************/
div.selectBox {
    position:relative;
    display:inline-block;
    cursor:default;
    text-align:left;
    line-height:17px;
    clear:both;
    color:#FFF;
}
span.selected {
    width:63px;

    text-indent:5px;
	font-size:10px;
/*    border:1px solid #ccc;
    border-right:none;
    border-top-left-radius:5px;
    border-bottom-left-radius:5px;*/
    background:#CCC;
    overflow:hidden;
}
span.selectArrow {
    width:17px;
/*    border:1px solid #60abf8;
    border-top-right-radius:5px;
    border-bottom-right-radius:5px;*/
    text-align:center;
    font-size:12px;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -o-user-select: none;
    user-select: none;
    background:#CCC;
}
 
span.selectArrow,span.selected {
    position:relative;
    float:left;
    height:17px;
    z-index:1;
}

div.selectOptions {
    position:absolute;
    top:17px;
    left:0;
    width:80px;
/*    border:1px solid #ccc;
    border-bottom-right-radius:5px;
    border-bottom-left-radius:5px;*/
    overflow:hidden;
    background:#CCC;
    padding-top:2px;
    display:none;
	z-index:1;
}
     
span.selectOption {
	display: block;
	width: 80px;
	line-height: 17px;
	font-size:10px;
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 5px;
}
 
span.selectOption:hover {
    color:#000;
    background:#f99d31;         
}           
/*********************************************/
/**************  PAGINATION ******************/
            #loading{
				top: 100px;
                left: 50%;
				right:50%;
				position:relative;
            }
            #lista_produktow .pagination ul li.inactive,
            #lista_produktow .pagination ul li.inactive:hover{
               /* background-color:#ededed; */
                color:#bababa;
                font-weight: normal;
               /* border:1px solid #bababa; */
                cursor: default;
            }
            #lista_produktow .data ul li{
                list-style: none;
                font-family: verdana;
                margin: 5px 0 5px 0;
                color: #000;
                font-size: 13px;
            }

            #lista_produktow .pagination{
                width: 750px;
                height: 25px;
            }
            #lista_produktow .pagination ul li{
                list-style: none;
                float: left;
                /* border: 1px solid #006699; */
                padding: 2px 6px 2px 6px;
                margin: 0 3px 0 3px;
                font-family: arial;
                font-size: 14px;
                color: #000000;
                /* font-weight: bold; */
                /* background-color: #f2f2f2; */
            }
            #lista_produktow .pagination ul li:hover{
                color: orange;
                font-weight: bold;
                /* background-color: #006699; */
                cursor: pointer;
            }
			.go_button
			{
			/*background-color:#f2f2f2;border:1px solid #006699;*/color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;/*position:absolute;*/margin-top:-1px;float:right;
			}
			.total
			{
			float:right;font-family:arial;color:#999;clear:left;min-width:50px;
			}

/**********************************************/

#submit_gallery{
	border:none;
	width: 27px;
	height: 27px;
	background: url(http://naopak.com.pl/img/galeria.png) no-repeat;
}

#submit_list{
	border:none;	
	width: 27px;
	height: 27px;
	background: url(http://naopak.com.pl/img/lista.png) no-repeat;
}
</style>
<script type="text/javascript">
jQuery(document).ready(function(){	

		jQuery('#material').selectbox();
		jQuery('#kolor').selectbox();
		
		jQuery('#filtruj_btn').hover(function(){
			jQuery('#filtruj_btn').css('background-color', '#F99D31');
			jQuery('#filtruj_btn').css('color', '#333');
		},function(){
			jQuery('#filtruj_btn').css('background-color', '#CCC');
			jQuery('#filtruj_btn').css('color', '#FFF');
		});	

		jQuery('#czysc_filtr_btn').hover(function(){
			jQuery('#czysc_filtr_btn').css('background-color', '#F99D31');
			jQuery('#czysc_filtr_btn').css('color', '#333');
		},function(){
			jQuery('#czysc_filtr_btn').css('background-color', '#CCC');
			jQuery('#czysc_filtr_btn').css('color', '#FFF');
		});	
		
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

	$("#customForm").submit(function() {
		var showMode = $("#showForm input[name='show']").val();
		var page = $("input[name='page']").val();
		
		$("input[name='subcategory']").val();
		
		loadData(page,showMode);
		return false;
	});
	
	$("#czysc_filtr_btn").click(function() {
		console.log("czysc_filtr_btn");
		//$('#customForm').get(0).reset();
		$(".cena").val("");
		$(".sbSelector").text("wybierz");
		$("#material").val("-1");		
		$("#kolor").val("-1");
		loadData(1, $("input[name='show']").val());
		return false;
	});
		
	$("#submit_gallery").click(function() {
		var showMode = $(this).attr("showmode");
		$("#showForm input[name='show']").val(showMode);
		console.log("show mode: "+showMode);
		var page = $("input[name='page']").val();
		loadData(page,showMode);
		return false;
	});
	
	$("#submit_list").click(function() {
		var showMode = $(this).attr("showmode");
		$("#showForm input[name='show']").val(showMode);
		console.log("show mode: "+showMode);
		var page = $("input[name='page']").val();
		loadData(page,showMode);	
		return false;
	});
	
	$(".submenu_inactive, .link_all").click(function(){
		var $this_obj = $(this);
		var showMode = $("#showForm input[name='show']").val();
		var page = $("input[name='page']").val();

		
		var subcat = "";
		if($(this).hasClass("link_all"))//=="link_all")
		{
			console.log("0 link_all subcat: "+subcat);
			subcat = "all";
		}
		else
		{
			subcat = $(this).attr("id").substring(4);		 	
		}
		$("input[name='subcategory']").val(subcat);
		$("input[name='category']").val("all");
		var cat = "all";
		
		console.log("cat: "+cat);
		console.log("subcat: "+subcat);
		
		if($(this).attr('class')=="link_all")
		{
			//#1FB5DA
			jQuery('.accordionContent').hide();
			jQuery('.accordionButton').removeClass("on");
			$(this).addClass('on');	
			console.log("link_all");
		}
		else
		{
			$(this).attr('class', 'submenu_active');
			console.log("!link_all");
		}
		
		$( "#wrapper div a" ).each(function ( index, domEle) {
				
				if($this_obj.get(0)===$(this).get(0))
				{
					console.log("continue");
					return true;
				}
				if(!($(this).hasClass("link_all")||$(this).hasClass("on")))
					$(this).attr('class', 'submenu_inactive');			
				else
					$(this).removeClass("on");					
			});
		loadData(page,showMode,cat,subcat);	
		return false;
	// zapamietywac categorie
	// poprawic kategorie nad kolorami
	});
	
	 function loading_show(){
		  $('#loading').html("<img src='img/loading_list.gif'/>").fadeIn('fast');
	  }
	  function loading_hide(){
		  $('#loading').fadeOut('fast');
	  }             
	     
	  function loadData(page,showMode,cat,subcat){
 	     
		 loading_show();  
  	     var form_serialize = $("#customForm :input").serialize();
		 //var showMode = $("#showForm input[name='show']").attr("value");
		 console.log("show mode: "+showMode);
		 var formData = "";
		 // ustawic odpowiednia kategorei w menu
		 if (typeof cat == 'undefined')
		 {
			 console.log("undefined cat: "+$("input[name='category']").val());
			 if($("input[name='category']").val()!="all")
				 var cat = $("input[name='category']").val();	 	
			 else
				 var cat = "all"; 
		 }
		 if (typeof subcat == 'undefined')
		 {
			 var subcat = $("input[name='subcategory']").val();
			 console.log("undefined subcat: "+subcat);			 			 
			 if(subcat!="all")
				 if (subcat.indexOf("sub_") >= 0)
			 	 {
					 var subcat = $("input[name='subcategory']").val().substring(4);		 	
				 }
				 else
				 {
					 var subcat = $("input[name='subcategory']").val();		 	
			     }
			 else
				 var subcat = "all"; 
		 }
		 console.log("loadData cat: "+cat);
		 console.log("loadData subcat: "+subcat);
		 
		 
		 
		 formData = "cat="+cat+"&subcat="+subcat+"&show="+showMode+"&page="+page+"&"+form_serialize;
		 console.log("\n\nSerialized input string\n"+formData+"\n\npage="+page);
		 
		  $.ajax
		  ({
			  type: "POST",
			  url: "<? echo get_bloginfo('template_url'); ?>/load_data.php",
			  data: 
			  {
				form: formData
			  },
			  success: function(msg)
			  {
				  $("#lista_produktow").ajaxComplete(function(event, request, settings)
				  {
					  loading_hide();
					  //console.log(msg);
					  $("#lista_produktow").html(msg);
					  //$("input[name='show']").val("");
				  });
			  }
		  });
	  }
	//loading_show();
	loadData(<? echo $page; ?>, $("input[name='show']").val());

	$('#lista_produktow .pagination li.active').live('click',function(){
		var page = $(this).attr('p');
		$("input[name='page']").val(page);		
		var showMode = $("#showForm input[name='show']").val();
		loadData(page,showMode);		
	});   
	        
	$('#go_btn').live('click',function(){
		var page = parseInt($('.goto').val());
		var no_of_pages = parseInt($('.total').attr('a'));
		if(page != 0 && page <= no_of_pages){
			var showMode = $("#showForm input[name='show']").val();
			$("input[name='page']").val(page);		
			loadData(page,showMode);	
		}else{
			alert('Enter a PAGE between 1 and '+no_of_pages);
			$('.goto').val("").focus();
			return false;
		}
		
	});
	
}); // ******************************** END OF jQuery(document).ready

function enableSelectBoxes(){
    $('div.selectBox').each(function(){
        $(this).children('span.selected').html($(this).children('div.selectOptions').children('span.selectOption:first').html());
		$(this).attr('value',$(this).children('div.selectOptions').children('span.selectOption:first').attr('value'));
		
		$(this).children('span.selected,span.selectArrow').click(function(){
			if($(this).parent().children('div.selectOptions').css('display') == 'none'){
				$(this).parent().children('div.selectOptions').css('display','block');
			}
			else
			{
				$(this).parent().children('div.selectOptions').css('display','none');
			}
		});
		
		$(this).find('span.selectOption').click(function(){
			$(this).parent().css('display','none');
			$(this).closest('div.selectBox').attr('value',$(this).attr('value'));
			$(this).parent().siblings('span.selected').html($(this).html());
		});	
    });
}

</script>
<?php
	$connection = mysql_connect('localhost', 'root', '');
    $db = mysql_select_db('bollo_naopak', $connection);
	mysql_set_charset('utf8',$connection); 
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	mysql_query('set names utf8;');


// *************************************** MENU

	$query_menu = "SELECT t_category.id, t_category.nazwa AS cat_nazwa, t_subcategory.subID, t_subcategory.nazwa AS sub_nazwa, t_subcategory.catID FROM t_category LEFT JOIN t_subcategory ON t_category.id = t_subcategory.catID ORDER BY `t_category`.`id` ASC LIMIT 0 , 30";
	
	  $sql_menu = mysql_query($query_menu);
      $menu=""; 
	  $poprzednia_nazwa_kategorii = "";
	  $x=0;
	  $subkat = $subcat;

	  $link = get_permalink(). "?" .http_build_query($_GET);
	  $menu .= '<div id="wrapper">'; 
	  
	  while($s = mysql_fetch_array($sql_menu))		
	  {
		 	$aktualna_nazwa_kategorii = $s[1];
		 
		 	if($aktualna_nazwa_kategorii != $poprzednia_nazwa_kategorii)
			{
				if($x>0)
				{
					$menu .= '</div>';
					$x=0;
				}
			
				if($cat===$s[0])
				{
					 
					$menu .= '<div class="accordionButton on">'.$aktualna_nazwa_kategorii.'</div>';
					if($s[3] != "")
					{			
						$menu .= '<div class="accordionContent cat_selected" style="display: block">';	
					}
				}
				else
				{
					$menu .= '<div class="accordionButton">'.$aktualna_nazwa_kategorii.'</div>';
					if($s[3] != "")
					{			
						$menu .= '<div class="accordionContent">';	
					}
				}
				
				$poprzednia_nazwa_kategorii = $aktualna_nazwa_kategorii;							
			}

			$adres = 'http://naopak.com.pl/lista2';
 
			if($s[3] != "")
			{
				
				if($subkat == $s[2])
				{
					$link = $adres.'?subcat='.$s[2];
					$menu .= '<a  class="submenu_active" href="'.$link.'" id="sub_'.$s[2].'">'.$s[3].'</a><br>';
				}
				else
				{
					$link = $adres.'?subcat='.$s[2];
					$menu .= '<a class="submenu_inactive" href="'.$link.'" id="sub_'.$s[2].'">'.$s[3].'</a><br>';	
				}
				
				$x++;	
			}					
	  }
	  
  		$menu .= '<div class="accordionButton">
		<a class="link_all" >wszystkie</a>
		</div></div>';  

// ***************************************** MENU END

	$adres = get_permalink();
	parse_str($adres);

	$query_kolor="SELECT nazwa FROM s_kolor";
	$sql_kolor = mysql_query($query_kolor);
 
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


		$query_material="SELECT nazwa FROM s_material";
		//$sql_tagi = $wpdb->get_results($query_material, ARRAY_N);
		$sql_mat = mysql_query($query_material);
		//foreach ( $sql_tagi as $s )
		while($s = mysql_fetch_array($sql_mat))		
		{
			if($material === $s[0])
			{
				$material_filtr .= "<option selected=\"selected\" value=\"$s[0]\">$s[0]</option>";
				$material_filtr2 .= "<span class=\"selectOption\" selected=\"selected\" value=\"$s[0]\">$s[0]</span>";
			}
			else
			{
				$material_filtr .= "<option value=\"$s[0]\">$s[0]</option>";
				$material_filtr2 .= "<span class=\"selectOption\" value=\"$s[0]\">$s[0]</span>";
			}
		}
?> 


<div class="hfeed content">
<div id="main_contetn">
<div id="mapa_listowanie">
	<div class="mapa">jesteś tutaj: <?php echo $_SERVER['REQUEST_URI']; ?></div>

    <div class="galeria_lista">    
    
    <form id="showForm" method="post">
     <input type="hidden" name="subcategory" value="<? if($subcat!=="") echo $subcat; else echo "all"; ?>" />
     <input type="hidden" name="category" value="<? if($cat!=="") echo $cat; else echo "all"; ?>" />
    <input type="hidden" value="<? 	
	if(isset($_SESSION["show_method"]))
	{
		echo $_SESSION["show_method"];
	}
	else
		echo "0";		
	 ?>" name="show" />
    <input type="submit" id="submit_gallery" value="" showmode="0"  />
    <input type="submit" id="submit_list" value=""  showmode="1"  />
    </form>
   
	</div>
    	<div class="filtr_listy">
        
   <form  id="customForm" method="post" enctype="text/plain" >
    <span class="filtruj_span">
		<!--<a id="filtruj" href="#" >filtruj</a>-->
        <input id="czysc_filtr_btn" class="filtruj_btn" type="button" value="wyczyść filtr">
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
	<? echo $kolory_filtr; ?>
  </select>
  </span>

  <span class="filtr_materialu"> 
  <span class="filtr_nazwa">materiał:</span>
  <select name="material" id="material" class="material">
  	  <option value="-1">wybierz</option>
	<? echo $material_filtr; ?>
  </select>
  </span>
    
</form>
    </div>
</div>
<div id="menu_produktow">
<div id="filter">Kategorie:
</div>
<?php echo $menu; ?>


</div>  <?php // closeing <div class="menu produktow"> ?>
<input type="hidden" value="1" name="page" />
<div id="loading"></div>
<div id="lista_produktow">

</div>  <?php // closeing <div class="lista produktow"> ?>
</div> <?php  // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>
<?php get_footer(); /*

	echo "<p><br /><br />
		kolor = $kolor	<br />
		material = $material <br />
		cena_min = $cena_min <br />
		cena_max = $cena_max <br />
		cat = $cat <br />
		subcat = $subcat
		<br /><br /></p>";
		*/ ?>