<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Index.php ]
 */
class Index extends CI_Controller
{

	private $data;
	private $per_page;
	private $breadcrumb_data;
	private $left_sidebar_data;
	private $another_js;
	private $another_css;
	public $PAGE;


	public function __construct()
	{
		parent::__construct();
		chkMemberPerm();
		// echo('<pre>');
		// print_r($this->session->userdata());
		// echo('</pre>');
		// die();
		$this->load->library('cart');
		$this->load->model('product_model', 'product');

		$data['base_url'] = base_url();
		$data['site_url'] = site_url();

		$data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$data['csrf_cookie_name'] = $this->config->item('csrf_cookie_name');
		$data['csrf_protection_field'] = insert_csrf_field(true);

		$this->per_page = 12;
		$this->num_links = 6;
		$this->uri_segment = 3;

		$this->data = $data;
		$this->breadcrumb_data = $data;
		$this->left_sidebar_data = $data;
		$this->another_js .= '<script src="' . base_url('assets/js_modules/members/members.js?ft=' . filemtime('assets/js_modules/members/members.js')) . '"></script>';
		$this->another_js .= '<script src="' . base_url('assets/js/cart.js?ft=' . filemtime('assets/js/cart.js')) . '"></script>';

		// $js_url = 'assets/js_modules/members/members.js?ft=' . filemtime('assets/js_modules/members/members.js');
		// $js_url = 'assets/js/cart.js?ft=' . filemtime('assets/js/cart.js');
		// $this->another_js = '<script src="' . base_url($js_url) . '"></script>';
	}

	// ------------------------------------------------------------------------

	/**
	 * Render this controller page
	 * @param String path of controller
	 * @param Integer total record
	 */
	private function render_view($path)
	{
		$this->data['page_header'] = $this->parser->parse('template/frontend/headerView', $this->data, TRUE);
		$this->data['page_content'] = $this->parser->parse_repeat($path, $this->data, TRUE);
		$this->data['page_footer'] = $this->parser->parse('template/frontend/footerView', $this->data, TRUE);
		$this->data['another_css'] = $this->another_css;
		$this->data['another_js'] = $this->another_js;
		$this->parser->parse('template/frontend/indexView', $this->data);
	}
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

	public function index()
	{
		$this->load->model('common_model');
		$product = $this->db->query("select * from tb_products_types where fag_allow = 'allow'");
		$brand = $this->db->query("select * from tb_banners where fag_allow = 'allow'");
		$promotion = $this->db->query("select * from tb_promotions where fag_allow = 'allow'");
		$this->data['product_type'] = $product->result_array();
		$this->data['brand'] = $brand->result_array();
		$this->data['promotion'] = $promotion->result_array();
		$data['cart_value'] = $this->cart->contents();
		$this->data['cartItems'] = $data['cart_value'];

		$this->render_view('index');
	}
	public function member_index($encrypt_id = '')
	{
		$encrypt_id = urldecode($encrypt_id);
		$id = decrypt($encrypt_id);
		$this->load->model('common_model');
		$rows = rowArray($this->common_model->custom_query("select * from tb_members where member_id=" . $id));
		if ($rows['same'] == 1) {
			$this->data['record_same'] = 'checked';
		}elseif ($rows['same'] == 0){
			$this->data['record_same'] = '';
		}
		$this->data['record_member_fname'] = $rows['member_fname'];
		$this->data['record_member_lname'] = $rows['member_lname'];
		$this->data['record_member_shop'] = $rows['member_shop'];
		$this->data['record_member_email_addr'] = $rows['member_email_addr'];
		$this->data['record_member_addr'] = $rows['member_addr'];
		$this->data['record_member_same'] = $rows['member_same'];
		$this->data['record_member_note'] = $rows['member_note'];
		$this->render_view('member_index');
	}
	public function shops_page()
	{
		$start_row = $this->uri->segment($this->uri_segment, '0');
		if (!is_numeric($start_row)) {
			$start_row = 0;
		}
		$per_page = $this->per_page;
		$results_shops = $this->Frontend_shops->read($start_row, $per_page);
		$total_row = $results_shops['total_row'];
		$search_row = $results_shops['search_row'];
		$list_data_shops = $results_shops['list_data'];
		// $list_data_shops = $this->setDataListFormat($results_shops['list_data'], $start_row);


		$page_url = site_url('frontend_page');
		$pagination = $this->create_pagination($page_url . '/shops_page', $search_row);
		$end_row = $start_row + $per_page;
		if ($search_row < $per_page) {
			$end_row = $search_row;
		}

		if ($end_row > $search_row) {
			$end_row = $search_row;
		}

		$this->data['data_list_shops'] = $list_data_shops;
		$this->data['current_page_offset'] = $start_row;
		$this->data['start_row']	= $start_row + 1;
		$this->data['end_row']	= $end_row;
		$this->data['total_row']	= $total_row;
		$this->data['search_row']	= $search_row;
		$this->data['page_url']	= $page_url;
		$this->data['pagination_link']	= $pagination;
		$this->data['csrf_protection_field']	= insert_csrf_field(true);
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
		$this->render_view('shops_page');

		// $start_row = 0;
		// $results_news = $this->Frontend_news->read($start_row);
		// $list_data_news = $this->setDataListFormat($results_news['list_data'], $start_row);
		// $this->data['data_list_get_news'] = $list_data_news;
		// $this->data['data_news_list'] = $list_data_news;

		// $results_shops = $this->Frontend_shops->read($start_row);
		// $list_data_shops = $results_shops['list_data'];
		// $this->data['data_list_shops'] = $list_data_shops;

		// $this->render_view('shops_page');
		// die(print_r($this->data['data_list_shops']));
		// print_r($this->db->last_query());
		// die();
	}

