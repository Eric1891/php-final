<?php

include_once 'functions/Property.php';

include_once 'Header.php';



if (isset ( $_GET ['delRowPropertyno'] )) {
    
    $rowPropertyNo = $_GET ['delRowPropertyno'];
    
    $deleteResult = delProperty ($rowPropertyNo);
    
    if ($deleteResult == - 1)
       showErrorMessage ( "Failed to delete row PropertyNo  $rowPropertyNo. FK Violation" );
    elseif ($deleteResult == 0)
        showErrorMessage ( "Failed to deleted row PropertyNo  $rowPropertyNo" );
    else
        showInfoMessage ( "Successfully deleted row PropertyNo  $rowPropertyNo" );
        }
?>

<?php

$result = getAllProperty();

if(!$result)

   echo  "Failed to get Property list";
  else
if ($result->num_rows > 0)
{
		 
    // Print table's header
    echo '<table width="100%" border="1">
            <tr>
                <td><strong>Property Number</strong></td>
                <td><strong>Type</strong></td>
                <td><strong>Rooms</strong></td>
                <td><strong>Rent</strong></td>
                <td><strong>StaffNo</strong></td>
                <td><strong>Branch Number</strong></td>
                <td><strong>Address</strong></td>
                <td><strong>Delete?</strong></td>
            </tr>';
    
    // Print table's body
      while ( $rows = $result->fetch_assoc () ) {
		
		echo"<tr>
		         <td>{$rows ['property_no']}</td>
                <td>{$rows ['prop_type']}</td>
                <td>{$rows ['rooms']}</td>
                <td>{$rows ['rent']}</td>
                <td>{$rows ['staff_no']}</td>
				<td>{$rows ['branch_no']}</td>
				 <td>{$rows ['street1']},
					{$rows ['street2']}<BR/>
					{$rows ['city']},
					{$rows ['sn']},
					{$rows ['zip']}</td>
					
                <td>
                    <form action=propertyList.php>
                        <input type=hidden name=delRowPropertyno value=\"{$rows ['property_no']}\" />
                        <button type=submit>Delete</button>
                    </form>
                </td>
		</tr>";
    }
    echo '</table>';
    
}
include_once 'footer.php';
?>
