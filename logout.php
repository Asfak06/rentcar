<?php

if(isset($_SESSION['user_id']) && isset($_GET['logout']) ){
    session_unset();
    session_destroy();
    setcookie("rememberme", "", time()-3600);
    
}

?>