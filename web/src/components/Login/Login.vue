<template>
    <div class="login">
        <el-dialog title="注册/登录" :visible.sync="dialogFormVisible">
            <el-form :model="ruleForm2" status-icon :rules="rules2" ref="ruleForm2" label-width="55px" class="demo-ruleForm">
                <el-form-item label="用户名" prop="user">
                    <el-input type="text" v-model="ruleForm2.useName" auto-complete="off" ref="userName"></el-input>
                </el-form-item>
                <el-form-item label="密码" prop="pass">
                    <el-input type="text" v-model="ruleForm2.usePass" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="esc()">取 消</el-button>
                <el-button type="primary" :disabled="!userExp || !passExp" @click="login()">登录</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<script>
    import {reqUser} from '../../api'
    export default {
        data () {
            var validateUser = (rule, value, callback) => {
                if (this.ruleForm2.useName === '') {
                    callback(new Error('用户名必须输入!'))
                } else if (!this.userExp) {
                    callback(new Error('用户名4到12位数字/英文/下划线!'))
                } else {
                    callback()
                }
            }
            var validatePass = (rule, value, callback) => {
                if (this.ruleForm2.usePass === '') {
                    callback(new Error('密码必须输入!'))
                } else if (!this.passExp) {
                    callback(new Error('密码4到12位数字/英文/下划线!'))
                } else {
                    callback()
                }
            }
            return {
                dialogFormVisible: false,
                ruleForm2: {
                    useName: '',
                    usePass: ''
                },
                rules2: {
                    user: [
                        { validator: validateUser, trigger: 'blur' }
                    ],
                    pass: [
                        { validator: validatePass, trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            show (obj) {
                this.dialogFormVisible = true
            },
            esc () {
                this.ruleForm2.useName = ''
                this.ruleForm2.usePass = ''
                this.dialogFormVisible = false
            },
            login () {
                const URL = '/usersLogin.php'
                const data = {
                    useName: this.ruleForm2.useName.trim(),
                    usePass: this.ruleForm2.usePass.trim()
                }
                reqUser(URL, data).then(res => {
                    if (res.resCode === 1) {
                        this.$store.state.user = res.resData
                        this.$store.dispatch('getSaveList', {userId: res.resData.userId})
                        window.localStorage.boring = JSON.stringify({useName: res.resData.userId, usePass: res.resData.userId})
                        this.dialogFormVisible = false
                    } else {
                        this.$message.error('用户名已存在/密码不正确,请重新输入!')
                        this.$refs.userName.focus()
                    }
                })
            }
        },
        computed: {
            userExp () {
                return /\w{4,12}/g.test(this.ruleForm2.useName.trim())
            },
            passExp () {
                return /\w{4,12}/g.test(this.ruleForm2.usePass.trim())
            }
        }
    }
</script>
<style lang="less">
    .login {
        .el-dialog {
            width: 30%;
            min-width: 400px;
        }
        .el-dialog__body {
            padding: 50px 40px;
        }
    }
</style>
