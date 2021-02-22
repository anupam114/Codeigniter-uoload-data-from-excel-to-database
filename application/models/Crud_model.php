<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Crud_model extends CI_Model {
		
		public function __construct()
		{
			parent::__construct();
		}

		function insert_excel($data){
			$this->db->insert_batch('rck_order_refund', $data);
		}
	}
?>