<?php

class Message extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library(array('session'));
        date_default_timezone_set('Asia/Dhaka');
    }

    function get_student_info_by_student_id($data)
    {
        $this->db->select('s.*');
        $this->db->from('tbl_student as s');
        $this->db->where('s.class_id', $data['class_id']);
        $this->db->where('s.section_id', $data['section_id']);
        $this->db->where('s.group', $data['group_id']);
        $this->db->where('s.status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_all_teachers()
    {
        $this->db->select('tbl_teacher.*,tp.name as post_name,ts.name as section_name');
        $this->db->from('tbl_teacher');
        $this->db->join('tbl_teacher_post AS tp', 'tbl_teacher.post=tp.id');
        $this->db->join('tbl_teacher_section AS ts', 'tbl_teacher.section=ts.id');
        $this->db->where('tbl_teacher.status', 1);
        $this->db->order_by("tbl_teacher.id", "asc");
        $query = $this->db->get();
        return $query->result_array();
    }


    function single_sms_send($sms_info)
    {
        $message_config = $this->db->query("SELECT * FROM tbl_message_config")->result_array();
        if(empty($message_config)){
            $sdata['exception'] = "Message panel configuration not found to database.";
            $this->session->set_userdata($sdata);
            redirect("dashboard/index");
        }

        $server_url = $message_config[0]['server_url'];
        $api_key = $message_config[0]['api_key'];
        $form_number = $message_config[0]['form_number'];


        $contact = $sms_info['number'];
        $from = $form_number;
        $sms_text = $sms_info['message'];
        //echo $sms_text;
        //die;

        $ch = "$server_url/smsapi?api_key=$api_key&type=text&contacts=$contact&senderid=$from&msg=" . urlencode($sms_text);
        ///echo $ch;
       // die;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $ch);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        //print $result;
        //die;

        $cdata = array();
        $cdata['sms_shoot_id'] = $result;
        $cdata['date'] = date('Y-m-d H:i:s');
        if ($this->db->insert('tbl_message_sms_shoot', $cdata)) {
            return true;
        }
    }


    function sms_send($sms_info)
    {
        $message_config = $this->db->query("SELECT * FROM tbl_message_config")->result_array();
        if(empty($message_config)){
            $sdata['exception'] = "Message panel configuration not found to database.";
            $this->session->set_userdata($sdata);
            redirect("dashboard/index");
        }

        $server_url = $message_config[0]['server_url'];
        $api_key = $message_config[0]['api_key'];
        $form_number = $message_config[0]['form_number'];

        //sms send       
        $contact = $sms_info['numbers'];
        $from = $form_number;
        $sms_text = $sms_info['message'];
        $is_bangla_sms = $sms_info['is_bangla_sms'];
        if ($is_bangla_sms == 0) {
            $ch = "$server_url/smsapi?api_key=$api_key&type=text&contacts=$contact&senderid=$from&msg=" . urlencode($sms_text);
        } else {
            $ch = "$server_url/smsapi?api_key=$api_key&type=text/unicode&contacts=$contact&senderid=$from&msg=" . urlencode($sms_text);
        }
        //echo $ch;
        //die;

        // echo $ch;
        //die;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $ch);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        //echo ($result);
        //die;
        curl_close($curl);
        //end sms send
        $cdata = array();
        $cdata['sms_shoot_id'] = $result;
        $cdata['date'] = date('Y-m-d H:i:s');
        if ($this->db->insert('tbl_message_sms_shoot', $cdata)) {
            return true;
        }
    }

    function DoCommonInsert($data, $tableName)
    {
        /* echo '<pre>';
        print_r($data);
        echo $tableName;
        die(); */
        $this->db->set($data);
        $insertresult = $this->db->insert($tableName);
        if ($insertresult) {
            $return['status'] = 1;
        } else {
            $return['status'] = 0;
        }
        return $return;
    }


    //////// edit by dip (07-06-17)////////////////
    function GetStudentInfoByBirthday()
    {
        /* SELECT tbl_class.name,tbl_section.name,tbl_student_group.name,tbl_student.id,tbl_student.name,tbl_student.roll_no,tbl_student.gender,tbl_student.guardian_mobile FROM
        tbl_student AS a INNER JOIN tbl_class AS b ON b.id=a.class_id
INNER JOIN tbl_section AS c ON c.id=a.section_id
INNER JOIN tbl_student_group AS d ON d.id=a.group WHERE date_of_birth='1992-10-02' */

        $date = date('m-d');
        $this->db->select('tbl_class.id AS classId,tbl_class.name as class,tbl_section.id AS sectionId,tbl_section.name as section,tbl_student_group.id AS groupId,tbl_student_group.name as groupName,tbl_student.id,tbl_student.name,tbl_student.roll_no,tbl_student.gender,tbl_student.guardian_mobile,tbl_student.student_code');
        $this->db->from('tbl_student');
        $this->db->join('tbl_class', 'tbl_class.id = tbl_student.class_id');
        $this->db->join('tbl_section', 'tbl_section.id = tbl_student.section_id');
        $this->db->join('tbl_student_group', 'tbl_student_group.id = tbl_student.group');
        $this->db->where("date_of_birth LIKE '%" . $date . "%'");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $studentData = $result->result_array();
            /* echo '<pre>';
            print_r($studentData);
            die(); */
            $return['status'] = 1;
            $return['studentData'] = $studentData;
        } else {
            $return['status'] = 0;
        }
        return $return;
    }
    //////// edit by dip (07-06-17)////////////////
    //////// edit by dip (09-06-17)////////////////
    function GetTeacherInfoByBirthday()
    {
        $date = date('m-d');
        //SELECT id,NAME, FROM tbl_teacher WHERE date_of_birth LIKE '%06-08%'
        $this->db->select('id,name,mobile,gender,subject');
        $this->db->from('tbl_teacher');
        $this->db->where("date_of_birth LIKE '%" . $date . "%'");
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $studentData = $result->result_array();
            /* echo '<pre>';
            print_r($studentData);
            die(); */
            $return['status'] = 1;
            $return['teacherData'] = $studentData;
        } else {
            $return['status'] = 0;
        }
        return $return;
    }
    //////// edit by dip (09-06-17)////////////////
    //////// edit by dip (11-06-17)////////////////
    function GetCategoryInfo($CategoryType)
    {
        $where = array(
            'category_id' => $CategoryType
        );
        $this->db->select('id,contact_name,contact_number');
        $this->db->from('tbl_message_contact_list');
        $this->db->where($where);
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $CategoryData = $result->result_array();
            /* echo '<pre>';
            print_r($studentData);
            die(); */
            $return['status'] = 1;
            $return['CategoryData'] = $CategoryData;
        } else {
            $return['status'] = 0;
        }
        $Categorywhere = array(
            'id' => $CategoryType
        );
        $this->db->select('name');
        $this->db->from('tbl_message_category');
        $this->db->where($Categorywhere);
        $result = $this->db->get();
        $Categoryname = $result->row_array();

        $return['name'] = $Categoryname['name'];
        $return['category_id'] = $CategoryType;
        return $return;
    }

    function GetGuardianSMSReport($FromDate, $ToDate)
    {
        $this->db->select('c.name AS studentName,a.mobile_number,a.date,d.name AS className,e.name AS sectionName,f.name AS groupName,g.template_name,b.template_body');
        $this->db->from('tbl_message_to_guardian_student_list AS a');
        $this->db->join('tbl_message_to_guardian AS b', 'b.id=a.to_guardian_message_id');
        $this->db->join('tbl_student AS c', 'c.id=a.student_id');
        $this->db->join('tbl_class AS d', 'd.id=b.class_id');
        $this->db->join('tbl_section AS e', 'e.id=b.section_id');
        $this->db->join('tbl_student_group AS f', 'f.id=b.group');
        $this->db->join('tbl_message_template AS g', 'g.id=b.template_id');
        $this->db->where("a.date BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $Data = $result->result_array();
            $return['status'] = 1;
            $return['GuardianSMSReport'] = $Data;
        } else {
            $return['status'] = 0;
        }
        return $return;

        /* echo '<pre>';
        print_r($CategoryData);
        die(); */
    }

    function GetDetailsSMSReport($FromDate, $ToDate)
    {
        /* SELECT  FROM tbl_message_to_guardian_student_list AS a
INNER JOIN tbl_student AS b ON b.id=a.student_id
INNER JOIN tbl_message_to_guardian AS c ON c.id=a.to_guardian_message_id
INNER JOIN tbl_message_template AS d ON d.id=c.template_id */
        /* SELECT  FROM tbl_message_to_teacher_list AS a
        INNER JOIN tbl_teacher AS b ON b.id=a.teacher_id
        INNER JOIN tbl_message_to_teacher AS c ON c.id=a.to_teacher_message_id
        INNER JOIN tbl_message_template AS d ON d.id=c.template_id */
        $return = array();
        $i = 0;
        $this->db->select('b.name,a.mobile_number,a.date,d.template_name,c.template_body');
        $this->db->from('tbl_message_to_guardian_student_list AS a');
        $this->db->join('tbl_student AS b', 'b.id=a.student_id');
        $this->db->join('tbl_message_to_guardian AS c', 'c.id=a.to_guardian_message_id');
        $this->db->join('tbl_message_template AS d', 'd.id=c.template_id');
        $this->db->where("a.date BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $guardianData = $result->result_array();
            foreach ($guardianData as $Data) {
                $return[$i]['messageName'] = 'Message To Guardian';
                $return[$i]['ReciverName'] = $Data['name'];
                $return[$i]['Number'] = $Data['mobile_number'];
                $return[$i]['template_name'] = $Data['template_name'];
                $return[$i]['template_body'] = $Data['template_body'];
                $return[$i]['date'] = $Data['date'];
                $lenth = strlen($Data['template_body']);
                //$lenth = 320;
                if ($lenth <= 160) {
                    $count = 1;
                } else {
                    $count = ceil($lenth / 169);
                };
                $return[$i]['numberOfSMS'] = $count;
                $i++;
            }
        }
        $this->db->select('b.name,a.mobile,a.date,d.template_name,c.template_body');
        $this->db->from('tbl_message_to_teacher_list AS a');
        $this->db->join('tbl_teacher AS b', 'b.id=a.teacher_id');
        $this->db->join('tbl_message_to_teacher AS c', 'c.id=a.to_teacher_message_id');
        $this->db->join('tbl_message_template AS d', 'd.id=c.template_id');
        $this->db->where("a.date BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $teacherData = $result->result_array();
            foreach ($teacherData as $Data) {
                $return[$i]['messageName'] = 'Message To Teacher';
                $return[$i]['ReciverName'] = $Data['name'];
                $return[$i]['Number'] = $Data['mobile'];
                $return[$i]['template_name'] = $Data['template_name'];
                $return[$i]['template_body'] = $Data['template_body'];
                $return[$i]['date'] = $Data['date'];
                $lenth = strlen($Data['template_body']);
                //$lenth = 320;
                if ($lenth <= 160) {
                    $count = 1;
                } else {
                    $count = ceil($lenth / 169);
                };
                $return[$i]['numberOfSMS'] = $count;
                $i++;
            }
        }
        /* SELECT FROM tbl_message_to_phonebook_list AS a
INNER JOIN  tbl_message_contact_list AS b ON b.category_id=a.smsReciver_id
INNER JOIN tbl_message_to_phonebook AS c ON c.id=a.to_message_for_birthday_id
INNER JOIN tbl_message_category AS d ON d.id=c.categoryId
INNER JOIN tbl_message_template AS e ON e.id=c.template_id */
        $this->db->select('b.contact_name,a.mobile_number,a.date,d.name,e.template_name,c.template_body');
        $this->db->from('tbl_message_to_phonebook_list AS a');
        $this->db->join('tbl_message_contact_list AS b', 'b.category_id=a.smsReciver_id');
        $this->db->join('tbl_message_to_phonebook AS c', 'c.id=a.to_message_for_birthday_id');
        $this->db->join('tbl_message_category AS d', 'd.id=c.categoryId');
        $this->db->join('tbl_message_template AS e', 'e.id=c.template_id');
        $this->db->where("a.date BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $phonebookData = $result->result_array();
            foreach ($phonebookData as $Data) {
                $return[$i]['messageName'] = 'Message To ' . $Data['name'];
                $return[$i]['ReciverName'] = $Data['contact_name'];
                $return[$i]['Number'] = $Data['mobile_number'];
                $return[$i]['template_name'] = $Data['template_name'];
                $return[$i]['template_body'] = $Data['template_body'];
                $return[$i]['date'] = $Data['date'];
                $lenth = strlen($Data['template_body']);
                //$lenth = 320;
                if ($lenth <= 160) {
                    $count = 1;
                } else {
                    $count = ceil($lenth / 169);
                };
                $return[$i]['numberOfSMS'] = $count;
                $i++;
            }
        }
        /* 	SELECT  FROM tbl_message_for_birthday_to_guardian_student_list AS a
    INNER JOIN tbl_student AS b ON b.id=a.student_id
    INNER JOIN tbl_message_for_birthday AS c ON c.id=a.to_message_for_birthday_id
    INNER JOIN tbl_message_template AS d ON d.id=c.template_id */
        $this->db->select('b.name,a.mobile_number,a.date,d.template_name,c.template_body');
        $this->db->from('tbl_message_for_birthday_to_guardian_student_list AS a');
        $this->db->join('tbl_student AS b', 'b.id=a.student_id');
        $this->db->join('tbl_message_for_birthday AS c', 'c.id=a.to_message_for_birthday_id');
        $this->db->join('tbl_message_template AS d', 'd.id=c.template_id');
        $this->db->where("a.date BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $birthdayStudentData = $result->result_array();
            foreach ($birthdayStudentData as $Data) {
                $return[$i]['messageName'] = 'Message To Student Birthday';
                $return[$i]['ReciverName'] = $Data['name'];
                $return[$i]['Number'] = $Data['mobile_number'];
                $return[$i]['template_name'] = $Data['template_name'];
                $return[$i]['template_body'] = $Data['template_body'];
                $return[$i]['date'] = $Data['date'];
                $lenth = strlen($Data['template_body']);
                //$lenth = 320;
                if ($lenth <= 160) {
                    $count = 1;
                } else {
                    $count = ceil($lenth / 169);
                };
                $return[$i]['numberOfSMS'] = $count;
                $i++;
            }
        }
        /* 	SELECT  FROM tbl_message_for_birthday_to_teacher AS a
    INNER JOIN tbl_teacher AS b ON b.id=a.teacher_id
    INNER JOIN tbl_message_for_birthday AS c ON c.id=a.to_message_for_birthday_id
    INNER JOIN tbl_message_template AS d ON d.id=c.template_id */
        $this->db->select('b.name,a.mobile_number,a.date,d.template_name,c.template_body');
        $this->db->from('tbl_message_for_birthday_to_teacher AS a');
        $this->db->join('tbl_teacher AS b', 'b.id=a.teacher_id');
        $this->db->join('tbl_message_for_birthday AS c', 'c.id=a.to_message_for_birthday_id');
        $this->db->join('tbl_message_template AS d', 'd.id=c.template_id');
        $this->db->where("a.date BETWEEN '" . $FromDate . "' AND '" . $ToDate . "'");
        $result = $this->db->get();
        if ($result->num_rows($result) > 0) {
            $birthdayStudentData = $result->result_array();
            foreach ($birthdayStudentData as $Data) {
                $return[$i]['messageName'] = 'Message To Teacher Birthday';
                $return[$i]['ReciverName'] = $Data['name'];
                $return[$i]['Number'] = $Data['mobile_number'];
                $return[$i]['template_name'] = $Data['template_name'];
                $return[$i]['template_body'] = $Data['template_body'];
                $return[$i]['date'] = $Data['date'];
                $lenth = strlen($Data['template_body']);
                //$lenth = 320;
                if ($lenth <= 160) {
                    $count = 1;
                } else {
                    $count = ceil($lenth / 169);
                };
                $return[$i]['numberOfSMS'] = $count;
                $i++;
            }
        }
        if (!empty($return)) {
            $returndata['status'] = 1;
            $returndata['report'] = $return;
        } else {
            $returndata['status'] = 0;
        }
        /* echo '<pre>';
        print_r($returndata);
        die(); */
        return $returndata;
    }

    //////// edit by dip (11-06-17)////////////////
}