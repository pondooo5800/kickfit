
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_login_model extends CI_Model
{
	private $tb_member_login;

    function __construct(){
        parent::__construct();

		$this->tb_member_login = 'tb_admin';
    }

	public function encrypt_md5_salt($pass)
	{
		// admin
		// 123456 ($2y$11$7E1Dw5fgB1FifW0apMj8meNHQG9janZMxtnaWPC4niyulskCov5sa)
        $key1 = 'RTy4$58/*tdr#t';	//default = RTy4$58/*tdr#t
        $key2 = 'ci@gen#$_sdf';		//default = ci@gen#$_sdf

        $key_md5 = md5($key1 . $pass . $key2);
        $key_md5 = md5($key2 . $key_md5 . $key1);
        $sub1 = substr($key_md5, 0, 7);
        $sub2 = substr($key_md5, 7, 10);
        $sub3 = substr($key_md5, 17, 12);
        $sub4 = substr($key_md5, 29, 3);
        return md5($sub3 . $sub1 . $sub4 . $sub2);
	}

    public function secure_pass($pass)
    {
		$key_encrypt = $this->encrypt_md5_salt($pass);
		$options = array('cost' => 11);
        return password_hash($key_encrypt, PASSWORD_BCRYPT, $options);
    }

	public function db_validate($username, $password)
	{
		//$key_encrypt = $this->encrypt_md5_salt($password);
		$this->db->where('username', $username);
		$this->db->where('fag_allow', 'allow');

		$query = $this->db->get($this->tb_member_login);
		// 		print_r($this->db->last_query());
		// die();

        if($query->num_rows() == 1)
        {
			if($row = $query->row())
			{

				// echo $this->secure_pass($password);
				//if (password_verify($key_encrypt, $row->password))
				if ($password==$row->password)
				{
					return $row;
				}
			}
        }

        // If the previous process did not validate
        // then return false.
        return array();
	}

    public function validate()
	{
        $username = $this->security->xss_clean($this->input->post('input_username'));
        $password = $this->security->xss_clean($this->input->post('input_password'));

		$row = $this->db_validate($username, $password);
        if(!empty($row)){
			$data = array(
					'user_id' => $row->user_id,
					'username' => $row->username,
					'fullname' => $row->fullname,
					'user_level' => $row->user_level,
					'login_validated' => TRUE,
					'encrypt_user_id'=>encrypt($row->user_id),
					);
			$this->session->set_userdata($data);
			return TRUE;
		}

		// If the previous process did not validate
        // then return false.
		return FALSE;
    }

}
?>
