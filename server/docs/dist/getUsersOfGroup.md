

## getUsersOfGroup

### 1) 请求地址

> /getUsersOfGroup.php

### 2) 调用方式：HTTP get

### 3) 接口描述：

* 群组中用户列表 - 根据 群组id 获得群组中的成员

### 4) 请求参数:

> /getUsersOfGroup.php?groupId=c5602ffe9069ece63a14ff471a2d4022&pageNum=1&pageSize=10

#### GET参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|groupId||string|Y|-|
|pageNum||string|Y|-|
|pageSize||string|Y|-|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "dataSize": "10",
        "dataNum": "1",
        "dataTotal": "1",
        "dataList": [
            {
                "id": "22",
                "groupId": "c5602ffe9069ece63a14ff471a2d4022",
                "userId": "10011",
                "groupName": null,
                "groupLord": null
            }
        ]
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
|id||string|Y|-|
|groupId||string|Y|-|
|userId||string|Y|-|
|groupName||string|Y|-|
|groupLord||string|Y|-|
|resInfo||string|Y|-|

