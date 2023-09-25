<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMapFromDumps(array (
  'default' => 
  array (
    'tablesByName' => 
    array (
      'message' => '\\Map\\MessageTableMap',
      'secret' => '\\Map\\SecretTableMap',
      'users' => '\\Map\\UserTableMap',
    ),
    'tablesByPhpName' => 
    array (
      '\\Message' => '\\Map\\MessageTableMap',
      '\\Secret' => '\\Map\\SecretTableMap',
      '\\User' => '\\Map\\UserTableMap',
    ),
  ),
));
