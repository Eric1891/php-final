<?php

/*
 * Returns an object containing a list of all property in the database
 */
function getAllProperty() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL propertyList()" );
    
    $dbc->close ();
    
    return $resultArr;
}

/*
 * Returns an object containing a list of all persons in the database
 */
function getAllStaffNo() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL staffNoList()" );
    
    $dbc->close ();
    
    return $resultArr;
}

/*
 * Returns an object containing a list of all address in the database

function getAllAddress() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "CALL addressList()" );
    
    $dbc->close ();
    
    return $resultArr;
}
 */
 
function getAllBranch() {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT* FROM branch" );
    
    $dbc->close ();
    
    return $resultArr;
}


/*
 * Deletes a record from the person table with the given ID
 */
function delProperty ($rowPropertyNo) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT deletePropertyByNumber(\"$rowPropertyNo\") AS deleteResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['deleteResult'];
}

/*
 * Add a new person record to the person and address tables
 */
 
function addProperty($staffNo, $branchNo, $addressID, 
    $propNo, $rooms, $rent, $type) {
    $dbc = getDBC ();
    
    $resultArr = $dbc->query ( "SELECT insertProperty (\"$staffNo\", \"$branchNo\", 
    \"$addressID\", \"$propNo\", \"$rooms\", \"$rent\", \"$type\") AS insertResult" );
    
    $result = $resultArr->fetch_assoc ();
    
    $dbc->close ();
    
    return $result ['insertResult'];
}
?>

