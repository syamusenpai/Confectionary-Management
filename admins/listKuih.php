<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <title>List Kuih</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins|Lato|Roboto+Mono');

        body, html {
            margin: 0;
            background-color: #ede7f6;
        }

        h1 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        table {
            font-family: 'Lato', sans-serif;
            border-collapse: collapse;
        }

        tr, td {
            text-align: center;
            padding: 5px 0;
        }

        tr:nth-child(even) {
            background-color: #fff4b7;
        }

        a {
            font-family: 'Roboto Mono', monospace;
        }

        img {
            object-fit: cover;
            width: 80px;
            height: 80px;
        }

        .btn {
            text-align: center;
        }

        .view-btn {
            background-color: #2196F3;
            color: white;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: white;
        }

        button {
            font-family: 'Lato', sans-serif;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            margin: 5px;
        }

        button:hover {
            cursor: pointer;
        }

        html, body {
            margin: 0;
            background-color: #fce02d;
        }

        center {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            color: black;
        }
    </style>
</head>

<body>

    <br>
    <h1>Kuih Information</h1>
    <br>

    <table align="center">

        <tr style="background-color: #ffea6b;">
            <th style="width: 90px;">Image</th>
            <th style="width: 200px;">Kuih Name</th>
            <th style="width: 200px;">Quantity</th>
            <th style="width: 80px;">Price</th>
            <th style="width: 60px;"></th>
        </tr>

        <?php
        include("../include/db_connect.php");

        $query = "SELECT * FROM products";
        $result = mysqli_query($dbc, $query);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $productId = $row["id"];
                $image = $row["image"];
                $kuihName = $row["name"];
                $quantity = $row["quantity"];
                $kuihPrice = $row["price"];

                ?>
                <tr>
                    <td><?php echo '<img src="../img/', $image, '" >'; ?></td>
                    <td><?php echo $kuihName; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td>RM<?php echo $kuihPrice; ?></td>
                    <td>
                        <a href="viewKuih.php?kuihId=<?php echo $productId; ?>" style="color:black;">
                            <button class="view-btn">View</button>
                        </a>
                    </td>
                </tr>
            <?php
            }
        } else {
            echo "No kuih are available";
        }
        ?>
    </table>

    <br>
    <div class="btn"><a href="addKuih.php"><button class="edit-btn">Add Kuih Info</button></a></div>
    <br>
    <br>
    <a href="Admin_dashbord.php"><center>[Back to Admin Page]</center></a>
</body>
</html>
