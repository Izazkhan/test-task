<?php
/**
 * Sends a JSON response with proper headers.
 *
 * @param mixed $data The data to be encoded into JSON.
 * @param int $statusCode The HTTP status code to send (default is 200).
 */
function jsonResponse($data, $statusCode = 200)
{
    // Set the response status code
    http_response_code($statusCode);

    // Set the content type to JSON
    header('Content-Type: application/json');
    // Encode the data to JSON and send the response
    echo json_encode($data);
    exit; // Ensure no further code is executed after the response
}
