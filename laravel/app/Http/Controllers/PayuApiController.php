<?php

namespace testmiguel\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use testmiguel\OrderPayUReference;
use testmiguel\OrderState;

class PayuApiController extends Controller
{

    public $apiLogin = 'pRRXKOl8ikMmt9u';
    public $apiKey = '4Vj8eK4rloUd272L48hsrarnUA';

    public $testBaseUrl = "https://sandbox.api.payulatam.com";
    public $payBaseUrl = "https://api.payulatam.com";

    public $apiEndPoint = "/reports-api/4.0/service.cgi";

    public $currentUrl = "https://sandbox.api.payulatam.com";

    public function checkOrderByReference($orderReference)
    {
        //TODO check last payu try to update to validate if there is enought time to request this create a function to check this
        $orderReferenceList = OrderPayUReference::where('state', OrderState::PAYU_ORDER_NO_STATE)->orWhere('state', OrderState::PAYU_ORDER_PENDING)->get();
        foreach ($orderReferenceList as $order) {
            echo $order->id;
            //TODO pass StoreOrder
            $this->checkPayUOrderByReference($order);
            return;
        }

        //$this->testGuzzleClient();
        //$this->checkPayUOrderByReference('BrunoHans11');
    }

    public function checkPayUOrderByReference($orderReference)
    {
        $jsonBody = $this->createJsonBody($orderReference->order_reference);

        $client = new Client([
            'base_uri' => $this->currentUrl,
            'verify' => false,
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/xml'
            ],
            'body' => $jsonBody,
            'connect_timeout' => 90
        ]);

        $res = $client->request('POST', $this->apiEndPoint);

        if ($res->getStatusCode() != 200) {
            echo 'not successful request';
            return;
        }

        $simpleXml = new \SimpleXMLElement($res->getBody()->getContents());
        echo $simpleXml->code;

        if ($simpleXml->code != 'SUCCESS') {
            //echo 'not successful request';
            return;
        }

        if ($simpleXml->result->payload->order->id == '') {
            //echo 'this reference doesnt exist';
            $orderReference->state = OrderState::PAYU_ORDER_NO_EXIST;
            $orderReference->save();
            //TODO update order to cancelled and OrderResultPayU to doesnt exist
            return;
        }

        //TODO check if OrderResultPayU exists if no then create it


        $status = $simpleXml->result->payload->order->status;
        if ($status == 'CANCELLED' || $status == 'REJECTED') {
            $orderReference->state = OrderState::PAYU_ORDER_DECLINED;
            $orderReference->save();
            echo 'this order was canceled need update on db';
            //TODO update order to cancelled
        } else if ($status == 'APPROVED' || $status == 'CAPTURED') {
            $orderReference->state = OrderState::PAYU_ORDER_APPROVED;
            $orderReference->save();
            //TODO update order to approved
        }


        echo $simpleXml->result->payload->order->accountId;
        echo $simpleXml->result->payload->order->status;

    }

    private function createJsonBody($reference)
    {
        $jsonObject = new \stdClass();
        $jsonObject->test = false;
        $jsonObject->language = 'en';
        $jsonObject->command = 'ORDER_DETAIL_BY_REFERENCE_CODE';
        $jsonObject->merchant = array(
            'apiLogin' => $this->apiLogin,
            'apiKey' => $this->apiKey
        );
        $jsonObject->details = array(
            'referenceCode' => $reference
        );

        return json_encode($jsonObject);
    }

    private function testGuzzleClient()
    {
        $client = new Client([
            'base_uri' => 'https://api.github.com', 'verify' => false]);

        $res = $client->request('GET', '/users/MiguelArturoFlores');
        // this also works $res = $client->get('/users/MiguelArturoFlores');

        echo $res->getStatusCode();

        echo $res->getBody();
    }
}
