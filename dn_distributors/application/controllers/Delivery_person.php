<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_person extends CI_Controller{
    public function index(){
        $this->load->view('DP/delivery_person');
    }

    public function register_customer(){
        $this->load->view('DP/register_customer');
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
            $this->load->model('Dp_model');
            $this->Dp_model->insert_customer_data();
            $this->session->set_flashdata('success', 'Customer Successfully Registered');
            redirect('Delivery_person/register_customer');
        }
        else{
            $this->session->set_flashdata('error', 'Customer Registration Failed');
            redirect('Delivery_person/register_customer');
        }
    }

    public function view_customer(){
        $this->load->model('Dp_model');
        $data['h'] = $this->Dp_model->get_customer_data();
        $this->load->view('DP/customer_view', $data);
    }

    public function view_each_customer($cus_id){
        $this->load->model('Dp_model');
        $data = $this->Dp_model->get_each_customer($cus_id);
        echo json_encode($data);
    }

    public function MakeOrder(){
        $details['cus_nic'] ="";
        $details['cus_company_address'] = "";
        $this->load->model('Dp_model');
        $details['product']=$this->Dp_model->get_product();
        //print_r($details);
        $this->load->view('DP/dp_make_order',$details);

    }

    public function MakeOrderDirect(){
        $details['cus_nic'] =$_GET['cus_nic'];
        $details['cus_company_address'] =$_GET['cus_company_address'];
        $this->load->model('Dp_model');
        $details['product']=$this->Dp_model->get_product();
        //print_r($cus);
        $this->load->view('DP/dp_make_order',$details);

    }

    public function MakeOrderCustomerVice(){
        $details['cus_id'] =$_GET['cus_id'];
//        $output = '';
//        $cus_id = $this->input->post('cus_id');
//        print_r($details['cus_id']);
        $this->load->model('Dp_model');
        $data = $this->Dp_model->get_customer_vice_data($details['cus_id']);
        foreach($data->result() as $row){
            $cus_nic =  $row->cus_nic;
            $cus_company_address = $row->cus_company_address;
        }
        $details['cus_nic'] = $cus_nic;
        $details['cus_company_address'] = $cus_company_address;
        $details['product']=$this->Dp_model->get_product();
        $this->load->view('DP/dp_make_order',$details);
//        echo json_encode($details);
    }

    public function  AddToCart(){

        $data= array(
            "id"    => $_POST["product_id"],
            "name"  => $_POST["product_name"],
            "qty"   => $_POST["quantity"],
            "price" => $_POST["product_price"],
        );
        $this->cartdata = $data;
        $this->cart->insert($data);
        echo $this->ViewCart();

    }

    public function ViewCart(){

        $output='';
        $output.= '
            <h3> Your Order</h3>
            <div class = "table-responsive" >

                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Item Name</th>
                        <th width="15%">Quantity</th>
                        <th width="15%">Price(Rs.)</th>
                        <th width="15%">Total Price(Rs.)</th>
                        <th width="15%">Action</th>
                    </tr>
        ';
        $count = 0;
        foreach($this->cart->contents() as $item){
            $count++;
            $output .= '
                    <tr>
                        <td>'.$item["name"].'</td>
                        <td>'.$item["qty"].'</td>
                        <td>'.$item["price"].'</td>
                        <td>'.$item["subtotal"].'</td>
                        <td><button type="button" name="remove" class="btn btn-danger btn-xs remove_inventory" id="'.$item["rowid"].'"  >Remove</button></td>
                    </tr>
            ';
        }
        $output .='
                    <tr>
                        <td colspan="3" align="right" >Total Price of Your Order (Rs.)</td>
                        <td>'.$this->cart->total(). '</td>
                    </tr>
                </table>
            </div>
        ';

        if($count==0){
            $output = '<h3 align="center">Order is Empty</h3>';
        }
        return $output ;
    }

    public function LoadCart(){
        echo $this->ViewCart();
    }

    public function RemoveItem(){
        $row_id = $_POST["row_id"];
        //echo $row_id;
        $data = array(
            'rowid'   => $row_id,
            'qty'     => 0
        );

        $this->cart->update($data);
        echo $this->ViewCart();
    }

    public function ClearCart(){
        $this->cart->destroy();
        echo $this->ViewCart();
    }

    function SubmitOrder(){

        $delivery_address=$this->input->post('delivery_address') ;
        $order_date=$this->input->post('delivery_date') ;
        $cus_nic =$this->input->post('cus_nic') ;
        $count = 0;
        $order['delivery_address']=$delivery_address;
        $order['order_date'] = $order_date;

        foreach($this->cart->contents() as $item){
            $count++;
            //print_r($item);
            $data[] = $item ;
        }

        //print_r($cus_nic);
        if($count==0){
            $massage=array('massage' => 'Please add items to order before submit..','class' => 'alert alert-warning fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('/Delivery_person/MakeOrder');
        }
        else{
            $this->load->model('Dp_model');
            $this->Dp_model->add_order($cus_nic,$order,$data);
            $this->ClearCart();
            $massage=array('massage' => 'Your Order Added.','class' => 'alert alert-success fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('Delivery_person');
        }
    }

    public function search_view_customer(){
        $output = '';
        $query = '';
        $this->load->model('Dp_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Dp_model->search_customer($query );
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
                        <td><button type="button" class="btn btn-info" onclick="make_order('.$row->cus_id.')">Make Order</button></td>
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

    public function view_pending_orders(){
        $this->load->model('Dp_model');
        $data['h'] = $this->Dp_model->get_order_data();
        $this->load->view('Dp/pending_orders', $data);
    }

    public function view_each_pending_order($order_id){
        $this->load->model('Dp_model');
        $data = $this->Dp_model->get_each_pending_order($order_id);
        echo json_encode($data);
    }

    public function search_view_pending_orders(){
        $output = '';
        $query = '';
        $this->load->model('Dp_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Dp_model->search_pending_order($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Delivery Address</th>
                        <th>Ordered Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->order_id.'</td>
                        <td>'.$row->cus_name.'</td>
                        <td>'.$row->delivery_address.'</td>
                        <td>'.$row->ordered_date.'</td>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->quantity.'</td>
                        <td>'.$row->total_price.'</td>
                        <td><button type="button" class="btn btn-success" onclick="complete_order('.$row->order_id.')">Deliver Order</button></td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="6">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }

    public function search_view_pending_orders_view(){
        $output = '';
        $query = '';
        $this->load->model('Dp_model');

        if($this->input->post('query')){
            $query = $this->input->post('query');
        }
        $data = $this->Dp_model->search_pending_order($query );
        $output .= '
            <div class="table-responsive">
                <table class="table table-stiped">
                    <tr>
                        <th>Order Id</th>
                        <th>Customer Name</th>
                        <th>Delivery Address</th>
                        <th>Ordered Date</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
        ';

        if($data->num_rows() > 0){
            foreach($data->result() as $row){
                $output .= '
                    <tr>
                        <td>'.$row->order_id.'</td>
                        <td>'.$row->cus_name.'</td>
                        <td>'.$row->delivery_address.'</td>
                        <td>'.$row->ordered_date.'</td>
                        <td>'.$row->product_name.'</td>
                        <td>'.$row->quantity.'</td>
                        <td>'.$row->total_price.'</td>
                    </tr>
                ';
            }
        }
        else{
            $output .= '<tr>
                            <td colspan="6">No Data Found</td>
                        </tr>';
        }
        $output .= '</table>';
        echo $output;
    }


    public function complete_order($order_id){
        $order_id = $this->input->post('order_id');
        $this->load->model('Dp_model');
        $data1 = $this->Dp_model->get_order_details($order_id);
        foreach($data1->result() as $pro1){
            $product_name = $pro1->product_name;
            $quantity1 = $pro1->quantity;
//            $details1['product_name'] = array($product_name, $quantity1);
        }
        $data2 = $this->Dp_model->get_stock(date('m/d/Y'));
        foreach($data2->result() as $pro2){
            $pro_name = $pro2->product_name;
            $quantity2 = $pro2->quantity;
//            $details2['pro'] = array($pro_name, $quantity2);
        }

        if($product_name == $pro_name){
            $data3 = $this->Dp_model->get_order_quantity($order_id, $product_name);
            $data4 = $this->Dp_model->get_vehicle_quantity($pro_name);

            $total_quantity = $data4 - $data3;
            print_r($total_quantity);
        }
//        foreach($data1->result() as $pro){
//            $product_name = $pro->product_name;
//            $quantity = $pro->quantity;
//        }
//        $data2 = $this->Dp_model->get_stock(date('m/d/Y'));
//        foreach($data2->result() as $row){
//            $pro_name = $row->product_name;
//            $qua = $row->added_quantity;
//        }
//        if($pro_name == $product_name){
//            $data3 = $this->Dp_model->get_order_product($order_id, $product_name);
//            foreach($data3->result() as $new1){
//                $quant_1 = $new1->quantity;
//            }
//            $data4 = $this->Dp_model->get_vehicle_quantity($pro_name, date('m/d/Y'));
//            foreach($data4->result() as $new2){
//                $quant_2 = $new2->added_quantity;
//            }
//
//            $new_quantity = $quant_2 - $quant_1;
//            $this->Dp_model->update_stock(date('m/d/Y'), $product_name, $new_quantity);
//        }
        $this->Dp_model->complete_order($order_id);
//        echo json_encode(array("status"=>TRUE));
    }

}