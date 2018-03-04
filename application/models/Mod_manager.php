<?php
class Mod_manager extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 確認管理者是否登入
    public function chk_login_status()
    {
        return $this->session->userdata('manager_login_ststus');
    }

    // 確認管理者信箱帳號是否存在
    public function chk_login($email, $pwd)
    {
        $this->db->where('email', $email);
        $this->db->where('password', sha1($pwd));
        // 透過藉由信箱密碼下去比對是否存在
        if ($this->db->count_all_results('manager_main') == 0) {
            // 不存在
            return false;
        } else {
            // 存在
            return true;
        }
    }

    // 管理員進行登入
    public function do_login($email)
    {
        $manager = $this->get_once_by_email($email);

        $session_arr = array(
            'manager_name' => $manager['nickname'],
            'manager_email' => $manager['email'],
            'manager_id' => $manager['id'],
            'manager_login_ststus' => true,
        );

        // 登入資訊保存到Session
        $this->session->set_userdata($session_arr);
        $this->set_last_login($manager['id']);
        return true;
    }

    // 取得管理員Email
    public function get_once_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('manager_main')->row_array();
    }

    // 確認E-mail是否重複
    public function chk_repeat_email($id, $email)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        return $this->db->get('manager_main')->row_array();
    }

    // 設定最後登入時間
    public function set_last_login($id)
    {
        $dataArray = array(
            'last_date' => date('Y-m-d'),
            'last_time' => date('H-i-s'),
        );

        $this->db->where('id', $id);
        return $this->db->update('manager_main', $dataArray);
    }

    // 管理員登出
    public function logout()
    {
        $this->session->unset_userdata('manager_name');
        $this->session->unset_userdata('manager_email');
        $this->session->unset_userdata('manager_id');
        $this->session->unset_userdata('manager_login_ststus');
        return true;
    }

    // 取得管理員清單
    public function get_all()
    {
        return $this->db->get('manager_main')->result_array();
    }

    // 取得特定管理員
    public function get_once($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('manager_main')->row_array();
    }

    // 取得管理員總筆數
    public function get_total()
    {
        return $this->db->count_all_results('manager_main');
    }

    // 新增管理員
    public function insert($dataArray)
    {
        return $this->db->insert('manager_main', $dataArray);
    }

    // 更新管理員
    public function update($id, $dataArray)
    {
        $this->db->where('id', $id);
        return $this->db->update('manager_main', $dataArray);
    }

    // 刪除管理員
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('manager_main');
    }
}
