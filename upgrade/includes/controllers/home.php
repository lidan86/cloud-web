<?php
class Home extends Controller {

	function Home()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	function step_1()
	{
		$this->step_2();
	}
	
	function step_2()
	{
		$this->load->database();
		$this->load->dbforge();
		
		$this->checkForIncorrectVersionNumber();
		
		// loop through and run all updates
		while($this->_runUpgradeProcess())
		{
			continue;
		}
		
		$this->load->view('header');
		$this->load->view('upgrade/step2');
		$this->load->view('footer');
	}
	
	function checkForIncorrectVersionNumber()
	{
	    $q = $this->db->get_where('config', array('name' => '_db_version'))->row();
		
		//FIXME - Will be removing if there is a RC2 release.
	    if($q->value == '2.0.0,0.2.0.0')
	    {
    	    $data = array('value' => '2.0.0,0.0.2.0');
        	$this->db->where('name', '_db_version')->update('config', $data);
	    }
	}
	
	function _runUpgradeProcess()
	{
		$ver = $this->_getDbVersion();
		if($ver != $this->_getFileVersion())
		{
			include(APPPATH.'sql/sql_'.$ver.'.php');
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function _getDbVersion()
	{
		if($this->db->get_where('config', array('name' => '_db_version'))->num_rows() == 0)
		{
			// return original upgrade path
			return '2.0.0,0.0.1.0';
		}
		return @$this->db->get_where('config', array('name' => '_db_version'))->row()->value;
	}
	
	function _getFileVersion()
	{
	    include('../xu_ver.php');
		return $version;
	}
}
