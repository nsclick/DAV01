<?php
if (!defined('BASEPATH'))
	exit ('No direct script access allowed');

class Upload extends CI_Controller {

	function __construct() {
		parent :: __construct();

		$this->load->helper(array (
			'form',
			'url'
		));

		//load our new PHPExcel library
		$this->load->library('excel');
	}

	public function index() {

		$this->load->view('upload');

	}

	function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xls';
		//$config['max_size'] = '100';
		//$config['max_width'] = '1024';
		//$config['max_height'] = '768';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$error = array (
				'error' => $this->upload->display_errors()
			);

			$this->load->view('upload', $error);
		} else {
			$data = array (
				'upload_data' => $this->upload->data()
			);

			$this->load->view('upload_success', $data);
		}
	}

	public function read($file_name) {

		$this->config->load('xls_map');
		
		$file_path = FCPATH . "uploads/$file_name";
		if (!is_readable($file_path)) {
			echo "The Excel file doesn't exists'" . PHP_EOL;
			return false;
		}

		$this->excel = PHPExcel_IOFactory :: load($file_path);
		$this->excel->setActiveSheetIndex(2);

		//get some value from a cell
		echo $number_value = $this->excel->getActiveSheet()->getCell('J31')->getValue();
		echo PHP_EOL;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */