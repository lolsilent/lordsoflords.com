<!DOCTYPE html>
<html>
<head>
<title>Lords of Lords the sword of the sixth element</title>
<meta charset="UTF-8">
<meta name="description" content="Lords of Lords the sword of the sixth element is a free online text-based role playing game!">
<meta name="keywords" content="text based RPG, lords of lords">
<link rel="shortcut icon" path="/favicon.ico">
<style type="text/css">
* {
margin:0px;
font-family:Arial,Tahoma,Verdana;
font-size:12px;
-webkit-appearance: none;
-moz-appearance: none;
appearance:   none;
}

body{
color:#ffffff;
background-color:#000000;
}

th {
border:1px #456789 solid;
background-color:#123456;
padding-left:1px;
padding-right:1px;
}


input, select, submit, textarea,option {
margin:0px;
border:1px #456789 solid;
border-width:1px;
font-size:8pt;
background-color:#123456;
color:#FFFFFF;
text-align:center;
}

a {
color:#eee888;
text-decoration:none;
}

a:hover{
color:#ffffff;
}

</style>
</head>
<body>
<a href="/"><img src="/images/lordsoflords2.jpg" width="436" height="46" border="0" title="Free online text-based RPG games" alt="Free online text-based RPG games"></a>




<div id="fb-root"></div>
<script>
	
	(function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1039128972838357";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


</script>

<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="true"></div>

<div class="fb-like" data-href="https://lordsoflords.com/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>






/*_______________-=TheSilenT.CoM=-_________________*/



<script>
 // This is called with the results from from FB.getLoginStatus().
 function statusChangeCallback(response) {
 console.log('statusChangeCallback');
 console.log(response);
 // The response object is returned with a status field that lets the
 // app know the current login status of the person.
 // Full docs on the response object can be found in the documentation
 // for FB.getLoginStatus().
 if (response.status === 'connected') {
  // Logged into your app and Facebook.
  testAPI();
 } else if (response.status === 'not_authorized') {
  // The person is logged into Facebook, but not your app.
  document.getElementById('status').innerHTML = 'Please log ' +
  'into this app.';
 } else {
  // The person is not logged into Facebook, so we're not sure if
  // they are logged into this app or not.
  document.getElementById('status').innerHTML = 'Please log ' +
  'into Facebook.';
 }
 }

 // This function is called when someone finishes with the Login
 // Button. See the onlogin handler attached to it in the sample
 // code below.
 function checkLoginState() {
 FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
 });
 }

 window.fbAsyncInit = function() {
 FB.init({
 appId  : '{your-app-id}',
 cookie  : true, // enable cookies to allow the server to access 
      // the session
 xfbml  : true, // parse social plugins on this page
 version : 'v2.5' // use graph api version 2.5
 });

 // Now that we've initialized the JavaScript SDK, we call 
 // FB.getLoginStatus(). This function gets the state of the
 // person visiting this page and can return one of three states to
 // the callback you provide. They can be:
 //
 // 1. Logged into your app ('connected')
 // 2. Logged into Facebook, but not your app ('not_authorized')
 // 3. Not logged into Facebook and can't tell if they are logged into
 // your app or not.
 //
 // These three cases are handled in the callback function.

 FB.getLoginStatus(function(response) {
 statusChangeCallback(response);
 });

 };

 // Load the SDK asynchronously
 (function(d, s, id) {
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) return;
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

 // Here we run a very simple test of the Graph API after login is
 // successful. See statusChangeCallback() for when this call is made.
 function testAPI() {
 console.log('Welcome! Fetching your information.... ');
 FB.api('/me', function(response) {
  console.log('Successful login for: ' + response.name);
  document.getElementById('status').innerHTML =
  'Thanks for logging in, ' + response.name + response.id + '!';
 });
 }
</script>

<!--
 Below we include the Login Button social plugin. This button uses
 the JavaScript SDK to present a graphical Login button that triggers
 the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();" autologoutlink="true">
</fb:login-button>

<div id="status">
</div>

</body>
</html>