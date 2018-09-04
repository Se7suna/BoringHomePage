<template>
    <div class="alert">
        <el-dialog title="收藏夹" :visible.sync="dialogFormVisible">
            <el-form :model="form">
                <el-form-item label="图标地址">
                    <el-input v-model="form.linkIco" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="链接名称">
                    <el-input v-model="form.linkName" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="链接地址">
                    <el-input v-model="form.linkToSrc" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="esc()">取 消</el-button>
                <el-button type="primary" @click="push()">保存</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<script>
    import {reqAddItem} from '../../api'
    export default {
        data () {
            return {
                dialogFormVisible: false,
                form: {
                    linkIco: '',
                    linkName: '',
                    linkToSrc: ''
                }
            }
        },
        methods: {
            show (obj) {
                this.dialogFormVisible = true
                if (obj) {
                    this.form.linkIco = obj.linkIco
                    this.form.linkName = obj.linkName
                    this.form.linkToSrc = obj.linkToSrc
                }
            },
            esc () {
                this.form.linkIco = ''
                this.form.linkName = ''
                this.form.linkToSrc = ''
                this.dialogFormVisible = false
            },
            push () {
                const URL = '/updateFavoriteLinks.php'
                const data = {
                    linkIco: this.form.linkIco,
                    linkName: this.form.linkName,
                    linkToSrc: this.form.linkToSrc
                }
                reqAddItem(URL, data).then(res => {
                    if (res.resCode === 1) {
                        this.$store.state.saveList.dataList.push(res.resData)
                        this.$message({
                            message: '保存成功!',
                            type: 'success'
                        })
                    }
                })
                this.dialogFormVisible = false
            }
        }
    }
</script>
<style lang="less">
    .alert {
        .el-dialog {
            width: 30%;
            min-width: 400px;
        }
        .el-dialog__body {
            padding: 50px 40px;
        }
    }
</style>
