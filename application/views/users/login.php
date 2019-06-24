    <!DOCTYPE html>
    <html lang="en">  
    <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <!-- CSS -->    
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    </head>
    <body>
    <div class="container">
        <h2>User Login</h2>
        <?php
        if(!empty($success_msg)){
            echo '<p class="statusMsg">'.$success_msg.'</p>';
        }elseif(!empty($error_msg)){
            echo '<p class="statusMsg">'.$error_msg.'</p>';
        }
        ?>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="Email" required="" value="">
                <?php echo form_error('email','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Password" required="">
              <?php echo form_error('password','<span class="help-block">','</span>'); ?>
            </div>
            <div class="form-group">
                <input type="submit" name="loginSubmit" class="btn-primary" value="Submit"/>
            </div>
        </form>
        <p class="footInfo">Don't have an account? <a href="<?php echo base_url(); ?>users/registration">Register here</a></p>
    </div>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
    </html>