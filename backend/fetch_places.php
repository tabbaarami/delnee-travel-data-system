<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "delnee";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['country_id'])) {
        $countryId = intval($_GET['country_id']);

        // Fetch country details
        $countryQuery = $pdo->prepare("SELECT * FROM countries WHERE id = :country_id");
        $countryQuery->bindParam(':country_id', $countryId, PDO::PARAM_INT);
        $countryQuery->execute();
        $country = $countryQuery->fetch(PDO::FETCH_ASSOC);

        // Fetch places for the selected country
        $placesQuery = $pdo->prepare("SELECT * FROM places WHERE country_id = :country_id");
        $placesQuery->bindParam(':country_id', $countryId, PDO::PARAM_INT);
        $placesQuery->execute();

        // Render the country details
        echo '<div class="container-xxl py-5">';
        echo '<div class="container">';
        echo '<div class="text-center wow fadeInUp mb-5" data-wow-delay="0.1s">';

        if ($country) {
            echo '<h1 class="mb-5">Summary About <span class="text-primary text-uppercase">' . htmlspecialchars($country['name']) . '</span></h1>';
            echo '<p>' . htmlspecialchars($country['description']) . '</p>';
        } else {
            echo '<h1 class="mb-5">Summary About <span class="text-primary text-uppercase">Country</span></h1>';
            echo '<p>No details found for this country.</p>';
        }

        echo '</div>';

        // Render the tourist sites
        echo '<div class="text-center wow fadeInUp" data-wow-delay="0.6s">';
        echo '<h1 class="mb-5">The most tourist sites in <span class="text-primary text-uppercase">' . ($country ? htmlspecialchars($country['name']) : 'Country') . '</span></h1>';
        echo '</div>';
        echo '<div id="placesContainer">';

        if ($placesQuery->rowCount() > 0) {
            while ($row = $placesQuery->fetch(PDO::FETCH_ASSOC)) {
                $imageData = $row['image']; // Assuming 'image' is the BLOB column
                echo '<div class="row g-4 mb-5">';
                echo '<div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.6s">';
                echo '<div class="rounded">';
                echo '<div class="bg-transparent p-1">';
                echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                echo '<div class="w-100 h-100 d-flex align-items-center justify-content-center mb-3">';
                if ($imageData) {
                    $imageType = 'image/jpeg'; // Assuming the BLOB data is a JPEG
                    echo '<img src="data:' . $imageType . ';base64,' . base64_encode($imageData) . '" width="500px" alt="Image of ' . htmlspecialchars($row['name']) . '">';
                } else {
                    echo '<img src="img/default.jpg" width="200px" alt="Image not available">';
                }
                echo '</div>';
                echo '</div>';
                echo '<p class="text-body mb-5">' . htmlspecialchars($row['description']) . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No places found for this country.</p>';
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p>Please select a country.</p>';
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
