<?php
class Mod_category extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mod_product');
    }

    // 取得分類
    public function get_once_by_type($type)
    {
        $res = $this->db->where('type', $type);
        return $this->db->get('category_main')->row_array($res);
    }

    // 確認分類是否重複
    public function chk_repeat_type($id, $type)
    {
        $this->db->where('type', $type);
        $this->db->where('id !=', $id);
        return $this->db->get('category_main')->row_array();
    }

    // 取得分類清單
    public function get_all()
    {
        $res = $this->db->get('category_main')->result_array();
        return $this->mod_product->get_category_products_total($res);
    }

    // 取得特定分類
    public function get_once($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('category_main')->row_array();
    }

    // 取得分類總筆數
    public function get_total()
    {
        return $this->db->count_all_results('category_main');
    }

    // 新增分類
    public function insert($dataArray)
    {
        return $this->db->insert('category_main', $dataArray);
    }

    // 更新分類
    public function update($id, $dataArray)
    {
        $this->db->where('id', $id);
        return $this->db->update('category_main', $dataArray);
    }

    // 刪除分類
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('category_main');
    }
}
