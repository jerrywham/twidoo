<?php require_once('common.php'); 
$filter = (isset($_['filter'])?explode(',',$_['filter']):array());

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Twidoo, minimalistic to-do list</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Minimalistic to-do list by Idleman">
    <meta name="author" content="Idleman">

    <!-- Le styles -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="./favicon.ico">
  </head>

  <body>

    <div class="navbar">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="logo" href="#"></a>
          
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#"><i class="icon-home icon-white"></i> Accueil</a></li>
              <li><a href="http://blog.idleman.fr"><i class="icon-eye-open icon-white"></i> A propos</a></li>
              <li>
                <?php if(!$myUser){ ?>
                <form class="loginForm" action="action.php?action=login" method="POST">
                  <input type="text" name="login" class="input-mini loginInput" placeholder="Login"><input type="text" name="password" class="input-mini passwordInput" placeholder="Password">
                  <button class="btn btn-inverse"><i class="icon-user icon-white"></i></button>
                </form>
                <?php }else{ ?>
                  <p class="loginBloc"><i class="icon-user icon-white"></i> <?php echo $myUser->login; ?> - <a class="btn btn-inverse" href="action.php?action=logout">D&eacute;connexion</a></p>
                <?php } ?>
              </li>
            </ul>
          </div><!--/.nav-collapse -->

        </div>
      </div>
    </div>

    <div class="container">
        <div class="well-mini form-inline">
          <div class="btn-group pull-left margin5r">
            <button class="btn" onclick="window.location='index.php?filter=0,1';"><i class="icon-home"></i></button>
            <button class="btn <?php echo (isset($filter[0]) && $filter[0]==0 && count($filter)==1?'btn-primary':'') ?>" onclick="window.location='index.php?filter=0';">A faire</button>
            <button class="btn <?php echo (isset($filter[0]) && $filter[0]==1 && count($filter)==1?'btn-primary':'') ?>" onclick="window.location='index.php?filter=1';">En cours</button>
            <button class="btn <?php echo (isset($filter[0]) && $filter[0]==2 && count($filter)==1?'btn-primary':'') ?>" onclick="window.location='index.php?filter=2';">Fait</button>
          </div>
          
            <input type="text" name="taskDate" class="input-mini" placeholder="JJ/MM/YYYY">
         
            <div class="hidden-desktop"><br/></div>
          <div class="input-append">
            <input type="text" name="taskName" class="input-xxlarge" placeholder="T&acirc;che">
            <button id="addTaskButton" class="btn btn-primary"><i class="icon-plus icon-white"></i></button>
          </div>
        </div>

  
<div id="errorMessage" class="alert alert-error hide">
          <button class="close" data-dismiss="alert" type="button">×</button>
        <strong></strong>
        <span></span>
        </div>

        <div id="infoMessage"  class="alert alert-info hide">
          <button class="close" data-dismiss="alert" type="button">×</button>
        <strong></strong>
        <span></span>
        </div>
   
        
        
         
    <?php if($myUser!=false){ ?>
      <div class="row show-grid">
        <?php 

        $tasks = get_tasks($filter); 

        foreach($tasks as $task){ ?>
        <div class="span12 todo-list-item">
          
          <?php 
          switch($task['s']){ 
               case '0': 
                echo '<span onclick="changeTaskState(\''.$task['i'].'\',1,this);" class="label label-important label-todo pointer"><i class="icon-remove icon-white"></i> <span>A faire </span></span>';
               break;
               case '1': 
                echo '<span onclick="changeTaskState(\''.$task['i'].'\',2,this);" class="label label-info label-todo pointer"><i class="icon-time icon-white"></i> <span>En cours </span></span>';
               break;
               case '2': 
                echo '<span onclick="changeTaskState(\''.$task['i'].'\',0,this);" class="label label-success label-todo pointer"><i class="icon-ok icon-white"></i> <span>Fait </span></span>';
               break; 
          } 
          ?>

             <?php echo $task['n']; ?><?php if($task['d']!=''){ ?> -  <em><i class="icon-calendar"></i><?php } ?> <?php echo $task['d']; ?></em>  <button onclick="deleteTask('<?php echo $task['i']; ?>',this);" class="btn btn-mini btn-danger pull-right"><i class="icon-minus-sign icon-white"></i></button> <!--<button onclick="updateTask('<?php echo $task['i']; ?>',this);" class="btn btn-mini pull-right margin5r"><i class="icon-pencil"></i></button>-->
        </div>
        <?php } ?>

      </div>
      <?php }else{ ?>

      <p>Vous devez &ecirc;tre connect&eacute; pour acceder aux t&acirc;ches</p>

      <?php } ?>

      <br/>
<!--
    <div class="btn-group">
       <button class="btn">«</button> 
        <button class="btn">1</button>
        <button class="btn">»</button>
    </div>
-->

      <hr>

      <footer>
        <p><em>Twidoo</em> - minimalistic to-do list by <a href="http://blog.idleman.fr" target="_blank">idleman</a></p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/main.js"></script>

  </body>
</html>
