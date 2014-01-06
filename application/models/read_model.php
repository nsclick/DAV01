<?php
class Read_model extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent :: __construct();
	}

	function insert_graph($identifier, $name, $type) {
		$data = array (
			'identifier' => $identifier,
			'name' => $name,
			'type' => $type,
			'date' => date('Y-m-d')
		);

		$this->db->insert('graph', $data);
		return $this->db->insert_id();
	}

	function insert_meta($graph_id, $field1, $field2, $value){
		$data = array (
			'graph_id' => $graph_id,
			'field1' => $field1,
			'field2' => $field2 ? $field2 : NULL,
			'value' => $value
		);

		$this->db->insert('metas', $data);
		return $this->db->insert_id();
		
	}
	
	function insert_graphs($data) {

		$this->db->trans_start();

		foreach ($data as $gr) {
			switch($gr['type']){
				
				case 'direct':
					$this->insert_direct($gr);
					break;
				
				case 'range':
					$this->insert_range($gr);
					break;
			}
		}

		$this->db->trans_complete();
	}

	function insert_range($data){
		$id = $this->insert_graph($data['identifier'], $data['title'], $data['type']);
		if($data['smile'])
			$this->insert_meta($id, 'smile', NULL, $data['smile']);
		
		foreach($data['range'] as $range){
			$this->insert_meta($id, $range['field1'], $range['field2'], $range['value']);
		}
	}
	
	function insert_direct($data) {
		
		$id = $this->insert_graph($data['identifier'], $data['title'], $data['type']);
		
		$this->insert_meta($id, $data['field'], NULL, $data['value']);
		
		if($data['smile'])
			$this->insert_meta($id, 'smile', NULL, $data['smile']);
		
	}
}