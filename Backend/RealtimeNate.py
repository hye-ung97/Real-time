import requests
import json
import schedule
from bs4 import BeautifulSoup
import datetime
import time
import pymysql

conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password", db="db",  charset='utf8')
cur = conn.cursor()

def jobNate():
    k = 0
    req = requests.post('https://www.nate.com/nate/LiveKeyword')
    content = req.content
    file = open('nate.txt', 'a+', encoding='utf-8')

    content = content[:content.rfind(b'\'')]
    content = content[content.find(b'\'')+1:]

    s = list(map(lambda x: x[1],json.loads(content.decode('euc-kr'))))

    timeNT = datetime.datetime.now()

    for i in range(0, 10, 1):
        word = s[i]
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
                        listD = soup2.select("#tvpColl>.coll_tit")  # tv검색
                        if (not listD):
                            listD = soup2.select("#movieEColl>.coll_tit")  # 영화
                            if (not listD):
                                listD = soup2.select("#rcpCookColl>.coll_tit")  # 음식
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
                                                        listD = soup2.select("#musicNColl>.coll_tit")  # 음악
                                                        if (not listD):
                                                            listD = soup2.select("#cityNColl>.coll_tit")  # 해외도시
                                                            if (not listD):
                                                                listD = soup2.select("#poiColl>.coll_tit")  # 지역
                                                                if (not listD):
                                                                    listD = soup2.select("#dirtColl>.coll_tit")  # 사이트
                                                                    if (not listD):
                                                                        cat = '기타'
                                                                        color = '#3F51B5'

        for j in listD:
            try:
                keyword = j.find("h2").text
            except AttributeError:
                try:
                    keyword = j.find("strong").text
                except AttributeError:
                    try:
                        keyword = j.find("b").text
                    except AttributeError:
                        k=1
                        break

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
                    # print("keyword:" + word + ' category:기타')
                    cat = '기타'
                    color = '#3F51B5'
            else:
                # print("keyword:" + word + ' category:기업')
                cat = '기업'
                color = '#FF9800'

        #file.write(str(i+1) + "\t" + s[i] +"\t" + str(timeNT)[:16] + "\t"+ str(cat) +"\n")
        if (k!=1):
            k = 0
            sql = 'insert into nate value ("' + str(i+1) + '","' + s[i] + '","' + str(timeNT)[:16] + '","' + cat + '","'+ color +'")'
            cur.execute(sql)
            conn.commit()


schedule.every(1).minutes.do(jobNate)


while True:
    schedule.run_pending()
    time.sleep(1)