<?php
if (!defined('BASEPATH'))  exit('No direct script access allowed');

/**
 * [ Controller File name : Cart.php ]
 */
class Cart extends CI_Controller
{

  private $data;
  private $per_page;
  private $breadcrumb_data;
  private $left_sidebar_data;
  private $another_js;
  private $another_css;

  public function __construct()
  {
    parent::__construct();
    // chkMemberPerm();
    // Load cart library
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
    $this->controller = 'cart';
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
    $data['cart_value'] = $this->cart->contents();
    $this->data['cartItems'] = $data['cart_value'];
    $this->render_view('cart');
  }

  public function updateItemQty()
  {
    $update = 0;

    // Get cart item info
    $rowid = $this->input->get('rowid');
    $qty = $this->input->get('qty');

    // Update item in the cart
    if (!empty($rowid) && !empty($qty)) {
      $data = array(
        'rowid' => $rowid,
        'qty'   => $qty
      );
      $update = $this->cart->update($data);
    }

    // Return response
    echo $update ? 'ok' : 'err';
  }

  public function removeItem($rowid)
  {
    $remove = $this->cart->remove($rowid);
    redirect('cart');
  }
  public function checkout()
  {
    $custData = $data = array();
    // If order request is submitted
    $custData = array(
      'name'     => $this->session->userdata('member_fname') . ' ' . $this->session->userdata('member_lname'),
      'email'     => $this->session->userdata('member_email_addr'),
      'phone'     => $this->session->userdata('member_mobile_no'),
      'address' => $this->session->userdata('member_email_addr'),
      'member_id' => $this->session->userdata('member_id')
    );
    $insert = $this->product->insertCustomer($custData);

    if ($insert) {
      $order = $this->placeOrder($insert);
      if ($order) {
        $this->order_sendMail($order);
        redirect($this->controller . '/orderSuccess/' . $order);
      } else {
        $data['error_msg'] = 'Order submission failed, please try again.';
      }
    } else {
      $data['error_msg'] = 'Some problems occured, please try again.';
    }
    $this->render_view('cart');
  }
  public function placeOrder($custID)
  {
    // Insert order data
    $ordData = array(
      'customer_id' => $custID,
      'grand_total' => $this->cart->total(),
      'member_id' => $this->session->userdata('member_id')
    );
    $insertOrder = $this->product->insertOrder($ordData);

    if ($insertOrder) {
      // Retrieve cart data from the session
      $cartItems = $this->cart->contents();

      // Cart items
      $ordItemData = array();
      $i = 0;
      foreach ($cartItems as $item) {
        $ordItemData[$i]['order_id']     = $insertOrder;
        $ordItemData[$i]['product_id']     = $item['id'];
        $ordItemData[$i]['quantity']     = $item['qty'];
        $ordItemData[$i]['sub_total']     = $item["subtotal"];
        $i++;
      }

      if (!empty($ordItemData)) {
        // Insert order items
        $insertOrderItems = $this->product->insertOrderItems($ordItemData);

        if ($insertOrderItems) {
          // Remove items from the cart
          $this->cart->destroy();

          // Return order ID
          return $insertOrder;
        }
      }
    }
    return false;
  }
  public function orderSuccess($ordID)
  {
    $data['order_value'] = $this->product->getOrder($ordID);
    $this->data['order'] = $data['order_value'];
    $this->render_view('order-succes');
  }
  public function orderPDF($ordID)
  {
    $mpdf = new \Mpdf\Mpdf([
      'default_font_size' => 9,
      'default_font' => 'sarabun'
    ]);
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];

    $mpdf = new \Mpdf\Mpdf([
      'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
      ]),
      'fontdata' => $fontData + [
        'sarabun' => [
          'R' => 'THSarabunNew.ttf',
          'I' => 'THSarabunNew Italic.ttf',
          'B' => 'THSarabunNew Bold.ttf',
          'BI' => 'THSarabunNew BoldItalic.ttf',
        ]
      ],

