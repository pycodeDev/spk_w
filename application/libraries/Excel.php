<?php
if (!defined('BASEPATH')) exit('No Direct Script Allowed');
require_once( APPPATH . 'third_party/PHPExcel/PHPExcel.php');

class Excel extends PHPExcel
{
	
	function __construct()
	{
		parent::__construct();
		require_once( APPPATH . 'third_party/PHPExcel/PHPExcel.php');
		require_once( APPPATH . 'third_party/PHPExcel/PHPExcel/IOFactory.php');
	}
}