<?php
// $execution_time = microtime(true); // Start counting
$publicKey = ""; // your Trello Public API key
$trelloBoardId = "5c8aab433718ca7a53ceb3b8"; // the id of the trello board for the API call
$releaseHistoryId = "5c8aded82d38c74039cf8009"; // the id of the list "Releases / Patch Notes" on Epic's Trello Roadmap
$URIparameters = "&cards=all&lists=all&actions=all"; // parameters for the REST API call
$curl = "https://api.trello.com/1/boards/" . $trelloBoardId . "/?key=" . $publicKey . $URIparameters; // REST API call to Trello servers
//$curl = "GXLc34hk.json"; // can be also a local downloaded .json file directly from Trello instead
// Put the contents of the JSON API response in a string
$strJsonFileContents = file_get_contents($curl);
// Convert the string to associative array for use with PHP
$arrayJSON = json_decode($strJsonFileContents, true);
//var_dump($arrayJSON); // view array in console
// console_log($arrayJSON); // view array in console

echo ""; // clear the contents each time

/**
 * Logs the JSON to the console for easy debugging using Javascript
 * @param array $output
 * @param bool $withScriptTags
 * @return string
 */
function console_log($output, $withScriptTags = true) {
    $jsCode = "console.log(" . json_encode($output, JSON_HEX_TAG) . ");";
    if ($withScriptTags) {
        $jsCode = "<script>" . $jsCode . "</script>";
    }
    echo $jsCode;
}

/**
 * Gets the "createCard" date from the Trello JSON file
 * @param string $cardID
 * @param mixed $arrayJSON
 * @return string
 */
function getCreateCardDate($cardID, $arrayJSON)
{
    foreach ($arrayJSON["actions"] as $i) {
        if (array_key_exists("card", $i["data"])) {
            if ($i["data"]["card"]["id"] === $cardID) {
                /* if ($i["type"] === "createCard") {
                    return $i["date"];
                } else if ($i["type"] === "updateCard") {
                    return $i["date"];
                } */
                return $i["date"];
            }
        }
    }
    return "2019-01-01T00:00:00.001Z"; // dummy date in case there will be some error
}

/**
 * Generates the card version history on the page by reading the JSON file
 * @param mixed $arrayJSON
 * @param string $releaseHistoryId
 * @return void
 */
function generateCardVersionHistory($arrayJSON, $releaseHistoryId)
{
    $searchResult = "";
    $allEntries = "";
    $entryURL = "";
    $cardID = "";
    $elem = 0; // just for counting the element's number in the JSON file for easier debugging
    foreach ($arrayJSON["cards"] as $i) {
        if (array_key_exists("idList", $i)) {
            $searchResult = $i["idList"];

            if ($searchResult == $releaseHistoryId) {
                $entryURL = $i["url"]; // URL for each card's link
                $cardID = $i["id"]; // save card's ID for getCreateCardDate()
                $cardDate = getCreateCardDate($cardID, $arrayJSON);
                    // In case missing/invalid date on the action, switch to the "Last Activity" date on the card instead
                    if ($cardDate === "2019-01-01T00:00:00.001Z") {
                        if ($i["dateLastActivity"]) $cardDate = $i["dateLastActivity"];
                    }
                $entryDate = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $cardDate);
                $entryDateShort = $entryDate->format('Y-m-d');
                $entryDateLong = $entryDate->format('Y-m-d H:i:s');

                if (array_key_exists("desc", $i)) {
                    $entryProgram = $i["name"];
                    if (ctype_space($i["desc"]) || strlen($i["desc"]) < 1) {
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
                    // "<div class='entryNo'>" . $elem . " cardId=" . $i["id"] . "</div>",
                    "<p><a href='" . $entryURL . "' target='_blank' rel='noreferrer' title='Click to open the link to the Trello card in a separate window'>"
                        . $entryProgram . "</a><span class='date' title='"
                        . $entryDateLong . " UTC±00:00 (dates are not accurate!)'> ( " . $entryDateShort . " )</span></p>",
                    "<p class='changelog'>" . $entryLog . "</p>",
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

generateCardVersionHistory($arrayJSON, $releaseHistoryId);

// $execution_time = microtime(true) - $execution_time;
// printf('It took %.5f sec', $execution_time);
