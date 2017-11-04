<?php
class ModelCoffeeShopCrmDashboard extends Model {


	public function getCrsByCr_type($cr_type) {
	
	
		$sql =  "SELECT stage, stage_id, SUM(IF(due_period = 'past',cnt,0)) AS past_due_dates, SUM(IF(due_period = 'current',cnt,0)) AS current_due_dates, SUM(IF(due_period = 'future',cnt,0)) AS future_due_dates FROM ( SELECT cr.cr_type, IF(service_s.cr_stage_id IS NULL,IF(sales_s.cr_stage_id IS NULL,os.name,sales_s.cr_stage_desc),service_s.cr_stage_desc) AS stage, IF(service_s.cr_stage_id IS NULL, IF(sales_s.cr_stage_id IS NULL, os.order_status_id, sales_s.cr_stage_id), service_s.cr_stage_id) AS stage_id, IF(DATEDIFF(crh.due_date,NOW()) > 7,'future',IF(DATEDIFF(crh.due_date,NOW()) < 0,'past','current')) AS due_period, COUNT(cr.cr_id) AS cnt FROM " .DB_PREFIX . "customer_relationships cr INNER JOIN " . DB_PREFIX ."cr_history crh ON crh.cr_id = cr.cr_id  AND crh.current = 1 LEFT JOIN " . "cr_stages sales_s On sales_s.cr_stage_id = crh.cr_stage_id AND cr.cr_type = 'sale' AND (cr.order_id IS NULL OR cr.order_id = 0) LEFT JOIN " . "cr_stages service_s On service_s.cr_stage_id = crh.cr_stage_id AND cr.cr_type = 'service' LEFT JOIN `" . DB_PREFIX ."order` o ON o.order_id = cr.order_id LEFT JOIN " . DB_PREFIX ."order_status os ON os.order_status_id = o.order_status_id WHERE crh.cr_status = 1 AND (sales_s.locale = '" .$this->config->get('config_admin_language') . "' OR service_s.locale = '" .$this->config->get('config_admin_language') . "' OR os.language_id = '" .(int)$this->config->get('config_language_id') . "')";
		
		if ($cr_type == 'order') {
			$sql .= " AND cr.cr_type = 'sale' AND (cr.order_id IS NOT NULL AND cr.order_id > 0) ";
		} else {
			$sql .= " AND cr.cr_type = '".$cr_type ."' ";
			if ($cr_type == 'sale') {
				$sql .= " AND (cr.order_id IS NULL OR cr.order_id = 0) ";
			}
		}
		
		$sql .= " GROUP BY cr_type, stage, due_period ) AS stage_sum GROUP BY  stage";
		
		$query = $this->db->query($sql);

		return $query->rows;
	}
}