<?php
class ControllercoffeeshopcrmRibbon extends Controller {
	public function index() {
		
		if($this->user->IsLogged()) {
		
		$this->load->language('coffeeshopcrm/ribbon');
		$data['buttons'] = array();
		$button = array();
		

		// search
		$button['name'] = $this->language->get('btn_search');
		$button['link'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'], 'SSL');
		$button['icon'] = 'fa fa-group';
		$data['buttons'][] = $button;
		
		// Home
		if (isset($this->session->data['customer_id'])) {
		$button['name'] = $this->language->get('btn_home');
		$button['link'] = $this->url->link('coffeeshopcrm/home', 'token=' . $this->session->data['token'], 'SSL');
		$button['icon'] = 'fa fa-user';
		$data['buttons'][] = $button;
		}

		// search
		$button['name'] = $this->language->get('btn_cr');
		$button['link'] = $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'], 'SSL');
		$button['icon'] = 'fa fa-coffee';
		$data['buttons'][] = $button;

		$this->response->setOutput($this->load->view('coffeeshopcrm/ribbon.tpl', $data));
		
	} else $this->response->setOutput('');
	}
}
