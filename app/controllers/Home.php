<?php
class Home extends Controller{

    public function __construct(){
        $this->model = $this->model("Main");
    }

    public function index(){
        $this->view("home/index");
    }
}