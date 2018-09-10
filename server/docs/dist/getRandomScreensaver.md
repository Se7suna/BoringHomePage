

## getRandomScreensaver

### 1) 请求地址

> /getRandomScreensaver.php

### 2) 调用方式：HTTP get

> /getRandomScreensaver.php?pageNum=1&pageSize=10

### 3) 接口描述：

* 获得 background

### 4) 请求参数:

#### GET参数:
|字段名称       |字段说明         |类型            |必填            |备注     |
| -------------|:--------------:|:--------------:|:--------------:| ------:|
|pageNum||string|Y|-|
|pageSize||string|Y|-|



### 5) 请求返回结果:

```
{
    "resCode": 1,
    "resData": {
        "dataSize": "10",
        "dataNum": "1",
        "dataTotal": "17",
        "dataList": [
            {
                "id": "1",
                "bgSrc": "http://p2.so.qhimgs1.com/t01bee7604c431e895e.jpg",
                "bgStar": "1",
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "2",
                "bgSrc": "http://p2.so.qhimgs1.com/t01f4009dcadda0b8ee.jpg",
                "bgStar": "1",
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "3",
                "bgSrc": "http://p1.so.qhimgs1.com/t01fbac44bfe298163d.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "4",
                "bgSrc": "http://p4.so.qhmsg.com/t019ecc4cdfac172df9.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "5",
                "bgSrc": "http://p2.so.qhimgs1.com/t01807762f360ad55fe.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "6",
                "bgSrc": "http://p0.so.qhmsg.com/t01fb94f659f76699d5.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "7",
                "bgSrc": "http://p0.so.qhmsg.com/t0139367c2e6239ad7f.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "8",
                "bgSrc": "http://p0.so.qhmsg.com/t0139367c2e6239ad7f.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "9",
                "bgSrc": "http://p2.so.qhimgs1.com/sdr/200_200_/t015bec62de1a6eff4e.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            },
            {
                "id": "10",
                "bgSrc": "http://p0.so.qhmsg.com/t010a594d49c80c228f.jpg",
                "bgStar": null,
                "bgAuthor": null,
                "bgName": null,
                "bgDesc": null
            }
        ]
    },
    "resInfo": "成功: 获得数据!"
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
|bgSrc||string|Y|-|
|bgStar||string|Y|-|
|bgAuthor||string|Y|-|
|bgName||string|Y|-|
|bgDesc||string|Y|-|
|resInfo||string|Y|-|

