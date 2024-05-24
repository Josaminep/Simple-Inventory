<?php
// Database connection
$host = 'localhost';
$dbname = 'sari_sari_store_db';
$username = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// CRUD functions
function createItem($name, $price, $quantity) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO items (name, price, quantity) VALUES (?, ?, ?)");
    $stmt->execute([$name, $price, $quantity]);
    return $pdo->lastInsertId();
}

function readItems() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM items");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function readItem($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateItem($id, $name, $price, $quantity) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE items SET name = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->execute([$name, $price, $quantity, $id]);
    return $stmt->rowCount();
}

function deleteItem($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->rowCount();
}
?>
