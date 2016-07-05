<?php
class Msg extends MX_Controller {

    public function __construct() {
            parent::__construct();

            Modules::run('auth/make_sure_is_logged_in');

            $this->load->model('m_options');
    }

    public function index(){
        $data['get_msg']= $this->m_options->get_all_msg($this->session->userdata['user_id']);
        echo '123123123123123';
        $this->load->view('v_msg', $data);
    }


}