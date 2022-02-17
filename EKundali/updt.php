<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location:/403.html");
    $directaccess = 1;
}


include __DIR__ . ('./Sheets/vendor/autoload.php');
include __DIR__ . ('./Sheets/config.php');
include "../php/api_includes.php";

$data_resp = array(

    'uname' => "{$_POST['name']}",
    'gender' => "{$_POST['gender']}",
    'language' => "{$_POST['language']}",
    'dob' => "{$_POST['dob']}",
    'tob' => "{$_POST['tob']}",
    'birth_place' => "{$_POST['place']}",
    'orderid' => "{$_POST['orderid']}",
    'transanctionid' => "{$_POST['transactionid']}",
    'hash' => "{$_SESSION['encrypt']}",
    'module' => "{$_POST['modules']}"

);
echo $data_resp['module'];

append_to_sheet($sheetId, $data_resp);

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
        $range = 'A1:J1';
        $values = [
            [
                $data_append['uname'],
                $data_append['gender'],
                $data_append['language'],
                $data_append['dob'],
                $data_append['tob'],
                $data_append['birth_place'],
                $data_append['orderid'],
                $data_append['transanctionid'],
                $data_append['hash'],
                $data_append['module']

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

            append_to_sheet($spreadsheetId, $data_append);
        } else {
            echo $e->getMessage(); //print the error just in case your data is not appended.
        }
    }
}
