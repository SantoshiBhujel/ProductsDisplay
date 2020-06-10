<?php 
    require_once 'user-model.php';  
    $page_title="REGISTER";
    session_start();
  
    if(isset($_POST['save_button']))
    {
        $username=$_POST['username'];   //if(!preg_match('/^[a-zA-Z]+$/',$username))       
        $email=$_POST['email'];    // (filter_var( $email, FILTER_VALIDATE_EMAIL))//INBUILT FUNCTION TO VALIDATE THE EMAIL
        $contact=$_POST['contact'];
        $password=$_POST['password'];
        $retyped_password =$_POST['retyped_password'];
            {
                
                $fileName = $_FILES['image']['name'];
                $fileTmpName = $_FILES['image']['tmp_name'];
                $fileSize = $_FILES['image']['size'];
                $fileError = $_FILES['image']['error'];
                $fileType = $_FILES['image']['type'];
                //dd($_FILES);
                $fileExt = explode('.',$fileName); 
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpeg','jpg','png');

                if(!in_array($fileActualExt, $allowed))
                {
                    echo "You cannot upload file of this extension!";
                    return;
                }

                if($fileError !== 0)
                {
                    echo "There was an error uploading file!";
                    return;
                }

                if($fileSize > 5 * 1024 * 1024) // 5 MB
                {
                    echo "Your file is too large!"; 
                    return;
                }

                $fileNameNew = time().".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination); 
            }
            
        if($password ==  $retyped_password)
        {
            
            $user_model=new UserModel(); 
            $rows_affected=$user_model-> insert($username, $email, $contact, $password, $fileNameNew, $fileDestination);
            if($rows_affected>0)
            {
                $_SESSION['username']= $username;
                $_SESSION['logged_in'] = true;
                header('Location: user.php');
            }
        }
        else
        {
            $error= "Password does not match";
        }
    }
?>
<?php include('include/header.php')?>

    <section class="register">
        <div class="container">
        <form method="POST" action="register.php" enctype="multipart/form-data" onsubmit="return validate();">
                <h1>Sign Up</h1>
                
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <label >Username</label>
                    <input class="input-field" type="text" placeholder="Username" name="username" id="name" autocomplete="off">
                    <span class="error-message" id="nameerror"/>
                </div>

                <div class="form-group">
                    <i class="fa fa-envelope icon"></i>
                    <label>Email</label>
                    <input class="input-field" type="text" name="email" id="email" autocomplete="off" placeholder="john@gmail.com">
                    <span id="emailerror"/>
                </div>
            

                <div class="form-group">
                    <i class="fa fa-dial icon"></i>
                    <label for="inputAddress">Contact</label>
                    <input class="input-field" type="text" name="contact" id="contact" autocomplete="off" placeholder="1234567890">
                    <span id="contacterror"/>
                    
                </div>

                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <label >Password</label>
                    <input class="input-field" type="password" name="password" id="password" autocomplete="off" placeholder="Password">
                    <span class="error-message" id="passworderror"/>
                </div>

                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <label >Retype Password</label>
                    <input type="password" name="retyped_password" id="confirm"  autocomplete="off">
                    <span class="error-message" id="retypedpassworderror"/>
                    <?php if (isset($error)):?>
                        <span><?php echo $error;?></span>
                    <?php endif;?>
                </div>

                <div class="form-group">
                    <label >Upload profile picture?</label>
                    <img src="image/man.png" style="width:50px">
                    
                    <input type="file" name="image"/>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>

                <input type="submit" value="Save" name="save_button">
            </form>
        </div>
    </section>
    <script src="javascript.js">
    </script>
    
<?php include('include/footer.php')?>