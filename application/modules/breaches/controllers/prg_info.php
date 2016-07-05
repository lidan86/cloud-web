<?php
class prg_info extends AdminController {
    private $data;
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('_m');
    }  
    public function index(){
        $crud =  new grocery_CRUD();
                $crud->set_table('carf');
                $crud->set_subject('(CARF) - Program Information');
        $crud->unset_edit();
                $crud->unset_add();$crud->unset_delete();$crud->unset_list();
                $crud->unset_export();$crud->unset_print();
                $crud->unset_back_to_list();
        $state = $crud->getState();
        $state_info = $crud->getStateInfo();        
        if($state == 'add'){
                //Do your cool stuff here . You don't need any State info you are in add
            }
            elseif($state == 'edit'){
                $primary_key = $state_info->primary_key;
                $crud->field_type('mpe_number', 'integer');
                $crud->field_type('drf_num', 'integer');
                $crud->field_type('tld', 'date');
                $crud->field_type('ttd', 'date');
                $crud->required_fields('project_name','mpe_number','drf_num','priority','prod_type_id',
                    'mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_category',
                    'target_market_id','mention_seg'); 
                $crud->fields('project_name','mpe_number','drf_num','priority','prod_type_id','req_type_id',
                    'mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_category',
                    'target_market_id','mention_reg','mention_seg');
            }
            else {
                $crud->unset_fields('request_num','sp_project_id','sp_project_txt','first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax','cs_tools_needed_id','cs_tools_other','pd_pic','email','mobile','received_date','additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas','additional_modul_vas_orhers','Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow','sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4','sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg','wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info','wording_notif_unreg','when_provided_unreg','wording_notif_others','business_model','business_model_other','prog_mech_note','attachment_id','sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator','third_party','other_if_any','vas_lvl','vas_conc','vas_dev','device_conc','device_dev','recommendation','service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_cur','cost_deliver','cost_cap_value','approval','created_at','updated_at','user_add','user_update');
            }
        $crud->display_as('project_name','Project Name')
            ->display_as('mpe_number','MPE Number')
            ->display_as('drf_num','DRF Number')
            ->display_as('priority','Priority')
            ->display_as('prod_type_id','Product Type')

            ->display_as('mention_req','Pls. Mention the change (Update)')
            ->display_as('pic_prod_owner_id','PIC / Product Owner')
            ->display_as('tld','Target Launch Date')
            ->display_as('ttd','Target Termination Date')
            ->display_as('program_desc','Program Description')
            ->display_as('objective_id','Objective')
            ->display_as('target_market_category','Target Market Customer Category')
            ->display_as('target_market_id','Target Market Customer')
            ->display_as('mention_reg','If Region pls mention')
            ->display_as('mention_seg','Segment community based');
        $crud->change_field_type('req_type_id','invisible');
                $crud->set_lang_string('update_success_message',
                 'Your data has been successfully stored into the database.<br/>Please wait while you are redirecting to the list page.
                 <script type="text/javascript">
                  window.location = "'.base_url().'carf/traffic_proj/index/edit/'.$this->uri->segment(5).'";
                 </script>
                 <div style="display:none">
                 ');
                
               $crud->set_relation_n_n('prod_type_id','r_master_carf','m_prod_type','carf_id','prod_type_id','name');
        $crud->set_relation_n_n('objective_id','r_master_carf','m_pi_obj','carf_id','pi_obj_id','name');
        $crud->set_relation('target_market_id','m_pi_prepaid','name');
        $crud->set_relation_n_n('mention_reg','r_master_carf','m_region_reg','carf_id','pi_reg_poc','region_name');
        $crud->callback_before_update(array($this,'callback_before'));
        $crud->callback_edit_field('project_name',array($this,'edit_field_project_name'));
        $url_link = "href='".base_url()."breaches/chart'";

        $data['newbutton']='<button type="button" class="btn btn-success" onclick="location.'.$url_link.'">Chart</button>';

        try{
                        $data['gcrud'] = $crud->render();
                    } catch(Exception $e) {
                        if($e->getCode() == 14) //The 14 is the code of the "You don't have permissions" error on grocery CRUD.
                    {
                        redirect(base_url().'breaches');
                    }else{
                        show_error($e->getMessage());
                    }
                    }
//                $data['gcrud'] = $crud->render();
		$this->template->build('v_index', $data);
    }
    function callback_before($post_array,$primary_key) {

        $post_array['req_type_id'] = 'Change - Update';
        return $post_array;
    }
    function field_tld($value = '', $primary_key = null){
        $tampil=  '<input value="'.$value.'" maxlength="10" type="text" id="fromtld" name="fromtld"/>'
                . '';
        return $tampil;
    }
    function field_ttd($value = '', $primary_key = null){
        $tampil=  '<input value="'.$value.'" maxlength="10" type="text" id="tottd" name="tottd"/>'
                . '';
        return $tampil;
    }
    function edit_field_project_name($value, $primary_key){
    return '<input type="text" maxlength="50" value="'.$value.'" name="project_name"> Request Number :'.date("Ymd").$primary_key;
    }    
    
//'project_name','request_num','mpe_number','drf_num','priority','prod_type_id','req_type_id','mention_req','pic_prod_owner_id','tld','ttd','program_desc','objective_id','target_market_category','target_market_id','mention_reg','mention_seg','sp_project_id','sp_project_txt','first_reg','charging_by','charging_by_notes','recurring_model','recurring_period','registration_chan','tarif_information','tarif_p1','tarif_p1_tax','tarif_p2','tarif_p2_tax','tarif_p3','tarif_p3_tax','cs_tools_needed_id','cs_tools_other','pd_pic','email','mobile','received_date','additional_modul_mobile','additional_modul_mobile_others','roaming_int_mobile','roaming_int_mobile_other','additional_modul_broadband','additional_modul_broadband_other','roaming_int_broadband','roaming_int_broadband_others','srv_param','additional_modul_blackberry','other_modul_blackberry','roaming_int_blackberry','additional_modul_vas','additional_modul_vas_orhers','Subscriber_benefit','user_requirement','key_com_tag','media_prog_launch','media_ongoing_basic','general_flow','sms_reg_p1','sms_reg_p2','sms_reg_p3','sms_reg_p4','sms_reg_p5','sms_unreg_p1','sms_unreg_p2','sms_unreg_p3','sms_unreg_p4','sms_unreg_p5','query_info','query_usage','sdc','sdc_int_roaming','if_not_avaliable','wording_notif_reg','when_provided_reg','wording_notif_recur','when_provided_recur','query_info_layanan','query_info_quota','query_info_usage','when_provided_info','wording_notif_unreg','when_provided_unreg','wording_notif_others','business_model','business_model_other','prog_mech_note','attachment_id','sog_capman','billing','engineering','vas_eng','netplan','it_ds','bca','reva','regulator','third_party','other_if_any','vas_lvl','vas_conc','vas_dev','device_conc','device_dev','recommendation','service_path_desc','system_net_element impact','it_service_path','it_system_desc','it_tottal_subs','it_sub_with_events','it_increase_tps','net_traffic_erlang','net_throughput','net_tot_subs','net_subs_events','prod_dev_req','it_cap_assessment','it_cap_available','it_cap_not_available','it_cap_par_available','it_cap_cond_available','net_cap_available','net_cap_not_available','net_cap_par_available','net_cap_cond_available','res_cap_across','net_element_resevation','cons_reserv','dr_withdrawn','dr_approved','dr_reject','dr_partially','cost_cur','cost_deliver','cost_cap_value','approval','created_at','updated_at','user_add','user_update'
}