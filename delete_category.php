<?php
// Get IDs
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Validate inputs
if ($category_id == null || $category_id == false) {
	$error = "Invalid category ID.";
	include('error.php');
} else {
	require_once('database.php');
// Delete the product from the database
    $query = 'DELETE FROM categories
              WHERE categoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('category_list.php');