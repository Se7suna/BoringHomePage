<template>
  <div class="option">
    <el-tabs v-model="activeName">
      <el-tab-pane
        label="收藏夹"
        name="first">
        <ul>
          <template v-if="this.$store.state.saveList">
            <li
              v-for="i of this.$store.state.saveList.dataList"
              :key="i.linkId"
              class="option_item"
              @click="editLink(i.linkId)">
              <img :src="i.linkIco">
              <p>{{ i.linkName }}</p>
              <p>{{ i.linkToSrc }}</p>
            </li>
          </template>
          <div
            v-if="$store.state.user.id"
            class="option_add">
            <el-button
              round
              @click="showAlert()">
              <i class="el-icon-plus"/>
            </el-button>
          </div>
          <p
            v-else
            class="option_hint">请登录获取网络收藏夹</p>
        </ul>
      </el-tab-pane>
      <el-tab-pane
        label="设置"
        name="second">
        <ul>
          <div class="option_fun">
            <p
              :class="{show: colorShow}"
              class="msg">{{ loginMsg }}</p>
            <div
              v-if="!this.$store.state.user.key"
              class="new">
              <el-button
                :disabled="!$store.state.user.id"
                type="primary"
                @click="newGroup()">创建群组</el-button>
            </div>
            <div
              v-else
              class="push">
              <el-button
                type="primary"
                @click="showUpdate()">上传链接</el-button>
            </div>
            <div
              v-if="!this.$store.state.user.key"
              class="join">
              <el-button
                :disabled="!$store.state.user.id"
                type="primary"
                @click="joinGroup()">加入群组</el-button>
            </div>
            <div
              v-else
              class="quit">
              <el-button
                type="danger"
                @click="quitGroup()">退出群组</el-button>
            </div>
            <div class="change">
              <el-button
                type="info"
                plain
                @click="changeBg()">更换背景</el-button>
            </div>
            <ul
              v-if="$store.state.user.push"
              class="list">
              <li
                v-for="i of $store.state.user.push"
                :key="i.linkId"
                class="option_item">
                <img :src="i.linkIco">
                <p class="top">{{ i.linkName }}</p>
                <p class="mid">{{ i.linkToSrc }}</p>
                <!-- <p class="bot"></p> -->
                <el-button
                  type="success"
                  @click="agree(i.linkId)">同意</el-button>
                <el-button
                  type="danger"
                  @click="reject(i.linkId)">拒绝</el-button>
              </li>
            </ul>
          </div>
        </ul>
      </el-tab-pane>
    </el-tabs>
    <div class="option_btn">
      <el-button
        v-if="!$store.state.user.id"
        type="success"
        @click="showLogin()">注册 / 登录</el-button>
      <el-button
        v-else
        type="danger"
        @click="logOut()">注销</el-button>
    </div>
    <Alert ref="alert"/>
    <Login ref="login"/>
    <Update ref="update"/>
  </div>
