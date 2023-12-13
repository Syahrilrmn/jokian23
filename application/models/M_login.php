<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Login extends CI_Model
{

    function GET_LOGIN($email, $pass)
    {
        $row = $this->db->query("SELECT * FROM tbl_login WHERE user ='$email' AND pass = '$pass'" );
        return $row;
    }   
}
?>
