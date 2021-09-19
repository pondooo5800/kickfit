<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * Members_model Class
 * @date 2019-12-05
 */
class Members_model extends MY_Model
{

	private $my_table;
	public $session_name;
	public $order_field;
	public $order_sort;
	public $owner_record;

	public function __construct()
	{
		parent::__construct();
		$this->my_table = 'tb_members';
		$this->set_table_name($this->my_table);
		$this->order_field = '';
		$this->order_sort = '';
	}


	public function exists($data)
	{
		$member_id = checkEncryptData($data['member_id']);
		$this->set_where("$this->my_table.member_id = $member_id");
		return $this->count_record();
	}


	public function load($id)
	{
		$this->set_where("$this->my_table.member_id = $id");
		return $this->load_record();
	}


	public function create($post)
	{
		$data = array(
			'member_user_id' => $post['member_user_id'],
			'member_fname' => $post['member_fname'],
			'member_lname' => $post['member_lname'],
			'member_addr' => $post['member_addr'],
			'member_email_addr' => $post['member_email_addr'],
			'member_age' => $post['member_age'],
			'member_mobile_no' => $post['member_mobile_no'],
			'member_employment' => $post['member_employment'],
			'member_type' => $post['member_type'],
			'date_of_birth' => setDateToStandard($post['date_of_birth']),
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
		$order_by	= 'member_id DESC ';
		if ($this->order_field != '') {
			$order_field = $this->order_field;
			$order_sort = $this->order_sort;
			$order_by	= " $this->my_table.$order_field $order_sort";
		}

		if ($search_field != '' && $value != '') {
			$search_method_field = "$this->my_table.$search_field";
			$search_method_value = '';
			if ($search_field == 'member_user_id') {
				$search_method_value = "LIKE '%$value%'";
			}
			if ($search_field == 'member_fname') {
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
		$this->db->select("$this->my_table.*");

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
			'member_user_id' => $post['member_user_id'],
			'member_fname' => $post['member_fname'],
			'member_lname' => $post['member_lname'],
			'member_addr' => $post['member_addr'],
			'member_email_addr' => $post['member_email_addr'],
			'member_age' => $post['member_age'],
			'member_mobile_no' => $post['member_mobile_no'],
			'member_employment' => $post['member_employment'],
			'member_type' => $post['member_type'],
			'date_of_birth' => setDateToStandard($post['date_of_birth']),
			'fag_allow' => 'allow',
		);

		$member_id = checkEncryptData($post['encrypt_member_id']);
		$this->set_where("$this->my_table.member_id = $member_id");
		return $this->update_record($data);
	}

	public function delete($post)
	{
		$member_id = checkEncryptData($post['encrypt_member_id']);
		$this->set_where("$this->my_table.member_id = $member_id");
		return $this->delete_record();
	}
}
/*---------------------------- END Model Class --------------------------------*/
