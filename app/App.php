<?php
declare(strict_types = 1);
    
############ GET FILES ############
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

############ GET FILES DATA ############
    function getTransactions(string $fileName): array
    {
        if(! file_exists($fileName)){
            trigger_error('File' . $fileName . 'does not exist.', E_USER_ERROR);
        }
        $file = fopen($fileName, 'r');
        fgetcsv($file); # removes the first row
        $transactions = [];        
        while(($transaction = fgetcsv($file))!= false){
            $transactions[] = extractTransactions($transaction);
        }
        return $transactions;
    }

############ RETRIEVE AMOUNT ############
    function extractTransactions(array $transactionRow): array
    {
        [$date, $checkNumber, $description, $amount] = $transactionRow; # list
        $amount = (float) str_replace(['$', ','], '', $amount);
        return [
            'date' => $date,
            'checkNumber' => $checkNumber,
            'description' => $description,
            'amount' => $amount,
        ];
    }

############ CALCULATE TOTALS ############
    function calculateTotal(array $transactions): array
    {
        $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];
        foreach($transactions as $transaction){
            $totals['netTotal'] += $transaction['amount'];
            if($transaction['amount'] >= 0){
                $totals['totalIncome'] += $transaction['amount'];
            } else{
                $totals['totalExpense'] += $transaction['amount'];
            }
        }
        return $totals;
    }
?>