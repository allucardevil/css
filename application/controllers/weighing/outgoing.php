<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outgoing extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * outgoing controller
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
		redirect('weighing/outgoing/data_today');
	}
	
	# data ---------------------
	
	public function data_today()
	{
		$date = mdate("%Y-%m-%d", time());
		
		# weighing list pagination
		$this->load->library('pagination');
		$config 				= array();
		$config['full_tag_open'] = '<div class="pagination pagination-centered"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['prev_link'] = '&lt; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['base_url'] 	= site_url() . '/weighing/outgoing/data_today/' . $date . '/';
		$config['per_page'] 	= 10; 
		$config["uri_segment"] 	= 5;
		$page 					= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$limit 					= $config["per_page"];
		$offset 				= $page;
		
		# call model
		$this->load->model('weighing');
		$data['total'] = $this->weighing->total_data_outgoing_today();
		$config['total_rows'] = $data['total'];
		
		$this->pagination->initialize($config);
		$data['list_today'] = $this->weighing->list_data_outgoing_today($limit, $offset);
		$data['link_today'] = $this->pagination->create_links();
		
		# user logged in
		$data['user'] = 'admin';
				
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/list_outgoing_today', $data);
		$this->load->view('template/footer');
	}
	
	public function add()
	{
		# dropdown for airline
		$this->load->model('airline');
		$stn = $this->config->item('stn_code');
		$data['query_airline'] = $this->airline->get_all_airline($stn);
		
		# dropdown for stn
		$this->load->model('station');
		$data['query_station'] = $this->station->get_all_station();
		
		# dropdown for agent
		$this->load->model('agent');
		$data['query_agent'] = $this->agent->get_all_agent();
		
		# dropdown for goods
		$this->load->model('goods');
		$data['query_goods'] = $this->goods->get_all_goods();
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/add_outgoing', $data);
		$this->load->view('template/footer');
	}
	
	public function save()
	{
		# prepare data from config
		$stn = $this->config->item('stn_code');
		
		# get user data
		$user = 'admin';
		
		# get value from form
		$airline 	= $this->input->post('airline');
		$agent 		= $this->input->post('agent');
		$from 		= $this->input->post('from');
		$to 		= $this->input->post('to');
		$final_dest = $this->input->post('final_dest');
		$date 		= mdate("%Y-%m-%d", strtotime($this->input->post('date')));
		
		# get wor no
		$this->load->model('weighing');
		$wor_type 	= '0'; # 1=incoming 0=outgoing
		$wo_no 		= $this->weighing->get_last_wor($wor_type);
		
		# call models
		$wor_id = $this->weighing->save_data_outgoing($date, $stn, $wo_no, $airline, $agent, $from, $to, $final_dest, $user);
		
		# inject data to weighing details
		$this->weighing->save_outgoing_details($stn, $wo_no, $user);
		
		# redirect to add_wight
		redirect('weighing/outgoing/add_weight/' . $wo_no . '/');
	}
	
	public function delete()
	{
		# get id form url
		$wo_no = $this->uri->segment(4,0);
		
		# if segment 0, aborted mission n redirect to list
		if($wo_no == 0){redirect('weighing/outgoing/data_today');}
		
		# call model
		$this->load->model('weighing');
		$this->weighing->delete_data_outgoing_by_id($wo_no);
		
		# redirect after delete
		redirect('weighing/outgoing/add_weight/' . $wo_no);
	}
	
	public function print_data()
	{
		# get id form url
		$wo_no = $this->uri->segment(4,0);
		
		# call model
		$this->load->model('weighing');
		$data['query_data'] = $this->weighing->get_outgoing_data_by_id($wo_no);
				
		# call view
		$this->load->view('weighing/outgoing_print', $data);
	}
	
	# data ---------------------
	
	
	# weight -------------------
	
	public function add_weight()
	{
		# prepare data
		$wo_no = $this->uri->segment(4, 0);
		$data['wo_no'] = $this->uri->segment(4, 0);
		
		# dropdown for goods
		$this->load->model('goods');
		$data['query_goods'] = $this->goods->get_all_goods();
		
		# call model
		$this->load->model('weighing');
		$data['query_data'] = $this->weighing->get_outgoing_data_by_id($wo_no);
		$data['query_weight'] = $this->weighing->get_outgoing_weight_by_id($wo_no);
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/add_outgoing_weight', $data);
		$this->load->view('template/footer');
	}
	
	public function save_weight()
	{
		# prepare data
		$stn = $this->config->item('stn_code');
		$user = 'admin';
		
		# get data from form
		$goods 		= $this->input->post('goods');
		$wo_no 		= $this->input->post('wo_no');
		$pcs 		= $this->input->post('pcs');
		$weight 	= $this->input->post('weight');
		$length 	= $this->input->post('length');
		$width 		= $this->input->post('width');
		$height 	= $this->input->post('height');
		$vol_weight = ($length*$width*$height) / 6000;
		
		# compare weight
		if( $vol_weight == 0)
		{
			$paid_weight = $weight;
		}
		elseif($weight > $vol_weight)
		{
			$paid_weight = $weight;
		}
		else
		{
			$paid_weight = $vol_weight;
		}
		
		# call model
		$this->load->model('weighing');
		$this->weighing->save_weight($stn, $wo_no, $goods, $pcs, $weight, $length, $width, $height, $vol_weight, $paid_weight, $user);
		
		# redirect to add weight
		redirect('weighing/outgoing/add_weight/' . $wo_no . '/');
		
	}
	
	public function delete_weight()
	{
		# get id form url
		$wo_no = $this->uri->segment(4,0);
		$wow_id = $this->uri->segment(5,0);
		
		# if segment 0, aborted mission n redirect to list
		if($wo_no == 0 ||$wow_id == 0){redirect('weighing/outgoing/data_today');}
		
		# call model
		$this->load->model('weighing');
		$this->weighing->delete_data_weight_by_id($wow_id);
		
		# redirect after delete
		redirect('weighing/outgoing/add_weight/' . $wo_no . '/');
	}
	
	# weight -------------------
	
	# details -------------------
	
	public function get_details()
	{
		# prepare data
		$wo_no = $this->uri->segment(4, 0);
		$data['wo_no'] = $this->uri->segment(4, 0);
		
		# call model
		$this->load->model('weighing');
		$data['query_data'] = $this->weighing->get_outgoing_data_by_id($wo_no);
		$data['query_details'] = $this->weighing->get_outgoing_details_by_id($wo_no);
		$data['query_weight'] = $this->weighing->get_outgoing_weight_by_id($wo_no);
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/outgoing_details', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_details()
	{
		# prepare data
		$wo_no = $this->uri->segment(4, 0);
		$data['wo_no'] = $this->uri->segment(4, 0);
		
		# call model
		$this->load->model('weighing');
		$data['query_details'] = $this->weighing->get_outgoing_details_by_id($wo_no);
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/edit_details', $data);
		$this->load->view('template/footer');
	}
	
	public function update_details()
	{
		# prepare data
		$user = 'admin';
		
		# get data from form
		$wo_no = $this->input->post('outgoing_no');
		$data = array(
					'wod_awb'	=> $this->input->post('awb'),
					'wod_shipper_name'	=> $this->input->post('shipper_name'),
					'wod_shipper_address'	=> $this->input->post('shipper_address'),
					'wod_shipper_phone'	=> $this->input->post('shipper_phone'),
					'wod_shipper_fax'	=> $this->input->post('shipper_fax'),
					'wod_shipper_email'	=> $this->input->post('shipper_email'),
					'wod_consignee_name'	=> $this->input->post('consignee_name'),
					'wod_consignee_address'	=> $this->input->post('consignee_address'),
					'wod_consignee_phone'	=> $this->input->post('consignee_phone'),
					'wod_consignee_fax'	=> $this->input->post('consignee_fax'),
					'wod_consignee_email'	=> $this->input->post('consignee_email'),
				);
		
		# compare weight
		
		
		# call model
		$this->load->model('weighing');
		$this->weighing->update_outgoing_details($data,$wo_no);
		
		# redirect to add weight
		redirect('weighing/outgoing/get_details/'.$wo_no.'/');
		
	}
	#-----------------------------------
	
	public function search()
	{
		$data['user'] = 'admin';
		
		# dropdown for airline
		$this->load->model('airline');
		$stn = $this->config->item('stn_code');
		$data['query_airline'] = $this->airline->get_all_airline($stn);
		
		# dropdown for stn
		$this->load->model('station');
		$data['query_station'] = $this->station->get_all_station();
		
		# dropdown for agent
		$this->load->model('agent');
		$data['query_agent'] = $this->agent->get_all_agent();
		
		# dropdown for commodity
		$this->load->model('commodity');
		$data['query_commodity'] = $this->commodity->get_all_commodity();
		
		# dropdown for goods
		$this->load->model('goods');
		$data['query_goods'] = $this->goods->get_all_goods();
		
		# call view search form
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/search_outgoing', $data);
		$this->load->view('template/footer');
	}
	
	public function do_search()
	{
		# get data from search form
		if ($this->input->post('btb_no') == '') { $btb_no = 'all'; }else{ $btb_no = $this->input->post('btb_no');}
		$type 		= $this->input->post('type');
		if($this->input->post('start_date')==''){ $start_date = mdate("%Y-%m-%d", time());}else{ $start_date = $this->input->post('start_date');}
		if($this->input->post('end_date')==''){ $end_date = mdate("%Y-%m-%d", time());}else{ $end_date = $this->input->post('end_date');}
		$from 		= $this->input->post('from');
		$to 		= $this->input->post('to');
		$final_dest 		= $this->input->post('final_dest');
		$airline 		= $this->input->post('airline');
		$agent 		= $this->input->post('agent');
		$commodity 		= $this->input->post('commodity');
		$goods 		= $this->input->post('goods');
		$payment 		= $this->input->post('payment');
		
		redirect('/weighing/outgoing/search_result/' . $btb_no . '/' . $type. '/' . $start_date . '/' . $end_date . '/' . $from. '/' . $to. '/' .$final_dest . '/' .$airline. '/' . $agent. '/' . $commodity. '/' . $goods. '/' . $payment. '/' );
	}
	
	public function search_result()
	{
		# user logged in
		$data['user'] = 'admin';
		
		# get data from uri segment
		$btb_no = $this->uri->segment(4, '');
		$type = $this->uri->segment(5, 'outgoing');
		$start_date = $this->uri->segment(6, time());
		$start_date = mdate("%Y-%m-%d", strtotime($start_date));
		$data['start_date'] = $start_date;
		$end_date = $this->uri->segment(7, time());
		$end_date = mdate("%Y-%m-%d", strtotime($end_date));
		$data['end_date'] = $end_date;
		$from = $this->uri->segment(8, '');
		$to = $this->uri->segment(9, '');
		$final_dest = $this->uri->segment(10, '');
		$airline = $this->uri->segment(11, '');
		$agent = $this->uri->segment(12, '');
		$commodity = $this->uri->segment(13, '');
		$goods = $this->uri->segment(14, '');
		$payment = $this->uri->segment(15, '');
		
		
		# weighing list pagination
		$this->load->library('pagination');
		$config 					= array();
		$config['full_tag_open'] 	= '<div class="pagination pagination-centered"><ul>';
		$config['full_tag_close'] 	= '</ul></div>';
		$config['prev_link'] 		= '&lt; Prev';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['next_link'] 		= 'Next &gt;';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a href="#">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['first_link'] 		= TRUE;
		$config['last_link'] 		= TRUE;
		$config['base_url'] 		= site_url() . '/weighing/outgoing/search_result/' . $btb_no . '/' . $type. '/' . $start_date . '/' . $end_date . '/' . $from. '/' . $to. '/' .$final_dest . '/' .$airline. '/' . $agent. '/' . $commodity. '/' . $goods. '/' . $payment. '/' ;
		$config['per_page'] 		= 10; 
		$config['uri_segment'] 		= 16;
		$config['use_page_numbers'] = FALSE;
		$page 						= ($this->uri->segment(16)) ? $this->uri->segment(16) : 0;
		$limit 						= $config["per_page"];
		$offset 					= $page;
		
		
		
		# call model
		$this->load->model('weighing');
		$total = $this->weighing->total_outgoing_search($btb_no, $type, $start_date, $end_date, $from, $to, $final_dest, $airline, $agent, $commodity, $goods, $payment);
		foreach($total as $row):$total_rows = $row->total;endforeach;
		$config['total_rows'] = $total_rows ;
		$data['total']= $total_rows;
		
		$this->pagination->initialize($config);
		$data['list_today'] = $this->weighing->list_outgoing_search($btb_no, $type, $start_date, $end_date, $from, $to, $final_dest, $airline, $agent, $commodity, $goods, $payment, $limit 	, $offset);
		$data['link_today'] = $this->pagination->create_links();
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/list_outgoing', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_awb()
	{
		$data['btb'] = $this->uri->segment(4);
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('outgoing/edit_awb', $data);
		$this->load->view('template/footer');
	}
	
	public function save_awb()
	{
		$btb_no = $this->input->post('btb_no');
		$awb_no = $this->input->post('awb_no');
		$this->load->model('weighing');
		$this->load->model('outgoing_model');
		
		#cek awb lama
		$awb_old = $this->weighing->get_awb_weighing_outgoing($btb_no); 
		foreach ($awb_old as $ao){}
		$this->outgoing_model->update_status_house_awb_by_awb_no($ao->wod_awb);
		
		$weight = $this->weighing->get_total_outgoing_weight( $btb_no );
		foreach ($weight as $rw){
			$data = array (
					'oha_awb_no' => $awb_no,
					'oha_status_parent' => 'parent',
					'oha_piece' => $rw->total_piece,
					'oha_weight' => $rw->total_actual_weight,
					'oha_status'  => 'active',
					'oha_update_by'  => 'admin',
				);
		}
		$data_awb=array('wod_awb' => $awb_no );
		$this->weighing->update_awb_weighing_outgoing($btb_no,$data_awb);
		
		$this->outgoing_model->insert_house_awb($data);
		redirect('outgoing/build_up');
	}
	
}

/* End of file outgoing.php */
/* Location: ./application/controllers/weighing/outgoing.php */