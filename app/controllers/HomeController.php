<?php
class HomeController extends Controller{

    public function __construct(){
        $this->model = $this->model("Home");
    }

    public function index(){
        $this->view("home/index");
    }
}