<?php
class home extends CI_Controller
{

  var $folder =   "home";
  var $title  =   "HOME";

  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->template->load('template', $this->folder . '/view');
  }

  function testing()
  {
    $query = mysql_query("select id_training from data_training where mse = (select min(mse) from data_training)");
    $data = mysql_fetch_array($query);
    $id_training = $data[0];

    header('location:http://localhost/sektb/training/testing/' . $id_training);
  }
}
