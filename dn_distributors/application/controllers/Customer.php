<?php


class Customer extends CI_Controller
{
    var $data;

    function __construct(){
        parent::__construct(); // needed when adding a constructor to a controller
        $this->data['cus_nic'] = $this->session->userdata('user_nic');
        // $this->data can be accessed from anywhere in the controller.
    }
    public function index(){
        //$this->load->view('templates/form');
        $this->data['cus_nic'] = $this->session->userdata('user_nic');

        $this->load->model('customer_model');
        $details['product']=$this->customer_model->get_product();
        $this->load->view('Customer/customer_main_view',$details);

    }

    public function LoadDeliveredOrder(){
        $cus_nic=$this->data['cus_nic'];
        //print_r($this->data);
        $this->load->model('customer_model');
        $data['delivered_order']=$this->customer_model->get_delivered_orders($cus_nic);
        $this->load->view('Customer/cus_view_delivered_orders', $data);
        //print_r($data);
    }

    public function LoadPendingOrder(){
        $cus_nic=$this->data['cus_nic'];
        $this->load->model('customer_model');
        $data['pending_orders']=$this->customer_model->get_pending_orders($cus_nic);
        $data['products']=$this->customer_model->get_order_product();
        $this->load->view('Customer/cus_view_pending_orders',$data);
        //print_r($data);
    }

    public function CancelOrder(){
        //$order_number=$this->input->post('order_no') ;
        $order_number=$_POST["order_id"];
        $this->load->model('customer_model');
        $respond=$this->customer_model->check_order($order_number);
        //print_r($order_number);
        if($respond){
            $massage=array('message' => 'Order Canceled!!!.','class' => 'alert alert-success fade in');
            $this->customer_model->cancel_pending_order($order_number);
            $this->session->set_flashdata('massage',$massage);
            redirect('Customer/index');

        }
        else{
            $massage=array('message' => 'Something Wrong.!!! Please Try Again. ','class' => 'alert alert-warning fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('Customer/index');
        }

    }

    public function LoadRegistration(){
        $this->load->view('Customer/cus_registration_view');
    }

    public function Registration(){

        $data=array('success'=>false,'massages'=>array());

        $this->form_validation->set_rules('cus_name','Your Name','required');
        $this->form_validation->set_rules('cus_nic','NIC','required|is_unique[customer.cus_nic]');
        $this->form_validation->set_rules('cus_address','Your Address','required');
        $this->form_validation->set_rules('cus_phone','Your Phone ','required');
        $this->form_validation->set_rules('cus_email','Email','required|valid_email|is_unique[customer.cus_email]');
        $this->form_validation->set_rules('cus_company_name','Company Name','required');
        $this->form_validation->set_rules('cus_company_address','Company Address','required');
        $this->form_validation->set_rules('cus_company_phone','Company Pnone','required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>' );

        if($this->form_validation->run() == FALSE ){
            foreach($_POST as $key => $value){
                $data['massages'][$key]=form_error($key);
            }
        }

        else
        {
            $data['success']=true;

            $this->load->model('customer_model');
            $this->customer_model->Reg_customer();
            $massage=array('message' => 'You are registered..','class' => 'alert alert-success fade in');
            $this->session->set_flashdata('massage',$massage);
        }
        echo json_encode($data);
    }

    public function ViewRegDetails(){
        //echo'aaa';
        $cus_nic=$this->data['cus_nic'];
        $this->load->model('customer_model');

        //get details of customer
        $details['customer']=$this->customer_model->get_customer($cus_nic);

        $this->load->view('Customer/cus_edit_reg_details',$details);
        //print_r($details);
    }

    public function EditRegDetails(){
        $cus_nic=$this->data['cus_nic'];

        $this->form_validation->set_rules('cus_name','cus_name','required');
        $this->form_validation->set_rules('cus_address','cus_address','required');
        $this->form_validation->set_rules('cus_phone','cus_phone','required');
        $this->form_validation->set_rules('cus_company_name','cus_company_name','required');
        $this->form_validation->set_rules('cus_company_address','cus_company_address','required');
        $this->form_validation->set_rules('cus_company_phone','cus_company_phone','required');
        //$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>' );

        if($this->form_validation->run() == FALSE ){
            $massage=array('massage' => 'You input some wrong details.please try again!!','class' => 'alert alert-warning fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('/Customer/ViewRegDetails');
        }

        else
        {
            $massage=array('massage' => 'You Edited Your Profile Details...','class' => 'alert alert-success fade in');
            $this->session->set_flashdata('massage',$massage);
            $this->load->model('customer_model');
            $this->customer_model->Update_Customer($cus_nic);
            redirect('/Customer/ViewRegDetails');

        }
    }

    public function LoadFeedback(){
        //$order_id=$this->input->post('order_no') ;
        $ordeer_id=$_POST["order_id"];
        $this->load->model('customer_model');
        $details['order']=$this->customer_model->get_order($ordeer_id);

        //print_r($details);
        //$details['product']=$this->customer_model->get_product();
        $this->load->view('Customer/cus_feedback_view',$details);

    }

    public function Feedback(){

        //$this->form_validation->set_rules('cus_feedback','cus_feedback','required');

        $data= $_POST["cus_feedback"];
        //$data['order_id']     = $_POST["order_id"];
        print_r($data);
        $this->load->model('customer_model');
        $this->customer_model->customer_feedback($data);
        $massage=array('massage' => 'Your Feedback Submitted ','class' => 'alert alert-success fade in');
        $this->session->set_flashdata('massage',$massage);
        redirect('Customer');
        /*if ($this->form_validation->run() == FALSE){
            $massage=array('message' => 'Something Wrong.. Please Try Again','class' => 'alert alert-warning fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('/Customer/');
        }

        else{

            $this->load->model('customer_model');
            $this->customer_model->customer_feedback();
            $massage=array('message' => 'Feedback Submitted','class' => 'alert alert-success fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('/Customer');
//            echo 'aaa';

        }*/


    }

    //functions that related to make order part are begin here
    public function MakeOrder(){
        $cus_nic=$this->data['cus_nic'];
        $this->load->model('customer_model');
        $details['product']=$this->customer_model->get_product();
        $details['customer']=$this->customer_model->get_customer($cus_nic);
        //print_r($details);
        $this->load->view('Customer/cus_makeorder_view',$details);

    }

    public function  AddToCart(){

        $data= array(
            "id"    => $_POST["product_id"],
            "name"  => $_POST["product_name"],
            "qty"   => $_POST["quantity"],
            "price" => $_POST["product_price"],
        );

        //$this->load->model('customer_model');
        //$this->customer_model->
        $this->cartdata = $data;
        //print_r($data);
        //print_r($this->cartdata);
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
        $count = 0;
        $cus_nic =$this->data['cus_nic'];;
        $order['delivery_address']=$delivery_address;
        $order['order_date'] = $order_date;
        foreach($this->cart->contents() as $item){
            $count++;
            //print_r($item);
            $data[] = $item ;
        }
        //print_r($count);
        //print_r($data);
        //print_r($order['delivery_address']);

        if($count==0){
            $massage=array('massage' => 'Please add items to order before submit..','class' => 'alert alert-warning fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('/Customer/MakeOrder');
        }
        else{

            $this->load->model('customer_model');
            $this->customer_model->add_order($cus_nic,$order,$data);
            $this->ClearCart();
            $massage=array('massage' => 'Your Order Added.It Will Delivered to You ','class' => 'alert alert-success fade in');
            $this->session->set_flashdata('massage',$massage);
            redirect('Customer');
        }
    }

}