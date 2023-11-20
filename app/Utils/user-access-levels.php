<?php
/**
 * Access rules for different folders in the APP folder.
 * 
 * @param string Request type - defined throught Routes.php
 * 
 * @return bool
 */

function checkingUserAccessLevel($type)
{
    switch($type)
    {   
        case "public":
            return true;
        break;

        // case "auth":
        //     if (isset($_SESSION['adm_usr']) && !empty($_SESSION['adm_usr']) ){
        //         $id = $_SESSION['adm_usr'];
        //         if ($id in database) return false
        //     }
        // break;
    }
}
?>