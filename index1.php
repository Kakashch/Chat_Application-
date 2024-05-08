<?php
include ("connect.php");
session_start();
$query1 = "select * from user";
$result1 = mysqli_query($conn, $query1);

?>
<style>
    .sent {
        float: right;
        margin-right: 2px;
        background-color: #DCF8C6;
        /* Light green for sent messages */
    }

    .received {
        float: left;
        margin-left: 2px;
        background-color: #FFFFFF;
        /* White background for received messages */
    }

    .container {
        display: flex;
        height: 100vh;
    }

    .part1 {
        flex: 40%;
        border: 1px solid #ccc;
        overflow-y: scroll;

    }

    .part2 {
        flex: 60%;
        border: 1px solid #ccc;
        overflow-y: scroll;

    }

    img {
        float: left;
        width: 40px;
        height: 40px;
        margin-right: 12px;
        border-radius: 50%;
        object-fit: cover;
    }

    .chat-info {
        border: 1px solid grey;
        border-radius: 12px;
        padding: 5px;
        margin-right: 10px;

    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        margin-bottom: 3px;
        /* Adjust as needed */
    }

    .search-input {
        padding: 2px 5px;
        margin: 10px 20px;
        width: -webkit-fill-available;
        border-radius: 12px;

    }

    .form {
        /* position: fixed; */
        bottom: 0px;
        left: 40%;
        width: 88%;
        background-color: #f0f0f0;
        padding: 10px;
        box-sizing: border-box;
        /* display: flex; */
        align-items: center;

    }

    .send-icon {
        bottom: 0px;
        right: 0px;
        background-color: green;
        /* Send button background color */
        color: #fff;
        /* Send button text color */
        /* padding: 10px; */
        padding: 2px 4px 12px 1px;
        cursor: pointer;
        border-radius: 15px;
    }

    .send-info {
        width: 100%;
    }
    }

    .const {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }

    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    .sms {
        border: 2px solid #dedede;
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 10px;
        margin: 10px 0;
    }
</style>

<script>
    var searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("input", function () {
        var query = this.value; // Get the value of the input field
        inputs(query); // Call the inputs function with the query
    });

    function inputs(query) {
        var div = document.getElementsByClassName("chat-info");
        for (var i = 0; i < div.length; i++) {
            var chatInfo = div[i];
            var chatText = chatInfo.children[1].children[0].outerText;
            if (query === '' || chatText.indexOf(query) !== -1) {
                chatInfo.style.display = "block";
            } else {
                chatInfo.style.display = "none";
            }
        }

    }


    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="style1.css">

    <title>my first project</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">ChatApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only"></span></a>
      </li> -->
                <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Register <span class="sr-only"></span></a>
      </li> -->
                <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Login <span class="sr-only"></span></a>
      </li> -->
            </ul>
            <?php
            if (isset($_SESSION["username"])) {
                // Display the name
                echo "<p>Hello, " . $_SESSION["username"] . "</p>";
                ?> <a href="logout.php">Logout</a> <!-- Link to logout page -->
                <?php
            } else {
                ?>
                <form action="login.php" method="POST" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="name" type="search" placeholder="Enter Name"
                        aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Login</button>
                </form>
            <?php }
            ?>


        </div>
    </nav>
    <header>
        <div class="container">
            <div class="part1">
                <!-- Content for the first part of the screen goes here -->
                <div><input type="search" id="searchInput" class="search-input"></div>
                <ul>
                    <?php
                    $sessionUserId = isset($_SESSION["username"]) ? $_SESSION["username"] : null;
                    // Query to select all users except the session user
                    $sql = "SELECT * FROM users WHERE name != '$sessionUserId'";
                    $res = mysqli_query($conn, $sql);

                    // Check if any users other than the session user are found
                    if (mysqli_num_rows($res) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($res)) {
                            // Display user information
                            ?>
                            <a onclick="openDiv('<?php echo $row['name']; ?>')">
                                <?php
                                echo '<li>';
                                echo '<div class="chat-info">';
                                echo '<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/thomas.jpg" alt="">';
                                echo '<span class="username"><strong>' . $row["name"] . '</strong></span>';
                                echo '<span class="timestamp" style="display: block; text-align: right; margin-right: 20px;">' . date("h:i A") . '</span>';
                                echo '<p>This is a message from ' . $row["name"] . '.</p>';
                                echo '</div>';
                                echo '</li>';
                                ?>
                            </a>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </ul>
            </div>

            <div class="part2" style="height:100vh;overflow-y:hidden;">
                <!-- Content for the second part of the screen goes here -->
                <?php
                // Assuming $result1 contains messages for all users, not just user1
                while ($row3 = mysqli_fetch_array($result1)) {
                    // Loop through each user's message container
                    $userId = $row3['recipient_id'];
                    ?>
                    <div id="<?php echo $userId; ?>" style="display:none;height:100vh;">
                        <h2 style="height:10vh;box-shadow:3px 4px 7px lightgray"><?php echo $userId; ?></h2>
                        <div style="height:80vh;overflow-y:scroll;">
                            <?php
                            // Assuming $result1 contains messages for all users, not just user1
                            $query5 = "SELECT * FROM user WHERE (sender_id = '$sessionUserId' AND recipient_id = '$userId') OR (sender_id = '$userId' AND recipient_id = '$sessionUserId')";
                            $result6 = mysqli_query($conn, $query5);
                            while ($row6 = mysqli_fetch_array($result6)) {
                                $messageClass = ($row6["sender_id"] == $sessionUserId) ? 'sent' : 'received';
                                ?>
                                <div class="message <?php echo $messageClass; ?>">
                                    <?php echo $row6["messege"]; ?>
                                </div>
                                <br><br><br><br>
                            <?php } ?>
                        </div>

                        <div style="height:10vh;" class="send-info">
                            <form id="myForm_<?php echo $userId; ?>" action="sendMessage.php" method="POST"
                                style="width:100%;">
                                <input type="hidden" name="id" value="<?php echo $sessionUserId; ?>">
                                <input type="hidden" name="recipient_id" value="<?php echo $userId; ?>">
                                <input class="form" name="message" type="text" style="border-radius:15px;width:88%;" />
                                <button class="send-icon" style="width:10%;" type="submit" name="submit" value="submit"
                                    >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M18.3 3.71a.996.996 0 0 0-1.41 0L6.71 14.89 3.7 11.87a.996.996 0 1 0-1.41 1.41l4.59 4.59c.39.39 1.02.39 1.41 0l11.3-11.3a.996.996 0 0 0 0-1.41z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <script>
                // Function to open a specific user's message container
                function openDiv(userId) {
                    var div = document.getElementById(userId);
                    if (div) {
                        var ght = document.getElementsByClassName("part2")[0];
                        for (var i = 0; i < ght.children.length; i++) {
                            if (ght.children[i].id === userId) {
                                ght.children[i].style.display = "block";
                            } else {
                                ght.children[i].style.display = "none";
                            }
                        }
                    }
                }

                // Function to disable the submit button after it's clicked
                function disableSubmitButton(userId) {
                    var submitButton = document.getElementById("myForm_" + userId).querySelector("[type='submit']");
                    if (submitButton) {
                        submitButton.disabled = true;
                    }
                }
            </script>



        </div>
    </header>

</body>

</html>

<script>
    // Get a reference to the form and submit button
    var form = document.getElementById("myForm");
    var submitButton = document.getElementById("submitButton");

    // Add an event listener to the form submission
    form.addEventListener("submit", function (event) {
        // Disable the submit button to prevent multiple submissions
        submitButton.disabled = true;
    });
</script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>