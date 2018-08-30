<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class test extends CI_Controller {

    public function view_top()
    {
        $this->load->view('template/top.php');
    }

    public function view_form()
    {
        $this->load->view('template/form.php');
    }

    public function view_login(){
        $this->load->view('home/login.php');
    }

    public function view_home(){
        $this->load->view('home/Home.php');
    }
}