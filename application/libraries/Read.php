<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Read { 
    public function __construct() { 
    	$this->CI =& get_instance();
    	
    	//load PHPExcel library
		$this->CI->load->library('excel');
    }
    
    function set_file($file){
    	$this->CI->excel = PHPExcel_IOFactory :: load($file);
    }
    
	private function get_cell($sheet, $cell){
		
		$this->CI->excel->setActiveSheetIndex($sheet);
		return $this->CI->excel->getActiveSheet()->getCell($cell)->getValue();
		
	}
	
	function direct($sheet, $title, $field, $value, $smile=NULL){
		
		$smile = $smile ? $this->get_cell($sheet, $smile) : NULL;
		
		$data = array(
			'title' => $this->get_cell($sheet, $title),
			'field' => $this->get_cell($sheet, $field),
			'value' => $this->get_cell($sheet, $value),
			'smile' => $smile
		);
		
		return $data;
	}
	
	function range($sheet, $title, $range, $smile=NULL){
		
		$title = $this->get_cell($sheet, $title);
		$smile = $smile ? $this->get_cell($sheet, $smile) : NULL;
		
		$this->CI->excel->setActiveSheetIndex($sheet);
		
		$matriz = $this->CI->excel->getActiveSheet()->rangeToArray($range);
		
		$range = $this->set_range_matriz($matriz);
		
		$data = array(
			'title' => $title,
			'range' => $range,
			'smile' => $smile
		);
		
		return $data;
	}
	
	private function set_range_matriz($matriz){
		
		//Get Titles
		$titles = array_shift($matriz);
		array_shift($titles);
		
		$data = array();
		foreach($titles as $index => $title){
			foreach($matriz as $line){
				$data[] = array(
					'field1' => str_replace("\n", '',trim($title)),
					'field2' => str_replace("\n", '',trim($line[0])),
					'value' => ($line[$index + 1]) ? $line[$index + 1] : 0
				);
			}
		}
		
		return $data;
	}
}