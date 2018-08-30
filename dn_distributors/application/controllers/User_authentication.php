<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_authentication extends CI_Controller{

    public function user_login()
    {
        $this->form_validation->set_rules('user_email', 'user_email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');



        if ($this->form_validation->run() == FALSE)
        {
            redirect('Home');
        }
        else
        {
            $this->load->model('user_model');
            $result=$this->user_model->userLogin();

            if ($result !=false) {
                $status=$result->user_status;
                if($status==1){
                    $user_data=array(
                        'user_id'=>$result->id,
                        'user_nic'=>$result->user_nic,
                        'user_name'=>$result->user_name,
                        'user_email'=>$result->user_email,
                        'loggedin'=>TRUE
                    );
                    $this->session->set_userdata($user_data);
                    redirect('Customer');
                }
                elseif($status==2){
                    $user_data=array(
                        'user_id'=>$result->id,
                        'user_nic'=>$result->user_nic,
                        'user_name'=>$result->user_name,
                        'user_email'=>$result->user_email,
                        'loggedin'=>TRUE
                    );
                    $this->session->set_userdata($user_data);
                    redirect('Delivery_person');
                }
                else{
                    $user_data=array(
                        'user_id'=>$result->id,
                        'user_nic'=>$result->user_nic,
                        'user_name'=>$result->user_name,
                        'user_email'=>$result->user_email,
                        'loggedin'=>TRUE
                    );
                    $this->session->set_userdata($user_data);
                    redirect('Admin');
                }
            }

            else{

//                $this->session->set_flashdata('errmsg','Wrong email and password');
//                redirect('Home');
                echo 'Wrong';
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('Home');
    }

    public function user_registration(){
        $this->form_validation->set_rules('cus_name', 'cus_name', 'required');
        $this->form_validation->set_rules('cus_company_name', 'cus_company_name', 'required');
        $this->form_validation->set_rules('cus_company_address', 'cus_company_address', 'required');
        $this->form_validation->set_rules('cus_nic', 'cus_nic', 'required|is_unique[customer.cus_nic]|is_unique[user.user_nic]');
        $this->form_validation->set_rules('cus_email', 'cus_email', 'required|valid_email|is_unique[customer.cus_email]|is_unique[user.user_email]');
        $this->form_validation->set_rules('cus_phone', 'cus_phone', 'required|is_unique[customer.cus_phone]');
        $this->form_validation->set_rules('cus_company_phone', 'cus_company_phone', 'required|is_unique[customer.cus_company_phone]');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]');

        if($this->form_validation->run() != FALSE){
            $this->load->model('user_model');
            $this->user_model->insert_user_data();
            redirect('Home');
        }
        else{
            echo 'Something Wrong';
        }
    }


}