</template>
<script>
import Alert from '../../components/Alert/Alert.vue';
import Login from '../../components/Login/Login.vue';
import Update from '../../components/Update/Update.vue';
export default {
  components: {
    Alert,
    Login,
    Update,
  },
  props: {
    changeBg: {
      type: Function,
      default: null,
    },
  },
  computed: {
    loginMsg() {
      const user = this.$store.state.user;
      if (!user.id) {
        return '状态: 未登录, 请登录!';
      } else {
        if (user.key) {
          return `状态: 已加入 ${user.key}`;
        } else {
          return '状态: 暂未加入群组';
        }
      }
    },
    colorShow() {
      return this.$store.state.user.key;
    },
  },
  data() {
    return {
      activeName: 'first',
      user: '',
    };
  },
  methods: {
    showAlert() {
      this.$refs.alert.show();
    },
    showLogin() {
      this.$refs.login.show();
    },
    logOut() {
      this.$confirm('确认退出? (退出后将不能获取您的网络收藏夹)', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning',
      }).then(() => {
        this.$store.dispatch('logOut');
        this.$message({
          type: 'success',
          message: '退出成功!',
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消',
        });
      });
    },
    editLink(id) {
      this.$refs.alert.show(id);
    },
    quitGroup() {
      this.$confirm('此操作将退出该群组, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning',
      }).then(() => {
        const data = {
          userId: this.$store.state.user.userId,
        };
        this.$store.dispatch('quitGroup', data).then(resolve => {
          if (resolve) {
            this.$message({
              type: 'success',
              message: '退出成功!',
            });
          } else {
            this.$message({
              message: '退出失败, 请重试 !',
              type: 'error',
            });
          }
        }).catch(reject => {
          console.log(reject);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消!',
        });
      });
    },
    newGroup() {
      const data = {
        userId: this.$store.state.user.userId,
      };
      this.$store.dispatch('newGroup', data).then(resolve => {
        if (resolve) {
          this.$message({
            type: 'success',
            message: '创建成功 !',
          });
        } else {
          this.$message({
            message: '创建失败, 请重试 !',
            type: 'error',
          });
        }
      }).catch(reject => {
        console.log(reject);
      });
    },
    joinGroup() {
      this.$prompt('请输入群组6位数字邀请key', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        inputPattern: /^\d{6,6}$/,
        inputErrorMessage: 'key格式不正确',
      }).then(({value}) => {
        const data = {
          userId: this.$store.state.user.userId,
          hash: value,
        };
        this.$store.dispatch('joinGroup', data).then(resolve => {
          if (resolve) {
            this.$message({
              type: 'success',
              message: `加入${value}成功!`,
            });
          } else {
            this.$message({
              message: '加入失败, 请确认key !',
              type: 'error',
            });
          }
        }).catch(reject => {
          console.log(reject);
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '取消 !',
        });
      });
    },
    showUpdate() {
      this.$refs.update.show();
    },
    agree(linkId) {
      const data = {
        userId: this.$store.state.user.userId,
        linkId,
      };
      this.$store.dispatch('agree', data).then(resolve => {
        if (resolve) {
          this.$message({
            type: 'success',
            message: '已接受 !',
          });
        } else {
          this.$message({
            message: '接受失败, 请重试 !',
            type: 'error',
          });
        }
      }).catch(reject => {
        console.log(reject);
      });
    },
    reject(linkId) {
      this.$confirm('确认拒绝该请求?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning',
      }).then(() => {
        const data = {
          userId: this.$store.state.user.userId,
          linkId,
        };
        this.$store.dispatch('reject', data).then(resolve => {
          if (resolve) {
            this.$message({
              type: 'success',
              message: '已拒绝该请求 !',
            });
          } else {
            this.$message({
              message: '操作失败, 请重试 !',
              type: 'error',
            });
          }
        }).catch(reject => {
          console.log(reject);
        });

      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消 !',
        });
      });
    },
  },
  mounted() {
    if (window.localStorage.boring) {
      this.user = JSON.parse(window.localStorage.boring);
    }
  },
};
</script>
<style lang="less">
    .option {
        position: absolute;
        top: 0;
        right: 0;
        width: 15%;
        height: 100%;
        padding-bottom: 8%;
        background-color: #eee;
        .el-tabs {
            height: 100%;
        }
        .el-tabs__content {
            height: 100%;
            .show {
                color: #67C23A
            }
        }
        .el-tabs__nav{
            width: 100%;
            height: 80px;
            background-color: #fff;
            padding: 20px;
        }
        .el-tabs__active-bar {
            width: 50% !important
        }
        .el-tabs__item{
            width: 50%;
            text-align: center;
            font-size: 22px;
            font-weight: 800;
        }
        .el-tab-pane {
            padding: 5% 6.5% 0;
            height: 100%;
            overflow: auto;
            ul {
                padding-bottom: 8vh;
            }
        }

    }
    .option_item {
        text-align: center;
        background-color: #fff;
        padding: 8%;
        margin-bottom: 8%;
        img {
            width: 100%;
            height: 80%;
        }
        p {
            color: #303133;;
            margin-top: 4%
        }
    }
    .option_add {
        display: flex;
        justify-content: center;
        i {
            padding: 5px;
            font-size: 22px;
            font-weight: 800;
        }
        // padding-bottom: 6%;
    }
    .option_hint {
        color: #606266;
       margin-top: 30vh;
        text-align: center;
    }
    .option_btn {
        display: flex;
        justify-content: center;
        position: absolute;
        width: 100%;
        height: 8vh;
        bottom: 0;
        left: 0;
        text-align: center;
        background-color: #fff;
        padding: 6%;
        button {
            width: 100%;
        }
    }
    .option_fun {
        p,
        div,
        ul {
            margin-bottom: 8%;
            .el-button {
                width: 100%;
            }
        }
        .msg {
            text-align: center;
            color: #333;
            background-color: #fff;
            border-radius: 5px;
            padding: 8% 0;
        }
        .list {
            .el-button {
                width: 44%;
            }
            .top {
                font-weight: 800;
                color: #303133;
            }
            .mid {
                color: #606266;
            }
            .bot {
                color: #909399
            }
        }
    }
</style>
