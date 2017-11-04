<?php

class ControllercoffeeshopcrmActivity extends Controller {
	public function index() {
		$this->load->language('coffeeshopcrm/activity');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['token'] = $this->session->data['token'];
		$data['activities'] = array();

		$customer = $this->session->data['customer_id'];
		$this->load->model('coffeeshopcrm/home');
		$results = $this->model_coffeeshopcrm_home->getActivities($customer);
	

		// generates the customer activity link
		$temp = current($results);

		// $temp2 = unserialize($temp['data']);
		$temp2 = json_decode($temp['data'], true);		

		$data['ca_link'] = $this->url->link('report/customer_activity', 'token=' . $this->session->data['token'] . '&filter_customer=' .urlencode($temp2['name']) , 'SSL');

		unset($temp);
		unset($temp2);


		foreach ($results as $result) {
			$comment = vsprintf($this->language->get('text_' . $result['key']), json_decode($result['data']));



			$find = array(
				'customer_id=',
				'order_id=',
				'return_id='
			);



			$replace = array(
				$this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=', 'SSL'),
				$this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=', 'SSL'),
				$this->url->link('sale/return/edit', 'token=' . $this->session->data['token'] . '&return_id=', 'SSL')
			);



			$data['activities'][] = array(

				'comment'    => str_replace($find, $replace, $comment),
				'date_added' => date($this->language->get('datetime_format'), strtotime($result['date_added']))
			);
		}



		return $this->load->view('coffeeshopcrm/activity.tpl', $data);
	}

}

