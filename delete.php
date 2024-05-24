<?php
// Include the PHP file with the CRUD functions
include 'crud_functions.php';

// Check if the item ID is set in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Call the deleteItem function with the item ID
    if(deleteItem($id)) {
        // Redirect back to the display page after successful deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Failed to delete item.";
    }
}
?>
