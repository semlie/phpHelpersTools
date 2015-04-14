<?php

date_default_timezone_set('America/New_York');

class ApiRestHelper {

    public static function createApiCall($url, $method, $headers, $data = array()) {
        if ($method == 'PUT') {
            $headers[] = 'X-HTTP-Method-Override: PUT';
        }
//        $headers[] = "Cache-Control: no-cache";
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        switch ($method) {
            case 'GET':
                break;
            case 'POST':
                curl_setopt($handle, CURLOPT_POST, true);
                curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data,'','&'));
                break;
            case 'PUT':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($data,'','&'));
                break;
            case 'DELETE':
                curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        $response = curl_exec($handle);
        return $response;
    }

}

require_once 'interface\IcrmContact.php';

class CrmApi implements \crm\IcrmContact {

    public function getResponseStatus($param) {
        $response = json_decode($param, true);
//        var_dump($response);
        if ($response['status'] == 'SUCCESS') {
            return $response['data'];
            //Do something with contact
        } else {
            // Error, for example if we provided invalid contact id
            return FALSE;
            $errors = $response['errors'];
            exit;
            // Do something with errors
        }
    }

    function __construct() {
        $this->authenticationData = $this->login(CrmUser ,CrmPas);
        $this->headers = array(
            'Accept: application/json',
            'ZURMO_SESSION_ID: ' . $this->authenticationData['sessionId'],
            'ZURMO_TOKEN: ' . $this->authenticationData['token'],
            'ZURMO_API_REQUEST_TYPE: REST',
        );
    }

    function login($username, $password) {
        $headers = array(
            'Accept: application/json',
            'ZURMO_AUTH_USERNAME: ' . $username,
            'ZURMO_AUTH_PASSWORD: ' . $password,
            'ZURMO_API_REQUEST_TYPE: REST',
        );
        $response = ApiRestHelper::createApiCall(apiUrl . '/zurmo/api/login', 'POST', $headers);
        return $this->getResponseStatus($response);
    }

    public function creatNewCrmContact($user) {
        $response = ApiRestHelper::createApiCall(apiUrl . '/contacts/contact/api/create/', 'POST', $this->headers, array('data' => $user));
        return $this->getResponseStatus($response);
    }

    public function deleteCrmContact($userId) {
        $response = ApiRestHelper::createApiCall(apiUrl . '/contacts/contact/api/delete/' . $userId, 'DELETE', $this->headers);
       
        return $this->getResponseStatus($response);
    }

    public function getCrmContactByUserId($user) {

        $response = ApiRestHelper::createApiCall(apiUrl . '/contacts/contact/api/read/' . $user, 'GET', $this->headers);
        return $this->getResponseStatus($response);
    }

    public function searchCrmContactByEmail($user) {
        $data = array(
            'dynamicSearch' => array(
                'dynamicClauses' => array(
                    array(
                        'attributeIndexOrDerivedType' => 'primaryEmail',
                        'structurePosition' => 1,
                        'primaryEmail' => array('emailAddress' => $user)
                    ),
                    array(
                        'attributeIndexOrDerivedType' => 'name',
                        'structurePosition' => 2,
                        'mobilePhone' => $user,
                    ),
                    array(
                        'attributeIndexOrDerivedType' => 'name',
                        'structurePosition' => 3,
                        'firstName' => $user,
                    ),
                    array(
                        'attributeIndexOrDerivedType' => 'name',
                        'structurePosition' => 4,
                        'lastName' => $user,
                    ),
                ),
                'dynamicStructure' => '1 OR 2 OR 3 OR 4',
            ),
            'pagination' => array(
                'page' => 1,
                'pageSize' => 4,
            ),
            'sort' => 'firstName.asc',
        );

// Get first page of results
        $response = ApiRestHelper::createApiCall(apiUrl . '/contacts/contact/api/list/filter/', 'POST', $this->headers, array('data' => $data));
        $response = $this->getResponseStatus($response);
        if ($response['totalCount'] > 0) {
            foreach ($response['items'] as $item) {
//                var_dump($item);
                return $item['id'];
                // Print contacts
            }
        } else {
            return FALSE;
        }
    }

    public function updateCrmContact($user) {
        
    }

    public function buildUserData($param) {
        $primaryEmail = array();
        $dataCrm = array();
        $primaryEmail['emailAddress'] = 'iiii@gmmmail.com';
        $primaryEmail['optOut'] = '0';
        $primaryAddress = array();
        $primaryAddress['street1'] = 'hertzog';
        $primaryAddress['city'] = 'city';
        $primaryAddress['country'] = 'israel';
# Everybody Can Read type = 0
# $dataCrm used to send the data to the API
        $dataCrm['firstName'] = 'semli1';
        $dataCrm['lastName'] = 'lieb';
        $dataCrm['mobilePhone'] = '05555555555';
        $dataCrm['primaryEmail'] = $primaryEmail;
        $dataCrm['primaryAddress'] = $primaryAddress;
//$dataCrm['owner']['id']        = 1;
# Everybody Can Read type = 0
        $readWriteModelPermissions['type'] = '1';
        $state['id'] = '6';
//$state['name'] = null;
//$state['order'] = null;
        $dataCrm['state'] = $state;

        $dataCrm['explicitReadWriteModelPermissions'] = array('nonEveryoneGroup' => '', 'type' => 1);

        return $dataCrm;
    }
    public function addNewCrmContact($user) {
        $userId = $this->searchCrmContactByEmail($user);
        if(empty($userId)){
            $userId =$this->creatNewCrmContact($user);
        }
        return $userId;
    }

}
