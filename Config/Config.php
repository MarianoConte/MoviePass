<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/MoviePass");
define("VIEWS_PATH", "Views");
define("ASSETS_PATH", "Assets");
define("CSS_PATH", FRONT_ROOT.'/'.VIEWS_PATH.'/'.ASSETS_PATH."/css");
define("JS_PATH", FRONT_ROOT.'/'.VIEWS_PATH.'/'.ASSETS_PATH."/js");
define("IMG_PATH", FRONT_ROOT.'/'.VIEWS_PATH.'/'.ASSETS_PATH."/img");
define("API_KEY", "api_key=93e965aff08c0f589671eb501c17f038");
define("API_URL", "https://api.themoviedb.org/3/");
define("DOMAIN", "http://localhost");
define('TIME_ZONE', 'America/Argentina/Buenos_Aires');

// Database data
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE_NAME", "moviepass");

?>