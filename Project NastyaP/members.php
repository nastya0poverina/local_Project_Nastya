<?php
    require_once 'header.php';
    if (!$loggedin) die ("</div></body></html>");
    
    if (isset($_GET['view'])){
        $view = sanitizeString($_GET['view']);
        
        if ($view == $user) $name = "Your";
        else $name = "'$view'";
        
        echo "<h3>Профиль пользователя $name</h3>";
        showProfile($view);
        die ("</div></body></html>");
    }
    
    $result = queryMysql("SELECT user FROM members ORDER BY user");
    $num = $result->rowCount();
    
    while ($row = $result->fetch()){
        echo "<li><a data-transition='slide' href='members.php?view=" . $row['user'] . "&$randstr'>" . $row['user'] . "</a>";
        echo " [<a data-transition='slide' href='members.php?remove=" . $row['user'] . "&r=$randstr'>drop</a>]";
    }
    ?>
    </ul></div>
  </body>
</html>