	public function shop_detail_page($shop_id)
	{
		$start_row = 0;
		$results_shop = $this->Frontend_shops->detail_read($shop_id);
		$this->data['shop_id'] = $results_shop['shop_id'];
		$this->data['shop_cover'] = $results_shop['shop_cover'];
		$this->data['shop_name_th'] = $results_shop['shop_name_th'];
		$this->data['shop_name_en'] = $results_shop['shop_name_en'];
		$this->data['addr'] = $results_shop['addr'];
		$this->data['mobile_no'] = $results_shop['mobile_no'];
		$this->data['time_open'] = $results_shop['time_open'];
		$this->data['time_close'] = $results_shop['time_close'];

		$results_promotions = $this->Frontend_shops->promotions_read($shop_id);
		$this->data['data_list_promotions'] = $results_promotions['list_data'];

		$results_food = $this->Frontend_shops->food_read($shop_id);
		$this->data['data_list_menu'] = $results_food['list_data'];

		$this->load->model('common_model');
		$rows = $this->common_model->custom_query("select * from shop_images where shop_id=" . $shop_id . " and fag_allow!='delete' order by image_id ASC");
		$this->data['count_image'] = count($rows);
		$shops_images = "";
		foreach ($rows as $key => $value) {
			$shops_images =  $shops_images . '<div class="preview-image preview-show-' . ($key + 1) . '">' .
				'<div data-image_id="' . $value['image_id'] . '" class="image-cancel" data-no="' . ($key + 1) . '"></div>' . '<div class="image-zone"><img style="width:70%; height: 500px;" id="pro-img-' . ($key + 1) . '" src="' . base_url() . $value['encrypt_name'] . '"></div>' .
				'</div><br/><br/>';
		}
		$this->data['shops_images'] = $shops_images;
		$this->render_view('shops_detail_page');
	}


	private function setDataListFormat($lists_data, $start_row = 0)
	{
		$data = $lists_data;
		$count = count($lists_data);
		for ($i = 0; $i < $count; $i++) {
			$start_row++;
			$data[$i]['record_number'] = $start_row;
			$pk1 = $data[$i]['blog_id'];
			$data[$i]['url_encrypt_id'] = urlencode(encrypt($pk1));

			if ($pk1 != '') {
				$pk1 = encrypt($pk1);
			}
			$str = strlen($data[$i]['blog_name']);
			$blog_name_title = $data[$i]['blog_name'];

			if ($str > 100) {
				$blog_name_title = iconv_substr($data[$i]['blog_name'], 0, 30, "UTF-8") . "...";
				$data[$i]['blog_name_title'] = $blog_name_title;
			} else {
				$data[$i]['blog_name_title'] = $blog_name_title;
			}
		}
		return $data;
	}

	public function privacy_page()
	{
		$this->render_view('privacy_page');
	}
}
/*---------------------------- END Controller Class --------------------------------*/
