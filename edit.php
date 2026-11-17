<?php
session_start();

require_once "db.php";
require_once "entry.class.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$userId = (int) $_SESSION["user_id"];
$entry = new Entry($conn, $userId);

$id = (int) ($_GET["id"] ?? $_POST["id"] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$journal = $entry->getEntryById($id);

if ($journal === null) {
    header("Location: index.php");
    exit;
}

$error = "";
$success = "";

$title = $journal["title"];
$content = $journal["content"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"] ?? "");
    $content = trim($_POST["content"] ?? "");

    if ($title === "" || $content === "") {
        $error = "Please fill in all fields.";
    } else {
        $result = $entry->updateEntry(
            $id,
            $title,
            $content
        );

        if ($result) {
            $success = "Entry updated successfully!";
        } else {
            $error = "Failed to update entry.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="style.css">

    <title>Edit Journal Entry</title>
</head>
<body class="addEdit-page">

<div class="container mt-5">

    <h2>Edit Journal Entry</h2>

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

    <form method="POST" action="edit.php?id=<?= $id ?>">

        <input type="hidden"
               name="id"
               value="<?= $id ?>">

        <div class="mb-3">
            <label class="form-label">Title</label>

            <input type="text"
                   name="title"
                   class="form-control"
                   value="<?= htmlspecialchars($title) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>

            <textarea name="content"
                      class="form-control"
                      rows="5"
                      required><?= htmlspecialchars($content) ?></textarea>
        </div>

        <button type="submit"
                class="btn addEdit-btn">
            Update Entry
        </button>

        <a href="index.php"
           class="btn addEdit-btn">
            Back
        </a>

    </form>

</div>

</body>
</html>