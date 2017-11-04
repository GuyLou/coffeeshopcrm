<?php
class ModelCoffeeShopCrmCustomerRelationships extends Model {
	public function addeditCr($customer_id, $user_id, $data) {
	
		if(isset($data['cr_id'])) {
		
		$cr = (int)$data['cr_id'];
		$this->db->query("UPDATE " .DB_PREFIX .  "cr_history  SET current = 0 WHERE cr_id = '" .(int) $cr ."'");
		
		if (isset($data['order_id'])) {
			$this->db->query("UPDATE " .  "customer_relationships  SET order_id = '" . (int) $data['cr_stage'] . "' WHERE order_id = '" .(int) $data['order_id'] ."'");
		}
		
		}
		else {
		$this->db->query("INSERT INTO " .  "customer_relationships (customer_id, cr_type, order_id) VALUES ('" .(int)$customer_id . "',"." '". $this->db->escape($data['cr_type']) ."','". (int) $data['order_id'] ."')");
		
		$cr = $this->db->getLastId();
		}
		
		if (isset($data['order_id_set'])) {
			$this->db->query("UPDATE `" . DB_PREFIX . "order`  SET order_status_id = '" . (int) $data['cr_stage'] . "', date_modified = NOW() WHERE order_id = '" .(int) $data['order_id_set'] ."'");
		}
		
		
		$this->db->query("INSERT INTO " . DB_PREFIX . "cr_history (cr_id, cr_status, due_date, cr_stage_id, description, current, user_id) VALUES ('". (int) $cr . "','". (int)$data['cr_status']."','".  $this->db->escape($data['due_date']) . "','" . (int)$data['cr_stage']."','".  $this->db->escape($data['description']) . "','1','". (int)$user_id. "')");
		
		return $cr;

	}
	
	public function GetCr($cr) {
	
	$sql = "SELECT ".  "cr.cr_id, cr.customer_id, cr.cr_type, cr.order_id,  crh.cr_history_id, crh.cr_status, crh.creation_date, crh.due_date, crh.cr_stage_id, crh.description FROM ". DB_PREFIX . "customer_relationships cr INNER JOIN " .DB_PREFIX . "cr_history crh ON cr.cr_id = crh.cr_id AND crh.current = 1 WHERE cr.cr_id = '" . (int)$cr ."'";
	$query =$this->db->query($sql);
	
	return $query->row;
	}
	
	public function GetCrPHistory($cr) {
	
	 $sql = "SELECT * FROM (";
	 
	 $sql .= "SELECT cr.cr_type, crh.cr_stage_id, IF(os.name IS NULL, crs.cr_stage_desc, os.name) AS stage_desc, order_id, description, crh.creation_date, crh.due_date, CONCAT(u.firstname,' ',u.lastname) AS uname FROM ". DB_PREFIX . "customer_relationships cr INNER JOIN ".DB_PREFIX .  "cr_history crh ON cr.cr_id = crh.cr_id AND cr.cr_id = '". (int)$cr ."' LEFT JOIN ". DB_PREFIX . "order_status os ON os.order_status_id = crh.cr_stage_id AND (cr.order_id > 0 AND cr.cr_type ='sale') LEFT JOIN ". DB_PREFIX . "cr_stages crs ON crs.cr_stage_id = crh.cr_stage_id AND ((cr.order_id = 0 AND cr.cr_type ='sale') OR (cr.cr_type ='service')) LEFT JOIN `" . DB_PREFIX ."user` u ON u.user_id = crh.user_id WHERE (os.language_id = '" .(int)$this->config->get('config_language_id') ."' OR os.language_id IS NULL) AND (crs.locale = '" .$this->config->get('config_admin_language') ."' OR crs.locale IS NULL)";
	 
	 $query = $this->db->query("SELECT IF(cr_type = 'sale' AND order_id > 0, 1,0) FROM ". DB_PREFIX . "customer_relationships cr WHERE cr_id = '". (int)$cr  . "'");
	 if ((int) reset($query) == 1)
	 {
	 
	$sql .= "UNION SELECT 'sale' AS cr_type, os.order_status_id AS stage_id, os.name, oh.order_id, `comment`, date_added AS creation_date,'' AS due_date, '' AS uname FROM ". DB_PREFIX . "order_history oh LEFT JOIN ". DB_PREFIX . "order_status os ON os.order_status_id = oh.order_status_id INNER JOIN ".  DB_PREFIX ."customer_relationships cr On cr.order_id = oh.order_id AND cr.cr_id = '". (int)$cr ."' WHERE (os.language_id = '" .(int)$this->config->get('config_language_id') ."')";
	}

	$sql .= ") AS history ORDER BY creation_date DESC";
	
	$query = $this->db->query($sql);
	
	return $query->rows;
	}
	
