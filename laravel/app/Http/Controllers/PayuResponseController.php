<?php

namespace testmiguel\Http\Controllers;

use Illuminate\Http\Request;

class PayuResponseController extends Controller
{
    public function paymentResponse(Request $request)
    {
        //merchantId=508029&merchant_name=Test+PayU+Test&merchant_address=Av+123+Calle+12&telephone=7512354&merchant_url=http%3A%2F%2Fpruebaslapv.xtrweb.com&transactionState=4&lapTransactionState=APPROVED&message=APPROVED&referenceCode=BrunoHans17&reference_pol=840045541&transactionId=b211e0de-ecec-4bc5-a3a1-9a29167a1823&description=Test+PAYU&trazabilityCode=00000000&cus=00000000&orderLanguage=es&extra1=&extra2=&extra3=&polTransactionState=4&signature=fb7a7a68725008f8965e59f776485782&polResponseCode=1&lapResponseCode=APPROVED&risk=.00&polPaymentMethod=10&lapPaymentMethod=VISA&polPaymentMethodType=2&lapPaymentMethodType=CREDIT_CARD&installmentsNumber=1&TX_VALUE=49900.00&TX_TAX=.00&currency=COP&lng=es&pseCycle=&buyerEmail=miguelflores2505%40gmail.com&pseBank=&pseReference1=&pseReference2=&pseReference3=&authorizationCode=00000000&processingDate=2016-11-17
        $transactionState = $request->input('transactionState');
        $messageState = '';
        if($transactionState == 4){
            $messageState = 'fue Aprobada, estamos procesando tu orden!';
        }
        else if($transactionState == 7){
            $messageState = 'esta pendiente de aprobacion por PayU!';
        }
        else {
            $messageState = 'fue Rechazada! ';
        }

        return view('not-logged/checkout/paymentResponse',['messageState' => $messageState, 'transactionState' => $transactionState ]);
    }
}
