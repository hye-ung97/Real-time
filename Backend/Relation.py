import pymysql
import time
import datetime
import requests
import schedule
from bs4 import BeautifulSoup

def relation():
    timeM = datetime.datetime.now()
    conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password", db="db",  charset='utf8')
    cur = conn.cursor()

    sql2 = 'select distinct contents from naver where time like "'+ str(timeM)[:10] + '%" order by time desc limit 30'
    cur.execute("set charset utf8")
    cur.execute(sql2)
    rows = cur.fetchall()

    time = datetime.datetime.now()
    for i in rows:
        key = str(i)
        # 다음 연관검색어
        reqD = requests.get("https://search.daum.net/search?w=tot&q=" + key.replace("',)", "").replace("('", "").replace(" ","+"))
        reqD_text = reqD.text
        soup = BeautifulSoup(reqD_text, "lxml")
        listD = soup.select("#netizen_lists_top > span")

        for j in listD:
            yeon = j.find("a", {"class": "keyword"}).text
            sql = 'insert into relation select "' + key.replace("',)","").replace("('","") + '","' + yeon + '","' + str(time)[:10] + '" from dual where not exists (select * from relation where yeon="' + yeon + '" and contents="'+ key.replace("',)","").replace("('","") +'")'
            cur.execute("set charset utf8")
            cur.execute(sql)
            conn.commit()

        #네이버 연관검색어
        reqN = requests.get("https://search.naver.com/search.naver?query="+ key.replace("',)", "").replace("('", "").replace(" ","+"))
        reqN_text = reqN.text
        soup = BeautifulSoup(reqN_text, "lxml")

        listN = soup.select("#nx_related_keywords > dl > dd > ul > li")

        for m in listN:
            yeon2 = m.find("a").text
            sql3 = 'insert into relation select "' + key.replace("',)", "").replace("('", "") + '","' + yeon2 + '","' + str(
                time)[:10] + '" from dual where not exists (select * from relation where yeon="' + yeon2 + '" and contents="'+ key.replace("',)", "").replace("('", "") +'")'
            cur.execute("set charset utf8")
            cur.execute(sql3)
            conn.commit()

        #Zum 연관검색어
        reqZ = requests.get("http://search.zum.com/search.zum?query="+ key.replace("',)", "").replace("('", "").replace(" ","+"))
        reqZ_text = reqZ.text
        soup = BeautifulSoup(reqZ_text, "lxml")

        listZ = soup.select("#connected_search > ul > li")
        for p in listZ:
            yeon4 = p.find("a").text
            sql4 = 'insert into relation select "' + key.replace("',)", "").replace("('", "") + '","' + yeon4 + '","' + str(
                time)[:10] + '" from dual where not exists (select * from relation where yeon="' + yeon4 + '" and contents="'+ key.replace("',)", "").replace("('", "") +'")'
            cur.execute("set charset utf8")
            cur.execute(sql4)
            conn.commit()
    conn.close()

def relation2():
    timeM = datetime.datetime.now()
    conn = pymysql.connect(host="capruby07.cafe24.com", port=3306, user="capruby07", passwd="fnql0707!", db="capruby07", charset='utf8')
    cur = conn.cursor()

    sql3 = 'select distinct contents from daum where time like "' + str(timeM)[:10] + '%" order by time desc limit 20'
    cur.execute("set charset utf8")
    cur.execute(sql3)
    rows = cur.fetchall()

    time = datetime.datetime.now()
    for i in rows:
        key = str(i)
        # 다음 연관검색어
        reqD = requests.get(
            "https://search.daum.net/search?w=tot&q=" + key.replace("',)", "").replace("('", "").replace(" ", "+"))
        reqD_text = reqD.text
        soup = BeautifulSoup(reqD_text, "lxml")
        listD = soup.select("#netizen_lists_top > span")

        for j in listD:
            yeon = j.find("a", {"class": "keyword"}).text
            sql = 'insert into relation select "' + key.replace("',)", "").replace("('",
                                                                                   "") + '","' + yeon + '","' + str(
                time)[
                                                                                                                :10] + '" from dual where not exists (select * from relation where yeon="' + yeon + '" and contents="' + key.replace(
                "',)", "").replace("('", "") + '")'
            cur.execute("set charset utf8")
            cur.execute(sql)
            conn.commit()

        # 네이버 연관검색어
        reqN = requests.get(
            "https://search.naver.com/search.naver?query=" + key.replace("',)", "").replace("('", "").replace(" ", "+"))
        reqN_text = reqN.text
        soup = BeautifulSoup(reqN_text, "lxml")

        listN = soup.select("#nx_related_keywords > dl > dd > ul > li")

        for m in listN:
            yeon2 = m.find("a").text
            sql3 = 'insert into relation select "' + key.replace("',)", "").replace("('",
                                                                                    "") + '","' + yeon2 + '","' + str(
                time)[
                                                                                                                  :10] + '" from dual where not exists (select * from relation where yeon="' + yeon2 + '" and contents="' + key.replace(
                "',)", "").replace("('", "") + '")'
            cur.execute("set charset utf8")
            cur.execute(sql3)
            conn.commit()

        # Zum 연관검색어
        reqZ = requests.get(
            "http://search.zum.com/search.zum?query=" + key.replace("',)", "").replace("('", "").replace(" ", "+"))
        reqZ_text = reqZ.text
        soup = BeautifulSoup(reqZ_text, "lxml")

        listZ = soup.select("#connected_search > ul > li")
        for p in listZ:
            yeon4 = p.find("a").text
            sql4 = 'insert into relation select "' + key.replace("',)", "").replace("('",
                                                                                    "") + '","' + yeon4 + '","' + str(
                time)[
                                                                                                                  :10] + '" from dual where not exists (select * from relation where yeon="' + yeon4 + '" and contents="' + key.replace(
                "',)", "").replace("('", "") + '")'
            cur.execute("set charset utf8")
            cur.execute(sql4)
            conn.commit()
    conn.close()


