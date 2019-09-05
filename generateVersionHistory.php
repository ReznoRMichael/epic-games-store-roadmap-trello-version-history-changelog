<?php
// $execution_time = microtime(true); // Start counting
// Get the contents of the JSON file 
$strJsonFileContents = file_get_contents("GXLc34hk.json");
// Convert to associative array for use with PHP
$arrayJSON = json_decode($strJsonFileContents, true);
// var_dump($arrayJSON); // print array

echo ""; // clear the contents each time

/**
 * Gets the "createCard" date from the Trello JSON file
 * @param string $cardID
 * @param mixed $arrayJSON
 * @return string
 */
function getCreateCardDate($cardID, $arrayJSON) {
    foreach($arrayJSON["actions"] as $i) {
        if(array_key_exists("card", $i["data"])) {
            if($i["data"]["card"]["id"] === $cardID && $i["type"] === "createCard") {
                return $i["date"];
            }
        }
    }
    return "2019-01-01T00:00:00.001Z"; // dummy date in case there will be some error
}

/**
 * Generates the card version history on the page by reading the JSON file
 * @param mixed $arrayJSON
 * @return void
 */
function generateCardVersionHistory($arrayJSON) {
    $releaseHistoryId = "5c8aded82d38c74039cf8009"; // the id of the list "Releases / Patch Notes" on Epic's Trello Roadmap
    $searchResult = ""; $allEntries = ""; $entryURL = ""; $cardID = "";
    $elem = 0; // just for counting the element's number in the JSON file for easier debugging
    foreach($arrayJSON["cards"] as $i) {
        if(array_key_exists( "idList", $i)) {
            $searchResult = $i["idList"];

            if($searchResult == $releaseHistoryId) {
                $entryURL = $i["url"]; // URL for each card's link
                $cardID = $i["id"]; // save card's ID for getCreateCardDate()
                $entryDate = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', getCreateCardDate($cardID, $arrayJSON))->format('Y-m-d');

                if(array_key_exists("desc", $i)) {
                    $entryProgram = $i["name"];
                    if(ctype_space($i["desc"]) || strlen($i["desc"]) < 1) {
                        $entryLog = "(No Patch Release description was given for this entry)";
                    } else {
                        $searchFor = array("**Patch Notes:**", "**Patch Notes**", "Patch Notes:", "Patch Notes");
                        $replaceWith = array("", "", "", "");
                        $entryLog = str_replace($searchFor, $replaceWith, $i["desc"]); // delete the "Patch Notes" texts
                        $entryLog = trim($entryLog); // delete all whitespace from beginning and ending
                        $entryLog = str_replace("\n", "<br>", $entryLog); // replace all newline characters with html <br>
                    }
                } else {
                    $entryProgram = $i["name"];
                    $entryLog = "(No Patch Release description was given for this entry)";
                }

                // single entry in the html
                $entry = [
                    "<div>",
                        "<div class='horizontal-line'></div>",
                        // "<div class='entryNo'>" . $elem . "</div>",
                        "<p><a href='" . $entryURL . "' target='_blank' title='Click to open the link to the Trello card in a separate window'>"
                         . $entryProgram . "</a><span class='date'> ( " . $entryDate . " )</span></p>",
                        "<p class='changelog'>" . $entryLog . "</div>",
                    "</div>"
                ];
                $entry = implode("\n", $entry);

                // append single entry to the final result
                $allEntries .= $entry;
            }
        }
        $elem++;
    }
    // view final result
    echo $allEntries;
}

generateCardVersionHistory($arrayJSON);

// $execution_time = microtime(true) - $execution_time;
// printf('It took %.5f sec', $execution_time);