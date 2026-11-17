<?php

class Entry{

    private $conn;
    private $userId;


    public function __construct($conn, $userId){

        $this->conn = $conn;
        $this->userId = (int)$userId;

    }


    // INSERT a new entry. Returns the new entry id, or false on failure.
    public function createEntry($title, $content){

        $title = trim($title);
        $content = trim($content);

        if($title === "" || $content === ""){
            return false;
        }

        $sql = "INSERT INTO entries (user_id, title, content) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $this->userId, $title, $content);

        if($stmt->execute()){
            $newId = $this->conn->insert_id;
            $stmt->close();
            return $newId;
        }

        $stmt->close();
        return false;

    }


    // SELECT all entries of the user (newest first) for the homepage.
    // Returns an array of rows (empty array if there are none).
    public function getEntries(){

        $sql = "SELECT id, title, content, created_at
                FROM entries
                WHERE user_id = ?
                ORDER BY created_at DESC, id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $entries = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $entries;

    }


    // SELECT one entry for the view page. Returns the row, or null if not found.
    public function getEntryById($id){

        $id = (int)$id;

        $sql = "SELECT id, title, content, created_at
                FROM entries
                WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id, $this->userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $entry = $result->fetch_assoc();

        $stmt->close();
        return $entry ?: null;

    }


    // UPDATE an existing entry. Returns true on success, false otherwise.
    public function updateEntry($id, $title, $content){

        $id = (int)$id;
        $title = trim($title);
        $content = trim($content);

        if($title === "" || $content === ""){
            return false;
        }

        // make sure the entry exists and belongs to this user
        if($this->getEntryById($id) === null){
            return false;
        }

        $sql = "UPDATE entries SET title = ?, content = ? WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $title, $content, $id, $this->userId);

        $ok = $stmt->execute();

        $stmt->close();
        return $ok;

    }


    // DELETE an entry. Returns true if a row was deleted.
    public function deleteEntry($id){

        $id = (int)$id;

        $sql = "DELETE FROM entries WHERE id = ? AND user_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id, $this->userId);

        $ok = $stmt->execute() && $stmt->affected_rows > 0;

        $stmt->close();
        return $ok;

    }

}

?>
