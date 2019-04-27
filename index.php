<?php

require dirname(__FILE__) . '/vendor/autoload.php';

require_once 'utils.php';

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets($client);

$config = parse_ini_file('properties.ini');

// Prints the names and majors of students in a sample spreadsheet:
$spreadsheetId = $config['spreadsheet_id'];
$range = 'A1:E104';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    print "Name, Major:\n";
    foreach ($values as $row) {
        // Print columns A and E, which correspond to indices 0 and 4.
        printf("%s, %s, %s, %s, %s\n", $row[0], $row[1], $row[2], $row[3], $row[4]);
    }
}