<?php
// Replace with your own device id and device password
const DEVICE_ID = "49b8e79d-bc02-9295-fe09-a4112427490c";
const DEVICE_PASSWORD = "SamsonitePhp1";

class Transaction {

    public function refund() {

        $card = Array("ID" => 
                "1e700b9f-3e43-4cc0-9a02-884dd4c7e6ee"); // Card ID. Generated by PayFabric. 
                                                         
        $transaction = Array(
                "Amount" => "1.12",
                "Customer" => "1", // Customer ID
                "Currency" => "USD",
                "SetupId" => "Strongtrans", // Payment Gateway name
                "Tender" => "CreditCard",
                "Type" => "Credit",
                "Card" => $card);

        // Convert the data to JSON.
        $json = json_encode($transaction, TRUE);

        // Setup the HTTP request.
        $httpUrl = "https://sandbox.payfabric.com/v2/rest/api/transaction/process";
        $httpHeader = Array(
                "Content-Type: application/json",
                "authorization: " . DEVICE_ID . "|" . DEVICE_PASSWORD);        
        $curlOptions = Array(CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_VERBOSE => TRUE,
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_HTTPHEADER => $httpHeader);

        // Execute the HTTP request.
        $curlHandle = curl_init($httpUrl);
        curl_setopt_array($curlHandle, $curlOptions);
        $httpResponseBody = curl_exec($curlHandle);
        $httpResponseCode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);

        if ($httpResponseCode >= 300) {
            // Handle errors.
        }          

        // Convert the JSON into a multi-dimensional array.
        $responseArray = json_decode($httpResponseBody, TRUE);

        // Output the results of the request.
        var_dump($httpResponseBody);

        return $responseArray;        

    }

}

