<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Refund_Model', 'refund');
		$this->load->helper('url');
	}

	public function index(){
		$data['refund']=$this->refund->all_refund();
		$this->load->view('refund',$data);
	}

	public function wallet(){
		$data['current_refund']=$this->refund->get_current_refund();
		//print_r($current_refund);exit();
		$this->load->view('wallet', $data);
	}
}
