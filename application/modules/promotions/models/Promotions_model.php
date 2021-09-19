<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Promotions_model Class
 * @date 2019-12-05
 */
class Promotions_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_promotions';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$promotion_id = checkEncryptData($data['promotion_id']);
		$this->set_where("$this->my_table.promotion_id = $promotion_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.promotion_id = $id");
		return $this->load_record();

	}


	public function create($post)
	{
		$data = array(
			'promotion_name' => $post['promotion_name'],
			'promotion_detail' => $post['promotion_detail'],
			'promotion_discount' => $post['promotion_discount'],
			'promotion_price' => $post['promotion_price'],
			'date_of_promotion_start' => setDateToStandard($post['date_of_promotion_start']),
			'date_of_promotion_end' => setDateToStandard($post['date_of_promotion_end']),
			'fag_allow' => 'allow',
		);
		return $this->add_record($data);
	}


	/**
	 * List all data
	 * @param $start_row	Number offset record start
	 * @param $per_page	Number limit record perpage
	 */
	public function read($start_row, $per_page)
	{
		$search_field 	= $this->session->userdata($this->session_name . '_search_field');
		$value 	= $this->session->userdata($this->session_name . '_value');
		$value 	= trim($value);

		$where	= '';
		$order_by	= 'promotion_id DESC ';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'promotion_name') {
				$search_method_value = "LIKE '%$value%'";
			}
			// if ($search_field == 'email_addr') {
			// 	$search_method_value = "LIKE '%$value%'";
			// }
			// if ($search_field == 'shop_user') {
			// 	$search_method_field = "users_2.user_fname";
			// 	$search_method_value = "LIKE '%$value%'";
			// }
			// if ($search_field == 'fag_allow') {
			// 	$search_method_value = "LIKE '%$value%'";
			// }
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value ";
			if ($order_by == '') {
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$total_row = $this->count_record();
		$search_row = $total_row;
		if ($where != '') {
			// $this->db->join('category AS category_1', "$this->my_table.cate_id = category_1.cate_id", 'left');
			// $this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
			// $this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
			// $this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
			// $this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*");
		// $this->db->join('users AS users_2', "$this->my_table.shop_user = users_2.user_id", 'left');
		// $this->db->join('users AS users_3', "$this->my_table.user_delete = users_3.user_id", 'left');
		// $this->db->join('users AS users_4', "$this->my_table.user_add = users_4.user_id", 'left');
		// $this->db->join('users AS users_5', "$this->my_table.user_update = users_5.user_id", 'left');

		$list_record = $this->list_record();
		// print_r($this->db->last_query());
		// die();

		$data = array(
			'total_row'	=> $total_row,
			'search_row'	=> $search_row,
			'list_data'	=> $list_record
		);
		return $data;
	}

	public function update($post)
	{
		$data = array(
			'promotion_name' => $post['promotion_name'],
			'promotion_detail' => $post['promotion_detail'],
			'promotion_discount' => $post['promotion_discount'],
			'promotion_price' => $post['promotion_price'],
			'date_of_promotion_start' => setDateToStandard($post['date_of_promotion_start']),
			'date_of_promotion_end' => setDateToStandard($post['date_of_promotion_end']),
			'fag_allow' => 'allow',
		);


		$promotion_id = checkEncryptData($post['encrypt_promotion_id']);
		$this->set_where("$this->my_table.promotion_id = $promotion_id");
		return $this->update_record($data);
	}


	public function delete($post)
	{
		$promotion_id = checkEncryptData($post['encrypt_promotion_id']);
		$this->set_where("$this->my_table.promotion_id = $promotion_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
