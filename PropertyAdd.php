<?php

include_once 'functions/Person.php';
include_once 'functions/Property.php';
include_once 'Header.php';

$staffNo = getIfSet("staffNo");
$branchNo =getIfSet ( "branchNo" );
$addressID = getIfSet ( "addressID" );
$propNo = getIfSet ( "propNo" );
$rooms = getIfSet ( "rooms" );
$rent = getIfSet ( "rent" );
$type = getIfSet ( "type" );

$Branch=getIfSet("Branch");

if(isset($_REQUEST['staffNo'])){
		if(strlen($_REQUEST['staffNo'])>=1)
		echo "<br><b>staffNo: </b>". $_REQUEST['staffNo'];
		else
			echo"<br><b>Error:</b>Please select a staffNo.";
	};
	
if(isset($_REQUEST['branchNo'])){
		if(strlen($_REQUEST['branchNo'])>=1)
		echo "<br><b>branchNo: </b>". $_REQUEST['branchNo'];
		else
			echo"<br><b>Error:</b>Please select a branchNo.";
	};	
	
if(isset($_REQUEST['addressID'])){
		if(strlen($_REQUEST['addressID'])>=1)
		echo "<br><b>addressID: </b>". $_REQUEST['addressID'];
		else
			echo"<br><b>Error:</b>Please enter an addressID.";
	};	
	
if(isset($_REQUEST['propNo'])){
		if(strlen($_REQUEST['propNo'])>=1)
		echo "<br><b>propNo: </b>". $_REQUEST['propNo'];
		else
			echo"<br><b>Error:</b>Please enter a propNo.";
	};
	
if(isset($_REQUEST['rooms'])){
		if(strlen($_REQUEST['rooms'])>=1)
		echo "<br><b>rooms: </b>". $_REQUEST['rooms'];
		else
			echo"<br><b>Error:</b>Please enter a rooms number.";
	};
	
if(isset($_REQUEST['rent'])){
		if(strlen($_REQUEST['rent'])>=1)
		echo "<br><b>rent: </b>". $_REQUEST['rent'];
		else
			echo"<br><b>Error:</b>Please enter a rent number.";
	};	
	
if(isset($_REQUEST['type'])){
		if(strlen($_REQUEST['type'])>=1)
		echo "<br><b>type: </b>". $_REQUEST['type'];
		else
			echo"<br><b>Error:</b>Please select a type.";
	};	
		
if (isValid_and_set ( "staffNo" )  && isValid_and_set ( "branchNo" ) 
&& is_numeric  ($_GET['addressID'] ) && isValid_and_set  ("propNo" ) 
&& is_numeric  ($_GET['rooms'] ) 
&& is_numeric ( $_GET['rent']) && isValid_and_set("type")) 


{
    
    $insertResult = addProperty ( $staffNo, $branchNo, $addressID, $propNo, $rooms, $rent, $type);
    
    if ($insertResult == - 1)
        showErrorMessage ( "Failed to insert row ID $propNo. PK repeated" );
    elseif ($insertResult == 0)
        showErrorMessage ( "Failed to insert row ID $propNo" );
    else
        showInfoMessage ( "Successfully inserted row ID $propNo" );
} else if (isset ( $_GET ['btnAddProp'] ))
    showErrorMessage ( "Please enter valid values" );

?>
<form name="frmAddProperty">
    <table border="0">
        <tr>
            <td width="90">
                <strong>Staff:</strong>
            </td>
            <td>
                <SELECT name=staffNo>
					<option value="">None</option>
<?php
$result = getAllStaff ();
while ( $rows = $result->fetch_assoc () ) {
?>
    <option value=<?=$rows['staff_no']?> <?=$staffNo==$rows['staff_no']?"selected":""?>>(<?=$rows['staff_no']?>) <?=$rows['last_name'], $rows['first_name']?></option>";
<?php
}
?>
   </SELECT></td></tr>
        <tr><td width="150">
                <strong>Branch:</strong>
            </td><td>
   <SELECT name=branchNo><option value="">None</option>
   
<?php
$result = getAllBranch ();
while ( $rows = $result->fetch_assoc () ) {
	
	  echo "<option value=\"{$rows['branch_no']}\"";
    
    if ($Branch == $rows ['branch_no'])
        echo "SELECTED";
    
    echo ">{$rows['branch_no']}</option>";

}
?>
 </SELECT>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Address ID<br>(From address table):</strong>
            </td>
            <td>
                <INPUT type=text name=addressID   value="<?=$addressID ?>" />
                
 

                
            </td>
        </tr>
        <tr>
            <td>
                <strong>Property Number:</strong>
            </td>
            <td>
                <input type=text name=propNo value="<?=$propNo ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Rooms:</strong>
            </td>
            <td>
                <input type=text name=rooms value="<?=$rooms ?>"  />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Rent:</strong>
            </td>
            <td>
                <input type=text name=rent value="<?=$rent ?>"  />
            </td>
        </tr>
        <tr>
            <td>
                <strong>Type:</strong>
            </td>
            <td>
                <input type=radio name=type value="H" <?php echo ($type  == 'H'?"CHECKED":"") ?>>House<BR>
                <input type=radio name=type value="F" <?php echo ($type  == 'F'?"CHECKED":"") ?>>Flat<BR>
                <input type=radio name=type value="C" <?php echo ($type  == 'C'?"CHECKED":"") ?>>Condo<BR>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <button type=submit name=btnAddProp>Add</button>
                <button type=reset>Reset</button>
            </td>
        </tr>
    </table>
</form>

<?php
include_once 'footer.php';
?>
