<template>
  <div class="addLink">
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
        <el-form-item label="链接地址(必填)">
          <el-input
            v-model="form.linkToSrc"
            auto-complete="off"/>
        </el-form-item>
      </el-form>
      <div
        slot="footer"
        class="dialog-footer">
        <el-button
          :disabled="!form.linkToSrc.trim()"
          type="primary"
          @click="addLink()">保存</el-button>
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
    addLink() {
      // hashList[0], 为多群组功能预留
      const data = {
        groupId: this.$store.state.hashList[0].groupId,
        userId: this.$store.state.user.userId,
        shareLinkSrc: this.form.linkToSrc.trim(),
      };
      this.$store.dispatch('addLink', data).then(resolve => {
        if (resolve) {
          this.$message({
            message: '添加成功, 请等待群组审核 !',
            type: 'success',
          });
          this.esc();
        } else {
          this.$message({
            message: '添加失败, 请重试 !',
            type: 'error',
          });
        }
      });
    },
  },
};
</script>
<style lang="less">
    .addLink {
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
