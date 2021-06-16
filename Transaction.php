<?php
    $conn = mysqli_connect('localhost', 'root', 'Balaji881@', 'customers');
    if ($conn->connect_error) {
        die("Connection Failed:" . $conn->connect_error);
    }
    if (isset($_POST['transfer'])) {
        $From = $_POST['from'];
        $TO = $_POST['to'];
        $Amt = $_POST['amt'];
        $dt = date("Y-m-d H:i:s");
    }
   $sql = "SELECT Account_Balance from customer_details WHERE Holder_Name = '$From' ";
    $query1 = mysqli_query($conn, $sql);
    while ($rs = mysqli_fetch_assoc($query1)) {
        $SBAL = $rs['Account_Balance'];
    }
    $sql2 = "SELECT Account_Balance from customer_details WHERE Holder_Name = '$TO' ";
    $query2 = mysqli_query($conn, $sql2);
    while ($rs = mysqli_fetch_assoc($query2)) {
        $RBAL = $rs['Account_Balance'];
    }
    if( $SBAL >= $Amt ) {
        $message = "Transfer Successful";
echo "<script type='text/javascript'>alert('$message');</script>";
     $SBAL = $SBAL - $Amt;
    $RBAL = $RBAL + $Amt;
        $stmt = $conn->prepare("INSERT INTO transfers(SENDER, RECEIVER, AMOUNT, DT)
     values(?,?,?,?)");
        $stmt->bind_param("ssss", $From, $TO, $Amt, $dt);
        $stmt->execute();
        header("Location: Transaction.html");
     $ret = "UPDATE customer_details SET  Account_Balance = '$SBAL' WHERE Holder_Name = '$From' ";
        $conn->query($ret);
        $ter = "UPDATE customer_details SET  Account_Balance = '$RBAL' WHERE Holder_Name = '$TO'";
        $conn->query($ter);

    }
    else{
        echo "<script>alert('Insufficient Funds!')</script>";
    }



?>
