<?php
/*


Usage:

<?php
require_once( 'includes/class.connector.php');

$connector = new connector();

$result =  $connector->query( "select * from table" );
while( $row = $connector->getRows( $result ) ) {

  echo '<p>'.$row['attribute'].'</p>';

}

?>

*/



//require_once 'class.systemconfig.php';

class connector
{
  var $theQuery;
  var $link;
 
  function connector()
  {
    # Load settings from parent class
    //$settings = systemConfig::getSettings();

    #Get the main settings from the array we just loaded
    $host   = '127.0.0.1:3310';
    $db     = 'rlibcalendar';
    $user   = 'webuser01';
    $pass   = 'w3bpas2';

    # Connect to the database
    if( $this->link = mysql_connect( $host, $user, $pass ) )
	{ 
	  if( !mysql_select_db( $db ) )
	  {
	    echo '<p><b>Error:</b> Could not select the database. '.mysql_error().'. Please try again later</p>'; 
		exit;
	  }
	}
	else 
	{ 
	  echo '<p><b>Error:</b> Could not connect to the database. '.mysql_error().'. Please try again later</p>';
	  exit;
	}
	 
	register_shutdown_function( array( &$this, 'close' ) );
  }

  function query($query)
  {
    $this->theQuery = $query;
    return mysql_query($query, $this->link);
  }
   
  function getRows($result)
  {
    return mysql_fetch_array($result);
  }
  
  function numRows( $result )
  {
    return mysql_num_rows( $result );
  }

  function close()
  {
    mysql_close($this->link);
  }
}
?>