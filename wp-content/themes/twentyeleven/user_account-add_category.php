<?php
/**
 * @package asd
 *
 * @author: Wery
 * @url: http://www.customweb.com

 Template Name: User Account - add category
 
 */	
?>

<?php
function add_scripts()
{
/*	echo '
	<script language="javascript">
	jQuery(document).ready(function(){
	
	jQuery(\'.menu\').mouseover(function() {
		jQuery(this).addClass(\'over\');
	}).mouseout(function() {
		jQuery(this).removeClass(\'over\');										
	});
	
	});
	
	</script>
	';
	*/
	
//	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/pm/jquery.tablesorter.js"></script>';	
}
add_action('wp_head', 'add_scripts');

get_header();

?>
	<script language="javascript">
	jQuery(document).ready(function(){
	
    
    
    	jQuery("input[id^='kat_delete']").click(function(){
          var nazwa_tabeli = jQuery(this).attr("name");
		  var id_tabeli = jQuery(this).attr("id");
		  var catID =  id_tabeli.match( /[0-9]{1,}/i );
		
		  //alert('nazwa_tabeli: ' + nazwa_tabeli + '  ,catID: "'+catID[0]+'"');

          jQuery.ajax({
              type: 'POST',
              url: '<? echo get_bloginfo('template_url'); ?>/kat_table_delete.php',
              data: { tabela: catID[0] },
              cache: false,
              success: function()
              { 		
				  jQuery('#table_kat').find('td:contains(\''+nazwa_tabeli+'\')').parent().remove();
              }
         }); 		 
     });

	jQuery("input[id^='form_delete']").click(function(){
  
          var nazwa_tabeli = jQuery(this).attr("name");
          var nr = jQuery("#kat_"+nazwa_tabeli).val();		
         
          jQuery.ajax({
              type: 'POST',
              url: '<? echo get_bloginfo('template_url'); ?>/delete.php',
              data: { wiersz: nr },
              cache: false,
              success: function()
              { 			
                  jQuery("select#kat_"+nazwa_tabeli+" option[value=" + nr+"]").remove();
              }
         });
     });
     

		
         jQuery("input[id^='form_edit']").click(function() {
          var nr = jQuery(this).attr("id").substr(9);

          var nazwa_tabeli = jQuery(this).attr("name");
          var wartosc = jQuery("select#kat_"+nazwa_tabeli+" option:selected").text();
          jQuery("input[id^='edit_kat_tb_"+nr+"']").val(wartosc);
          jQuery("input[id^='form_add"+nr+"']").hide();
          jQuery("input[id^='form_edit"+nr+"']").hide();
          jQuery("input[id^='form_delete"+nr+"']").hide();
          
          if(jQuery('#edit_kat_tb_'+ nr).length){
              
          jQuery("input[id^='edit_kat_tb_"+nr+"']").closest("tr").show();
          jQuery("input[id^='edit_kat_btn_"+nr+"']").closest("tr").show();
          
          }else{
              
              jQuery("#kat_buttons" + nr + " tr:last").after('<tr><td colspan="2"><input name="edit_kat_tb_'+nr+'" type="text" id="edit_kat_tb_'+nr+'" value="'+wartosc+'" /><input type="button" id="edit_kat_btn_'+nr+'" name="edit_kat_btn_'+nr+'" value="OK"/></td></tr>');
             
          }            
      });   
      
      jQuery("input[id^='form_add']").live('click', function(){
          var nr = jQuery(this).attr("id").substr(8);		
          
          jQuery("input[id^='form_add"+nr+"']").hide();
          jQuery("input[id^='form_edit"+nr+"']").hide();
          jQuery("input[id^='form_delete"+nr+"']").hide();
      
          // zanezpieczyc przed ponownym wstawieniem !!!
          if(jQuery('#add_kat_tb_'+ nr).length){

          jQuery("input[id^='add_kat_tb_"+nr+"']").closest("tr").show();
          jQuery("input[id^='add_kat_btn_"+nr+"']").closest("tr").show();
          }else{
              jQuery("#kat_buttons" + nr + " tr:last").after('<tr><td colspan="2"><input name="add_kat_tb_'+nr+'" type="text" id="add_kat_tb_'+nr+'" value=""/><input type="button" id="add_kat_btn_'+nr+'" name="add_kat_btn_'+nr+'" value="OK"/></td></tr>');
          }		
      });  
      
      jQuery("input[id^='add_kat_btn_']").live('click', function(){
  
          jQuery("input[id^='edit_kat_tb_"+nr+"']").val("");
          var nr = jQuery(this).attr("id").substr(12);
  	
          jQuery("#kat_buttons" + nr + " tr:eq(1)").hide();
          jQuery("#kat_buttons" + nr + " tr:eq(2)").hide();
          
          jQuery("input[id^='form_add"+nr+"']").show();
          jQuery("input[id^='form_edit"+nr+"']").show();
          jQuery("input[id^='form_delete"+nr+"']").show();
          
          var sel_name = jQuery("input[id^='form_add"+nr+"']").attr("name");		 
          var subcat_name = jQuery("input[id^='add_kat_tb_"+nr+"']").val(); 

         
          jQuery.ajax({
              type: 'POST',
              url: '<? echo get_bloginfo('template_url'); ?>/add.php',
              data: { sub_nazwa: subcat_name, id_rodzic: nr},
              cache: false,
              success: function(data)
              { 
			  var nr = jQuery.trim(data);		
			  
                  jQuery("select#kat_"+sel_name).append('<option value="'+nr+'">'+subcat_name+'</option>');
                  jQuery("#kat_"+sel_name).val(nr);                
				  

              }
         });
      });   
  
      jQuery("input[id^='edit_kat_btn_']").live('click', function(){         
          var nr = jQuery(this).attr("id").substr(13);
          
          jQuery("#kat_buttons" + nr + " tr:eq(1)").hide();
          jQuery("#kat_buttons" + nr + " tr:eq(2)").hide();
          
          jQuery("input[id^='form_add"+nr+"']").show();
          jQuery("input[id^='form_edit"+nr+"']").show();
          jQuery("input[id^='form_delete"+nr+"']").show();
          
          var nazwa_tabeli = jQuery("input[id^='form_add"+nr+"']").attr("name");
          var nr_wiersza = jQuery("#kat_"+nazwa_tabeli).val();			
          var wartosc = jQuery("input[id^='edit_kat_tb_"+nr+"']").val();
  
          jQuery.ajax({
              type: 'POST',
              url: '<? echo get_bloginfo('template_url'); ?>/edit.php',
              data: { tabela: nazwa_tabeli, wiersz: nr_wiersza, nowa_wartosc: wartosc },
              cache: false,
              success: function(data)
              {
                  jQuery("select#kat_"+nazwa_tabeli+" option[value=" + nr_wiersza+"]").replaceWith('<option value="'+nr_wiersza+'">'+wartosc+'</option>');
                  jQuery("select#kat_"+nazwa_tabeli).val(nr_wiersza);
              }
         });
      });
      
      jQuery("#dodaj_nowa_kat_btn").click(function(){
  
        jQuery("#dodaj_nowa_kat_btn").closest("tr").hide();      
        
        if(jQuery('#dodaj_nowa_kat_tb').length){
  
              jQuery("#dodaj_nowa_kat_tb").closest("tr").show();
        }else{
              jQuery("#table_kat tr:last").after('<tr><td colspan="3"><input type="text" id="dodaj_nowa_kat_tb" /><input type="button" id="dodaj_nowa_kat_ok_btn" name="dodaj_nowa_kat_ok_btn" value="dodaj"/></td></tr>');
        }	
     });
     
      jQuery("#dodaj_nowa_kat_ok_btn").live('click', function(){
		  
		  var nr = parseInt(jQuery('input[id^="form_add"]').last().attr("id").substr(8))+1;
		  var x = nr+"";
          alert(x);
		  
		  jQuery("#dodaj_nowa_kat_btn").closest("tr").show();
          jQuery("#dodaj_nowa_kat_tb").closest("tr").hide();
        
		   var nazwa_tabeli = jQuery("#dodaj_nowa_kat_tb").val();
		 alert(nazwa_tabeli);
         jQuery.ajax({
              type: 'POST',
              url: '<? echo get_bloginfo('template_url'); ?>/create_new.php',
              data: { new_category: nazwa_tabeli },
              cache: false,
			  success: function()
              {

					alert(x);
					jQuery('#table_kat tr:last').prev().before('<tr><td>'+nazwa_tabeli+'</td><td><select name="kat_'+nazwa_tabeli+'" id="kat_'+nazwa_tabeli+'"></td><td><table id="kat_buttons'+x+'"><tr><td><input type="button" id="form_add'+x+'" name="'+nazwa_tabeli+'" value="dodaj"/></td><td><input type="button" id="form_edit'+x+'" name="'+nazwa_tabeli+'" value="edytuj"/></td><td><input type="button" id="form_delete'+x+'" name="'+nazwa_tabeli+'" value="usuń"/></td></tr></table></td></tr>');
              }
         });
         
     });	

    
    
    // *************************************
    
   jQuery('.submenu_group').each(function(){
		var div = jQuery(this).find('.submenu_active').length;		
		if(div==0)
		{
			jQuery(this).hide();
		}
	});

	// ********************************
	

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
	
	
	 // extend the default setting to always include the zebra widget. 
    $.tablesorter.defaults.widgets = ['zebra']; 
    // extend the default setting to always sort on the first column 
    $.tablesorter.defaults.sortList = [[0,0]]; 
    // call the tablesorter plugin 
    $("table").tablesorter(); 
	
	
	});
	
	</script>
