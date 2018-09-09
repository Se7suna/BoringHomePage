API document
============


## \# getRandomScreensaver

Description : 获得随机background

Method: GET

Request:
```json
{
  "pageSize": 10,
  "pageNum": 1
}
```

Response:
```json
[
  {
    "resCode": 1,
    "resData": {
      "dataSize": 10,
      "dataNum": 1,
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
          "bgSrc": "http://p2.so.qhimgs1.com/t012bcb5589c0884b42.jpg",
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
]
```
