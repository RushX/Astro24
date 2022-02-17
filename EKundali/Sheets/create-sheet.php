<?php
require_once 'config.php';
require_once './php/api_includes.php';
session_start();
function create_spreadsheet()
{

    $client = new Google_Client();

    $db = new DB();

    $arr_token = (array) $db->get_access_token();
    $accessToken = array(
        'access_token' => $arr_token['access_token'],
        'expires_in' => $arr_token['expires_in'],
    );

    $client->setAccessToken($accessToken);

    $service = new Google_Service_Sheets($client);

    try {
        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => [
                'title' => 'DH_Sheet'
            ]
        ]);
        $spreadsheet = $service->spreadsheets->create($spreadsheet, [
            'fields' => 'spreadsheetId'
        ]);
        printf("Spreadsheet ID: %s\n", $spreadsheet->spreadsheetId);
    } catch (Exception $e) {
        if (401 == $e->getCode()) {
            $refresh_token = $db->get_refersh_token();

            $client = new GuzzleHttp\Client(['base_uri' => 'https://accounts.google.com']);

            $response = $client->request('POST', '/o/oauth2/token', [
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token,
                    "client_id" => GOOGLE_CLIENT_ID,
                    "client_secret" => GOOGLE_CLIENT_SECRET,
                ],
            ]);

            $data = (array) json_decode($response->getBody());
            $data['refresh_token'] = $refresh_token;

            $db->update_access_token(json_encode($data));

            create_spreadsheet();
        } else {
            echo $e->getMessage(); //print the error just in case your sheet is not created.
        }
    }
}

create_spreadsheet();

$data_resp = array(

    'uname' => 'Rushi muley',
    'mname' => 'Gayatri',
    'dob' => '25/12/2002',
    'tob' => '4:30',
    'birth_place' => 'Beed',
    'orderid' => '5asdase3$ew',
    'transanctionid' => '5sdfs334',
    'hash' => '5192925',

);

function append_to_sheet($spreadsheetId = '', $data_append)
{
    $client = new Google_Client();

    $db = new DB();

    $arr_token = (array) $db->get_access_token();
    $accessToken = array(
        'access_token' => $arr_token['access_token'],
        'expires_in' => $arr_token['expires_in'],
    );

    $client->setAccessToken($accessToken);

    $service = new Google_Service_Sheets($client);

    try {
        $range = 'A1:H1';
        $values = [
            [
                $data_append['uname'],
                $data_append['mname'],
                $data_append['dob'],
                $data_append['tob'],
                $data_append['birth_place'],
                $data_append['orderid'],
                $data_append['transanctionid'],
                $data_append['hash'],

            ],
            // Additional rows ...
        ];
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
        printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());
    } catch (Exception $e) {
        if (401 == $e->getCode()) {
            $refresh_token = $db->get_refersh_token();

            $client = new GuzzleHttp\Client(['base_uri' => 'https://accounts.google.com']);

            $response = $client->request('POST', '/o/oauth2/token', [
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token,
                    "client_id" => GOOGLE_CLIENT_ID,
                    "client_secret" => GOOGLE_CLIENT_SECRET,
                ],
            ]);

            $data = (array) json_decode($response->getBody());
            $data['refresh_token'] = $refresh_token;

            $db->update_access_token(json_encode($data));

            append_to_sheet($spreadsheetId);
        } else {
            echo $e->getMessage(); //print the error just in case your data is not appended.
        }
    }
}
?>