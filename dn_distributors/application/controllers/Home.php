<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index()
    {
        $this->load->view('home.php');
    }

    public function admin(){
        $this->load->view('admin');
    }

    public function customer(){
        $this->load->view('customer');
    }

    public function delivery_person(){
        $this->load->view('delivery_person');
    }

    public function products(){
        $this->load->model('user_model');
        $details['product'] = $this->user_model->get_product();
        $this->load->view('products', $details);
    }
}
