<?php
class Mod_product extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // 確認商品標題是否重複
    public function chk_repeat_title($id, $title)
    {
        $this->db->where('title', $title);
        $this->db->where('id !=', $id);
        return $this->db->get('product_main')->row_array();
    }

    // 取得商品清單
    public function get_all()
    {
        return $this->db->get('product_main')->result_array();
    }

    // 取得分類上架商品清單
    public function get_category_all($id)
    {
        if ($id != 'all') {
            $this->db->where('category', $id);
            $this->db->where('online', 1);
        }else {
            $this->db->where('online', 1);

        }

        $this->db->join('category_main', 'category_main.id = product_main.category');
        $res = $this->db->get('product_main')->result_array();
        return $res;
    }

    // 取得特定商品
    public function get_once($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('product_main')->row_array();
    }

    // 取得上架精選商品
    public function get_feature()
    {
        $this->db->where('feature', 1);
        $this->db->where('online', 1);

        return $this->db->get('product_main')->result_array();
    }

    // 取得商品總筆數
    public function get_total()
    {
        return $this->db->count_all_results('product_main');
    }

    // 取得上架商品總筆數
    public function get_online_total()
    {
        $this->db->where('online', 1);

        return $this->db->count_all_results('product_main');
    }

    // 取得各分類上架商品總筆數
    public function get_category_products_total($res)
    {
        foreach ($res as $key => $value) {
            $this->db->where('category', $value['id']);
            $this->db->where('online', 1);

            $res[$key]['total'] = $this->db->count_all_results('product_main');
        }

        return $res;
    }

    // 新增商品
    public function insert($dataArray)
    {
        return $this->db->insert('product_main', $dataArray);
    }

    // 更新商品
    public function update($id, $dataArray)
    {
        $this->db->where('id', $id);

        return $this->db->update('product_main', $dataArray);
    }

    // 刪除商品
    public function delete($id)
    {
        $this->db->where('id', $id);

        return $this->db->delete('product_main');
    }

    // 設定上下架商品
    public function set_online($id, $num)
    {
        $this->db->where('id', $id);

        return $this->db->update('product_main', array('online' => $num));
    }

    // 設定精選商品
    public function set_feature($id, $num)
    {
        $this->db->where('id', $id);

        return $this->db->update('product_main', array('feature' => $num));
    }

    // 取得商品數圖片總數量
    public function get_sub_all_photo($id)
    {
        $this->db->where('product_id', $id);

        return $this->db->get('product_img')->result_array();
    }

    // 新增商品副圖片
    public function insert_sub_photo($dataArray)
    {
        return $this->db->insert('product_img', $dataArray);
    }

    // 刪除商品副圖片
    public function delete_sub_photo($id)
    {
        $this->db->where('id', $id);

        return $this->db->delete('product_img');
    }
}
