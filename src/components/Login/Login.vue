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
            ref="userPass"
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
    async login() {
      const userData = {
        userName: this.ruleForm2.userName.trim(),
        userPass: this.ruleForm2.userPass.trim(),
      };
      // 发起登录请求
      const state = this.$store.state;
      const loginInfo = await this.$store.dispatch('userLogin', userData);
      if (+loginInfo === 1) {
        // 登录成功, 获取收藏夹
        const userId = {userId: state.user.userId};
        const hashRes = await this.$store.dispatch('getHash', userId);
        if (hashRes) {
          this.$store.dispatch('getGroupLink', state.hashList);
        }
        // 本地缓存账户信息
        const lsData = {userName: state.user.userName, userPass: this.ruleForm2.userPass.trim()};
        window.localStorage.boring = JSON.stringify(lsData);
        this.dialogFormVisible = false;
      } else if (+loginInfo === 2) {
        // 登录失败, 提示是否注册
        this.$confirm('该用户名不存在, 是否注册?', '提示', {
          confirmButtonText: '注册',
          cancelButtonText: '取消',
          type: 'warning',
        }).then(() => {
          // 确认注册
          this.$store.dispatch('regUser', userData).then(regRes => {
            if (regRes) {
              // 注册成功
              this.$message({
                type: 'success',
                message: '注册成功!',
              });
              const lsData = {userName: state.user.userName, userPass: this.ruleForm2.userPass.trim()};
              window.localStorage.boring = JSON.stringify(lsData);
              this.esc();
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
          });
        }).catch(() => {
          // 取消注册
          this.$message({
            type: 'info',
            message: '已取消',
          });
          this.$refs.userName.focus();
        });

      } else if (+loginInfo === 4) {
        this.$message.error('密码不正确,请重新输入!');
        this.ruleForm2.userPass = '';
        this.$refs.userPass.focus();
      }
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
