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
            width: 25%; /* Increased width for better content fit */
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 0;
            right: 0;
            font-size: 28px;
            font-weight: bold;
            padding: 5px;
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

    <?php
    // Display the items in a table
    $items = readItems();

    if (count($items) > 0) {
        echo '<table border="1">
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
                        <button onclick="openViewModal('.$item['id'].')">View</button> |
                        <button onclick="openEditModal('.$item['id'].')">Edit</button> |
                        <a href="#" onclick="confirmDelete('.$item['id'].')">Delete</a>
                    </td>
                </tr>';
        }

        echo '</table>';
    } else {
        echo 'No items found.';
    }
    ?>

    <br>
    <a href="#" onclick="openModal()">Add New Item</a>

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

    <!-- Your JavaScript to control the modals -->
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

        // Your existing functions for openModal, closeModal, confirmDelete, openEditModal
        // Make sure to include them here as well
    </script>
</body>
</html>
