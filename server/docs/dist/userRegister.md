API document
============


## \# userRegister

Description : 用户注册,用户名和密码必填但不作额外验证, 用户头像选填,用户头像目前仅支持 http 链接形式的, 暂不支持自主上传

Method: POST

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
      "userId": 1536418392,
      "userAvatar": "",
      "userName": "qgp",
      "userPass": "123456"
    },
    "resInfo": "成功: 用户注册成功！"
  }
]
```
