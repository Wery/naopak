<?php
/**

 Template Name: reg-login
 
 */
function add_scripts()
{
	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/reg/jquery.js"></script>';
	echo '<script type="text/javascript" src="'.get_bloginfo('template_url').'/reg/loginvalidation.js"></script>';
	
}
add_action('wp_head', 'add_scripts');

if ( is_user_logged_in() ) 
{ 
	/*echo  '<script>location.href = "' . site_url() . '/"</script>';*/
}

if (isset($_POST['submit'])) {
	$creds = array();
	$creds['user_login'] = $_POST["email"];
	$creds['user_password'] = $_POST["pass"];
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	/*if ( is_wp_error($user) )
	{
   		//echo $user->get_error_message();
	}
	else
	{
		echo  '<script>location.href = "' . site_url() . '/"</script>';
	}*/
}

get_header();

?>
		
<link href="<?php echo get_bloginfo('template_url') ?>/reg/general.css" rel="stylesheet" type="text/css"/>
 
<style>
#content{
}
.login{
	display: block;
	margin-left: auto;
	margin-right: auto;
	width: 250px;
	
	border: 2px #ccc solid;

}
</style>
       		
 <div id="primary">
			<div id="content" role="main">

				<?php // the_post(); ?>

				<?php // get_template_part( 'content', 'page' ); ?>    
                
                <div class="login">
                <p>Zaloguj się:</p>
                <div class="loginForm">
                    <form id="customForm" action="<?php the_permalink(); ?>" method="post">
                    <div>
                        <label for="email">Twój adres email:</label><input id="email" type="text" name="email" /> 
                        <br />
                        <span id="emailInfo"></span>
                    </div>
                    <div >
                        <label for="pass">Hasło:</label><input id="pass" name="pass"  type="password"/> 
                        <br />
                        <span id="passInfo"></span>
                    </div>
                     <div>
						<input id="submit" type="submit" name="submit" value="Zaloguj się" style="width:115px;" />
                    </div>
                        </form>
                        <div class="echo">
                          <?php
                if (isset($_POST['submit'])) {
					echo 'Logowanie niepoprawne, proszę spróbować ponownie';
				}
				?></div>
                    </div>
                <div class="przypomnienieForm">
                <form id="customForm" action="<?php the_permalink(); ?>" method="post">
                <div>
                        <label for="remindPassEmail">Twój adres email:</label><input id="remindPassEmail" type="text" name="remindPassEmail" /> 
                        <br />
                        <span id="emailInfo"></span>
                    </div>
                     <div>
						<input id="submit" type="submit" name="przypomnienieForm" value="Przypomnij hasło" style="width:115px;" />
                    </div>
                        </form>
                </div>
                  <div class="echo">
                <?php
				function md5_pass($length = 6)
				{
					return substr(md5(rand().rand()), 0, $length);
				}
 				
				if (!empty($_POST['przypomnienieForm'])) {
				   $remindPassEmail = $_POST["remindPassEmail"];
				   
				   $wpdb = new wpdb('root', '', 'bollo_naopak', 'localhost');
				   if ( username_exists(  $remindPassEmail ) )
					{
					    $newPass = md5_pass();
						$hashedPass = wp_hash_password($newPass); 		
						$result = mysql_query( "UPDATE `wpp_users` SET `user_pass` = '$hashedPass' WHERE `user_login` = '$remindPassEmail';")
						or die(mysql_error());  
						$subject = 'NaOpak - przypomnienie hasła';
						$message = 'Witamy,<br><br>';
						$message .= 'Dla Twojego konta w NaOpak.pl został wypełniony formularz przypomnienia hasła. W celach bezpieczeństwa zostało wygenerowane dla Ciebie nowe hasło. Prosimy o jego zmianę po zalogowaniu.<br><br>';
						$message .= 'Nowe hasło:<br><br>';
						$message .= urlencode($newPass) . '<br><br>';
						$message .= 'Pozdrawiamy,<br><br>';
						$message .= 'zespół NaOpak.pl';
						$header_info = 'MIME-Version: 1.0' . "\r\n";
						$header_info .= 'Content-type: text/html; charset=utf-8' . "\r\n";
						$header_info .= 'From: NaOpak.pl \r\n';
						mail($remindPassEmail, $subject, $message, $header_info);	
						echo 'Email z przypomnieniem hasła został wysłany.';
					}
					else
					{
						echo 'Nazwa użtkownika nie istnieje!';	
					}
				}
				?></div>
                </div>    
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>