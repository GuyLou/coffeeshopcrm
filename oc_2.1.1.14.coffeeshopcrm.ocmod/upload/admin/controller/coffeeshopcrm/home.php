<?php
class ControllercoffeeshopcrmHome extends Controller {

	public function index() {
		$this->load->language('coffeeshopcrm/home');
		$this->load->model('coffeeshopcrm/home');
		$customer = $this->session->data['customer_id'];

		$this->document->setTitle($this->language->get('heading_title'));

		// get customers summary
		$data['customers'] = array();
		$results= $this->model_coffeeshopcrm_home->getCustomerInfo($customer);
		$result = reset($results);

		$data['customers'] = array(
				'customer_id' => $result['customer_id'],
				'customer_name'    => $result['customer'],
				'customer_group' => $result['customer_group'],
				'telephone' => $result['telephone'],
				'email' => $result['email'],
				'points' => number_format((int)$result['points']),
				'credit' => number_format((int)$result['credit']),
				'date_added'  => date($this->language->get('datetime_format'), strtotime($result['date_added'])),
				'edit'        => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'], 'SSL'),
			);

		// customers summary language
		$data['cdetails_head'] = $this->language->get('cdetails_head');
		$data['cdetails_customer_id'] = $this->language->get('cdetails_customer_id');
		$data['cdetails_customer_name'] = $this->language->get('cdetails_customer_name');
		$data['cdetails_email'] = $this->language->get('cdetails_email');
		$data['cdetails_phone'] = $this->language->get('cdetails_phone');
		$data['cdetails_date_added'] = $this->language->get('cdetails_date_added');
		$data['cdetails_group'] = $this->language->get('cdetails_group');
		$data['cdetails_points'] = $this->language->get('cdetails_points');
		$data['cdetails_credits'] = $this->language->get('cdetails_credits');
		$data['cdetails_notes'] = $this->language->get('notes');
		$data['button_note'] = $this->language->get('button_note');
		
		// $wishlist = unserialize($result['wishlist']); //$customer
		$wishlist = json_decode($result['wishlist'],true); //$customer
		
		// get orders summary
		$results= $this->model_coffeeshopcrm_home->getSumOrders($customer);
		
		
		foreach ($results as $result) { 
			$data['ordertotals'][] = array (
				'order_status' => $result['order_status'],
				'orders'          => number_format((int)$result['orders']),
				'products'    => number_format((int)$result['products']),
				'totals' => number_format((int)$result['total']),
			);
		
		}
		
		$data['orders_summary']	=	$this->language->get('orders_summary');
		$data['orders_status']	=	$this->language->get('orders_status');
		$data['orders_number']	=	$this->language->get('orders_number');
		$data['orders_products']	=	$this->language->get('orders_products');
		$data['orders_value']	=	$this->language->get('orders_value');
		
		// get activities summary
		$results= $this->model_coffeeshopcrm_home->getActivitiesCount($customer);
		$data['activities_count'] = array_map('number_format',array_map('intval',$results)); 
		
		$data['activities_header']	=	$this->language->get('activities_header');
		$data['activities_logins']	=	$this->language->get('activities_logins');
		$data['activities_number']	=	$this->language->get('activities_number');
		$data['activities_updates']	=	$this->language->get('activities_updates');
		
		
		$data['leads_header']	=	$this->language->get('leads_header');
		$data['new']	=	$this->language->get('new');
		$data['follow-up']	=	$this->language->get('follow-up');
		$data['interested']	=	$this->language->get('interested');
		$data['services_header']	=	$this->language->get('services_header');
		
		$data['returns_header']	=	$this->language->get('returns_header');
		
		
		
		$data['heading_title'] = $this->language->get('heading_title');
		

		
		$data['button_edit'] = $this->language->get('button_edit');
		
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_ip'] = $this->language->get('column_ip');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_url'] = $this->language->get('column_url');
		$data['column_referer'] = $this->language->get('column_referer');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_customer'] = $this->language->get('entry_customer');

		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_filter'] = $this->language->get('button_filter');

		$data['token'] = $this->session->data['token'];

		$url = '';
		
		$this->session->data['cr_type'] = 'sale';
		$this->session->data['is_order'] = -1;
		$data['sales'] = $this->load->controller('coffeeshopcrm/customerrelationships/home');
		
		$this->session->data['cr_type'] = 'service';
		$data['services'] = $this->load->controller('coffeeshopcrm/customerrelationships/home');
		
		$data['activity'] = $this->load->controller('coffeeshopcrm/activity');
		$data['orders'] = $this->load->controller('coffeeshopcrm/orders');
		$data['returns'] = $this->load->controller('coffeeshopcrm/returns');
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');


		$this->response->setOutput($this->load->view('coffeeshopcrm/home.tpl', $data));
		
	}
	
	public function gohome() {
	
		if (isset($this->request->get['customer_id'])) {
			$this->session->data['customer_id'] = $this->request->get['customer_id'];
			$this->response->redirect($this->url->link('coffeeshopcrm/home', 'token=' . $this->session->data['token'] , 'SSL'));
		} else {
			$this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		

	
	}
	
	
	public function gocr() {
	
		if (isset($this->request->get['customer_id'])) {
			$this->session->data['customer_id'] = $this->request->get['customer_id'];
			$this->response->redirect($this->url->link('coffeeshopcrm/customerrelationships/add', 'token=' . $this->session->data['token'] , 'SSL'));
		} else {
			$this->response->redirect($this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] , 'SSL'));
		}
		

	
	}

	public function goaway() {
	
			$this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'] , 'SSL'));


	
	}
}
