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
        echo('This is Backend for Croz/Word');
        echo('<br>Code by Dhany Da Vinci');
    }
    
    public function boardinfo(){
        $idgame = htmlspecialchars($this->input->post('idgame'));
        $actmonth = htmlspecialchars($this->input->post('actmonth'));

        $checkdup = $this->Adv_Model->boardinfo($idgame, $actmonth);

        echo json_encode($checkdup);
    }
    
    public function addnew_tts_user(){
    
        $userinput = htmlspecialchars($this->input->post('uname_reg'));
        $idgame = htmlspecialchars($this->input->post('idgame'));

        $checkdup = $this->Adv_Model->cekttsuser($userinput, $idgame);

        $dataInsert = array(
            'plt'    => $userinput,
            'gameid'    => $idgame,
        );
        $response = $this->Adv_Model->playuser('playanalytic', $dataInsert);
        echo json_encode($checkdup);
    }
    
    public function update_tts_game(){
        $userinput = htmlspecialchars($this->input->post('uname_reg'));
        $idgame = htmlspecialchars($this->input->post('idgame'));
        $j_hor = $this->input->post('j_hor');
        $j_ver = $this->input->post('j_ver');

        $checkdup = $this->Adv_Model->updategametts($userinput, $idgame, $j_hor, $j_ver);

        echo json_encode($checkdup);
    }
    
    public function loadgameboard() {
        $partisipan = $this->Adv_Model->loadgameboard(1);        
        echo json_encode($partisipan);
    }
    

    public function playuser(){
        $dataInsert = array(
            'plt'    => 'human',
        );
        $response = $this->Adv_Model->playuser('playanalytic', $dataInsert);
    }
}