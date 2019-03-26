# gnu_hoilday

그누보드5.3용으로 개발된 국가특일 정보 api 입니다.


https://www.data.go.kr/dataset/15012690/openapi.do
공공데이터에 가입하시고 위의 링크로 가신 후 해당 api를 신청하신후
api키를 받아서 사용하시면 됩니다.

해당 api키는 2년에 한번씩 재 신청이 필요 합니다.

신청하신 api키를 
api/holiday.php 파일의 40번째줄
$ServiceKey = '';
해당 변수에 기입해 주시면 됩니다.

해당 사용법은 이러합니다.
