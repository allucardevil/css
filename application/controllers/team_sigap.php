<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team_sigap extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * privacy policy controller
	 *
	 * url : http://dom.kno.wms.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	function __construct()
	{
        parent::__construct();
		
    }
	 
	public function index()
	{
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('template/team_sigap');
		$this->load->view('template/footer');
    }
    
}

/* End of file outgoing.php */
/* Location: ./application/controllers/weighing/outgoing.php */