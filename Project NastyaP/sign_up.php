<?php
    require_once 'header.php';
    
    echo <<<_END
        <script>
            function userCheck($user){
                if (user.value == ''){
                    $('#used').html('$nbsp;')
                    return
                }
                $.post('usercheck.php', {user : user.value}, function(data){ $('#used').html(data)})
            }
        </script>
    _END;
    
    $error = $user = $password = "";
    if (isset($_SESSION['user'])){
        delete_brows_session();
    }
    
    if (isset($_POST['user'])){
        $user = sanitizeString($_POST['user']);
        $password = sanitizeString($_POST['password']);
        
        if ($user == "" or $password == "") $error = 'Не заполнены поля для ввода данных о пользователе<br><br>';
        else{
            $result = queryMysql("SELECT * FROM members WHERE user = '$user'");
            
            if ($result -> num_rows) $error = "Это имя уже зарегистрированы, придумайте уникальное имя <br><br>";
            else{
                queryMysql("INSERT INTO members VALUES('$user', '$password')");
                die('<h4>Аккаунт создается</h4>Пожалуйста, зарегистрируйтесь</div></body><html>');
            }
        }     
    }
    
    echo <<<_END
      <form method='post' action='sign_up.php?r=$randstr'>$error
      <div data-role='fieldcontain'>
        <label></label>
        ВВедите данные пользователся, чтобы зарегистрироваться
      </div>
      <div data-role='fieldcontain'>
        <label>Имя</label>
        <input type='text' maxlength='16' name='user' value='$user'
          onBlur='userCheck(this)'>
        <label></label><div id='used'>&nbsp;</div>
      </div>
      <div data-role='fieldcontain'>
        <label>Пароль</label>
        <input type='text' maxlength='16' name='password' value='$password'>
      </div>
      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' value='Войти'>
      </div>
    </div>
  </body>
</html>
_END;
?>    