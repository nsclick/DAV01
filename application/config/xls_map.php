<?php

$config['xls_map'] = array(
	
	/* ===================== PANTALLA 1 ============================= */
	'pantalla1.xls' => array(
	
		//Cantidad de examenes procesados
		array(
			'screen' => 1,
			'sheet' => 0,
			'identifier' => 'P1S1C1',
			'type' => 'direct', //direct | range | directsmile | rangesmile
			'title' => 'A3',
			'field' => 'A4',
			'value' => 'A5',
			'smile' => NULL,
		),
	
		//Cantidad de examenes derivados
		array(
			'screen' => 1,
			'sheet' => 0,
			'identifier' => 'P1S1C2',
			'type' => 'direct', //direct | range | directsmile | rangesmile
			'title' => 'A8',
			'field' => 'A4',
			'value' => 'A10',
			'smile' => NULL,
		),
		
		//Cantidad de examenes recibidos en laboratorio
		array(
			'screen' => 1,
			'sheet' => 0,
			'identifier' => 'P1S1C3',
			'type' => 'direct', //direct | range | directsmile | rangesmile
			'title' => 'A13',
			'field' => 'A4',
			'value' => 'A15',
			'smile' => NULL,
		),
		
		// Costo examen -mes
		array(
			'screen' => 1,
			'sheet' => 0,
			'identifier' => 'P1S1C4',
			'type' => 'direct', //direct | range | directsmile | rangesmile
			'title' => 'A18',
			'field' => 'A4',
			'value' => 'A20',
			'smile' => NULL,
		),
		
		// Gasto en Reactivos
		array(
			'screen' => 1,
			'sheet' => 0,
			'identifier' => 'P1S1C5',
			'type' => 'direct', //direct | range | directsmile | rangesmile
			'title' => 'C6',
			'field' => 'A4',
			'value' => 'C8',
			'smile' => NULL
		),
		
		// ========================= FIN Secuencia 1 ===================================
		
		//Reactivos Centinela (Micriobiologia)
		array(
			'screen' => 1,
			'sheet' => 1,
			'identifier' => 'P1S2C13',
			'type' => 'range', //direct | range
			'title' => 'A29',
			'range' => 'A29:B32',
			'smile' => NULL,
		),

		//Reactivos Centinela (Micriobiologia)
		array(
			'screen' => 1,
			'sheet' => 2,
			'identifier' => 'P1S3C1',
			'type' => 'range', //direct | range | directsmile | rangesmile
			'title' => 'A3',
			'range' => 'A4:O9',
			'smile' => NULL
		),
		
	),
	
	/* ===================== FIN PANTALLA 1 ============================= */
	
	/* ===================== PANTALLA 2 ============================= */
	'pantalla2.xls' => array(
	
	),
	/* ===================== FIN PANTALLA 2 ============================= */

	/* ===================== PANTALLA 3 ============================= */
	'pantalla3.xls' => array(
	
	),
	/* ===================== FINPANTALLA 3 ============================= */


);