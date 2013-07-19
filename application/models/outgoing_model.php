<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outgoing_model extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id :
	 * App code :
	 *
	 * weighing model
	 *
	 * url : http://dom.kno.wms.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : pandhawa digital
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 */
	 
	 # outgoing data -----------------------------------
	 
	public function insert_house_awb($data)
	{
		$this->db->insert('outgoing_house_awb',$data);
	}
	public function update_status_house_awb_by_awb_no($awb)
	{
		$this->db->where('oha_awb_no', $awb);
		$this->db->update('outgoing_house_awb', array('oha_status'=>'void')); 
	}
	public function save_build_up($data)
	{
		$this->db->insert('outgoing_build_up',$data);
	}
	public function get_build_up($uld)
	{
		$this->db->where('obu_uld',$uld);
		$query = $this->db->get('outgoing_build_up');
		return $query->result();
	}
	public function get_build_up_details($uld)
	{
		$where = array(
				'obud_uld' => $uld,
				'obud_status' => 'active',
			);
		$this->db->where($where);
		$query = $this->db->get('outgoing_build_up_details');
		return $query->result();
	}
	public function get_parent_house_awb($awb)
	{
		$where = array(
				'oha_awb_no' => $awb,
				'oha_status_parent' => 'parent',
		);
		$this->db->where($where);
		$query = $this->db->get('outgoing_house_awb');
		return $query->result();
	}
	public function get_child_house_awb($awb)
	{
		$where = array(
				'oha_awb_no' => $awb,
				'oha_status_parent' => 'child',
		);
		$this->db->where($where);
		$query = $this->db->get('outgoing_house_awb');
		return $query->result();
	}
	public function get_total_child_house_awb($awb)
	{
		$query = " 	SELECT oha_awb_no, SUM(oha_piece) AS total_oha_piece , SUM(oha_weight) AS total_oha_weight
					FROM outgoing_house_awb
					WHERE oha_status_parent = 'child' AND oha_awb_no = '$awb' AND oha_status != 'void'
				";
		$query = $this->db->query($query);
		return $query->result();
	}
	public function insert_awb($data)
	{
		$this->db->insert('outgoing_build_up_details',$data);
	}
	
}
	 