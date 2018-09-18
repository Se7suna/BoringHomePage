<template>
  <div class="option">
    <el-tabs v-model="activeName">
      <el-tab-pane
        label="收藏夹"
        name="first">
        <ul>
          <template v-if="$store.state.user.linkOfUser">
            <li
              v-for="i of $store.state.user.linkOfUser"
              :key="i.id"
              class="option_item"
              @click="editLink(i)">
              <img :src="i.shareLinkIcoScr">
              <p>{{ i.shareLinkName }}</p>
              <p>{{ i.shareLinkSrc }}</p>
            </li>
          </template>
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
            <p
              v-if="$store.state.hashList.length"
              class ="hash">
              {{ $store.state.hashList[0].groupId }}
            </p>
            <div
              v-if="!$store.state.hashList.length && $store.state.user.userId"
              class="new">
              <el-button
                type="primary"
                @click="newGroup()">创建群组</el-button>
            </div>
            <div
              v-if="$store.state.hashList.length"
              class="push">
              <el-button
                type="primary"
                @click="showAddLink()">上传链接</el-button>
            </div>
            <div
              v-if="!$store.state.hashList.length && $store.state.user.userId"
              class="join">
              <el-button
                type="primary"
                @click="joinGroup()">加入群组</el-button>
            </div>
            <div
              v-if="$store.state.hashList.length"
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
              v-if="$store.getters.isMaster"
              class="list">
              <li
                v-for="i of $store.state.linkList"
                :key="i.id"
                class="option_item">
                <img :src="i.shareLinkIcoScr">
                <p class="top">{{ i.shareLinkName }}</p>
                <p class="mid">{{ i.shareLinkSrc }}</p>
                <!-- <p class="bot"></p> -->
                <el-button
                  type="success"
                  @click="agree(i)">同意</el-button>
                <el-button
                  type="danger"
                  @click="reject(i)">拒绝</el-button>
              </li>
            </ul>
          </div>
        </ul>
      </el-tab-pane>
    </el-tabs>
    <div class="option_btn">
      <el-button
        v-if="!$store.state.user.userId"
        type="success"
        @click="showLogin()">注册 / 登录</el-button>
      <el-button
        v-else
        type="danger"
        @click="logOut()">注销</el-button>
    </div>
    <EditLink ref="editLink"/>
    <Login ref="login"/>
    <AddLink ref="addLink"/>
  </div>
</template>
<script>
import EditLink from '../../components/EditLink/EditLink.vue';
import Login from '../../components/Login/Login.vue';
import AddLink from '../../components/AddLink/AddLink.vue';
export default {
  components: {
    EditLink,
    Login,
    AddLink,
  },
  props: {
    changeBg: {
      type: Function,
      default: null,
    },
  },
  computed: {
    loginMsg() {
      const state = this.$store.state;
      if (!state.user.userId) {
        return '状态: 未登录, 请登录!';
      }
      if (state.hashList.length) {
        return this.$store.getters.isMaster ? '状态: 群主登录' : '状态: 群员登录';
      } else {
        return '状态: 暂未加入群组';
      }
    },
    colorShow() {
      return this.$store.state.hashList.length;
    },
  },
  data() {
    return {
      activeName: 'first',
      user: '',
    };
  },
  methods: {
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
        window.localStorage.boring = '';
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
    editLink(item) {
      if (this.$store.getters.isMaster) {
        this.$refs.editLink.show(item);
      }
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
      const userId = {
        userId: this.$store.state.user.userId,
      };
      this.$store.dispatch('newGroup', userId).then(resolve => {
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
      });
    },
    joinGroup() {
      this.$prompt('请输入群组hash', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        inputPattern: /^\w{32,32}$/,
        inputErrorMessage: 'hash格式不正确',
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
              message: '加入失败, 请确认hash !',
              type: 'error',
            });
          }
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '取消 !',
        });
      });
    },
    showAddLink() {
      this.$refs.addLink.show();
    },
    agree(item) {
      const data = {
        id: item.id,
        shareLinkState: 1,
      };
      this.$store.dispatch('updataLink', data).then(resolve => {
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
      });
    },
    reject(item) {
      this.$confirm('确认拒绝该请求?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning',
      }).then(() => {
        const data = {
          id: item.id,
          shareLinkState: 0,
        };
        this.$store.dispatch('updataLink', data).then(resolve => {
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
        background-color: #eee;
        .el-tabs {
            height: 92%;
        }
        .el-tabs__nav-scroll,
        .el-tabs__nav-wrap{
          height: 100%;
        }
        .el-tabs__header {
          height: 8%;
          margin: 0;
        }
        .el-tabs__content {
            height: 92%;
            .show {
                color: #67C23A
            }
        }
        .el-tabs__nav{
            width: 100%;
            height: 100%;
            background-color: #fff;
        }
        .el-tabs__active-bar {
            width: 50% !important
        }
        .el-tabs__item{
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            width: 50%;
            vertical-align: middle;
            text-align: center;
            font-size: 22px;
            font-weight: 800;
            padding: 0;
        }
        .el-tab-pane {
            padding: 8% 6.5% 0;
            height: 100%;
            overflow: auto;
        }
        .el-button {
          text-align: center;
          padding-left: 0;
          padding-right: 0;
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
        height: 8%;
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
        .hash {
            word-wrap: break-word;
            border: 1px solid #999;
            color: #666;
            background-color: #fff;
            padding: 10px;
            border-radius: 3px;
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
