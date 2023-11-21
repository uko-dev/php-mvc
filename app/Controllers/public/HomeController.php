<?php
/**
 * Home page controller
 */

require APP_DIR . 'Models/public/Home.php';

class HomeController extends BaseController{

    /**
     * Home page view
     * 
     * @param array request info
     * @param object pages templates object
     */
    public function defaultPageView($r, $pt)
    {   
        // create request information HTML layout
        function showRequestInfo($arr){
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        }

        // get page title HTML
        $title = Home::createPageTitle($r['lang']);

        // show page
        include APP_DIR . 'Views/public/home/page.php';
    }


    /**
     * Sending contacts form request example
     * 
     * @param array request info
     */
    public function sendContactForm($r)
    {   
        echo "<pre>";
        print_r($r);
        echo "</pre>";
        exit();
    }
}
?>