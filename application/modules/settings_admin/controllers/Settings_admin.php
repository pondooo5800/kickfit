<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Settings_admin.php ]
 */
class Settings_admin extends CRUD_Controller
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
		$this->load->model('settings_admin/Settings_admin_model', 'Settings_admin');
		$this->load->model('FileUpload_model', 'FileUpload');
		$this->data['page_url'] = site_url('settings_admin/settings_admin');
		$this->file_allow_type = @array_values($this->file_allow);
		$this->file_allow_mime = @array_keys($this->file_allow);
		$this->file_check_name = '';
		$js_url = 'assets/js_modules/settings_admin/settings_admin.js?ft=' . filemtime('assets/js_modules/settings_admin/settings_admin.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Index of controller
	 */

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
	 * Default Validation for Update
	 * see also https://www.codeigniter.com/userguide3/libraries/form_validation.html
	 */
	public function formValidateUpdate()
	{
		$this->load->library('form_validation');
		$frm = $this->form_validation;

		$frm->set_rules('password', 'รหัสผ่าน', 'trim|required');

		$frm->set_message('required', '- กรุณาใส่ข้อมูล %s');
		$frm->set_message('is_natural', '- %s ต้องระบุตัวเลขจำนวนเต็ม');

		if ($frm->run() == FALSE) {
			$message  = '';
			$message .= form_error('password');
			return $message;
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
			$results = $this->Settings_admin->load($id);
			if (empty($results)) {
				$this->data['message'] = "ไม่พบข้อมูลตามรหัสอ้างอิง <b>$id</b>";
				$this->render_view('ci_message/danger');
			} else {
				$this->data['csrf_field'] = insert_csrf_field(true);
				$this->setPreviewFormat($results);
				$this->data['data_id'] = $id;

				$this->render_view('settings_admin/settings_admin/edit_view');
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
		// $message .= $this->formValidateUpdate();
		$post = $this->input->post(NULL, TRUE);
		// $password = strlen($post['password']);
		// if ($password < 6) {
		// 	$ok = FALSE;
		// 	$message = "รหัสผ่านต้องมากกว่า 6 ตัวอักษร";
		// }

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
			$result = $this->Settings_admin->update($post);
			if ($result == false) {
				$message = $this->Settings_admin->error_message;
				$ok = FALSE;
			} else {
				$message = '<strong>บันทึกข้อมูลเรียบร้อย</strong>' . $this->Settings_admin->error_message;
				$ok = TRUE;
			}
			$json = json_encode(array(
				'is_successful' => $ok,
				'message' => $message
			));

			echo $json;
		}
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
