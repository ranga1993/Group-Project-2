<?php

class Dp_model extends CI_Model{
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

    public function get_customer_data(){
        $query1 = "SELECT * FROM customer WHERE cus_availability = 1";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public  function get_each_customer($cus_id){
        $query = $this->db->query("SELECT * FROM customer WHERE cus_id = $cus_id");
        return $query->row();
    }

    public function get_product(){
        $query=$this->db->get("product");
        return $query->result() ;

    }

    public function add_order($cus_nic,$order,$data){
        $order_no=substr($cus_nic,0,3).substr($order['order_date'],8,10).rand(10,20);
        $order_details = array(
            'order_id'         => $order_no,
            'cus_nic'          => $cus_nic,
            'ordered_date'     => $order['order_date'],
            'delivery_address' => $order['delivery_address'],
            'order_status'     => 4
        );
        $this->db->insert('orders',$order_details);

        foreach ($data as $item){
            $this->db->select('product_name');
            $this->db->from('product');
            $this->db->where('product_id',$item['id']);
            $product_name =$this->db->get();
            //print_r($product_name);
            $order_product = array(
                'order_id'      => $order_no,
                'product_id'    => $item['id'],
                'product_price' => $item['price'],
                'quantity'      => $item['qty'],
                'total_price'   => $item['subtotal'],
            );
            $this->db->insert('order_product',$order_product);
        }

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

    public  function get_each_pending_order($order_id){
        $query1 = "SELECT customer.cus_name, orders.delivery_address, orders.ordered_date, product.product_name, order_product.quantity, order_product.total_price FROM customer, orders, order_product, product WHERE orders.cus_nic = customer.cus_nic AND orders.order_id = order_product.order_id AND order_product.product_id = product.product_id AND order_product.order_id = $order_id";
        $query = $this->db->query($query1);
        return $query->row();
    }

    public function search_pending_order($query){
        $this->db->select("orders.order_id, customer.cus_name, orders.delivery_address, orders.ordered_date, product.product_name, order_product.quantity, order_product.total_price");
        $this->db->from("orders");
        $this->db->join('order_product', 'orders.order_id = order_product.order_id');
        $this->db->join('customer', 'orders.cus_nic = customer.cus_nic');
        $this->db->join('product', 'order_product.product_id = product.product_id');
        $this->db->where_not_in('orders.order_status', array(2, 3));

        if($query != ''){
            $this->db->like('cus_name', $query);
        }
//        $this->db->order_by('ordered_date', 'ASC');

        return $this->db->get();
//        if($query != ''){
//            $query1 = "SELECT customer.cus_name AS cus_name, orders.delivery_address As delivery_address, orders.ordered_date As ordered_date, product.product_name AS product_name, order_product.quantity AS quantity, order_product.total_price AS total_price FROM customer, orders, order_product, product WHERE orders.cus_nic = customer.cus_nic AND orders.order_id = order_product.order_id AND order_product.product_id = product.product_id AND (orders.order_status NOT IN (2)) AND (customer.cus_name LIKE $query) ORDER BY ordered_date ASC";
//            return $query1;
//        }
    }

    public function get_order_data(){
//        $query1 = "SELECT * FROM delivery_person WHERE dp_availability = 1";
        $query1 = "SELECT customer.cus_name AS cus_name, orders.delivery_address As delivery_address, orders.ordered_date As ordered_date, product.product_name AS product_name, order_product.quantity AS quantity, order_product.total_price AS total_price FROM customer, orders, order_product, product WHERE orders.cus_nic = customer.cus_nic AND orders.order_id = order_product.order_id AND order_product.product_id = product.product_id AND (orders.order_status NOT IN (2)) ORDER BY ordered_date ASC";
        $query2 = $this->db->query($query1);
        return $query2;
    }

    public function complete_order($order_id){
//        $data=array('new_status'=>2);
//        $this->db->set('order_status', 'new_status', false);
        $this->db->set('order_status', 2);
        $this->db->where('order_id',$order_id);
        $this->db->update('orders');
//        return $this->db->affected_rows();
    }

    public function get_customer_vice_data($cus_id){
        $this->db->select("*");
        $this->db->from("customer");
        $this->db->where("cus_id", $cus_id);
        return $this->db->get();
    }

    public function get_order_details($order_id){
        $this->db->select("order_product.*, orders.*, product.*");
        $this->db->from("order_product");
        $this->db->join('orders', 'orders.order_id = order_product.order_id');
        $this->db->join('product', 'order_product.product_id = product.product_id');
        $this->db->where("order_id", $order_id);
        return $this->db->get();
    }

    public function get_stock($date){
        $this->db->select("*");
        $this->db->from("vehicle_stock");
        $this->db->where("date", $date);
        return $this->db->get();
    }

    public function get_order_quantity($order_id, $product_name){
        $this->db->select("product.*, order_product.*");
        $this->db->from("order_product");
        $this->db->join('product', 'order_product.product_id = product.product_id');
        $this->db->where("order_id", $order_id);
        $this->db->where("product_name", $product_name);
        return $this->db->get();
    }

    public function get_vehicle_quantity($pro_name, $date){
        $this->db->select("*");
        $this->db->from("vehicle_stock");
//        $this->db->join('product', 'order_product.product_id = product.product_id');
        $this->db->where("product_name", $pro_name);
        $this->db->where("date", $date);
        return $this->db->get();
    }

    public function update_stock($date, $product_name, $new_quantity){
        $this->db->set('remain_quantity', $new_quantity);
        $this->db->where('product_name',$product_name);
        $this->db->where('date',$date);
        $this->db->update('vehicle_stock');
    }
}