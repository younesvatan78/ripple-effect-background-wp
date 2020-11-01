<?php
$ch = curl_init();

$data = array(
    "username" => "7731586646",
    "password" => "45127588"
);
$url2 = "pj24.ir/user/login.php";

curl_setopt($ch, CURLOPT_URL,"pj24.ir/user/login.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');

curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
curl_setopt($ch, CURLOPT_TIMEOUT,10);
//curl_setopt($ch, CURLOPT_REFERER, $url2);
curl_setopt($ch, CURLOPT_ENCODING, '');

 


$output = curl_exec($ch);
//echo $output;



$now = new DateTime();

$formatter = new IntlDateFormatter(
                "fa_IR@calender=persian",
                IntlDateFormatter::SHORT,
                IntlDateFormatter::SHORT,
                'Asia/Tehran',
                IntlDateFormatter::TRADITIONAL,
                "MM - dd "
);




$url = "pj24.ir/user/index.php";
curl_setopt($ch, CURLOPT_URL,$url); 
curl_setopt($ch, CURLOPT_POST, 0);


//if($output == '{"ok":true}'){
    //echo 'sucess';
    //curl_setopt($ch, CURLOPT_URL,"pj24.ir/user/index.php");
    $new = curl_exec($ch);
    
    $find_thingsout = explode('<label class="btn btn-circle default green-stripe lable-cursor dashboard-chart-font">',$new);
    echo $find_thingsout[1];
    //echo $find_thingsout[2];
    //echo "Today's date: " . $formatter->format($now);
    //echo "<br>";
    //}
    curl_close($ch);
    
    function convert_to_int( $persiannum ){
        $persian_list_num = array(
            '۱' => 1,
            '۲' => 2,
            '۳' => 3,
            '۴' => 4,
            '۵' => 5,
            '۶' => 6,
            '۷' => 7,
            '۸' => 8,
            '۹' => 9,
            '۰' => 0,
            '-' => '',
            ' ' => ''
        );
        $result = strtr($persiannum,$persian_list_num);
        return $result;
    }


    /** Get Today date and convert it to int  */
    $tdate = $formatter->format($now);
    //echo $tdate[6];
    $final_tdate = convert_to_int($tdate);
    $icount = strlen($final_tdate);
    //echo $icount;
    //echo $final_tdate;
    $tdate_mounth = intval(substr($final_tdate, 0,2));
    $tdate_day = intval(substr($final_tdate,2,5));
    // $tdate_mounth = 7;
    // $tdate_day = 25;

   
   
$imploded = strval($find_thingsout[2]);
echo "<br>";
$pj24_date_to_en =  convert_to_int($imploded);
$remained_date_len = strlen($pj24_date_to_en);
/** To find the position number of each charecter */
//for( $i = 0 ; $i <= $remained_date_len -1; $i++ ){
//        echo '<br>';
//        echo 'position is ' . $i;
//        echo ' - ' . $pj24_date_to_en[$i];
//    }
    $expire_mounth = intval(substr($pj24_date_to_en,167,2));
    $start_day = intval(substr($pj24_date_to_en,29,2));
    $expire_day = intval(substr($pj24_date_to_en,169,2));
    
    
    
if($tdate_mounth == $expire_mounth){
    echo "Remained day is ", $expire_day - $tdate_day ;
}
if($tdate_mounth < $expire_mounth){
    $static_int = $start_day;
    $int1 = $tdate_day - $start_day;
    if($tdate_mounth<= 6){
        $remained_day = 31 - $int1;
        echo "Remained day is ", $remained_day;
    }
    $remained_day = 30 - $int1;
    echo "Remained day is ",$remained_day;
}    
