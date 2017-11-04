<?php
class ModelCoffeeShopCrmHome extends Model {

	public function getCustomerTotalOrders($customer_id) {
		$sql = "SELECT c.customer_id, CONCAT(c.firstname, ' ', c.lastname) AS customer_name, c.email, cgd.name AS customer_group, c.wishlist, c.status, COUNT(o.order_id) AS orders, SUM(op.quantity) AS products, SUM(o.total) AS `total` FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id)LEFT JOIN `" . DB_PREFIX . "customer` c ON (o.customer_id = c.customer_id) LEFT JOIN `" . DB_PREFIX . "customer_group_description` cgd ON (c.customer_group_id = cgd.customer_group_id) LEFT JOIN  ". DB_PREFIX . "order_status os ON o.order_status_id = os.order_status_id ";
		//c.wishlist for tests
		$sql .= " WHERE o.customer_id > 0 AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sql .= " AND o.order_status_id > '0'";
		$sql .= "AND o.customer_id = '" .(int)$customer_id . "'";
		$sql .= " GROUP BY o.order_status_id";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getCustomerInfo($customer_id) {
		$sql = "SELECT  c.customer_id, CONCAT(c.firstname, ' ', c.lastname) AS customer, c.email, c.telephone, c.date_added, cgd.name AS customer_group, c.status, c.wishlist, SUM(cr.points) AS points, SUM(ct.amount) AS credit FROM " . DB_PREFIX . "customer c LEFT JOIN `" . DB_PREFIX . "customer_group_description` cgd ON (c.customer_group_id = cgd.customer_group_id) LEFT JOIN " . DB_PREFIX . "customer_reward cr ON (cr.customer_id = c.customer_id) LEFT JOIN   `" . DB_PREFIX . "customer_transaction` ct ON (ct.customer_id = c.customer_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'" . " AND c.customer_id = '" . (int)$customer_id ."' GROUP BY customer_id";
		
		$query = $this->db->query($sql);

		return $query->rows;
		
	}
	
	public function getSumOrders($customer_id) {
		$sql = "SELECT o.customer_id, os.name AS order_status, COUNT(o.order_id) AS orders, SUM(op.quantity) AS products, SUM(o.total) AS `total` FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "order_product` op ON (o.order_id = op.order_id) LEFT JOIN " . DB_PREFIX . "order_status os ON o.order_status_id = os.order_status_id WHERE o.customer_id = '" .(int)$customer_id ."' AND o.order_status_id > '0' GROUP BY o.order_status_id ORDER BY o.order_status_id ASC";
		
		$query = $this->db->query($sql);

		return $query->rows;
		
	}
	
	public function getActivitiesCount($customer_id) {
		$query = $this->db->query("SELECT IFNULL(SUM(IF(ac_type = 'login',cnt,0)),0) AS logins, IFNULL(SUM(IF(ac_type = 'order_account',cnt,0)),0) AS orders, IFNULL(SUM(IF(ac_type = 'order_account',cnt,0)),0) AS updates FROM (SELECT IF(`key` IN ('login','order_account'),`key`,'account_update') AS ac_type, COUNT(activity_id) AS cnt FROM " . DB_PREFIX . "customer_activity ca WHERE date_added >= DATE_SUB(CURDATE(),INTERVAL 7 DAY)  AND customer_id = '". (int) $customer_id ."' AND `key` != 'register' GROUP BY ac_type) a");

		return $query->row;
	}
	
	public function getActivities($customer_id) {
		$query = $this->db->query("SELECT CONCAT('customer_', ca.key) AS `key`, ca.data, ca.date_added FROM `" . DB_PREFIX . "customer_activity` ca" ." WHERE customer_id = '". (int) $customer_id ."' ORDER BY ca.date_added DESC ") ;

		return $query->rows;
	}
	
	public function getTotalCustomerActivities($customer_id) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_activity` ca ";

		$sql .= " WHERE customer_id = '". (int) $customer_id ."'";
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getOrders($customer) {
		$sql = "SELECT o.order_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, (SELECT os.name FROM " . DB_PREFIX . "order_status os WHERE os.order_status_id = o.order_status_id AND os.language_id = '" . (int)$this->config->get('config_language_id') . "') AS status, o.shipping_code, o.total, o.currency_code, o.currency_value, o.date_added, o.date_modified, crh.due_date, crh.description, cr.cr_id FROM `" . DB_PREFIX . "order` o  LEFT JOIN " . DB_PREFIX . "customer_relationships cr On cr.order_id = o.order_id LEFT JOIN " . DB_PREFIX . "cr_history crh ON cr.cr_id = crh.cr_id ";

		$sql .= " WHERE o.customer_id = '". (int) $customer ."' ";
		$sql .= " AND (crh.current = 1 OR crh.current IS NULL)";
		$sql .= " ORDER BY o.date_modified DESC ";

		$query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function GetReturns($customer_id) {
		$sql = "SELECT return_id, order_id, product_id, product, model, quantity, opened, `comment`, date_added, rr.name AS reason, ra.name AS raction, rs.name AS rstatus FROM `" . DB_PREFIX . "return` r LEFT JOIN " . DB_PREFIX . "return_action ra ON ra.return_action_id = r.return_action_id LEFT JOIN " . DB_PREFIX . "return_reason rr ON rr.return_reason_id = r.return_reason_id LEFT JOIN " . DB_PREFIX . "return_status rs ON rs.return_status_id = r.return_status_id WHERE customer_id = '". (int) $customer_id ."' AND ra.language_id = '". (int)$this->config->get('config_language_id') ."' AND rr.language_id = '". (int)$this->config->get('config_language_id') ."' AND rs.language_id = '". (int)$this->config->get('config_language_id') ."'";
		$query = $this->db->query($sql);

		return $query->rows;	
	}
	
	
}