<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register page</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="pages/assets/css/style.css?v=1.0">
        
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> </a>
                </div>
        
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav ">
                        <li>
                            <a href="index.php?page=accounts&action=edit">My account</a>
                        </li>
                        <li class="active">
                            <a href="index.php?page=tasks&action=create"  >Add New Task</a>
                        </li>
                        <li >
                            <a href="index.php?page=tasks&action=all">Tasks</a>
                        </li>
                        <li>
                            <a href="index.php?page=accounts&action=logout">Logout</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="new-task-form">
                        
                        <form class="form-horizontal"  action="index.php?page=tasks&action=edit&id=<?php echo $data->id; ?>" method="post">
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Message:</label>
                            <div class="col-sm-10">
                                <textarea name="message" id="task" class="form-control" rows="3" required="required"><?php echo $data->message; ?></textarea>
                              
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Due Date </label>
                            <div class="col-sm-10">
                               <input type="date" name="duedate" id="inputDuedate" class="form-control" value="<?php echo date('Y-m-d',strtotime($data->duedate)); ?>" required="required" title="">
                              
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">isDone </label>
                            <div class="col-sm-10">
                               <select name="isdone" id="inputIsdone" class="form-control" required="required">
                                   <option value="0" <?php if($data->isdone=='0'){ echo 'selected';} ?> >No</option>
                                   <option value="1" <?php if($data->isdone=='1'){ echo 'selected';} ?>>yes</option>
                               </select>
                              
                            </div>
                          </div>
                          <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-success">Save</button>
                              <a href="index.php?page=tasks&action=all" class="btn btn-default">Cancel</a>
                              <a href="index.php?page=tasks&action=delete&id=<?php echo $data->id; ?>" class="btn btn-danger">Delete</a>
                            </div>
                          </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>



        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container">
                <a class="navbar-brand" href="#"> </a>
            </div>
        </nav>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
         <script src="Hello World"></script>
    </body>
</html>