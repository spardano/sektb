<?php
class home extends CI_Controller{

    var $folder =   "home";
    var $title  =   "HOME";

    function __construct() {
        parent::__construct();
    }
    
    function index()
    {
      $this->template->load('template', $this->folder.'/view'); 
    }
}