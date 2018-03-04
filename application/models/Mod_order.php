<?php
class Mod_order extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 取得訂單清單
    public function get_all()
    {
        $res =  $this->db->get('order_main')->result_array();
        foreach ($res as $key => $value) {
            $res[$key] = $this->get_sub_once($value);
        }
        return $res;
    }

    // 取得特定訂單
    public function get_once($id)
    {
        $this->db->where('id', $id);
        $res = $this->db->get('order_main')->row_array();
        return $this->get_sub_once($res);
    }

    // 取得特定訂單副表
    public function get_sub_once($res)
    {
        $this->db->where('order_id', $res['id']);
        $res['sub_order'] = $this->db->get('order_sub')->result_array();
        $res['total'] = 0;

        foreach ($res['sub_order'] as $key => $value) {
            $res['total'] += $value['product_price'] * $value['product_qty'];
        }
        return $res;
    }

    // 取得訂單總筆數
    public function get_total()
    {
        return $this->db->count_all_results('order_main');
    }

    // 新增訂單
    public function insert($dataArray)
    {
        return $this->db->insert('order_main', $dataArray);
    }

    // 更新訂單
    public function update($id, $dataArray)
    {
        $this->db->where('id', $id);
        return $this->db->update('order_main', $dataArray);
    }

    // 刪除訂單
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('order_main');
    }
}
