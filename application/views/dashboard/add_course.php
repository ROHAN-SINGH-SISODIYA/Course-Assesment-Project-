      <?php //var_dump($Assesment_data);exit(); 
      $this->load->view('includes/navbar'); 
      $title_name='';
      $description='';
      $course_eid='';
      foreach ($data as $key) 
      {
      	$course_eid=$key->course_id;
      	$title_name=$key->course_title;
      	$description=$key->course_desc;
      }
       ?>
      <div class="container" id="main" style="margin-top: 100px;">
           <form method="post" id="form1" onsubmit="return false;" action="<?php  if(count($data)>0){echo site_url('Dashboard/updatedata');}else{echo site_url('Dashboard/savedata'); }?>" enctype="multipart/form-data">
      		  <div class="form-group">
      		    <label for="title">Title</label>
      		    <input type="text" class="form-control" id="title_id" value="<?php echo $title_name; ?>" name="title" id="title" placeholder="Title">
      		  </div>
      		  <div class="form-group">
      		    <label for="Description">Description</label>
      		    <textarea class="form-control" id="description_data" rows="4" id="Description1" name="discription" placeholder="Description"><?php echo $description; ?></textarea>
      		  </div>
      		  <div class="form-group">
      		       <label >Upload Files</label>
      		       <button id="ADDFILE"  class="btn btn-xs btn-info add_file" value="1" style="float: right;">Add files</button>
            </div>
            <div id="uploadFileContainer" class="form-group"></div>

                <div class="form-group">
                	  <input type="hidden" id="input_hidden_field" name="elems[]"  value=""/>
                    <input type="hidden" id="assesment_hidden_field" name="assesment_eid[]"  value=""/>
                	  <input type="hidden" name="course_eid" value="<?php echo $course_eid; ?>">
                </div>

              
                <div  class="form-group">
                <?php
                  foreach ($data as $key) 
                    {
      	              ?>
                  		<div class="alert alert-info">
                  			<button type="button" data-fileID="<?php echo $key->file_id ?>" class="close" id="dismissbtn" data-dismiss="alert" aria-hidden="true">&times;</button>
                  			<strong>File Name</strong>
                  			<p><?php echo $key->file_name; ?></p> 
                  		</div>
                  	 <?php
                   }
                ?>
                </div>

               <div class="form-group">
                   <label>Add Assesment</label>
                   <button data-toggle="modal" data-target="#modalForm1"  class="btn btn-xs btn-info" value="1" style="float: right;">Assesment</button>
               </div> 
               <div id="show_assesment_list" class="form-group">
                 
                  
               </div>
                 
      		  <div class="form-group">
      		   <?php
      		    if(count($data)>0)
      		    {
                    ?> 
                      <input type="submit" id="submithere" name="submit" value="Submit" class="btn btn-success validate">
      			       </div>
                    <?php
      		    }
      		    else
      		    {
      		    	?>
      			    	<input type="submit"  name="submit" value="Submit" class="btn btn-success validate">
      			       </div>
      		       <?php
      		    }	
      		   ?>   		    
           </form>

      <!-- Modal for add assesment -->
        <div class="modal fade" id="modalForm1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Assesment</h4>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg1"></p>
                        <div class="table-responsive">
                        <form role="form">
                         <table class="table table-boredered">
                          <tr>
                            <th>Assesment Title</th>
                            <th>Select</th>
                          </tr>
                                                 
                            <?php 
                               /*if (count($Assesment_data) > 0) 
                               {*/
                                //var_dump($Assesment_data);
                                  foreach ($Assesment_data as $key) 
                                    {
                                       ?>
                                         <tr id="<?php echo $key->Assesment_id;?>"> 
                                           <td><?php echo $key->title."<br>"; ?></td>
                                           <td><input type="checkbox" name="user_id[]" class="checkedClass" data-title="<?php echo $key->title; ?>" data-assesment="<?php echo $key->Assesment_id; ?>"  value="<?php echo $key->Assesment_id;?>"></td>
                                        </tr> 
                                       <?php
                                     }
                               
                              /* else 
                               {
                                  echo "0 results";
                               }*/
                             ?> 
                          
                         </table>
                            
                        </form>
                      </div>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" name="add_assesment" id="append_assesment" class="btn btn-success submitBtn1">Add Assesment</button>
                    </div>
                </div>
            </div>
        </div>

        <!--End Model-->


           <script type="text/javascript">
              var file_eid = [];
              $(document).on('click','button#dismissbtn',function(event){                   
              file_eid.push($(this).attr('data-fileID')); 
                       $('#input_hidden_field').val(file_eid);
                       console.log(file_eid);    
                  });

                  addfiles=[]; 
                  $('.add_file').each(function() {
                        $(this).click(function(e) {        
                             addfiles.push($(this).val());
                             console.log("button=",addfiles);
                        }); 
                 });
                
                  $(document).on('click','.validate',function(event)
                  {     
                    var validation = 0;
                      add_input_file=[];
                     $('.input_file_validate').each(function() {
                             add_input_file.push($(this).val());
                          if($(this).val()== '')
                          {
                              alert('Please upload all file');
                              validation++;
                          } 
                        
                    });    

                    var title_id = document.getElementById('title_id');
                    var description_data = document.getElementById('description_data');
                    if(title_id.value == '')
                    {
                        alert('Please enter title');
                              validation++;
                    } 
                    else if(description_data.value == '')
                    {
                        alert('Please write discription');
                              validation++;
                    }
                    else if(addfiles.length<1)
                    {
                        alert('Add the File');
                              validation++;
                     } 
                   /* else if(addfiles.length!=add_input_file.length)
                    {
                        alert('Please first upload all the File');
                        return false;
                    }*/
                    if(validation==0){
                      $("#form1").removeAttr("onsubmit");
                    }

                  });

                      $(document).on('click','button#ADDFILE',function(event){
                event.preventDefault();
                
                addFileInput();
              });

              function addFileInput()
              {
                var html='';
                html +='<div class="alert alert-info">';
                html +='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                html +='<strong>Upload file</strong>';
                html +='<input type="file" class="input_file_validate" name="multipleFiles[]" />';
                html +='</div>';

                $("div#uploadFileContainer").append(html);
              }




      $('#append_assesment').click(function()
      {            
              
                  var assesment = [];
                  var title =[]; 
                  $('.checkedClass').each(function(i)
                  {
                    if($(this).prop("checked")){
                      title.push($(this).attr("data-title"));
                      assesment.push($(this).attr("data-assesment"));
                       $('#assesment_hidden_field').val(assesment);
                    }   
                  });
                   //console.log(title);
                  if(title.length === 0)
                   {
                      alert("Please Select atleast one checkbox");
                   }
                  else
                   {
                     
                       var table = $('#show_assesment_list');
                       var  cell='';
                       cell+= '<table class="table table-bordered">';
                       cell+= '<tr>';
                       cell+= '<th>S.no</th>';
                       cell+= '<th>Assesment Name</th>';
                       cell+= '</tr>';
                       for(var i=0; i<assesment.length; i++)
                       {
                              
                               cell+= '<tr>';
                               cell+= '<td>'+(i+1)+'</td>';
                               cell+= '<td>'+title[i]+'</td>';
                               cell+= '</tr>';    
                               console.log(table);                 
                       }
                         cell+= '</table>';
                         table.html( cell );
                        $('#modalForm1').modal('hide');
                       
                   }
      });

           </script>
      </div>




