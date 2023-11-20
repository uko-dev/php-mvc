<?php
/**
 *---------------------------------------------------------
 * HTTP APPLICATION ROUTES
 *---------------------------------------------------------
 *  
 * Contains the paths that are used by the system to connect
 * users HTTP requests with applications controllers.
 * 
 * Depending of requests' access levels, each route can be located in
 * different folders.
 * 
 */
return
[
    "public" => [
        ""             => "home/defaultPageView",
        "portfolio"    => "portfolio/bufferPageView",
        "portfolio/&p" => "portfolio/projectPageView",
        "404"          => "error/error404View"
    ]
];


?>