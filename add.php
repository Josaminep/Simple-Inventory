<?php
include 'crud_functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    createItem($name, $price, $quantity);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Item</title>
</head>

<body>
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add New Item</h2>
            <form action="add.php" method="post">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>
                <label for="price">Price:</label><br>
                <input type="text" id="price" name="price" required><br>
                <label for="quantity">Quantity:</label><br>
                <input type="text" id="quantity" name="quantity" required><br><br>
                <input type="submit" value="Add Item">
            </form>
        </div>
    </div>

    <script>
        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>
