<?php
class com_plan extends AdminController {
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
                $crud->set_subject('(CARF) - Communication Plan & User Experience');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_list();
                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                $crud->edit_fields('Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow',
                        'sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4',
                        'sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg',
                        'wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info',
                        'wording_notif_unreg','when_provided_unreg','wording_notif_others','flag_form','updated_at');
                $crud->display_as('Subscriber_benefit','Objective / Subscriber Benefit')
                    ->display_as('user_requirement','User Requirement')
                    ->display_as('key_com_tag','Key Communication/tagline')
                    ->display_as('media_prog_launch','Media for Program Launch')
                    ->display_as('media_ongoing_basic','Media for on-going basis')
                    ->display_as('general_flow','General flow of purchasing')
                    ->display_as('sms_reg_p1','Registration Keyword P1')
                    ->display_as('sms_reg_p2','Registration Keyword P2')
                    ->display_as('sms_reg_p3','Registration Keyword P3')
                    ->display_as('sms_reg_p4','Registration Keyword P4')
                    ->display_as('sms_reg_p5','Registration Keyword P5')
                    ->display_as('sms_unreg_p1','Un-Registration Keyword P1')
                    ->display_as('sms_unreg_p2','Un-Registration Keyword P2')
                    ->display_as('sms_unreg_p3','Un-Registration Keyword P3')
                    ->display_as('sms_unreg_p4','Un-Registration Keyword P4')
                    ->display_as('sms_unreg_p5','Un-Registration Keyword P5')
                    ->display_as('query_info','Query Info')
                    ->display_as('query_usage','Query Usage')
                    ->display_as('sdc','SDC for Registration & unregistration')
                    ->display_as('sdc_int_roaming','SDC International Roaming')
                    ->display_as('if_not_avaliable','if still not available, when will be provided ?')
                    ->display_as('wording_notif_reg','Wording Notification Registration')
                    ->display_as('when_provided_reg','When will be provided ?')
                    ->display_as('wording_notif_recur','Wording Notification Recurring')
                    ->display_as('when_provided_recur','When will be provided ?')
                    ->display_as('query_info_layanan','Info Layanan')
                    ->display_as('query_info_quota','Info Quota')
                    ->display_as('query_info_usage','Info Usage')
                    ->display_as('when_provided_info','When will be provided ?')
                    ->display_as('wording_notif_unreg','Wording Notification Unregistration')
                    ->display_as('when_provided_unreg','When will be provided ?')
                    ->display_as('wording_notif_others','Others Wording Notification');
        $crud->unset_texteditor('Subscriber_benefit','full_text')
            ->unset_texteditor('wording_notif_others','full_text')
            ->unset_texteditor('user_requirement','full_text')
            ->unset_texteditor('general_flow','full_text');
        $crud->set_relation('media_prog_launch','m_media','name');
        $crud->set_relation('media_ongoing_basic','m_media','name');
        $crud->set_relation('wording_notif_reg','m_wording_notif','name');
        $crud->set_relation('wording_notif_recur','m_wording_notif','name');
        $crud->change_field_type('flag_form','invisible')
            ->change_field_type('updated_at','invisible');
        $crud->callback_before_update(array($this,'callback_before'));
                $crud->set_lang_string('update_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'carf/bus_mod/index/edit/'.$this->uri->segment(5).'";
                 </script>
                 <div style="display:none">
                 ');
                $crud->unset_fields('project_name','request_num','mpe_number','drf_num','priority','prod_type_id','req_type_id','mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_category','target_market_id','mention_reg','mention_seg','sp_project_id','sp_project_txt','first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax','cs_tools_needed_id','cs_tools_other','pd_pic','email','mobile','received_date','additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas','additional_modul_vas_orhers','business_model','business_model_other','prog_mech_note','attachment_id','sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator','third_party','other_if_any','vas_lvl','vas_conc','vas_dev','device_conc','device_dev','recommendation','service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_cur','cost_deliver','cost_cap_value','approval','created_at','updated_at','user_add','user_update');
                try{
                        $data['gcrud'] = $crud->render();
                    } catch(Exception $e) {
                        if($e->getCode() == 14) //The 14 is the code of the "You don't have permissions" error on grocery CRUD.
                    {
                        redirect(base_url().'carf');
                    }else{
                        show_error($e->getMessage());
                    }
                    }
		$this->template->build('v_form', $data);

    }
    function callback_before($post_array,$primary_key) {

        $post_array['updated_at'] = date('Y-m-d H:i:s');
        $post_array['flag_form'] = 7;
        return $post_array;
    }
}