<?php
/**
 * Selection of your web application working mode.
 * 
 * Framework has 2 default modes for errors reporting:
 * 
 * Production mode - turn off errors reporting.
 * Development mode - turn on errors reporting.
 * 
 */
    switch(ENVIRONMENT)
    {
        // turn on errors reporting
        case "development":
            {
                error_reporting(-1);
                ini_set("display_errors", 1);

                // show array function
                function test($arr){
                    echo "<pre>";
                    print_r($arr);
                    echo "</pre>";
                    exit();
                }
            }
        break;

        // turn off errors reporting
        case "production":
            {
                ini_set("display_errors", 0);
            }
        break;
    }


?>
