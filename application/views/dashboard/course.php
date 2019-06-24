	<?php $this->load->view('includes/navbar'); ?>
	<div class="container" id="main" style="margin-top: 100px;">
		<a href="<?php echo base_url();?>/dashboard/add_course"><button style="float: right;" class="btn btn-success">Add Course</button></a>
	    <table class="table table-striped table-bordered" width="600" border="1" cellspacing="5" cellpadding="5">
		  <tr style="background:#CCC">
		  	<th>S.No.</th>
		    <th>Title</th>
		    <th>Discription</th>
		    <th>File</th>
		    <th>Edit</th>
			<th>Delete</th>
		  </tr>

		  <?php
		  $i=1;
		 // var_dump($data);exit();
		  foreach($data as $row)
		  {
		  echo '<tr>';
		  echo '<td>'.$i.'</td>';
		  echo '<td>'.$row->course_title.'</td>';
		  echo '<td>'.$row->course_desc.'</td>';
		  echo '<td>'.$row->file_name.'</td>';
		  echo '<td><button onclick="window.location.href=\''.base_url().'dashboard/add_course/'.$row->course_id.'\'" class="btn btn-info">Edit</button></td>';
		  echo '<td><button onclick="window.location.href=\''.site_url('Dashboard/Delete_data/').$row->course_id.'\'" class="btn btn-danger">Delete</button></td>';
		  echo '</tr>';
		  $i++;
		  }
		   ?> 
		</table>
	</div>




