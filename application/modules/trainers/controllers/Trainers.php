<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Trainers.php ]
 */
class Trainers extends CRUD_Controller
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
		$this->load->model('trainers/Trainers_model', 'Trainers');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('trainers/trainers');
		$this->file_allow_type = @array_values($this->file_allow);
		$this->file_allow_mime = @array_keys($this->file_allow);
		$this->file_check_name = '';
		$js_url = 'assets/js_modules/trainers/trainers.js?ft=' . filemtime('assets/js_modules/trainers/trainers.js');
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
		chkUserPerm();
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
		$this->session->unset_userdata($this->Trainers->session_name . '_search_field');
		$this->session->unset_userdata($this->Trainers->session_name . '_value');

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
			$arr = array($this->Trainers->session_name . '_search_field' => $search_field, $this->Trainers->session_name . '_value' => $value);
			$this->session->set_userdata($arr);
		} else {
			$search_field = $this->session->userdata($this->Trainers->session_name . '_search_field');
			$value = $this->session->userdata($this->Trainers->session_name . '_value');
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
			$this->Trainers->order_field = $field;
			$this->Trainers->order_sort = $sort;
		}
		$results = $this->Trainers->read($start_row, $per_page);
		$total_row = $results['total_row'];
		$search_row = $results['search_row'];
		$list_data = $this->setDataListFormat($results['list_data'], $start_row);


		$page_url = site_url('trainers/trainers');
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

		$this->render_view('trainers/trainers/list_view');
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
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแสดงข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Trainers->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->setPreviewFormat($results);
				$this->render_view('trainers/trainers/preview_view');
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
		$this->render_view('trainers/trainers/add_view');
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

		$frm->set_rules('fname', 'ชื่อ', 'trim|required');
		$frm->set_rules('lname', 'นามสกุล', 'trim|required');
		$frm->set_rules('tel', 'เบอร์โทรศัพท์', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('username', 'username', 'trim|required');
		$frm->set_rules('password', 'password', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('fname');
			$message .= form_error('lname');
			$message .= form_error('tel');
			$message .= form_error('email_addr');
			$message .= form_error('username');
			$message .= form_error('password');
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

		$frm->set_rules('fname', 'ชื่อ', 'trim|required');
		$frm->set_rules('lname', 'นามสกุล', 'trim|required');
		$frm->set_rules('tel', 'เบอร์โทรศัพท์', 'trim|required');
		$frm->set_rules('email_addr', 'อีเมล', 'trim|required');
		$frm->set_rules('username', 'username', 'trim|required');
		$frm->set_rules('password', 'password', 'trim|required');


		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('fname');
			$message .= form_error('lname');
			$message .= form_error('tel');
			$message .= form_error('email_addr');
			$message .= form_error('username');
			$message .= form_error('password');
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

			$id = $this->Trainers->create($post);
			if ($id != '') {
				$success = TRUE;
				$encrypt_id = encrypt($id);
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>';
			} else {
				$success = FALSE;
				$message = 'Error : ' . $this->Trainers->error_message;
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
			$this->data['message'] = "กรุณาระบุรหัสอ้างอิงที่ต้องการแก้ไขข้อมูล";
			$this->render_view('ci_message/warning');
		} else {
			$results = $this->Trainers->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);
				$this->setPreviewFormat($results);
				$this->data['data_id'] = $id;

				$this->render_view('trainers/trainers/edit_view');
			}
		}
	}

	// ------------------------------------------------------------------------
	public function checkRecordKey($data)
	{
		$error = '';
		$user_id = ci_decrypt($data['encrypt_user_id']);
		if ($user_id == '') {
			$error .= '- รหัส user_id';
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
			$message .= "รหัสอ้างอิงที่ใช้สำหรับอัพเดตข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {

			$result = $this->Trainers->update($post);
			if ($result == false) {
				$message = $this->Trainers->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Trainers->error_message;
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
			$message .= "รหัสอ้างอิงที่ใช้สำหรับลบข้อมูลไม่ถูกต้อง";
		}
		if ($message != '') {
			$json = json_encode(array(
				'is_successful' => FALSE,
				'message' => $message
			));
			echo $json;
		} else {
			$result = $this->Trainers->delete($post);
			if ($result == false) {
				$message = $this->Trainers->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>ลบข้อมูลเรียบร้อย</strong>';
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
			$pk1 = $data[$i]['user_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$data[$i]['encrypt_user_id'] = $pk1;
			$data[$i]['record_user_id'] = $data[$i]['user_id'];
			$data[$i]['record_fullname'] = $data[$i]['fname'] .' '. $data[$i]['lname'];
			$data[$i]['record_username'] = $data[$i]['username'];
			$data[$i]['record_age'] = $data[$i]['age'];
			$data[$i]['record_addr'] = $data[$i]['addr'];
			$data[$i]['record_email_addr'] = $data[$i]['email_addr'];
			$data[$i]['date_of_birth'] = setThaiDate($data[$i]['date_of_birth']);
			$data[$i]['record_tel'] = $data[$i]['tel'];
			$data[$i]['datetime_add'] = setThaiDate($data[$i]['datetime_add']);
			$data[$i]['datetime_update'] = setThaiDate($data[$i]['datetime_update']);
			$data[$i]['datetime_delete'] = setThaiDate($data[$i]['datetime_delete']);
		}
		return $data;
	}

	/**
	 * SET choice subject
	 */
	private function setStatusSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'th':
				$subject = 'คนไทย';
				break;
			case 'en':
				$subject = 'คนต่างชาติ';
				break;
		}
		return $subject;
	}
	private function setFagAllowSubject($value)
	{
		$subject = '';
		switch ($value) {
			case 'allow':
				$subject = 'เผยแพร่';
				break;
			case 'block':
				$subject = 'ไม่เผยแพร่';
				break;
			case 'delete':
				$subject = 'ลบ';
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
		$pk1 = $data['user_id'];
		$this->data['recode_url_encrypt_id'] = urlencode(encrypt($pk1));

		if ($pk1 != '') {
			$pk1 = encrypt($pk1);
		}
		$this->data['encrypt_user_id'] = $pk1;
		$this->data['record_user_id'] = $data['user_id'];
		$this->data['record_password'] = $data['password'];
		$this->data['record_username'] =  $data['username'];
		$this->data['record_fname'] =$data['fname'];
		$this->data['record_lname'] =$data['lname'];
		$this->data['record_email_addr'] = $data['email_addr'];
		$this->data['record_tel'] = $data['tel'];
		$this->data['record_addr'] = $data['addr'];
		$this->data['record_age'] = $data['age'];
		$this->data['record_date_of_birth'] = setThaiDate($data['date_of_birth']);
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
