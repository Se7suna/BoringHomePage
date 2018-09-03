import Mock from 'mockjs'
// const Random = Mock.Random

// 获取背景图片
Mock.mock(
    // 请求地址
    '/getRandomScreensaver.php',
    // 返回数据
    {
        // 请求结果(失败0, 成功1)
        resCode: 1,
        // 图片地址( imgSrc: 'https://rabc2.iteye.com/i/media/v1/0f000nTw6TryU7IXpq-Cqs.jpg' )
        imgSrc: '/static/img/timg.jpg'
    }
)

// 生成一个新的群组
Mock.mock(
    // 请求地址
    '/userRegister.php',
    // 参数 (用户名, 密码)
    // {userID: String, userPWD: String}
    // 返回数据
    {
        // hash 群组身份唯一标识信息
        hash: parseInt(Math.random() * Math.pow(10, 15)),
        // key 用于成员加入群组
        key: parseInt(Math.random() * Math.pow(10, 10))
    }
)
