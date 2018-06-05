<?php
/**
 *  Author: Mahadev
 *  
 *  Version: 1
 */
class View {
	private $data=array();
	/**
	 *  Set value from Controller to View page
	 */
	function assign($varname, $vardata){
		$this->data[$varname] = $vardata;
	}

	/**
	 *  Display view(html) page from Controller
	 */
	function display($filename){
    //extract the data that the controller got from the model
		extract($this->data);
    //include the file that presents the extracted data
		include($filename);
	}
}
