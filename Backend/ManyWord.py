from bs4 import BeautifulSoup
import requests
import pymysql
import urllib.request as req
from konlpy.tag import Kkma, Twitter
from collections import Counter

conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password", db="db",  charset='utf8')
cur = conn.cursor()

sql = 'select text,contents, title from blog where contents="낙지 볶음"'
cur.execute("set charset utf8")
cur.execute(sql)
rows = cur.fetchall()

twitter = Twitter()

mydoclist_twitter = []

# text,title,link,contents
for i in rows:
    # text
    temp = str(i[0])
    # # title
    # temp2 = str(i[1])
    # link
    # temp3 = str(i[1])
    # contents
    temp4 = str(i[1])
    #title
    temp5 = str(i[2])

    print(temp)
    # 형태소 분석
    twitter_nouns2 = twitter.pos(temp5)
    twitter_nouns =twitter.pos(temp)
    mydoclist_twitter.append(twitter_nouns2)
    mydoclist_twitter.append(twitter_nouns)

    # print(mydoclist_twitter)

    # 명사 형용사 뽑기
    noun_adj_list =[]
    for s in mydoclist_twitter:
        for word, tag in s:
            if tag in ['Noun','Adjective','Verb']:
                noun_adj_list.append(word)


    print(noun_adj_list)

    # 가장 많이나온 단어 상위 10개
    counts = Counter(noun_adj_list)
    print(counts.most_common(10))

    del noun_adj_list[:]
    del mydoclist_twitter[:]


    for j in counts.most_common(10):
        cts = str(j).split("('")[1].split("'")[0]
        num = str(j).split(", ")[1].split(")")[0]
        print(cts)
        print(num)
        sql3 = 'insert into blogword (contents, mword,cnt) values ( "' + temp4 + '","'+cts+'",' + num + ')'
        print(sql3)
        cur.execute(sql3)
        conn.commit()

