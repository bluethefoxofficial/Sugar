
<?php
include ("json.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}
if ($_POST['username'] == "") {
    echo "Error: no username";
} else {

    $username = $_POST['username'];
    $email = $_POST['email'];
    // Create connection
    $conn = mysqli_connect($dbhost, $dbname, $dbpassword, $db);
    // Check connection
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }
    // sql to create table
    $sql = "CREATE TABLE " . strip_tags($_POST['username']) . " (
id LONGTEXT, 
username LONGTEXT,
password LONGTEXT,
profilepicture LONGTEXT,
role LONGTEXT,
ban LONGTEXT,
token LONGTEXT,
email LONGTEXT,
bio LONGTEXT
);";
    if (mysqli_query($conn, $sql) === TRUE) {
        $sql = "INSERT INTO " . strip_tags($username) . " (id, username, password, email, profilepicture, role, ban, token, bio)
VALUES ('" . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999) . rand(100, 999999999) . rand(100, 999) . "', '" . strip_tags($username) . "', '" . password_hash($_POST['password'], PASSWORD_BCRYPT) . "', '" . $email . "', 'novalue', 'Member', '0', '" . generateRandomString(rand(10, 99)) . "','No bio has been set for this account')";
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "New record created successfully";
            header("Location: ../index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error creating table: " . mysqli_error($conn);
        exit();
    }
    $conn->close();
}
?>