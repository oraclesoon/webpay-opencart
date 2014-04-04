<?php 
class ModelPaymentMCP extends Model {
  	public function getMethod($address, $total) { 
		$this->load->language('payment/mcp');
		
		
		$method_data = array();
	

      		$method_data = array( 
        		'code'       => 'mcp',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('mcp_sort_order')
      		);
    	return $method_data;
  	}
}
?>
