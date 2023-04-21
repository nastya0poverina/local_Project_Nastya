<?php
$db_host = 'localhost';
$db_name = 'project_db';
$db_user = 'project_user';
$db_password = 'project_password';

$connect = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($connect->connect_error) die("Fatal Error");

function queryMysql($query) {
    global $connect;
    $result = $connect->query($query);
    if (!$result) die("Fatal Eror");
    return $result;
}

function create_table($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Таблица '$name' создана или уже существует<br>";
}

function delete_brows_session() {
    $_SESSION=array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');
    
    session_destroy();
}

function sanitizeString($var) {
    global $connect;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
        $var = stripslashes($var);
    return $connect->real_escape_string($var);
}

function showProfile($user) {
    if(file_exists("$user.jpg"))
        echo "<img src='user.jpg' align = 'left'>";
    
        $result = queryMysql("SELECT * FROM profiles WHERE user = '$user'");
        
        if ($result->num_rows){
            $row = $result->fetch_array(MYSQL_ASSOC);
            echo stripslashes($row['text']) . "<br style='clean:left;'><br>";
        }
        else echo "<p>Здесь пока что не на что смотреть</p><br>";      
}
?>