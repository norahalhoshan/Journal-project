
<?php
session_start();

require_once "db.php";
require_once "entry.class.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$userId = (int) $_SESSION["user_id"];
$id = (int) ($_POST["id"] ?? 0);

// Check entry ID
if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// Create Entry object
$entry = new Entry($conn, $userId);

// Delete the entry
$result = $entry->deleteEntry($id);

// Redirect to homepage
header("Location: index.php");
exit;
?>
 