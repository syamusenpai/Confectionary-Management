<?php
include("../include/db_connect.php");

// Assuming the page name is editProfile.php
$editUserLink = "editUser.php";
$editAdminLink = "editAdmin.php";

// Your existing code for querying admins and users
$queryAdmins = "SELECT id, name AS username, email, phone_number, 'admin' AS role FROM admins";
$resultAdmins = mysqli_query($dbc, $queryAdmins);

$queryUsers = "SELECT id, username, email, phone_number, role FROM users";
$resultUsers = mysqli_query($dbc, $queryUsers);

if ($resultAdmins && $resultUsers) {
    $rows = array();

    while ($row = mysqli_fetch_assoc($resultAdmins)) {
        $rows[] = $row;
    }

    while ($row = mysqli_fetch_assoc($resultUsers)) {
        $rows[] = $row;
    }

    // Now $rows contains the merged data from both tables

    if (count($rows) > 0) {
?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="content-type" content="text/html; charset=UTF-8">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
                integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
            <title>All Profiles</title>
            <style>
                @import url('https://fonts.googleapis.com/css?family=Poppins|Lato|Roboto+Mono');

                body,
                html {
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

                tr,
                td {
                    text-align: center;
                    padding: 5px 0;
                }

                tr:nth-child(even) {
                    background-color: #fff4b7;
                }

                a {
                    font-family: 'Roboto Mono', monospace;
                }

                html,
                body {
                    margin: 0;
                    background-color: #fce02d;
                }

                th {
                    font-size: 19px;
                }

                center {
                    font-family: 'Poppins', sans-serif;
                    font-size: 20px;
                    color: black;
                }

                .search-container {
                    text-align: center;
                    margin-bottom: 20px;
                }

                input[type=text] {
                    padding: 5px;
                }

                select {
                    padding: 5px;
                }

                button {
                    padding: 5px 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }
            </style>
        </head>

        <body>

            <br>
            <h1>All Profiles</h1>

            <div class="search-container">
                <label for="search">Search:</label>
                <input type="text" id="search" placeholder="Search by name, email, or role">
                <select id="filter">
                    <option value="all">All</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button onclick="filterProfiles()">Search</button>
            </div>

            <br>
            <table align="center" id="profilesTable">

                <tr style="background-color: #ffea6b;">
                    <th style="width: 200px;">Name/Username</th>
                    <th style="width: 250px;">Email</th>
                    <th style="width: 250px;">Phone number</th>
                    <th style="width: 100px;">Role</th>
                    <th style="width: 60px;"></th>
                    <th style="width: 60px;"></th>
                </tr>

                <?php
                foreach ($rows as $row) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $email = $row["email"];
                    $phone_number = $row["phone_number"];
                    $role = $row["role"];

                    // Determine the profile type (admin or user)
                    $profileType = ($role === 'admin') ? 'admin' : 'user';

                    // Construct the edit link based on the profile type
                    $editLink = ($profileType === 'admin') ? "$editAdminLink?id=$id" : "$editUserLink?id=$id";
                ?>

                    <tr>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $phone_number; ?></td>
                        <td><?php echo $role; ?></td>
                        <td><a href="<?php echo $editLink; ?>" style="color:black;"><i class="fas fa-edit"></i></a></td>
                        <td><a href="delete.php?id=<?php echo $id; ?>" onclick='return confirmation()' style="color:black;"><i class="fa fa-trash"
                                    aria-hidden="true"></i></a></td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <br>
            <br>
            <a href="Admin_dashbord.php"><center>[Back to admin main]</center></a>
            <script>
                function confirmation() {
                    return confirm("Are you sure you want to delete this profile?");
                }

                function filterProfiles() {
                    var input, filter, table, tr, td, i, select, filterRole;
                    input = document.getElementById("search");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("profilesTable");
                    tr = table.getElementsByTagName("tr");
                    select = document.getElementById("filter");
                    filterRole = select.value.toUpperCase(); // Corrected toUpperCase

                    for (i = 1; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td");
                        var name = td[0].textContent || td[0].innerText;
                        var email = td[1].textContent || td[1].innerText;
                        var phone = td[2].textContent || td[2].innerText;
                        var role = td[3].textContent || td[3].innerText;

                        if ((name.toUpperCase().indexOf(filter) > -1 || email.toUpperCase().indexOf(filter) > -1) &&
                            (filterRole === "ALL" || role.toUpperCase() === filterRole)) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            </script>
        </body>

        </html>
    <?php
    } else {
        echo "<tr><td colspan='6'>No matching records found</td></tr>";
    }
} else {
    echo "Error in the query: " . mysqli_error($dbc);
}
?>
