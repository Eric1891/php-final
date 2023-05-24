<?php

include_once 'functions/Common.php';
include_once 'Header.php';

$dbc = getDBC();

if($dbc->connect_errno) {
    
    echo "<h2 style=color:#F00><IMG src=icons/Error.png> Error Code: $dbc->connect_errno. ";
    echo "Connection info in the function getDBC() in the file: " . realpath ('.') . '/functions/Common.php' . "</h2>";

    switch($dbc->connect_errno) {
      case 1045:
        echo "<h2 style=color:#F00><IMG src=icons/Error.png> Incorrect Username/password. Check the value of \$user and \$pass";
        break;
      case 1049:
        echo "<h2 style=color:#F00><IMG src=icons/Error.png> Incorrect database name. Check the value of \$db</h2>";
        break;
      case 2002:
        echo "<h2 style=color:#F00><IMG src=icons/Error.png> Cannot connect to database. Check the value of \$host</h2>";
        break;
    }

	$dbc->close();
}
else {
    
    echo "<h2 class=messageOK><IMG src=icons/OK.png> Successfully connected to database</h2>";

	$dbc = getDBC();
    $result = $dbc->query("SHOW TABLES");
    $dbc->close();

    if($result && $result->num_rows > 0) {
            
        echo "<h2 class=messageOK><IMG src=icons/OK.png> Tables found</h2>";
		
		$dbc = getDBC();
        $result = $dbc->query("SELECT count(*) pCount FROM person");
		$dbc->close();
		        
        if($result && $result->fetch_assoc()['pCount'] > 0) {
            
            echo "<h2 class=messageOK><IMG src=icons/OK.png> Test data found</h2>";				
			
			$dbc = getDBC ();            
            $result = $dbc->query("CALL personList()");
			$dbc->close();
            
            if($result) {

                echo "<h2 class=messageOK><IMG src=icons/OK.png> Person procedure found</h2>";
				
				$dbc = getDBC ();
				$result = $dbc->query("CALL insertProperty()");
				
				if($result)
					echo "<h2 class=messageOK><IMG src=icons/OK.png> insertProperty() found</h2>";
				else
					echo "<h2 style=color:#F00><IMG src=icons/Error.png> insertProperty() not found. Implement and load from " . realpath ('.') . '/SQL/Property.sql' . "</h2>";
				
				$result = $dbc->query("CALL propertyList()");
				
				if($result)
					echo "<h2 class=messageOK><IMG src=icons/OK.png> propertyList() found</h2>";
				else
					echo "<h2 style=color:#F00><IMG src=icons/Error.png> propertyList() not found. Implement and load from " . realpath ('.') . '/SQL/Property.sql' . "</h2>";
				
				$result = $dbc->query("CALL deletePropertyByNumber()");
				
				if($result)
					echo "<h2 class=messageOK><IMG src=icons/OK.png> deletePropertyByNumber() found</h2>";
				else
					echo "<h2 style=color:#F00><IMG src=icons/Error.png> deletePropertyByNumber() not found. Implement and load from " . realpath ('.') . '/SQL/Property.sql' . "</h2>";
				
				
				$dbc->close();
			}
            else
                echo "<h2 style=color:#F00><IMG src=icons/Error.png> Person procedures not loaded. Load from " . realpath ('.') . '/SQL/Person.sql' . "</h2>";
        }
        else
            echo "<h2 style=color:#F00><IMG src=icons/Error.png> Data not loaded from " . realpath ('.') . '/SQL/TestData.sql' . "</h2>";
    }
    else
        echo "<h2 style=color:#F00><IMG src=icons/Error.png> Tables not loaded from " . realpath ('.') . '/SQL/Tables.sql' . "</h2>";
}

include_once 'footer.php';

?>