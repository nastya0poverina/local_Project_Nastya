<?php
  require_once 'header.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    echo "<br><div class='center'>Вы вышли из своего аккаунта <a data-transition='slide' href='index.php?r=$randstr'>нажмите здесь</a>чтобы вернуться на главную страницу.</div>";
  }
  else echo "<div class='center'>Вы не можете выйти из аккаунта который не существует</div>";
?>
    </div>
  </body>
</html>