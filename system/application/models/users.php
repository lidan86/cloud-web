<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * XtraUpload
 *
 * A turn-key open source web 2.0 PHP file uploading package requiring PHP v5
 *
 * @package		XtraUpload
 * @author		Matthew Glinski
 * @copyright	Copyright (c) 2006, XtraFile.com
 * @license		http://xtrafile.com/docs/license
 * @link		http://xtrafile.com
 * @since		Version 2.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * XtraUpload Users Model
 *
 * @package		XtraUpload
 * @subpackage	Model
 * @category	Model
 * @author		Matthew Glinski
 * @link		http://xtrafile.com/docs/pages/files
 */

// ------------------------------------------------------------------------

class Users extends Model 
{
    var $loggedin = false;

	// ------------------------------------------------------------------------
	
    public function Users()
    {
        // Call the Model constructor
        parent::Model();
		$this->checkUserAuth();
    }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->getUserById()
	 *
	 * Load a user object by id
	 *
	 * @access	public
	 * @param	string
	 * @return	none
	 */
	public function getUserById($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row();
	}
    
	// ------------------------------------------------------------------------
	
	/**
	 * Users->checkUserAuth()
	 *
	 * Load a view variable to see if the user is logged in
	 *
	 * @access	public
	 * @param	string
	 * @return	none
	 */
    public function checkUserAuth()
    {
		if($this->session->userdata('id'))
		{
			$this->load->vars(array('loggedin' => true));
			$this->loggedin = true;
		}
		else
		{
			$this->load->vars(array('loggedin' => false));
			if(!stristr($this->uri->uri_string(),'/user/login'))
			{
				// Force all users to login by uncommenting the following line
				//redirect('/user/login');
			}
		}
    }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->getUsernameById()
	 *
	 * Get a username from a user id
	 *
	 * @access	public
	 * @param	int
	 * @return	none
	 */
	public function getUsernameById($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		if($query->num_rows() != '1')
		{
			return 'Anonymous';
		}
		return $query->row()->username;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->userLogout()
	 *
	 * Log the user out
	 *
	 * @access	public
	 * @return	none
	 */
	public function userLogout()
    {
		$this->session->sess_destroy();
		return true;
    }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->userUpdate()
	 *
	 * Update the user entry in the DB with new entries
	 *
	 * @access	public
	 * @param	array
	 * @return	none
	 */
	public function userUpdate($data)
	{
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('users', $data); 
		return true;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->userUpdateForgot()
	 *
	 * Save a new password to the user account
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	none
	 */
	public function userUpdateForgot($pass, $username)
	{
		$this->db->where('username', $username);
		$this->db->update('users', array('password' => $pass)); 
		return true;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->processLogin()
	 *
	 * Run a login attempt
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	none
	 */
	public function processLogin($user, $pass)
	{
		// Check if user exists in DB 
		$query = $this->db->get_where('users', array('username' => $user, 'status' => 1, 'password' => md5($this->config->config['encryption_key'].$pass)));
		$num = $query->num_rows();
		
		// If there is a user
		if($num == 1)
		{
			// Get user data and setup session
			$userData = $query->row();
			
			$newdata = array(
					   'username'  	=> $user,
					   'id'			=> $userData->id,
					   'group'		=> $userData->group,
					   'email'     	=> $userData->email,
					   'loggedin'	=> TRUE,
					   'login'		=> TRUE,
					   'ip_logged'	=> FALSE
				   );
	
			$this->session->set_userdata($newdata);
			return true;
		}
		else
		{
			return false;
		}
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->genPass()
	 *
	 * Generate a password
	 * DEPERICIATED
	 *
	 * @access	public
	 * @param	string
	 * @param	bool
	 * @return	none
	 */
	public function genPass($length, $caps=true)
	{
		// Depriciated, use the refrenced function
		return $this->functions->genPass($length, $caps);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Users->newUser()
	 *
	 * Save the new user to the database and send them an email
	 *
	 * @access	public
	 * @param	array
	 * @param	bool
	 * @return	none
	 */
	public function newUser($data, $pay=false)
	{
		
		// save the new user to the DB
		$this->db->insert('users', $data);
		$id = $this->db->insert_id();
		
		if(!$pay)
		{
			$to = $data['email'];
			$user = $this->db->get_where('users', array('id' => $id))->row();
			$group = $this->db->get_where('groups', array('id' => $user->group))->row();
			$this->sendNewUserEmail($to, $user, $group);
		}
		else
		{
			$to = $data['email'];
			$user = $this->db->get_where('users', array('id' => $id))->row();
			$this->sendPayLinkEmail($to, $user, $id);
		}
		
		return $id;
	}
	
	public function sendNewUserEmail($to, $user, $group)
	{
		// Load the email library
		$this->load->library('email');
		
		// Setup the mail library
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		$rec = array(
			'd' => 'Daily',
			'w' => 'Weekly',
			'm' => 'Monthly',
			'y' => 'Yearly',
			'dy' => 'Bi-Yearly',
		);
		
		// Set email options
		$this->email->from($this->startup->site_config['site_email'], $this->startup->site_config['sitename'].' Support');
		$this->email->to($to);
		$this->email->subject('New user at '.$this->startup->site_config['sitename'].'!');
		
		$msg = 'Hello '.$user->username.',<br />Welcome to '.$this->startup->site_config['sitename'].'!<br /><br />Here are your account details should you ever need them:<br /><br />--------------------------<br />Username: '.$user->username.'<br />Group: '.ucwords($group->name).'<br />';

		if($group->price > 0.00)
		{
			$msg .= 'Ammount Paid: '.$group->price.'<br />';
			if($group->repeat_billing)
			{
				$msg .= 'Billing Period: '.$rec[$group->repeat_billing].'<br />';
			}
		}
		
		$msg .= '--------------------------<br /><br />Thanks for joining our community!<br />'.$this->startup->site_config['sitename'].' Administration';

		$this->email->message($msg);
		
		// Send the email
		$this->email->send();
	}
	
	public function sendPayLinkEmail($to, $user, $id)
	{
		// Load the email library
		$this->load->library('email');
		
		// Setup the mail library
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		
		// Set email options
		$this->email->from($this->startup->site_config['site_email'], $this->startup->site_config['sitename'].' Support');
		$this->email->to($to);
		$this->email->subject('New user at '.$this->startup->site_config['sitename'].'!');
		
		$msg = 'Hello '.$user->username.',<br />Welcome to '.$this->startup->site_config['sitename'].'!<br /><br />Before you account is activated you need to pay using the following link. If you have already completed the payment process, please wait while we authorize your payment. Once complete you will recive a new email containg your details.<br /><br /><a href="'.site_url('user/pay_new/'.$id.'/'.$user->gateway).'">Pay Here</a><br /><br />Thanks for joining our community!<br />'.$this->startup->site_config['sitename'].' Administration';

		$this->email->message($msg);
		
		// Send the email
		$this->email->send();
	}
}
