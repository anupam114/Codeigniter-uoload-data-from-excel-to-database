<?php
Class Refund_Model extends CI_Model{

	public function all_refund(){

		$query=$this->db->get("rck_order_refund");
	    return $query->result();
	}

	public function get_current_refund(){
		$refund_status= 0;
        $query = $this->db->get_where('rck_order_refund', array('refund_status' => $refund_status));
        return $query->result();

	}
}
