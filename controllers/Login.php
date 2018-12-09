<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();    
        $this->load->model(array('common/insert_model', 'common/edit_model', 'common/custom_methods_model','Message'));      
    }

    public function index() {
        $data = array();      
        $data['company_name'] = "SAN Bricks";
        $this->load->view('login/index', $data);
    }
	
	function validate_mobile_number($phoneNumber)
    {
        if (!empty($phoneNumber)) // phone number is not empty
        {
            if (preg_match('/^\d{11}$/', $phoneNumber)) // phone number is valid
            {
                return true;
                // your other code here
            } else // phone number is not valid
            {
                return false;
            }
        } else // phone number is empty
        {
            return false;
        }
    }
	
	function random_password($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
    }
	
	public function forgot_password() {
		if($_POST){
			$user_name = $this->input->post("user_name");
			$is_authenticated = $this->custom_methods_model->num_of_data("tbl_user", "WHERE user_name='$user_name'");
            if ($is_authenticated > 0) {
               $user_info = $this->custom_methods_model->select_row_by_condition("tbl_user", "user_name='$user_name'");
			   if ($this->validate_mobile_number($user_info[0]->mobile)) {
				    $new_pass = $this->random_password(8);	
                    // echo $new_pass;
					// die;
                    $mdata = array();
					$mdata['user_id'] = $user_info[0]->id;
					$mdata['old_pass'] = $user_info[0]->user_password;
					$mdata['new_pass'] = md5($new_pass);
					$mdata['date'] = date('Y-m-d H:i:s');
					$this->db->insert("tbl_user_pass_history", $mdata);
				   
				    $data = array();	
				    $data['user_password'] =   md5($new_pass);
				    $data['id'] = $user_info[0]->id;
				    $this->db->where('id', $data['id']);
				    $this->db->update('tbl_user', $data);
					
					
				    $sms_info = array();
					$sms_info['message'] = "You have successfully forgot your password. Your Password is : '" . $new_pass . "'. Thank You, School360° Team";
					$sms_info['numbers'] = "88" . $user_info[0]->mobile;
					$status = $this->Message->sms_send($sms_info);
					
					if($status){
						 $sdata['message'] = "Your password has been send by a SMS.";
						 $this->session->set_userdata($sdata);
						 redirect("login/forgot_password");
					}else{
						$sdata['exception'] = "Some error occurred.";
					    $this->session->set_userdata($sdata);
					    redirect("login/forgot_password");
					}
					
			   }else{
				   $sdata['exception'] = "User Mobile Number Not Valid!";
				   $this->session->set_userdata($sdata);
				   redirect("login/forgot_password");
			   }			  
		    }else{
				$sdata['exception'] = "User Name did not match!";
				$this->session->set_userdata($sdata);
				redirect("login/forgot_password");
			}
		}
        $data = array();
        $contact_info = $this->db->query("SELECT school_name FROM tbl_contact_info")->result_array();
        $data['school_name'] = $contact_info[0]['school_name'];
        $this->load->view('login/forgot_password', $data);
    }

    public function authentication() {

        $user_name = $this->input->post("user_name");
        $password = $this->input->post("password");
        $password = md5($password);
        $is_authenticated = $this->custom_methods_model->num_of_data("tbl_user", "WHERE user_name='$user_name' AND user_password='$password'");
        if ($is_authenticated > 0) {
            $user_info = $this->custom_methods_model->select_row_by_condition("tbl_user", "user_name='$user_name' AND user_password='$password'");
			$this->session->set_userdata('user_info', $user_info);
            redirect("dashboard/index");
        } else {
            $sdata['exception'] = "User Name or Password did not match!";
            $this->session->set_userdata($sdata);
            redirect("login/index");
        }
    }
	


    public function logout() {
        $this->session->unset_userdata('user_info');
        $sdata['message'] = "You are logged out";
        $this->session->set_userdata($sdata);
        redirect("login/index");
    }

    public function denied() {
        $data['title'] = 'Access denied';
        $data['heading_msg'] = 'Access denied';
        $data['maincontent'] = $this->load->view('login/denied', '', true);
        $this->load->view('admin_logins/index', $data);
    }
	public function change_password($user_id = null){
		if($_POST){		
		   $user_id = $this->input->post("user_id");
		   $password = $this->input->post("current_pass");
           $password = md5($password);
		   $is_authenticated = $this->custom_methods_model->num_of_data("tbl_user", "WHERE id='$user_id' AND user_password='$password'");
		   if ($is_authenticated > 0) {
               $data = array();	
			   $data['user_password'] = md5($this->input->post("new_pass"));
			   $data['id'] = $user_id;
			   $this->db->where('id', $data['id']);
               $this->db->update('tbl_user', $data);
			   $sdata['message'] = "You are Successfully Password Changes.";
               $this->session->set_userdata($sdata);
               redirect("login/change_password/".$user_id);
			}else {
				$sdata['exception'] = "Sorry Current Password Does'nt Match !";
				$this->session->set_userdata($sdata);
				redirect("login/change_password/".$user_id);
			}
		}else{
			$data['title'] = 'Change Password';
            $data['heading_msg'] = "Change Password";   
            $data['user_id'] = $user_id;
            $data['top_menu'] = $this->load->view('users/user_menu', '', true);
            $data['maincontent'] = $this->load->view('login/change_password', $data, true);
            $this->load->view('admin_logins/index', $data);
		}
	}


    public function student_guardian_login()
    {
        $data = array();
        $data['title'] = 'Login to Student and Guardian Panel';
        $data['heading_msg'] = "Login to Student and Guardian Panel";
        $this->load->view('student_guardian_panels/login', $data);
    }

    public function student_guardian_login_authentication() {
        $user_name = $this->input->post("user_name");
        $password = $this->input->post("password");
        $password = md5($password);
        $is_authenticated = $this->custom_methods_model->num_of_data("tbl_student", "WHERE (student_code='$user_name' or guardian_mobile='$user_name') AND password='$password'");
        if ($is_authenticated > 0) {
            $student_info = $this->custom_methods_model->select_row_by_condition("tbl_student", "(student_code='$user_name' or guardian_mobile='$user_name') AND password='$password'");
            $this->session->set_userdata('student_info', $student_info);
            redirect("student_guardian_panels/index");
        } else {
            $sdata['exception'] = "Student ID / Mobile or Password did not match !";
            $this->session->set_userdata($sdata);
            redirect("login/student_guardian_login");
        }
    }

    public function student_guardian_logout() {
        $this->session->unset_userdata('student_info');
        $sdata['message'] = "You are logged out";
        $this->session->set_userdata($sdata);
        redirect("login/student_guardian_login");
    }


}













