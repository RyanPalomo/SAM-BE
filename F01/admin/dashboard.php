<?php
session_start();

include("../connect.php");

// Check if admin is logged in
if (empty($_SESSION['logged'])) {
    header('Location: ../login.php'); // Redirect to the login page if not logged in
    exit();
}

// Fetch events and training content
$eventsQuery = "SELECT * FROM event";
$events = executeQuery($eventsQuery);

$trainingQuery = "SELECT * FROM training";
$trainings = executeQuery($trainingQuery);

// Handle add or edit operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $type = $_POST['type'];
    $id = $_POST['id'] ?? null;
    $content = $_POST['content'];
    $images = null;

    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../img/';
        $fileName = str_replace(' ', '_', basename($_FILES['image']['name'])); // Replace spaces with underscores
        $fileTmp = $_FILES['image']['tmp_name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (in_array($fileType, $allowedTypes)) {
            $targetFilePath = $uploadDir . $fileName;
            if (move_uploaded_file($fileTmp, $targetFilePath)) {
                $images = "img/" . $fileName; // Relative path for database storage
            } else {
                die('File upload failed.');
            }
        } else {
            die('Invalid file type.');
        }
    }

    // Query Execution
    if ($action === 'add') {
        $query = "INSERT INTO $type (content, image) VALUES ('$content', '$images')";
    } elseif ($action === 'edit') {
        if ($images) {
            $query = "UPDATE $type SET content='$content', image='$images' WHERE id=$id";
        } else {
            $query = "UPDATE $type SET content='$content' WHERE id=$id";
        }
    }
    executeQuery($query);
    header("Location: dashboard.php");
    exit();
}


// Handle delete operations
if (isset($_GET['delete']) && isset($_GET['type'])) {
    $id = $_GET['delete'];
    $type = $_GET['type'];
    $query = "DELETE FROM $type WHERE id=$id";
    executeQuery($query);
    header("Location: dashboard.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="img/x-icon" href="../img/icon.png">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Admin Dashboard</h1>

    <div class="mb-4 d-flex justify-content-end">
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>

    <!-- Events Section -->
    <h2>Manage Events</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal" data-type="event" data-action="add">Add Event</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($event = mysqli_fetch_assoc($events)): ?>
            <tr>
                <td><?php echo $event['id']; ?></td>
                <td><img src="../<?php echo $event['image']; ?>" alt="" width="50"></td>
                <td><?php echo $event['content']; ?></td>
                <td>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal" data-type="event" data-action="edit" data-id="<?php echo $event['id']; ?>" data-content="<?php echo $event['content']; ?>" data-image="<?php echo $event['image']; ?>">Edit</button>

                    <a href="dashboard.php?delete=<?php echo $event['id']; ?>&type=event" 
                    class="btn btn-danger" 
                    onclick="return confirm('Are you sure you want to delete this content?');">
                    Delete
                    </a>

                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Training Section -->
    <h2>Manage Training</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modal" data-type="training" data-action="add">Add Training</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($training = mysqli_fetch_assoc($trainings)): ?>
            <tr>
                <td><?php echo $training['id']; ?></td>
                <td><img src="../<?php echo $training['image']; ?>" alt="" width="50"></td>
                <td><?php echo $training['content']; ?></td>
                <td>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal" data-type="training" data-action="edit" data-id="<?php echo $training['id']; ?>" data-content="<?php echo $training['content']; ?>" data-image="<?php echo $training['image']; ?>">Edit</button>

                    <a href="dashboard.php?delete=<?php echo $training['id']; ?>&type=training" 
                    class="btn btn-danger" 
                    onclick="return confirm('Are you sure you want to delete this content?');">
                    Delete
                    </a>
                    
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add/Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="action" id="modalAction">
                    <input type="hidden" name="type" id="modalType">
                    <input type="hidden" name="id" id="modalId">

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="modalContent" name="content" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="modalImage" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
     const modal = document.getElementById('modal');
    modal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');
        const type = button.getAttribute('data-type');
        const id = button.getAttribute('data-id');
        const content = button.getAttribute('data-content');
        const image = button.getAttribute('data-image');

        document.getElementById('modalAction').value = action;
        document.getElementById('modalType').value = type;
        document.getElementById('modalId').value = id || '';
        document.getElementById('modalContent').value = content || '';
        document.getElementById('modalImage').value = '';
        document.getElementById('modalLabel').textContent = action === 'add' ? `Add ${type}` : `Edit ${type}`;
    });
</script>
</body>
</html>
