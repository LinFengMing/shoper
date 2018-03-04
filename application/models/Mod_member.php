<?php
class Mod_member extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 取得會員Email
    public function get_once_by_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('user_main')->row_array();
    }

    // 確認Email是否重複
    public function chk_repeat_email($id, $email)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $id);
        return $this->db->get('user_main')->row_array();
    }

    // 取得會員清單
    public function get_all()
    {
        return $this->db->get('user_main')->result_array();
    }

    // 取得特定會員
    public function get_once($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('user_main')->row_array();
    }

    // 取得會員總筆數
    public function get_total()
    {
        return $this->db->count_all_results('user_main');
    }

    // 新增會員
    public function insert($dataArray)
    {
        return $this->db->insert('user_main', $dataArray);
    }

    // 更新會員
    public function update($id, $dataArray)
    {
        $this->db->where('id', $id);
        return $this->db->update('user_main', $dataArray);
    }

    // 刪除會員
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user_main');
    }
}
