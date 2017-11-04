<?php
class ControllercoffeeshopcrmCustomerRelationships extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('coffeeshopcrm/customerrelationships');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('coffeeshopcrm/customerrelationships');
		

		$this->getList();
	}

	public function add() {
		$this->load->language('coffeeshopcrm/customerrelationships');
		$this->load->model('coffeeshopcrm/customerrelationships');
		
		
		if (isset($this->request->get['cr_type'])) { $this->document->setTitle($this->language->get('heading_title_' . $this->request->get['cr_type'])); }

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$cr = $this->model_coffeeshopcrm_customerrelationships->addeditCr($this->session->data['customer_id'], $this->user->getid(), $this->request->post); //$this->request->post

			$this->session->data['success'] = $this->language->get('text_success');

			$redir = '';
			if (!isset($this->request->get['redir'])) {
				$redir = 'customerrelationships';
			} else {
				$redir = $this->request->get['redir'];
			}
			
			$this->response->redirect($this->url->link('coffeeshopcrm/' .$redir, 'token=' . $this->session->data['token']  . '&cr=' .$cr, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('coffeeshopcrm/customerrelationships');
		$this->load->model('coffeeshopcrm/customerrelationships');
		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$cr = $this->model_coffeeshopcrm_customerrelationships->addeditCr($this->session->data['customer_id'], $this->user->getid(), $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			$gets = $this->session->data['gets'];
			$redir = 'customerrelationships';
			foreach ($gets as $getkey => $getvalue) {
				switch ($getkey) {
					case 'route':
					break;
					case 'route2':
					break;
					case 'cr':
					break;
					case 'redir':
						$redir = $this->session->data['gets']['redir'];
					break;
					case 'token':
					break;
					default:
						$url .=  '&' .$getkey .'=' .$getvalue;
				}
			}
			
			$this->response->redirect($this->url->link('coffeeshopcrm/' . $redir, 'token=' . $this->session->data['token'] .$url, 'SSL'));
		} else {
		
			$cr_info = $this->model_coffeeshopcrm_customerrelationships->GetCr($this->request->get['cr']);
			$this->session->data['customer_id'] = $cr_info['customer_id'];
		
		}

		$this->getForm();
	}

	protected function getList() {
	
		// table sorting
		
		if (isset($this->request->get['sort'])) {
			$filter_data['sort'] = $this->request->get['sort'];
			$data['sort'] = $filter_data['sort'];
			$sort = '&sort=' . $filter_data['sort'];
		} else {
			$filter_data['sort'] = 'cr_id';
			$data['sort'] = 'cr_id';
			$sort = '&sort=cr_id';
		}

		if (isset($this->request->get['ord'])) {
			$filter_data['ord'] = $this->request->get['ord'];
			$data['ord'] = $filter_data['ord'];
			$ord = '&ord=' . $filter_data['ord'];
		} else {
			$filter_data['ord'] = 'asc';
			$data['ord'] = $filter_data['ord'];
			$ord = '&ord=asc';
		}
		
		
		// paging

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$filter_data['limit_start']  = ($page - 1) * $this->config->get('config_limit_admin');
		$filter_data['limit_len']  = $this->config->get('config_limit_admin');
		$page_url = '&page=' .$page;

		
		// table filtering
		$filters = '';

		
		if (isset($this->request->get['cr_id'])) {
			$filter_data['cr_id'] = $this->request->get['cr_id'];
			$data['filter_cr_id'] = $filter_data['cr_id'];
			$filters .= '&cr_id=' .$filter_data['cr_id'];
		} else {
			$data['filter_cr_id'] = '';
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$filter_data['customer_id'] = $this->request->get['filter_customer_id'];
			$data['filter_customer_id'] = $filter_data['customer_id'];
			$filters .= '&filter_customer_id=' .$filter_data['customer_id'];
		} else {
			$data['filter_customer_id'] = '';
		}
		
		if (isset($this->request->get['filter_cr_status'])) {
			$filter_data['cr_status'] = $this->request->get['filter_cr_status'];
			$data['filter_cr_status'] = $filter_data['cr_status'];
			$filters .= '&filter_cr_status=' .$filter_data['cr_status'];
		} else {
			$data['filter_cr_status'] = '';
		}
		
		if (!empty($this->request->get['filter_order_id'])) {
			$filter_data['order_id'] = $this->request->get['filter_order_id'];
			$data['filter_order_id'] = $filter_data['order_id'];
			$filters .= '&filter_order_id=' .$filter_data['order_id'];
			
		} else {
			$data['filter_order_id'] = '';
		}
		
		if (isset($this->request->get['filter_cr_type'])) {
			$filter_data['cr_type'] = $this->request->get['filter_cr_type'];
			$data['filter_cr_type'] = $filter_data['cr_type'];
			$filters .= '&filter_cr_type=' .$filter_data['cr_type'];
			
		} else {
			$data['filter_cr_type'] = '';
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_data['creation_date'] = $this->request->get['filter_date_added'];
			$data['filter_date_added'] = $filter_data['creation_date'];
			$filters .= '&filter_date_added=' .$filter_data['creation_date'];
			
		} else {
			$data['filter_date_added'] = '';
		}

		if (isset($this->request->get['filter_date_added_op'])) {
			$filter_data['date_added_op'] = $this->request->get['filter_date_added_op'];
			$data['filter_date_added_op'] = $filter_data['date_added_op'];
			$filters .= '&filter_date_added_op=' .$filter_data['date_added_op'];
			
		} else {
			$data['filter_date_added_op'] = '';
		}

		
		if (isset($this->request->get['filter_due_date'])) {
			$filter_data['due_date'] = $this->request->get['filter_due_date'];
			$data['filter_due_date'] = $filter_data['due_date'];
			$filters .= '&filter_due_date=' .$filter_data['due_date'];
			
		} else {
			$data['filter_due_date'] = '';
		}

		if (isset($this->request->get['filter_due_date_op'])) {
			$filter_data['due_date_op'] = $this->request->get['filter_due_date_op'];
			$data['filter_due_date_op'] = $filter_data['due_date_op'];
			$filters .= '&filter_due_date_op=' .$filter_data['due_date_op'];
			
		} else {
			$data['filter_due_date_op'] = '';
		}

		if (isset($this->request->get['filter_stage'])) {
			$filter_data['stage'] = $this->request->get['filter_stage'];
			$data['filter_stage'] = $filter_data['stage'];
			$filters .= '&filter_stage=' .$filter_data['stage'];
			
		} else {
			$data['filter_stage'] = '';
		}

		$data['ops'] = array ('>','>=','=','<=','<');
		
		
		// the actual page
		
		if(isset($this->session->data['customer_id'])) {
		$data['insert_sale'] = $this->url->link('coffeeshopcrm/customerrelationships/add', 'token=' . $this->session->data['token'] .'&cr_type=sale&redir=customerrelationships/index' ,  'SSL');
		$data['insert_service'] = $this->url->link('coffeeshopcrm/customerrelationships/add', 'token=' . $this->session->data['token'] .'&cr_type=service&redir=customerrelationships/index' ,  'SSL');
		}
		
		$types = array('sale','service','order');
		
			foreach ($types as $type) {
				$results = $this->model_coffeeshopcrm_customerrelationships->GetStages($type);
				
					
				$data['stages'][$type] = array();
				foreach ($results as $result) {
					$data['stages'][$type][$result['id']] = $result['desc'];

				}
			}
			
		$data['cr_types'] = array();
		$data['cr_types'][] = array(
			'name' => 'sale',
			'desc' => $this->language->get('sale')
		);
		
		
		$data['cr_types'][] = array(
			'name' => 'service',
			'desc' => $this->language->get('service')
		);

		$data['cr_types'][] = array(
			'name' => 'order',
			'desc' => $this->language->get('order')
		);
			

		$data['cr_status'][] = array(
			'name' => '1',
			'desc' => $this->language->get('cr_status_1')
		);

		$data['cr_status'][] = array(
			'name' => '0',
			'desc' => $this->language->get('cr_status_0')
		);			
			

		$data['crs'] = array();
		$crdata = array();


	
		$crscnt = $this->model_coffeeshopcrm_customerrelationships->GetCrsCount($filter_data);
		$results = $this->model_coffeeshopcrm_customerrelationships->getCrs($filter_data);
		

	
		foreach ($results as $result) {
			$data['crs'][] = array(
				'cr_id'      => $result['cr_id'],
				'creation_date'    => date($this->language->get('date_format_short'), strtotime($result['creation_date'])),
				'order_id'        => $result['order_id'],
				'cr_status'        => $result['cr_status'],
				'due_date' => date('Y-m-d', strtotime($result['due_date'])),
				'description' => $result['description'],
				'cr_stage_desc'          =>  $result['cr_stage_desc'],
				'cr_type'          =>  $this->language->get($result['cr_type']),
				'edit'        => $this->url->link('coffeeshopcrm/customerrelationships/edit', 'token=' . $this->session->data['token'] . '&cr=' .$result['cr_id'] .'&redir=customerrelationships/index'  .$filters .$page_url .$sort .$ord, 'SSL'),
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_insert_sale'] = $this->language->get('button_insert_sale');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_insert_service'] = $this->language->get('button_insert_service');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_reset'] = $this->language->get('button_reset');
		
		// cr columns
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_missing'] = $this->language->get('text_missing');
		$data['column_cr_id'] = $this->language->get('column_cr_id');
		$data['column_cr_type'] = $this->language->get('column_cr_type');
		$data['column_creation_date'] = $this->language->get('column_creation_date');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_due_date'] = $this->language->get('column_cr_due_date');
		$data['column_description'] = $this->language->get('column_cr_description');
		$data['column_stage_desc'] = $this->language->get('column_stage_desc');
		$data['column_action'] = $this->language->get('column_action');
		
		// form titles
		$data['form_cr_id'] = $this->language->get('column_cr_id');
		$data['form_order_id'] = $this->language->get('column_order_id');
		$data['form_cr_type'] = $this->language->get('column_cr_type');
		$data['form_date_added'] = $this->language->get('column_creation_date');
		$data['form_due_date'] = $this->language->get('column_cr_due_date');
		$data['form_stage'] = $this->language->get('column_stage_desc');
		$data['form_cr_status'] = $this->language->get('form_cr_status');
		$data['form_customer_id'] = $this->language->get('form_customer_id');
		

		// form default values
		$data['ph_due_date'] = date('Y-m-d', time());
		$data['ph_date_added'] = date('Y-m-d', time());
		

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		
		$arrtemp = '';
		$sort_arr = array ('cr_id','cr_type','order_id','creation_date','cr_stage_desc','due_date');
		
		foreach ($sort_arr as $sarr) {
			if ($filter_data['sort'] == $sarr) {
				if ($filter_data['ord'] == 'asc') {
					$ord = '&ord=desc';
				} else {
					$ord = '&ord=asc';
				}
			} else {
				$ord = '&ord=asc';
			}
			$arrtemp = 'sort_' .$sarr;
			$data[$arrtemp] = $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] . '&sort=' .$sarr .$ord . $filters .$page_url, 'SSL');
		}
		
		unset($arrtemp);
		unset($desc);

		$data['form_action'] = $this->url->link('coffeeshopcrm/customerrelationships', '', 'SSL');
		$data['route'] = 'coffeeshopcrm/customerrelationships';
		$data['token'] = $this->session->data['token'];



		$pagination = new Pagination();
		$pagination->total = $crscnt;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] . $filters . $sort .$ord . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($crscnt) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($crscnt - $this->config->get('config_limit_admin'))) ? $crscnt : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $crscnt, ceil($crscnt / $this->config->get('config_limit_admin')));

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('coffeeshopcrm/cr_list.tpl', $data));
	}
	
	public function home() {

		$this->load->language('coffeeshopcrm/customerrelationships');

		if (!isset($this->session->data['cr_type']) and !isset($this->session->data['customer_id'])) {
			return "";
		} else {
		
		
		
		$this->load->model('coffeeshopcrm/home');
		$this->load->model('coffeeshopcrm/customerrelationships');

		$data['token'] = $this->session->data['token'];

		$crdata = array();
		
		$crdata['customer_id'] = $this->session->data['customer_id'];
		$crdata['cr_type'] = $this->session->data['cr_type'];
		if(isset($this->session->data['is_order'])) { $crdata['is_order'] = $this->session->data['is_order']; }
		if(isset($this->session->data['stage'])) { $crdata['stage'] = $this->session->data['stage']; }
		if(isset($this->session->data['cr_status'])) { $crdata['cr_status'] = $this->session->data['cr_status']; }
		if(isset($this->session->data['due_date'])) { $crdata['due_date'] = $this->session->data['due_date'];}
		if(isset($this->session->data['creation_date'])) { $crdata['creation_date'] = $this->session->data['creation_date']; }
		

		$data['add'] = $this->url->link('coffeeshopcrm/customerrelationships/add', 'token=' . $this->session->data['token'] .'&cr_type=' . $crdata['cr_type'] . '&redir=home', 'SSL');
		
		$data['heading_title'] = $this->language->get('heading_title_' . $crdata['cr_type']);
		
		$results = $this->model_coffeeshopcrm_customerrelationships->getCrs($crdata);

		if(isset($this->session->data['is_order'])) { unset($this->session->data['is_order']); }
		if(isset($this->session->data['stage'])) { unset($this->session->data['stage']); }
		if(isset($this->session->data['cr_status'])) { unset($this->session->data['cr_status']); }
		if(isset($this->session->data['due_date'])) { unset($this->session->data['due_date']); }
		if(isset($this->session->data['creation_date'])) { unset($this->session->data['creation_date']); }
		if(isset($this->session->data['cr_type'])) { unset($this->session->data['cr_type']); }

		$data['crs'] = array();
		
		
		foreach ($results as $result) {
			$data['crs'][] = array(
				'cr_id'      => $result['cr_id'],
				'creation_date'    => date($this->language->get('date_format_short'), strtotime($result['creation_date'])),
				'order_id'        => $result['order_id'],
				'cr_status'        => $result['cr_status'],
				'due_date' => date($this->language->get('date_format_short'), strtotime($result['due_date'])),
				'description' => $result['description'],
				'cr_stage_desc'          =>  $result['cr_stage_desc'],
				'edit'        => $this->url->link('coffeeshopcrm/customerrelationships/edit', 'token=' . $this->session->data['token'] . '&cr=' .$result['cr_id'] , 'SSL'),
			);
		}
		
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_missing'] = $this->language->get('text_missing');
		$data['column_cr_id'] = $this->language->get('column_' .$crdata['cr_type']  .'_id');
		$data['column_creation_date'] = $this->language->get('column_creation_date');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_due_date'] = $this->language->get('column_due_date');
		$data['column_description'] = $this->language->get('column_description');
		$data['column_stage_desc'] = $this->language->get('column_stage_desc');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_view'] = $this->language->get('button_view');

		$data['token'] = $this->session->data['token'];


		return $this->load->view('coffeeshopcrm/customerrelationships.tpl', $data);
		}
	}
	

	protected function getForm() {
	
		$data['customer_id'] = $this->session->data['customer_id'];
		$data['form_cr_type'] = $this->language->get('form_cr_type');
		$data['form_no_orders'] = $this->language->get('form_no_orders');
		$data['form_creation_date'] = $this->language->get('form_creation_date');
		$data['form_due_date'] = $this->language->get('form_due_date');
		$data['form_cr_stage'] = $this->language->get('form_cr_stage');
		$data['form_cr_status'] = $this->language->get('form_cr_status');
		$data['form_order_id'] = $this->language->get('form_order_id');
		$data['form_title'] = $this->language->get('form_title');
		

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_history'] = $this->language->get('tab_history');

		$data['token'] = $this->session->data['token'];

		if (!isset($this->request->get['redir'])) {
			$data['cancel'] = $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] , 'SSL');
		} else {
			$data['cancel'] = $this->url->link('coffeeshopcrm/' .$this->request->get['redir'] , 'token=' . $this->session->data['token'] , 'SSL');
		}

		
		$types = array();
		if (isset($this->request->get['cr'])) {
			$data['cr'] = $this->request->get['cr'];
			$cr_info = $this->model_coffeeshopcrm_customerrelationships->GetCr($data['cr']);
			
			$data['creation_date'] = date($this->language->get('date_format_short'), strtotime($cr_info['creation_date']));
			$data['due_date'] = date('Y-m-d', strtotime($cr_info['due_date']));
			$data['cr_type'] = $cr_info['cr_type'];
			$data['cr_status1'] = $cr_info['cr_status'];
			$data['form_title'] =  $this->language->get('edit') . ' ' . $this->language->get($data['cr_type']);
			$data['action'] = $this->url->link('coffeeshopcrm/customerrelationships/edit', 'token=' . $this->session->data['token'] . '&cr=' . $data['cr'] , 'SSL');
			$data['description']    = $cr_info['description'];
			$this->session->data['customer_id'] = $cr_info['customer_id'];
			
		
			if ($cr_info['cr_type'] == 'service') {
				$types[] = 'service';
				$data['stage_id'] = $cr_info['cr_stage_id'];
			} else {
				if (!isset($cr_info['order_id']) || ((int)$cr_info['order_id'] == 0)) {
					$types[] = 'sale';
					$dorders = 1;
				}
				$types[] = 'order';
				$data['stage_id'] = $cr_info['cr_stage_id'];
			}
			
			$data['order_id'] = $cr_info['order_id'];
			
			
		} else if(isset($this->request->get['cr_type'])) {
			$data['cr_type'] =$this->request->get['cr_type'];
			if ($data['cr_type'] == 'service') {
				$types[] = 'service';
				$dorders = 0;				
			} else {
				$types[] = 'sale';
				$dorders = 1;
				$types[] = 'order';
			}
			
			$data['cr_status1'] = '';
			$data['creation_date'] = date('Y-m-d', time()); 
			$data['due_date'] = date('Y-m-d', time()); 
			$data['action'] = $this->url->link('coffeeshopcrm/customerrelationships/add', 'token=' . $this->session->data['token'] , 'SSL');
			$data['description'] = '';
			$data['stage_id'] = 0;
			
		} else {
				$this->error['warning'] = $this->language->get('error_no_cr_type');
				$data['error_warning'] = $this->error['warning'];
				
				$this->response->redirect($data['cancel']);
				$data['stage_id'] = 0;
				
			}

			foreach ($types as $type) {
				$results = $this->model_coffeeshopcrm_customerrelationships->GetStages($type);
				
					
				$data['stages'][$type] = array();
				foreach ($results as $result) {
					$data['stages'][$type][$result['id']] = $result['desc'];

				}
			}
			
			$data['form_type'] = $this->language->get('form_' .$data['cr_type']);
			
		$data['cr_status'][] = array(
			'name' => '1',
			'desc' => $this->language->get('cr_status_1')
		);

		$data['cr_status'][] = array(
			'name' => '0',
			'desc' => $this->language->get('cr_status_0')
		);
			

			if (isset($dorders)) {
				$results =  $this->model_coffeeshopcrm_customerrelationships->GetOrdersIds($this->session->data['customer_id'], $dorders);
				foreach ($results as $result) {
					$data['dorders'][] = $result['order_id'];
				}
			}
			
		
			$this->document->setTitle($this->language->get('heading_title_' . $data['cr_type']));
			$data['heading_title'] = $this->language->get('heading_title_' . $data['cr_type']);


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		

		$this->load->model('coffeeshopcrm/customerrelationships');
		
		$this->session->data['gets'] = $this->request->get;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('coffeeshopcrm/cr_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'coffeeshopcrm/customerrelationships')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
/*
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 128)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['code']) < 3) || (utf8_strlen($this->request->post['code']) > 10)) {
			$this->error['code'] = $this->language->get('error_code');
		}

		$coupon_info = $this->model_marketing_coupon->getCouponByCode($this->request->post['code']);

		if ($coupon_info) {
			if (!isset($this->request->get['coupon_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			} elseif ($coupon_info['coupon_id'] != $this->request->get['coupon_id']) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}
*/
		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'marketing/coupon')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function history() {
		$this->load->language('coffeeshopcrm/customerrelationships');

		$this->load->model('coffeeshopcrm/customerrelationships');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['form_cr_type'] = $this->language->get('form_cr_type');
		$data['form_no_orders'] = $this->language->get('form_no_orders');
		$data['form_creation_date'] = $this->language->get('form_creation_date');
		$data['form_due_date'] = $this->language->get('form_due_date');
		$data['form_cr_stage'] = $this->language->get('form_cr_stage');
		$data['form_order_id'] = $this->language->get('form_order_id');
		$data['form_uname'] = $this->language->get('form_uname');
		


		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$data['crphistories'] = array();

		$results = $this->model_coffeeshopcrm_customerrelationships->GetCrPHistory($this->request->get['cr']);
		$temp = reset($results);
		$cr_type = $temp['cr_type'];
		$cr_type_desc = $this->language->get('form_'.$this->db->escape($temp['cr_type']));

		foreach ($results as $result) {
			$data['crphistories'][] = array(
				'cr_type'   => $cr_type,
				'cr_type_desc'   => $cr_type_desc,
				'cr_stage_id'   => $result['cr_stage_id'],
				'stage_desc'     => $result['stage_desc'],
				'description'     => $result['description'],
				'creation_date' => date($this->language->get('date_format_short'), strtotime($result['creation_date'])),
				'due_date' => ($result['due_date'] == '') ? $this->language->get('form_no_due_date') : date($this->language->get('date_format_short'), strtotime($result['due_date'])),
				'order_id'     => $result['order_id'],
				'uname'     => $result['uname']
			);
		}
		
		unset($temp);
		unset($cr_type);
		unset($cr_type_desc);
		
		$this->response->setOutput($this->load->view('coffeeshopcrm/cr_history.tpl', $data));
	}
}
