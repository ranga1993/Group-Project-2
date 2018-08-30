<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function index()
    {
        $this->load->view('Admin/admin');
    }

    public function add_customer(){
        $this->load->view('Admin/add_customer');
    }

//    public function updateCustomer(){
//        $this->load->view('Admin/update_customer');
//    }
//
//    public function removeCustomer(){
//        $this->load->view('Admin/remove_customer');
//    }
//
//    public function removeDp(){
//        $this->load->view('Admin/remove_delivery_person');
//    }

//    public function removeProduct(){
//        $this->load->view('Admin/remove_product');
//    }

    public function add_delivery_person(){
        $this->load->view('Admin/add_delivery_person');
    }

//    public function update_delivery_person(){
//        $this->load->view('Admin/update_delivery_person');
//    }

    public function add_product(){
        $this->load->view('Admin/add_product');
    }

    public function vehicle_stock(){
        $this->load->view('Admin/add_vehicle_stock');
    }

    public function add_main_stock(){
        $this->load->view('Admin/add_main_stock');
    }

    public function update_vehicle_stock(){
        $this->load->view('Admin/update_vehicle_stock');
    }

    public function customer_registration(){
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
            $this->load->model('Admin_model');
            $this->Admin_model->insert_customer_data();
            $this->session->set_flashdata('success', 'Customer Successfully Registered');
            redirect('Admin/add_customer');
        }
        else{
//            echo 'Something Wrong';
            $this->session->set_flashdata('error', 'Registration Failed');
            redirect('Admin/add_customer');
        }
    }

    public function update_customer_details(){
        $data=array(
            'cus_name'=>$this->input->post('cus_name'),
            'cus_company_name'=>$this->input->post('cus_company_name'),
            'cus_company_address'=>$this->input->post('cus_company_address'),
            'cus_nic'=>$this->input->post('cus_nic'),
            'cus_email'=>$this->input->post('cus_email'),
            'cus_phone'=>$this->input->post('cus_phone'),
            'cus_company_phone'=>$this->input->post('cus_company_phone'));

        $this->load->model('Admin_model');
        $this->Admin_model->update_customer(array('cus_id'=>$this->input->post('cus_id')), $data);
        $this->session->set_flashdata('success', 'Successfully Updated');
        echo json_encode(array("status"=>TRUE));
    }

    public function update_product_details(){

//        $this->form_validation->set_rules('product_code', 'product_code', 'required|is_unique[product.product_code]');
//        $this->form_validation->set_rules('product_name', 'product_name', 'required|is_unique[product.product_name]');
//        $this->form_validation->set_rules('type', 'type', 'required');
//        $this->form_validation->set_rules('description', 'description', 'required');
//        $this->form_validation->set_rules('image', 'image', 'required');
//        $this->form_validation->set_rules('price', 'price', 'required');
//
//        if($this->form_validation->run() != FALSE){
//            $this->load->model('Admin_model');
//            $this->Admin_model->update_product();
//            redirect('Admin');
//        }
//        else{
//            echo 'Something Wrong';
//        }
        $data=array(
            'product_name'=>$this->input->post('product_name'),
            'product_type'=>$this->input->post('product_type'),
            'product_description'=>$this->input->post('product_description'),
            'product_image'=>$this->input->post('product_image'),
            'product_price'=>$this->input->post('product_price'));
        $this->load->model('Admin_model');
        $this->Admin_model->update_product(array('product_id'=>$this->input->post('product_id')), $data);
        $this->session->set_flashdata('success', 'Successfully Updated');
        echo json_encode(array("status"=>TRUE));
    }

    public function update_main_stock_details(){
        $data=array(
            'date'=>$this->input->post('date'),
            'product_name'=>$this->input->post('product_name'),
            'stock_quantity'=>$this->input->post('stock_quantity'));

        $data1=array(
            'product_name'=>$this->input->post('product_name'));

        $data2=array(
            'stock_id'=>$this->input->post('stock_id'));

        $this->load->model('Admin_model');
        $old_name = $this->Admin_model->get_old_product_name($data2['stock_id']);
        foreach($old_name->result() as $row){
            $old =  $row->product_name;
        }
        $this->Admin_model->update_main_stock(array('stock_id'=>$this->input->post('stock_id')), $data);
        $this->Admin_model->update_total_main_stock_det($old, $data1['product_name']);
        $this->session->set_flashdata('success', 'Successfully Updated');
        echo json_encode(array("status"=>TRUE));
    }

    public function update_vehicle_stock_details(){
        $data=array(
            'date'=>$this->input->post('date'),
            'product_name'=>$this->input->post('product_name'),
            'added_quantity'=>$this->input->post('added_quantity'),
            'remain_quantity'=>$this->input->post('added_quantity'));

        $data1=array(
            'id'=>$this->input->post('id'),
            'product_name'=>$this->input->post('product_name'));

        $this->load->model('Admin_model');
        $stock = $this->Admin_model->get_vehicle_stock_for_cal($data1['id']);
        foreach($stock->result() as $row){
            $current_quantity =  $row->added_quantity;
        }

        $total = $this->Admin_model->get_total_stock_for_cal($data['product_name']);
        foreach($total->result() as $row){
            $total_quantity =  $row->quantity;
        }
        $min = $this->Admin_model->get_min_quantity($data['product_name']);
        foreach($min->result() as $row){
            $min_quantity =  $row->minimum_quantity;
        }

        if((($total_quantity + $current_quantity) - $data['added_quantity']) >= $min_quantity){
            $this->Admin_model->update_vehicle_stock(array('id'=>$this->input->post('id')), $data);
            $this->Admin_model->update_total_vehicle_stock($data1['id'], $data1['product_name'], $current_quantity);
            $this->session->set_flashdata('success', 'Successfully Updated');
            echo json_encode(array("status"=>TRUE));
        }
        else{
            $this->session->set_flashdata('error', 'You Cannot Add Such Quantity.. Minimum Stock Quantity Reached');
            echo json_encode(array("status"=>FALSE));
        }

    }

    public function insert_main_stock(){
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
        $this->form_validation->set_rules('quantity', 'quantity', 'required');

        $data = array(
            'product_name'=>$this->input->post('product_name'),
//            'quantity'=>$this->input->post('added_quantity')
        );
        $this->load->model('Admin_model');
        $result = $this->Admin_model->search_total_stock($data['product_name']);
        foreach($result->result() as $row){
            $current_quantity =  $row->quantity;
        }

        $data1 = array(
            'product_name'=>$this->input->post('product_name'),
            'quantity'=>($this->input->post('quantity') + $current_quantity)
        );

        if($this->form_validation->run() != FALSE){
            if($result->num_rows() > 0){
                $this->load->model('Admin_model');
                $this->Admin_model->insert_main_stock();
                $this->Admin_model->update_total_stock($data['product_name'], $data1);
                $this->session->set_flashdata('success', 'Successfully Added To Company Stock');
                redirect('Admin/add_main_stock');
            }
            else{
                $this->load->model('Admin_model');
                $this->Admin_model->insert_main_stock();
                $this->Admin_model->insert_total_stock();
                $this->session->set_flashdata('success', 'Successfully Added To Company Stock');
                redirect('Admin/add_main_stock');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Stock Adding Failed');
            redirect('Admin/add_main_stock');
        }
    }

    public function add_vehicle_stock(){
        $this->form_validation->set_rules('date', 'date', 'required');
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
        $this->form_validation->set_rules('added_quantity', 'added_quantity', 'required');

        $data = array(
            'product_name'=>$this->input->post('product_name'),
            'quantity'=>$this->input->post('added_quantity')
        );
        $this->load->model('Admin_model');
        $stock = $this->Admin_model->get_stock_for_cal($data['product_name'])->result_array();
        $min = $this->Admin_model->get_min_quantity($data['product_name'])->result_array();

        if($this->form_validation->run() != FALSE){
            if($stock[0]['stock_quantity'] - $data['quantity'] >= $min[0]['minimum_quantity']){
//                $this->load->model('Admin_model');
                $data1=array(
                    'product_name'=>$this->input->post('product_name'),
                    'quantity'=>($stock[0]['stock_quantity'] - $data['quantity']));
                $this->Admin_model->insert_vehicle_stock();
                $this->Admin_model->update_total_stock($data1['product_name'],$data1);
                $this->session->set_flashdata('success', 'Successfully Added To Vehicle Stock');
                redirect('Admin/vehicle_stock');
            }
            else{
                $this->session->set_flashdata('error', 'Cannot Add To Vehicle Stock.. Minimum Stock Quantity Reached');
                redirect('Admin/vehicle_stock');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Vehicle Stock Adding Failed');
            redirect('Admin/vehicle_stock');
        }
    }

    public function view_customer(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_customer_data();
        $this->load->view('Admin/view_customers', $data);
    }

    public function view_vehicle_stock(){
        $this->load->model('Admin_model');
        $data1['h'] = $this->Admin_model->get_vehicle_stock();
        $this->load->view('Admin/view_vehicle_stock', $data1);
    }

    public function view_main_stock(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_main_stock();
        $this->load->view('Admin/view_main_stock', $data);
    }

    public function view_delivery_person(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_dp_data();
        $this->load->view('Admin/view_delivery_persons', $data);
    }

    public function view_pending_orders(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_pending_orders();
        $this->load->view('Admin/pending_orders', $data);
    }

    public function view_delivered_orders(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_delivered_orders();
        $this->load->view('Admin/delivered_orders', $data);
    }

    public function view_products(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_product_details();
        $this->load->view('Admin/view_products', $data);
    }

    public function update_customer(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_customer_data();
        $this->load->view('Admin/update_customer', $data);
    }

    public function update_product(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_product_details();
        $this->load->view('Admin/update_product', $data);
    }

    public function update_delivery_person(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_dp_data();
        $this->load->view('Admin/update_delivery_person', $data);
    }

    public function update_main_stock(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_main_stock();
        $this->load->view('Admin/update_main_stock', $data);
    }

    public function remove_customer(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_customer_data();
        $this->load->view('Admin/remove_customer', $data);
    }

    public function remove_product(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_product_details();
        $this->load->view('Admin/remove_product', $data);
    }

    public function remove_dp(){
        $this->load->model('Admin_model');
        $data['h'] = $this->Admin_model->get_dp_data();
        $this->load->view('Admin/remove_delivery_person', $data);
    }

    public function remove_delivery_person(){
        $this->form_validation->set_rules('name', 'name', 'required');

        if($this->form_validation->run() != FALSE){
            $this->load->model('Admin_model');
            $this->Admin_model->remove_dp();
            redirect('Admin');
        }
    }


    public function add_delivery_person_details(){

        $this->form_validation->set_rules('dp_name', 'dp_name', 'required');
        $this->form_validation->set_rules('dp_address', 'dp_address', 'required');
        $this->form_validation->set_rules('dp_nic', 'dp_nic', 'required|is_unique[delivery_person.dp_nic]|is_unique[user.user_nic]');
        $this->form_validation->set_rules('dp_email', 'dp_email', 'required|valid_email|is_unique[delivery_person.dp_email]|is_unique[user.user_email]');
        $this->form_validation->set_rules('dp_phone', 'dp_phone', 'required|is_unique[delivery_person.dp_phone]');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required|matches[password]');

        if($this->form_validation->run() != FALSE){
            $this->load->model('Admin_model');
            $this->Admin_model->insert_dp_data();
            $this->session->set_flashdata('success', 'Delivery Person Successfully Registered');
            redirect('Admin/add_delivery_person');
        }
        else{
            $this->session->set_flashdata('error', 'Registration Failed');
            redirect('Admin/add_delivery_person');
        }
    }

    public function update_dp_details(){

        $data=array(
            'dp_name'=>$this->input->post('dp_name'),
            'dp_address'=>$this->input->post('dp_address'),
            'dp_nic'=>$this->input->post('dp_nic'),
            'dp_email'=>$this->input->post('dp_email'),
            'dp_phone'=>$this->input->post('dp_phone'));

        $this->load->model('Admin_model');
        $this->Admin_model->update_dp(array('dp_id'=>$this->input->post('dp_id')), $data);
        $this->session->set_flashdata('success', 'Successfully Updated');
        echo json_encode(array("status"=>TRUE));
    }

    public function add_product_details(){

        $this->form_validation->set_rules('product_name', 'product_name', 'required|is_unique[product.product_name]');
        $this->form_validation->set_rules('product_type', 'product_type', 'required');
        $this->form_validation->set_rules('product_description', 'product_description', 'required');
        $this->form_validation->set_rules('product_image', 'product_image', 'required');
        $this->form_validation->set_rules('product_price', 'product_price', 'required');
        $this->form_validation->set_rules('minimum_quantity', 'minimum_quantity', 'required');

        if($this->form_validation->run() != FALSE){
            $this->load->model('Admin_model');
            $this->Admin_model->add_product();
            $this->session->set_flashdata('success', 'Product Registration is Successful');
            redirect('Admin/add_product');
        }
        else{
            $this->session->set_flashdata('error', 'Product Registration Failed');
            redirect('Admin/add_product');
        }
    }

    public function update_each_product($product_id){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_product($product_id);
        echo json_encode($data);
    }

    public function view_each_customer($cus_id){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_customer($cus_id);
        echo json_encode($data);
    }

    public function view_each_product_stock($stock_id){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_main_stock($stock_id);
        echo json_encode($data);
    }

    public function view_each_vehicle_stock($id){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_vehicle_stock($id);
        echo json_encode($data);
    }

    public function view_each_main_stock(){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_main_stock();
        echo json_encode($data);
    }

    public function remove_each_customer($cus_id){
        $this->load->model('Admin_model');
        $this->Admin_model->remove_customer($cus_id);
        $this->session->set_flashdata('success', 'Customer Successfully Removed From The System');
        echo json_encode(array("status" => TRUE));
    }

    public function update_each_customer($customer_id){
        $this->load->model('Admin_model');
        $this->Admin_model->update_customer($customer_id);
        echo json_encode(array("status" => TRUE));
    }

    public function update_each_main_stock($stock_id){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_update_each_main_stock($stock_id);
        echo json_encode($data);
    }

    public function view_each_pending_order($order_number){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_pending_order($order_number);
        echo json_encode($data);
    }

    public function view_each_delivered_order($order_number){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_delivered_order($order_number);
        echo json_encode($data);
    }

//    public function update_delivery_person($dp_id){
//        $this->load->model('Admin_model');
//        $this->Admin_model->update_delivery_person($dp_id);
//        echo json_encode(array("status" => TRUE));
//    }

    public function view_each_dp($dp_id){
        $this->load->model('Admin_model');
        $data = $this->Admin_model->get_each_dp($dp_id);
        echo json_encode($data);
    }

    public function remove_each_dp($dp_id){
        $this->load->model('Admin_model');
        $this->Admin_model->remove_dp($dp_id);
        $this->session->set_flashdata('success', 'Delivery Person Successfully Removed From The System');
        echo json_encode(array("status" => TRUE));
    }

    public function search_update_customer(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_customer($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Customer Name</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Company Contact Number</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->cus_name.'</td>
                        <td>'.$row->cus_nic.'</td>
                        <td>'.$row->cus_email.'</td>
                        <td>'.$row->cus_phone.'</td>
                        <td>'.$row->cus_company_name.'</td>
                        <td>'.$row->cus_company_address.'</td>
                        <td>'.$row->cus_company_phone.'</td>
                        <td><button type="button" class="btn btn-success" onclick="edit_customer('.$row->cus_id.')">Update</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_view_customer(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_customer($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Customer Name</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Company Contact Number</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->cus_name.'</td>
                        <td>'.$row->cus_nic.'</td>
                        <td>'.$row->cus_email.'</td>
                        <td>'.$row->cus_phone.'</td>
                        <td>'.$row->cus_company_name.'</td>
                        <td>'.$row->cus_company_address.'</td>
                        <td>'.$row->cus_company_phone.'</td>
                        <td><button type="button" class="btn btn-info" onclick="view_each_customer('.$row->cus_id.')">View</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_remove_customer(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_customer($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Customer Name</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Company Contact Number</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->cus_name.'</td>
                        <td>'.$row->cus_nic.'</td>
                        <td>'.$row->cus_email.'</td>
                        <td>'.$row->cus_phone.'</td>
                        <td>'.$row->cus_company_name.'</td>
                        <td>'.$row->cus_company_address.'</td>
                        <td>'.$row->cus_company_phone.'</td>
                        <td><button type="button" class="btn btn-warning" onclick="remove_each_customer('.$row->cus_id.')">Delete</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_update_dp(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_dp($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Delivery Person Name</th>
                        <th>Address</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->dp_name.'</td>
                        <td>'.$row->dp_address.'</td>
                        <td>'.$row->dp_nic.'</td>
                        <td>'.$row->dp_email.'</td>
                        <td>'.$row->dp_phone.'</td>
                        <td><button type="button" class="btn btn-success" onclick="edit_delivery_person('.$row->dp_id.')">Update</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_view_dp(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_dp($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Delivery Person Name</th>
                        <th>Address</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->dp_name.'</td>
                        <td>'.$row->dp_address.'</td>
                        <td>'.$row->dp_nic.'</td>
                        <td>'.$row->dp_email.'</td>
                        <td>'.$row->dp_phone.'</td>
                        <td><button type="button" class="btn btn-info" onclick="view_each_dp('.$row->dp_id.')">View</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_remove_dp(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_dp($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Delivery Person Name</th>
                        <th>Address</th>
                        <th>NIC</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->dp_name.'</td>
                        <td>'.$row->dp_address.'</td>
                        <td>'.$row->dp_nic.'</td>
                        <td>'.$row->dp_email.'</td>
                        <td>'.$row->dp_phone.'</td>
                        <td><button type="button" class="btn btn-warning" onclick="remove_each_dp('.$row->dp_id.')">Delete</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_update_product(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_product($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->product_type.'</td>
                        <td>'.$row->product_description.'</td>
                        <td><img src="'.base_url('assets/images/'.$row->product_image.'').'" width="100px" height="100px"></td>
                        <td>'.$row->product_price.'</td>
                        <td><button type="button" class="btn btn-success" onclick="update_product('.$row->product_id.')">Update</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_view_product(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_product($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->product_type.'</td>
                        <td>'.$row->product_description.'</td>
                        <td><img src="'.base_url('assets/images/'.$row->product_image.'').'" width="100px" height="100px"></td>
                        <td>'.$row->product_price.'</td>
                        <td><button type="button" class="btn btn-info" onclick="view_product('.$row->product_id.')">View</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_update_main_stock(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_update_main_stock($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->date.'</td>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->stock_quantity.'</td>
                        <td><button type="button" class="btn btn-success" onclick="edit_main_stock('.$row->stock_id.')">Update</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_view_main_stock(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_main_stock($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->quantity.'</td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_view_vehicle_stock(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_vehicle_stock($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->date.'</td>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->remain_quantity.'</td>
                        <td><button type="button" class="btn btn-info" onclick="view_stock('.$row->id.')">View</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_update_vehicle_stock(){
        $output = '';
        $query = '';
        $this->load->model('Admin_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Admin_model->search_vehicle_stock($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Added Quantity</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->date.'</td>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->added_quantity.'</td>
                        <td><button type="button" class="btn btn-success" onclick="edit_vehicle_stock('.$row->id.')">Update</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="7">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

}