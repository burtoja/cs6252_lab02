<?php
// Get IDs
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Validate inputs
if ($category_id == null || $category_id == false) {
	$error = "Invalid category ID.";
	include('error.php');
} else {
	require_once('database.php');
	
	//See how many rows are in products table with the given categoryID
	$query = 'SELECT * FROM products
			 WHERE categoryID = :category_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':category_id', $category_id);
	$statement->execute();
	$products = $statement->fetchAll();
	$statement->closeCursor();
	if (count($products) > 0) {
		$error = "The category cannot be deleted since it contains products.";
		include('error.php');
	} else {
	// Delete the category from the database
		$query = 'DELETE FROM categories
	              WHERE categoryID = :category_id';
	    $statement = $db->prepare($query);
	    $statement->bindValue(':category_id', $category_id);
	    $statement->execute();
	    $statement->closeCursor(); 
	    
	    // Display the Product List page
	    include('category_list.php');
    }
}

