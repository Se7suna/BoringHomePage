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
            v-model="ruleForm2.useName"
            type="text"
            auto-complete="off"/>
        </el-form-item>
        <el-form-item
          label="密码"
          prop="pass">
          <el-input
            v-model="ruleForm2.usePass"
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
      return /\w{4,12}/g.test(this.ruleForm2.useName.trim());
    },
    passExp() {
      return /\w{4,12}/g.test(this.ruleForm2.usePass.trim());
    },
  },
  data() {
    var validateUser = (rule, value, callback) => {
      if (this.ruleForm2.useName.trim() === '') {
        callback(new Error('用户名必须输入!'));
      } else if (!this.userExp) {
        callback(new Error('用户名4到12位数字/英文/下划线!'));
      } else {
        callback();
      }
    };
    var validatePass = (rule, value, callback) => {
      if (this.ruleForm2.usePass.trim() === '') {
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
        useName: '',
        usePass: '',
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
      this.ruleForm2.useName = '';
      this.ruleForm2.usePass = '';
      this.dialogFormVisible = false;
    },
    login() {
      const data = {
        useName: this.ruleForm2.useName.trim(),
        usePass: this.ruleForm2.usePass.trim(),
      };
      const user = this.$store.state.user;
      this.$store.dispatch('getUser', data).then(resolve => {
        if (resolve) {
          const data = {userId: user.userId};
          this.$store.dispatch('getSaveList', data).then(resolve => {
            if (!resolve) {
              console.log('获取收藏夹失败, 请联系开发人员 !');
            }
          }).catch(reject => {
            console.log(reject);
          });
          window.localStorage.boring = JSON.stringify({useName: user.useName, usePass: user.userPass});
          this.dialogFormVisible = false;
        } else {
          this.$message.error('用户名已存在/密码不正确,请重新输入!');
          this.$refs.userName.focus();
        }
      }).catch(reject => {
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
