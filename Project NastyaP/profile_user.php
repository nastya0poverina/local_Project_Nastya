<?php
    require_once 'header.php';
    
    if ($loggedin == False) die("</div></body></html>");
    echo "<h3>Ваш профиль</h3>";
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    
    if (isset($_POST['text'])){
        $text = sanitizeString($_POST['text']);
        $text = preg_replace('/\s\s+/', ' ', $text);
        
        if($result->num_rows) queryMysql("UPDATE profiles SET text='$text' WHERE user='$user'");
        else queryMysql("INSET INTO profiles VALUES('$user', '$text')");
    }else{
        if ($result->num_rows){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $text = stripcslashes($row['text']);
        }else $text = "";
    }
    
    $text = stripcslashes(preg_replace('/\s\s+/', ' ', $text));
    
    showProfile($user);
    
    echo <<<_END
      <form data-ajax='false' method='post'
        action='profile.php?r=$randstr' enctype='multipart/form-data'>
      <h3>Enter or edit your details and/or upload an image</h3>
      <textarea name='text'>$text</textarea><br>
      Image: <input type='file' name='image' size='14'>
      <input type='submit' value='Save Profile'>
      </form>
    </div><br>
  </body>
</html>
_END;
?>