<template>
  <div class="update">
    <el-dialog
      :visible.sync="dialogFormVisible"
      :show-close="false"
      title="上传链接">
      <el-form :model="form">
        <el-form-item label="图标地址">
          <el-input
            v-model="form.linkIco"
            auto-complete="off"/>
        </el-form-item>
        <el-form-item label="链接名称">
          <el-input
            v-model="form.linkName"
            auto-complete="off"/>
        </el-form-item>
        <el-form-item label="链接地址">
          <el-input
            v-model="form.linkToSrc"
            auto-complete="off"/>
        </el-form-item>
      </el-form>
      <div
        slot="footer"
        class="dialog-footer">
        <el-button
          :disabled="!form.linkIco.trim() || !form.linkName.trim() || !form.linkToSrc.trim()"
          type="primary"
          @click="pushGroup()">保存</el-button>
        <el-button @click="esc()">取 消</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dialogFormVisible: false,
      form: {
        linkIco: '',
        linkName: '',
        linkToSrc: '',
      },
    };
  },
  methods: {
    show() {
      this.dialogFormVisible = true;
    },
    esc() {
      this.form.linkIco = '';
      this.form.linkName = '';
      this.form.linkToSrc = '';
      this.dialogFormVisible = false;
    },
    pushGroup() {
      const user = this.$store.state.user;
      const data = {
        userId: user.userId,
        groupId: user.key,
        linkIco: this.form.linkIco.trim(),
        linkName: this.form.linkName.trim(),
        linkToSrc: this.form.linkToSrc.trim(),
      };
      this.$store.dispatch('pushGroup', data);
      this.$message({
        message: '提交成功 !',
        type: 'success',
      });
      this.form.linkIco = '';
      this.form.linkName = '';
      this.form.linkToSrc = '';
      this.dialogFormVisible = false;
    },
  },
};
</script>
<style lang="less">
    .update {
        .el-dialog {
            width: 30%;
            min-width: 400px;
        }
        .el-dialog__body {
            padding: 50px 40px;
        }
        .dialog-footer {
            .el-button {
                width: 30%;
            }
        }
    }
</style>
