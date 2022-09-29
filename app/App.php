<?php
declare(strict_types = 1);
    
############ getTransactionFiles ############
    function getTransactionFiles(string $dirPath): array
    {
        $files = [];
        foreach(scandir($dirPath) as $file){
            if(is_dir($file)){
                continue;
            }
            $files[] = $dirPath . $file;
        }
        return $files;
    }

############ getTransaction ############
    function getTransactions(string $fileName): array
    {
        if(! file_exists($fileName)){
            trigger_error('File' . $fileName . 'does not exist.', E_USER_ERROR);
        }

        $file = fopen($fileName, 'r');
        fgetcsv($file); # removes the first row
        $transactions = [];        
        while(($transaction = fgetcsv($file))!= false){
            $transactions[] = $transaction;
        }
        return $transactions;
    }
?>