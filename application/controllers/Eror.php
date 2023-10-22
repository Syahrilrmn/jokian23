<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eror extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('M_login');
		$this->load->model('M_Admin');
	}

	public function index()
	{
		$data['title_web'] = 'Eror | Sistem Informasi Perpustakaan';
		$this->load->view('frontend/eror', $data);
	}
}

