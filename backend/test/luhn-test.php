<?php

/**
 * Automated test for the LuhnValidator and the main.php command.
 */

require(__DIR__ . '/../src/LuhnValidator.php');

$testValues = [
    '0' => false,
    '1' => false,
    'test' => false,
    '26test' => false,
    '' => false,
    '26' => true,
    '2.6' => false,
    '182' => true,
    '2899' => true,
    '79927398713' => true,
    '79927398703' => false,
    '8071279919366069' => true,
    '8071279919366060' => false,
    ' 5570080582146024 ' => true
];

// Test the LuhnValidator class itself
$results = [];
$failure = false;
foreach($testValues as $value => $expected) {
    $luhn = new LuhnValidator($value);

    $result = $luhn->isValid() === $expected;

    if(!$result) {
        $resultStr = 'FAIL';
        $failure = true;
    } else {
        $resultStr = 'Pass';
    }

    // Output test results
    echo "Test \"$value\": $resultStr\n";
}

if($failure)
    echo "LuhnValidator: One or more tests failed.\n\n";
else
    echo "LuhnValidator: All tests have passed.\n\n";

// Test the main.php script
$results = [];
$output = [];
$returnCode = 0;
$failure = false;
foreach($testValues as $value => $expected) {
    $mainPath = __DIR__ . '/../src/main.php';
    exec("php $mainPath $value", $output, $returnCode);

    // Return code should be the opposite integer of the expected boolean value
    // e.g. 0 is true (valid), 1 is false (invalid)
    $result = $returnCode == !$expected;

    if(!$result) {
        $resultStr = 'FAIL';
        $failure = true;
    } else {
        $resultStr = 'Pass';
    }

    echo "Shell Test \"$value\": $resultStr\n";
}

if($failure)
    echo "main.php: One or more tests failed.\n";
else
    echo "main.php: All tests have passed.\n\n";