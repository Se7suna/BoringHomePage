<template>
  <div class="page">
    <Search/>
    <div
      v-if="pageSort.length"
      class="swiper-container">
      <div class="swiper-wrapper">
        <ul
          v-for="(list, index) of pageSort"
          :key="index"
          class="swiper-slide page_ul">
          <li
            v-for="i of list"
            :key="i.id"
            class="page_ul_item"
            @click="link(i.shareLinkSrc)">
            <div :style="{backgroundImage: `url(${i.shareLinkIcoScr})`}"/>
            <p>{{ i.shareLinkName }}</p>
          </li>
        </ul>
      </div>
      <!-- 如果需要分页器 -->
      <div class="swiper-pagination"/>
    </div>
  </div>
</template>
<script>
import Swiper from 'swiper';
import Search from '../../components/Search/Search.vue';
export default {
  components: {
    Search,
  },
  computed: {
    pageSort() {
      const list = this.$store.state.user.linkOfUser;
      if (list) {
        let res = [];
        let item = [];
        for (let i = 0, len = list.length; i < len; i++) {
          item.push(list[i]);
          if (item.length === 10) {
            res.push(item);
            item = [];
          } else if (i + 1 === len) {
            res.push(item);
          }
        }
        return res;
      }
    },
  },
  watch: {
    pageSort: function() {
      this.$nextTick(() => {
        new Swiper('.swiper-container', {
          loop: true,
          // 分页器
          pagination: {
            el: '.swiper-pagination',
          },
        });
      });
    },
  },
  methods: {
    link(url) {
      window.location.href = url;
    },
  },
};
</script>
<style lang="less">
    .page {
        margin-top: -5vmax
    }
    .swiper-container {
        width: 50vmax;
        height: 24vmax;
        margin: 0 auto;
    }
    .page_ul {
        display: flex;
        flex-flow: wrap;
    }
    .page_ul_item {
        display: flex;
        flex-flow: column;
        width: 6vmax;
        height: 12vmax;
        margin: 0 2vmax;
        div {
            width: 6vmax;
            height: 6vmax;
            background: no-repeat center center;
            background-size: 100% 100%;
            border-radius: 50%;
        }
        p {
            margin-top: 1vmax;
            text-align: center;
        }
    }
</style>
