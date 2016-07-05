<?php
class dashboard extends AdminController {
    public function __construct() {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
    }
    public function index($id=''){
        if($this->session->userdata['group_id'] == '7'||$this->session->userdata['group_id'] == '9'){
            $data = '';
            $this->template->build('plma/dashboard', $data);
        }
    }
}