<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Fortin Sign In</title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/signup.css" rel="stylesheet">


    </head>

    <body>

        <div class="container">
            <form class="form-signin" role="form" action="checklogin.php" method="GET">

                <h2 class="form-signin-heading" >Login</h2>





                <input type="text" name="username" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" name="userpwd" class="form-control" placeholder="Password" required>   

                <?php
                if (isset($_REQUEST['login'])):
                    if (!empty($_REQUEST['login'])):
                        $login_param = $_GET['login'];
                        if ('failed' == $login_param):
                            ?>
                            <p style="color:red;">Invalid Login!!</p> 

                            <?php
                        endif;
                    endif;
                endif;
                ?>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div> <!-- /container -->

    </body>
</html>
