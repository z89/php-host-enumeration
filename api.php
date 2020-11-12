<?php
// Check the hostname request is formatted correctly
if (isset($_GET['host'])) { 
    // Remove all instances of https:// or http:// and trim all whitespaces from the hostnamae
    $host = preg_replace("(https?://)", "", trim($_GET['host'])); 

    // Check if hostname provided is a valid match for processing
    if (!preg_match('/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/', $host)) { 
        echo "the hostname requested does not appear to be valid";
        exit; 
    } 
    
    // Start the timer for request
    $startTime = microtime(true); 

    // Open internet socket to the provided hostname 
    $fp = @fsockopen(gethostbyname($host), 80); 
    
    // Stop the timer for request
    $endTime = microtime(true); 

    // Calculate the time in milliseconds and round to two decimal places
    $mstime = round((($endTime - $startTime) * 1000), 2);
    
    // If the socket returns a sucessful connection (true) then process request
    if ($fp) { 
        header('Content-Type: application/json');
        echo json_encode(['ip'=>gethostbyname($host), 'hostname'=>$host, 'port'=>80, 'time'=>$mstime, 'connection'=>'successful'], JSON_PRETTY_PRINT);

    } else {
        header('Content-Type: application/json');
        echo json_encode(['hostname'=>$host, 'port'=>80, 'connection'=>'refused'], JSON_PRETTY_PRINT);
    }
}
?>