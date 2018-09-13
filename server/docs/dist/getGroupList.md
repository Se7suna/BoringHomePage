

## getGroupList

### 1) 请求地址

> /getGroupList.php

### 2) 调用方式：HTTP get

> /getGroupList.php?userId=2

### 3) 接口描述：

* 用户根据 用户id 获得 他所参加的群组列表

### 4) 请求参数:

#### GET参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|userId||string|Y|-|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "dataList": [
            {
                "id": "2",
                "groupId": "2",
                "userId": "2",
                "groupName": "2",
                "groupLord": "2"
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
|dataList||string|Y|-|
|id||string|Y|-|
|groupId||string|Y|-|
|userId||string|Y|-|
|groupName||string|Y|-|
|groupLord|群主id|string|Y|-|
|resInfo||string|Y|-|

