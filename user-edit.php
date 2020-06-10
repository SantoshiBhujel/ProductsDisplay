<?php
    include 'session.php';
    require_once 'user-model.php';
    $user_model= new UserModel();
    
    
        if(!isset($_POST['save']))
        {
            $id=$_GET['userid'];
            $user= $user_model->get_by_id($id);
            $username= $user['username'];
            $email=$user['email'];
            $contact=$user['contact'];
            $password=$user['password'];
        }


        else
        {
            $id= $_POST['id'];
            $username=$_POST['username'];
            $email=$_POST['email'];  
            $contact=$_POST['contact'];
            $password=$_POST['password'];
            $user_model-> update($id, $username, $email, $contact, $password);
            header('location: user.php');
        }

?>

<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>


<section class="register">
        <div class="container">
        <form method="POST" action="user-edit.php" enctype="multipart/form-data" onsubmit="return validate();">
                <h1>Update User Information</h1>
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <div class="form-group">
                    <i class="fa fa-user icon"></i>
                    <label >Username</label>
                    <input class="input-field" type="text" placeholder="Username" name="username" id="name" autocomplete="off" value="<?php if(isset($username)) echo $username;?>">
                    <span class="error-message" id="nameerror"/>
                </div>

                <div class="form-group">
                    <i class="fa fa-envelope icon"></i>
                    <label>Email</label>
                    <input class="input-field" type="text" name="email" id="email" autocomplete="off" placeholder="john@gmail.com" value="<?php if(isset($email)) echo $email;?>">
                    <span id="emailerror"/>
                </div>
            

                <div class="form-group">
                    <i class="fa fa-dial icon"></i>
                    <label for="inputAddress">Contact</label>
                    <input class="input-field" type="text" name="contact" id="contact" autocomplete="off" placeholder="1234567890" value="<?php if(isset($contact)) echo $contact;?>">
                    <span id="contacterror"/>
                    
                </div>

                <div class="form-group">
                    <i class="fa fa-key icon"></i>
                    <label >Password</label>
                    <input class="input-field" type="password" name="password" id="password" autocomplete="off" placeholder="Password" value="<?php if(isset($password)) echo $password;?>">
                    <span class="error-message" id="passworderror"/>
                </div> 
                <input type="submit" value ="UPDATE" name="save">     
            </form>
        </div>
    </section>
<?php include('include/footer.php')?>