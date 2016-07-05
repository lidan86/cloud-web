<?php
class View extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('m_carf');
    }
    public function index($id=''){
        echo $id;
        $data['nomer']=$id;
	$this->template->build('v_read', $data);
    }
    
}