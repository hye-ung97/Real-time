import json
from collections import Counter
import pymysql
from konlpy.tag import Twitter

conn = pymysql.connect(host="capruby07.cafe24.com", port=3306, user="capruby07", passwd="fnql0707!", db="capruby07",  charset='utf8')
cur = conn.cursor()
sql2 = 'select name from map where contents="낙지 볶음"'
cur.execute("set charset utf8")
cur.execute(sql2)
rows2 = cur.fetchall()

twitter = Twitter()
mydoclist_twitter = []


class KnuSL():

    def data_list(wordname):
        with open('data/SentiWord_info.json', encoding='utf-8-sig', mode='r') as f:
            data = json.load(f)
        result = ['None', 'None']

        for i in range(0, len(data)):
            if data[i]['word'] == wordname:
                result.pop()
                result.pop()
                result.append(data[i]['word_root'])
                result.append(data[i]['polarity'])

        r_word = result[0]
        s_word = result[1]

        # print('어근 : ' + r_word)
        # print('극성 : ' + s_word)

        return r_word, s_word

for k in rows2:
    name = k[0]
    sql = 'select text,contents, name from blogstore where name="'+name+'"'
    cur.execute("set charset utf8")
    cur.execute(sql)
    rows = cur.fetchall()


    if __name__ == "__main__":
        ksl = KnuSL

        for a in rows:
            temp = str(a[0])
            # print(temp)
            temp1 = str(a[1])
            # print(temp1)
            temp2 = str(a[2])
            # print(temp2)

        # 3. 트윗터 패키지 안에 konlpy 모듈호출
            twitter_nouns = twitter.pos(temp)
            mydoclist_twitter.append(twitter_nouns)

            noun_adj_list = []
            for s in mydoclist_twitter:
                for word, tag in s:
                    if tag in ['Adjective', 'Verb']:
                        noun_adj_list.append(word)
            a = 0
            while (a==0):
                try:
                    for k in noun_adj_list:
                        #print(k.__getitem__(0)
                        if(ksl.data_list(k) != ('None','None')):
                            print(k)
                            print(ksl.data_list(k))
                            wo =str(ksl.data_list(k)).split("('")[1].split("'")[0]
                            feel =str(ksl.data_list(k)).split(", '")[1].split("')")[0]
                            print(wo)
                            print(feel)
                            sql3 = 'insert into blogstorePN (contents, name, word, feeling) values ("' + temp1 + '","' + temp2 + '","' + k +'",' + feel +')'
                            print(sql3)
                            cur.execute(sql3)
                            conn.commit()

                    a = a + 1
                except:
                    break

            del noun_adj_list[:]
            del mydoclist_twitter[:]