<?php
include_once('./_common.php');

if ($ch_holi == false) {
    header('Access-Control-Allow-Origin:'.(isset($headers['Origin']) == true ? $headers['Origin'] : '*'));
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Allow-Headers:Authorization');
    header('Access-Control-Allow-Methods:*');
    header("Content-type: text/json; charset=utf-8",true);
}

$table_name = G5_TABLE_PREFIX.'pr_hoilday';
$result = @sql_fetch("SHOW TABLES LIKE '{$table_name}'");
if (!$result) {
    $holi_sql = "
		CREATE TABLE IF NOT EXISTS `{$table_name}` (
            `h_id` int(11) NOT NULL auto_increment,
            `isholi` char(1) NOT NULL default '',
            `date` date NOT NULL default '0000-00-00',
            `name` varchar(100) NOT NULL default '' ,
            PRIMARY KEY  (`h_id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8
	";
	//echo $holi_sql;
	@sql_query($holi_sql);
}

if ($_GET['date']) {
    $today = $_GET['date'];
} else {
    $today = date("Y-m-d");
}

$todays = explode('-',$today);

$year = $todays[0]; //년도
$month = $todays[1];//달
$day = $todays[2];//일

$url = 'http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/getRestDeInfo'; /*URL*/
$ServiceKey = '본인의key';

$display = array();

if ($year && !$month) {
    //마지막 실행일을 저장
    $update = date("Y-m-d");
    $sql = " select * from {$table_name} where name = '업데이트' ";
    $row = sql_fetch($sql);
    if ($row['date']) {
        $sql = " update from {$table_name} set date = '{$update}' where name = '업데이트' ";
        sql_query($sql);
    } else {
        $sql = " insert into {$table_name} set date = '{$update}' , name = '업데이트' ";
        sql_query($sql);
    }
    if (!$row['date']) {
        $row['date'] = '0000-00-00';
    }
    if ($update != $row['date'] || $ch_holi == false) {
        //한해의 데이터를 반환한다.
        for ($i=1 ; $i < 13 ; $i++) {
            if (strlen($i) < 2) {
                $month = '0'.$i;
            } else {
                $month = $i;
            }
            $ch = curl_init();
            $queryParams = '?' . urlencode('ServiceKey') . "={$ServiceKey}"; /*Service Key*/
            $queryParams .= '&' . urlencode('solYear') . '=' . urlencode($year); /*연*/
            $queryParams .= '&' . urlencode('solMonth') . '=' . urlencode($month); /*월*/
            curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            $response = curl_exec($ch);
            curl_close($ch);
            $xml = simplexml_load_string($response);

            foreach ($xml->body->items->item as $item) {
                $key = substr($item->locdate,0,4).'-'.substr($item->locdate,4,2).'-'.substr($item->locdate,6,2);
                $val = $item->dateName.'';
                $isholi = $item->isHoliday.'';

                //디비에 저장
                $sql = " select count(*) as cnt from {$table_name} where date = '{$key}' ";
                $row = sql_fetch($sql);
                if ($row['cnt'] == 0) {
                    $sql = " insert into {$table_name} set
                        date = '{$key}'
                        , name = '{$val}'
                        , isholi = '{$isholi}'
                    ";
                    sql_query($sql);
                }

                $display[] = array(
                    'date' => $key
                    , 'name' => $val
                    , 'isholi' => $isholi
                );
            }
        } // end for
    }

} else if ($year && $month && !$day) {
    $isdate = "{$year}-{$month}";
    $sql = "select * from {$table_name} where date like '{$isdate}%'";
    $result = sql_query($sql);
    if ($result) {
        while ($row = sql_fetch_array($result)) {
            $display[] = array(
                'date' => $row['date']
                , 'name' => $row['name']
                , 'isholi' => $row['isholi']
            );
        }
    }
} else if ($year && $month && $day) {
    $isdate = "{$year}-{$month}-{$day}";
    $sql = "select * from {$table_name} where date = '{$isdate}'";
    $row = sql_fetch($sql);
    $display[] = array(
        'date' => $row['date']
        , 'name' => $row['name']
        , 'isholi' => $row['isholi']
    );
}

if ($ch_holi == false) {
    $return = json_encode($display,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    echo $return;
}
?>
