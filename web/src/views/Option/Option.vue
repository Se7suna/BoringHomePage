<template>
    <div class="option">
        <el-tabs v-model="activeName">
            <el-tab-pane label="收藏夹" name="first">
                <ul>
                    <template v-if="this.$store.state.saveList">
                        <li class="option_item" v-for="i of this.$store.state.saveList.dataList" :key="i.linkId">
                            <img :src="i.linkIco">
                            <p>{{i.linkName}}</p>
                            <p>{{i.linkToSrc}}</p>
                        </li>
                    </template>
                    <div class="option_add">
                        <el-button round @click="showAlert()">
                            <i class="el-icon-plus"></i>
                        </el-button>
                    </div>
                </ul>
            </el-tab-pane>
            <el-tab-pane label="设置" name="second">
                <ul>
                    <div class="option_fun">
                        <p class="msg" :class="{show: colorShow}">{{loginMsg}}</p>
                        <div class="new">
                            <el-button type="primary" @click="newGroup()">创建群组</el-button>
                        </div>
                        <div class="join">
                            <el-button type="primary">加入群组</el-button>
                        </div>
                        <div class="push">
                            <el-button type="primary">上传链接</el-button>
                        </div>
                        <div class="change">
                            <el-button type="primary" @click="changeBg()">更换背景</el-button>
                        </div>
                        <ul class="list">
                            <li class="option_item">
                                <img src="./img/jd.jpg">
                                <p class="top">京东商城</p>
                                <p class="mid">url</p>
                                <p class="bot">描述</p>
                                <el-button type="success">同意</el-button>
                                <el-button type="danger">拒绝</el-button>
                            </li>
                            <li class="option_item">
                                <img src="./img/jd.jpg">
                                <p class="top">京东商城</p>
                                <p class="mid">url</p>
                                <p class="bot">描述</p>
                                <el-button type="success">同意</el-button>
                                <el-button type="danger">拒绝</el-button>
                            </li>
                        </ul>
                    </div>
                    <li class="option_push">
                    </li>
                </ul>
            </el-tab-pane>
        </el-tabs>
        <div class="option_btn">
            <el-button type="success" v-if="!$store.state.user.id" @click="showLogin()">注册 / 登录</el-button>
            <el-button type="danger" v-else @click="logOut()">注销</el-button>
        </div>
        <Alert ref="alert"/>
        <Login ref="login"/>
    </div>
</template>
<script>
    import Alert from '../../components/Alert/Alert.vue'
    import Login from '../../components/Login/Login.vue'
    export default {
        data () {
            return {
                activeName: 'first',
                user: ''
            }
        },
        props: ['changeBg'],
        mounted () {
            if (window.localStorage.boring) {
                this.user = JSON.parse(window.localStorage.boring)
            }
        },
        computed: {
            loginMsg () {
                const user = this.$store.state.user
                if (!user.id) {
                    return '状态: 未登录, 请登录!'
                } else {
                    if (user.key) {
                        return `状态: 已加入 ${user.key}`
                    } else {
                        return '状态: 暂未加入群组'
                    }
                }
            },
            colorShow () {
                return this.$store.state.user.key
            }
        },
        methods: {
            showAlert () {
                this.$refs.alert.show()
            },
            showLogin () {
                this.$refs.login.show()
            },
            newGroup () {
                const ls = window.localStorage
                if (ls.boring) {
                    this.$notify.error({
                        title: '错误',
                        message: '您已创建或加入群组, 如需加入其他群组请清空浏览器缓存后再进行该操作!'
                    })
                } else {
                    const data = {
                        hash: parseInt(Math.random() * Math.pow(10, 15)),
                        key: parseInt(Math.random() * Math.pow(10, 10))
                    }
                    this.user = data
                    ls.boring = JSON.stringify(data)
                    this.$notify({
                        title: '成功',
                        message: '新建群组成功! 您的邀请key : ' + data.key,
                        type: 'success'
                    })
                }
            },
            logOut () {
                this.$store.dispatch('logOut')
            }
        },
        components: {
            Alert,
            Login
        }
    }
</script>
<style lang="less">
    .option {
        position: absolute;
        top: 0;
        right: 0;
        width: 15%;
        height: 100%;
        padding-bottom: 8%;
        background-color: #eee;
        .el-tabs {
            height: 100%;
        }
        .el-tabs__content {
            height: 100%;
            .show {
                color: #67C23A
            }
        }
        .el-tabs__nav{
            width: 100%;
            height: 80px;
            background-color: #fff;
            padding: 20px;
        }
        .el-tabs__active-bar {
            width: 50% !important
        }
        .el-tabs__item{
            width: 50%;
            text-align: center;
            font-size: 22px;
            font-weight: 800;
        }
        .el-tab-pane {
            padding: 5% 6.5%;
            height: 100%;
            overflow: auto;
        }

    }
    .option_item {
        text-align: center;
        background-color: #fff;
        padding: 8%;
        margin-bottom: 8%;
        img {
            width: 100%;
            height: 80%;
        }
        p {
            color: #303133;;
            margin-top: 4%
        }
    }
    .option_add {
        display: flex;
        justify-content: center;
        i {
            padding: 5px;
            font-size: 22px;
            font-weight: 800;
        }
        padding-bottom: 6%;
    }
    .option_btn {
        display: flex;
        justify-content: center;
        position: absolute;
        width: 100%;
        height: 8%;
        bottom: 0;
        left: 0;
        text-align: center;
        background-color: #fff;
        padding: 6%;
        button {
            width: 100%;
        }
    }
    .option_fun {
        p,
        div,
        ul {
            margin-bottom: 8%;
            .el-button {
                width: 100%;
            }
        }
        .msg {
            text-align: center;
            color: #333;
            background-color: #fff;
            border-radius: 5px;
            padding: 8% 0;
        }
        .list {
            .el-button {
                width: 45%;
            }
            .top {
                font-weight: 800;
                color: #303133;
            }
            .mid {
                color: #606266;
            }
            .bot {
                color: #909399
            }
        }
    }
</style>
