<template>
    <div class="search">
        <el-input placeholder="请输入内容" v-model="searchTxt" class="input-with-select" @keyup.native.enter="goTo()">
            <el-select v-model="searchType" slot="prepend">
                <el-option label="百度" value="1"></el-option>
                <el-option label="谷歌" value="2"></el-option>
            </el-select>
            <el-button slot="append" icon="el-icon-search" @click="goTo()"></el-button>
        </el-input>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                searchTxt: '',
                searchType: '1'
            }
        },
        methods: {
            goTo () {
                if (!this.searchTxt.trim()) {
                    return
                }
                if (this.searchType === '1') {
                    const url = 'https://www.baidu.com/s?wd=' + this.searchTxt
                    window.location.href = url
                } else {
                    const url = 'https://www.google.com/s?wd=' + this.searchTxt
                    window.location.href = url
                }
            }
        }
    }
</script>
<style lang="less">
    .search {
        width: 35vmax;
        margin: 5vmax auto;
        .el-select {
            .el-input__inner {
                width: 5vmax;
                min-width: 75px;
            }
        }
        .el-input__inner {
            width: 27vmax;
            color: #409EFF;
        }
        .el-button {
            width: 3vmax;
            min-width: 54px;
        }
    }
</style>
