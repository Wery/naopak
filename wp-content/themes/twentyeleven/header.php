<?php
			if (isset($_POST['login-submit'])) {
				$creds = array();
				$creds['user_login'] = $_POST["email"];
				$creds['user_password'] = $_POST["pass"];
				$creds['remember'] = false;
				$user = wp_signon( $creds, false );
				if ( is_wp_error($user) )
				{
					echo $user->get_error_message();
				}
				else
				{
					echo  '<script>location.href = "' . site_url() . '/"</script>';
				}
			}
			if(isset($_POST['login-submit']))
			{
				if ($_GET['logout'] == 'true') {
						wp_logout();
						echo  '<script>location.href = "' . site_url() . '/"</script>';
				}
			}
			
			function print_basket()
			{
				$item_count=count($_SESSION['cart']);
				if($item_count < 1)
				{
					$message = "Twój koszyk jest pusty !";
				}
				else if($item_count == 1)
				{
					$message = "Masz 1 przedmiot w koszyku.";
				}
				else if($item_count > 1 & $item_count < 5)
				{
					$message = "Masz $item_count przedmioty w koszyku.";
				}
				else if($item_count >= 5)
				{
					$message = "Masz $item_count przedmiotów w koszyku.";
				}
				
				echo '<a id="koszyk" class="koszyk_btn" href="http://naopak.com.pl/koszyk" >'.$message.'</a>';
                echo '<a href="http://naopak.com.pl/koszyk" >';
                echo '<img id="img_koszyk" src="http://naopak.com.pl/img/koszyk.jpg"/></a>';
              
			}
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>

<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
 
<?php
function add_jquery_tools() {
		wp_register_script('addons_script', 'http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js', array('jquery'), '');
		wp_enqueue_script('addons_script');
		wp_register_script('addons_javascript', 'http://naopak.com.pl/wp-content/themes/twentyeleven/js/tooltips.js', false, '');
		wp_enqueue_script('addons_javascript');
}    
add_action('wp_print_scripts', 'add_jquery_tools');
?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php 
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
		<link rel="stylesheet" href="http://naopak.com.pl/wp-content/themes/twentyeleven/slider/slider.css" type="text/css" />
		
		
</head>

<body <?php body_class(); ?>>

	<!--
    <div class="horizontal" id="horizontal1"></div>
    <div class="horizontal" id="horizontal2"></div>
    <div class="horizontal" id="horizontal3"></div>
    <div class="horizontal" id="horizontal4"></div>
    <div class="horizontal" id="horizontal5"></div>
    <div class="horizontal" id="horizontal6"></div>
    <div class="vertical" id="vertical1"></div>
    <div class="vertical" id="vertical2"></div>
    <div class="vertical" id="vertical3"></div>
    <div class="vertical" id="vertical4"></div>
    <div class="vertical" id="vertical5"></div>
    <div class="vertical" id="vertical6"></div>
    -->
    
