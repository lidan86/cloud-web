<?php
class compl_lvl extends AdminController {
    public function __construct() {
            parent::__construct();
            Modules::run('auth/make_sure_is_logged_in');
            $this->load->model('_m');
    }
    public function index(){
        $data['id'] = $this->uri->segment(5);
         $id = $this->uri->segment(5);
        $data['info_carf'] = $this->_m->get_carf($id);

        if($this->session->userdata['group_id'] == '6' || $this->session->userdata['group_id'] == '7') {
            $this->template->build('v_compl', $data);
        }else{
            $this->template->build('v_compl_not', $data);
        }
    }
    public function add_data(){
        $data['id'] =  $this->uri->segment(5);

        $this->template->build('v_comp_add',$data);
    }
    public function do_insert(){
        $id = $_POST['carf_id'];
        $compl_lvl = $_POST['category_lvl'];
        $fields = array(
            'carf_id'        => $id,
            'category_lvl'   =>$compl_lvl,
            'category_project'=> 'Vas Project',
            'dcp'           => $_POST['dcp'],
            'dt'            => $_POST['dt'],
            'total_rfs'     => $_POST['total_rfs']

        );
        $this->db->insert('m_complex', $fields);
        $fields1 = array(
            'carf_id'        => $id,
            'category_lvl'   =>$compl_lvl,
            'category_project'=> 'Device Project',
            'dcp'           => $_POST['dcp1'],
            'dt'            => $_POST['dt1'],
            'total_rfs'     => $_POST['total_rfs1']

        );
        $this->db->insert('m_complex', $fields1);
        $fields2 = array(
            'carf_id'        => $id,
            'category_lvl'   =>$compl_lvl,
            'category_project'=> 'Blackberry Project',
            'dcp'           => $_POST['dcp2'],
            'dt'            => $_POST['dt2'],
            'total_rfs'     => $_POST['total_rfs2']

        );
        $this->db->insert('m_complex', $fields2);
        $fields3 = array(
            'carf_id'        => $id,
            'category_lvl'   =>$compl_lvl,
            'category_project'=> 'Mobile Internet Project',
            'dcp'           => $_POST['dcp3'],
            'dt'            => $_POST['dt3'],
            'total_rfs'     => $_POST['total_rfs3']

        );
        $this->db->insert('m_complex', $fields3);
        $fields4 = array(
            'carf_id'        => $id,
            'category_lvl'   =>$compl_lvl,
            'category_project'=> 'Internet Banking Project',
            'dcp'           => $_POST['dcp4'],
            'dt'            => $_POST['dt4'],
            'total_rfs'     => $_POST['total_rfs4']

        );
        $this->db->insert('m_complex', $fields4);
        $flag = array(
            'flag_form'     => 11,
            'updated_at' => date('Y-m-d H:i:s')

        );
        $this->db->where('id', $id);
        $this->db->update('carf', $flag);


        redirect("carf/compl_lvl/index/edit/".$id);
    }
    public function editData($id) {
        $carf =  $this->uri->segment(5);
        $idx = $this->uri->segment(6);
        $queryx = $this->db->query("select * from m_complex WHERE id =".$idx);
        $sqlx = $queryx->result();
        foreach($sqlx as  $row){
            $category_lvl = $row->category_lvl;
            $category_project = $row->category_project;
            $dcp = $row->dcp;
            $dt = $row->dt;
            $total_rfs = $row->total_rfs;
        }

        $data = array(
            'id'=> $idx,
            'carf_id'=> $carf,
            'category_lvl' => $category_lvl,
            'category_project' =>$category_project,
            'dcp' => $dcp,
            'dt' => $dt,
            'total_rfs' => $total_rfs


        );

        $this->template->build('v_comp_edit',$data);
    }
    public function do_update() {
        $id = $_POST['id'];

        $carf_id = $_POST['carf_id'];
        $fields = array(

            'dcp'           => $_POST['dcp'],
            'dt'            => $_POST['dt'],
            'total_rfs'     => $_POST['total_rfs']

        );
        $this->db->where('id', $id);
        $this->db->update('m_complex', $fields);
        $flag = array(
            'flag_form'     => 11,
            'updated_at' => date('Y-m-d H:i:s')

        );
        $this->db->where('id', $id);
        $this->db->update('carf', $flag);

        redirect("carf/compl_lvl/index/edit/".$carf_id);
    }
    public function do_delete() {
        $carf =  $this->uri->segment(5);
        $id =  $this->uri->segment(6);

        $this->db->where('id', $id);
        $this->db->delete('m_complex');

        redirect("carf/compl_lvl/index/edit/".$carf);
    }
}
