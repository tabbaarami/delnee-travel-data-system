<?php
// Handles user authentication and session creation
// Demonstrates database query for user validation
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['username']);
        $userPassword = trim($_POST['password']);
    
        try {
            // Query to fetch user details
            $query = $pdo->prepare("SELECT * FROM users WHERE user_name = :username");
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->execute();
    
            if ($query->rowCount() > 0) {
                $user = $query->fetch(PDO::FETCH_ASSOC);
                // Verify password (assuming passwords are hashed in the database)
                // Note: Password comparison is done in plain text (can be improved using hashing)
                if ($userpassword === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['user_name'];
    
                    // Redirect to a dashboard or home page
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Invalid password.";
                }
            } else {
                $error = "User not found.";
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
