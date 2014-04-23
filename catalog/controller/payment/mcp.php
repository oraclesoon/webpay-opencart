
application/x-httpd-php mcp.php 
PHP script text
<?php

class ControllerPaymentMCP extends Controller {

    protected function index() {

        $this->data['button_confirm'] = $this->language->get('button_confirm');

            $q = mysql_query('SELECT * FROM mcp_data') or die(mysql_error());

            $result = mysql_fetch_array($q);

            $dt = new DateTime;

            $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

            $amt_first = $this->currency->format($order_info['total'], $order_info['currency_value'], false);

            $amt = preg_replace("/[^a-zA-Z0-9\/_|+ .-]/", '', $amt_first);

            $ref = $dt->format('YmdHis');

            $cur = $this->currency->getCode();

            $mid = $result['merchant_id'];

            $linkBuf = $result['merchant_key']. "?mid=" . $mid ."&ref=" . $ref ."&cur=" .$cur ."&amt=" .$amt;

            $fgkey = md5($linkBuf);

            
        $this->data['cur'] = $cur; 

        $this->data['fgkey'] = $fgkey;

        $this->data['ref'] = $ref;

        $this->data['mid'] = $mid;

        $this->data['amt'] = $amt;

        $this->data['buyer'] = $order_info['payment_firstname'];

        $this->data['tel'] = $order_info['telephone'];

        $this->data['email'] = $order_info['email'];

        $products = $this->cart->getProducts();

        $prod = "";

        foreach ($products as $product) {
            $prod .= $product['name']."\r\n";
        }

        

        $this->data['product'] = $prod;



        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {

         $this->data['base'] = $this->config->get('config_ssl');

      } else {

         $this->data['base'] = $this->config->get('config_url');

      }

        $this->data['continue'] = $this->url->link('checkout/success');



        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/mcp.tpl')) {

            $this->template = $this->config->get('config_template') . '/template/payment/mcp.tpl';

        } else {

            $this->template = 'default/template/payment/mcp.tpl';

        }



        $this->render();

    }



    public function callback(){

        $this->load->model('checkout/order');

    }

}