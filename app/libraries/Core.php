<?php
class Core{
    protected $controller = "home";
    protected $action = "index";
    protected $params = [];

    public function __construct()
    {
        $url = $this->get_url();
        if(isset($url[0]) && file_exists(APPROOT . "/controllers/" . ucfirst(strtolower($url[0])) . "Controller.php")){
            $this->controller = ucfirst(strtolower($url[0]));
            unset($url[0]);
        }
        $this->controller = $this->controller . "Controller";
        require_once APPROOT . "/controllers/" . $this->controller . ".php";
        $this->controller = new $this->controller;

        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->action = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        
        call_user_func_array([$this->controller, $this->action], $this->params);
        
    }

    public function get_url(){
        return isset($_GET["url"]) ? explode("/", filter_var(rtrim($_GET["url"], "/"), FILTER_SANITIZE_URL)) : [];

        // if(isset($_GET["url"])){
        //     $url = rtrim($_GET["url"], "/");
        //     $url = filter_var($url, FILTER_SANITIZE_URL);
        //     $url = explode("/", $url);
        //     return $url;
        // }else return [];
    }
}