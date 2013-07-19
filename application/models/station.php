<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Station extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * airline model
	 *
	 * url : http://dom.kno.wms.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	 public function get_all_station()
	 {
		 $query = $this->db->get('var_station');
		 return $query->result();
	 }
     
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */