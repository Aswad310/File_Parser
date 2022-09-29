<?php
    declare(strict_types = 1);

    # directory
    $root = dirname(__DIR__) . DIRECTORY_SEPARATOR; # /var/www/html/tfp/

    # constants
    define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR); # /var/www/html/tfp/app
    define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR); # /var/www/html/tfp/transaction_files/
    define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR); # /var/www/html/tfp/views/

    # include App.php
    require (APP_PATH.('App.php'));

    $files = getTransactionFiles(FILES_PATH);

    $transactions = [];

    foreach($files as $file){
        $transactions = array_merge($transactions, getTransactions($file));
    }

    // echo '<pre>';
    // print_r($transactions);
    // echo '</pre>';

    # include transactions.php file
    require (VIEWS_PATH . 'transactions.php');
?>