<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $xml = new DOMDocument();
    $xml->load('users.xml');

    $xpath = new DOMXPath($xml);
    $query = "//user[username='$username']";
    $user = $xpath->query($query)->item(0);

    if ($user) {
        $storedPassword = $user->getElementsByTagName('password')->item(0)->nodeValue;

        if (password_verify($password, $storedPassword)) {
            header('Location: homepage.html');
        } else {
            echo "<div class='container'><p class='error'>Invalid password. <a href='login.html'>Try again</a></p></div>";
        }
    } else {
        echo "<div class='container'><p class='error'>User not found. <a href='login.html'>Try again</a></p></div>";
    }
}
?>
