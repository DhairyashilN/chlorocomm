<?php class Mymodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function usrchk($usr) {
        $qry = 'SELECT count(*) as cnt from acp_profile where username= ? ';
        $res = $this->db->query($qry,array( $usr ))->result();
        if ($res[0]->cnt > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }

}
?>