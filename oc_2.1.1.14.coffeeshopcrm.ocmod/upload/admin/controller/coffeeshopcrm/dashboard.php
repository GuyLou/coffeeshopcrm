<?php
class ControllercoffeeshopcrmDashboard extends Controller {


	public function index() {
		$this->load->language('coffeeshopcrm/dashboard');
		
		$data['tstage'] = $this->language->get('tstage');
		$data['tpast_due_dates'] = $this->language->get('tpast_due_dates');
		$data['tcurrent_due_dates'] = $this->language->get('tcurrent_due_dates');
		$data['tfuture_due_dates'] = $this->language->get('tfuture_due_dates');
		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['tcr_type'] = $this->language->get('cr-') . $this->language->get($this->session->data['dash_cr_type']);
		
		
		
		$this->load->model('coffeeshopcrm/dashboard');
		
		$data['crs'] = array();
		$results = $this->model_coffeeshopcrm_dashboard->getcrsBycr_type($this->session->data['dash_cr_type']);
		
		$tmpdate = date('Y-m-d');
		foreach ($results as $result) {
			$data['crs'][] = array(
				'stage' => $result['stage'],
				'past_due_dates'          => number_format((int)$result['past_due_dates']),
				'current_due_dates'    => number_format((int)$result['current_due_dates']),
				'future_due_dates' => number_format((int)$result['future_due_dates']),
				'past_crs' => $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] .'&filter_cr_type='. $this->session->data['dash_cr_type'].'&filter_stage=' . $result['stage_id'] .'&filter_due_date_op=<&filter_due_date=' . date('Y-m-d') . '&filter_cr_status=1', 'SSL'),
				'current_crs' => $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] .'&filter_cr_type='. $this->session->data['dash_cr_type'].'&filter_stage=' . $result['stage_id'].'&filter_due_date_op=<%3D&filter_due_date=' .date('Y-m-d', strtotime("+7 day")) . '&filter_cr_status=1', 'SSL'),
				'future_crs' => $this->url->link('coffeeshopcrm/customerrelationships', 'token=' . $this->session->data['token'] .'&filter_cr_type='. $this->session->data['dash_cr_type'].'&filter_stage=' . $result['stage_id'] .'&filter_due_date_op=>&filter_due_date=' . date('Y-m-d', strtotime("+7 day")) . '&filter_cr_status=1', 'SSL')
			);
		
		}
		unset($tmpdate);
		
	$this->response->setOutput($this->load->view('coffeeshopcrm/dashboard.tpl', $data));	
		
	}
}
