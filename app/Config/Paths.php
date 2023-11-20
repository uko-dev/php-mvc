<?php
/**
 * Contains the paths that are used by the framework
 * to locate the main directories: app, public, system, etc.
 */

/**
 *---------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------
 *
 * The APP directory is the main place where website logic and application code lives.
 * 
 * Folders in APP directory: 
 * /config
 * /controllers
 * /models
 * /views
 * /utils
 * 
 */
    $appDirectory = __DIR__ . "/../";
    define("APP_DIR", $appDirectory);


/**
 *---------------------------------------------------------
 * PUBLIC DIRECTORY NAME
 *---------------------------------------------------------
 *
 * The PUBLIC folder contains the framework bootstrap file - index.php
 * 
 * The PUBLIC folder also contains all the browser-accessible files of
 * your website, like CSS, JavaScript, website pictures and videos, etc.
 * 
 */
    $publicDirectory = __DIR__ . "/../../public/";
    define("PUBLIC_DIR", $publicDirectory);


/**
 *---------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------
 *
 * The SYSTEM folder contains all main framework files.
 * 
 * Be especially careful if you decide to make changes to any files in SYSTEM folder. 
 * 
 */
    $systemDirectory = __DIR__ . "/../../system/";
    define("SYSTEM_DIR", $systemDirectory);


?>