	public function GetCrsCount($data) {
		
		$sql = "SELECT COUNT(cr.cr_id) AS cnt FROM ". DB_PREFIX . "customer_relationships cr INNER JOIN " . DB_PREFIX ."cr_history crh ON cr.cr_id = crh.cr_id AND crh.current = 1 LEFT JOIN ". DB_PREFIX . "cr_stages crs ON crs.cr_stage_id = crh.cr_stage_id AND ((cr.order_id = 0 AND cr.cr_type ='sale') OR (cr.cr_type ='service')) LEFT JOIN " . DB_PREFIX . "order_status os ON os.order_status_id = crh.cr_stage_id AND (cr.order_id > 0 AND cr.cr_type ='sale')";
		
		
		$sql .= " WHERE ";
		
		$implode = array();
		
		// language
		$implode[] = " (os.language_id = '" .(int)$this->config->get('config_language_id') . "' OR os.language_id IS NULL) AND (crs.locale = '" .$this->config->get('config_admin_language') . "' OR crs.locale IS NULL) ";
		
		// customer_id
		if (!empty($data['customer_id'])) {
			$implode[] = " cr.customer_id ='" . (int)$data['customer_id'] . "'";
		}
		
		// cr_id
		if (!empty($data['cr_id'])) {
			$implode[] = " cr.cr_id ='" . (int)$data['cr_id'] . "'";
		}
		// order_id
		if (isset($data['order_id'])) {
			$implode[] = " cr.order_id ='" . (int)$data['order_id'] . "'";
		}		
		
		// cr_type
		if (!empty($data['cr_type'])) {
			if ($data['cr_type'] == 'order') {
				$implode[] = " cr.cr_type ='" . 'sale' . "' AND cr.order_id > 0 ";
			} else {
				$implode[] = " cr.cr_type ='" . $this->db->escape($data['cr_type']) . "'";
			}
		}
		
		// stage
		if (!empty($data['stage'])) {
			$implode[] = " crh.cr_stage_id = '" . $this->db->escape($data['stage']) . "'";
		}
		
		// cr_status
		if (isset($data['cr_status'])) {
			$implode[] = " crh.cr_status = '" . $this->db->escape($data['cr_status']) . "'";
		}

		// due date
		if (!empty($data['due_date'])) {
			if (empty($data['due_date_op'])) {
				$data['due_date_op'] = "=";
			}

			
			$implode[] = " DATE(crh.due_date)  ".  html_entity_decode($data['due_date_op'])." '" . $this->db->escape($data['due_date']) . "'";
		}

		// date added
		if (!empty($data['creation_date'])) {
			if (empty($data['date_added_op'])) {
				$data['date_added_op'] = "=";
			}

			
			$implode[] = " DATE(cr.creation_date)  ".  html_entity_decode($data['date_added_op'])." '" . $this->db->escape($data['creation_date']) . "'";
		}

		// is order linked either all (is_order isempty), none (is_order != 1) or order only (is_order = 1)
		if (!empty($data['is_order'])) {
			if ($data['is_order'] == '1') {
				$tmp = " >0) ";
			}
			else {
				$tmp = " IS NULL OR cr.order_id = 0) ";
			}
			$implode[] = "( cr.order_id " . $tmp ;
		}		

		
		$sql .=  implode(" AND ", $implode);
		
	$query = $this->db->query($sql);
	return $query->row['cnt'];			

	}
	
	public function GetCrs($data) {
	
		$sql = "SELECT cr.cr_id, cr.cr_type, cr.creation_date, cr.order_id, crh.cr_status, crh.due_date, crh.description, IF(os.name IS NULL, crs.cr_stage_desc, os.name) AS cr_stage_desc FROM ". DB_PREFIX . "customer_relationships cr INNER JOIN " .DB_PREFIX . "cr_history crh ON cr.cr_id = crh.cr_id AND crh.current = 1 LEFT JOIN ". DB_PREFIX . "cr_stages crs ON crs.cr_stage_id = crh.cr_stage_id AND ((cr.order_id = 0 AND cr.cr_type ='sale') OR (cr.cr_type ='service')) LEFT JOIN " . DB_PREFIX . "order_status os ON os.order_status_id = crh.cr_stage_id AND (cr.order_id > 0 AND cr.cr_type ='sale')";
		
		$sql .= " WHERE ";
		
		$implode = array();
		
		// language
		$implode[] = " (os.language_id = '" .(int)$this->config->get('config_language_id') . "' OR os.language_id IS NULL) AND (crs.locale = '" .$this->config->get('config_admin_language') . "' OR crs.locale IS NULL) ";
		
		// customer_id
		if (!empty($data['customer_id'])) {
			$implode[] = " cr.customer_id ='" . (int)$data['customer_id'] . "'";
		}
		
		// cr_id
		if (!empty($data['cr_id'])) {
			$implode[] = " cr.cr_id ='" . (int)$data['cr_id'] . "'";
		}
		// order_id
		if (isset($data['order_id'])) {
			$implode[] = " cr.order_id ='" . (int)$data['order_id'] . "'";
		}		
		
		// cr_type
		if (!empty($data['cr_type'])) {
			if ($data['cr_type'] == 'order') {
				$implode[] = " cr.cr_type ='" . 'sale' . "' AND cr.order_id > 0 ";
			} else {
				$implode[] = " cr.cr_type ='" . $this->db->escape($data['cr_type']) . "'";
			}
		}
		
		// stage
		if (!empty($data['stage'])) {
			$implode[] = " crh.cr_stage_id = '" . $this->db->escape($data['stage']) . "'";
		}
		
		// cr_status
		if (isset($data['cr_status'])) {
			$implode[] = " crh.cr_status = '" . $this->db->escape($data['cr_status']) . "'";
		}

		// due date
		if (!empty($data['due_date'])) {
			if (empty($data['due_date_op'])) {
				$data['due_date_op'] = "=";
			}

			
			$implode[] = " DATE(crh.due_date)  ".  html_entity_decode($data['due_date_op'])." '" . $this->db->escape($data['due_date']) . "'";
		}

		// date added
		if (!empty($data['creation_date'])) {
			if (empty($data['date_added_op'])) {
				$data['date_added_op'] = "=";
			}

			
			$implode[] = " DATE(cr.creation_date)  ".  html_entity_decode($data['date_added_op'])." '" . $this->db->escape($data['creation_date']) . "'";
		}

		// is order linked either all (is_order isempty), none (is_order != 1) or order only (is_order = 1)
		if (!empty($data['is_order'])) {
			if ($data['is_order'] == '1') {
				$tmp = " >0) ";
			}
			else {
				$tmp = " IS NULL OR cr.order_id = 0) ";
			}
			$implode[] = "( cr.order_id " . $tmp ;
		}		

		$sql .=  implode(" AND ", $implode);

		if (isset($data['sort'])) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY cr_id";
		}
		
