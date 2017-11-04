<?php
class ControllercoffeeshopcrmReturns extends Controller {
	public function index() {
		$this->load->language('coffeeshopcrm/returns');

		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['c_opened'] = $this->language->get('c_opened');
		$data['c_closed'] = $this->language->get('c_closed');
		$data['c_edit'] = $this->language->get('c_edit');
		
		$data['t_return_id'] = $this->language->get('t_return_id');
		$data['t_date_added'] = $this->language->get('t_date_added');
		$data['t_order_id'] = $this->language->get('t_order_id');
		$data['t_product_id'] = $this->language->get('t_product_id');
		$data['t_product'] = $this->language->get('t_product');
		$data['t_model'] = $this->language->get('t_model');
		$data['t_quantity'] = $this->language->get('t_quantity');
		$data['t_opened'] = $this->language->get('t_opened');
		$data['t_reason'] = $this->language->get('t_reason');
		$data['t_raction'] = $this->language->get('t_raction');
		$data['t_status'] = $this->language->get('t_status');
		$data['t_comment'] = $this->language->get('t_comment');
		$data['t_action'] = $this->language->get('t_action');


		$data['token'] = $this->session->data['token'];

		$data['returns'] = array();
	
		if (isset($this->request->get['customer'])) {
			$customer = $this->request->get['customer'];
		} else {
			$customer = 1;
			// needs redirection
		}

		$this->load->model('coffeeshopcrm/home');

		$results = $this->model_coffeeshopcrm_home->GetReturns($customer);
		
		$data['returns'] = array();
		$temp = array();
		foreach ($results as $result) {
				$data['returns'][] = array (
				'date_added'	=>	date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'return_id' => $result['return_id'],
				'order_id' => $result['order_id'],
				'product_id' => $result['product_id'],
				'product' => $result['product'],
				'model' => $result['model'],
				'opened' => $result['opened'],
				'comment' => $result['comment'],
				'quantity' => $result['quantity'],
				'reason' => $result['reason'],
				'raction' => $result['raction'],
				'rstatus' => $result['rstatus'],
				'edit'	=>	$this->url->link('sale/return/edit', 'token=' . $this->session->data['token'] . '&return_id=' . $result['return_id'], 'SSL')
				);

		}
		
		return $this->load->view('coffeeshopcrm/returns.tpl', $data);
	}
}
