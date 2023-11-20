<?php
/**
 * Errors pages controller
 */

class ErrorController extends BaseController{

    /**
     * View of 404 page
     * 
     * @param array
     * @param object
     */
    public function error404View($r, $pt)
    {
        // create request information HTML layout
        function showRequestInfo($arr){
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        }

        include APP_DIR . 'Views/public/404/' .$r['lang'] . '.php';
    }
}



?>