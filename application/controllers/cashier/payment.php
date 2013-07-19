<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	/**
	 *
	 */
	 
	public function index()
	{
		redirect('cashier/payment/new_receipt');
	}
	
	public function new_receipt()
	{
		#sidebar data
		$data['sidebar'] = 'kasir';
		
		#view call
		$this->load->view('template/css_header');
		$this->load->view('cashier/css/add_payment_receipt_form');
		$this->load->view('template/css_menubar');
		$this->load->view('template/css_footer');
		//$this->load->view('template/sidebar', $data);
		//$this->load->view('template/breadcumb');
		//$this->load->view('template/footer');
	}
	
	public function do_search_receipt()
	{
		#load model
		$this->load->model('cashier');
		
		#form validation
		$this->form_validation->set_rules('btb_no', 'btb_no', 'required');
		
		#preparing search
		if ($this->form_validation->run() == FALSE)
		{ 
			#redirect if form btb empty
			redirect('cashier/payment/new_receipt'); 
		} else
		{
			$search = $this->input->post('btb_no');
			$type = $this->input->post('type');
			
			//$data['payment_receipt'] = $this->cashier->get_search_payment_receipt($search,$type_search);
			if($type == 'outgoing'){
				$this->payment_receipt_outgoing($search,$type);
			} else {
				$this->payment_receipt_incoming($search,$type);
			}
			
		}
	}
	
	public function payment_receipt_outgoing($search,$type)
	{
			#sidebar data
			$data['sidebar'] = 'kasir';
		
			$data['type'] = $type;
			$data['weighing_details']= $this->cashier->get_search_weighing_details_by_type_no($search, $type);
			
			if ($data['weighing_details'] == NULL)
			{
				redirect('cashier/payment/new_receipt/not_found'); 
			}
		
			#prepare var
			$data['payment_type']= $this->cashier->get_all_payment_type();
			$data['agent']= $this->cashier->get_all_agent();
			
			#perhitungan biaya
			$outgoing_weight = $this->cashier->get_weighing_outgoing_by_wo_no($search);
			$rental_rates = $this->cashier->get_rental_rates_by_wo_no($search);
			
			$actual_weight=0;
			$paid_weight=0;
			foreach($outgoing_weight as $ow)
			{
				$actual_weight = $actual_weight + $ow->wow_actual_weight;
				$paid_weight = $paid_weight + $ow->wow_paid_weight;
			}
			
			foreach($rental_rates as $rr)
			{
				$data['min_day'] = $rr->wrr_min_day;
				$data['daily_rates'] = $rr->wrr_daily_rates;
				$data['package_base'] = $rr->wrr_package_base;
				$data['administration'] = $rr->wrr_administration;
				$data['tax'] = $rr->wrr_tax;
				$data['min_charge'] = $rr->wrr_min_charge;
				$data['asperindo'] = $rr->wrr_asperindo;
				$data['wh_charge'] = $rr->wrr_wh_charge;
				$data['cargo_charge'] = $rr->wrr_cargo_charge;
				$data['trucking'] = $rr->wrr_trucking;
			}
			
			$selisih = strtotime(date('Y-m-d')) - strtotime($ow->wo_date);
			$selisih = $selisih / (3600 * 24);
			$data['selisih'] = $selisih;
			
			if($data['selisih'] > $data['min_day']){
				$data['charge'] = $data['package_base'] + ($data['selisih'] - $data['min_day']) * $data['daily_rates'];
			} else {
				$data['charge'] = $data['package_base'] ;
			}
			
			if($data['charge'] < $data['min_charge']){
				$data['charge'] = $data['min_charge'];
			}
			
			$data['total_sewa_gudang'] = $data['charge'] + $data['wh_charge'] + $data['cargo_charge'] + $data['trucking'];
			$data['total_biaya'] = $data['total_sewa_gudang'] + (  $data['total_sewa_gudang'] * ($data['tax']/100) ); 
			
			if($data['min_day'] > $data['selisih'])
			{
				$data['charge'] = $data['min_charge']; 
			} else
			{
				$data['charge'] = $data['selisih'] * $data['daily_rates'];
			}		
			$data['total_sewa_gudang'] = $data['charge'] + $data['wh_charge'] + $data['cargo_charge'] + $data['trucking'];
			$data['total_biaya'] = $data['total_sewa_gudang'] + (  $data['total_sewa_gudang'] * ($data['tax']/100) ); 
			//$data['total_sewa_gudang'] = $data['charge'] + $data['administration'];
			
			$data['actual_weight'] = $actual_weight;
			$data['paid_weight'] = $paid_weight;
			
			$this->load->view('template/header');
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/breadcumb');
			if ($type == 'outgoing'){$this->load->view('cashier/payment_receipt_outgoing_form',$data);}
			if ($type == 'incoming'){$this->load->view('cashier/payment_receipt_incoming_form',$data);}
			$this->load->view('template/footer');
		
	}
	
	public function payment_receipt_incoming($search,$type)
	{
			#sidebar data
			$data['sidebar'] = 'kasir';
		
			$data['type'] = $type;
			$data['weighing_details']= $this->cashier->get_search_weighing_details_by_type_no($search, $type);
			
			if ($data['weighing_details'] == NULL)
			{
				redirect('cashier/payment/new_receipt/not_found'); 
			}
			
			#prepare var
			$data['payment_type']= $this->cashier->get_all_payment_type();
			$data['agent']= $this->cashier->get_all_agent();
			
			#perhitungan biaya
			//$incoming_weight = $this->cashier->get_weighing_imcoming_by_wi_no($search);
			$rental_rates = $this->cashier->get_rental_rates_by_wi_no($search);
			
			$actual_weight=0;
			$paid_weight=0;
			foreach($data['weighing_details'] as $wd)
			{
				$actual_weight = $actual_weight + $wd->wid_actual_weight;
			//	$paid_weight = $paid_weight + $wd->wid_paid_weight;
			}
			
			foreach($rental_rates as $rr)
			{
				$data['min_day'] = $rr->wrr_min_day;
				$data['daily_rates'] = $rr->wrr_daily_rates;
				$data['package_base'] = $rr->wrr_package_base;
				$data['administration'] = $rr->wrr_administration;
				$data['tax'] = $rr->wrr_tax;
				$data['min_charge'] = $rr->wrr_min_charge;
				$data['asperindo'] = $rr->wrr_asperindo;
				$data['wh_charge'] = $rr->wrr_wh_charge;
				$data['cargo_charge'] = $rr->wrr_cargo_charge;
				$data['trucking'] = $rr->wrr_trucking;
			}
			
			$selisih = strtotime(date('Y-m-d')) - strtotime($wd->wi_date);
			$selisih = $selisih / (3600 * 24);
			$data['selisih'] = $selisih;
			
			if($data['selisih'] > $data['min_day']){
				$data['charge'] = $data['package_base'] + ($data['selisih'] - $data['min_day']) * $data['daily_rates'];
			} else {
				$data['charge'] = $data['package_base'] ;
			}
						
			if($data['charge'] < $data['min_charge']){
				$data['charge'] = $data['min_charge'];
			}
			
			$data['total_sewa_gudang'] = $data['charge'] + $data['wh_charge'] + $data['cargo_charge'] + $data['trucking'];
			$data['total_biaya'] = $data['total_sewa_gudang'] + (  $data['total_sewa_gudang'] * ($data['tax']/100) ); 
			
			$data['actual_weight'] = $actual_weight;
			//$data['paid_weight'] = $paid_weight;
			
			$this->load->view('template/header');
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/breadcumb');
			if ($type == 'outgoing'){$this->load->view('cashier/payment_receipt_outgoing_form',$data);}
			if ($type == 'incoming'){$this->load->view('cashier/payment_receipt_incoming_form',$data);}
			$this->load->view('template/footer');
		
	}
	
	public function save_payment()
	{
		$this->load->model('cashier');
		# get user data
		$user = 'admin';
		
		if($this->input->post('btb_type') == 'OUTGOING'){$btb_type = "out";}
		if($this->input->post('btb_type') == 'INCOMING'){$btb_type = "in";}
		$data = array(
				'pr_stn' => $this->input->post('station'),
				'pr_type' => $btb_type,
				'pr_weighing_no' => $this->input->post('btb_no'),
				'pr_awb_no' => $this->input->post('awb_no'),
				'pr_agent_id' => $this->input->post('agent'),
			);
		
		
		if($this->input->post('total_bayar') != "")
		{ $total= $this->input->post('total_bayar');} else 
		{ $total = $this->input->post('administrasi')+$this->input->post('charge');
		  $total_ppn = $total + $total*$this->input->post('ppn')/100;
		  if($this->input->post('discount') == "")
		  { $disc = $this->input->post('disc_rp');} else 
		  { $disc = $total*$this->input->post('discount')/100;}
		  $total = $total_ppn - $disc;
		}
		  
		if($this->input->post('discount') == "")
		{ $disc = $this->input->post('disc_rp');} else 
		{ 
			$disc = $this->input->post('discount')/100 * ($this->input->post('administrasi')+$this->input->post('charge'));
		}
		$data_prd = array(
				'prd_weighing_no' => $this->input->post('btb_no'),
				'prd_administration' => $this->input->post('administrasi'),
				'prd_ppn' => $this->input->post('ppn'),
				'prd_actual_weight' => $this->input->post('actual_weight'),
				'prd_paid_weight' => $this->input->post('paid_weight'),
				'prd_charge' => $this->input->post('charge'),
				'prd_date' => mdate('%Y-%m-%d',strtotime($this->input->post('date'))),
				'prd_disc' => $disc,
				'prd_disc_ket' => $this->input->post('ket_disc'),
				'prd_total' => $total,
				'prd_update_by' => $user,
			);
		
		$deposit = $this->cashier->get_deposit_agent($this->input->post('agent'));
		foreach ($deposit as $value)
			{
				$deposit_cash = $value['agent_deposit'];
			}
			
		if ($this->input->post('payment_type') == 'deposit')
		{
			if ($total > $deposit_cash){
				if ($this->input->post('btb_type') == 'OUTGOING')
				{ $this->payment_receipt_outgoing($this->input->post('btb_no'), 'outgoing');}
				else
				{ $this->payment_receipt_incoming($this->input->post('btb_no'), 'incoming');}
			} else {
				$deposit_cash = $deposit_cash - $total;
				$this->cashier->deposit_update($this->input->post('agent'),$deposit_cash);
				$this->cashier->save_payment_receipt($data);
				$this->cashier->save_payment_receipt_details($data_prd);
				if ($this->input->post('btb_type') == 'OUTGOING')
				{ $this->cashier->update_weighing_outgoing_status($this->input->post('btb_no'));}
				else
				{ $this->cashier->update_weighing_incoming_status($this->input->post('btb_no'));}
				redirect('cashier/payment/new_receipt');
			}
		}else
		{
			if ($this->input->post('btb_type') == 'OUTGOING')
			{ $this->cashier->update_weighing_outgoing_status($this->input->post('btb_no'));}
			else
			{ $this->cashier->update_weighing_incoming_status($this->input->post('btb_no'));}
			$this->cashier->save_payment_receipt($data);
			$this->cashier->save_payment_receipt_details($data_prd);
			redirect('cashier/payment/new_receipt');
		}
		
	}
	
	public function do_search_payment()
	{
		if($this->input->post('type') == 'outgoing'){
			redirect('cashier/payment/daily_outgoing_payment_report/'.$this->input->post('start_date').'/'.$this->input->post('end_date').'/');
		} else {
			redirect('cashier/payment/daily_incoming_payment_report/'.$this->input->post('start_date').'/'.$this->input->post('end_date').'/');
		}
	}
	
	public function daily_outgoing_payment_report()
	{
		#sidebar data
		$data['sidebar'] = 'kasir';
			
		$this->load->model('cashier');
		
		$start_date= date('Y-m-d',strtotime($this->uri->segment(4))); 
		$end_date= date('Y-m-d',strtotime($this->uri->segment(5))); 
		
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
		$config['base_url'] 	= site_url() . '/cashier/payment/daily_outgoing_payment_report/'.$start_date.'/'.$end_date.'/' ;
		$config['per_page'] 	= 10; 
		$config["uri_segment"] 	= 6;
		$page 					= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$limit 					= $config["per_page"];
		$offset 				= $page;
		
		# call model
		$this->load->model('cashier');
		$data['total'] = $this->cashier->total_payment_receipt_by_type($start_date,$end_date,'out');
		
		$config['total_rows'] = $data['total'];
		
		$this->pagination->initialize($config);
		
		$data['list_today_out'] = $this->cashier->list_payment_outgoing_today($start_date,$end_date,$limit, $offset);
	//	$data['list_today_in'] = $this->cashier->list_payment_incoming_today($start_date,$end_date,$limit, $offset);
		$data['link_payment_report'] = $this->pagination->create_links();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
	
		//print_r($data);
		$this->load->view('template/css_header');
		$this->load->view('template/css_menubar');
		//$this->load->view('template/sidebar', $data);
		//$this->load->view('template/breadcumb');
		$this->load->view('cashier/css/daily_outgoing_payment_report', $data);
		$this->load->view('template/css_footer');
	}
	
	public function daily_incoming_payment_report()
	{
		#sidebar data
		$data['sidebar'] = 'kasir';
			
		$this->load->model('cashier');
		
		$start_date= date('Y-m-d',strtotime($this->uri->segment(4))); 
		$end_date= date('Y-m-d',strtotime($this->uri->segment(5))); 
		
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
		$config['base_url'] 	= site_url() . '/cashier/payment/daily_incoming_payment_report/'.$start_date.'/'.$end_date.'/' ;
		$config['per_page'] 	= 10; 
		$config["uri_segment"] 	= 6;
		$page 					= ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		$limit 					= $config["per_page"];
		$offset 				= $page;
		
		# call model
		$this->load->model('cashier');
		$data['total'] = $this->cashier->total_payment_receipt_by_type($start_date,$end_date,'in');
		
		$config['total_rows'] = $data['total'];
		
		$this->pagination->initialize($config);
		
		$data['list_today_in'] = $this->cashier->list_payment_incoming_today($start_date,$end_date,$limit, $offset);
		$data['link_payment_report'] = $this->pagination->create_links();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
	
		//print_r($data);
		$this->load->view('template/css_header');
		$this->load->view('template/css_menubar');
		$this->load->view('cashier/css/daily_incoming_payment_report', $data);
		$this->load->view('template/css_footer');
	}
	
	public function receipt_list()
	{
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		#$this->load->view('template/welcome_message');
		$this->load->view('template/footer');
	}
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */