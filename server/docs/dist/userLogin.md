

## userLogin

### 1) 请求地址

> /userLogin.php

### 2) 调用方式：HTTP post

> /userLogin.php?userName=qgp&userPass=123456 

### 3) 接口描述：

* 用户登录, 目前密码是非必填

### 4) 请求参数:

#### GET参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|userName||string|Y|-|
|userPass||string|N|-|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "userId": "1536565549",
        "userAvatar": "",
        "userName": "qgp"
    },
    "resInfo": "成功：用户名 qgp 登录成功。"
}
```


### 6) 请求返回结果参数说明:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|resCode||string|Y|-|
|resData||string|Y|-|
|userId||string|Y|-|
|userAvatar||string|Y|-|
|userName||string|Y|-|
|resInfo||string|Y|-|

