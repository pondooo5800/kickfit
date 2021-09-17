<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Shop.php ]
 */
class Shop extends CI_Controller
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
        // Load cart library
		chkMemberPerm();
		$this->load->model("Shop_model");
    	$this->load->library("pagination");
		$this->load->library('cart');

		// Load product model
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

		$js_url = 'assets/js/cart.js?ft=' . filemtime('assets/js/cart.js');
		$this->another_js = '<script src="' . base_url($js_url) . '"></script>';
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
		$config = array();
        $config["base_url"] = base_url() . "shop/index";
        $config["total_rows"] = $this->Shop_model->record_count();
        $config["per_page"] = 24;
		$config["uri_segment"] = 3;

		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['first_link']       = false;
		$config['last_link']        = false;
		$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['attributes']       = ['class' => 'page-link'];
		$config['first_tag_open']   = '<li class="page-item">';
		$config['first_tag_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data['products'] = $this->Shop_model->
            fetch_product($config["per_page"], $page);
		$this->data['links'] = $this->pagination->create_links();

		$this->load->model('common_model');
		$product = $this->db->query("select * from tb_products_types where fag_allow = 'allow'");
		$brand = $this->db->query("select * from tb_banners where fag_allow = 'allow'");
		$promotion = $this->db->query("select * from tb_promotions where fag_allow = 'allow'");
		$this->data['product_type'] = $product->result_array();
		$this->data['brand'] = $brand->result_array();
		$this->data['promotion'] = $promotion->result_array();
		$this->render_view('shop');
	}
	public function category($product_type_id = NULL )
	{
		$this->load->model('common_model');
		$total_rows = rowArray($this->common_model->custom_query("select COUNT(*) as total_rows from tb_products where product_type = ".$product_type_id."	and fag_allow = 'allow'"));

		$config = array();
        $config["base_url"] = base_url() . "shop/category/".$product_type_id;
        $config["total_rows"] = $total_rows['total_rows'];

        $config["per_page"] = 24;
		$config["uri_segment"] = 3;

		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['first_link']       = false;
		$config['last_link']        = false;
		$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['attributes']       = ['class' => 'page-link'];
		$config['first_tag_open']   = '<li class="page-item">';
		$config['first_tag_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['products'] = $this->Shop_model->
			fetch_category($config["per_page"], $page ,$product_type_id);
		// print_r($page);
		// die();
		$this->data['links'] = $this->pagination->create_links();

		$product = rowArray($this->common_model->custom_query("select * from tb_products_types where fag_allow = 'allow' and product_type_id =". $product_type_id));
		$this->data['product_type_name'] = $product['product_type_name'];
		$this->data['product_type_id'] = $product['product_type_id'];
		$product = $this->db->query("select * from tb_products_types where fag_allow = 'allow'");
		$brand = $this->db->query("select * from tb_banners where fag_allow = 'allow'");
		$promotion = $this->db->query("select * from tb_promotions where fag_allow = 'allow'");
		$this->data['product_type'] = $product->result_array();
		$this->data['brand'] = $brand->result_array();
		$this->data['promotion'] = $promotion->result_array();

		$this->render_view('shop');
	}

	public function brand($banner_id = NULL )
	{
		$this->load->model('common_model');
		$total_rows = rowArray($this->common_model->custom_query("select COUNT(*) as total_rows from tb_banners where banner_id = ".$banner_id."	and fag_allow = 'allow'"));
		$config = array();
        $config["base_url"] = base_url() . "shop/brand/".$banner_id;
        $config["total_rows"] = $total_rows['total_rows'];
        $config["per_page"] = 24;
		$config["uri_segment"] = 3;
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['first_link']       = false;
		$config['last_link']        = false;
		$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['attributes']       = ['class' => 'page-link'];
		$config['first_tag_open']   = '<li class="page-item">';
		$config['first_tag_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['banners'] = $this->Shop_model->
		fetch_banner($config["per_page"], $page ,$banner_id);
				// print_r($this->db->last_query());
		// die();

		// print_r($page);
		// die();
		$this->data['links'] = $this->pagination->create_links();

		$banner = rowArray($this->common_model->custom_query("select * from tb_banners where fag_allow = 'allow' and banner_id =". $banner_id));
		$this->data['banner_name'] = $banner['banner_name'];
		$this->data['banner_id'] = $banner['banner_id'];

		$product = $this->db->query("select * from tb_products_types where fag_allow = 'allow'");
		$brand = $this->db->query("select * from tb_banners where fag_allow = 'allow'");
		$promotion = $this->db->query("select * from tb_promotions where fag_allow = 'allow'");
		$this->data['product_type'] = $product->result_array();
		$this->data['brand'] = $brand->result_array();
		$this->data['promotion'] = $promotion->result_array();

		$this->render_view('shop');
	}
	public function promotion($promotion_id = NULL )
	{
		$this->load->model('common_model');
		$total_rows = rowArray($this->common_model->custom_query("select COUNT(*) as total_rows from tb_promotions where promotion_id = ".$promotion_id."	and fag_allow = 'allow'"));
		$config = array();
        $config["base_url"] = base_url() . "shop/promotion/".$promotion_id;
        $config["total_rows"] = $total_rows['total_rows'];
        $config["per_page"] = 24;
		$config["uri_segment"] = 3;
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['first_link']       = false;
		$config['last_link']        = false;
		$config['full_tag_open']    = '<ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul>';
		$config['attributes']       = ['class' => 'page-link'];
		$config['first_tag_open']   = '<li class="page-item">';
		$config['first_tag_close']  = '</li>';
		$config['prev_tag_open']    = '<li class="page-item">';
		$config['prev_tag_close']   = '</li>';
		$config['next_tag_open']    = '<li class="page-item">';
		$config['next_tag_close']   = '</li>';
		$config['last_tag_open']    = '<li class="page-item">';
		$config['last_tag_close']   = '</li>';
		$config['cur_tag_open']     = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open']     = '<li class="page-item">';
		$config['num_tag_close']    = '</li>';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data['promotions'] = $this->Shop_model->
		fetch_promotion($config["per_page"], $page ,$promotion_id);
		// print_r($this->db->last_query());
		// die();

		// print_r($page);
		// die();
		$this->data['links'] = $this->pagination->create_links();

		$promotion = rowArray($this->common_model->custom_query("select * from tb_promotions where fag_allow = 'allow' and promotion_id =". $promotion_id));
		$this->data['promotion_name'] = $promotion['promotion_name'];
		$this->data['promotion_id'] = $promotion['promotion_id'];

		$product = $this->db->query("select * from tb_products_types where fag_allow = 'allow'");
		$brand = $this->db->query("select * from tb_banners where fag_allow = 'allow'");
		$promotion = $this->db->query("select * from tb_promotions where fag_allow = 'allow'");
		$this->data['product_type'] = $product->result_array();
		$this->data['brand'] = $brand->result_array();
		$this->data['promotion'] = $promotion->result_array();

		$this->render_view('shop');
	}
	public function addToCart(){
		$proID = $this->input->post('product_id');
        $product = $this->product->getRows($proID);
		$post = $this->input->post(NULL, TRUE);
		$data = array(
            'id'    => $product['product_id'],
            'qty'    => $post['qty'],
            'price'    => $product['price'],
            'name'    => $product['product_name'],
			'image' => $product['product_img1'],
        );
        $this->cart->insert($data);
		if ($post['segment'] === 'ajax') {
			$cart = array(
				'num_of_items' => $this->cart->total_items(),
				'total_price' => number_format($this->cart->total())
				);
				echo json_encode($cart);
		} elseif ($post['segment'] === 'index'){
			redirect('index');
		} elseif ($post['segment'] === 'category'){
			redirect('shop/category/' . $post['product_type']);
		} elseif ($post['segment'] === 'shop'){
			redirect('shop');
		}
	}
	public function search()
	{
		$this->load->model('common_model');
		$product = $this->db->query("select * from tb_products_types where fag_allow = 'allow'");
		$brand = $this->db->query("select * from tb_banners where fag_allow = 'allow'");
		$promotion = $this->db->query("select * from tb_promotions where fag_allow = 'allow'");
		$this->data['product_type'] = $product->result_array();
		$this->data['brand'] = $brand->result_array();
		$this->data['promotion'] = $promotion->result_array();

		$key = $this->input->post('search');
		$this->data['txt_search']	= $key;
		$this->data['products'] = $this->Shop_model->search($key);

		$this->render_view('shop');
  	}

}
/*---------------------------- END Controller Class --------------------------------*/
