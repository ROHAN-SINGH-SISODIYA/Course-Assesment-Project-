 <?php $this->load->view('includes/navbar');?>
 <div class="container" style="margin-top: 50px;">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Assesment
                    <small style="color: red;">list</small>
                    
                </h1>
            </div>
            
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th  style="text-align: center;">Serial No</th>
                        <th style="text-align: center; ">Assesment Id</th>
                        <th style="text-align: center;">Title</th>
                        <th style="text-align: center;">Created By</th>
                        <th style="text-align: center;">Created Time</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>

                </thead>
                <tbody id="show_data">
                   
                </tbody>
            </table>
        </div>
    </div>
    
</div>


<!-- MODAL EDIT -->

<!--END MODAL EDIT-->

<!--MODAL DELETE-->

<!--END MODAL DELETE-->


<script type="text/javascript">
    $(document).ready(function(){
        show_product(); 
        $('#mydata').dataTable();\
        function show_product(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('Auth/Assesment_list_display')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    var cnt=0;
                    for(i=0; i<data.length; i++){
                        cnt++;
                        html += '<tr>'+
                        '<td style="text-align: center;">'+cnt+'</td>'+
                        '<td style="text-align: center;">'+data[i].Assesment_id+'</td>'+
                        '<td style="text-align: center;">'+data[i].title+'</td>'+
                        '<td style="text-align: center;">'+data[i].created_by+'</td>'+
                        '<td style="text-align: center;">'+data[i].created_time +'</td>'+
                        '<td style="text-align:center;">'+
                        '<a href="<?php echo site_url("Assesment/assesment/")?>'+data[i].Assesment_id+'" class="btn btn-warning btn-xs item_edit">Edit</a>'+
                        '</td>'+
                        '</tr>';
                    }
                    $('#show_data').html(html);
                }
                
            });
        }
    });
    
        //Save product
        
        
    </script>


    <!-- index ajax -->
    $(document).on('click','#save',function(){
    var check = []; 
    var option=[]; 
    
    $.each($("input[name='checkopt']"),function(){
    if($(this).prop("checked") == true){
    check.push($(this).val());
}
else if($(this).prop("checked") == false){
check.push('0');
}
});
$.each($("input[name='option']"),function(){
option.push($(this).val());
});

var title = $('#title').val();
var question_text = $('#Question_t').val();
var Questtype =$('#Quest_type').val();
var status = $('#is_active').val(); 


$.ajax({
url: '<?php echo site_url()."Auth/test"?>',
method: 'post',
dataType:'JSON',
data: {title:title,question_text:question_text,Questtype:Questtype,status:status,check:check,option:option},
success: function(response){
alert("inserted");

}
});

});
$(document).on('click','#update',function(){
var check1 = []; 
var option1=[]; 
var option_id =[];
$.each($("input[name='checkopt_1']"),function(){
if($(this).prop("checked") == true){
check1.push($(this).val());
}
else if($(this).prop("checked") == false){
check1.push('0');
}
});
$.each($("input[name='option_1']"),function(){
option1.push($(this).val());
});
$.each($("input[name='option_id']"),function(){
option_id.push($(this).val());
});
console.log(option_id);
var title = $('#title').val();
var question_text = $('#Question_t').val();
var Questtype =$('#Quest_type').val();
var status = $('#is_active').val(); 
var Asses_Id = $('#Assesment_id_1').val();
var Quest_Id = $('#Question_id_1').val(); 
$.ajax({
url:'<?php echo site_url()."Auth/Update"?>',
method:'post',
dataType:'JSON',
data:{title:title,question_text:question_text,Questtype:Questtype,status:status,Asses_Id:Asses_Id,Quest_Id:Quest_Id,check1:check1,option1:option1,option_id:option_id},
success:function(response){
alert("update successfull");
}
});
});
