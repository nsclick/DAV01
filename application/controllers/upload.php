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

		
	}

	public function index() {

		$this->load->view('upload');

	}

	function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';
		$config['max_size'] = 0;
		$config['overwrite'] = true;

		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('graphs')) {
			$error = array (
				'error' => $this->upload->display_errors()
			);

			$this->load->view('upload', $error);
		} else {
			$data = array (
				'upload_data' => $this->upload->data()
			);
	
			$this->read($data['upload_data']['file_name']);
			
			$this->load->view('upload_success', $data);
		}
	}

	public function read($file_name) {

		$this->config->load('xls_map', true);
		$this->load->library('read');
		
		
		$xls_map = $this->config->item('xls_map');
		$xls_map = $xls_map['xls_map'];
		
		//Loads file maps
		$xls_map = $xls_map[$file_name];
		
		$file_path = FCPATH . "uploads/$file_name";
		if (!is_readable($file_path)) {
			echo "The Excel file doesn't exists'" . PHP_EOL;
			return false;
		}
		
		//Set the file
		$this->read->set_file($file_path);
		
		foreach($xls_map as $index => $g){
			
			switch($g['type']){
				case 'direct':
					$data = $this->read->direct($g['sheet'], $g['title'], $g['field'], $g['value'], $g['smile']);
					$g['title'] = $data['title'];
					$g['field'] = $data['field'];
					$g['value'] = $data['value'];
					$xls_map[$index] = $g;
					break;
				
				case 'range':
					$data = $this->read->range($g['sheet'], $g['title'], $g['range'], $g['smile']);
					$g['title'] = $data['title'];
					$g['range'] = $data['range'];
					$xls_map[$index] = $g;
					break;			
			}
		}
		
		
		//Inserts data onto DB
		$this->load->model('Read_model');
		$this->Read_model->insert_graphs($xls_map);
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */