<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    $strErr = $idxErr = "";
    $result = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["string"])) {
            $strErr = "String is required";
        } else if (empty($_POST["index"])) {
            $idxErr = "Index is required";
        } else {
            $resArr = find_end_par($_POST["string"], intval($_POST["index"]));
            $result = $resArr[0];
            $strErr = $resArr[1][0];
            $idxErr = $resArr[1][1];
        }
    }

    function find_end_par($str, $idx)
    {
        $strArr = str_split($str);
        $curChar = $strArr[$idx];

        if ($curChar === "(") {
            $openPar = 1;

            for ($i = ($idx + 1); $i < count($strArr); $i++) {
                if ($strArr[$i] === "(") { 
                    $openPar++;
                } else if ($strArr[$i] === ")") {
                    $openPar--;
                }

                if ($openPar === 0) {
                    return [$i, ["", ""]];
                }
            }

            if ($openPar > 0) {
                return [0, ["Invalid string", ""]];
            }
        } else {
            return [0, ["", "Char at index is not an opening parenthesis"]];
        }
    }
    ?>

    <h2>Find Closing Parenthesis</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        String: <input type="text" name="string">
        <span class="error">* <?php echo $strErr; ?></span>
        <br><br>
        Index: <input type="number" name="index">
        <span class="error">* <?php echo $idxErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if ($result > 0) echo ($result);
    ?>

</body>

</html>