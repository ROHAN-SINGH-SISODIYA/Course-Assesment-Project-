<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */

    public function Authentification() {
        $notif = array();
        $email = $this->input->post('email');
        $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $row = $query->row();
            if ($row->is_active != 1) {
                $notif['message'] = 'Your account is disabled !';
                $notif['type'] = 'warning';
            } else {
                $sess_data = array(
                    'users_id' => $row->users_id,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'email' => $row->email
                );
                $this->session->set_userdata('logged_in', $sess_data);
                $this->update_last_login($row->users_id);
            }
        } else {
            $notif['message'] = 'Username or password incorrect !';
            $notif['type'] = 'danger';
        }

        return $notif;
    }

    /*
     * 
     */

    private function update_last_login($users_id) {
        $sql = "UPDATE users SET last_login = NOW() WHERE users_id=" . $this->db->escape($users_id);
        $this->db->query($sql);
    }

    /*
     * 
     */

    public function register() {
        $notif = array();
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'password' => Utils::hash('sha1', $this->input->post('password'), AUTH_SALT),
            'is_active' => $this->input->post('is_active') ? : 0
        );
        $this->db->insert('users', $data);
        $users_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }
    /**
     * 
     */
    public function Assesment($title,$question_text,$Questtype, $status, $option,$check) {
        $assist_id = uniqid( );

        
        $question_order =1;

        //$sql ="INSERT INTO `assesment_tbl`(`Assesment_id`, `title`, `created_by`, `created_time`, `status`) VALUES ('$assist_id ','$title','veer1',now(),'$status')";
        $sql="insert into Assesment_tbl (Assesment_id,title,created_by,created_time,status) values('$assist_id ','$title','veer1',now(),'$status')";


        $this->db->query($sql);
        $this->db->query($sql1);

        return null;
        
        
    }
    public function Assesment_list()
    {
     /* $sql = "select Assesment_tbl.title,Assesment_qst_tbl.Question_text,Assesment_qst_tbl.Question_type,Assesment_option_tbl.options,Assesment_option_tbl.correct_answer,Assesment_tbl.status from Assesment_tbl inner join Assesment_qst_tbl on Assesment_tbl.Assesment_id=Assesment_qst_tbl.Assesment_id inner join Assesment_option_tbl on Assesment_option_tbl.Quesstion_id=Assesment_qst_tbl.Quesstion_id ";*/

     $sql = "select Assesment_id,title,created_by,created_time from Assesment_tbl";




     $query = $this->db->query($sql);
     return $query->result();

 }
 public function retrives($qst_id,$Ass_id)
 {
    $temp_store=$qst_id;
    $temp_Ass = $Ass_id;
    $sql = "select Question_text,Question_type from Assesment_qst_tbl where Quesstion_id='$temp_store' and Assesment_id='$temp_Ass' ";

    $query= $this->db->query($sql);
    return $query->result();
}
public function title($Ass_id)
{
    $temp_Ass = $Ass_id;
    $sql = "select title from Assesment_tbl where Assesment_id='$temp_Ass'";
    $query= $this->db->query($sql);
    return $query->result();
}
public function option($qst_id,$Ass_id)
{
    $str_1 = $qst_id;
    $str_2 = $Ass_id;
    $sql = "select options ,correct_answer,option_id from Assesment_option_tbl  where Quesstion_id='$str_1' and Assesment_id='$str_2'";

    $query= $this->db->query($sql);
    return $query->result();
}
public function update($title,$question_text,$Questtype,$status, $option,$check, $Question_id,$Assesment_id,$option_id)
{



   $sql = "update Assesment_tbl set title='$title' where Assesment_id='$Assesment_id'";

    $this->db->query($sql);
   $sql1 = "update Assesment_qst_tbl set Question_text='$question_text' ,Question_type='$Questtype',status='$status' where Quesstion_id='$Question_id' and Assesment_id='$Assesment_id'";

 $this->db->query($sql1);
   for($i=0;$i<count($option);$i++)
   {
    $option[$i] = str_replace("'", "\'", $option[$i]);

    $sql2 = "update Assesment_option_tbl set options='$option[$i]',correct_answer='$check[$i]',status='$status' where Quesstion_id='$Question_id' and Assesment_id='$Assesment_id' and option_id='$option_id[$i]'";

    $this->db->query($sql2);

     }
return $Assesment_id;

}
public function Assesment_submit()
{

    $title=$_POST['title'];
    $status = $_POST['status'];

    $assist_id = uniqid( );
    $sql = "insert into Assesment_tbl(Assesment_id,title,created_by,created_time,status) values('$assist_id','$title','veer',now(),'$status')";
    $this->db->query($sql);
    return $assist_id;
}
public function edit_assesment_question($assesment)
{
    $sql = "select * from Assesment_tbl where Assesment_id='$assesment'";
    $query = $this->db->query($sql); 
    $data['Assesment']=$query->result_array();       
    $sql = "select Quesstion_id from Assesment_qst_tbl where Assesment_id='$assesment'";
    $query = $this->db->query($sql);

    $data['questionList']=$query->result_array();
     
    return $data;
}
public function Question_add()
{   

    $question_id = uniqid();
    $title = $_POST['title'];
    $Assesment_id=$_POST['Assesment_id'];
    $question_text = $_POST['question_text'];
    $Questtype = $_POST['Questtype'];
    $status=$_POST['status'];
    $option = $_POST['option'];
    $check = $_POST['check'];
    $question_order =1;
    $sql = "update Assesment_tbl set title='$title' where Assesment_id='$Assesment_id'";
    $this->db->query($sql);
    $sql1 ="insert into  Assesment_qst_tbl(Quesstion_id,Assesment_id,Question_text,Question_type,status,Qst_order) values('$question_id','$Assesment_id','$question_text','$Questtype','$status','$question_order')";
    $this->db->query($sql1);

    $cnt=0;
    for($i=0;$i<count($option);$i++) {
        $option_i = uniqid();
        $cnt++;
        $option_1[$i] = str_replace("'", "\'", $option[$i]);
        $sql2  = "insert into Assesment_option_tbl(option_id,Quesstion_id,Assesment_id,options,correct_answer,status,option_order) values('$option_i','$question_id','$Assesment_id','$option_1[$i]','$check[$i]','$status','$cnt')" ;
        $this->db->query($sql2);


    }
    return $question_id;
}
    /*
     * 
     */

    public function check_email($email) {
        $sql = "SELECT * FROM users WHERE email = " . $this->db->escape($email);
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row;
        }
        return null;
    }

}
