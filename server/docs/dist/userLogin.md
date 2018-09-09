API document
============


## \# userLogin

Description : 目前密码是非必填

Method: GET

Request:
```json
{
  "userName": "qgp",
  "userPass": 123456
}
```

Response:
```json
[
  {
    "resCode": 1,
    "resData": {
      "userId": "1536418392",
      "userAvatar": "",
      "userName": "qgp"
    },
    "resInfo": "成功：用户名 qgp 登录成功。"
  }
]
```
