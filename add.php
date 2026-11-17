<?php
session_start();

require_once "db.php";
require_once "entry.class.php";

$error = "";

$success = "";

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;

}

$userId = $_SESSION["user_id"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"] ?? "");

    $content = trim($_POST["content"] ?? "");

    if ($title === ""|| $content === "") {

        $error = "Please fill in all fields.";

    } else {

        $entry = new Entry($conn, $userId);

        $result = $entry->createEntry($title, $content);

        if ($result !== false) {

            $success = "Entry added successfully!";

        } else {

            $error = "Failed to add entry.";

        }

    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    
    <title>Document</title>
</head>
<body class="addEdit-page">
  <div class="container mt-5">
    <h2 >Add New Journal Entry</h2>

    <?php if ($error !== ""): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($success !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="add.php">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title"
                   class="form-control" required placeholder="enter your journal title">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content"
                      class="form-control"
                      rows="5" required placeholder=" Express your thoughts..."></textarea>
        </div>

        <button type="submit" class="btn mt-2 addEdit-btn">
            Add Entry
        </button>

        <a href="index.php" class="btn mt-2 addEdit-btn">
            Back
        </a>
    </form>
</div>   



</body>
</html>