		if (isset($data['ord'])) {
			$sql .= ' '.$data['ord'];
		}

		
		if (isset($data['limit_len'])) {
			if(!isset($data['limit_start'])) {
			$data['limit_start'] = 0;
			}
			$sql .= " LIMIT " . $data['limit_start'] .',' .$data['limit_len'] ;
		}
		

	$query = $this->db->query($sql);
	return $query->rows;	
	}
	
	public function GetTotalCrs($data) {
	
	
		// the elaborate - premium
		$sql = "SELECT ". $impld ." FROM ".  DB_PREFIX ."customer_relationships cr INNER JOIN " . DB_PREFIX ."cr_history crh ON cr.cr_id = crh.cr_id AND crh.current = 1 ";
		
		$implode = array();
		
		// customer_id
		if (!empty($data['customer_id'])) {
			$implode[] = " cr.customer_id '" . (int)$data['customer_id'] . "'";
		}
		
		
		// cr_type
		if (!empty($data['cr_type'])) {
			$implode[] = " cr.cr_type '" . $this->db->escape($data['cr_type']) . "'";
		}
		
		// stage
		if (!empty($data['stage'])) {
			$implode[] = " cr.stage '" . $this->db->escape($data['stage']) . "'";
		}
		
		// cr_status
		if (!empty($data['cr_status'])) {
			$implode[] = " cr.cr_status '" . $this->db->escape($data['cr_status']) . "'";
		}
		
		
		if ($implode) {
			$impld1 .= " WHERE " . implode(" AND ", $implode);
		}
		
		if ($implode) {
			$impld1 .= " WHERE " . implode(" AND ", $implode);
		}
			
		return $query->rows;
	
	}
	
	public function GetStages($cr_type) {
		
		if ($this->db->escape($cr_type) == 'order') {
			$sql = "SELECT os.order_status_id AS id, os.name AS `desc` FROM " .DB_PREFIX ."order_status os WHERE language_id = '" .(int)$this->config->get('config_language_id') ."'";
		} else {
			$sql = "SELECT cr_stage_id AS id, cr_stage_desc AS `desc` FROM ".  DB_PREFIX ."cr_stages WHERE cr_type = '" . $cr_type ."' AND locale ='". $this->config->get('config_admin_language')."'";
		}
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	
	public function GetCurrentStage($order_id) {
		$sql = "SELECT os.name FROM `" .DB_PREFIX ."order` o  INNER JOIN " .DB_PREFIX ."order_status os ON os.order_status_id = o.order_status_id WHERE o.order_id = '" . (int)$order_id ."' AND language_id = '" .(int)$this->config->get('config_language_id') ."'";
		$query = $this->db->query($sql);
		
		return $query->row;
	
	}
	
	public function GetOrdersIds($customer_id, $null) {

		$sql =  "SELECT o.order_id FROM `" .DB_PREFIX ."order` o LEFT JOIN " . DB_PREFIX . "customer_relationships cr ON cr.order_id = o.order_id WHERE o.customer_id = '". (int) $customer_id ."'";

		if((int) $null == 1) {
			$sql .= " AND cr.order_id IS NULL";
		}
		$sql .= " ORDER BY o.order_id DESC";
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	

	
}