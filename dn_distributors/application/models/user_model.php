<?php
class user_model extends CI_model{

    public function insert_user_data(){

        $data=array(
            'cus_name'=>$this->input->post('cus_name'),
            'cus_company_name'=>$this->input->post('cus_company_name'),
            'cus_company_address'=>$this->input->post('cus_company_address'),
            'cus_nic'=>$this->input->post('cus_nic'),
            'cus_email'=>$this->input->post('cus_email'),
            'cus_phone'=>$this->input->post('cus_phone'),
            'cus_company_phone'=>$this->input->post('cus_company_phone'),
            'password'=>sha1($this->input->post('password')),
            'confirm_password'=>sha1($this->input->post('confirm_password')));

        $query1 = "INSERT INTO customer(cus_nic, cus_name, cus_email, cus_phone, cus_company_name, cus_company_address, cus_company_phone) VALUES ('$data[cus_nic]', '$data[cus_name]', '$data[cus_email]', '$data[cus_phone]', '$data[cus_company_name]', '$data[cus_company_address]', '$data[cus_company_phone]')";
        $query2 = "INSERT INTO user(user_nic, user_name, user_email, password, confirm_password) VALUES ('$data[cus_nic]', '$data[cus_name]', '$data[cus_email]', '$data[password]', '$data[confirm_password]')";

        $this->db->query($query1);
        $this->db->query($query2);
    }

    public function userLogin(){
        $user_email=$this->input->post('user_email');
        $password=sha1($this->input->post('password'));

        $this->db->where('user_email',$user_email);
        $this->db->where('password',$password);
        $respond=$this->db->get('user');

        if($respond->num_rows()==1)
        {
            return $respond->row(0);

        }
        else
        {
            return false;
        }
    }

    public function get_product(){
        $query=$this->db->get("product");
        return $query->result() ;

    }
}