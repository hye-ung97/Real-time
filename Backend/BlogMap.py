import urllib.request
import pymysql
import xml.etree.ElementTree as elemTree
import json
from collections import OrderedDict
from pprint import pprint


file_data = OrderedDict()
client_id = "TINu97pfUX4zAy7KrVYV"
client_secret = "sGqcrnOB2h"

conn = pymysql.connect(host="host.com", port=3306, user="user", passwd="password", db="db",  charset='utf8')
cur = conn.cursor()

sql = 'select distinct contents, name,address from map where contents="명란 바게트" or contents="시금치 피타" or contents="마라탕"'
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


for i in rows:
    temp = str(i[0])
    temp2 = str(i[1])
    temp3 = str(i[2])
    print(temp)
    print(temp2)
    print(temp3)
    temp2='"'+temp2+'"'
    # print(temp2)
    ww = [1, 101, 201, 301, 401, 501]
    for j in ww:
        api_url = make_naver_search_api_url('blog', temp2, j, 100)
        file_data = (get_request_url(api_url, client_id, client_secret))
        with open('./blog.json', 'w', encoding="utf-8") as d:
            json.dump(file_data, d, ensure_ascii=False)


        with open('./blog.json','r',encoding="utf-8") as f:
            dict = json.loads(file_data)
            ee = dict['total']
            print(ee)
            if j>=ee:
                break

        for h in dict['items']:
            print(h['postdate'][:4]+ "-" + h['postdate'][4:6] + "-" + h['postdate'][6:8])
            sql2 = 'insert into blogstore (contents,name,address,time,total,link) values ("' + temp + '","' + temp2.replace('"','') + '", "' + temp3 + '","' + h['postdate'][:4] + "-" + h['postdate'][4:6] + "-" + h['postdate'][6:8] + '","'+str(ee)+'","'+h['link']+'")'

            cur.execute(sql2)
            conn.commit()
