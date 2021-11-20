<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['propertyName'] ) )
{
  
  if( $_POST['propertyName'] and $_POST['content'] )
  {
    
    $query = 'INSERT INTO projects (
        propertyName,
        content,
        type,
        fromDate,
        toDate,
        photo
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['propertyName'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['type'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['fromDate'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['toDate'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['photo'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Project has been added' );
    
  }
  
  header( 'Location: projects.php' );
  die();
  
}

?>

<h2>Add Project</h2>

<form method="post">
  
  <label for="propertyName">Property Name:</label>
  <input type="text" name="propertyName" id="propertyName">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="10"></textarea>
      
  <script>

  ClassicEditor
    .create( document.querySelector( '#content' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
  </script>
  
  <br>
  
  <label for="fromDate">From Date:</label>
  <input type="date" name="date" id="fromDate">
  
  <br>
  
  <label for="toDate">To Date:</label>
  <input type="date" name="date" id="toDate">
  
  <br>

  <label for="type">Type:</label>
  <?php
  
  $values = array( 'Website', 'Graphic Design' );
  
  echo '<select name="type" id="type">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Add Project">
  
</form>

<p><a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a></p>


<?php

include( 'includes/footer.php' );

?>
