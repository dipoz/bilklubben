<?php
$servername = "";
$username = "";
$password = "";
$database = "";



// Opprette tilkobling:
$conn = mysqli_connect($servername, $username, $password, $database);

//Dette for at norske bookstaver blir vist riktig når informasjonen hentes fra databasen:
$conn->query('set character_set_client=utf8');
$conn->query('set character_set_connection=utf8');
$conn->query('set character_set_results=utf8');
$conn->query('set character_set_server=utf8');

// Sjkke tilkobling:
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
