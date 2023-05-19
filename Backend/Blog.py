import urllib.request
import pymysql
import xml.etree.ElementTree as elemTree
import json
from collections import OrderedDict
from pprint import pprint

file_data = OrderedDict()
client_id = "TINu97pfUX4zAy7KrVYV"
client_secret = "sGqcrnOB2h"

conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password!", db="db",  charset='utf8')
cur = conn.cursor()

sql = 'select distinct contents from daum where cat="음식"'
cur.execute("set charset utf8")
cur.execute(sql)
rows = cur.fetchall()


def make_naver_search_api_url(node, search_text, start_num, disp_num):
    base_url = 'https://openapi.naver.com/v1/search/' + node + '.json'
    param_query = "?query=" + urllib.parse.quote(search_text)
    param_start = "&start=" + str(start_num)
    param_disp = "&display=" + str(disp_num)


    return base_url + param_query + param_start + param_disp


def get_request_url(API_url, client_id, client_secret):
    request = urllib.request.Request(API_url)
    request.add_header("X-Naver-Client-Id", client_id)
    request.add_header("X-Naver-Client-Secret", client_secret)
    response = urllib.request.urlopen(request)

    if response.getcode() == 200:
        return response.read().decode('utf-8')

    else:
        return None
        print("--- error ---")

c =1

for i in rows:
    temp = str(i[0])
    print(temp)
    temp2 = temp+'맛집'
    print(temp2)
    ww = [1, 100, 200, 300, 400, 500, 600, 700, 800, 900]
    for j in ww:
        api_url = make_naver_search_api_url('blog', temp2, j, 100)
        file_data = (get_request_url(api_url, client_id, client_secret))
        with open('./blog.json', 'w', encoding="utf-8") as d:
            json.dump(file_data, d, ensure_ascii=False)


        with open('./blog.json','r',encoding="utf-8") as f:
            dict = json.loads(file_data)
            ww2 = dict['total']
            if j>=ww2:
                break
            print(ww2)

        for h in dict['items']:
            print(h['title'].replace("<b>","").replace("</b>",""), h['link'],h['postdate'][:4]+ "-" + h['postdate'][4:6] + "-" + h['postdate'][6:8])
            sql2 ='insert into blog (contents,title, link, date, total) select "'+temp+'","'+h['title'].replace("<b>","").replace("</b>","")+'", "'+h['link']+'","'+h['postdate'][:4]+ "-" + h['postdate'][4:6] + "-" + h['postdate'][6:8]+'","'+str(ww2)+'" from dual where not exists(select * from blog where (contents="'+temp+'") and (title ="'+h['title'].replace("<b>","").replace("</b>","")+'") and (link="'+h['link']+'") and (date="'+h['postdate'][:4]+ "-" + h['postdate'][4:6] + "-" + h['postdate'][6:8]+'"))'
            cur.execute(sql2)
            conn.commit()
