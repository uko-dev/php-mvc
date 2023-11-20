<?php
/**
 * FrontController request router
*/

require APP_DIR . "Utils/user-access-levels.php";

class Router{

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
     * Request access level
     * 
     * @var string
     */
    public $accessLevel = "";


    /**
     * Request controller name
     * 
     * @var string
     */
    public $controller = "";

    /**
     * Request method name
     * 
     * @var string
     */
    public $method = "";


    /**
     * Run router
     * 
     * @param array request information from FrontController
     * @param array request routes
     */
    public function __construct($request, $routes)
    {
        // initialize data from FrontController
        $this->request = $request;
        $this->routes  = $routes;
        
        // prepare request name for searching in routes
        if ($this->request['r_type'] == "http") {
            $requestNameForRoutes = $this->prepareRequestNameForRoutes($this->request['http_paths']);
            if (empty($this->request['http_paths'])) $this->request['http_paths'][0] = "";
        }
        if ($this->request['r_type'] == "xmlhttp") $requestNameForRoutes = $this->request['r_name'];
        
        // detarmine request executable file information
        $this->determineRequestExecutableFileInfo($requestNameForRoutes);

        // get request access level
        $this->determineRequestAccessLevel();

        // run execute file of request
        $this->runExecuteFileOfRequest();
    }


    /**
     * Prepare request name for searching in routes
     * 
     * @param array request name parts 
     */
    private function prepareRequestNameForRoutes($parts)
    {           
        // if request has only 1 parameter
        if (count($parts) == 1) $requestName = $parts[0];

        // if request has more than 1 parameters
        if (count($parts) > 1){
            // define params in request information variable
            $this->request['params'] = [];

            // define request name string
            $requestName = $parts[0];
            unset($parts[0]);

            // add params in request name string
            foreach ($parts as $key => $value) {
                $requestName .= "/&p";
                array_push($this->request['params'], $value);
            }
        }

        // if emply parameters - home page
        if (empty($parts)) $requestName = "";
        
        // return prepared request name
        return $requestName;
    }


    /**
     * Determine request name executable file information:
     * - controller
     * - method
     * - access level
     * 
     * @param string prepared request name
     */
    private function determineRequestExecutableFileInfo($requestName)
    {
        // iterate throught access levels
        foreach ($this->routes as $level => $routes) {

            // iterate throught pages
            foreach($routes as $page => $route){

                // get information about request executable file
                if ($requestName == $page){
                    $this->accessLevel = $level;

                    $routeParts = explode("/", $route);
                    $this->controller = ucfirst($routeParts[0]) . "Controller.php";
                    $this->method = $routeParts[1];
                }
            }
        }
    }


    /**
     * Determine request access level
     */
    private function determineRequestAccessLevel()
    {
        if (empty($this->accessLevel) || !checkingUserAccessLevel($this->accessLevel)){
            $this->showError();
        }
    }


    /**
     * Run request executable controller and method via BaseController
     */
    private function runExecuteFileOfRequest()
    {   
        // errors checking
        if (empty($this->controller) || empty($this->method)){
            $this->showError();
        }

        // run BaseController
        require APP_DIR . "Controllers/" . $this->accessLevel . "/BaseController.php";
        $baseController = new BaseController();
        $baseController->init($this->request, $this->accessLevel, $this->controller, $this->method);
    }


    /**
     * Show error
     */
    private function showError()
    {
        // redirect to 404 page
        if ($this->request['r_type'] == "http"){
            header("Location: " . $this->request['lang_link'] . "404");
            exit();
        }

        // send JSON with error
        if ($this->request['r_type'] == "xmlhttp"){
            exit(json_encode(["status" => "404", "message" => "An error has occurred!"]));
        }
    }
}





?>