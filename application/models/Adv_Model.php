<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adv_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function boardinfo($idgame='', $actmonth, $uname='testing'){
        //$sql0 = "SELECT * FROM `crossword_board_set` WHERE substring(`cwrilis`,1,2) = '" . $actmonth . "' ORDER BY substring(`cwrilis`,7,2) DESC";
        //$sql0 = "SELECT a.idboard, a.boardset,a.hor_set, a.ver_set, a.idgame, a.boardsize, a.j_hor, a.j_ver, a.ttsinfo, a.cwrilis, a.liveschedule , b.prggame FROM `crossword_board_set` a LEFT JOIN `userregtts` b ON a.idgame=b.idgame WHERE substring(`cwrilis`,1,2) = '" . $actmonth . "' ORDER BY substring(`cwrilis`,7,2) DESC";
        $sql0 = "SELECT a.idboard, a.boardset,a.hor_set, a.ver_set, a.idgame, a.boardsize, a.j_hor, a.j_ver, a.ttsinfo, a.cwrilis, a.liveschedule, (SELECT b.prggame FROM userregtts b WHERE uname='" . $uname . "' AND b.idgame=a.idgame ORDER BY b.intime DESC LIMIT 1 ) AS prggame FROM crossword_board_set a WHERE statuscw=1 AND substring(`cwrilis`,1,2) = '" . $actmonth . "' ORDER BY a.idboard DESC";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }


    public function loadgameboard($idgame){
        $sql0 = "SELECT * FROM crossword_board_set WHERE idgame='" . $idgame . "'";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();
        return $result;
    }
    
    public function cekttsuser($uname, $idgame){
        
        $sql0 = "SELECT * FROM userregtts WHERE uname='" . $uname . "' AND idgame='" . $idgame . "'";
        
        $query0 = $this->db->query($sql0);
        $result = $query0->result_array();

        if (count($result) == 0) {
            //Data user belum terdaftar
            $sql0 = "SELECT * FROM crossword_board_set WHERE idgame='" . $idgame . "'";    
            $query0 = $this->db->query($sql0);
            $result = $query0->result_array();

            $boardset = $result[0]['boardset'];
            $j_hor = $result[0]['j_hor'];
            $j_ver = $result[0]['j_ver'];


            $sql_ins = "INSERT INTO userregtts (uname, j_hor, j_ver, idgame) VALUES ('" . $uname ."', '" . $j_hor . "','" . $j_ver . "','" . $idgame . "')";        
            $queryins0 = $this->db->query($sql_ins);

            //Load Data User
            $sql0 = "SELECT boardset, hor_set, ver_set, a.idgame, b.j_hor, b.j_ver, ttsinfo, uname, boardsize FROM crossword_board_set a 
                        INNER JOIN userregtts b ON a.idgame=b.idgame 
                     WHERE a.idgame='" . $idgame . "' AND uname='" . $uname . "'";    
            $query0 = $this->db->query($sql0);
            $queryins = $query0->result_array();
        }else{
            //Load Data User
            $sql0 = "SELECT boardset, hor_set, ver_set, a.idgame, b.j_hor, b.j_ver, ttsinfo, uname, boardsize FROM crossword_board_set a 
                        INNER JOIN userregtts b ON a.idgame=b.idgame 
                     WHERE a.idgame='" . $idgame . "' AND uname='" . $uname . "'";    
            $query0 = $this->db->query($sql0);
            $queryins = $query0->result_array();
        }
        return $queryins;
    }

    public function updategametts($userinput, $idgame, $j_hor, $j_ver, $prggame){
        $sql0 = "UPDATE userregtts SET j_hor='" . $j_hor . "', j_ver='" . $j_ver . "', prggame=" . $prggame ." WHERE uname='" . $userinput . "' AND idgame='" . $idgame . 
        "'";
        $query0 = $this->db->query($sql0);

        return true;
    }

    public function playuser($tbl = 'boboanalytic', $data){
        $this->db->insert($tbl, $data);
        return true;
    }


}