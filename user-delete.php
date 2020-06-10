
<?php

    include 'session.php';
    require_once 'user-model.php';
    $page_title="User Delete";
   
   
    if(!isset($_POST['submit']))
    {
        $id= $_GET['id']; //value from url parameter
    }

    else
    {
        $id= $_POST['id']; //value from hidden field
        $user_model=new UserModel;

        if($user_model->delete($id))
        {
            header('Location: user.php');
        }

        else
        {
            $error="User could not be deleted";
        }
    }

?>

<?php include('include/header.php')?>
<?php include('include/dashboard.php')?>  
    <p>Are you sure?</p>

    <form method="POST" action="user-delete.php">

        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" value="DELETE?" name='submit'>

        <?php if (isset($error)):?>
            <span>
                    <?php echo $error;?>
            </span>
        <?php endif;?>

    </form>

    <a href="user.php" class="sub"> NO </a>

<?php include('include/footer.php')?>