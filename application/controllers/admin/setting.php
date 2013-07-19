<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

	/**
	 */
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');	
	}
	
	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}
	
	function _example_output($output = null)
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('example',$output);
		$this->load->view('template/footer');	
	}
	
	
	public function airline()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('airline');
			$crud->set_subject('Airline');
			$crud->required_fields('airline_code');
			$crud->required_fields('airline_name');
			$crud->unset_columns('airline_stn', 'airline_update_on', 'airline_update_by');
			$crud->change_field_type('airline_stn','invisible');
			$crud->change_field_type('airline_update_on','invisible');
			$crud->change_field_type('airline_update_by','invisible');
			$crud->callback_before_insert(array($this, 'airline_default_field'));
			#$crud->columns('Code','Name');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function airline_default_field($post_array) 
	{
		$post_array['airline_stn'] = $this->config->item('stn_code');
		$post_array['airline_update_by'] = 'admin';
		return $post_array;
	}
	
	public function agent()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('agent');
			$crud->set_subject('Agent');
			$crud->unset_columns('agent_stn', 'agent_update_on', 'agent_update_by');
			$crud->change_field_type('agent_stn','invisible');
			$crud->change_field_type('agent_update_on','invisible');
			$crud->change_field_type('agent_update_by','invisible');
			$crud->required_fields('agent_name');
			$crud->callback_before_insert(array($this, 'agent_default_field'));
			
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function agent_default_field($post_array) 
	{
		$post_array['agent_stn'] = $this->config->item('stn_code');
		$post_array['agent_update_by'] = 'admin';
		return $post_array;
	}
	
	public function station()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('station');
			$crud->set_subject('Station');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function commodity()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('commodity');
			$crud->set_subject('commodity');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function goods()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('goods');
			$crud->set_subject('goods');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			$crud->set_relation('goods_commodity','commodity','commodity_code');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function payment()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('payment_type');
			$crud->set_subject('Payment Type');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	public function tax_invoice_number()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tax_invoice_number');
			$crud->set_subject('No Faktur Pajak');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			$crud->callback_after_insert(array($this, 'tin_calc'));
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function tin_calc($post_array) 
	{
		$post_array['wrr_stn'] = $this->config->item('stn_code');
		$post_array['wrr_update_by'] = 'admin';
		return $post_array;
	}
	
	public function warehouse_rental_rates()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('warehouse_rental_rates');
			$crud->set_subject('Harga Sewa Gudang');
			$crud->display_as('wrr_daily_rates','Sewa Gudang/Hari');
			$crud->display_as('wrr_administration','Biaya Administrasi');
			$crud->display_as('wrr_tax','Ppn (%)');
			$crud->display_as('wrr_min_day','Minimal Hari');
			$crud->display_as('wrr_min_charge','Minimal Charge');
			
			$crud->display_as('wrr_asperindo','Asperindo');
			$crud->display_as('wrr_update_on','Update');
			$crud->display_as('wrr_update_by','By');
			
			
			
			# hide on table
			$crud->unset_columns('wrr_stn');
			
			# hide on add form
			$crud->change_field_type('wrr_stn','invisible');
			$crud->change_field_type('wrr_update_on','invisible');
			$crud->change_field_type('wrr_update_by','invisible');
			
			# set manual value for stn and update_by
			$crud->callback_before_insert(array($this, 'wrr_default_field'));
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function wrr_default_field($post_array) 
	{
		$post_array['wrr_stn'] = $this->config->item('stn_code');
		$post_array['wrr_update_by'] = 'admin';
		return $post_array;
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin/setting.php */