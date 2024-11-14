<?php

header("Content-Type: text/xml");

$mockResponse = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<payment>
    <merchant-account-id>c3671cf9-6366-4e39-8d67-31ce24094655</merchant-account-id>
    <transaction-id>f96a2be7-88a5-4a2b-8d3e-34e0666e6c8c</transaction-id>
    <transaction-state>success</transaction-state>
    <completion-time-stamp>2024-10-10T10:47:31.000Z</completion-time-stamp>
    <statuses>
        <status code="201.0000" description="The resource was successfully created." severity="information"/>
    </statuses>
    <card>
        <expiration-month>12</expiration-month>
        <expiration-year>2026</expiration-year>
        <card-type>visa</card-type>
    </card>
    <card-token>
        <token-id>4920619521161111</token-id>
        <masked-account-number>444433******1111</masked-account-number>
    </card-token>
</payment>
XML;

echo $mockResponse;
