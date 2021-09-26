<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Services_model Class
 * @date 2019-12-05
 */
class Services_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_service';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$service_id = checkEncryptData($data['service_id']);
		$this->set_where("$this->my_table.service_id = $service_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.service_id = $id");
		return $this->load_record();
	}


	public function create($post,$id)
	{
		$data = array(
			'member_id' => $id,
			'fullname' => $post['member_fname'] .' '.$post['member_lname'],
			'member_pro' => $post['member_pro'],
			'service_count' => '1',
			'ser_date' => '',
			'ser_time' => '',
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
		$order_by	= 'service_id DESC ';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'fullname') {
				$search_method_value = "LIKE '%$value%'";
			}
			$where	.= ($where != '' ? ' AND ' : '') . " $search_method_field $search_method_value ";
			if ($order_by == '') {
				$order_by	= " $this->my_table.$search_field";
			}
		}
		$total_row = $this->count_record();


		$search_row = $total_row;
		if ($where != '') {
			$this->set_where($where);
			$search_row = $this->count_record();
		}
		$offset = $start_row;
		$limit = $per_page;
		$this->set_order_by($order_by);
		$this->set_offset($offset);
		$this->set_limit($limit);
		$this->db->select("$this->my_table.*,tb_members.member_fname,tb_members.member_lname,tb_promotions.promotion_name,tb_promotions.promotion_value");
		$this->db->join('tb_members', "$this->my_table.member_id = tb_members.member_id", 'left');
		$this->db->join('tb_promotions', "$this->my_table.member_pro = tb_promotions.promotion_id", 'left');

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
			'ser_date' => setDateToStandard($post['ser_date']),
			'ser_time' => $post['ser_time'],
			'service_count' => $post['service_count'] + 1,
			'fag_allow' => 'allow',
		);

		$service_id = checkEncryptData($post['encrypt_service_id']);
		$this->set_where("$this->my_table.service_id = $service_id");
		return $this->update_record($data);
	}

	public function delete($post)
	{
		$service_id = checkEncryptData($post['encrypt_service_id']);
		$this->set_where("$this->my_table.service_id = $service_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
