# Real-time-page-soop
진행 기간 : 2019년 03월 ~ 2019년 6월   
인원 : 3명 

## 1️⃣ Project Object
정보화 시대에 많은 데이터들이 존재하고 있다. 너무 많은 데이터로 혼란이 생기기도하고 필요한 데이터들을 놓치기도 한다. 이러한 데이터들을 효율적으로 사용하기 위해 최근 빅데이터를 활용하여 분석 및 예측을 통해 마케팅에 활용하는 서비스가 많아지고 있다.
빅데이터 분석 서비스(SOOB-Something special Out Of Bigdata)는 1차원적인 정보를 넘어 더 다 양하고 정확한 정보를 얻을 수 있도록 웹페이지를 만들고자 한다. 또한 핵심적인 정보를 제공함으로 써 편리하고 신속하게 정보를 제공하려고 한다. 기존 실시간 검색어는 단순 키워드 제공 형식으로 보 여주고 있지만 SOOB은 키워드의 카테고리 분류를 통해 키워드의 정보를 한눈에 알 수 있도록 제공 할 예정이다. 또한 food 카테고리 데이터에 대한 분석을 하여 새로운 가공된 정보를 추출하는 것이 웹페이지의 목적이다.

## 2️⃣ Architecture
![루비들](https://github.com/hye-ung97/Real-time-page-soop/assets/117243197/efdec451-2138-490e-9173-823cb81fecd6)

## 3️⃣ Technology stack
![Python](https://img.shields.io/badge/python-3670A0?style=for-the-badge&logo=python&logoColor=ffdd54)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)
![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

![PyCharm](https://img.shields.io/badge/pycharm-143?style=for-the-badge&logo=pycharm&logoColor=black&color=black&labelColor=green)
![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)

![AWS](https://img.shields.io/badge/AWS-%23FF9900.svg?style=for-the-badge&logo=amazon-aws&logoColor=white)

## 4️⃣ 주요기능
1. Crawling(크롤링) : python의 BeautifulSoup 라이브러리와 naver api를 활용
2. 데이터 분석 (자연어 처리 및 감정 분석) : 한글 텍스트(blog 내용)의 형태소를 분석하여 명사, 형 용사, 동사 추출 및 형태소의 긍부정 분석
3. 웹페이지 제작
   - 실시간 검색어 : 3대 포탈사이트의 실시간 검색어와 연관검색어를 모아 실시간으로 보여주고 카 테고리 분류하여 시각화
   - 음식 카테고리 : 실시간 검색어에 대한 sns의 기간별 변화 추이, 관련 상위 해쉬태그와 긍부정 반응을 보여주고 진정한 맛집 정보 제공
   - 키워드 알림 서비스 : 개인 사용자별 관심 키워드를 입력받아 실시간 검색어에 해당 키워드가 오를 시 알림 서비스 제공

## 5️⃣ 시연영상
![SOOB](https://github.com/hye-ung97/Real-time-page-soob/blob/11d57c271f438b4f9f8ebfdf6c89c77f09636d7a/img/%EB%A3%A8%EB%B9%84%EC%8A%A4%20%EC%8B%9C%EC%97%B0%20%EC%98%81%EC%83%81.gif)


