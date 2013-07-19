<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class 	Incoming extends CI_Controller {

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
		redirect('incoming/add');
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
		$this->load->view('weighing/add_incoming', $data);
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
		$wir_type 	= '0'; # 1=incoming 0=outgoing
		$wi_no 		= $this->weighing->get_last_wir($wir_type);
		
		# call models
		$wir_id = $this->weighing->save_incoming($date, $stn, $wi_no, $airline, $agent, $from, $to, $final_dest, $user);
		
		# redirect to add_wight
		redirect('weighing/incoming/add_weight/' . $wi_no . '/');
	}
	
	
	public function add_weight()
	{
		# prepare data
		$wi_no = $this->uri->segment(4, 0);
		$data['wo_no'] = $this->uri->segment(4, 0);
		
		# dropdown for goods
		$this->load->model('goods');
		$data['query_goods'] = $this->goods->get_all_goods();
		
		# call model
		$this->load->model('weighing');
		$data['query_data'] = $this->weighing->get_weighing_incoming_data_by_id($wi_no);
		$data['query_weight'] = $this->weighing->get_weighing_incoming_weight_by_id($wi_no);
		
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/add_incoming_weight', $data);
		$this->load->view('template/footer');
	}
	
	public function save_weight()
	{
		# prepare data
		$stn = $this->config->item('stn_code');
		$user = 'admin';
		
		# get data from form
		$goods 		= $this->input->post('goods');
		$wi_no 		= $this->input->post('wi_no');
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
		$this->weighing->save_weight($stn, $wi_no, $goods, $pcs, $weight, $length, $width, $height, $vol_weight, $paid_weight, $user);
		
		# redirect to add weight
		redirect('weighing/incoming/add_weight/' . $wi_no . '/');
		
	}
	
	public function dell_weight()
	{
		
	}
	
	public function weighing_list_today()
	{
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
		$config['base_url'] 	= site_url() . '/weighing/incoming/weighing_list_today/';
		$config['per_page'] 	= 10; 
		$config["uri_segment"] 	= 4;
		$page 					= ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$limit 					= $config["per_page"];
		$offset 				= $page;
		
		$this->load->model('weighing');
		$data['total'] = $this->weighing->total_incoming_today();
		$config['total_rows'] = $data['total'];
		
		$this->pagination->initialize($config);
		$data['list_today'] = $this->weighing->list_incoming_today($limit, $offset);
		$data['link_today'] = $this->pagination->create_links();
		
		
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/list_incoming', $data);
		$this->load->view('template/footer');
	}
	
	
	
}

/* End of file outgoing.php */
/* Location: ./application/controllers/weighing/outgoing.php */