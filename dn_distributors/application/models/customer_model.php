<?php

class customer_model extends CI_Model
{
    public function get_customer($cus_nic){

        $this->db->where('cus_nic', $cus_nic);
        $query=$this->db->get("customer");
        return $query->result() ;
    }

    public function get_order($order_number){
        $this->db->where('order_number', $order_number);
        $query=$this->db->get("order_details");
        return $query->result() ;
    }

    public function check_order($order_number){
        $this->db->where('order_id', $order_number);
        $query=$this->db->get("orders");
        if ($query->num_rows() == 1){
            return true;
        }
        else {return false; }

    }

    public function get_product(){
        $query=$this->db->get("product");
        return $query->result() ;

    }

    public function Reg_customer(){
        $data=array(
            'cus_name'=>$this->input->post('cus_name',TRUE),
            'cus_address'=>$this->input->post('cus_address',TRUE),
            'cus_nic'=>$this->input->post('cus_nic',TRUE),
            'cus_phone'=>$this->input->post('cus_phone',TRUE),
            'cus_email'=>$this->input->post('cus_email',TRUE),
            'cus_company_name'=>$this->input->post('cus_company_name',TRUE),
            'cus_company_address'=>$this->input->post('cus_company_address',TRUE),
            'cus_company_phone'=>$this->input->post('cus_company_phone',TRUE),
            'cus_availability'=>1
        );

        return $this->db->insert('customer',$data);

    }

    public function Update_Customer($cus_nic){
        $data=array(
            'cus_name'=>$this->input->post('cus_name',TRUE),
            'cus_phone'=>$this->input->post('cus_phone',TRUE),
            'cus_company_name'=>$this->input->post('cus_company_name',TRUE),
            'cus_company_address'=>$this->input->post('cus_company_address',TRUE),
            'cus_company_phone'=>$this->input->post('cus_company_phone',TRUE)
        );

        //$query = "UPDATE customer SET cus_name='$data[cus_name]', cus_address='$data[cus_address]',cus_phone='$data[cus_phone]',cus_company_name='$data[cus_company_name],cus_company_address='$data[cus_company_address],cus_company_phone='$data[cus_company_phone]' WHERE cus_nic='$cus_nic";
        return $this->db->update('customer',$data,"cus_nic='$cus_nic'");

    }


    public function customer_feedback($data){

        /*$data=array (
            'order_no'=>$this->input->post('order_no'),
            'customer_feedback'=>$this->input->post('cus_feedback')
        );

        */$query = "UPDATE delivered_order SET customer_Feedback='$data[customer_feedback]'";
        return $this->db->query($query);

    }

    public function get_delivered_orders($cus_nic){
       $this->db->select('t2.order_id, t2.ordered_date, t2.delivery_address, t1.delevered_date, t3.product_id, t3.product_price, t3.quantity, t3.total_price');
        $this->db->from('delevered_order as t1');
        $this->db->where('t2.cus_nic', $cus_nic);
        $this->db->where('t2.order_status',2);
        $this->db->join('orders as t2', 't2.order_id = t1.order_id');
        $this->db->join('order_product as t3', 't3.order_id = t2.order_id');
        $query=$this->db->get();
        return $query;

    }

    public function get_pending_orders($cus_nic){
        $this->db->select('t2.order_id, t2.ordered_date,t2.delivery_address, t1.product_id,t1.product_price, t1.total_price, t1.quantity');
        $this->db->from('order_product as t1');
        $this->db->where('t2.cus_nic', $cus_nic );
        $this->db->where('t2.order_status',1);
        $this->db->join('orders as t2', 't2.order_id = t1.order_id', 'RIGHT');
        $query=$this->db->get();
        return $query;
    }

    public function get_order_product(){
        $this->db->select('*');
        $this->db->from('order_product');
        $query=$this->db->get();
        return $query;
    }

    public function cancel_pending_order($order_number){
        $query = "UPDATE orders SET order_status=3 WHERE order_id='$order_number'";
        return $this->db->query($query);

    }

    public function add_order($cus_nic,$order,$data){
        $order_no=substr($cus_nic,0,3).substr($order['order_date'],8,10).rand(10,20);
        $order_details = array(
            'order_id'         => $order_no,
            'cus_nic'          => $cus_nic,
            'ordered_date'     => $order['order_date'],
            'delivery_address' => $order['delivery_address'],
            'order_status'     => 1
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

}