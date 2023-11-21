<?php
/**
 * BaseController provides a convenient place for loading global components
 * or connecting functions that will be used in all controllers.
 * 
 * For example, you can configure here the logic of global components for pages, like header, footer, etc.
 */

require APP_DIR . 'Models/public/PagesTemplates.php';

class BaseController extends PagesTemplates{

    /**
     * Run request execute file
     * 
     * @var array information about request
     * @var string request access level
     * @var string controller of request
     * @var string method of request
     */
    public function init($request, $accessLevel, $controller, $method)
    {
        // connect request controller
        require APP_DIR . "Controllers/" . $accessLevel . "/" . $controller;

        // create request controller object
        $className     = str_replace(".php", "", $controller);
        $controllerObj = new $className;
        
        // run controller method for HTTP requests
        if ($request['r_type'] == "http")
        {
            // add page information to request array
            $request['page_name_only'] = $request['http_paths'][0];
            $request['page_with_params'] = $this->determinePageParams($request['http_paths']);

            $pt = new PagesTemplates(); // create pages templates object
            $pt->initRequestInfo($request); // send request information to Pages Templates Model
            $controllerObj->$method($request, $pt); // run controller methos
        }
        
        // run controller method for XMLHTTP requests
        else{
            $controllerObj->$method($request); // run controller methos
        }
    }


    /**
     * Determine page name
     * 
     * @var array http_paths from request array
     * 
     * @return string
     */
    private function determinePageParams($arr)
    {
        $url = "";

        (count($arr) == 1) ? $url = $arr[0] : $url = implode("/", $arr);

        return $url;
    }
}



?>