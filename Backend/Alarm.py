import pymysql
import time
import schedule

def alarm():
    conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password", db="db",  charset='utf8')
    cur = conn.cursor()

    sql = 'select * from insertword'
    cur.execute("set charset utf8")
    cur.execute(sql)
    rows = cur.fetchall()

    sql2 = 'select contents,cat,time from naver order by time desc limit 10'
    cur.execute("set charset utf8")
    cur.execute(sql2)
    rows2 = cur.fetchall()

    sql3 = 'select contents,cat,time from daum order by time desc limit 10'
    cur.execute("set charset utf8")
    cur.execute(sql3)
    rows3 = cur.fetchall()

    sql4 = 'select contents,cat,time from nate order by time desc limit 10'
    cur.execute("set charset utf8")
    cur.execute(sql4)
    rows4 = cur.fetchall()

    #insertword에서 가져온것
    for u in rows:
        id = str(u[0])
        keyword = str(u[1])

        for i in rows2:
            navercontents = str(i[0])
            navercat = str(i[1])
            navertime = str(i[2])
            if keyword in navercontents:
                insertsql = 'insert into alarm (id, keyword, cat, site, time) select "' + id + '","' + navercontents + '","' + navercat + '","naver","' + navertime + '" from dual where not exists''(select * from alarm where keyword="' + navercontents + '" and id="' + id + '" and time like "' + navertime[0:10] + '%" and site="naver")'
                cur.execute("set charset utf8")
                cur.execute(insertsql)
                conn.commit()
        # daum에서 가져온것
        for k in rows3:
            daumcontents = str(k[0])
            daumcat = str(k[1])
            daumtime = str(k[2])
            if keyword in daumcontents:
                insertsql2 = 'insert into alarm (id, keyword, cat, site, time) select "' + id + '","' + daumcontents + '","' + daumcat + '","daum","' + daumtime + '" from dual where not exists''(select * from alarm where keyword="' + daumcontents + '" and id="' + id + '" and time like "' + daumtime[
                                                                                                                                                                                                                                                                                                       0:10] + '%" and site="daum")'
                cur.execute("set charset utf8")
                cur.execute(insertsql2)
                conn.commit()

        # nate에서 가져온것
        for z in rows4:
            natecontents = str(z[0])
            natecat = str(z[1])
            natetime = str(z[2])
            if keyword in natecontents:
                insertsql3 = 'insert into alarm (id, keyword, cat, site, time) select "' + id + '","' + natecontents + '","' + natecat + '","nate","' + natetime + '" from dual where not exists''(select * from alarm where keyword="' + natecontents + '" and id="' + id + '" and time like "' + natetime[
                                                                                                                                                                                                                                                                                                       0:10] + '%" and site="nate")'
                cur.execute("set charset utf8")
                cur.execute(insertsql3)
                conn.commit()



schedule.every(5).minutes.do(alarm)

while True:
    schedule.run_pending()
    time.sleep(1)
