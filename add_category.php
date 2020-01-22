<?php
// Get IDs
$category_name = filter_input(INPUT_POST, 'name');

// Validate inputs
if ($category_name == null) {
	$error = "Invalid category name.";
	include('error.php');
} else {
	require_once('database.php');
// Delete the product from the database
    $query = 'INSERT INTO categories (categoryName)
              VALUES (:category_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_name', $category_name);
    $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('category_list.php');