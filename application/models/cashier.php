<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cashier extends CI_Model {

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
	 
	public function get_search_payment_receipt($search,$type_search)
	{
		$query = "	SELECT * FROM payment_receipt AS pr
					LEFT JOIN (SELECT agent_id,agent_name FROM var_agent) AS agent ON pr.pr_agent_id = agent.agent_id
					WHERE pr.pr_weighing_no = '$search'
					AND pr.pr_type = '$type_search' 
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_search_weighing_details_by_type_no($search,$type)
	{
		if($type == 'outgoing'){
			$query = " 	SELECT * FROM  weighing_outgoing as wo 
						LEFT JOIN (SELECT * FROM weighing_outgoing_details ) AS wod ON  wo.wo_no = wod.wod_wo_no 
						WHERE wo_no = '$search' AND wo_status = 'unpaid' 
					";
						
		} else {
			$query = " 	SELECT * FROM  weighing_incoming as wi
						LEFT JOIN (SELECT * FROM weighing_incoming_details ) AS wid ON  wi.wi_no = wid.wid_weighing_no 
						WHERE wi_no = '$search' AND wi_status = 'unpaid'
					";
		}
		$query = $this->db->query($query);
		return $query->result();
		
	}

	public function get_rental_rates_by_wo_no($wo_no)
	{
		$query = "	SELECT * FROM  weighing_outgoing as wo 
					LEFT JOIN (SELECT agent_id,agent_name,agent_asperindo FROM var_agent ) AS agent ON wo.wo_agent = agent.agent_id  
					LEFT JOIN (SELECT * FROM warehouse_rental_rates ORDER BY wrr_id DESC LIMIT 1 ) AS wrr ON wo.wo_stn = wrr.wrr_stn AND wrr.wrr_asperindo = agent.agent_asperindo
					WHERE wo_no = '$wo_no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_rental_rates_by_wi_no($wi_no)
	{
		$query = "	SELECT * FROM  weighing_incoming as wi
					LEFT JOIN (SELECT agent_id,agent_name,agent_asperindo FROM var_agent ) AS agent ON wi.wi_agent = agent.agent_id 
					LEFT JOIN (SELECT * FROM warehouse_rental_rates ORDER BY wrr_id DESC LIMIT 1 ) AS wrr ON (wi.wi_stn = wrr.wrr_stn AND wrr.wrr_asperindo = agent.agent_asperindo) 
					WHERE wi_no = '$wi_no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_weighing_outgoing_by_wo_no($wo_no)
	{
		$query = "	SELECT * FROM  weighing_outgoing as wo
					LEFT JOIN (SELECT * FROM weighing_outgoing_weight ) AS wow ON  wo.wo_no = wow.wow_wo_no 
					WHERE wo_no = '$wo_no'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function get_all_goods()
	{
		$query = $this->db->get('var_goods');
		return $query->result();
	}
    
	public function get_all_payment_type()
	{
		$query = $this->db->get('var_payment_type');
		return $query->result();
	}
	
	public function get_all_agent()
	{
		$query = $this->db->get('var_agent');
		return $query->result();
	}
	
	public function get_deposit_agent($agent_id)
	{
		$this->db->where('agent_id', $agent_id);
		$query = $this->db->get('var_agent');
		return $query->result_array();
	}
     
	public function save_payment_receipt($data)
	{
		$this->db->insert('payment_receipt',$data);
	}
	
	public function save_payment_receipt_details($data)
	{
		$this->db->insert('payment_receipt_details',$data);
	}
	
	public function deposit_update($agent_id, $deposit_cash)
	{
		$this->db->update('var_agent', array('agent_deposit'=>$deposit_cash), array('agent_id'=>$agent_id));
	}
	
	public function update_weighing_outgoing_status($btb_no)
	{
		$this->db->update('weighing_outgoing', array('wo_status'=>'paid'), array('wo_no'=>$btb_no));
	}
	
	public function update_weighing_incoming_status($btb_no)
	{
		$this->db->update('weighing_incoming', array('wi_status'=>'paid'), array('wi_no'=>$btb_no));
	}
	
	public function total_payment_receipt($start_date,$end_date)
	{
		$query = " 
					SELECT * FROM payment_receipt AS pr
					LEFT JOIN (SELECT * FROM payment_receipt_details) AS prd ON pr.pr_weighing_no = prd.prd_weighing_no
					WHERE prd.prd_date >= '$start_date' AND prd.prd_date <= '$end_date'
					
				";
		$query = $this->db->query($query);
		$count = $query->num_rows();
		return $query->num_rows();
	}
	
	public function total_payment_receipt_by_type($start_date,$end_date,$type)
	{
		$query = " 
					SELECT * FROM payment_receipt AS pr
					LEFT JOIN (SELECT * FROM payment_receipt_details) AS prd ON pr.pr_weighing_no = prd.prd_weighing_no
					WHERE prd.prd_date >= '$start_date' AND prd.prd_date <= '$end_date' AND pr.pr_type='$type'
					
				";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	public function list_payment_outgoing_today($start_date,$end_date,$limit,$offset)
	{
		$query = " 
					SELECT pr_id, pr_type, prd_weighing_no, prd_date, pr_weighing_no, wo_no, wo_airline, wo_origin, wo_destination, wo_final_dest, wo_status, wo_date, agent_id, agent_name FROM payment_receipt AS pr 
					LEFT JOIN (SELECT MAX(prd_id), prd_weighing_no, prd_date FROM payment_receipt_details GROUP BY prd_id) AS prd ON pr.pr_weighing_no = prd.prd_weighing_no
					LEFT JOIN (SELECT wo_no, wo_airline, wo_origin, wo_destination, wo_final_dest, wo_status, wo_date FROM weighing_outgoing) AS wo ON pr.pr_weighing_no = wo.wo_no
					LEFT JOIN (SELECT agent_id, agent_name FROM var_agent) AS agn ON pr.pr_agent_id = agn.agent_id
					WHERE prd.prd_date >= '$start_date' AND prd.prd_date <= '$end_date' AND pr.pr_type = 'out' 
					LIMIT $offset,$limit
					
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
	public function list_payment_incoming_today($start_date,$end_date,$limit,$offset)
	{
		$query = " 
					SELECT pr_id, pr_type, prd_weighing_no, prd_date, pr_weighing_no, wi_no, wi_airline, wi_origin, wi_destination, wi_final_dest, wi_status, wi_date, agent_id, agent_name FROM payment_receipt AS pr
					LEFT JOIN (SELECT prd_weighing_no, prd_date FROM payment_receipt_details) AS prd ON pr.pr_weighing_no = prd.prd_weighing_no
					LEFT JOIN (SELECT wi_no, wi_airline, wi_origin, wi_destination, wi_final_dest, wi_status, wi_date FROM weighing_incoming) AS wi ON pr.pr_weighing_no = wi.wi_no
					LEFT JOIN (SELECT agent_id, agent_name FROM var_agent) AS agn ON pr.pr_agent_id = agn.agent_id
					WHERE prd.prd_date >= '$start_date' AND prd.prd_date <= '$end_date' AND pr.pr_type = 'in'
					LIMIT $offset,$limit
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	
}

/* End of file airline.php */
/* Location: ./application/models/airline.php */