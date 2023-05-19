import requests
import schedule
from bs4 import BeautifulSoup
import datetime
import time
import pymysql

conn = pymysql.connect(host="capruby07.cafe24.com", port=3306, user="capruby07", passwd="fnql0707!", db="capruby07", charset='utf8')
cur = conn.cursor()


def jobNaver():
    reqN = requests.get("https://www.naver.com")
    reqN_text = reqN.text
    soup = BeautifulSoup(reqN_text, "lxml")

    listN = soup.select(".PM_CL_realtimeKeyword_rolling > ul >li")
    file = open('naver.txt', 'a+', encoding='utf-8')

    timeN = datetime.datetime.now()

    for i in listN:
        rank = i.find("span", {"class": "ah_r"}).text
        word = i.find("span", {"class": "ah_k"}).text

        reqD = requests.get("https://search.daum.net/search?w=tot&q=" + word.replace(" ", "+"))
        reqD_text = reqD.text
        soup2 = BeautifulSoup(reqD_text, "lxml")

        a = 1
        listD = soup2.select(".coll_cont>div>div>strong>a")  # 기업
        if (not listD):
            a = 0
            listD = soup2.select("#profColl>.coll_tit")  # 인물
            if (not listD):
                listD = soup2.select("#healthColl>.coll_tit")  # 건강정보
                if (not listD):
                    listD = soup2.select("#EXMsmokColl>.coll_tit")  # 자격증
                    if (not listD):
                        listD = soup2.select("#movieEColl>.coll_tit")  # 영화
                        if (not listD):
                            listD = soup2.select("#tvpColl>.coll_tit")  # tv검색
                            if (not listD):
                                listD = soup2.select("#rcpCookColl>.coll_tit")  # 음식
                                if (not listD):
                                    listD = soup2.select("#musicNColl>.coll_tit")  # 음악
                                    if (not listD):
                                        listD = soup2.select("#pediaColl>.coll_tit")  # 백과사전
                                        if (not listD):
                                            listD = soup2.select("#ndictionaryColl>.coll_tit")  # 어학사전
                                            if (not listD):
                                                listD = soup2.select("#speFZZ>.coll_tit")  # 기념일
                                                if (not listD):
                                                    listD = soup2.select("#addressColl>.coll_tit")  # 도시
                                                    if (not listD):
                                                        listD = soup2.select("#nationalNColl>.coll_tit")  # 국가
                                                        if (not listD):
                                                            listD = soup2.select("#cityNColl>.coll_tit")  # 해외도시
                                                            if (not listD):
                                                                listD = soup2.select("#poiColl>.coll_tit")  # 지역
                                                                if (not listD):
                                                                    listD = soup2.select("#dirtColl>.coll_tit")  # 사이트
                                                                    if (not listD):
                                                                        cat = '기타'
                                                                        color = '#3F51B5'

        for i in listD:
            try:
                keyword = i.find("h2").text
            except AttributeError:
                try:
                    keyword = i.find("strong").text
                except AttributeError:
                    keyword = i.find("b").text

            if (a is not 1):
                if (str(keyword) == "인물"):  # 하나
                    # print("keyword:" + word + ' category:인물')
                    cat = '인물'
                    color = '#9C27B0'
                elif (str(keyword) == ("장소") or str(keyword) == ("주소") or str(keyword) == ("국가") or str(keyword) == (
                        "해외도시") or str(keyword) == ("지역")):  # 둘
                    # print("keyword:" + word + ' category:장소')
                    cat = '장소'
                    color = '#ff00eb'
                elif (str(keyword) == "TV검색"):
                    # print("keyword:" + word + ' category:TV 프로그램')
                    cat = 'TV 프로그램'
                    color = '#000000c7'
                elif (str(keyword) == "레시피"):
                    # print("keyword:" + word + ' category:음식')
                    cat = '음식'
                    color = '#03A9F4'
                elif (str(keyword) == " 다음 영화  "):
                    # print("keyword:" + word + ' category:영화')
                    cat = '영화'
                    color = '#8BC34A'
                elif (str(keyword) == "바로가기"):
                    # print("keyword:" + word + ' category:단체')
                    cat = '단체'
                    color = '#FFEB3B'
                elif (str(keyword) == "멜론뮤직"):
                    # cat = '음악'
                    # color = '#992b23'
                    if __name__ == "__main__":
                        RANK = 100

                        header = {'User-Agent': 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko'}
                        req3 = requests.get('https://www.melon.com/search/total/index.htm?q=' + word.replace(" ", "+"),
                                            headers=header)
                        html3 = req3.text
                        parse3 = BeautifulSoup(html3, 'html.parser')
                        try:
                            search3 = parse3.find_all("div", {"class": "tb_list d_song_list songTypeOne"})

                            searcht = []  # 제목
                            searchs = []  # 가수
                            if not searcht:
                                cat='기타'
                                color = '#3F51B5'
                            else:
                                for p in search3:
                                    searcht.append(p.find('a', {"class": "fc_gray"}).text)
                                    searchs.append(p.find('a', {"class": "fc_mgray"}).text)
                                cat='음악'
                                color = '#992b23'
                        except:
                            print(str(keyword))
                            cat='기타'
                            color = '#3F51B5'
                    else:
                        print(str(keyword))
                        cat='기타'
                        color='#3F51B5'
                elif (str(keyword) == "건강정보"):
                    # print("keyword:" + word + ' category:건강정보')
                    cat = '건강정보'
                    color = '#f80303'
                else:
                    cat = '기타'
                    color = '#3F51B5'
                    #print(color)
            else:
                # print("keyword:" + word + ' category:기업')
                cat = '기업'
                color = '#FF9800'

        #file.write(rank + "\t" + word +"\t"+ str(timeN)[:16] + "\t" + cat +"\n")
        sql = 'insert into naver value (' + rank + ',"' + word + '","' + str(timeN)[:16] + '","' + cat + '","'+color+'")'
        cur.execute(sql)
        conn.commit()


schedule.every(10).minutes.do(jobNaver)

while True:
    schedule.run_pending()
    time.sleep(1)