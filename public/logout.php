<?php

require_once __DIR__ . '/../boot.php';
session_start();
session_destroy();
redirect('index.php');