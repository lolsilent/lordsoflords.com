<?php 

/**
 * HybridAuth
 * https://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | https://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: https://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------
/*
https://lordsoflords.com/login.php?hauth.done=Google
https://lordsoflords.com/login.php?hauth.done=Facebook
https://lordsoflords.com/login.php?hauth.done=Twitter
https://lordsoflords.com/login.php?hauth.done=Live
https://lordsoflords.com/login.php?hauth.done=LinkedIn

https://lordsoflords.com/login.php?hauth.done=Google
https://lordsoflords.com/login.php?hauth.done=Facebook
https://lordsoflords.com/login.php?hauth.done=Twitter
https://lordsoflords.com/login.php?hauth.done=Live
https://lordsoflords.com/login.php?hauth.done=LinkedIn
*/

return
		array(
			"base_url" => "https://lordsoflords.com/login.php",
			"providers" => array(
				// openid providers
				"OpenID" => array(
					"enabled" => false
				),
				"Yahoo" => array(
					"enabled" => false,
					"keys" => array("key" => "", "secret" => ""),
				),
				"AOL" => array(
					"enabled" => false
				),
				"Google" => array(
					"enabled" => true,
					"keys" => array("id" => "1095848232889-5vcvr1ct4s3l9jglafc91u6km7hni6ff.apps.googleusercontent.com", "secret" => "K2t98DQUh3LMRNs5HsdTpEFp"),
				),
				"Facebook" => array(
					"enabled" => true,
					"keys" => array("id" => "1039128972838357", "secret" => "537f55fef85445c64a486143f6fe8dae"),
					"trustForwarded" => false
				),
				"Twitter" => array(
					"enabled" => true,
					"keys" => array("key" => "13yuKQNvHZvxqzu4KAQi0A7Hd", "secret" => "NvBtbxtKtXLP9DEGby39GhkWU4i5UEiw67zQ0xNo7E7zQPLccQ"),
					"includeEmail" => false
				),
				// windows live
				"Live" => array(
					"enabled" => true,
					"keys" => array("id" => "000000004C18DF0E", "secret" => "I7r8qkRmJMxtwKXz8PWGmdPtzxuNdegE")
				),
				"LinkedIn" => array(
					"enabled" => true,
					"keys" => array("key" => "775pwl018sx5qd", "secret" => "BtAJfgA21Q77lt2b")
				),
				"Foursquare" => array(
					"enabled" => false,
					"keys" => array("id" => "", "secret" => "")
				),
			),
			// If you want to enable logging, set 'debug_mode' to true.
			// You can also set it to
			// - "error" To log only error messages. Useful in production
			// - "info" To log info and error messages (ignore debug messages)
			"debug_mode" => true,
			// Path to file writable by the web server. Required if 'debug_mode' is not false
			"debug_file" => "configdebug.php",
);
