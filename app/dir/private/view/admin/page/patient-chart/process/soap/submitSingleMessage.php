<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:cdc:iisb:2011">
    <soap:Header />
    <soap:Body>
        <urn:submitSingleMessage>
            <!--Optional:-->
            <urn:username>DE-000001</urn:username>
            <!--Optional:-->
            <urn:password>FcqIaAnn</urn:password>
            <!--Optional:-->
            <urn:facilityID></urn:facilityID>
            <urn:hl7Message>
                <![CDATA[
MSH|^~\&|EPIC|DE-000001|VACC|CAIRLO|20230117140601|45707|VXU^V04^VXU_V04|21859394|P|2.5.1||||AL||||||DE-000002|
PID|1||NEWMRN123^^^130^MR||Parentheses^Shot||20201010|M||PHC1175|555 N Wonder Ln^^LOS ANGELES^CA^90057^US^^^037|LOS ANGELE|^NET^Internet^email@email.com~^PRN^CP^^^559^5558774||eng|SINGLE|||||linares^vilma^^|PHC1175|||||No previous|||N||
PD1||||||||||||N|20230117|||A||
ORC|RE|477423238^EPC|173876716||||||20230117140506|45707^RAMIREZ^WYNNIE^RN^||1942358916^LIAO^EDWARD^^^^^^NPI^^^^NPI^^^^^^^^MD|130003001^^^130003^^^^^QHC HOLLYWOOD PRIMARY CARE|(323)953-7170^^^^^323^9537170||||J30486^HW-FPX-1776^^130003001^QHC HOLLYWOOD PRIMARY CARE|||||||||||O|Per prot ncs
RXA|0|1|20240820||155^^CVX^^^|0.3|mL||00^^NIP001|45707^AGAIN^NEW^^^^^^CAA^^^^NPI^^^^^^^^PA|^^^DE-000002^^^^^QHC HOLLYWOOD PRIMARY CARE||||GK1337|20250101|PMC||||A|
RXR|IM|RD^Right deltoid^HL70163||||||||||||||||||
OBX|1|CE|64994-7^VACCINE FUND PGM ELIG CAT^LN|1|V02||||||F|||20230117|||VXC40^per immunization^CDCPHINVS|||||||||||||||
OBX|2|CE|30963-3^VACCINE FUNDING SOURCE^LN|1|VXC51^^CDCPHINVS||||||F
]]>
            </urn:hl7Message>
            server
        </urn:submitSingleMessage>
    </soap:Body>
</soap:Envelope>