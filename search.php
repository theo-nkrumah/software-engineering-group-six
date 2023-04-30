<?php
// establish database connection
require_once 'db_config.php';

// check if search query parameter is set
if (isset($_GET['q'])) {
  // sanitize the user input
  $search_query = trim($_GET['q']);

  // create the search query
  $sql = "SELECT * FROM pizza WHERE name LIKE :search_query OR description LIKE :search_query";

  // prepare the query
  $stmt = $pdo->prepare($sql);

  // bind the search query parameter to the prepared statement
  $stmt->bindValue(':search_query', '%'.$search_query.'%', PDO::PARAM_STR);

  // execute the query
  $stmt->execute();

  // fetch the search results
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // display the search results
  if (count($results) > 0) {
    echo "<h3>Search Results:</h3>";
    echo "<ul>";
    foreach ($results as $result) {
      echo "<li>".$result['name']."</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>No search results found.</p>";
  }
}
?>
