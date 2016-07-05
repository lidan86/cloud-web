<?php
class Dashboard extends MX_Controller {

	public function __construct() {

		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
		$this->load->model('dashboard_m');
	}

	/**
	 *
     */
	public function index(){


		$data = $this->dashboard_m->getTest();

		$this->template->build('v_index',  array('data' => $data));
	}

	public function change($lang = "english", $class, $method='', $param=""){
		/* $this->config->set_item('lang', $lang); */
		$this->session->set_userdata('lang',$lang);
		$this->lang->is_loaded = array();
		$this->lang->language = array();
		/* $this->lang->load('form_validation', $type);
		$this->lang->load('message', $type); */

		if(empty($method)) $method = 'index';
			redirect("/".$class."/".$method."/".$param);
	}
}
