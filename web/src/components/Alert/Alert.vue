<template>
    <div class="alert">
        <el-dialog title="收藏夹" :visible.sync="dialogFormVisible">
            <el-form :model="form">
                <el-form-item label="logo地址">
                    <el-input v-model="form.logo" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="链接名称">
                    <el-input v-model="form.name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="链接地址">
                    <el-input v-model="form.url" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">取 消</el-button>
                <el-button type="primary" @click="dialogFormVisible = false">保存</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<script>
     export default {
        data () {
            return {
                dialogTableVisible: false,
                dialogFormVisible: false,
                form: {
                    logo: '',
                    name: '',
                    url: ''
                }
            }
        },
        methods: {
            show () {
                this.dialogFormVisible = true
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
