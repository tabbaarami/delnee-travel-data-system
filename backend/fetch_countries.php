<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "delnee";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch countries
    $query = $pdo->prepare("SELECT * FROM country");
    $query->execute();

    // Check if countries exist
    if ($query->rowCount() > 0) {
        echo '<select name="country_id" id="country_id" onchange="fetchCountryDetails()">';
        echo '<option selected>Select Country</option>';

        // Loop through the countries and generate <option> elements
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $countryId = $row['country_id'];
            $countryName = htmlspecialchars($row['country_name']); // Make sure to escape special characters
            echo "<option value='$countryId'>$countryName</option>";
        }

        echo '</select>';
    } else {
        echo '<p>No countries found.</p>';
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
