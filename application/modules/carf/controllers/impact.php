<?php
class impact extends AdminController {
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
                $crud->set_subject('(CARF) - Impact Assessment Result');
                $crud->columns('project_name');
                $crud->unset_add();$crud->unset_delete();$crud->unset_list();
                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
                $crud->edit_fields('sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator',
                        'third_party','other_if_any','flag_form','updated_at');
                $crud->display_as('sog_capman','SOG Cap.Man')
                        ->display_as('billing','Billing')
                        ->display_as('engineering','Engineering')
                        ->display_as('vas_eng','VAS Engineering')
                        ->display_as('netplan','Netw. Planning')
                        ->display_as('it_ds','IT DS')
                        ->display_as('bca','BCA')
                        ->display_as('reva','REVA')
                        ->display_as('regulator','Regulatory')
                        ->display_as('third_party','Third Party')
                        ->display_as('other_if_any','Other If any');
        $crud->unset_texteditor('sog_capman','full_text')
            ->unset_texteditor('billing','full_text')
            ->unset_texteditor('engineering','full_text')
            ->unset_texteditor('vas_eng','full_text')
            ->unset_texteditor('netplan','full_text')
            ->unset_texteditor('it_ds','full_text')
            ->unset_texteditor('bca','full_text')
            ->unset_texteditor('reva','full_text')
            ->unset_texteditor('regulator','full_text')
            ->unset_texteditor('third_party','full_text')
            ->unset_texteditor('other_if_any','full_text');
        $crud->change_field_type('flag_form','invisible')
            ->change_field_type('updated_at','invisible');
        $crud->callback_before_update(array($this,'callback_before'));
                $crud->set_lang_string('update_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'carf/compl_lvl/index/edit/'.$this->uri->segment(5).'";
                 </script>
                 <div style="display:none">
                 ');
                $crud->unset_fields('project_name','request_num','mpe_number','drf_num','priority','prod_type_id','req_type_id','mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_category','target_market_id','mention_reg','mention_seg','sp_project_id','sp_project_txt','first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax','cs_tools_needed_id','cs_tools_other','pd_pic','email','mobile','received_date','additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas','additional_modul_vas_orhers','Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow','sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4','sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg','wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info','wording_notif_unreg','when_provided_unreg','wording_notif_others','business_model','business_model_other','prog_mech_note','attachment_id','vas_lvl','vas_conc','vas_dev','device_conc','device_dev','recommendation','service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_cur','cost_deliver','cost_cap_value','approval','created_at','updated_at','user_add','user_update');
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
        $post_array['flag_form'] = 10;
        return $post_array;
    }
}