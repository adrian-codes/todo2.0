<header id="main_header">
        <img src="images/todo_logo.gif" class="logo logo_large">
        <nav id="main-nav">
            <ul>
                <li><a>Register</a></li>
                <?php
                if(isset($_SESSION['userinfo'])){
                    echo "<li><a href='actions/logout.php'>Logout</a></li>";
                }
                else{
                    echo "<li><a href='actions/loginform.php'>Login</a></li>";
                }
                ?>
                <li><a>About-us</a></li>
                <li><a>Account</a></li>
            </ul>
        </nav>
    </header>