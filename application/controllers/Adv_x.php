<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adv extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		// $logged = $this->session->userdata('userLogged');
	 	// if(!$logged){
	 	// 	redirect("/login");
		//  }
		Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
                Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
        $this->load->model('Adv_Model');
	}
	
	public function index()
	{
        redirect('https://caridecolgen.id', 'refresh');
    }
    
    public function detail(){
 
        
        $this->load->view('public/template/header');
        $this->load->view('public/dashboard/dashboard_detail');
        $this->load->view('public/template/footer');    
    }
    
    public function dashboard(){

        $data = array (
            'userList' => $this->Adv_Model->get_listr(),
            'totalplay' => $this->Adv_Model->get_total(),
        );

        // $response = $this->Adv_Model->get_listr();
        // $totalplay = $this->Adv_Model->get_total();
        
        // echo json_encode($response);
        // echo ($totalplay['totalplay']);


        $this->load->view('public/dashboard/csv_view', $data);
    }
    
    
    public function playuser(){
        $dataInsert = array(
            'plt'    => 'human',
        );
        $response = $this->Adv_Model->playuser('playanalytic', $dataInsert);
    }

    public function addreg(){
        $dataInsert = array(
            'uname'    => htmlspecialchars($this->input->post('uname')),
            'uemail'    => htmlspecialchars($this->input->post('uemail')),
            'uphone'    => htmlspecialchars($this->input->post('nohp')),
            'uig'       => htmlspecialchars($this->input->post('uig')),
            'uscore'     => htmlspecialchars($this->input->post('uscore')),
            'utime'     => htmlspecialchars($this->input->post('utime')),
        );

        if($this->Adv_Model->addReg('registran', $dataInsert)){
            echo true;     
        }else{
            echo false;
        }
    }

    public function export_csv_process(){
        echo 'hello';
        
        $file_name = 'caridecolgen_data_on_'.date('Ymd').'.csv'; 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$file_name"); 
        header("Content-Type: application/csv;");
    
        // // get data 
        $partisipan = $this->Adv_Model->fetch_csv();

        // // file creation 
        $file = fopen('php://output', 'w');
    
        $header = array("User Name","Email", "Phone", "IG Account", "Score", "Durations (Sec)", "Date Time"); 
        fputcsv($file, $header);
        foreach ($partisipan->result_array() as $key => $value)
        { 
            fputcsv($file, $value); 
        }
        
        fclose($file); 
        exit; 
    }
}