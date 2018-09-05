<template>
  <div
    v-if="bgList.length"
    :style="{backgroundImage: `url(${bgList[bgNum].imgSrc})`}"
    class="app"
    @click.self="optionHidden()">
    <Page/>
    <Option
      v-if="optionShow"
      :changeBg="changeBg"/>
    <div
      v-if="!optionShow"
      class="app_btn"
      @click="optionShow = true"><i class="iconfont icon-shezhi"/></div>
    <p class="app_msg">本系列图片均来自网络，如有侵权，请联系作者删除。</p>
  </div>
</template>
<script>
import Page from './views/Page/Page.vue';
import Option from './views/Option/Option.vue';
import {reqBgImg, reqUser} from './api';
export default {
  components: {
    Page,
    Option,
  },
  data() {
    return {
      optionShow: false,
      bgList: [],
      bgNum: 0,
    };
  },
  methods: {
    optionHidden() {
      this.optionShow = false;
    },
    changeBg() {
      if (this.bgNum + 2 === this.bgList.length) {
        console.log('1');
        reqBgImg('/getRandomScreensaver.php').then(res => {
          if (res.resCode === 1) {
            for (let i of res.resData.dataList) {
              this.bgList.push(i);
            }
          } else {
            console.log('增加背景图失败');
          }
        });
      }
      this.bgNum++;
    },
  },
  mounted() {
    reqBgImg('/getRandomScreensaver.php').then(res => {
      if (res.resCode === 1) {
        this.bgList = res.resData.dataList;
      } else {
        console.log('获取背景图失败');
      }
    });
    if (window.localStorage.boring) {
      const user = JSON.parse(window.localStorage.boring);
      const URL = '/usersLogin.php';
      reqUser(URL, user).then(res => {
        if (res.resCode === 1) {
          this.$store.state.user = res.resData;
          this.$store.dispatch('getSaveList', {userId: res.resData.userId});
        } else {
          window.localStorage.boring = '';
        }
      });
    }
  },
};
</script>
<style lang="less">
    @import "../static/css/reset.css";
    @import "../static/css/swiper.css";
    @import "https://at.alicdn.com/t/font_816720_qcop362k3ec.css";
    .app {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100vw;
        height: 100vh;
        min-width: 1280px;
        min-height: 720px;
        background: no-repeat center center;
        background-size: 100% 100%;
    }
    .app_msg {
        position: absolute;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%);
        color: #333;
    }
    .app_btn {
        display: inline-block;
        position: absolute;
        top: 20px;
        right: 30px;
        .icon-shezhi {
            color: #40A9FF;
            font-size: 48px;
        }
    }
</style>
