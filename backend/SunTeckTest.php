<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class SunTeckTest extends TestCase
{
    public function testLuhnCheckSumIsValid(): void
    {
        $numbers = '79927398713';
        $sumOdd = 0;
        $sumEven = 0;
        $input = array_map('intval', str_split($numbers));
        foreach($input as $index => $number ) {
            //if even
            if($index % 2) {
                $doubled = $number * 2;
                //if double digit
                if($doubled > 9) {
                    $split = array_map('intval', str_split((string)$doubled));
                    $sumEven += array_sum($split);
                } else {
                    $sumEven += $doubled;
                }
            } else {
                $sumOdd += $number;
            }
        }
        $this->assertEquals(($sumEven + $sumOdd) % 10, 0);
    }
}
