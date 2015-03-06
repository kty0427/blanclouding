<!doctype HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>더페이스샵 블랑클라우딩 링크</title>
    <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
  </head>
  <body>
    <h3>카카오톡 링크는 카카오톡 앱이 설치되어 있는 모바일 기기에서만 전송 가능합니다.</h3>
    <a id="kakao-link-btn" href="javascript:;">더페이스샵 블랑클라우딩 확인하러가기</a>

    <script>
    // 사용할 앱의 Javascript 키를 설정해 주세요.
    Kakao.init('62027fc7fd5be42191c4c2e4787386ca');

    // 카카오톡 링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    Kakao.Link.createTalkLinkButton({
      container: '#kakao-link-btn',
      label: 'TheFaceShop의 BlanClouding 보러가기',
      image: {
        src: 'http://dn.api1.kage.kakao.co.kr/14/dn/btqaWmFftyx/tBbQPH764Maw2R6IBhXd6K/o.jpg',
        width: '300',
        height: '200'
      },
      webButton: {
        text: '카카오 디벨로퍼스',
        url: 'thefaceshopclouding.co.kr' // 앱 설정의 웹 플랫폼에 등록한 도메인의 URL이어야 합니다.
      }
    });
    </script>
  </body>
</html>
