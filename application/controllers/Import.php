<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('crud_model');
	}
	
	
	public function index()
	{
		$this->load->view('import');
	}
	
	function import_excel_data(){
		
		$this->load->library('excel');
		if(isset($_FILES["file"]["name"])){
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet){
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++){
					$member_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$order_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$provider_id = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$o_date = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$refund_amount = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$time_input = strtotime($o_date);  
					$order_date = date('Y-m-d H:i:s', $time_input);

					
					if(!empty($member_id)){
						$data[] = array(
							'member_id'  => $member_id,
							'order_id'=> $order_id,
							'provider_id'=> $provider_id,
							'order_date'=> $order_date,
							'refund_amount'=> $refund_amount
							
						);
					}
				}
				
			}
			//print_r($data);exit();
			$this->crud_model->insert_excel($data);
			$this->session->set_flashdata("Success","Data Uploaded Successfully !");
			redirect(base_url() , 'refresh');
		} 
	}
}
