<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_console extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mod_manager');
        $this->load->model('mod_member');
        $this->load->model('mod_category');
        $this->load->model('mod_product');
        $this->load->model('mod_contact');
    }

    // 刪除管理員
    public function delete_manager()
    {
        $id = $this->input->post('id');

        if ($this->mod_manager->delete($id)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '刪除成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，刪除失敗！';
        }

        echo json_encode($dataResponse);
    }

    // 刪除會員
    public function delete_member()
    {
        $id = $this->input->post('id');

        if ($this->mod_member->delete($id)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '刪除成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，刪除失敗！';
        }

        echo json_encode($dataResponse);
    }

    // 刪除分類
    public function delete_category()
    {
        $id = $this->input->post('id');

        if ($this->mod_category->delete($id)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '刪除成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，刪除失敗！';
        }

        echo json_encode($dataResponse);
    }

    // 刪除商品
    public function delete_product()
    {
        $id = $this->input->post('id');

        if ($this->mod_product->delete($id)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '刪除成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，刪除失敗！';
        }

        echo json_encode($dataResponse);
    }

    // 設定商品上下架
    public function online_product()
    {
        $id = $this->input->post('id');
        $num = $this->input->post('num');

        if ($this->mod_product->set_online($id, $num)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '設定成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，設定失敗！';
        }

        echo json_encode($dataResponse);
    }

    // 設定精選商品
    public function feature_product()
    {
        $id = $this->input->post('id');
        $num = $this->input->post('num');

        if ($this->mod_product->set_feature($id, $num)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '設定成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，設定失敗！';
        }

        echo json_encode($dataResponse);
    }

    // 商品說明上傳圖片
    public function upload_trumbowyg_image()
    {
        if (isset($_FILES)) {
            $dataArray['link'] = 'photos/' . uniqid();

            if ($_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/jpg') {
                if ($_FILES['image']['type'] == 'image/png') {
                    $dataArray['link'] = $dataArray['link'] . '.png';
                } else {
                    $dataArray['link'] = $dataArray['link'] . '.jpg';
                }

                if (!file_exists('photos')) {
                    mkdir('photos', 0777, true);
                }

                if (copy($_FILES['image']['tmp_name'], $dataArray['link'])) {
                    $view_data['sys_code'] = 200;
                    $view_data['sys_msg'] = '圖片新增成功！';
                    $view_data['link'] = $dataArray['link'];
                } else {
                    $view_data['sys_code'] = 500;
                    $view_data['sys_msg'] = '圖片新增失敗！';
                }
            } else {
                $view_data['sys_code'] = 404;
                $view_data['sys_msg'] = '檔案格式不符合！';
            }
        } else {
            $dataArray['link'] = 'assets/img/default.png';
        }

        echo json_encode($view_data);
    }

    // 商品主圖片上傳
    public function upload_main_photo()
    {
        if (isset($_FILES)) {
            $dataArray['main_photo'] = 'photos/' . uniqid();
            $id = $this->input->post('id');
            if ($_FILES['image']['type'] == 'image/png' ||
                $_FILES['image']['type'] == 'image/jpeg' ||
                $_FILES['image']['type'] == 'image/jpg') {
                if ($_FILES['image']['type'] == 'image/png') {
                    $dataArray['main_photo'] = $dataArray['main_photo'] . '.png';
                } else {
                    $dataArray['main_photo'] = $dataArray['main_photo'] . '.jpg';
                }
                if (!file_exists('photos')) {
                    mkdir('photos', 0777, true);
                }
                if (copy($_FILES['image']['tmp_name'], $dataArray['main_photo'])) {
                    $this->mod_product->update($id, $dataArray);
                    $view_data['sys_code'] = 200;
                    $view_data['sys_msg'] = '圖片新增成功...';
                    $view_data['link'] = $dataArray['main_photo'];
                } else {
                    $view_data['sys_code'] = 500;
                    $view_data['sys_msg'] = '圖片新增失敗...';
                }
            } else {
                $view_data['sys_code'] = 404;
                $view_data['sys_msg'] = '檔案格式不符合';
            }
        }

        echo json_encode($view_data);
    }

    // 商品副圖片上傳
    public function upload_sub_photo()
    {
        if (isset($_FILES)) {
            $dataArray['id'] = uniqid();
            $dataArray['product_id'] = $this->input->post('id');
            $dataArray['product_image'] = 'photos/' . $dataArray['id'];
            if ($_FILES['image']['type'] == 'image/png' ||
                $_FILES['image']['type'] == 'image/jpeg' ||
                $_FILES['image']['type'] == 'image/jpg') {
                if ($_FILES['image']['type'] == 'image/png') {
                    $dataArray['product_image'] = $dataArray['product_image'] . '.png';
                } else {
                    $dataArray['product_image'] = $dataArray['product_image'] . '.jpg';
                }
                if (!file_exists('photos')) {
                    mkdir('photos', 0777, true);
                }
                if (copy($_FILES['image']['tmp_name'], $dataArray['product_image'])) {
                    $this->mod_product->insert_sub_photo($dataArray);
                    $view_data['sys_code'] = 200;
                    $view_data['sys_msg'] = '圖片新增成功...';
                    $view_data['link'] = $dataArray['product_image'];
                    $view_data['id'] = $dataArray['id'];
                } else {
                    $view_data['sys_code'] = 500;
                    $view_data['sys_msg'] = '圖片新增失敗...';
                }
            } else {
                $view_data['sys_code'] = 404;
                $view_data['sys_msg'] = '檔案格式不符合';
            }
        }
        echo json_encode($view_data);
    }

    // 刪除商品副圖片
    public function delete_sub_photo()
    {
        $id = $this->input->post('id');
        if ($this->mod_product->delete_sub_photo($id)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '刪除成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，刪除失敗。';
        }

        echo json_encode($dataResponse);
    }

    // 刪除聯絡
    public function delete_contact()
    {
        $id = $this->input->post('id');

        if ($this->mod_contact->delete($id)) {
            $dataResponse['sys_code'] = 200;
            $dataResponse['sys_msg'] = '刪除成功！';
        } else {
            $dataResponse['sys_code'] = 404;
            $dataResponse['sys_msg'] = '發生錯誤，刪除失敗！';
        }

        echo json_encode($dataResponse);
    }
}
