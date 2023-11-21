<?php
/**
 * MVC Framework
 * 
 * This content is released under the MIT License (MIT)
 */

/**
 *---------------------------------------------------------
 * CORS CONFIG
 *---------------------------------------------------------
 *
 * this code is optional, you can remove it if you don't need any CORS features
 */
header('Access-Control-Allow-Origin: https://yourdomain.com/');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') return 0; // ignoring the options request


/**
 *---------------------------------------------------------
 * NECESSARY FILES CONNECTION
 *---------------------------------------------------------
 *
 * Project database configuration
 * 
 */
    require "../app/Config/Paths.php";
    require APP_DIR . "Config/Constants.php";


/**
 *---------------------------------------------------------
 * APPLICATION MODE
 *---------------------------------------------------------
 *
 * You are able to determine different applications mode.
 * 
 * Framework has 2 default modes for errors reporting: production, development.
 * 
 */
    define("ENVIRONMENT", "development");
    require SYSTEM_DIR . "Environment/Environment.php";


/**
 *---------------------------------------------------------
 * START APPLICATION SESSIONS
 *---------------------------------------------------------
 *
 * Running session in application.
 * 
 * You can store any default values as sessions variables.
 * 
 */
    session_start();


/**
 *---------------------------------------------------------
 * APPLICATION ROUTES FILES CONNECTION
 *---------------------------------------------------------
 *
 * Connect application HTTP and XML-HTTP routes.
 * 
 */
    $routesHTTP    = require APP_DIR . "Routes/http.php";
    $routesXMLHTTP = require APP_DIR . "Routes/xml-http.php";


/**
 *---------------------------------------------------------
 * BOOTSTRAP THE FRAMEWORK
 *---------------------------------------------------------
 *
 * Run the MVC framework
 * 
 */
    require SYSTEM_DIR . "Bootstrap/FrontController.php";
    $app = new FrontController();
    $app->init($routesHTTP, $routesXMLHTTP);
?>