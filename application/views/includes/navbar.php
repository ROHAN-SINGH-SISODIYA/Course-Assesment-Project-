<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container"> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a href="<?php echo site_url('dashboard');?>" class="navbar-brand">KnackBout</a>
        </div>
        
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url('dashboard/course');?>">Course</a></li>
                <li><a href="<?php echo site_url('dashboard/Assesment_list');?>">Assesment List</a></li>           
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