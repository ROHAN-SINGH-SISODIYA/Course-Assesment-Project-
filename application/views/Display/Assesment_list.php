 <?php $this->load->view('includes/navbar');?>
 
    <div class="container" style="margin-top: 50px;">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Assesment
                    <small style="color: red;">list</small>
                    <a href="<?php echo site_url("Assesment/assesment/");?>" class="btn  btn-xs  btn-primary  "   style="float: right;">Add New</a>
                    <?php

                    ?>
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
                     <?php
                       $cnt=0;
                       foreach ($Assesments as $value) {
                          
                           $Assesment_id_t= $value->Assesment_id ;
                           $title = $value->title;
                           $created_by = $value->created_by;
                           $created_time=$value->created_time;

                        $cnt++;
                            ?>
                                <tr>
                                <td style="text-align: center;"><?php echo$cnt;?></td>
                                <td style="text-align: center;"><?php echo $Assesment_id_t; ?></td>
                                <td style="text-align: center;"><?php echo  $title;?></td>
                                <td style="text-align: center;"><?php echo  $created_by; ?></td>
                                <td style="text-align: center;"><?php echo   $created_time;?> </td>
                                <td style="text-align:center;">
                                    <a href="<?php echo site_url("Assesment/assesment/$Assesment_id_t")?>" class="btn btn-warning btn-xs item_edit">Edit</a>
                                </td>
                                </tr>
                                <?php
                            }

                       ?>
                     
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
        $('#mydata').dataTable();
        function show_product(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('dashboard/Assesment_list_display')?>',
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