<div id="page" class="hfeed">

	<header id="branding" role="banner">
		<div class="shop-logo">
        	<a href="http://naopak.com.pl/"><img src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/naopak_logo.png" alt="naopak-logo" height="85" width="290"></a>
        </div>
        <div class="rightPanel">
        	<?php
			$permalink = site_url();
			if ( !is_user_logged_in() ) 
			{ 				
				echo '<div class="formDiv">';
				echo '
                <a id="register_link" href="' . $permalink . '/reg-user" target="_self">Rejestracja</a>
				<a id="regulamin_link" href="' . $permalink . '/regulamin" target="_self">Regulamin</a>
				<br>';
								print_basket();
				echo '<div class="form">';
				echo '<form id="mainLoginForm" action="' . $permalink . '/" method="post">';
                echo '        <div id="mainLoginForm">';				
				echo '            <input id="submit" type="submit" name="login-submit" value="OK"  /> ';
                echo '                <span id="loginEmailSpan"><label>LOGIN:</label><input id="loginEmail" type="text" name="email"  value="adres e-mail"/></span>';
                echo '            <br>';
                echo '                <span id="loginPassSpan"><label>HASŁO:</label><input id="loginPass" name="pass"  type="password" value="******"/></span>';                          
                echo '        </div>';
                echo '        </form>'; 
				echo '</div>';   				
				echo '</div>';
				
				echo '<div class="echo">';
                if (isset($_POST['login-submit'])) {
					echo 'Logowanie niepoprawne,<br>spróbuj ponownie lub <a href="' . $permalink . '/przypomnienie-hasla/" target="_self">przypomij hasło</a>.';
				}
				
				echo '</div>';
				echo '        <div class="clearFloat"></div>';
			}
			else
			{
				$perm = site_url() . '?logout=true';
				global $current_user;
      			get_currentuserinfo();
				echo '<div style="float:right"><span class="up_panel_links">';
				echo 'Witaj, ' . $current_user->user_login . '!';
				echo '<a href="http://naopak.com.pl/user-change-data" target="_self">Twój profil</a>';
				echo '<a href="' . $perm . '" target="_self">Wyloguj</a></span><span class="up_panel_basket">';
				
				print_basket();				
		
				echo '</span></div>';
			}
			?>
                    
        </div>
        <script>
			jQuery('#loginEmail').live('click', function() {
				$(this).val("");
			}); 
			jQuery('#loginPass').live('click', function() {
				$(this).val("");
			}); 
			
			jQuery('.koszyk_btn, #img_koszyk').hover(function(){
				jQuery('.koszyk_btn').css('background-color', '#F99D31');
				jQuery('.koszyk_btn').css('color', '#333');
			},function(){
				jQuery('.koszyk_btn').css('background-color', '#CCC');
				jQuery('.koszyk_btn').css('color', '#FFF');
			});
			
			jQuery('#mainLoginForm input[name="login-submit"]').hover(function(){
				jQuery('#mainLoginForm input[name="login-submit"]').css('background-color', '#F99D31');
				jQuery('#mainLoginForm input[name="login-submit"]').css('color', '#333');
			},function(){
				jQuery('#mainLoginForm input[name="login-submit"]').css('background-color', '#CCC');
				jQuery('#mainLoginForm input[name="login-submit"]').css('color', '#FFF');
		});
		</script>
        <div class="clear"></div>

			<!-- MENU -->
<?php
function generateMenu() {
$connection = Connect();
$result = mysql_query("SELECT id, nazwa FROM t_category")
or die(mysql_error());  
$num_rows = mysql_num_rows($result);
$i = 1;
while($row = mysql_fetch_array($result))
{
	echo '<a href="' . get_bloginfo('url') . '/lista2?cat=' . $row['id'] .'" target="_self">' . $row['nazwa'] . '</a><img src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/line.png" />   ';
	if($i == $num_rows)
	{
		echo '<a id="main-menuTrigger" href="#" target="_self">inne</a>   ';
	}
	$i++;
}
Disconnect($connection);
}
function generateSubmenu() {
	$connection = Connect();
	$result = mysql_query("SELECT subID, nazwa FROM t_subcategory")
	or die(mysql_error());  
	$num_rows = mysql_num_rows($result);
	echo '<table>';
	$i = 0;
	while($row = mysql_fetch_array($result))
	{
		if($i%2 ==0)
		{
			echo "<tr>";
			echo "<td>";
			echo '<a href="' . get_bloginfo('url') . '/lista2?subcat=' . $row['subID'] . '" target="_self">' . $row['nazwa'] . '</a>';
			echo "</td>";
		}
		else
		{
			echo "<td>";
			echo '<a href="' . get_bloginfo('url') . '/lista2?subcat=' . $row['subID'] . '" target="_self">' . $row['nazwa'] . '</a>';
			echo "</td>";
			echo "</tr>";		
		}
		$i++;	
	}
	echo "</table>";
	Disconnect($connection);
}
?>
            <div class="main-menu">
            	<?php  generateMenu(); ?>
            </div>
            <div class="main-submenu" id="main-submenu">
            	<?php  generateSubmenu(); ?>
            </div>
            <style>
			  /* tooltip styling */
			  .main-submenu {
				z-index:100000;				
				background-color:#fff;
				display:none;
				font-size:12px;
				height:auto;
				width:auto;
				padding:5px;
			  }			
			</style>
    		<!-- MENU -->

	</header><!-- #branding -->
    
