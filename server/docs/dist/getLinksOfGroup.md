

## getLinksOfGroup

### 1) 请求地址

> /getLinksOfGroup.php

### 2) 调用方式：HTTP get

> /getLinksOfGroup.php?groupId=123123&pageNum=1&pageSize=10&shareLinkState=1

### 3) 接口描述：

* 用户根据 群组id 获得 该群组中 待审核 或者 已审核的链接列表

### 4) 请求参数:

#### GET参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|groupId||string|Y|-|
|pageNum||string|N|-|
|pageSize||string|N|-|
|shareLinkState|群主审核状态|string|N|0表示未审核(默认未审核), 1表示审核通过|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "dataSize": "10",
        "dataNum": "1",
        "dataTotal": "0",
        "dataList": []
    },
    "resInfo": "成功: 获取数据成功!"
}
```


### 6) 请求返回结果参数说明:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|resCode||string|Y|-|
|resData||string|Y|-|
|dataSize||string|Y|-|
|dataNum||string|Y|-|
|dataTotal||string|Y|-|
|dataList||string|Y|-|
|resInfo||string|Y|-|

