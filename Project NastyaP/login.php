<?php
    require_once 'header.php';
    $error = $user = $password = "";
    if (isset($_POST['user'])){
        $user = sanitizeString($_POST['user']);
        $password = sanitizeString($_POST['password']);
        
        if ($user == "" or $password == ""){
            $error = 'не все поля введены';
        }else{
            $result = queryMysql("SELECT user, password FROM members WHERE user='$user' AND password='$password'");
            
            if ($result->num_rows){
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $password;
                die("ВЫ успешно зарегистрировались, пожалуйста <a data-transition='slide'
                     href='members.php?view=$user'>нажмите здесь</a> что бы продолжить</div> </body></html>");                
            }else{
                $error = "Неправильно веденые или получены данные о пользователе";
            }
        }
    }
    
    echo <<<_END
      <form method='post' action='login.php?r=$randstr'>
        <div data-role='fieldcontain'>
          <label></label>
          <span class='error'>$error</span>
        </div>
        <div data-role='fieldcontain'>
          <label></label>
          Введите свои данные что бы зарегистрироваться
        </div>
        <div data-role='fieldcontain'>
          <label>Имя пользователя</label>
          <input type='text' maxlength='16' name='user' value='$user'>
        </div>
        <div data-role='fieldcontain'>
          <label>Пароль</label>
          <input type='password' maxlength='16' name='password' value='$password'>
        </div>
        <div data-role='fieldcontain'>
          <label></label>
          <input data-transition='slide' type='submit' value='Зарегистрироваться'>
        </div>
      </form>
    </div>
  </body>
</html>
_END;
?>