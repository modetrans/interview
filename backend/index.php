<?php
    $submitted = $_POST['submitted'] ?? null;
    $numbers = $_POST['numbers'] ?? null;
    if(!validSubmission($numbers) && $submitted) {
        $_POST['error'] = 'Invalid Submission';
    }
    if($submitted && validSubmission($numbers)) {
        $result = check($numbers);
        responsed($result, $numbers);
    }

    function validSubmission($numbers) {
        return is_numeric($numbers);
    }
    function responsed($result, $numbers) {
        if(!$result) {
            $_POST['success'] = "{$numbers} is valid";
        } else {
            $_POST['error'] = "{$numbers} is not valid";
        }
    }

    function check($numbers) {
        $sumOdd = 0;
        $sumEven = 0;
        $input = array_map('intval', str_split($numbers));
        foreach($input as $index => $number ) {
            //if even
            if($index % 2) {
                $doubled = $number * 2;
                //if double digit
                if($doubled > 9) {
                    $split = array_map('intval', str_split( (string) $doubled));
                    $sumEven += array_sum($split);
                } else {
                    $sumEven += $doubled;
                }
            } else {
                $sumOdd += $number;
            }
        }
        return ($sumEven + $sumEven) % 10;
    }
?>

<form action="" method="post">
    <label for="">Enter Number:</label>
    <input type="text" name="numbers">
    <input type="hidden" name="submitted" value="1">
    <button type="submit">Check</button>
    <br>
    <?php echo $_POST['success'] ?? null ?>
    <?php if($error = $_POST['error'] ?? null): ?>
        <div><?php echo $error?></div>
    <?php endif; ?>
</form>