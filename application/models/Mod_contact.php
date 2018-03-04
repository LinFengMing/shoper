<?php
class Mod_contact extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

   // 取得分類清單
    public function get_all()
    {
        return $this->db->get('contact_main')->result_array();
    }

    // 取得特定聯絡
    public function get_once($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('contact_main')->row_array();
    }

    // 取得聯絡總筆數
    public function get_total()
    {
        return $this->db->count_all_results('contact_main');
    }

    // 新增聯絡
    public function insert($dataArray)
    {
        return $this->db->insert('contact_main', $dataArray);
    }

    // 更新聯絡
    public function update($id, $dataArray)
    {
        $this->db->where('id', $id);
        return $this->db->update('contact_main', $dataArray);
    }

    // 刪除聯絡
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('contact_main');
    }
}
