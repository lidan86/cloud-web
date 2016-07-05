<?php
class Home extends MX_Controller {

	public function __construct() {

		parent::__construct();

		Modules::run('auth/make_sure_is_logged_in');
		$this->load->model('home_m');
	}

	public function index(){
		if($this->session->userdata['group_id'] == '1' || $this->session->userdata['group_id'] == '9'){//administrator
			$this->template->parentTitle('');
			$this->template->title('Capacity Management Tools');

			$data = [];
			$data['active'] = '';
			$this->template->set_metadata('', base_url().'_assets/js/ol.js', 'js');

			$this->template->build('v_index', $data);
		}else{
			redirect("carf");
		}

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
