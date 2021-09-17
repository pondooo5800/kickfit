<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_login extends CRUD_Controller
{

	private $another_js;
	private $another_css;

    function __construct(){
        parent::__construct();
        // 		echo('<pre>');
		// print_r($this->session->userdata());
		// echo('</pre>');
		// die();

        $this->load->library('form_validation');

		$this->data['page_url'] = site_url('member_login');
		$this->data['page_title'] = 'PHP - LOGIN';

		$js_url = 'assets/js_modules/registers/registers.js?ft=' . filemtime('assets/js_modules/registers/registers.js');
		$this->another_js .= '<script src="' . base_url($js_url) . '"></script>';
		$this->another_js .= '<script src="'. base_url() .'assets/js/member_login.js"></script>';
    }

	//ปรับแต่งตาม Template ที่ใช้งาน
	protected function render_view($path)
	{
		$template_name = 'backend';
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/'.$template_name.'/loginTemplate', $this->data);
	}

    public function index($msg = NULL){
        $this->load->model('common_model');
		$contact = $this->db->query("select * from tb_admin where user_id = 1 AND fag_allow = 'allow'");
		$this->data['contact'] = $contact->row_array();
		$this->render_view('member_loginView');
    }

    public function process(){
    	$this->load->model('common_model');
        $frm = $this->form_validation;

        $frm->set_rules('input_username', 'ชื่อผู้ใช้งาน', 'trim|required');
        $frm->set_rules('input_password', 'รหัสผ่าน', 'trim|required');

        $frm->set_message('required', 'กรุณากรอก %s');

        $data_insert = array(
        	'action'=>'login',
        	'path'=>(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
        );

        if ($frm->run() == FALSE) {
            $message  = '';
            $message .= form_error('input_username');
            $message .= form_error('input_password');
            $data = array(
                    'is_successful' => false,
                    'message' => $message
                );
            $data_insert['state_note'] = $message;
        } else {

            // Load the model
            $this->load->model('Member_login_model');
            // Validate the user can login
            $result = $this->Member_login_model->validate();

            // Now we verify the result
            $data = array();
            if(!$result){
                $message = 'ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง';

                $data['message'] = $message;
                $data['is_successful'] = false;
				$data['redirect_url'] = '';
            }else{
            	$data_insert['member_id'] = $this->session->userdata('member_id');
            	$data_insert['status'] = 'success';

                $data['message'] = '';
                $data['is_successful'] = true;

                $data['redirect_url'] = 'index';


				if($url = $this->session->userdata('after_login_redirect')){
					$data['redirect_url'] = $url;
				}
            }
        }

        // $this->common_model->insert('statistics',$data_insert);

        echo json_encode($data);
    }

    public function destroy(){

		$data = array(
            'member_id' => '',
            'member_user_id' => '',
            'member_mobile_no' => '',
            'member_email_addr' => '',
            'member_fname' => '',
            'member_lname' => '',
            'member_shop' => '',
            'encrypt_member_id'=>'',
            'url_encrypt_id'=>'',
			'login_validated' => FALSE,
		);

    	$this->load->model('common_model');
        $data_insert = array(
        	'action'=>'logout',
        	'path'=>(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"
        );
        $data_insert['member_id'] = $this->session->userdata('member_id');
        $data_insert['status'] = 'success';
    	// $this->common_model->insert('statistics',$data_insert);

		$this->session->set_userdata($data);

        redirect($this->session->userdata('after_login_redirect'));
    }

}
?>
