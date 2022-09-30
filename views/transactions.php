<!DOCTYPE html>
<html>
    <head>
        <title>File Parser</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head> 

    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="4"><h1>CSV File Parser To HTML</h1></th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
                <?php if(! empty($transactions)): ?>
                        <?php foreach($transactions as $transaction): ?>
                            <tr>
                                <td><?= formatDate($transaction['date']) ?></td>
                                <td><?= $transaction['checkNumber'] ?></td>
                                <td><?= $transaction['description'] ?></td>
                                <td>
                                    <?php if($transaction['amount'] < 0): ?>
                                        <span style="color: red;">
                                            <?= formatDollerAmount($transaction['amount']) ?>
                                        </span>
                                    <?php elseif($transaction['amount'] > 0): ?>
                                        <span style="color: green;">
                                            <?= formatDollerAmount($transaction['amount']) ?>
                                        </span>
                                    <?php else: ?>
                                        <?= formatDollerAmount($transaction['amount']) ?>
                                    <?php endif ?>
                                </td>
                            </tr>    
                        <?php endforeach ?>
                <?php endif ?>
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?= formatDollerAmount($totals['totalIncome'] ?? 0) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?= formatDollerAmount($totals['totalExpense'] ?? 0) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?= formatDollerAmount($totals['netTotal'] ?? 0) ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>