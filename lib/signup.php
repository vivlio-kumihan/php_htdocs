<?php

require_once('config.php');
require_once('helpers/db_helper.php');
require_once('helpers/extra_helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = get_post('name');
  $email = get_post('email');
  $password = get_post('password');

  $db_ins = get_db_connect();
  $errs = [];
}

include_once('views/signup_view.php');