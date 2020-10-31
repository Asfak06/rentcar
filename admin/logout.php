<?php

if(isset($_SESSION['pass']) && isset($_GET['logout']) ){
    session_unset();
    session_destroy();   
}
?>