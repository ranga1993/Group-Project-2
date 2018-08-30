<?php
class Admin_model extends CI_model{

    public function insert_customer_data(){

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

    public function insert_dp_data(){

        $data=array(
            'dp_name'=>$this->input->post('dp_name'),
            'dp_address'=>$this->input->post('dp_address'),
            'dp_nic'=>$this->input->post('dp_nic'),
            'dp_email'=>$this->input->post('dp_email'),
            'dp_phone'=>$this->input->post('dp_phone'),
            'password'=>sha1($this->input->post('password')),
            'confirm_password'=>sha1($this->input->post('confirm_password')));

        $query1 = "INSERT INTO delivery_person(dp_nic, dp_name, dp_address, dp_email, dp_phone) VALUES ('$data[dp_nic]', '$data[dp_name]', '$data[dp_address]', '$data[dp_email]', '$data[dp_phone]')";
        $query2 = "INSERT INTO user(user_nic, user_name, user_email, password, confirm_password, user_status) VALUES ('$data[dp_nic]', '$data[dp_name]', '$data[dp_email]', '$data[password]', '$data[confirm_password]', 2)";

        $this->db->query($query1);
        $this->db->query($query2);
    }

    public function update_customer($where, $data){
        $this->db->where($where);
        $this->db->update('customer', $data);
        return $this->db->affected_rows();
    }

    public function update_main_stock($where, $data){
        $this->db->where($where);
        $this->db->update('stock', $data);
        return $this->db->affected_rows();
    }

    public function update_vehicle_stock($where, $data){
        $this->db->where($where);
        $this->db->update('vehicle_stock', $data);
        return $this->db->affected_rows();
    }

    public function update_total_stock($where, $data){
        $this->db->where('product_name',$where);
        $this->db->update('total_stock', $data);
        return $this->db->affected_rows();
    }

    public function update_total_main_stock($product_name){
        $stock = $this->get_stock_for_cal($product_name);
        foreach($stock->result() as $row){
            $current_quantity =  $row->stock_quantity;
        }

        $data=array(
            'product_name'=>$product_name,
            'quantity'=>$current_quantity
        );
        $this->db->where('product_name',$product_name);
        $this->db->update('total_stock', $data);
        return $this->db->affected_rows();
    }

    public function update_total_main_stock_det($product_name, $new){
        $stock = $this->get_stock_for_cal($new);
        foreach($stock->result() as $row){
            $current_quantity =  $row->stock_quantity;
        }

        $data=array(
            'product_name'=>$new,
            'quantity'=>$current_quantity
        );
        $this->db->where('product_name',$product_name);
        $this->db->update('total_stock', $data);
        return $this->db->affected_rows();
    }

    public function update_total_vehicle_stock($id, $product_name, $current_quantity){
        $total = $this->get_total_stock_for_cal($product_name);
        foreach($total->result() as $row){
            $total_quantity =  $row->quantity;
        }
        $vehicle = $this->get_vehicle_stock_quantity($id);
        foreach($vehicle->result() as $row){
            $vehicle_quantity = $row->added_quantity;
        }

        $new_quantity = ($total_quantity + $current_quantity) - $vehicle_quantity;
        $data=array(
            'product_name'=>$product_name,
            'quantity'=>$new_quantity
        );
        $this->db->where('product_name',$product_name);
        $this->db->update('total_stock', $data);
        return $this->db->affected_rows();
    }

    public function get_vehicle_stock_quantity($id){
        $this->db->select("added_quantity");
        $this->db->from("vehicle_stock");
        $this->db->where('id', $id);
        return $this->db->get();
    }

    public function insert_main_stock(){

        $data=array(
            'date'=>$this->input->post('date'),
            'product_name'=>$this->input->post('product_name'),
            'stock_quantity'=>$this->input->post('quantity'));

        $query1 = "INSERT INTO stock(date, product_name, stock_quantity) VALUES ('$data[date]', '$data[product_name]', '$data[stock_quantity]')";

        $this->db->query($query1);
    }

    public function insert_total_stock(){

        $data=array(
            'product_name'=>$this->input->post('product_name'),
            'quantity'=>$this->input->post('quantity'));

        $query1 = "INSERT INTO total_stock(product_name,quantity) VALUES ('$data[product_name]', '$data[quantity]')";

        $this->db->query($query1);
    }

    public function insert_vehicle_stock(){

        $data=array(
            'date'=>$this->input->post('date'),
            'product_name'=>$this->input->post('product_name'),
            'added_quantity'=>$this->input->post('added_quantity'));

        $query1 = "INSERT INTO vehicle_stock(date, product_name, added_quantity, remain_quantity) VALUES ('$data[date]', '$data[product_name]', '$data[added_quantity]', '$data[added_quantity]')";

        $this->db->query($query1);
    }

    public function update_dp($where, $data){
        $this->db->where($where);
        $this->db->update('delivery_person', $data);
        return $this->db->affected_rows();
    }

    public function get_customer_data(){
        $query1 = "SELECT * FROM customer WHERE cus_availability = 1";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_vehicle_stock(){
        $query1 = "SELECT * FROM vehicle_stock";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_order_data(){
        $query1 = "SELECT * FROM orders";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_order_product_data(){
        $query1 = "SELECT * FROM order_product";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_main_stock(){
        $query1 = "SELECT * FROM stock";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_dp_data(){
        $query1 = "SELECT * FROM delivery_person WHERE dp_availability = 1";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_pending_orders(){
        $query1 = "SELECT * FROM order_details WHERE order_status = 1";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_delivered_orders(){
        $query1 = "SELECT * FROM order_details WHERE order_status = 2";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function get_product_details(){
        $query1 = "SELECT * FROM product";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function remove_customer($cus_id){

        $query = "UPDATE customer SET cus_availability = 2 WHERE cus_id = $cus_id";
        $this->db->query($query);
    }

    public function remove_product(){
        $data = array(
            'product_code'=>$this->input->post('product_code')
        );

        $query = "UPDATE product SET status = 2 WHERE product_code = '$data[product_code]'";
        $this->db->query($query);
    }


    public function remove_dp($dp_id){

        $query = "UPDATE delivery_person SET dp_availability = 2 WHERE dp_id = $dp_id";
        $this->db->query($query);
    }

    public function add_product(){

        $data=array(
            'product_name'=>$this->input->post('product_name'),
            'product_type'=>$this->input->post('product_type'),
            'product_description'=>$this->input->post('product_description'),
            'product_image'=>$this->input->post('product_image'),
            'product_price'=>$this->input->post('product_price'),
            'minimum_quantity'=>$this->input->post('minimum_quantity'));

        $query1 = "INSERT INTO product(product_name, product_type, product_description, product_image, product_price, minimum_quantity) VALUES ('$data[product_name]', '$data[product_type]', '$data[product_description]', '$data[product_image]', '$data[product_price]', '$data[minimum_quantity]')";

        $this->db->query($query1);
    }

    public function update_product($where, $data){

        $this->db->where($where);
        $this->db->update('product', $data);
        return $this->db->affected_rows();
    }

    public  function get_each_customer($cus_id){
        $query = $this->db->query("SELECT * FROM customer WHERE cus_id = $cus_id");
        return $query->row();
    }

    public  function get_before_quantity($stock_id){
        $query = $this->db->query("SELECT * FROM stock WHERE stock_id = $stock_id");
        return $query->row();
    }

    public  function get_each_main_stock(){
//        $query = $this->db->query("SELECT product_name, SUM(stock_quantity) AS stock_quantity FROM stock GROUP BY product_name");
        $query = $this->db->query("SELECT * FROM total_stock");
        return $query->row();
    }

    public  function get_each_vehicle_stock($id){
        $query = $this->db->query("SELECT * FROM vehicle_stock WHERE id = $id");
        return $query->row();
    }

    public  function get_update_each_main_stock($stock_id){
        $query = $this->db->query("SELECT * FROM stock WHERE stock_id = $stock_id");
//        $query = $this->db->query("SELECT * FROM total_stock");
        return $query->row();
    }

    public function get_product($product_id){
        $query = $this->db->query("SELECT * FROM product WHERE product_id = $product_id");
        return $query->row();
    }

    public  function get_each_dp($dp_id){
        $query = $this->db->query("SELECT * FROM delivery_person WHERE dp_id = $dp_id");
        return $query->row();
    }

    public  function get_each_pending_order($order_number){
        $query = $this->db->query("SELECT * FROM order_details WHERE order_number = $order_number");
        return $query->row();
    }

    public  function get_each_delivered_order($order_number){
        $query = $this->db->query("SELECT * FROM order_details WHERE order_number = $order_number");
        return $query->row();
    }

    public function search_customer($query){
        $this->db->select("*");
        $this->db->from("customer");
        $this->db->where('cus_availability', 1);

        if($query != ''){
            $this->db->like('cus_name', $query);
        }
        $this->db->order_by('cus_id', 'DESC');

        return $this->db->get();
    }

    public function search_dp($query){
        $this->db->select("*");
        $this->db->from("delivery_person");
        $this->db->where('dp_availability', 1);

        if($query != ''){
            $this->db->like('dp_name', $query);
        }
        $this->db->order_by('dp_id', 'DESC');

        return $this->db->get();
    }

    public function search_product($query){
        $this->db->select("*");
        $this->db->from("product");
//        $this->db->where('dp_availability', 1);

        if($query != ''){
            $this->db->like('product_name', $query);
        }
        $this->db->order_by('product_id', 'ASC');

        return $this->db->get();
    }

    public function search_update_main_stock($query){
        $this->db->select("*");
        $this->db->from("stock");
//        $this->db->where('dp_availability', 1);
//        $query = $this->db->query("SELECT product_name, SUM(stock_quantity) AS stock_quantity FROM stock GROUP BY product_name");
        if($query != ''){
            $this->db->like('product_name', $query);
        }
        $this->db->order_by('date', 'DESC');

        return $this->db->get();
    }

    public function search_main_stock($query){
        $this->db->select("*");
//        $this->db->select_sum("stock_quantity");
//        $this->db->group_by("product_name");
        $this->db->from("total_stock");
//        $this->db->where('dp_availability', 1);
//        $query = $this->db->query("SELECT product_name, SUM(stock_quantity) AS stock_quantity FROM stock GROUP BY product_name");
        if($query != ''){
            $this->db->like('product_name', $query);
        }

        return $this->db->get();
    }

    public function search_vehicle_stock($query){
        $this->db->select("*");
        $this->db->from("vehicle_stock");
        if($query != ''){
            $this->db->like('product_name', $query);
            $this->db->or_like('date', $query);
        }

        return $this->db->get();
    }

    public function get_stock_for_cal($product_name){
        $this->db->select_sum("stock_quantity");
        $this->db->from("stock");
        $this->db->where("product_name", $product_name);

        return $this->db->get();
    }

    public function get_total_stock_for_cal($product_name){
        $this->db->select_sum("quantity");
        $this->db->from("total_stock");
        $this->db->where("product_name", $product_name);

        return $this->db->get();
    }

    public function get_vehicle_stock_for_cal($id){
        $this->db->select_sum("added_quantity");
        $this->db->from("vehicle_stock");
        $this->db->where("id", $id);

        return $this->db->get();
    }

    public function get_min_quantity($product_name){
        $this->db->select("minimum_quantity");
        $this->db->from("product");
        $this->db->where("product_name", $product_name);

        return $this->db->get();
    }

    public function search_total_stock($product_name){
        $this->db->select("*");
        $this->db->from("total_stock");
        $this->db->where("product_name", $product_name);
        return $this->db->get();
    }

    public function get_old_product_name($stock_id){
        $this->db->select("product_name");
        $this->db->from("stock");
        $this->db->where("stock_id", $stock_id);
        return $this->db->get();
    }
}