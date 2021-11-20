<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: projects.php' );
  die();
  
}

if( isset( $_POST['propertyName'] ) )
{
  
  if( $_POST['propertyName'] and $_POST['content'] )
  {
    
    $query = 'UPDATE projects SET
      propertyName = "'.mysqli_real_escape_string( $connect, $_POST['propertyName'] ).'",
      content = "'.mysqli_real_escape_string( $connect, $_POST['content'] ).'",
      fromDate = "'.mysqli_real_escape_string( $connect, $_POST['fromDate'] ).'",
      toDate = "'.mysqli_real_escape_string( $connect, $_POST['toDate'] ).'",
      type = "'.mysqli_real_escape_string( $connect, $_POST['type'] ).'",
      photo = "'.mysqli_real_escape_string( $connect, $_POST['photo'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Project has been updated' );
    
  }

  header( 'Location: projects.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM projects
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: projects.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

?>

<h2>Edit Project</h2>

<form method="post">
  
  <label for="propertyName">Property Name:</label>
  <input type="text" name="propertyName" id="propertyName" value="<?php echo htmlentities( $record['propertyName'] ); ?>">
    
  <br>
  
  <label for="content">Content:</label>
  <textarea type="text" name="content" id="content" rows="5"><?php echo htmlentities( $record['content'] ); ?></textarea>
  
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
  <input type="date" name="fromDate" id="fromDate" value="<?php echo htmlentities( $record['date'] ); ?>">
    
  <br>

  <label for="toDate">To Date:</label>
  <input type="date" name="toDate" id="toDate" value="<?php echo htmlentities( $record['date'] ); ?>">
    
  <br>
  
  <label for="type">Type:</label>
  <?php
  
  $values = array( 'Website', 'Graphic Design' );
  
  echo '<select name="type" id="type">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $value == $record['type'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Edit Project">
  
</form>

<p><a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a></p>


<?php

include( 'includes/footer.php' );

?>
