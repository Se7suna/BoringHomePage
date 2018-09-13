<template>
  <div class="alert">
    <el-dialog
      :visible.sync="dialogFormVisible"
      :show-close="false"
      title="修改链接">
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
          :disabled="!form.linkToSrc"
          type="primary"
          @click="editLink()">更新</el-button>
        <el-button
          type="danger"
          @click="deleteLink()">删除</el-button>
        <el-button @click="esc()">取 消</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
export default {
  data() {
    return {
      groupId: '',
      dialogFormVisible: false,
      linkId: 0,
      form: {
        linkIco: '',
        linkName: '',
        linkToSrc: '',
      },
    };
  },
  methods: {
    show(item) {
      this.dialogFormVisible = true;
      this.form.linkIco = item.shareLinkIcoScr;
      this.form.linkName = item.shareLinkName;
      this.form.linkToSrc = item.shareLinkSrc;
      this.linkId = item.id;
    },
    esc() {
      this.form.linkIco = '';
      this.form.linkName = '';
      this.form.linkToSrc = '';
      this.dialogFormVisible = false;
      this.linkId = 0;
    },
    editLink() {
      const data = {
        linkId: this.linkId,
        linkIco: this.form.linkIco.trim(),
        linkToSrc: this.form.linkToSrc.trim(),
        linkName: this.form.linkName.trim(),
      };
      this.$store.dispatch('updateLink', data).then(resolve => {
        if (resolve) {
          this.$message({
            message: '更新成功!',
            type: 'success',
          });
          this.esc();
        } else {
          this.$message({
            message: '更新失败, 请重试 !',
            type: 'error',
          });
        }
      }).catch(reject => {
        console.log('后端还没写该接口', reject);
      });
    },
    deleteLink() {
      this.$confirm('此操作将删除该链接, 是否继续?', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning',
      }).then(() => {
        const data = {
          userId: this.$store.state.user.userId,
          id: this.linkId,
        };
        this.$store.dispatch('deleteItem', data).then(resolve => {
          if (resolve) {
            this.$message({
              type: 'success',
              message: '删除成功 !',
            });
            this.esc();
          } else {
            this.$message({
              message: '删除失败, 请重试 !',
              type: 'error',
            });
          }
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消 !',
        });
      });
    },
  },
};
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
        .dialog-footer {
            .el-button {
                width: 20%;
            }
        }
    }
</style>
