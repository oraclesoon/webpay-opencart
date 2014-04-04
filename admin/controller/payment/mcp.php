<?php 
class ControllerPaymentmcp extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/mcp');
		$this->install();

		$this->document->setTitle = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('mcp', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_payment'] = $this->language->get('text_payment');
		$this->data['text_success'] = $this->language->get('text_success');
		$this->data['text_authorization'] = $this->language->get('text_authorization');
		$this->data['text_sale'] = $this->language->get('text_sale');
		$this->data['text_mcp'] = $this->language->get('text_mcp');
		$this->data['entry_profile_id'] = $this->language->get('entry_profile_id');
		$this->data['entry_profile_key'] = $this->language->get('entry_profile_key');
		$this->data['entry_test'] = $this->language->get('entry_test');
		$this->data['entry_transaction'] = $this->language->get('entry_transaction');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['error_permission'] = $this->language->get('error_permission');
		$this->data['error_merchantid'] = $this->language->get('error_merchantid');
		$this->data['error_merchantkey'] = $this->language->get('error_merchantkey');


		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_authorization'] = $this->language->get('text_authorization');
		$this->data['text_sale'] = $this->language->get('text_sale');
		
		$this->data['entry_profile_id'] = $this->language->get('entry_profile_id');
		$this->data['entry_profile_key'] = $this->language->get('entry_profile_key');
		$this->data['entry_test'] = $this->language->get('entry_test');
		$this->data['entry_transaction'] = $this->language->get('entry_transaction');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['profile_id'])) {
			$this->data['error_profile_id'] = $this->error['profile_id'];
		} else {
			$this->data['error_profile_id'] = '';
		}
		
 		if (isset($this->error['profile_key'])) {
			$this->data['error_profile_key'] = $this->error['profile_key'];
		} else {
			$this->data['error_profile_key'] = '';
		}
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/mcp&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];

		if (isset($this->request->post['mcp_profile_id'])) {
			$this->data['mcp_profile_id'] = $this->request->post['mcp_profile_id'];
		} else {
			$this->data['mcp_profile_id'] = $this->config->get('mcp_profile_id');
		}
		
		if (isset($this->request->post['mcp_profile_key'])) {
			$this->data['mcp_profile_key'] = $this->request->post['mcp_profile_key'];
		} else {
			$this->data['mcp_profile_key'] = $this->config->get('mcp_profile_key');
		}
		
		if (isset($this->request->post['mcp_test'])) {
			$this->data['mcp_test'] = $this->request->post['mcp_test'];
		} else {
			$this->data['mcp_test'] = $this->config->get('mcp_test');
		}
		
		if (isset($this->request->post['mcp_method'])) {
			$this->data['mcp_transaction'] = $this->request->post['mcp_transaction'];
		} else {
			$this->data['mcp_transaction'] = $this->config->get('mcp_transaction');
		}
		
		if (isset($this->request->post['mcp_order_status_id'])) {
			$this->data['mcp_order_status_id'] = $this->request->post['mcp_order_status_id'];
		} else {
			$this->data['mcp_order_status_id'] = $this->config->get('mcp_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['mcp_geo_zone_id'])) {
			$this->data['mcp_geo_zone_id'] = $this->request->post['mcp_geo_zone_id'];
		} else {
			$this->data['mcp_geo_zone_id'] = $this->config->get('mcp_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['mcp_status'])) {
			$this->data['mcp_status'] = $this->request->post['mcp_status'];
		} else {
			$this->data['mcp_status'] = $this->config->get('mcp_status');
		}
		
		if (isset($this->request->post['mcp_sort_order'])) {
			$this->data['mcp_sort_order'] = $this->request->post['mcp_sort_order'];
		} else {
			$this->data['mcp_sort_order'] = $this->config->get('mcp_sort_order');
		}
		
		//$this->id       = 'content';
		$this->template = 'payment/mcp.tpl';
		//$this->layout   = 'common/layout';
		
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
 		//$this->render();
	}

	public function install() {
		mysql_query("CREATE TABLE IF NOT EXISTS `mcp_data` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`merchant_id` varchar(1000) NOT NULL,
		`merchant_key` varchar(1000) NOT NULL,
		PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1") ;
	}


	private function validate() {
	
		if (!$this->user->hasPermission('modify', 'payment/mcp')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['mcp_profile_id']) {
			$this->error['profile_id'] = $this->language->get('error_profile_id');
		}

		if (!$this->request->post['mcp_profile_key']) {
			$this->error['profile_key'] = $this->language->get('error_profile_key');
		}
	
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>