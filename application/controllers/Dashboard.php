<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

    var $session_user;

    function __construct() {
        parent::__construct();
          
        $this->load->library('form_validation');
        $this->load->model('user');
        $this->load->model('course_record');
        $this->load->library('upload');
        $this->load->helper('directory');
        $this->load->model('Auth_model');
        
    }

    public function Assesment_list(){
        $this->load->model('Auth_model');
        $data['Assesments']=$this->Auth_model->Assesment_list();
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $this->load->view('Display/Assesment_list',$data);
        $this->load->view('includes/footer');
    }
    public function Assesment_list_display()
    {
     
        $data=$this->Auth_model->Assesment_list();
        echo json_encode($data);
        
    }
    
    function Assesment_submit(){

        echo json_encode($this->Auth_model->Assesment_submit());
    }
 

    function Question_add(){
   /* $data['title'] = 'test';
    $this->load->model('Auth_model');
   
    
    $question_text = $_POST['question_text'];
    $Questtype = $_POST['Questtype'];
    $status=$_POST['status'];
    $option = $_POST['option'];
    $check = $_POST['check'];
    $result = $this->Auth_model->Assesment($title,$question_text,$Questtype, $status, $option,$check );

    
    echo json_encode($result);*/
    echo json_encode($this->Auth_model->Question_add());


}
function retrive()
{

    $data['title'] = 'retrive';
    $this->load->model('Auth_model');
    $qst_id = $_POST['Question_id'];
    $Ass_id = $_POST['Assesment_id'];
    $result = $this->Auth_model->retrives($qst_id,$Ass_id);
    echo json_encode($result);  
}
function title()
{
    $data['title'] = 'title';
    $this->load->model('Auth_model');
    $Ass_id = $_POST['Assesment_id'];
    $result2 = $this->Auth_model->title($Ass_id);
    echo json_encode($result2);

}
function option()
{
    $data['option'] = 'option';
    $this->load->model('Auth_model');
    $qst_id = $_POST['Question_id'];
    $Ass_id = $_POST['Assesment_id'];
    $result = $this->Auth_model->option($qst_id,$Ass_id);
    echo json_encode($result);

}
public function update()
{
    $data['update'] = 'update';
    $this->load->model('Auth_model');

    $title= $_POST['title'];
    $question_text = $_POST['question_text'];
  
    $Questtype = $_POST['Questtype'];
    $status=$_POST['status'];
    $option = $_POST['option1'];
    $check = $_POST['check1'];
    $option_id = $_POST['option_id'];
    $Assesment_id= $_POST['Assesment_id'];
    $Question_id= $_POST['Question_id'];
    $result = $this->Auth_model->update($title,$question_text,$Questtype,$status, $option,$check, $Question_id,$Assesment_id,$option_id);
    echo json_encode($result);
}



   

   

    public function account(){
        $data = array();
        if($this->session->userdata('isUserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            //load the view
            $this->load->view('users/account', $data);
        }else{
            redirect('users/login');
        }
    }
     public function course()
    {
              $data = array();
              if($this->session->userdata('isUserLoggedIn'))
              {
                  $user_uni_id=$this->session->userdata('userId');
                  $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
                  $data['title'] = 'Course';      
                  $data['session_user'] = $this->session_user;
                  $this->load->view('includes/header', $data);
                  $this->load->view('includes/navbar');
                  $result['data']=$this->course_record->display_records($user_uni_id);
                  $this->load->view('dashboard/course',$result);
                  $this->load->view('includes/footer');
                  
              }
              else
              {
                  redirect('users/login');
              }
        
    }
    
     public function add_course($id="")
     {   
        $data['title'] = 'Add Course';   
        $course_eid=$id; 
        //$data['session_user'] = $this->session_user;
        $this->load->view('includes/header');
        $this->load->view('includes/navbar');
        $query="select *from Assesment_tbl";
        $qry=$this->db->query($query);
        $result['Assesment_data'] = $qry->result();     
        $result['data']=$this->course_record->edit_records($course_eid);
        $this->load->view('dashboard/add_course',$result);
        $this->load->view('includes/footer');    
     }
     

     public function updatedata()
     {   
       
        if($this->input->post('submit'))
        {
            $title=$this->input->post('title');
            $discription=$this->input->post('discription');
            $title=str_replace("'","\'", $title); 
            $discription=str_replace("'","\'", $discription);  
            $course_eid=$this->input->post('course_eid');
            $cross_data=$this->input->post('elems');

            $query="update course_tbl set course_title='$title',course_desc='$discription' where course_id='$course_eid'";
            $this->db->query($query);

            $ids = implode("','", $cross_data);
            //var_dump($ids);exit();
            $query="delete from course_file where file_id IN ('".$ids."')";
            $this->db->query($query);
              
             if(count($_FILES['multipleFiles']['name'])>0)
             {
                $number_of_files=count($_FILES['multipleFiles']['name']);
                $files=$_FILES;
                for ($i=0; $i <$number_of_files ; $i++)
                { 
                  $fnew=$files['multipleFiles']['name'][$i];
                  
                  $path=time().$files['multipleFiles']['name'][$i];
                  $full_path = preg_replace('/[^a-zA-Z0-9_.]/', '_', $path);
                  $_FILES['multipleFiles']['name']=$full_path;                 
                  $_FILES['multipleFiles']['type']=$files['multipleFiles']['type'][$i];
                  $_FILES['multipleFiles']['tmp_name']=$files['multipleFiles']['tmp_name'][$i];
                  $_FILES['multipleFiles']['error']=$files['multipleFiles']['error'][$i]; 
                  $_FILES['multipleFiles']['size']=$files['multipleFiles']['size'][$i];  

                  $config['upload_path']='./uploads/';
                  $file_path=$config['upload_path'].$full_path;
                  $config['allowed_types']='pdf|doc|docx|gif|jpg|png|xlsx|xls';
                  $config['max_size'] ='0';
                  $config['max_width']='0';
                  $config['max_height']='0';
                  $config['overwrite']=TRUE;
                  $config['remove_spaces']=TRUE;

                  $this->upload->initialize($config);
                  $file_id = uniqid();
                  $file_name = str_replace(' ',' ',$fnew);
                  $file_nam=str_replace("'","\'", $file_name);
                  $query="insert into course_file(file_id,course_id,file_name,file_path,status) values('$file_id','$course_eid','$file_nam','$file_path',1)";
                  $this->db->query($query);

                  if(!$this->upload->do_upload('multipleFiles'))
                  {
                    $error=array('error'=>$this->upload->display_errors());
                  }
                  else
                  {
                    $data=array('upload_data'=>$this->upload->data());
                    echo "success";
                  }
                }
              }  
             if(!$error)
             {
                redirect(base_url('dashboard/course'));
             }
        }         
        
     }
     
    public function Delete_data($id="")
    {
        $delete_course=$id;
        $query="delete from course_tbl where course_id='$delete_course'";
        $this->db->query($query);
        $query="delete from course_file where course_id='$delete_course'";
        $this->db->query($query);   
        redirect(base_url('dashboard/course'));  
    } 
    

    public function savedata()
         {
              $data = array();
              if($this->session->userdata('isUserLoggedIn'))
              {
                  $user_uni_id=$this->session->userdata('userId');
                  $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
                  
              }
              else
              {
                  redirect('users/login');
              }

             if($this->input->post('submit') && count($_FILES['multipleFiles']['name'])>0)
             {
                 $title=$this->input->post('title');
                 $discription=$this->input->post('discription');
                 $assesment_eid=$this->input->post('assesment_eid');
                // var_dump($assesment_eid);exit();
                // $as=count($assesment_eid);
                 //var_dump($as);exit();
                 $course_id = uniqid();
                
                 if(count($assesment_eid)>0)
                 {    
                      $assesment_eid =explode(',',implode("','", $assesment_eid)); 
                      //var_dump($assesment_eid);exit();
                      foreach ($assesment_eid as $key) {
                         $course_uniq_id= uniqid();
                        $query="insert into course_assmts(course_uniq_id,course_id,Assesment_id,status) values('$course_uniq_id','$course_id','$key',1)";
                         $this->db->query($query);
                      }
                       
                 }    

                 $title=str_replace("'","\'", $title); 
                 $discription=str_replace("'","\'", $discription);   
                 $query="insert into course_tbl(course_id,course_title,course_desc,created_by,created_date,status) values('$course_id','$title','$discription','$user_uni_id',now(),1)";
                 $this->db->query($query);

                 //$this->course_record->savefile($m,$file_id,$course_id); 
                 //echo "Records Saved Successfully";
                 //redirect(base_url('dashboard/course')); 
                
                $number_of_files=count($_FILES['multipleFiles']['name']);

                $files=$_FILES;
                if(!is_dir('uploads'))
                {
                    mkdir('./uploads',0777,true);
                }


                for ($i=0; $i <$number_of_files ; $i++)
                { 
                  $fnew=$files['multipleFiles']['name'][$i];

                  $path=time().$files['multipleFiles']['name'][$i];
                  $full_path = preg_replace('/[^a-zA-Z0-9_.]/', '_', $path);
                  $_FILES['multipleFiles']['name']=$full_path;                 
                  $_FILES['multipleFiles']['type']=$files['multipleFiles']['type'][$i];
                  $_FILES['multipleFiles']['tmp_name']=$files['multipleFiles']['tmp_name'][$i];
                  $_FILES['multipleFiles']['error']=$files['multipleFiles']['error'][$i]; 
                  $_FILES['multipleFiles']['size']=$files['multipleFiles']['size'][$i];  

                  $config['upload_path']='./uploads/';
                  $file_path=$config['upload_path'].$full_path;
                  $config['allowed_types']='pdf|doc|docx|gif|jpg|png|xlsx|xls';
                  $config['max_size'] ='0';
                  $config['max_width']='0';
                  $config['max_height']='0';
                  $config['overwrite']=TRUE;
                  $config['remove_spaces']=TRUE;

                  $this->upload->initialize($config);
                  $file_id = uniqid();
                  $file_name = str_replace(' ',' ',$fnew);
                  $file_nam=str_replace("'","\'", $file_name);
                  //var_dump($file_nam);
                  $query="insert into course_file(file_id,course_id,file_name,file_path,status) values('$file_id','$course_id','$file_nam','$file_path',1)";
                  $this->db->query($query);

                  if(!$this->upload->do_upload('multipleFiles'))
                  {
                    $error=array('error'=>$this->upload->display_errors());
                  }
                  else
                  {
                    $data=array('upload_data'=>$this->upload->data());
                    echo "success";
                  }
              }
             if(!$error)
             {
                redirect(base_url('dashboard/course'));
             }


            
             redirect(base_url('dashboard/course'));
         }

    }
}
