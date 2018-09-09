

## submitKEY

### 1) 请求地址

> /submitKEY.php

### 2) 调用方式：HTTP post

### 3) 接口描述：

* 用户加入群组

### 4) 请求参数:


#### POST参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|userId||string|Y|-|
|hash||string|Y|-|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "userId": "10010",
        "groupId": "c5602ffe9069ece63a14ff471a2d4022"
    },
    "resInfo": "成功: 加入成功!"
}
```


### 6) 请求返回结果参数说明:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|resCode||string|Y|-|
|resData||string|Y|-|
|userId||string|Y|-|
|groupId||string|Y|-|
|resInfo||string|Y|-|

