<?php
// Get the contents of the JSON file 
$strJsonFileContents = file_get_contents("GXLc34hk.json");
// Convert to array for use with PHP
$arrayJSON = json_decode($strJsonFileContents, true);
// var_dump($arrayJSON); // print array

function generateVersionHistory($arrayJSON) {
    $releaseHistoryId = "5c8aded82d38c74039cf8009"; // the id of Version History on Trello
    $searchResult = "";
    $allEntries = "";
    echo ""; // clear the contents each time the function is called

    $elem = 0;
    foreach($arrayJSON["actions"] as $i) {
        if(array_key_exists( "list", $i["data"])) {
            $searchResult = $i["data"]["list"]["id"];

            if($searchResult == $releaseHistoryId) {
                // $entryDate = DateTime::createFromFormat('Y-m-dTH:i:s.u', str_replace("Z", "", $i["date"]))->format('Y-m-d');
                // var_dump($entryDate);
                
                $entryDate = substr($i["date"], 0, 10);
                if(array_key_exists("card", $i["data"])) {
                    if(array_key_exists("desc", $i["data"]["card"])) {
                        $entryLog = str_replace("\n", "<br>", $i["data"]["card"]["desc"]);
                        $entryProgram = $i["data"]["card"]["name"];
                    } else {
                        $elem++;
                        continue;
                    }
                }

                $entry = [
                    "<div>",
                        "<div style='border-bottom:1px solid lightgray;'></div>",
                        //"<div class='entryNo'>" . $elem . "</div>",
                        "<div class='date'>" . $entryDate . "</div>",
                        "<p><strong>" . $entryProgram . "</strong></p>",
                        "<p class='changelog'>" . $entryLog . "</div>",
                    "</div>"
                ];
                $entry = implode("\n", $entry);
            
                $allEntries .= $entry;
            }
        }
        $elem++;
    }

    /* ------------------------------------------------------------------------------------ */
    // View all read entries in the #generate div
    /* ------------------------------------------------------------------------------------ */

    function viewAllEntries($allEntries) {
        echo $allEntries;
    }

    viewAllEntries($allEntries);
}

generateVersionHistory($arrayJSON);