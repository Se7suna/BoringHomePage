

## addLinkOfGroup

### 1) 请求地址

> /addLinkOfGroup.php 

### 2) 调用方式：HTTP post

### 3) 接口描述：

* 群组中新增链接

### 4) 请求参数:


#### POST参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|groupId||string|Y|群id|
|userId||string|Y|-|
|shareLinkSrc||string|Y|添加的链接|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "groupId": "c5602ffe9069ece63a14ff471a2d4022",
        "userId": "10010",
        "shareLinkSrc": "baidu.com",
        "userName": "",
        "shareLinkIcoScr": "",
        "shareLinkState": 0,
        "shareLinkName": ""
    },
    "resInfo": "成功: 链接提交成功, 等待审核！"
}
```


### 6) 请求返回结果参数说明:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|resCode||string|Y|-|
|resData||string|Y|-|
|groupId||string|Y|-|
|userId||string|Y|-|
|shareLinkSrc||string|Y|-|
|userName||string|Y|-|
|shareLinkIcoScr||string|Y|-|
|shareLinkState||string|Y|-|
|shareLinkName||string|Y|-|
|resInfo||string|Y|-|