<!--
	SLIDER
-->
	<div class="home-color-bar">
     	<div class="home-color-item" id="color1"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_yellow.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color2"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_orange.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color3"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_green.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color4"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_red.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color5"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_blue.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color6"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_purple.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color7"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_brown.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color8"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_grey.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color9"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_grey.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color10"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_grey.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color11"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_grey.png"  height="40px" width="80px"></a></div>
        <div class="home-color-item" id="color12"><a href="<?php echo get_bloginfo('url'); ?>/lista2?kolor=czarny" class="home-color-link" target="_self"><img alt="color-bar" class="home-color-image" src="http://naopak.com.pl/wp-content/themes/twentyeleven/images/color_tab_grey.png"  height="40px" width="80px"></a></div>
    </div>
<?php
function Connect() {
	$connection = @mysql_connect('localhost', 'root', '');
	if (!$connection) {
		die('Could not connect: ' . mysql_error());
	}
	$db = @mysql_select_db('bollo_naopak', $connection);
	mysql_set_charset('utf8',$connection); 
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	mysql_query('set names utf8;');
	return $connection;
}

function Disconnect($connection) {
	mysql_close($connection);
}

function getMaterialsList($kolor) {
	$connection = Connect();
	$result = mysql_query("SELECT nazwa FROM s_material")
	or die(mysql_error());  
	$num_rows = mysql_num_rows($result);
	echo "<table>";
	while($row = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>";
		echo '<a href="' . get_bloginfo('url') . '/lista2?material=' . $row['nazwa'] . '&kolor=' . $kolor .'" target="_self">' . $row['nazwa'] . '</a>';
		echo "</td>";
		echo "</tr>";		
	}
	echo "</table>";
	Disconnect($connection);
}
?>   

<!-- tooltip element -->
<style>
  /* tooltip styling */
  .tooltip {
	z-index:100000;
	background-color:#fff;
    display:none;
    font-size:12px;
    height:auto;
	width:70px;
    padding:5px;
  }

</style>
<script type="text/javascript" src="http://malsup.github.com/jquery.corner.js"></script>
<script type="text/javascript">
  jQuery('#main-submenu').corner("bottom");
  jQuery('.tooltip').corner("bottom");
  jQuery('.form').corner("bottom");
</script>
<div id="tooltip1" class="tooltip">
 <?php getMaterialsList("czarny"); ?>
</div>
<div id="tooltip2" class="tooltip">
 <?php getMaterialsList("czerwony"); ?>
</div>
<div id="tooltip3" class="tooltip">
 <?php getMaterialsList("zielony"); ?>
</div>
<div id="tooltip4" class="tooltip">
 <?php getMaterialsList("czarny"); ?>
</div>
<div id="tooltip5" class="tooltip">
 <?php getMaterialsList("czerwony"); ?>
</div>
<div id="tooltip6" class="tooltip">
 <?php getMaterialsList("zielony"); ?>
</div>
<div id="tooltip7" class="tooltip">
 <?php getMaterialsList("czarny"); ?>
</div>
<div id="tooltip8" class="tooltip">
 <?php getMaterialsList("czerwony"); ?>
</div>
<div id="tooltip9" class="tooltip">
 <?php getMaterialsList("zielony"); ?>
</div>
<div id="tooltip10" class="tooltip">
 <?php getMaterialsList("czarny"); ?>
</div>
<div id="tooltip11" class="tooltip">
 <?php getMaterialsList("czerwony"); ?>
</div>
<div id="tooltip12" class="tooltip">
 <?php getMaterialsList("zielony"); ?>
</div>
<!-- tooltip element -->
	<div id="main">
    
    	