<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class course_record extends CI_Model {

    function __construct() {
        parent::__construct();
    }

  

  function display_records($user_uniqid)
    {
    $query=$this->db->query("select course_tbl.course_id,course_tbl.course_title, course_tbl.course_desc,group_concat( course_file.file_name  ) as 'file_name'
        from course_tbl inner join course_file on course_tbl.course_id=course_file.course_id where course_tbl.created_by='$user_uniqid' group by course_tbl.course_id");
    return $query->result();
    }
    function edit_records($id)
    {
        $query=$this->db->query("select course_tbl.course_id,course_tbl.course_title, course_tbl.course_desc,course_file.file_id,course_file.file_path,course_file.file_name from course_tbl inner join course_file on course_tbl.course_id=course_file.course_id  where course_file.course_id='$id'");
        return $query->result();
    }

}
