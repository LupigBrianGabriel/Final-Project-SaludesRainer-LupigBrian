<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $xml = new DOMDocument();
    $xml->load('../webpages/users.xml');

    $xpath = new DOMXPath($xml);
    $query = "//user[username='$username']";
    $existingUser = $xpath->query($query);

    if ($existingUser->length > 0) {
        echo "<div class='container'><p class='error'>Username already exists. <a href='signup.html'>Try again</a></p></div>";
    } else {
        $newUser = $xml->createElement('user');
        
        $userNode = $xml->createElement('username', $username);
        $passNode = $xml->createElement('password', password_hash($password, PASSWORD_DEFAULT));
        
        $newUser->appendChild($userNode);
        $newUser->appendChild($passNode);
        $xml->documentElement->appendChild($newUser);
        
        $xml->save('../webpages/users.xml');
        
        header('Location: ../webpages/login.html');
    }
}
?>
