<?php

function clear($input, $encoding = 'UTF-8')
{
    return htmlspecialchars(
        strip_tags($input),
        ENT_QUOTES | ENT_HTML5,
        $encoding
    );
}

function checkEmpty($stringToCheck) {

    return (!(empty(trim($stringToCheck))));
}

function checkValid($arrayToCheck) {

    if ($arrayToCheck["valid"]) {
        return true;}
        else {return false;}
    }


function search_array_compact($data,$key){
    $compact = [];
    foreach($data as $row){
        if(!in_array($row[$key],$compact)){
            $compact[] = $row;
        }
    }
    return $compact;
}

function seperateData ($textareaString)
{

    $resultArr = [];



    // splitting the lines of the textarea by the linebreak

    $totalDataArr = explode("\n", $textareaString);

    $totalDataArrFiltered = array_values(array_filter($totalDataArr, "checkEmpty"));



    // Splitting the splitte the single lines into an Array of data
    // and removing items with empty strings
    // and giving new indexes

    $totalDataAsSingleArr = [];

    for ($i=0; $i<count($totalDataArrFiltered); $i++) {
        $totalDataAsSingleArr[] = array_values(array_filter(explode(" ", trim($totalDataArrFiltered[$i])), "checkEmpty"));
    }


    // checking salutation

    for ($i= 0; $i<count($totalDataAsSingleArr); $i++) {
        $compareStr = strtolower($totalDataAsSingleArr[$i][0]);
        if ($compareStr === "mr" || $compareStr === "mr." || $compareStr === "mister") {
            $resultArr[$i] = [
                "salutation" =>  "Mr",
                "valid" =>  true,
                ];
                array_shift($totalDataAsSingleArr[$i]);
        } elseif ($compareStr === "mrs" || $compareStr === "mrs." || $compareStr === "mistress") {
            $resultArr[$i] = [
                "salutation" => "Mrs",
                "valid" => true,
                ];
                array_shift($totalDataAsSingleArr[$i]);

        } else if ($compareStr === "ms." || $compareStr === "ms" || $compareStr === "miss") {
            $resultArr[$i] = [
                "salutation" => 'Ms',
                "valid" => true,
                ];
                array_shift($totalDataAsSingleArr[$i]);

        } else {
            $resultArr[$i] = [
                "salutation" => '',
                "valid" => true,
                ];
            }
    }



    // checking email

    for ($i = 0; $i < count($totalDataAsSingleArr); $i++) {
        if (count($totalDataAsSingleArr[$i]) > 0) {
            $compareStr = strtolower($totalDataAsSingleArr[$i][count($totalDataAsSingleArr[$i])-1]);

            $splittedEmail = explode("@", $compareStr);

            if (count($splittedEmail) === 2 && count(explode(".", $splittedEmail[1])) >= 2) {
                $resultArr[$i]["email"] = strtolower($compareStr);
                    array_pop($totalDataAsSingleArr[$i]);
            } elseif ((strpos($compareStr, "@") && count($splittedEmail) !==2) || (strpos($compareStr, "@") && count(explode(".", $splittedEmail[1])) < 2)) {
                $resultArr[$i]["email"] = "incorrect email";
                    array_pop($totalDataAsSingleArr[$i]);
            } else {
                $resultArr[$i]["email"] = "";
            }
        }
    }



    // checking firstName


    for ($i=0; $i < count($totalDataAsSingleArr); $i++) {

        if (count($totalDataAsSingleArr[$i])>0) {


        if(ctype_alpha($totalDataAsSingleArr[$i][0])) {

            $resultArr[$i]["firstName"] = $totalDataAsSingleArr[$i][0] ;
            array_shift($totalDataAsSingleArr[$i]);
        } else {
            $resultArr[$i]["firstName"] = "invalid first name";
            $resultArr[$i]["valid"] = false;
            array_shift($totalDataAsSingleArr[$i]);
            }
        } else {
            $resultArr[$i]["valid"] = false;
        }
    }



    // checking lastName

    for ($i=0; $i < count($totalDataAsSingleArr); $i++) {

        if (count($totalDataAsSingleArr[$i])>0) {

        if (!preg_match('/[^A-Za-z]+\'/', $totalDataAsSingleArr[$i][0])) {

            $resultArr[$i]["lastName"] = $totalDataAsSingleArr[$i][0];
            array_shift($totalDataAsSingleArr[$i]);

        } else {
            $resultArr[$i]["lastName"] = "invalid last name";
            $resultArr[$i]["valid"] = false;
            array_shift($totalDataAsSingleArr[$i]);
        }
    } else {
        $resultArr[$i]["valid"] = false;
    }
    $resultArr[$i]["compareName"] = strtolower($resultArr[$i]["firstName"].$resultArr[$i]["lastName"]);
    }



    // checking telephone

    for ($i=0; $i < count($totalDataAsSingleArr); $i++) {

        if (count($totalDataAsSingleArr[$i])>0) {
            
            $telephoneNumber = implode(" ", $totalDataAsSingleArr[$i]);

        if (!preg_match('/[^0-9]+()\+\-/', $telephoneNumber)) {
            $resultArr[$i]["telephone"] = $telephoneNumber;
        } else {
            $resultArr[$i]["telephone"] = "incorrect number";
            }
        } else {
            $resultArr[$i]["telephone"] = "";
        }
    }



    // filtering invalid data

    $resultArr = array_values(array_filter($resultArr, "checkValid" ));



    // filtering duplicates

    $compareNameArr = array_column($resultArr, 'compareName');
    $compareNameArrKeys = array_keys(array_unique($compareNameArr));
    $uniqueArray = [];

    for ($i=0; $i<count($compareNameArrKeys); $i++) {
        $uniqueArray[$i] = $resultArr[$compareNameArrKeys[$i]];
    }


    // echo "line 120  ".var_dump($totalDataAsSingleArr).'<br><br>';
    // echo "line 121  ".var_dump($resultArr).'<br><br>';
    // echo var_dump($resultArr).'<br><br>';

    // echo var_dump($compareNameArr).'<br><br>';
    // echo var_dump($compareNameArrKeys).'<br><br>';
    // echo var_dump($uniqueArray).'<br><br>';
    return $uniqueArray;
}

