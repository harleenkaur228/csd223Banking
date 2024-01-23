<?php include('navbar.php'); ?>
<?php

class account {
    private $balance;
    private $transactionHistory;

    public function __construct($initialBalance = 0) {
        $this->balance = $initialBalance;
        $this->transactionHistory = [];
    }

    public function credit($amount) {
        $this->balance += $amount;
        $this->recordTransaction('Credit', $amount);
    }

    public function debit($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $this->recordTransaction('Debit', $amount);
        } else {
            echo "Insufficient funds. Cannot debit $amount.\n";
        }
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getTransactionHistory() {
        return $this->transactionHistory;
    }

    private function recordTransaction($type, $amount) {
        $this->transactionHistory[] = [
            'type' => $type,
            'amount' => $amount,
            'balance' => $this->balance,
        ];
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223harleen";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : 0;

    if (isset($_POST['credit'])) {
        $sql = "INSERT INTO tbl_transaction (user_id, credit, debit, balance) VALUES ($userId, $amount, 0, 0)";
    } elseif (isset($_POST['debit'])) {
        $sql = "INSERT INTO tbl_transaction (user_id, credit, debit, balance) VALUES ($userId, 0, $amount, 0)";
    }

    $conn->query($sql);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
        body {
            background-color: #f2f2f2;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 14px 16px;
            display: inline-block;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        form {
            margin-top: 20px;
        }

        label, input, button {
            display: block;
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Credit or Debit</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" required>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required>
        <button type="submit" name="credit">Credit</button>
        <button type="submit" name="debit">Debit</button>
    </form>

    <h1>Transaction History</h1>

    <?php
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
    $sql = "SELECT * FROM tbl_transaction WHERE user_id = $userId";
    $result = $conn->query($sql);
    ?>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $runningBalance = 0;
                while ($row = $result->fetch_assoc()):
                    $runningBalance += ($row['credit'] - $row['debit']);
                ?>
                    <tr>
                        <td><?= $row['credit'] > 0 ? 'Credit' : 'Debit' ?></td>
                        <td>$<?= abs($row['credit'] + $row['debit']) ?></td>
                        <td>$<?= $runningBalance ?></td>
                    </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No transaction history available for this account.</p>
    <?php endif; ?>
</div>

<?php
$conn->close();
?>

</body>
</html>