def relation3():
    timeM = datetime.datetime.now()
    conn = pymysql.connect(host="capruby07.cafe24.com", port=3306, user="capruby07", passwd="fnql0707!", db="capruby07", charset='utf8')
    cur = conn.cursor()

    sql1 = 'select distinct contents from nate where time like "' + str(timeM)[:10] + '%" order by time desc limit 30'
    cur.execute("set charset utf8")
    cur.execute(sql1)
    rows = cur.fetchall()

    time = datetime.datetime.now()
    for i in rows:
        key = str(i)
        # 다음 연관검색어
        reqD = requests.get(
            "https://search.daum.net/search?w=tot&q=" + key.replace("',)", "").replace("('", "").replace(" ", "+"))
        reqD_text = reqD.text
        soup = BeautifulSoup(reqD_text, "lxml")
        listD = soup.select("#netizen_lists_top > span")

        for j in listD:
            yeon = j.find("a", {"class": "keyword"}).text
            sql = 'insert into relation select "' + key.replace("',)", "").replace("('",
                                                                                   "") + '","' + yeon + '","' + str(
                time)[
                                                                                                                :10] + '" from dual where not exists (select * from relation where yeon="' + yeon + '" and contents="' + key.replace(
                "',)", "").replace("('", "") + '")'
            cur.execute("set charset utf8")
            cur.execute(sql)
            conn.commit()

        # 네이버 연관검색어
        reqN = requests.get(
            "https://search.naver.com/search.naver?query=" + key.replace("',)", "").replace("('", "").replace(" ", "+"))
        reqN_text = reqN.text
        soup = BeautifulSoup(reqN_text, "lxml")

        listN = soup.select("#nx_related_keywords > dl > dd > ul > li")

        for m in listN:
            yeon2 = m.find("a").text
            sql3 = 'insert into relation select "' + key.replace("',)", "").replace("('",
                                                                                    "") + '","' + yeon2 + '","' + str(
                time)[
                                                                                                                  :10] + '" from dual where not exists (select * from relation where yeon="' + yeon2 + '" and contents="' + key.replace(
                "',)", "").replace("('", "") + '")'
            cur.execute("set charset utf8")
            cur.execute(sql3)
            conn.commit()

        # Zum 연관검색어
        reqZ = requests.get(
            "http://search.zum.com/search.zum?query=" + key.replace("',)", "").replace("('", "").replace(" ", "+"))
        reqZ_text = reqZ.text
        soup = BeautifulSoup(reqZ_text, "lxml")

        listZ = soup.select("#connected_search > ul > li")
        for p in listZ:
            yeon4 = p.find("a").text
            sql4 = 'insert into relation select "' + key.replace("',)", "").replace("('",
                                                                                    "") + '","' + yeon4 + '","' + str(
                time)[
                                                                                                                  :10] + '" from dual where not exists (select * from relation where yeon="' + yeon4 + '" and contents="' + key.replace(
                "',)", "").replace("('", "") + '")'
            cur.execute("set charset utf8")
            cur.execute(sql4)
            conn.commit()
    conn.close()

schedule.every(5).minutes.do(relation)
schedule.every(5).minutes.do(relation2)
schedule.every(5).minutes.do(relation3)

while True:
    schedule.run_pending()
    time.sleep(1)