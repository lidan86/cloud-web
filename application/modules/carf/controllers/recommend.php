<?php
class recommend extends AdminController {
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
                $crud->set_subject('(CARF) - Recommendation');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_list();
                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                $crud->edit_fields('recommendation','flag_form','updated_at');
        $crud->unset_texteditor('recommendation','full_text');
        $crud->callback_before_update(array($this,'callback_before'));
        $crud->change_field_type('flag_form','invisible')
            ->change_field_type('updated_at','invisible');
                $crud->set_lang_string('update_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'carf";
                 </script>
                 <div style="display:none">
                 ');
                $crud->unset_fields(
                        'project_name','mpe_number','drf_num','priority','prod_type_id','req_type_id','mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_prepaid_id','mention_reg_prep','mention_seg_prep','target_market_postpaid_id','mention_reg_post','mention_seg_post',
                        'sp_project_txt',
                        'first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax',
                        'cs_tools_needed_id','cs_tools_other',
                        'pd_pic','received_date',
                        'additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas_orhers',
                        'Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow','sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4','sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg','wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info','wording_notif_unreg','when_provided_unreg','wording_notif_others',
                        'business_model','business_model_other',
                        'sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator','third_party','other_if_any',
                        'vas_low_conc','vas_low_dev','vas_med_conc','vas_med_dev','vas_high_conc','vas_high_dev','device_low_conc','device_low_dev','device_med_conc','device_med_dev','device_high_conc','device_high_dev',
//                        'recommendation',
                        'request_num','sp_project_id','email','mobile','additional_modul_vas','prog_mech_note','attachment_id','service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_deliver','cost_cap_value',
                        'approval','created_at','user_add','updated_at','user_update'
                        );
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

        $post_array['flag_form'] = 12;
        return $post_array;
    }
}