<?php	$menu = '';
	
	if($user_role == "administrator")  // menu zalezne od roli: admin, moderator, kupujacy, projektant
	{
		//$content .= "to jest admin!<br><br>";
		$menu .= '
		<dt>- <a class="menu" href="' . get_bloginfo('url') . '/pm-admin">Prywatne wiadomości w systemie</a></dt>
		<dt>- <a class="menu" href="' . get_bloginfo('url') . '/admin-historia-zamowien" >Historia zamówień</a></dt>
		<dt>- <a class="menu" href="' . get_bloginfo('url') . '/dodawanie-produktu" >Dodaj produkt</a></dt>
		<dt>- <a class="menu" href="' . get_bloginfo('url') . '/przeglad-produktow" >Przeglądaj Twoje produkty</a></dt>
		<dt>* <a class="menu" href="' . get_bloginfo('url') . '/dodaj-kategorie" >Dodaj kategorie</a></dt>
		<dt>* <a class="menu" href="' . get_bloginfo('url') . '/dodaj-tagi" >Dodaj tagi produktów</a></dt>
		<dt>* <a class="menu" href="' . get_bloginfo('url') . '/user-display" >Przeglądaj użytkowników</a></dt>
		<dt>* <a class="menu" href="' . get_bloginfo('url') . '/producent-display" >Przeglądaj producentów</a></dt>
		';
	}
	else if($user_role == "producent")
	{
		//$content .= "to NIE jest admin!<br>";	
		
		$menu .= '
		<dt><a class="menu" href="' . get_bloginfo('url') . '/?page_id=315" >Przeglądaj Twoje produkty</a></dt>
		';	
	}
	
?>

<div id="menu">
<div id="filter">Tytuł menu:</div>
<div id="wrapper">
	<div class="accordionButtonLink"><a href="http://naopak.com.pl/user-change-data" >Twoje dane</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/historia-zakupow" >Historia zakupów</a></div>
    <div class="accordionButton">Wiadomości</div>
    <div class="accordionContentMenu">
        <a class="submenu_inactive" href="http://naopak.com.pl/wordpress3/pm-wyslij?user=admin" id="sub_19">wyślij do admina</a>
        <br/>
        <a class="submenu_inactive" href="http://naopak.com.pl/wordpress3/pm-otrzymane" id="sub_20">otrzymane</a>
        <br/>
        <a class="submenu_inactive" href="http://naopak.com.pl/wordpress3/pm-wyslane" id="sub_20">wysłane</a>
        <br/>
    </div>
    <div class="accordionButtonLink"><a href="#" >Obserwowane</a></div>
    <div class="accordionButtonLink"><a href="#" >Ulubieni projektancji</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/pm-admin" >Prywatne wiadomości w systemie</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/admin-historia-zamowien" >Historia zamówień</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/dodawanie-produktu" >Dodaj produkt</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/przeglad-produktow" >Przeglądaj Twoje produkty</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/dodaj-kategorie" >Dodaj kategorie</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/dodaj-tagi" >Dodaj tagi produktów</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/user-display" >Przeglądaj użytkowników</a></div>
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/producent-display" >Przegldąj producentów</a></div>        
    <div class="accordionButtonLink"><a href="http://naopak.com.pl/ustawienia" >ustawienia</a></div>   
</div>
</div>