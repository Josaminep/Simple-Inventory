<!DOCTYPE html>
<html>
<head>
    <title>Sari-Sari Store Inventory</title>
    <style>
body {
    background-image: url('img/cstore.jpg');
    background-size: cover;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin: 0;
    padding: 0;
    background-color: rgba(0, 0, 0, 0.6); /* Adjust alpha value for darkness */
}


        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
            background-color: rgba(255, 255, 255, 0.8);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        a:hover {
            background-color: #f5f5f5;
        }

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
            width: 25%; /* Increased width for better content fit */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        input[type="text"], input[type="submit"] {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Sari-Sari Store Inventory</h1>

    <div style="text-align: center;">
    <a href="add.php" style="display:inline-block; padding: 5px 10px; background-color: #4CAF50; color: white; border: none; border-radius: 3px; text-decoration: none;">Add New Item</a>
    </div>

    <?php
    // Include the PHP file with the CRUD functions
    include 'crud_functions.php';

    // Display the items in a table
    $items = readItems();

    if (!empty($items)) {
        echo '<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>';

        foreach ($items as $item) {
            echo '<tr>
                    <td>'.$item['id'].'</td>
                    <td>'.$item['name'].'</td>
                    <td>'.$item['price'].'</td>
                    <td>'.$item['quantity'].'</td>
                    <td>
                        <button onclick="openEditModal('.$item['id'].')">Edit</button> |
                        <button onclick="openViewModal('.$item['id'].')">View</button> |
                        <a href="#" onclick="confirmDelete('.$item['id'].')">Delete</a>
                    </td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo 'No items found.';
    }
    ?>

    <!-- The view modal -->
    <div id="viewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeViewModal()">&times;</span>
            <h2>Item Details</h2>
            <p><strong>Name:</strong> <span id="viewName"></span></p>
            <p><strong>Price:</strong> <span id="viewPrice"></span></p>
            <p><strong>Quantity:</strong> <span id="viewQuantity"></span></p>
        </div>
    </div>

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

    <!-- JavaScript to control the modals -->
    <script>
        function openViewModal(id) {
            var item = <?php echo json_encode($items); ?>.find(function(item) {
                return item.id === id;
            });

            document.getElementById('viewName').innerText = item.name;
            document.getElementById('viewPrice').innerText = item.price;
            document.getElementById('viewQuantity').innerText = item.quantity;

            document.getElementById('viewModal').style.display = 'block';
        }

        function closeViewModal() {
            document.getElementById('viewModal').style.display = 'none';
        }

        function openEditModal(id) {
            var item = <?php echo json_encode($items); ?>.find(function(item) {
                return item.id === id;
            });

            document.getElementById('editId').value = id;
            document.getElementById('editName').value = item.name;
            document.getElementById('editPrice').value = item.price;
            document.getElementById('editQuantity').value = item.quantity;

            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete?')) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</body>
</html>
