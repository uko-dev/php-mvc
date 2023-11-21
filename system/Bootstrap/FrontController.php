<?php
/**
 * MVC Framework bootstrap file
*/

require APP_DIR . "Utils/URL-parser.php";
require APP_DIR . "Utils/determine-IP.php";
require SYSTEM_DIR . "Bootstrap/Router.php";

class FrontController{

    /**
     * Request information
     * 
     * @var array
     */
    public $request = [];

    
    /**
     * Request type routes
     * 
     * @var array
     */
    public $routes = [];


    /**
     * Run application
     * 
     * @param array http requests routes 
     * @param array xmlhttp requests routes
     */
    public function init($http, $xmlhttp)
    {   
        // get request type
        $this->determineRequestType();

        // get request info depending on the request type
        if ($this->request['r_type'] == "http"){
            $this->determineRequestInfoHTTP();
            $this->routes = $http;
        }
        if ($this->request['r_type'] == "xmlhttp"){
            $this->determineRequestInfoXMLHTTP();
            $this->routes = $xmlhttp;
        }

        // get request ip address
        $this->request["ip"] = determineIPAddress();

        // run request Router
        $router = new Router($this->request, $this->routes);
    }


    /**
     * Determine request type
     */
    private function determineRequestType()
    {
        // initialize default type - HTTP
        $this->request['r_type'] = "http";

        // check if XML-HTTP
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === "XMLHttpRequest"){
            $this->request['r_type'] = "xmlhttp";
            
            // add $_GET information to request variable
            if ((isset($_GET) && !empty($_GET)) || ($_SERVER['REQUEST_METHOD']==='GET')){

                $this->request['r_xmlhttp_type'] = "get";

                // with params
                if (!empty($_SERVER['QUERY_STRING'])){
                    $this->request['r_name'] = strstr(substr($_SERVER['REQUEST_URI'], 1), "?", true);
                    parse_str($_SERVER['QUERY_STRING'], $this->request['r_data']);
                }

                // without params
                else{
                    $this->request['r_name'] = $_SERVER['REQUEST_URI'];
                    $this->request['r_data'] = $_SERVER['QUERY_STRING'];
                }
            }

            // add $_POST information to request variable
            if ((isset($_POST) && !empty($_POST)) || ($_SERVER['REQUEST_METHOD']==='POST')){
                $this->request['r_xmlhttp_type'] = "post";

                (empty($_POST)) ? $data = json_decode(file_get_contents('php://input'),true) : $data = $_POST;

                $this->request['r_name'] = $data['r_name'];
                unset($data['r_name']);

                $this->request['r_data'] = $data;
            }
        }
    }


    /**
     * Determine HTTP request info
     */
    private function determineRequestInfoHTTP()
    {
        // get link info
        $link       = rtrim(SITE_LINK, "/") . $_SERVER['REQUEST_URI'];
        $parsedInfo = $this->determinURLInfo($link);

        // add link info in request array
        $this->request['http_protocol'] = $parsedInfo['protocol'];
        $this->request['http_host']     = $parsedInfo['host'];
        $this->request['http_paths']    = $parsedInfo['path'];
        $this->request['http_query']    = $parsedInfo['query'];
    }


    /**
     * Determine XML-HTTP request info
     */
    private function determineRequestInfoXMLHTTP()
    {
        // get link info
        $link = $_SERVER['HTTP_REFERER'];
        $parsedInfo = $this->determinURLInfo($link);

        // add link info in request array
        $this->request['referer_http_link']     = $_SERVER['HTTP_REFERER'];
        $this->request['referer_http_protocol'] = $parsedInfo['protocol'];
        $this->request['referer_http_host']     = $parsedInfo['host'];
        $this->request['referer_http_paths']    = $parsedInfo['path'];
        $this->request['referer_http_query']    = $parsedInfo['query'];
    }


    /**
     * Parse link information
     * 
     * @param string link
     * 
     * @return array parsed link information
     */
    private function determinURLInfo($link)
    {
        // parse link information
        $parsedURL = new URLParser($link);
        $info      = [
            'protocol' => $parsedURL->get("protocol"),
            'host'     => $parsedURL->get("host"),
            'path'     => $this->determineRequestLanguage($parsedURL->get("path")),
            'query'    => $parsedURL->get("query")
        ];

        // return link information
        return $info;
    }


    /**
     * Determine request language
     * 
     * @param string link path
     */
    private function determineRequestLanguage($linkPath)
    {
        $lang = $linkPath[0];

        // if language is not contained in URL - default
        if (!in_array($lang, LANGS_LIST)){
            $this->request['lang'] = DEFAULT_LANG;
            $this->request['lang_link'] = SITE_LINK;
        }
        // if language is contained in URL - not default
        if (in_array($lang, LANGS_LIST)){
            $this->request['lang'] = $lang;
            $this->request['lang_link'] = SITE_LINK . $lang . "/";
            unset($linkPath[0]);
        }
        // if default language is contained in URL - 404
        if ($lang == DEFAULT_LANG){
            header("Location: " . SITE_LINK . "404");
            exit();
        }
        
        // return reindex link path
        return array_values($linkPath);
    }
}






?>