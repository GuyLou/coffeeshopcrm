<?php
class ControllercoffeeshopcrmOrders extends Controller {
	public function index() {

		$this->load->language('sale/order');


		$this->load->model('coffeeshopcrm/home');



		$data['token'] = $this->session->data['token'];

		$data['activities'] = array();
	
		$customer = $this->session->data['customer_id'];
	
		$results = $this->model_coffeeshopcrm_home->getOrders($customer);

		foreach ($results as $result) {
			if(is_null($result['due_date'])) { 
				$tmp = '';
				$tmp2 = '';
			}
			else {
				$tmp = date($this->language->get('date_format_short'), strtotime($result['due_date']));
				$tmp2 = '&cr=' . $result['cr_id'];
			}
			$data['orders'][] = array(
				'order_id'      => $result['order_id'],
				'customer'      => $result['customer'],
				'status'        => $result['status'],
				'description' => $result['description'],
				'total'         => $this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'due_date' => $tmp,
				'shipping_code' => $result['shipping_code'],
				'view'          => $this->url->link('sale/order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] , 'SSL'),
				'edit'          => $this->url->link('sale/order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] , 'SSL'),
				'delete'        => $this->url->link('sale/order/delete', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] , 'SSL'),
				'addedit'        => ($tmp2 == '') ? $this->url->link('coffeeshopcrm/customerrelationships/add', 'token=' . $this->session->data['token'] . '&cr_type=sale' .'&order_id=' . $result['order_id'] , 'SSL') : $this->url->link('coffeeshopcrm/customerrelationships/edit', 'token=' . $this->session->data['token'] . $tmp2, 'SSL'),
				'cr_id'      => $result['cr_id']
			);
		}
		unset($tmp);
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_missing'] = $this->language->get('text_missing');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_status'] = $this->language->get('column_status');

		
		$data['column_total'] = $this->language->get('column_total');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_return_id'] = $this->language->get('entry_return_id');
		$data['entry_order_id'] = $this->language->get('entry_order_id');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_date_modified'] = $this->language->get('entry_date_modified');

		$data['button_invoice_print'] = $this->language->get('button_invoice_print');
		$data['button_shipping_print'] = $this->language->get('button_shipping_print');
		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_view'] = $this->language->get('button_view');

		$data['token'] = $this->session->data['token'];
		
		$this->load->language('coffeeshopcrm/cusomerrelationships');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_due_date'] = $this->language->get('column_due_date');
		$data['button_add'] = $this->language->get('button_add');

		return $this->load->view('coffeeshopcrm/orders.tpl', $data);
	}
}
