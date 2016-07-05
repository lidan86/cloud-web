<?php
class bau_request extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('_m');
    }
    public function index(){
        $crud = $this->new_crud();
                $crud->set_table('carf');
                $crud->set_subject('(CARF) - Communication Plan & User Experience');
                $crud->columns('project_name');
//                $crud->unset_add();$crud->unset_delete();$crud->unset_read();$crud->unset_list();
//                $crud->unset_export();$crud->unset_print();
//                $crud->unset_back_to_list();
//                $crud->edit_fields('service_path_desc','system_net_element','it_service_path','it_system_desc','it_tottal_subs',	
//                        'it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs',
//                        'net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available',
//                        'it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available',
//                        'net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation',
//                        'cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value');
                $data['gcrud'] = $crud->render();
		$this->template->build('v_form', $data);
    }
}