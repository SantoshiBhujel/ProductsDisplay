function validate()
    {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var password= document.getElementById('password').value;
        var confirm= document.getElementById('confirm').value;
        //return name.value !='';
        //
        if(name=='')
        {
            var content = document.getElementById("nameerror") ;
            content.innerHTML='The text field is empty!';
            return false;
        }

        if(name.length<5 )
        {
            var content = document.getElementById("nameerror") ;
            content.innerHTML='Username length must be greater than 5!';
            return false;
        }

        var namepattern= /^[A-Za-z_]{1,}[A-Za-z0-9_.]*$/;
        if(namepattern.test(name)==false)
        {
            var content = document.getElementById("nameerror") ;
            content.innerHTML='Invalid username format';
            return false;
        }
        
        if(email=='')
        {
            var content = document.getElementById("emailerror");
            content.innerHTML='Email field cannot be empty!';
            return false;
        }

        var emailpattern=/^[A-Za-z0-9.-_]+@[A-Za-z0-9]+[.]{1}[A-Za-z0-9]+(.[A-Za-z]{2,})*$/;
        if(emailpattern.test(email)==false){
            var content=document.getElementById("emailerror");
            content.innerHTML="Invalid Email Format";
            return false;
        }
           
        if(password=='')
        {
            var content = document.getElementById("passworderror");
            content.innerHTML='Password field cannot be empty!';
            return false;
        }

        if(password.length<10 )
        {
            var content = document.getElementById("passworderror") ;
            content.innerHTML='Password length must be greater than 10!';
            return false;
        }

        passwordValidate(password);

        if(confirm==''){
            var content= document.getElementById("retypedpassworderror");
            content.innerHTML="Password confirmation field cannot be empty ";
            return false;
        }

    }

    function passwordValidate(password)
    {
        if ((/^[A-Z]{1,}$/.test(password)==false) || (/^[a-z]{1,}$/.test(password)==false) || (/^[0-9]{1,}$/.test(password)==false) || (/^[-_.@?(){}':;"]{1,}$/.test(password)==false))
        {
            var content= document.getElementById("passworderror");
            content.innerHTML="Password must contain at least one capital letter, one small letter, one digit and one punctuation ";
            return false;
        }
    }

    function session_active()
    {
        if($SESSSION==1)
        {

        }
    }