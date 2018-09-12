<template>
  <div class="login">
    <el-dialog
      :visible.sync="dialogFormVisible"
      title="注册/登录">
      <el-form
        ref="ruleForm2"
        :model="ruleForm2"
        :rules="rules2"
        status-icon
        label-width="55px"
        class="demo-ruleForm">
        <el-form-item
          label="用户名"
          prop="user">
          <el-input
            ref="userName"
            v-model="ruleForm2.userName"
            type="text"
            auto-complete="off"/>
        </el-form-item>
        <el-form-item
          label="密码"
          prop="pass">
          <el-input
            v-model="ruleForm2.userPass"
            type="text"
            auto-complete="off"/>
        </el-form-item>
      </el-form>
      <div
        slot="footer"
        class="dialog-footer">
        <el-button @click="esc()">取 消</el-button>
        <el-button
          :disabled="!userExp || !passExp"
          type="primary"
          @click="login()">登录</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
export default {
  computed: {
    userExp() {
      return /\w{4,12}/g.test(this.ruleForm2.userName.trim());
    },
    passExp() {
      return /\w{4,12}/g.test(this.ruleForm2.userPass.trim());
    },
  },
  data() {
    var validateUser = (rule, value, callback) => {
      if (this.ruleForm2.userName.trim() === '') {
        callback(new Error('用户名必须输入!'));
      } else if (!this.userExp) {
        callback(new Error('用户名4到12位数字/英文/下划线!'));
      } else {
        callback();
      }
    };
    var validatePass = (rule, value, callback) => {
      if (this.ruleForm2.userPass.trim() === '') {
        callback(new Error('密码必须输入!'));
      } else if (!this.passExp) {
        callback(new Error('密码4到12位数字/英文/下划线!'));
      } else {
        callback();
      }
    };
    return {
      dialogFormVisible: false,
      ruleForm2: {
        userName: '',
        userPass: '',
      },
      rules2: {
        user: [
          {validator: validateUser, trigger: 'blur'},
        ],
        pass: [
          {validator: validatePass, trigger: 'blur'},
        ],
      },
    };
  },
  methods: {
    show() {
      this.dialogFormVisible = true;
    },
    esc() {
      this.ruleForm2.userName = '';
      this.ruleForm2.userPass = '';
      this.dialogFormVisible = false;
    },
    login() {
      const data = {
        userName: this.ruleForm2.userName.trim(),
        userPass: this.ruleForm2.userPass.trim(),
      };
      const user = this.$store.state.user;
      // 发起登录请求
      this.$store.dispatch('getUser', data).then(resolve => {
        if (resolve) {
          const data = {userId: user.userId};
          // 登录成功, 获取收藏夹
          this.$store.dispatch('getSaveList', data).then(resolve => {
            if (!resolve) {
              // 获取收藏夹失败
              console.log('获取收藏夹失败, 请联系开发人员 !');
            }
          }).catch(reject => {
            // 获取收藏夹错误
            console.log(reject);
          });
          // 本地缓存账户信息
          window.localStorage.boring = JSON.stringify({userName: user.userName, userPass: user.userPass});
          this.dialogFormVisible = false;
        } else {
          // 登录失败, 提示是否注册
          this.$confirm('该用户名不存在, 是否注册?', '提示', {
            confirmButtonText: '注册',
            cancelButtonText: '取消',
            type: 'warning',
          }).then(() => {
            // 确认注册
            console.log(data);
            this.$store.dispatch('regUser', data).then(resolve => {
              if (resolve) {
                // 注册成功
                this.$message({
                  type: 'success',
                  message: '注册成功!',
                });
              } else {
              //  注册失败
                this.$message({
                  type: 'error',
                  message: '注册失败, 用户名已存在!',
                });
                // 清空用户名, 重新输入
                this.ruleForm2.userName = '';
                this.$refs.userName.focus();
              }
            }).catch(reject => {
              // 注册错误
              console.log(reject);
            });
          }).catch(() => {
            // 取消注册
            this.$message({
              type: 'info',
              message: '已取消',
            });
            this.ruleForm2.userName = '';
            this.ruleForm2.userPass = '';
            this.$refs.userName.focus();
          });
          // this.$message.error('用户名已存在/密码不正确,请重新输入!');
          // this.$refs.userName.focus();
        }
      }).catch(reject => {
        // 登录错误
        console.log(reject);
      });
    },
  },
};
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
