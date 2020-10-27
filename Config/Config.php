<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass");
define("VIEWS_PATH", "Views");
define("ASSETS_PATH", "Assets");
define("CSS_PATH", FRONT_ROOT.'/'.VIEWS_PATH.'/'.ASSETS_PATH."/css");
define("JS_PATH", FRONT_ROOT.'/'.VIEWS_PATH.'/'.ASSETS_PATH."/js");
define("API_KEY", "api_key=6b34cdf03eb047963c1b8f8ecb541c0a");
define("API_URL", "https://api.themoviedb.org/3/");

// Database data
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_NAME", "moviepass");

?>




