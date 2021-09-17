<?php
class Shop_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function record_count()
  {
    return $this->db->count_all("tb_products");
  }
  public function fetch_product($limit, $start)
  {
    $this->db->select("tb_products.*,tb_products_units.product_unit_name");
    $this->db->from("tb_products");
		$this->db->join('tb_products_units', "tb_products.product_unit_id = tb_products_units.product_unit_id", 'left');
    $this->db->limit($limit, $start);
    $this->db->where("tb_products.fag_allow = 'allow'");
    $this->db->order_by("tb_products.product_id", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  public function fetch_category($limit, $start ,$product_type_id)
  {
    $this->db->select("tb_products.*,tb_products_units.product_unit_name");
    $this->db->from("tb_products");
		$this->db->join('tb_products_units', "tb_products.product_unit_id = tb_products_units.product_unit_id", 'left');
    $this->db->limit($limit, $start);
    $this->db->where("tb_products.fag_allow = 'allow'");
    $this->db->where("tb_products.product_type =".$product_type_id);
    $this->db->order_by("tb_products.product_id", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  public function fetch_banner($limit, $start ,$banner_id)
  {
    $this->db->select("tb_products.*,tb_products_units.product_unit_name");
    $this->db->from("tb_products");
		$this->db->join('tb_products_units', "tb_products.product_unit_id = tb_products_units.product_unit_id", 'left');
    $this->db->limit($limit, $start);
    $this->db->where("tb_products.fag_allow = 'allow'");
    $this->db->where("tb_products.banner_type =".$banner_id);
    $this->db->order_by("tb_products.product_id", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  public function fetch_promotion($limit, $start ,$promotion_id)
  {
    $this->db->select("tb_products.*,tb_products_units.product_unit_name");
    $this->db->from("tb_products");
		$this->db->join('tb_products_units', "tb_products.product_unit_id = tb_products_units.product_unit_id", 'left');
    $this->db->limit($limit, $start);
    $this->db->where("tb_products.fag_allow = 'allow'");
    $this->db->where("tb_products.product_pro_id =".$promotion_id);
    $this->db->order_by("tb_products.product_id", "desc");
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
  public function search($key)
  {
    $this->db->select("tb_products.*,tb_products_units.product_unit_name");
    $this->db->from("tb_products");
		$this->db->join('tb_products_units', "tb_products.product_unit_id = tb_products_units.product_unit_id", 'left');
    $this->db->like('product_name', $key);
    $this->db->where("tb_products.fag_allow = 'allow'");
    $this->db->order_by("tb_products.product_id", "desc");

    $query = $this->db->get();
    return $query->result_array();
  }

}
