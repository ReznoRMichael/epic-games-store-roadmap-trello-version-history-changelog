<?php
// Get the contents of the JSON file 
$strJsonFileContents = file_get_contents("GXLc34hk.json");
// Convert to array for use with PHP
$arrayJSON = json_decode($strJsonFileContents, true);
// var_dump($arrayJSON); // print array

function generateCardVersionHistory($arrayJSON) {
    $releaseHistoryId = "5c8aded82d38c74039cf8009"; // the id of Version History on Trello
    $searchResult = ""; $allEntries = ""; $cardID = "";
    echo ""; // clear the contents each time the function is called

    $elem = 0;
    foreach($arrayJSON["cards"] as $i) {
        if(array_key_exists( "idList", $i)) {
            $searchResult = $i["idList"];

            if($searchResult == $releaseHistoryId) {
                $entryDate = substr($i["dateLastActivity"], 0, 10) . " — " . substr($i["dateLastActivity"], 11, 8); // "2019-08-28T17:56:51.603Z";
                $entryURL = $i["url"];

                if(array_key_exists("desc", $i)) {
                    $entryProgram = $i["name"];
                    if(ctype_space($i["desc"]) || strlen($i["desc"]) < 1) {
                        $entryLog = "(No Patch Release description was given for this entry)";
                    } else {
                        $entryLog = str_replace("\n", "<br>", $i["desc"]);
                    }
                } else {
                    $entryProgram = $i["name"];
                    $entryLog = "(No Patch Release description was given for this entry)";
                }

                $entry = [
                    "<div>",
                        "<div style='border-bottom:1px solid lightgray;'></div>",
                        // "<div class='entryNo'>" . $elem . "</div>",
                        "<div class='date'>" . $entryDate . "</div>",
                        "<p><a href='" . $entryURL . "' target='_blank' title='Click to open the link to the Trello card in a separate window'><strong>" . $entryProgram . "</strong></a></p>",
                        "<p class='changelog'>" . $entryLog . "</div>",
                    "</div>"
                ];
                $entry = implode("\n", $entry);
            
                $allEntries .= $entry;
            }
        }
        $elem++;
    }
    echo $allEntries;
}

function generateActionVersionHistory($arrayJSON) {
    $releaseHistoryId = "5c8aded82d38c74039cf8009"; // the id of Version History on Trello
    $searchResult = ""; $allEntries = "";
    echo ""; // clear the contents each time the function is called

    $elem = 0;
    foreach($arrayJSON["actions"] as $i) {
        if(array_key_exists( "list", $i["data"])) {
            $searchResult = $i["data"]["list"]["id"];

            if($searchResult == $releaseHistoryId) {
                // $entryDate = DateTime::createFromFormat('Y-m-dTH:i:s.u', str_replace("Z", "", $i["date"]))->format('Y-m-d');
                // var_dump($entryDate);
                $entryDate = substr($i["date"], 0, 10) . " — " . substr($i["date"], 11, 8);
                if(array_key_exists("card", $i["data"])) {
                    if(array_key_exists("desc", $i["data"]["card"])) {
                        $entryProgram = $i["data"]["card"]["name"];
                        $entryLog = str_replace("\n", "<br>", $i["data"]["card"]["desc"]);
                    } else {
                        $entryProgram = $i["data"]["card"]["name"];
                        $entryLog = "(No Patch Release description was given for this entry)";
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
}

generateCardVersionHistory($arrayJSON);