<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <ul class="navbar-nav">
            <?php
            if($GLOBALS['Current_User'] == null)
            {
              echo '<li class="nav-item">
                <a class="nav-link" href="../users/login">Login</a>
              </li>';
            }
            else
            {
              echo '<li>
                <a class="nav-link" href="../users/profile">'.$GLOBALS['Current_User']['email'].'</a>
              </li>';
            }
            ?>
          </ul>
        </nav>
    </header>
    <body>
