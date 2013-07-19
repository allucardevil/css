<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_csv extends CI_Controller {

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
		redirect('weighing/import_csv/import_outgoing');
	}
	
	public function import_outgoing(){
		# call view
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('weighing/import_outgoing_csv');
		$this->load->view('template/footer');
	}

	public function run_import(){
		
		$file   = explode('.',$_FILES['database']['name']);
		$length = count($file);
		if($file[$length -1] == 'csv' ){ 
			$tmp    = $_FILES['database']['tmp_name'];
		
			$handle = fopen($tmp,"r");
			$data = $handle;
			$i=0;
			echo "<table border='1'>";
			echo "<tr>";
					echo "<td> jenis </td>";//mengambil data csv sesuai dengan kolom dimulai dari 0
					echo "<td> airline </td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
					echo "<td></td>";
			echo "</tr>";
			do {
					
					echo "<tr>";
					echo "<td>" . $data[0] . "</td>";//mengambil data csv sesuai dengan kolom dimulai dari 0
					echo "<td>" . $data[1] . "</td>";
					echo "<td>" . $data[2] . "</td>";
					echo "<td>" . $data[3] . "</td>";
					echo "<td>" . $data[4] . "</td>";
					echo "<td>" . $data[5] . "</td>";
					echo "<td>" . $data[6] . "</td>";
					echo "<td>" . $data[7] . "</td>";
					echo "<td>" . $data[8] . "</td>";
					echo "<td>" . $data[9] . "</td>";
					echo "<td>" . $data[10] . "</td>";
					echo "<td>" . $data[11] . "</td>";
					echo "<td>" . $data[12] . "</td>";
					echo "<td>" . $data[13] . "</td>";
					echo "<td>" . $data[14] . "</td>";
					echo "<td>" . $data[15] . "</td>";
					echo "<td>" . $data[16] . "</td>";
					echo "<td>" . $data[17] . "</td>";
					echo "<td>" . $data[18] . "</td>";
					echo "<td>" . $data[19] . "</td>";
					echo "<td>" . $data[20] . "</td>";
					echo "<td>" . $data[21] . "</td>";
					echo "<td>" . $data[22] . "</td>";
					echo "</tr>";
					
				
			} while ($data = fgetcsv($handle,1000,","));
			echo "</table>";
		}
	}
	
}
?>