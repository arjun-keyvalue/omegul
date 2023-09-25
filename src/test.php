<?php
use Netsensia\Usernames\Generator;

require_once '../index.php';

// $user = new User();
// $user->setUsername('lolol');
// $user->save();

// $msg = new Message();
// $msg->setUser($user);
// $msg->setContent("hellooo");
// $msg->save();

// $conn = Propel::getConnection();
// $sql = "SELECT * FROM author WHERE id = '" . $_GET["id"] . "'";

// $stmt = $conn->prepare($sql);
// $stmt->execute();

// $res = $stmt->fetchAll();
// print_r($res);

// $gen = new Generator();
// echo str_replace(" ", "", $gen->generate(random_int(2, 3)));

echo $_SERVER['REMOTE_ADDR'];