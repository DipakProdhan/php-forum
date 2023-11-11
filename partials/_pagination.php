<?php

$items = 5;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($currentPage - 1) * $items;

$query = "SELECT * FROM threads LIMIT $item OFFSET $offset";





?>