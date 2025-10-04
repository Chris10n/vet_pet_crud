<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Pet Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body { background-color: #f0fdf4; color: #000; transition: background 0.4s, color 0.4s; }
        .navbar { background-color: #38b2ac; transition: background 0.4s; }
        .btn-primary { background-color: #48bb78; border: none; transition: all 0.3s ease; }
        .btn-primary:hover { background-color: #38a169; }

        .pet-booklet {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .pet-booklet:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 0 20px rgba(72, 187, 120, 0.7); /* soft green glow */
        }

        .pet-booklet-img { width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease; }
        .pet-booklet:hover .pet-booklet-img { transform: scale(1.05); }

        .pet-booklet-body { padding: 1rem; }
        .pet-booklet-title { font-size: 1.5rem; font-weight: bold; }
        .pet-booklet-text { color: #555; margin-bottom: .5rem; transition: color 0.3s ease; }
        .pet-booklet-footer { background: #f8f9fa; padding: .8rem; transition: background 0.3s ease; }

        /* Glowing Buttons */
        .btn-primary:hover,
        .btn-warning:hover,
        .btn-danger:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
        }

        /* Navbar Brand Glow */
        .navbar-brand:hover {
            text-shadow: 0 0 10px rgba(255,255,255,0.8);
            transition: text-shadow 0.3s ease;
        }

        /* Dark Mode Styles */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        body.dark-mode .navbar {
            background-color: #1e1e1e;
        }
        body.dark-mode .pet-booklet {
            background: #1e1e1e;
            color: #fff;
            box-shadow: 0 4px 12px rgba(255,255,255,0.1);
        }
        body.dark-mode .pet-booklet-text {
            color: #ccc;
        }
        body.dark-mode .pet-booklet-footer {
            background: #2c2c2c;
        }
        body.dark-mode .btn-primary {
            background-color: #4caf50;
        }
        body.dark-mode .btn-warning {
            background-color: #ffb74d;
        }
        body.dark-mode .btn-danger {
            background-color: #e57373;
        }

        /* Dark Mode na nag goglow into green light effect*/
        body.dark-mode .pet-booklet:hover {
            box-shadow: 0 0 25px rgba(76, 175, 80, 0.8); /* bright green glow */
        }
        body.dark-mode .btn-primary:hover {
            box-shadow: 0 0 15px rgba(76, 175, 80, 0.9);
        }
        body.dark-mode .btn-warning:hover {
            box-shadow: 0 0 15px rgba(255, 193, 7, 0.9);
        }
        body.dark-mode .btn-danger:hover {
            box-shadow: 0 0 15px rgba(244, 67, 54, 0.9);
        }
        body.dark-mode .navbar-brand:hover {
            text-shadow: 0 0 15px rgba(0,255,128,0.8);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">🐾 Vet Pet Records</a>
        <button class="btn btn-dark ms-auto" id="toggleDarkMode">🌙 Dark Mode</button>
    </div>
</nav>

<div class="container mt-4">
    <button class="btn btn-primary mb-4 shadow" data-bs-toggle="modal" data-bs-target="#addPetModal">
        ✚ Add New Pet Record
    </button>

    <div class="row g-4">
        <?php
        $stmt = $pdo->query("SELECT * FROM pets ORDER BY id DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $pet_name = htmlspecialchars($row['pet_name']);
            $species = htmlspecialchars($row['species']);
            $breed = htmlspecialchars($row['breed']);
            $owner_name = htmlspecialchars($row['owner_name']);
            $health_status = htmlspecialchars($row['health_status']);
            $image = htmlspecialchars($row['image']);
            $id = $row['id'];
        ?>
            <div class="col-lg-4 col-md-6">
                <div class="pet-booklet">
                    <img src="uploads/<?= $image ?>" alt="<?= $pet_name ?>" class="pet-booklet-img">
                    <div class="pet-booklet-body">
                        <h5 class="pet-booklet-title"><?= $pet_name ?></h5>
                        <p class="pet-booklet-text"><strong>Owner:</strong> <?= $owner_name ?></p>
                        <p class="pet-booklet-text"><strong>Species:</strong> <?= $species ?></p>
                        <p class="pet-booklet-text"><strong>Breed:</strong> <?= $breed ?></p>
                        <p class="pet-booklet-text"><strong>Health Status:</strong> <?= $health_status ?></p>
                    </div>
                    <div class="pet-booklet-footer d-grid gap-2 d-sm-flex justify-content-sm-end">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPetModal<?= $id ?>">✏️ Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $id ?>">🗑️ Delete</button>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class='modal fade' id='editPetModal<?= $id ?>' tabindex='-1'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='modal-content'>
                        <div class='modal-header bg-success text-white'>
                            <h5 class='modal-title'>Edit Pet Record</h5>
                            <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
                        </div>
                        <form method='post' action='update.php?id=<?= $id ?>' enctype='multipart/form-data'>
                            <div class='modal-body'>
                                <div class='mb-3'><label>Pet Name</label>
                                    <input type='text' name='pet_name' class='form-control' value='<?= $pet_name ?>' required>
                                </div>
                                <div class='mb-3'><label>Species</label>
                                    <input type='text' name='species' class='form-control' value='<?= $species ?>' required>
                                </div>
                                <div class='mb-3'><label>Breed</label>
                                    <input type='text' name='breed' class='form-control' value='<?= $breed ?>'>
                                </div>
                                <div class='mb-3'><label>Owner Name</label>
                                    <input type='text' name='owner_name' class='form-control' value='<?= $owner_name ?>' required>
                                </div>
                                <div class='mb-3'><label>Health Status</label>
                                    <input type='text' name='health_status' class='form-control' value='<?= $health_status ?>' required>
                                </div>
                                <div class='mb-3'><label>Pet Image</label><br>
                                    <img src='uploads/<?= $image ?>' class='img-fluid rounded shadow mb-3'><br>
                                    <input type='file' name='image' class='form-control'>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='submit' class='btn btn-success'>Update Record</button>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- Add Pet Modal -->
<div class="modal fade" id="addPetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add New Pet Record</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" action="create.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3"><label>Pet Name</label>
                        <input type="text" name="pet_name" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Species</label>
                        <input type="text" name="species" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Breed</label>
                        <input type="text" name="breed" class="form-control">
                    </div>
                    <div class="mb-3"><label>Owner Name</label>
                        <input type="text" name="owner_name" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Health Status</label>
                        <input type="text" name="health_status" class="form-control" required>
                    </div>
                    <div class="mb-3"><label>Pet Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Record</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const petId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This pet record will be deleted permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete.php?id=${petId}`;
                }
            });
        });
    });

    // Dark Mode Toggle
    document.getElementById('toggleDarkMode').addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
        this.textContent = document.body.classList.contains('dark-mode') ? "☀️ Light Mode" : "🌙 Dark Mode";
    });
</script>
</body>
</html>
