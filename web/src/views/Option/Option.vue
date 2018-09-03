<template>
    <div class="option">
        <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="收藏夹" name="first">
                <ul>
                    <li class="option_item">
                        <img src="./img/jd.jpg">
                        <p>京东商城</p>
                    </li>
                    <li class="option_item">
                        <img src="./img/jd.jpg">
                        <p>京东商城</p>
                    </li>
                    <div class="option_add">
                        <el-button round @click="showAlert()">
                            <i class="el-icon-plus"></i>
                        </el-button>
                    </div>
                    <Alert ref="alert"/>
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
            <el-button type="primary" plain  :loading="saveFlag" @click="save()">{{saveMsg}}</el-button>
            <el-button type="info" plain @click="optionHidden()">关闭</el-button>
        </div>
    </div>
</template>
<script>
    import Alert from '../../components/Alert/Alert.vue'
    export default {
        data () {
            return {
                activeName: 'first',
                saveFlag: false,
                saveMsg: '保存',
                user: ''
            }
        },
        mounted () {
            if (window.localStorage.boring) {
                this.user = JSON.parse(window.localStorage.boring)
            }
        },
        computed: {
            loginMsg () {
                const user = this.user
                if (!user) {
                    return '状态: 未加入群组'
                } else {
                    if (user.hash) {
                        return `邀请key: ${user.key}`
                    } else {
                        return '状态: 已加入群组'
                    }
                }
            },
            colorShow () {
                return !!this.user
            }
        },
        props: ['optionHidden'],
        methods: {
            handleClick (tab, event) {
                // console.log(tab, event)
            },
            save () {
                this.saveFlag = true
                this.saveMsg = '更新中...'
            },
            showAlert () {
                this.$refs.alert.show()
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
            }
        },
        components: {
            Alert
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
        padding: 2%;
        button {
            width: 40%;
            margin: 4%;
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
