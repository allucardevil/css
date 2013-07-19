<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Build_up extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * build_up controller
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
		redirect('outgoing/build_up/add');
	}
	
	public function build_up_list()
	{
	
	}
	
	public function add()
	{
		# dropdown for stn
		$this->load->model('station');
		$data['query_station'] = $this->station->get_all_station();
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('outgoing/add_build_up', $data);
		$this->load->view('template/footer');
	}
	
	
	public function save_build_up()
	{
		# prepare data from config
		$stn = $this->config->item('stn_code');
		
		# get user data
		$user = 'admin';
		
		# get value from form
		$data = array(
			'obu_uld' => $this->input->post('uld'),
			'obu_flight_no' => $this->input->post('flight_no'),
			'obu_from' => $this->input->post('from'),
			'obu_to' => $this->input->post('to'),
			'obu_date' => mdate("%Y-%m-%d", strtotime($this->input->post('date'))),
			'obu_update_by' => $user,
		);
		
		# call models
		$this->load->model('outgoing_model');
		$this->outgoing_model->save_build_up($data);
		
		# redirect to add_awb
		redirect('outgoing/build_up/add_awb_build_up/' . $this->input->post('uld') . '/');

	}
	
	public function add_awb_build_up()
	{
		# prepare data
		$data['uld'] = $this->uri->segment(4, 0);
		
		# prepare model
		$this->load->model('outgoing_model');
		$data['build_up'] = $this->outgoing_model->get_build_up( $data['uld'] );
		$data['build_up_details'] = $this->outgoing_model->get_build_up_details( $data['uld'] );
		
		$i=0;
		foreach ($data['build_up_details'] as $bud){
			$i++;
			$parent='parent_house_awb_'.$i;
			$child='child_house_awb_'.$i;
			$data[$parent] = $this->outgoing_model->get_parent_house_awb( $bud->obud_awb );
			$data[$child] = $this->outgoing_model->get_child_house_awb( $bud->obud_awb );
		}
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('outgoing/add_awb_build_up', $data);
		$this->load->view('template/footer');
	}
	
	public function save_awb()
	{
		# prepare data
		$stn = $this->config->item('stn_code');
		$user = 'admin';
		
		# get data
		$uld = $this->input->post('uld');
		$data = array(
				'obud_uld'	=> $uld,
				'obud_awb'	=> $this->input->post('awb_no'),
				'obud_piece'=> $this->input->post('pcs'),
				'obud_weight'=> $this->input->post('weight'),
				'obud_status'=> 'active',
			);
		
		# prepare model
		$this->load->model('outgoing_model');
		
		$awb_parent = $this->outgoing_model->get_parent_house_awb( $this->input->post('awb_no') );
		$awb_child = $this->outgoing_model->get_total_child_house_awb( $this->input->post('awb_no') );
		foreach ($awb_parent as $row_parent){ //mengeluarkan nilai
			if($awb_child==NULL){
				redirect('outgoing/build_up/add_awb_build_up/' .$uld . '/');
			}
			else {
				foreach ($awb_child as $row_child){ //mengeluarkan nilai
					$selisih_piece = $row_parent->oha_piece - $row_child->total_oha_piece;
					$selisih_weight = $row_parent->oha_weight - $row_child->total_oha_weight;
					if(( $selisih_piece > $data['obud_piece']) AND ( $selisih_weight > $data['obud_weight']))
					{
						$this->load->model('outgoing_model');
						//update outgoing house_airwaybil
						/*
						if(($selisih_piece == $this->input->post('pcs')) AND ($selisih_weight == $this->input->post('weight')) ){
							$this->outgoing_model->update_awb();	
						} 
						if( $this->input->post('pcs') < $row_parent->oha_piece ){	
							$data_house_awb = array(
												'oha_status_parent' =>'child' ,
												'oha_piece' =>$this->input->post('pcs') ,
												'oha_weight' =>$this->input->post('weight') ,
												'oha_status' =>'active' ,
												'oha_update_by' =>$user,	
											);
						}
						*/
						$this->outgoing_model->insert_awb($data);
						
					}
				}
			}
		}
			
		# redirect to add_awb
		redirect('outgoing/build_up/add_awb_build_up/' .$uld . '/');
	}
	
	
	
    
}

/* End of file outgoing.php */
/* Location: ./application/controllers/weighing/outgoing.php */