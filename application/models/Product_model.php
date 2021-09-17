<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_model extends CI_Model{

    function __construct() {
        $this->proTable = 'tb_products';
        $this->custTable = 'customers';
        $this->ordTable = 'orders';
        $this->ordItemsTable = 'order_items';
    }

    /*
     * Fetch products data from the database
     * @param id returns a single record if specified, otherwise all records
     */
    public function getRows($id = ''){
        $this->db->select('*');
        $this->db->from($this->proTable);
        $this->db->where('fag_allow', 'allow');
        if($id){
            $this->db->where('product_id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $this->db->order_by('product_id', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }

        // Return fetched data
        return !empty($result)?$result:false;
    }

    /*
     * Fetch order data from the database
     * @param id returns a single record of the specified ID
     */
    public function getOrder($id){
        $this->db->select('o.*, c.name, c.email, c.phone, c.address');
        $this->db->from($this->ordTable.' as o');
        $this->db->join($this->custTable.' as c', 'c.id = o.customer_id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();

        // Get order items
        // $this->db->select('i.*, p.image, p.name, p.price');
        // $this->db->from($this->ordItemsTable.' as i');
        // $this->db->join($this->proTable.' as p', 'p.id = i.product_id', 'left');
        // $this->db->where('i.order_id', $id);
        // $query2 = $this->db->get();
        // $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();

        // Return fetched data
        return !empty($result)?$result:false;
    }
    public function getOrderProduct_PDF($id){
        $this->db->select('oi.*, p.product_code, p.product_name, p.price, p.product_img1');
        $this->db->from('order_items as oi');
        $this->db->join('tb_products as p', 'p.product_id = oi.product_id', 'left');
        $this->db->where('oi.order_id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return !empty($result)?$result:false;
    }
    public function getOrder_PDF($id){
        $this->db->select('o.*, c.name, c.email, c.phone, c.address, m.member_user_id, m.member_addr, m.member_same, m.member_note');
        $this->db->from($this->ordTable.' as o');
        $this->db->join($this->custTable.' as c', 'c.id = o.customer_id', 'left');
        $this->db->join('tb_members as m', 'm.member_id = c.member_id', 'left');
        $this->db->where('o.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return !empty($result)?$result:false;
    }

    /*
     * Insert customer data in the database
     * @param data array
     */
    public function insertCustomer($data){
        // Add created and modified date if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }

        // Insert customer data
        $insert = $this->db->insert($this->custTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    /*
     * Insert order data in the database
     * @param data array
     */
    public function insertOrder($data){
        // Add created and modified date if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }

        // Insert order data
        $insert = $this->db->insert($this->ordTable, $data);

        // Return the status
        return $insert?$this->db->insert_id():false;
    }

    /*
     * Insert order items data in the database
     * @param data array
     */
    public function insertOrderItems($data = array()) {

        // Insert order items
        $insert = $this->db->insert_batch($this->ordItemsTable, $data);

        // Return the status
        return $insert?true:false;
    }

}