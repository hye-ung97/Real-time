import pymysql
import time
import datetime
import requests
import schedule
from bs4 import BeautifulSoup

def relation():
    timeM = datetime.datetime.now()
    conn = pymysql.connect(host="capruby07.cafe24.com", port=3306, user="capruby07", passwd="fnql0707!", db="capruby07", charset='utf8')
    cur = conn.cursor()

    sql2 = 'select name from map'
    cur.execute("set charset utf8")
    cur.execute(sql2)
    rows = cur.fetchall()


    for i in rows:
        key = str(i)
        print(key)
        time = datetime.datetime.now()
        reqN = requests.get("https://search.naver.com/search.naver?query="+ key.replace("('", "").replace("',)", "").replace(" ","+"))
        reqN_text = reqN.text
        soup = BeautifulSoup(reqN_text, "lxml")

        try:
            listN = soup.find_all("a", {"class": "tit _sp_each_url _sp_each_title"})
            if(not listN):
                listN = soup.find_all("span", {"class": "tit_inner"})
                if(not listN):
                    listN = soup.find_all("a", {"class": "biz_name"})

                #print(listN)

            print(str(listN).split('href="')[1].split('"')[0].replace("amp;",""))
        except:
            print(key)

        try:
            sql = 'update map set naverlink="' + str(listN).split('href="')[1].split('"')[0].replace("amp;","") + '" where name="' + key.replace("('", "").replace("',)", "") + '"'
            print(sql)
            cur.execute("set charset utf8")
            cur.execute(sql)
            conn.commit()
        except:
            print("오류");
relation()