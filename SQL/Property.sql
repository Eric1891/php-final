use cis495;
DROP PROCEDURE IF EXISTS propertyList;
DROP PROCEDURE IF EXISTS stateList;
DROP FUNCTION IF EXISTS deletePropertyByNumber;
DROP FUNCTION IF EXISTS insertProperty;
DROP FUNCTION IF EXISTS branchList;

DELIMITER $$


CREATE PROCEDURE stateList()
BEGIN
  SELECT state_id, name, abb FROM STATE;
END $$

CREATE PROCEDURE branchList()
BEGIN
  SELECT branch_no FROM branch;
END $$



/*
 * Function to add a new property_for_rent
 * The function checks if the property number already exists.
 * If the number doesn't exist, the insertion qurey executes
 * 
 * We will skip client assignment here
 *
 * The function returns these codes
 * -1: insert failed, number exists
 *  0: insert failed, other reasons
 *  1: insert OK
 */
CREATE FUNCTION insertProperty (p_staff_no VARCHAR(5), p_branch_no VARCHAR(5), p_address_id INT,
p_property_no VARCHAR(5), p_rooms VARCHAR(45), p_rent INT, p_prop_type VARCHAR(45)) RETURNS INT
BEGIN
	-- Declare and initialize variables
    DECLARE v_address_id INT;
    DECLARE v_result INT;
    DECLARE v_pk_count INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;

    SET v_address_id = -1;
    SET v_result = -1;
    SET v_pk_count = 0;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;

    -- Check if the ID is already used
    SELECT COUNT(*)
    INTO v_pk_count
    FROM   property_for_rent
    WHERE property_no = p_property_no;

    IF v_pk_count = 0 THEN

        -- Here when the ID is OK
        SELECT COUNT(*)
        INTO v_row_count_before
        FROM property_for_rent;

        
        INSERT INTO property_for_rent (property_no, address_id, prop_type, rooms, 
        rent, staff_no, branch_no) VALUE (p_property_no, p_address_id, p_prop_type,
        p_rooms, p_rent, p_staff_no, p_branch_no);

        SELECT COUNT(*)
        INTO v_row_count_after
        FROM property_for_rent;

        /*
         * Compare the row count before and after.
         * If the difference is 0, then the indsert did not succeed
         */
        IF v_row_count_after - v_row_count_before = 1 THEN
            -- insert succeeded
            SET v_result = 1;
        ELSE
            -- insert failed
            SET v_result = 0;
        END IF;

    END IF;

    return v_result;


END $$

/*
 * Procedure for returning all rows in the property_for_rent table
 */
CREATE PROCEDURE propertyList()
BEGIN
	SELECT property_no,
		   prop_type,
		   rooms,
		   rent, 
		   staff_no, 
		   branch_no, 
		   street1,
		   street2,
		   city,
		   state.name AS sn,
		   zip
	FROM property_for_rent 
    INNER JOIN address USING (address_id)
	INNER JOIN state USING (state_id);
	
END $$


/*
 * Function for deleting a record from the property_for_rent table
 * The function checks if the property number to be deleted is being referenced by the property table (FK).
 * If a FK exists, then the delete will not be allowed.
 * 
 * The function returns these codes
 * -1: delete failed a FK exists
 *  0: delete failed
 *  1: delete OK 
 */
CREATE FUNCTION deletePropertyByNumber(p_property_no VARCHAR(5)) RETURNS INT
BEGIN

   -- Declare and initialize variables
    DECLARE v_result INT;
    DECLARE v_row_count_before INT;
    DECLARE v_row_count_after INT;

    SET v_result = -1;
    SET v_row_count_before = 0;
    SET v_row_count_after = 0;


    -- Record the number of rows in the person table before and after
    -- If the after count < the before, then the delete operation succeeded
    SELECT COUNT(*)
    INTO v_row_count_before
    FROM property_for_rent;


    DELETE FROM property_for_rent 
    WHERE property_no = p_property_no;
    
    

    SELECT COUNT(*)
    INTO v_row_count_after
    FROM property_for_rent;

    /*
     * Compare the row count before and after.
     * If the difference is 0, then the delete did not succeed.
     */
    IF v_row_count_before - v_row_count_after != 0 THEN
        -- Delete succeeded
        SET v_result = 1;
    ELSE
        -- Delete failed
        SET v_result = 0;
    END IF;

  return v_result;

END $$

DELIMITER ;

