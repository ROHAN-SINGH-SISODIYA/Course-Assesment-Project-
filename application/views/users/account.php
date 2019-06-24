<!DOCTYPE html>
<html lang="en">  
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container"> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a href="<?php echo site_url('dashboard');?>" class="navbar-brand">My Application</a>
        </div>
        
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url('dashboard/course');?>">Course</a></li>
                <li><a href="<?php echo site_url('dashboard');?>">Assesment</a></li>           
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="<?php echo site_url('Users/logout');?>">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong>Logout</strong>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <h2>User Account</h2>
    <h3>Welcome <?php echo $user['name']; ?>!</h3>
    <div class="account-info">
        <p><b>Name: </b><?php echo $user['name']; ?></p>
        <p><b>Email: </b><?php echo $user['email']; ?></p>
        <p><b>Phone: </b><?php echo $user['phone']; ?></p>
        <p><b>Gender: </b><?php echo $user['gender']; ?></p>
    </div>
</div>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>