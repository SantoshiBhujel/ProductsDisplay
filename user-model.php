<?php

    require_once 'database.php';

    class UserModel
    {
        function login ($username, $password)
        {
            $database=new Database();
            $parameters=[ 
            'username'=>$username,
            'password'=>$password
            ];

            $sql ='select * from users where username=:username AND userpassword= md5(:password)';

            $rows= $database->fetchAll($sql, $parameters);
            if(count($rows)==0)
                return "No match Found";
            return count($rows)>0;
        }
        
        function insert($username, $email, $contact , $pass, $image, $destination)
        {
            $database=new Database();
            $parameters=[              
            'username'=>$username,
            'email'=>$email,
            'contact'=>$contact,
            'password'=>$pass,
            'image'=>$image,
            'destination'=>$destination
            ];

            $sql = 'insert into users(username, email, contact, userpassword, image, destination) values(:username ,:email, :contact, md5(:password), :image, :destination)';
            return $database->execute($sql, $parameters);
        }

        function get_all() 
        {
            $database = new Database();
            $sql = 'select * from users';
            return $database->fetchAll($sql);
        }

        function get_id($username)
        {
            $database = new Database();
            $sql = 'select * from users where username=:username';
            return $database->fetchAll($sql);
        }

        function get_by_id($id)
        {
            $database= new Database();
            $parameters=[
                'userid'=> $id
            ];
            $sql = 'select * from users where userid = :userid';
            $row = $database->fetchAll($sql,$parameters);
            if(count($row)==0)
                return NULL;
            return $row[0];
        }

        function update($id,$username,$email, $contact, $password)
        {
            $database=new Database();
            
            $parameters=[                
            'userid'=> $id,
            'username'=>$username,
            'email'=> $email,
            'contact'=>$contact,
            'password'=>$password
            ];
            $sql ='update users set username= :username, email= :email, contact=:contact, userpassword= md5(:password) where userid= :userid';
            return $database->execute($sql,$parameters);
        }

        function update_image($id, $image, $destination)
        {
            $database=new Database();
            
            $parameters=[                
            'userid'=> $id ,
            'image'=>$image,
            'destination'=>$destination
            
            ];
            $sql ='update users set image= :image, destination= :destination where userid= :userid';
            return $database->execute($sql,$parameters);
        }

        function delete($id)
        {
            $database=new Database();
            $parameters=[ 
                'userid'=> $id
            ];
            $sql ='delete from users where userid= :userid';
            return $database->execute($sql,$parameters);
        }      
}