<?php

function is_user_loggedIn(){
  if($_SESSION['LoggedIn'] && !empty($_SESSION["LoggedIn"])){
    return true;
  }
}
function is_token_set(){
  if(!isset($_GET['token']) || !isset($_SESSION['token'])){
    return true;
  }
}