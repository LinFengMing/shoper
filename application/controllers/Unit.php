<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mod_manager');
    }

    /*public function test()
    {
        $data = array(
            'id' => uniqid(),
            'email' => 'jiro853141@gmail.com',
            'phone' => '0960535590',
            'password' => sha1(853141),
            'nickname' => 'JiroLin',
            'create_date' => date('Y-m-d'),
            'create_time' => date('H-i-s'),
        );

        echo $this->db->insert('manager_main', $data);
    }*/
}
