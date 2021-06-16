<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer History</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <style>
        table {
            border: 4px solid white;
            border-radius: 2px;
            width: 100%;
            color: #588c7e;
            font-family: 'Poppins', sans-serif;
            font-size: 25px;
            text-align: center;
        }
        th {
            background-color: #39603d;
            color: #ffff;
        }
        .header{
            font-family: 'Poppins', sans-serif;
            color:#3C403D;
            display: flex;
            justify-content: center;
            padding-top: 2vh;
            padding-bottom: 2vh;
        }
        tr:nth-child(even){
           background-color: #daded4;
           color:#3C403D;
        }
        .home-btn{
            padding-top: 10px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="header">TRANSACTION HISTORY</div>
    <div class="table">
<table>
        <tr>
            <th>TRANSACTION ID</th>
            <th>SENDER</th>
            <th>RECEIVER</th>
            <th>DATE/TIME</th>

        </tr>
        <?php
        $conn = mysqli_connect('localhost', 'root', 'Balaji881@', 'customers');
        if ($conn->connect_error) {
            die("Connection Failed:" . $conn->connect_error);
        }
        $sql = "SELECT TRANSACTION_ID,SENDER,RECEIVER,DT from transfers";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" .$row["TRANSACTION_ID"] . "</td><td>" .$row["SENDER"] . "</td><td>" .$row["RECEIVER"] . "</td><td>" .$row["DT"] . "</td></tr>";
            }
                echo "</table>";
        }
        else{
            echo "0 result";
        }
        $conn-> close();
        ?>
    </table>
    </div>
    <div class="home-btn">
        <a href="index1.html">
        <button type="button" class="btn btn-dark">HOME</button></a>
    </div>
</body>
</html>