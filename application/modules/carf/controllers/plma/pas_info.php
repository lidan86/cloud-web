<?php
class pas_info extends AdminController {
    public function __construct() {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
    }
    public function index($id=''){
        if($this->session->userdata['group_id'] == '7'){//CMDB
            $data = '';
            $this->template->build('plma/pas_info', $data);
        }
    }
}