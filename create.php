<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pet_name   = $_POST['pet_name'];
    $species    = $_POST['species'];
    $breed      = $_POST['breed'];
    $owner_name = $_POST['owner_name'];
    $health_status = $_POST['health_status'];

    $image = $_FILES['image']['name'];
    $uploadDir = "uploads/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $target = $uploadDir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO pets (pet_name, species, breed, owner_name, health_status, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pet_name, $species, $breed, $owner_name, $health_status, $image]);
        header("Location: index.php");
        exit;
    } else {
        die("Image upload failed!");
    }
}
?>
