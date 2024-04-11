<?php

include('connection.php');


$categoryName = isset($_POST['categoryName']) ? $_POST['categoryName'] : '';
$chefName = isset($_POST['chefName']) ? $_POST['chefName'] : '';
$locationName = isset($_POST['locationName']) ? $_POST['locationName'] : '';


$sql = "SELECT recipes.title, categories.name as categoryName, chefs.name as chefName, locations.name as locationName 
        FROM recipes
        LEFT JOIN categories ON recipes.category_id = categories.id
        LEFT JOIN chefs ON recipes.chef_id = chefs.id
        LEFT JOIN locations ON recipes.location_id = locations.id
        WHERE ('$categoryName' = '' OR categories.name LIKE '%$categoryName%') AND
              ('$chefName' = '' OR chefs.name LIKE '%$chefName%') AND
              ('$locationName' = '' OR locations.name LIKE '%$locationName%')";

$result = $db->query($sql);


if ($result && $result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> Recipe Title: ". $row["title"]. " - Category: ". $row["categoryName"]. 
             " - Chef Name: ". $row["chefName"]. " - Location: " . $row["locationName"] . "<br>";
    }
} else {
    echo "0 results";
}

$db->close();
?>