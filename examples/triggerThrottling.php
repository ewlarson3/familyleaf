<?php

include_once '_includes.php';
include_once '_header.php';

// Fetch a person if a person id has been provided
if ($_GET['pid']) {
  $n = 0;
  do {
    $response = $fs->get('/platform/tree/persons/' . $_GET['pid'] . '/matches', [
      'headers' => [
        'Accept' => 'application/json'  
      ]  
    ]);
    $n++;
  } while ($response->statusCode < 400 && !$response->throttled && $n < 50);
  
  echo '<h2>Throttle Response</h2>';
  prettyPrint($response);
}

// Show a form if a person id hasn't been provided
else {
  ?>
    <form>
      <label>Person ID:</label>
      <input type="text" name="pid" placeholder="KWMX-PR9" />
      <button>Submit</button>
    </form>
  <?php
}

include_once '_footer.php';