      'default_font' => 'sarabun'
    ]);
    $order['order'] = $this->product->getOrder_PDF($ordID);
    $order['order_product'] = $this->product->getOrderProduct_PDF($ordID);
    $html = $this->load->view('order_pdfView', array(
      'order'  =>  $order['order'],
      'order_product'  =>  $order['order_product']
    ), true);
    $mpdf->WriteHTML($html);
    $mpdf->AddPage();
    $html_img = $this->load->view('order_img_pdfView', [], true);
    $mpdf->WriteHTML($html_img);
    $file_name = 'ใบสั่งซื้อสินค้า.pdf';
    $mpdf->Output($file_name, 'I');
  }
  public function order_sendMail($ordID)
  {
    $post = $this->input->post(NULL, TRUE);
    if ($post['member_email_order'] != '') {
      $to = $post['member_email_order'];
      $mpdf = new \Mpdf\Mpdf([
        'default_font_size' => 9,
        'default_font' => 'sarabun'
      ]);
      $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
      $fontDirs = $defaultConfig['fontDir'];

      $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
      $fontData = $defaultFontConfig['fontdata'];

      $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
          __DIR__ . '/tmp',
        ]),
        'fontdata' => $fontData + [
          'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf',
          ]
        ],

        'default_font' => 'sarabun'
      ]);
      $order['order'] = $this->product->getOrder_PDF($ordID);
      $order['order_product'] = $this->product->getOrderProduct_PDF($ordID);
      $html = $this->load->view('order_pdfView', array(
        'order'  =>  $order['order'],
        'order_product'  =>  $order['order_product']
      ), true);
      $mpdf->WriteHTML(($html));
      $mpdf->AddPage();
      $html_img = $this->load->view('order_img_pdfView', [], true);
      $mpdf->WriteHTML($html_img);
      $content = $mpdf->Output('', 'S');
      $filename = "order.pdf";
      $fromMail = "admin@yeejub.net";
      $fromName = "YeeJub | Order";
      $mailTo = $to;

      $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");
      $this->email->from($fromMail, $fromName);
      $this->email->to($mailTo);
          $this->email->subject("#คำสั่งซื้อหมายเลข  ".$ordID);
      $this->email->attach($content, 'attachment', $filename, 'application/pdf');
      if($this->email->send()){
        $this->session->set_flashdata('message', 'ใบสั่งซื้อสินค้าของคุณถูกส่งไปยัง Email เรียบร้อยแล้ว โปรดตรวจสอบ');
        redirect($this->controller . '/orderSuccess/' . $ordID);
      }else{
        $this->session->set_flashdata('message', 'ส่ง Email ไม่สำเร็จ');
        redirect($this->controller . '/orderSuccess/' . $ordID);
      }
    } else {
      $mpdf = new \Mpdf\Mpdf([
        'default_font_size' => 9,
        'default_font' => 'sarabun'
      ]);
      $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
      $fontDirs = $defaultConfig['fontDir'];

      $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
      $fontData = $defaultFontConfig['fontdata'];

      $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
          __DIR__ . '/tmp',
        ]),
        'fontdata' => $fontData + [
          'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf',
          ]
        ],

        'default_font' => 'sarabun'
      ]);
      $order['order'] = $this->product->getOrder_PDF($ordID);
      $order['order_product'] = $this->product->getOrderProduct_PDF($ordID);
      $html = $this->load->view('order_pdfView', array(
        'order'  =>  $order['order'],
        'order_product'  =>  $order['order_product']
      ), true);
      $mpdf->WriteHTML(($html));
      $mpdf->AddPage();
      $html_img = $this->load->view('order_img_pdfView', [], true);
      $mpdf->WriteHTML($html_img);
      $content = $mpdf->Output('', 'S');
      $filename = "order.pdf";
      $fromMail = "admin@yeejub.net";
      $fromName = "YeeJub | Order";
      $mailTo = "pondooo5800@gmail.com";

      $this->load->library('email');
      $this->email->set_mailtype("html");
      $this->email->set_newline("\r\n");
      $this->email->from($fromMail, $fromName);
      $this->email->to($mailTo);
      $this->email->subject("#คำสั่งซื้อหมายเลข  ".$ordID);
      $this->email->attach($content, 'attachment', $filename, 'application/pdf');
      $this->email->send();
    }
  }

}
/*---------------------------- END Controller Class --------------------------------*/
