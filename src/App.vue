<template>
    <div class="app">
        <Page/>
        <Option v-if="optionShow" :optionHidden="optionHidden"/>
        <div class="app_btn" v-if="!optionShow" @click="optionShow = true"><i class="iconfont icon-shezhi"></i></div>
        <p class="app_msg">本系列图片均来自网络，如有侵权，请联系作者删除。</p>
    </div>
</template>
<script>
    import Page from './views/Page/Page.vue'
    import Option from './views/Option/Option.vue'
    export default {
        data () {
            return {
                optionShow: false
            }
        },
        methods: {
            optionHidden () {
                this.optionShow = false
            }
        },
        components: {
            Page,
            Option
        }
    }
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
        background: url(../static/img/timg.jpg) no-repeat center center;
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
