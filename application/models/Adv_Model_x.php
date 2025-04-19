<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adv_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    
    public function get_listr(){
        $sql0 = "SELECT * FROM registran ORDER by intime DESC";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    public function fetch_csv(){
        
        $this->db->select("uname, uemail, uphone, uig, uscore, utime, intime");
        $this->db->from("registran");

        return $this->db->get();
    }
    public function get_total(){
        $sql0 = "SELECT count(plt) as totalplay FROM playanalytic";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->row_array();
        return $result;
    }

    public function addReg($tbl = 'registran', $data){
        $this->db->insert($tbl, $data);
        return true;
    }
    
    public function playuser($tbl = 'playanalytic', $data){
        $this->db->insert($tbl, $data);
        return true;
    }


}