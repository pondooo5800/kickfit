<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Products_units.php ]
 */
class Products_units extends CRUD_Controller
{

	private $per_page;
	private $another_js;
	private $another_css;
	private $file_allow;

	public function __construct()
	{
		parent::__construct();

		chkUserPerm();

		$this->per_page = 30;
		$this->num_links = 6;
		$this->uri_segment = 4;
		$this->load->model('products_units/Products_units_model', 'Products_units');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('products_units/products_units');
		$this->file_allow_type = @array_values($this->file_allow);
		$this->file_allow_mime = @array_keys($this->file_allow);
		$this->file_check_name = '';
		$js_url = 'assets/js_modules/products_units/products_units.js?ft=' . filemtime('assets/js_modules/products_units/products_units.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */
	public function index()
	{
		$this->list_all();
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	protected function render_view($path)
	{
		$this->data['top_navbar'] = $this->parser->parse('template/backend/navbarView', $this->top_navbar_data, TRUE);
		$this->data['left_sidebar'] = $this->parser->parse('template/backend/sidebarView', $this->left_sidebar_data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/backend/indexView', $this->data);
	}

	/**
	 * Set up pagination config
	 * @param String path of controller
	 * @param Integer total record
	 */
	public function create_pagination($page_url, $total)
	{
		$this->load->library('pagination');
		$config['base_url'] = $page_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $this->per_page;
		$config['num_links'] = $this->num_links;
		$config['uri_segment'] = $this->uri_segment;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}

	// ------------------------------------------------------------------------

	/**
	 * List all record
	 */
	public function list_all()
	{
		$this->session->unset_userdata($this->Products_units->session_name . '_search_field');
		$this->session->unset_userdata($this->Products_units->session_name . '_value');

		$this->search();
	}

	// ------------------------------------------------------------------------

	/**
	 * Search data
	 */
	public function search()
	{
		if (isset($_POST['submit'])) {
			$search_field =  $this->input->post('search_field', TRUE);
			$value = $this->input->post('txtSearch', TRUE);
			$arr = array($this->Products_units->session_name . '_search_field' => $search_field, $this->Products_units->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Products_units->session_name . '_search_field');
			$value = $this->session->userdata($this->Products_units->session_name . '_value');
		}

		$start_row = $this->uri->segment($this->uri_segment, '0');
		if (!is_numeric($start_row)) {
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$order_by =  $this->input->post('order_by', TRUE);
		if ($order_by != '') {
			$arr = explode('|', $order_by);
			$field = $arr[0];
			$sort = $arr[1];
			switch ($sort) {
				case 'asc':
					$sort = 'ASC';
					break;
				case 'desc':
					$sort = 'DESC';
					break;
			}
			$this->Products_units->order_field = $field;
			$this->Products_units->order_sort = $sort;
		}
		$results = $this->Products_units->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('products_units/products_units');
		$pagination = $this->create_pagination($page_url . '/search', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$this->data['data_list']	= $list_data;
		$this->data['search_field']	= $search_field;
		$this->data['txt_search']	= $value;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['order_by']	= $order_by;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);

		$this->render_view('products_units/products_units/list_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Preview Data
	 * @param String encrypt id
	 */
	public function preview($encrypt_id = "")
	{
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Products_units->load($id);
			if (empty($results)) {
				$this->data['message'] = "??????????????????????????????????????????????????????????????????????????? <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('products_units/products_units/preview_view');
			}
		}
	}


	// ------------------------------------------------------------------------
	/**
	 * Add form
	 */
	public function add()
	{
		$this->data['data_id'] = 0;
		$this->render_view('products_units/products_units/add_view');
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('product_unit_name', '?????????????????????????????????????????????', 'trim|required');
		$frm->set_rules('fag_allow', '???????????????', 'trim|required');

		$frm->set_message('required', '- ?????????????????????????????????????????? %s');
		$frm->set_message('is_natural', '- %s ?????????????????????????????????????????????????????????????????????');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('product_unit_name');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('product_unit_name', '?????????????????????????????????????????????', 'trim|required');
		$frm->set_rules('fag_allow', '???????????????', 'trim|required');

		$frm->set_message('required', '- ?????????????????????????????????????????? %s');
		$frm->set_message('is_natural', '- %s ?????????????????????????????????????????????????????????????????????');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('product_unit_name');
			$message .= form_error('fag_allow');
			return $message;
		}
	}

	/**
	 * Create new record
	 */
	public function save()
	{
		$message = '';
		$message .= $this->formValidate();
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$post = $this->input->post(NULL, TRUE);
			$encrypt_id = '';

			$id = $this->Products_units->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>???????????????????????????????????????????????????????????????</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Products_units->error_message;
			}

			$json = json_encode(array(
				'is_successful' => $success,
				'encrypt_id' =>  $encrypt_id,
				'message' => $message,
				'id' => $id
			));
			echo $json;
		}
	}


	// ------------------------------------------------------------------------

	/**
	 * Load data to form
	 * @param String encrypt id
	 */
	public function edit($encrypt_id = '')
	{
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		if ($id == "") {
			$this->data['message'] = "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Products_units->load($id);
			if (empty($results)) {
				$this->data['message'] = "??????????????????????????????????????????????????????????????????????????? <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);
				$this->setPreviewFormat($results);
				$this->data['data_id'] = $id;

				$this->render_view('products_units/products_units/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$product_unit_id = ci_decrypt($data['encrypt_product_unit_id']);
		if ($product_unit_id == '') {
			$error .= '- ???????????? product_unit_id';
		}
		return $error;
	}
	/**
	 * Update Record
	 */
	public function update()
	{
		$message = '';
		$message .= $this->formValidateUpdate();
		$post = $this->input->post(NULL, TRUE);
		// die(print_r($post));
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$result = $this->Products_units->update($post);
			if ($result == false) {
				$message = $this->Products_units->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>???????????????????????????????????????????????????????????????</strong>' . $this->Products_units->error_message;
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));

			echo $json;
		}
	}

	/**
	 * Delete Record
	 */
	public function del()
	{
		$message = '';
		$post = $this->input->post(NULL, TRUE);
		$error_pk_id = $this->checkRecordKey($post);
		if ($error_pk_id != '') {
			$message .= "???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {
			$result = $this->Products_units->delete($post);
			if ($result == false) {
				$message = $this->Products_units->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>???????????????????????????????????????????????????</strong>';
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));
			echo $json;
		}
	}


	/**
	 * SET array data list
	 */
	private function setDataListFormat($lists_data, $start_row = 0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for ($i = 0; $i < $count; $i++) {
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['product_unit_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_product_unit_id'] = $pk1;
			$data[$i]['preview_fag_allow'] = $this->setFagAllowSubject($data[$i]['fag_allow']);
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setFagAllowSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'allow':
				$subject = '?????????????????????';
				break;
			case 'block':
				$subject = '??????????????????????????????';
				break;
			case 'delete':
				$subject = '??????';
				break;
		}
		return $subject;
	}

	/**
	 * SET array data list
	 */
	private function setPreviewFormat($row_data)
	{
		$data = $row_data;
		$pk1 = $data['product_unit_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_product_unit_id'] = $pk1;
		$this->data['record_product_unit_id'] = $data['product_unit_id'];
		$this->data['record_product_unit_name'] = $data['product_unit_name'];
		$this->data['record_user_add'] = $data['user_add'];
		$this->data['record_user_update'] = $data['user_update'];
		$this->data['record_user_delete'] = $data['user_delete'];
		$this->data['record_datetime_add'] = $data['datetime_add'];
		$this->data['record_datetime_update'] = $data['datetime_update'];
		$this->data['record_datetime_delete'] = $data['datetime_delete'];
		$this->data['preview_fag_allow'] = $this->setFagAllowSubject($data['fag_allow']);
		$this->data['record_fag_allow'] = $data['fag_allow'];

		$this->data['record_datetime_delete'] = setThaiDate($data['datetime_delete']);
		$this->data['record_datetime_add'] = setThaiDate($data['datetime_add']);
		$this->data['record_datetime_update'] = setThaiDate($data['datetime_update']);
	}
}
/*---------------------------- END Controller Class --------------------------------*/
