<?php 



$config = dirname(__FILE__) . '/config.php';

require_once( "h/Auth.php" );
require_once( "h/Endpoint.php" );

if (isset($_REQUEST['hauth_start']) || isset($_REQUEST['hauth_done']))
{
 Hybrid_Endpoint::process();
}

try{
$hybridauth = new Hybrid_Auth( $config );
//$twitter = $hybridauth->authenticate( "Google" );
$twitter = $hybridauth->authenticate( "Facebook" );
//$twitter = $hybridauth->authenticate( "Twitter" );
//$twitter = $hybridauth->authenticate( "Live" );
//$twitter = $hybridauth->authenticate( "Linkedin" );
//$user_profile = $twitter->getUserProfile();
echo "Hi there! " . $user_profile->displayName;
//$twitter->setUserStatus( "Hello world!" );
//$user_contacts = $twitter->getUserContacts();
}
catch( Exception $e ){
echo "Ooophs, we got an error: " . $e->getMessage();
}



?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1039128972838357";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-login-button" data-max-rows="1" scope="email" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>