<?php

    require_once 'database.php';
    require_once 'user-model.php';
    require_once 'functions.php';
    $page_title='User List';
   
    $user_model=new UserModel;
    $rows= $user_model->get_all();
    //dd($rows);

?>

<?php include('include/header.php') ?>
<?php include('include/dashboard.php')?>
    <a class= "button" href="register.php"> NEW USER</a>

    <table style="margin-top: 60px; margin-left:100px; border:1px solid skyblue" cellspacing="20px" cellpadding="20px">
        <tr >
            <th>ID</th>
            <th>Image</th>
            <th>Username</th>
            <th>Email</th>
            <th>Contact</th>
            <th colspan="2">Action</th>
        </tr>
        
        <?php foreach($rows as $row):?>
        
            <tr style="border:1px solid skyblue">

                <td> <?php echo $row['userid']?> </td>
                <td> 
                    <?php echo "<img src='{$row['destination']}' alt='no image' style='width:100px; height:100px'/>"?> 
                    <a href="image-update.php?id=<?php echo $row['userid'];?>" > Change picture?</a>
                </td>
                <td> <?php echo $row['username'];?> </td> 
                <td> <?php echo $row['email']?> </td>
                <td> <?php echo $row['contact']?> </td>
                
                <td>
                    <a href="user-edit.php?userid=<?php echo $row['userid'];?>" class="button">
                        EDIT 
                    </a> 
                </td>

                <td>
                    <a href="user-delete.php?id=<?php echo $row['userid'];?>" class="button">
                        DELETE
                    </a> 
                </td>
                
            </tr>
        <?php endforeach;?>

    </table>   

<?php include('include/footer.php')?>

