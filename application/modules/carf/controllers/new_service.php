<?php
class capman extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('_m');
    }
    public function index(){
        $id = $this->uri->segment(5);
        $data['info_carf'] = $this->_m->get_carf($id);
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CARF) - Capacity Management PERSON IN CHARGE');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                $crud->edit_fields('pd_pic','received_date');
                $crud->display_as('pd_pic','PD Person In Charge')
                        ->display_as('received_date','Received Date');
                $crud->set_relation('pd_pic','ion_users','username');
                $crud->set_lang_string('update_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'carf/spec_add/index/edit/'.$this->uri->segment(5).'";
                 </script>
                 <div style="display:none">
                 ');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
}