<?php
session_start();

// Make sure the user is logged in.
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

require_once "db.php";
require_once "entry.class.php";

// Get the entry ID from the URL.
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header("Location: index.php");
    exit();
}

// Get the journal entry for the current user.
$journal = new Entry($conn, $_SESSION["user_id"]);
$entry = $journal->getEntryById($id);

// Show an error if the entry does not exist.
if (!$entry) {
    http_response_code(404);
    exit("Entry not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Entry | Alchemy & Ink</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navigation bar -->
    <header class="container-fluid p-0">
        <nav class="navbar nav-color shadow">
            <div class="container-fluid">

                <a class="navbar-brand brandname d-flex align-items-center gap-2" href="index.php">
                    <img src="imagesAndVideo/icon2.png" alt="logo" width="50">
                    Alchemy & Ink
                </a>

                <div class="d-flex gap-4">
                    <a class="nav-link" href="index.php">Home</a>
                    <a class="nav-link" href="add.php">Add entry</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>

            </div>
        </nav>
    </header>

    <!-- Journal entry -->
    <main class="container my-5 flex-grow-1">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow p-4">

                    <h2 class="mb-4">
                        <?php
                        echo htmlspecialchars(
                            $entry["title"],
                            ENT_QUOTES,
                            "UTF-8"
                        );
                        ?>
                    </h2>

                    <p class="mb-4">
                        <?php
                        echo nl2br(htmlspecialchars(
                            $entry["content"],
                            ENT_QUOTES,
                            "UTF-8"
                        ));
                        ?>
                    </p>

                    <small class="text-muted">
                        Created:
                        <?php
                        echo htmlspecialchars(
                            $entry["created_at"],
                            ENT_QUOTES,
                            "UTF-8"
                        );
                        ?>
                    </small>

                    <div class="mt-4">
                        <a href="index.php" class="btn addEdit-btn">
                            Back to Home
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="container text-center py-4">
        <h5>Alchemy & Ink</h5>
        <p>A place of hopes and dreams.</p>
        <p>Copyright 2026 Alchemy & Ink</p>
    </footer>

    <script src="script.js"></script>

</body>
</html>