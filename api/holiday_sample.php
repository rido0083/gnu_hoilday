<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script>
var formData = '';
$.ajax({
    url:'http://userdomain/api/holiday.php?date=2019-05-05',
    data: formData,
    dataType:'json',
    processData:false,
    contetnType:false,
    type:'POST',
    success:function(result){
        //console.log(result);
        console.log(result[0].isholi);
    }
});
</script>


<?php
$url = "http:/userdomain/api/holiday.php?date=2019-05-05";
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$str = curl_exec($curl);
curl_close($curl);
var_dump($str);
?>
