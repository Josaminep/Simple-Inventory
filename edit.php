<?php
// Include the PHP file with the CRUD functions
include 'crud_functions.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Update the item in the database
    if (updateItem($id, $name, $price, $quantity)) {
        // Show a success message
        echo '<script>alert("Update Successfully");</script>';

        // Redirect back to the display page after a short delay
        echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 500);</script>';
        exit();
    } else {
        echo "Failed to update item.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sari-Sari Store Inventory</title>
    <style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Sari-Sari Store Inventory</h1>
    
    <br>
    <a href="add.php">Add New Item</a>

    <!-- The edit modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Item</h2>
            <form id="editForm" action="edit.php" method="post">
                <input type="hidden" id="editId" name="id">
                <label for="editName">Name:</label><br>
                <input type="text" id="editName" name="name"><br>
                <label for="editPrice">Price:</label><br>
                <input type="text" id="editPrice" name="price"><br>
                <label for="editQuantity">Quantity:</label><br>
                <input type="text" id="editQuantity" name="quantity"><br><br>
                <input type="submit" value="Save Changes">
            </form>
        </div>
    </div>

    <!-- JavaScript to control the edit modal -->
    <script>
        function openEditModal(id) {
            // Get item details from server using AJAX and populate the form fields
            // For simplicity, I'm assuming the item details are available in a JavaScript object named `item`
            var item = <?php echo json_encode($items); ?>.find(function(item) {
                return item.id === id;
            });

            document.getElementById('editId').value = item.id;
            document.getElementById('editName').value = item.name;
            document.getElementById('editPrice').value = item.price;
            document.getElementById('editQuantity').value = item.quantity;

            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>