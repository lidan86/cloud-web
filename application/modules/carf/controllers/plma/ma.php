<?php
class ma extends AdminController {
    public function __construct() {
        parent::__construct();
        Modules::run('auth/make_sure_is_logged_in');
    }
    public function index($id=''){
        if($this->session->userdata['group_id'] == '9'){//capmanager
            $data = '';
            $this->template->build('plma/ma', $data);
        }
    }
}    