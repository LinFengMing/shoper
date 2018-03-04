<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Welcome extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
		parent::__construct();

		$this->load->model('mod_product');
	}

	// 前台首頁
	public function index()
	{
        // 頁面資訊
		$view_data = array(
			'title' => "Shoper",
			'path' => 'index',
			'page' => 'store.php',
			'menu' => 'index',
		);

		$view_data['feature'] = $this->mod_product->get_feature();

		$this->load->view('layout', $view_data);
	}
}
