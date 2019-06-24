
<?php $this->load->view('includes/navbar'); ?>
<?php //var_dump($Assesments_id_only);exit(); ?>



<div class="container" id="main">    

    <div id="signupbox" style="margin-top:80px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Assesment</div>
                <input type="hidden" name="" id="Assesment_id" value="<?php if(count($Assesments_id_only)>0){ echo$Assesments_id_only[0]['Assesment_id']; } ?>">

            </div>  
            <div class="panel-body" >
                <form  id="form_data" action="" onsubmit="return false;" class="form-horizontal" role="form"> 



                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Title:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Assesment title" required="required" value="<?php if(count($Assesments_id_only)>0){ echo($Assesments_id_only[0]['title']); } ?>" >
                            <input type="hidden" id="Question_id_1" name="Question_id_1">
                            

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <?php if(count($Assesments_id_only)<=0){ ?>
                            <div class="col-md-9 icheck pl40">
                              <input type="checkbox" id="is_active_1" checked="checked" name="is_active_1" value="1" > <label>Status</label>
                          </div>
                      </div>
                      <div style="border-top: 1px solid #999; padding-top:20px" id="removeble"  class="form-group">


                        <div class="col-md-offset-3 col-md-9">
                            <input type="submit" id="Assesadd"  class="btn btn-md btn-primary" value=" &nbsp Next &nbsp">


                        </div>    
                    <?php } ?>

                </div>
                <?php if(count($Assesments_id_only)!=0){ ?>
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Question Text:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="Question_t" name="Question_t" placeholder="Enter Question text" required="required" >
                            <input type="hidden" name="Question_id_2" id="Question_id_2" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Question Type:</label>
                        <div class="col-md-9">
                            <select name="Quest_type" class="form-control" id="Quest_type" required="required">
                                <option value="">Choose type</option>
                                <option value="single">single</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                     <label for="file" class="col-md-3">Add options</label>
                     <div class="col-md-9">
                         <button id="ADDFILE" class="btn btn-xs btn-info" style="float: left;">add option</button></span>
                     </div>
                 </div>


                 <div id="uploadFileContainer" >

                 </div>
              


                 <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9 icheck pl40">

                     <input type="checkbox" id="is_active" checked="checked" name="is_active" value="1" > <label>Status</label>
                 </div>
             </div>


             <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <input type="submit" id="save"  class="btn btn-md btn-primary savecls" value=" &nbsp Save &nbsp">

                    <input type="submit" name="update" id="update" class="btn btn-md btn-success" value="&nbsp Update &nbsp">
                    <a  href="<?php echo site_url('Assesment/assesment/').$Assesments_id_only[0]['Assesment_id'];?>" class="btn btn-md btn-info" id="newQuestion" >Add New Question</a>
                </div>                                           
            </div>

            <div class="form-group">
                <label type="hidden" class="col-md-3"></label>
                <div class="col-md-9 col-lg-9 col-sm-9 " >
                    <div id="edit_but">
                        <?php if(count($questionList)>0){ 
                            for($i=0;$i<count($questionList);$i++){?>
                                <tr style="float:left; padding-right:3px; padding-top:3px;">
                                    <td >
                                        <a href="javascript:void(0);"  class="btn btn-warning btn-xs item_edit"  data-Quesstion_id="<?php echo $questionList[$i]['Quesstion_id'];?>">Question <?php echo $i+1;?></a>
                                    </td>
                                </tr> 
                            <?php } } ?>
                        </div>

                    </div>

                </div>

            <?php } ?>
        </form>


        <script type="text/javascript">
          $(document).ready(function($){
            $("#update").hide();
            $("#newQuestion").hide();
            $("#save").hide();
            $(document).on('click','button#ADDFILE',function(event){
                event.preventDefault();
            $("#save").show();
                addFileInput();
            });

            $('#form_data').on('click','.item_edit',function(){
                $(".savecls").remove();
                $("#update").show();
                $("#ADDFILE").hide();
                $("#newQuestion").show();
               
                var Assesment_id = $('#Assesment_id').val();
                var Question_id = $(this).attr('data-Quesstion_id');
                $('[name="Question_id_2"]').val(Question_id);
                //console.log(Question_id);
                $.ajax({
                    url: '<?php echo site_url()."dashboard/retrive";?>',
                    method: 'post',
                    dataType:'JSON',
                    data: {Question_id:Question_id,Assesment_id:Assesment_id},
                    success: function(response){
                     var store1 =response[0].Question_text;
                     var  store2 =response[0].Question_type;
                     $('[name="Question_t"]').val(store1);
                     $('[name="Quest_type"]').val(store2);

                 }
             });

                $.ajax({
                    url: '<?php echo site_url()."dashboard/option";?>',
                    method: 'post',
                    dataType:'JSON',
                    data: {Question_id:Question_id,Assesment_id:Assesment_id},
                    success: function(response){
                        var temp = response.length;
                        var html='';
                       
                        for(var x=0;x<temp;x++ )
                        {
                         var checked = '';

                         if(response[x].correct_answer == 1)
                         {
                            checked = 'checked';

                        }

                        html+='<div class="form-group count">'+
                        '<label type="hidden" class="col-md-3"></label>'+
                        ' <div class="col-md-9 ">'+
                        '<input type="text" name="option_1" class="form-control optioncls_1" value="'+response[x].options+'" placeholder="enter option" required><input type="checkbox" id="Check_value" name="checkopt_1" class="checkedClass" '+checked+' value="1">'+
                        '</div>'+'<input type="hidden" name="option_id" value="'+response[x].option_id+'" >'+
                        '</div>';





                    }
                    $("div#uploadFileContainer").html(html);



                }
            });
            });
            function addFileInput()
            {

                var html='';
                html+='<div class="form-group count">'
                html+='<label type="hidden" class="col-md-3"></label>'
                html +=' <div class="col-md-9 ">';



                html +='<input type="text" name="option" class="form-control optioncls" placeholder="enter option" required><input type="checkbox" name="checkopt" class="checkedClass"  value="1">';

                html +='</div>';
                html+='</div>';


                $("div#uploadFileContainer").append(html);
                var count= $('.count').length;
                if(parseInt(count)==4)
                {
                         //$('#ADDFILE').prop('disabled', false);
                         $("#ADDFILE").remove();
                     }
                 }


             });
          /*here ended*/
          $(document).on('click',"#Assesadd",function(){

            var title = $('#title').val();

            var status = $('#is_active_1').val();
           
          if(title=='')
          {
            alert('Title required!');
           $('#title').focus();
          }
          else
            if(status == '')
            {
                alert(' Keep Status Choose');
                $('#is_active_1').focus();
            }else{
            $.ajax({
                url:'<?php echo site_url("dashboard/Assesment_submit");?>',
                method:'post',
                dataType:'JSON',
                data:{title:title,status:status},
                success:function(response){

                   window.location.href = "<?php echo site_url("Assesment/assesment/")?>"+response;

               }
           });
        }
        


        });
          $(document).on('click','#save',function(){
             var check = []; 
             var option=[]; 
                var temp_st;
            var temp_st_2=0;

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
         
             $.each($('.optioncls'),function(){
                  temp_st= $(this).val();

                if(temp_st =='' )
                {
                    temp_st_2=1;
                }
             });
            
             var title = $('#title').val();
             var Assesment_id = $('#Assesment_id').val();
             var question_text = $('#Question_t').val();
             var Questtype =$('#Quest_type').val();
             var status = $('#is_active').val(); 
             if(title=='')
             {
                alert("title required");
                $("#title").focus();
             }else if(question_text==''){
                    alert("Question is required");
                $("#Question_t").focus();
             }else if(Questtype=='')
             {
                 alert("Choose Question Type ");
                $("#Quest_type").focus();
             }else if(temp_st_2==1){
                alert("Fill Empty Option Field");
                $(".optioncls").focus();

             }else {
               
             $.ajax({
                url: '<?php echo site_url()."/dashboard/Question_add"?>',
                method: 'post',
                dataType:'JSON',
                data: {title:title,Assesment_id:Assesment_id,question_text:question_text,Questtype:Questtype,status:status,check:check,option:option},
                success: function(response){
                    alert("question added");
                    var html = '';
                    var Quesstion_id = response;
                    html += '<tr style="float:left; padding-right:3px; padding-top:3px;">'+'<td ">'+
                    '<a href="javascript:void(0);"  class="btn btn-warning btn-xs item_edit"  data-Quesstion_id="'+Quesstion_id+'">Question</a>'+'</td>'+'</tr>';
                    $('#edit_but').append(html);

                }
            });
         }

         });
          $(document).on('click','#update',function(){
            var check1 = []; 
            var option1=[]; 
            var option_id =[];
             var temp_st;
            var temp_st_2=0;
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
            $.each($('.optioncls_1'),function(){
                  temp_st= $(this).val();

                if(temp_st =='' )
                {
                    temp_st_2=1;
                }
             });

            //console.log(option_id);
            var title = $('#title').val();
            var question_text = $('#Question_t').val();
            var Questtype =$('#Quest_type').val();
            var status = $('#is_active').val(); 
            var Assesment_id = $('#Assesment_id').val();
            var Question_id = $('#Question_id_2').val(); 
            //console.log(title,question_text,Questtype,status,Assesment_id,Question_id);
            if(title=='')
             {
                alert("title required");
                $("#title").focus();
             }else if(question_text==''){
                    alert("Question is required");
                $("#Question_t").focus();
             }else if(Questtype=='')
             {
                 alert("Choose Question Type ");
                $("#Quest_type").focus();
             }else if(temp_st_2==1){
                alert("Fill Empty Option Field");
                $(".optioncls").focus();

             }else {
            $.ajax({
                url:'<?php echo site_url()."dashboard/Update"?>',
                method:'post',
                dataType:'JSON',
                data:{title:title,question_text:question_text,Questtype:Questtype,status:status,Assesment_id:Assesment_id,Question_id:Question_id,check1:check1,option1:option1,option_id:option_id},
                success:function(response){
                   alert("Your Record is update success fully");
                  window.location.href = "<?php echo site_url("Assesment/assesment/")?>"+response;
                }
            });
        }
        });


    </script>


</div>
</div>

</div> 



</div>
