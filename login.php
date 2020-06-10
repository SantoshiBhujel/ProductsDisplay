<?php

    require_once 'user-model.php';  
    require_once 'functions.php';
    

    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //dd($password);
        
        $username_length=strlen($username);
        $password_length=strlen($password);


        if($username == NULL && $password == NULL) 
        {
            $error = "Enter username or password";
        }
        else
        {
            if($username_length>=3 && $password_length >= 5 && preg_match('/[A-Z]/', $password)
             && preg_match('/[a-z]/', $password) && preg_match('/[0-9]/', $password) &&  
             preg_match('/[\'^!?$%&*()}{@#~?><>,|=_+?-]/', $password))
            {   
                session_start(); 
                $user_model= new UserModel();
                if($user_model->login($username, $password))
                {
                       
                    $_SESSION['username']=$username;
                    //dd($_SESSION['username']);
                    $_SESSION['logged_in'] = true; 
                    header('Location: category.php');
                }

                else
                {
                    echo "Invalid user";
                }
            }
        
             else
             {
                 if($username_length < 3 )
                 {
                   $error="Username must be atleast 3 characters long !";
                 }
                if($password_length < 5)
                 {
                   $error="Password must be atleast 5 characters..";
                 }
                 elseif(!preg_match('/^[A-Z]/',$password) or !preg_match('/^[a-z]/',$password) or !preg_match('/[0-9]/', $password) or !preg_match('/^[\'^!�$%&*()}{@#~?><>,|=_+�-]/', $password) )
                 {

                 $error="At least one uppercase ,one lowercase and one punctuation character required in password . ";
                 }
            }
        }
    }

?>
    

<?php include('include/header.php')?>

<section class="register">
    <div class="container">
        <form method="POST" action="login.php">
            <h1>Login</h1>
            
            <div class="form-group">
                <i class="fa fa-user icon"></i>
                <label >Username</label>
                <input  type="text" placeholder="Username" name="username" id="username" autocomplete="off">

                <span id="nameerror"/> 
            </div>

            <div class="form-group">
                <i class="fa fa-key icon"></i>
                <label >Password</label>
                <input  type="password" name="password" id="password" autocomplete="off" placeholder="Password">

                <span class="error-message" id="passworderror"/>

                <?php if(isset($error)): ?>
                    <p><?php echo $error; ?></p>
                <?php endif; ?>
                    
            </div>

            <input type="submit" name="login" value="Login">
        </form>  
    </div>
</section>

            <?php if(isset($error_message)): ?>
                <p style="text-align: center;"><?php echo $error_message; ?></p>
            <?php endif; ?> 

