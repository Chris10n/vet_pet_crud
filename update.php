<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM pets WHERE id=?");
$stmt->execute([$id]);
$pet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pet) {
    die("Pet not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pet_name   = $_POST['pet_name'];
    $species    = $_POST['species'];
    $breed      = $_POST['breed'];
    $owner_name = $_POST['owner_name'];
    $health_status = $_POST['health_status'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $target = $uploadDir . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $pet['image'];
    }

    $sql = "UPDATE pets SET pet_name=?, species=?, breed=?, owner_name=?, health_status=?, image=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pet_name, $species, $breed, $owner_name, $health_status, $image, $id]);
    header("Location: index.php");
    exit;
}
?>
