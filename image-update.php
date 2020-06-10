<?php
    include 'session.php';
    require_once 'user-model.php';
    $user_model= new UserModel();
    

    if(!isset($_POST['update']))
    {

        $id=$_GET['id'];
        $user= $user_model->get_by_id($id);
        $image= $user['image'];
        $destination=$user['destination'];
    }

    if(isset($_POST['update']))
    { 
            $id=$_POST['id'];
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

        $user_model-> update_image ($id, $fileNameNew, $fileDestination);
        header('location: user.php');
    }

?>


<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>

<div class="container">
        <form method="POST" action="image-update.php" enctype="multipart/form-data">
                <h1>Update Profile Picture</h1>
                <?php echo "<img src='{$user['destination']}' alt='no image' style='width:100px; height:100px'/>"?> 
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
                <div class="form-group">
                    <label >Change Profile Picture?</label>

                    <input class="input-field" type="file" name="image" id="image" autocomplete="off" >
                    <span class="error-message" id="nameerror"/>
                </div>

            <input type="submit" value ="Update" name="update">
        </form>

<?php include('include/footer.php')?>