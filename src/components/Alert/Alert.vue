<template>
  <div class="alert">
    <el-dialog
      :visible.sync="dialogFormVisible"
      :show-close="false"
      title="收藏夹">
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
          v-if="linkId"
          type="primary"
          :disabled="!form.linkToSrc"
          @click="updataLink()">更新</el-button>
        <el-button
          v-else
          type="primary"
          :disabled="!form.linkToSrc"
          @click="pushLink()">保存</el-button>
        <el-button
          v-if="linkId"
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
    show(linkId) {
      this.dialogFormVisible = true;
      if (linkId) {
        this.linkId = linkId;
        for (let i of this.$store.state.saveList.dataList) {
          if (i.linkId === linkId) {
            this.form.linkIco = i.linkIco;
            this.form.linkName = i.linkName;
            this.form.linkToSrc = i.linkToSrc;
            return;
          }
        }
      }
    },
    esc() {
      this.form.linkIco = '';
      this.form.linkName = '';
      this.form.linkToSrc = '';
      this.dialogFormVisible = false;
      this.linkId = 0;
    },
    pushLink() {
      const data = {
        linkIco: this.form.linkIco.trim(),
        linkName: this.form.linkName.trim(),
        linkToSrc: this.form.linkToSrc.trim(),
        userId: this.$store.state.user.userId,
      };
      this.$store.dispatch('addItem', data);
      this.$message({
        message: '添加成功 !',
        type: 'success',
      });
      this.dialogFormVisible = false;
    },
    updataLink() {
      const data = {
        linkId: this.linkId,
        linkIco: this.form.linkIco.trim(),
        linkToSrc: this.form.linkToSrc.trim(),
        linkName: this.form.linkName.trim(),
      };
      this.$store.dispatch('updateLink', data);
      this.$message({
        message: '更新成功!',
        type: 'success',
      });
      this.esc();
    },
    deleteLink() {
      this.$confirm('此操作将删除该链接, 是否继续?', '警告', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning',
      }).then(() => {
        const data = {};
        this.$store.dispatch('deleteItem', data);
        this.esc();
        this.$message({
          type: 'success',
          message: '删除成功 !',
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
                width: 30%;
            }
        }
    }
</style>
