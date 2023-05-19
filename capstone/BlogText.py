from bs4 import BeautifulSoup
import urllib.request as req
import pymysql

conn = pymysql.connect(host="capruby07.cafe24.com", port=3306, user="capruby07", passwd="fnql0707!", db="capruby07",  charset='utf8')
cur = conn.cursor()

sql = 'select link from blogstore where text is null and contents="초계국수"'
cur.execute("set charset utf8")
cur.execute(sql)
rows = cur.fetchall()

def get_text(final_url,bloglink):
    try:
        ##제목과 본문부분 추출
        res = req.urlopen(final_url)
        soup = BeautifulSoup(res, 'html.parser')
        # temp = soup.select("#se_textarea")

        ##본문 추출
        temp = soup.findAll("p", {"class": "se_textarea"})
        if not temp:
            temp = soup.findAll("p", {"class": "se-text-paragraph"})
            if not temp:
                temp = soup.findAll("div", {"class": "view"})
                if not temp:
                    temp = soup.findAll("div", {"class": "post-view"})

        contents = ""
        for a in temp:
            text = a.get_text()
            contents = contents + text
            # #print(text)
            # print(contents)

        contents = contents.replace('"', '')
        sql2 = 'update blogstore set text = "'+ contents +'" where link = "' + bloglink +'" and text is null'
        print(sql2)
        cur.execute(sql2)
        conn.commit()

    except:
        print("크롤링실패")


for u in rows:
    try:
        bloglink = str(u[0])
        id = bloglink.split("https://blog.naver.com/")[1].split("?")[0]
        logNo = bloglink.split("logNo=")[1]
        url = "https://blog.naver.com/PostView.nhn?blogId="+id+"&logNo="+logNo+"&redirect=Dlog&widgetTypeCall=true&directAccess=false"
        # print(url)
        get_text(url,bloglink)
    except:
        print("링크 변환 실패 -> 본문 크롤링 x")
