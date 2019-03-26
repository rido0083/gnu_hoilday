# gnu_hoilday

그누보드5.3용으로 개발된 국가특일 정보 api 입니다.

<br>
<br>
<a href="https://www.data.go.kr/dataset/15012690/openapi.do" target="_top">data.go.kr/dataset/15012690/openapi.do</a>

공공데이터에 가입하시고 위의 링크로 가신 후 해당 api를 신청하신후
api키를 받아서 사용하시면 됩니다.
<br>
해당 api키는 2년에 한번씩 재 신청이 필요 합니다.

<br>
신청하신 api키를 
api/holiday.php 파일의 40번째줄

$ServiceKey = '';

해당 변수에 기입해 주시면 됩니다.

<br>
해당 사용법은 이러합니다.

<br>
http://본인의홈페이지/api/holiday.php?date=
<br>
기본주소의 형태 입니다. 해당 date인자에 필요한 날짜를 입력합니다.
<br><br>
http://본인의홈페이지/api/holiday.php?date=2019
<br>
년도만 입력시에 해당년도의 특일정보를 json형태로 반환합니다. 이경우 해당 데이터베이스를 자동생성하고 디비에 해당 특일정보를 저장합니다.
<br>
해당 공공데이터의 api에서 2015년 데이터부터 제공하고 있으니 필요하신분은 2015부터 쭉 입력해 주시면 됩니다.
<br>
<br>
http://본인의홈페이지/api/holiday.php?date=2019-01
<br>
해당월의 특일을 json형태로 제공합니다. 이경우 위의 년도로 입력받은 데이터베이스에서 해당 정보를 반환합니다.
<br>
즉 해당년도의 데이터를 먼저 찍어주고 디비를 생성해 주셔야 합니다.
<br>
<br><br>
http://본인의홈페이지/api/holiday.php?date=2019-05-05
<br>
해당알의 특일을 json형태로 제공합니다. 이경우 위의 년도로 입력받은 데이터베이스에서 해당 정보를 반환합니다.

<br>
<br>
해당 년도의 url을 입력시에 기존 데이터에 없던 특일을 추가합니다.
현재 작성일(2019-03-26) 기준으로 2020년 데이터는 제공되고 있지 않는거 같습니다.

<br><br>
아래는 셈플url입니다. 
<br>
제작자의 사정에 의해 해당 셈플은 링크가 유효하지 않을 수 있습니다.

<br><br>
<a href="http://gnurido.iwinv.net/api/holiday.php?date=2019" target="_blank">gnurido.iwinv.net/api/holiday.php?date=2019</a>
<br>
<a href="http://gnurido.iwinv.net/api/holiday.php?date=2019-05" target="_blank">gnurido.iwinv.net/api/holiday.php?date=2019-05</a>
<br>
<a href="http://gnurido.iwinv.net/api/holiday.php?date=2019-05-05" target="_blank">gnurido.iwinv.net/api/holiday.php?date=2019-05-05</a>
<br><br><br>
제작자는 <a href="http://sir.kr" target="_blank">그누보드</a>에서 서식중입니다.