<link href="<? echo get_bloginfo('template_url'); ?>/js/add_prod/general.css" rel="stylesheet" type="text/css" />
<style>

#main_contetn{
	min-width:1000px;
	float:left;
	position:relative;
}

#menu_lewe{
	float:left;
	position:relative;
	padding-right:10px;
	margin-left:15px;
}

#center_content{
	float:left;
	margin-left:10px;
	position:relative;
}

dd{
	margin-bottom:0px;	
	margin-left:15px;
}


div.content a.menu{
	text-decoration:none;
	color:black;	
}

div.content .menu{
	text-decoration:none;
	color:black;	
}

div.content a:link.on {color:#1fb5da; text-decoration:none; } /* unvisited link */
div.content a:visited.on {color:#1fb5da; text-decoration:none; } /* visited link */
div.content a:hover.on {color:#1fb5da; text-decoration:none; } /* mouse over link */
div.content a:active.on {color:#1fb5da; text-decoration:none; } /* selected link */

div.content a:link.over {color:#1fb5da; text-decoration:none; } /* unvisited link */
div.content a:visited.over {color:#1fb5da; text-decoration:none; } /* visited link */
div.content a:hover.over {color:#1fb5da; text-decoration:none; } /* mouse over link */
div.content a:active.over {color:#1fb5da; text-decoration:none; } /* selected link */
	
div.content .on{
	color:#1fb5da;
	}
	
div.content .over{
	color: #1fb5da;
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
#menu{
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

#right_content_page{
	width: 750px;
	float:right;
	margin-left:10px;
	margin-right:12px;
	position:relative;
}	

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
.accordionButtonLink {	
	width: 190px;
	float: left;
	_float: none;  /* Float works in all browsers but IE6 */
	/*background: #003366;*/
	border-bottom: 1px dashed black;
	cursor: pointer;
	}	
div.content .accordionButtonLink a{
	text-decoration:none;
	color:#000;
}
div.content .accordionButtonLink a:hover{
	text-decoration:none;
	color:#1fb5da;
}	
div.accordionContentMenu a.submenu_inactive{
	color: black; 
	text-decoration: none; 
	}
	
div.accordionContentMenu a.submenu_active{
	color: #1fb5da; 
	text-decoration: none; 
	}

.accordionContentMenu {	
	font-weight:normal;
	width: 170px;
	margin-left:20px;
	float: left;
	_float: none; /* Float works in all browsers but IE6 */
	/*background: #95B1CE;*/
	}
.on {
	/*background: #990000;*/
	color:#1fb5da;
	}
	
.over {
	color: #1fb5da;
	/*background: #CCCCCC;*/
	}

div.content .back_btn{
	width:150px;
	height:25px;
	color:#FFF;	
	background-color:#CCC;
	padding:5px;
	text-decoration: none;	
}

div.content.back_btn:focus, div.content .back_btn:active, div.content .back_btn:hover { 
text-decoration: none;
}
div.content .back_btn:hover {
	color:#000;
	background-color:#F90;
}
</style>


<div class="hfeed content">
<div id="main_contetn">
<?php

if ( is_user_logged_in() ) {
?>

<div id="mapa_listowanie">
	<div class="mapa">jesteś tutaj: <?php echo $_SERVER['REQUEST_URI']; ?></div>
</div>
<? include "menu.php"; ?>
<div id="right_content_page" >
  <table id="table_kat" width="200" border="1">
      <tr><th>rodzaj kategori </th><th colspan="2">nazwa kategori </th></tr>
  <?php
  /*
  wybor produktow od 0 od 30 z kategorii glownej
  
  SELECT t_product.nazwa
FROM `t_product` 
INNER JOIN t_subcategory ON t_product.id_subcat = t_subcategory.subID
INNER JOIN t_category ON t_category.id = t_subcategory.catID
WHERE t_category.id =3
LIMIT 0 , 30
  
  */
  
  
  /*
  
	wybor produktow od 0 do 30 z danej podkategorii  
  
  SELECT t_product.nazwa
FROM `t_product` 
INNER JOIN t_subcategory ON t_product.id_subcat = t_subcategory.subID
WHERE t_subcategory.subID = 6

 */
// 	global $wpdb;
	$wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
		  
	 $sql_cat =$wpdb->get_results("SELECT t_category.id, t_category.nazwa AS nazwa1, t_subcategory.subID, t_subcategory.nazwa AS nazwa2, t_subcategory.catID FROM `t_category` LEFT JOIN t_subcategory ON t_category.id = t_subcategory.catID", ARRAY_N); 
       
      $output=""; 
      $x=0;
	  $i=0;
	  $nr=1;
	  $poprzednia_nazwa_kategorii = "";

	  foreach ( $sql_cat as $s )
      {	  
		  $aktualna_nazwa_kategorii = $s[1];

			if($aktualna_nazwa_kategorii != $poprzednia_nazwa_kategorii)
			{			 	        
				if($x==1 || $i>0)
				{
					$output .= 
              '</select>
              </td>
              <td>		
                  
              <table id="kat_buttons'.$nr.'">
              <tr>
              <td>
              <input type="button" id="form_add'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="dodaj"/>
              </td>
              <td>
              <input type="button" id="form_edit'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="edytuj"/>
              </td>
              <td>			
              <input type="button" id="form_delete'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="usuń"/>
              </td>
			  <td>
			  <input type="button" id="kat_delete'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="usuń kategorie"/>
			  </td>
              </tr>
              </table>
  
              </td>
              </tr>';
					$nr++;
					$i=0;
				}
			
              $output .= '<tr><td>'.$aktualna_nazwa_kategorii.'</td><td>
              <select name="kat_'.$s[1].'" id="kat_'.$s[1].'">';					
			  $output .= '<option value="'.$s[2].'">'.$s[3].'</option>';

				 $poprzednia_nazwa_kategorii = $aktualna_nazwa_kategorii;
				$x=0;
				$i++;
          }
		  else
		  {
			  $x=1;
			  $i=0;
             $output .= '<option value="'.$s[2].'">'.$s[3].'</option>';			  
		  }		  		 		  
      }
	  		$output .= 
              '</select>
              </td>
              <td>		
                  
              <table id="kat_buttons'.$nr.'">
              <tr>
              <td>
              <input type="button" id="form_add'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="dodaj"/>
              </td>
              <td>
              <input type="button" id="form_edit'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="edytuj"/>
              </td>
              <td>			
              <input type="button" id="form_delete'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="usuń"/>
              </td>
			  <td>
			  <input type="button" id="kat_delete'.$nr.'" name="'.$poprzednia_nazwa_kategorii.'" value="usuń kategorie"/>
			  </td>
              </tr>
              </table>
  
              </td>
              </tr>';
	  
      echo $output;
  ?>
  
  
  <tr><td colspan="3">
  <input type="button" id="dodaj_nowa_kat_btn" name="dodaj_nowa_kat_btn" value="dodaj nowa rodzaj"/>
  </td></tr>
  </table>

</div>

<?php
} else {
    echo 'Welcome, visitor!';
}

?>
</div> <?php // closeing <div class="main_content"> ?>
</div> <?php // closeing <div class="hfeed content"> ?>
<?php get_footer(); ?>