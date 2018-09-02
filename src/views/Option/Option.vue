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
                        <el-button round>
                            <i class="el-icon-plus"></i>
                        </el-button>
                    </div>
                </ul>
            </el-tab-pane>
            <el-tab-pane label="设置" name="second">
                <ul>
                    <div class="option_fun">
                        <p class="top">未加入群组</p>
                        <div class="new">新建群组</div>
                        <div class="join">加入群组</div>
                        <ul class="list">审核</ul>
                        <ul class="push">上传</ul>
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
    export default {
        data () {
            return {
                activeName: 'first',
                saveFlag: false,
                saveMsg: '保存'
            }
        },
        props: ['optionHidden'],
        methods: {
            handleClick (tab, event) {
                console.log(tab, event)
            },
            save () {
                this.saveFlag = true
                this.saveMsg = '更新中...'
            }
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
            color: #666;
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
</style>
