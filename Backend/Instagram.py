import selenium.webdriver as webdriver
from selenium.webdriver.common.keys import Keys
import time
import pymysql
import datetime
import schedule

conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password!", db="db",  charset='utf8')
cur = conn.cursor()

sql = 'select distinct contents from daum where contents="초계국수"'
cur.execute("set charset utf8")
cur.execute(sql)
rows = cur.fetchall()

############################# DB 연결 #####################################
localtime = datetime.datetime.now()

def insta():

    def hash(hashU,ttag):
        driverH = webdriver.Chrome('C:/Users/Kang/Desktop/chromedriver_win32 (1)/chromedriver.exe', options=options)
        driverH.implicitly_wait(5)
        driverH.get(hashU)
        inh=driverH.find_element_by_class_name('C4VMK')
        inhh=inh.find_elements_by_tag_name('a')
        day = driverH.find_element_by_class_name('Nzb55')
        postingtime=day.get_attribute("datetime")
        print(str(postingtime)[:10]) #게시글 시간

        cnt=1
        for con in inhh:
            tag = con.text
            if cnt==1:
                userId=con.text
                #print("userId : "+userId)

            elif tag.find("#")==0:
                #print(tag) #중복확인
                sql = 'insert into insta (userid, contents, hashtag, time) select "'+userId+'","'+ttag+'","'+tag+'","'+str(postingtime)[:10]+'"from dual where not exists(select * from insta where (userid="'+userId+'") and (contents="'+ttag+'") and (hashtag="'+tag+'") and (time="'+str(postingtime)[:10]+'"))'
                cur.execute(sql)
                conn.commit()

            cnt=cnt+1


    for i in rows:
        temp =str(i[0])
        tag = temp.replace(" ","")
        url = 'https://www.instagram.com/explore/tags/' + tag

        options = webdriver.ChromeOptions()
        options.add_argument('headless')
        options.add_argument('disable-gpu')
        driver = webdriver.Chrome('C:/Users/Kang/Desktop/chromedriver_win32 (1)/chromedriver.exe', options=options)

        driver.implicitly_wait(5)

        driver.get(url)

        totalCount = driver.find_element_by_class_name('g47SY').text

        sql2 = 'insert into instaT (contents, total, time) values ("' + tag + '","' + totalCount.replace(",","") + '","' + str(localtime)[:16] + '")'
        cur.execute(sql2)
        conn.commit()

        elem = driver.find_element_by_tag_name("body")
        # alt 속성의 값을 담을 빈 리스트 선언
        alt_list = []

        # 페이지 스크롤을 위해 임시 변수 선언
        pagedowns = 1
        # 스크롤을 20번 진행한다.
        while pagedowns < 1000:
            elem.send_keys(Keys.PAGE_DOWN)
            time.sleep(1)
            elem.send_keys(Keys.PAGE_DOWN)
            time.sleep(1)

            tt = driver.find_elements_by_class_name('weEfm')
            for a in tt:
                block = a.find_elements_by_tag_name('a')

                for c in block:
                    blockurl = c.get_attribute("href")
                    #print(blockurl)
                    hash(blockurl,tag)

            #print("-----------------------------------------------------")
            pagedowns += 1

        driver.quit()

#schedule.every(23).hours.do(insta)

# while True:
#     schedule.run_pending()
#     time.sleep(1)

insta()
