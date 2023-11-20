<?php
/**
 * Portfolio pages controller
 */

require APP_DIR . 'Models/public/Portfolio.php';

class PortfolioController extends BaseController{

    /**
     * Projects buffer page view
     * 
     * @param array
     * @param object
     */
    public function bufferPageView($r, $pt)
    {   
        // create request information HTML layout
        function showRequestInfo($arr){
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        }

        // get page title HTML
        $title = Portfolio::createBufferPageTitle($r['lang']);

        // show page
        include APP_DIR . 'Views/public/portfolio/buffer/page.php';
    }


    /**
     * Selected project page view
     * 
     * @param array
     * @param object
     */
    public function projectPageView($r, $pt)
    {   
        // validate if selected project exists
        if (Portfolio::validateProjectURL($r['http_paths'][1]) === false)
        {
            // header("Location: " . $r['lang_link'] . "404");
            // exit();
            echo $r['lang_link'] . "404";
            exit();
        }

        // create request information HTML layout
        function showRequestInfo($arr){
            echo "<pre>";
            print_r($arr);
            echo "</pre>";
        }

        // get page title HTML
        $projectTitle = Portfolio::getProjectPageTitle($r['lang'], $r['http_paths'][1]);

        include APP_DIR . 'Views/public/portfolio/'.$r['http_paths'][1].'/page.php';
    }
}
?>