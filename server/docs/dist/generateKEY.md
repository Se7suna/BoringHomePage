

## generateKEY

### 1) 请求地址

>http://localhost/me/MYCLOUDSERVERRELATED/118.25.100.119/BoringHomepage/server/api/generateKEY.php

### 2) 调用方式：HTTP post

### 3) 接口描述：

* 接口描述详情

### 4) 请求参数:


#### POST参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|userId||string|Y|-|
|groupName||string|N|-|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "hash": "c5602ffe9069ece63a14ff471a2d4022",
        "groupId": "c5602ffe9069ece63a14ff471a2d4022",
        "groupLord": "10011",
        "groupName": "肉山小客厅"
    },
    "resInfo": "成功: 创建成功!"
}
```


### 6) 请求返回结果参数说明:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|resCode||string|Y|-|
|resData||string|Y|-|
|hash||string|Y|-|
|groupId||string|Y|-|
|groupLord||string|Y|-|
|groupName||string|Y|-|
|resInfo||string|Y|-|