/* Example Response:
{
  "AVSAddressResponse": null,
  "AVSZipResponse": null,
  "AuthCode": null,
  "CVV2Response": null,
  "IAVSAddressResponse": null,
  "Message": "Failed merchant rule check",
  "OriginationID": "A10A6F8BDC6F",
  "RespTrxTag": null,
  "ResultCode": "117",
  "Status": "Denied",
  "TAXml": "<TransactionData><Connection name=\"Strongtrans\" connector=\"PayflowPro\"><Processor id=\"9\">FDMSNashville<\/Processor><PaymentType id=\"1\">Credit<\/PaymentType><Server><Address>https:\/\/pilot-payflowpro.paypal.com<\/Address><Port \/><ProxyAddress \/><ProxyPort \/><ProxyUserID \/><ProxyPassword \/><TimeOut \/><\/Server><Partner>PayPal<\/Partner><Vendor>strongtrans<\/Vendor><UserID>strongtrans<\/UserID><Password>$tr0ngtr@n$<\/Password><MerchantDescriptor \/><MerchantServiceNumber \/><CommodityCode \/><VATNumber \/><ConnectionXSLPath>C:\\Program Files (x86)\\Common Files\\Nodus\\Framework\\ConnectionManager\\Connectors\\PayflowPro<\/ConnectionXSLPath><\/Connection><Transaction post=\"False\" type=\"6\" status=\"2\"><NeededData><Transaction><Type>6<\/Type><Status>Denied<\/Status><Category>NeededData<\/Category><Fields \/><\/Transaction><\/NeededData><FailureData><Transaction><Type>6<\/Type><Status>Denied<\/Status><Category>FailureData<\/Category><Fields \/><\/Transaction><\/FailureData><ResponseData><Transaction><Type>6<\/Type><Status>Denied<\/Status><Category>ResponseData<\/Category><Fields><Field id=\"TrxField_D17\"><Name>ResultCode<\/Name><Desc>117<\/Desc><Value>117<\/Value><\/Field><Field id=\"TrxField_D31\"><Name>ResponseMsg<\/Name><Desc>Failed merchant rule check<\/Desc><Value>Failed merchant rule check<\/Value><\/Field><Field id=\"TrxField_D16\"><Name>OriginationID<\/Name><Desc>A10A6F8BDC6F<\/Desc><Value>A10A6F8BDC6F<\/Value><\/Field><\/Fields><\/Transaction><\/ResponseData><RequestData><Transaction><Type>6<\/Type><Status>2<\/Status><Category>RequestData<\/Category><Fields><Field id=\"TrxField_D1\"><Name>ACCT<\/Name><Desc>Credit Card Number<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>XXXXXXXXXXXX1111<\/Value><\/Field><Field id=\"TrxField_D3\"><Name>EXPDATE<\/Name><Desc>Expiration Date MMYY<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>1215<\/Value><\/Field><Field id=\"TrxField_D5\"><Name>BillToFirstName<\/Name><Desc>First Name<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>Herb<\/Value><\/Field><Field id=\"TrxField_D7\"><Name>BillToLastName<\/Name><Desc>Last Name<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>Caen<\/Value><\/Field><Field id=\"TrxField_D11\"><Name>BillToCity<\/Name><Desc>City<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>San Francisco<\/Value><\/Field><Field id=\"TrxField_D12\"><Name>BillToState<\/Name><Desc>State<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>CA<\/Value><\/Field><Field id=\"TrxField_D13\"><Name>BillToZip<\/Name><Desc>Zip<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>94109<\/Value><\/Field><Field id=\"TrxField_D15\"><Name>Amt<\/Name><Desc>Transaction Amount<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>1.12<\/Value><\/Field><Field id=\"TrxField_D47\"><Name>BillToCountry<\/Name><Desc>Country Code<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>USA<\/Value><\/Field><Field id=\"TrxField_D48\"><Name>CustCode<\/Name><Desc>Customer Code<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>1<\/Value><\/Field><Field id=\"TrxField_D55\"><Name>BillToStreet<\/Name><Desc>Account Holder Street<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>69 Ellis Street <\/Value><\/Field><Field id=\"TrxField_D74\"><Name>CurrencyCode<\/Name><Desc>Currency Code<\/Desc><Required>0<\/Required><Encrypted>0<\/Encrypted><Type>6<\/Type><Value>USD<\/Value><\/Field><Field id=\"TRXFIELD_D19\"><Name>PaymentType<\/Name><Value>1<\/Value><\/Field><Field id=\"TRXFIELD_D2\"><Name>TRXFIELD_D2<\/Name><Value>XXXXXXXXXXXX1111<\/Value><\/Field><Field id=\"TRXFIELD_D18\"><Name>CCType<\/Name><Value>Visa<\/Value><\/Field><Field id=\"TRXFIELD_D54\"><Name>AccountName<\/Name><Value>Herb Caen<\/Value><\/Field><Field id=\"TRXFIELD_D8\"><Name>Address1<\/Name><Value>69 Ellis Street<\/Value><\/Field><Field id=\"SaveCreditCard\"><Name>SaveCreditCard<\/Name><Value>0<\/Value><\/Field><Field id=\"MSO_PFTrxKey\"><Name>MSO_PFTrxKey<\/Name><Value>140824070508<\/Value><\/Field><Field id=\"MSO_WalletID\"><Name>MSO_WalletID<\/Name><Value>1e700b9f-3e43-4cc0-9a02-884dd4c7e6ee<\/Value><\/Field><Field id=\"MSO_Last_Xmit_Date\"><Name>MSO_Last_Xmit_Date<\/Name><Value>2014-08-24 00:00:00<\/Value><\/Field><Field id=\"MSO_Last_Xmit_Time\"><Name>MSO_Last_Xmit_Time<\/Name><Value>1900-01-01 7:31:57 PM<\/Value><\/Field><Field id=\"MSO_Last_Settled_Date\"><Name>MSO_Last_Settled_Date<\/Name><Value>1900-01-01<\/Value><\/Field><Field id=\"MSO_Last_Settled_Time\"><Name>MSO_Last_Settled_Time<\/Name><Value>1900-01-01 00:00:00<\/Value><\/Field><\/Fields><\/Transaction><\/RequestData><\/Transaction><\/TransactionData>",
  "TrxDate": "8\/24\/2014 7:31:57 PM",
  "TrxKey": "140824070508"
}
*/
