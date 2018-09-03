<template>
    <div class="app">
        <Page/>
    </div>
</template>
<script>
    import Page from './views/Page/Page.vue'
    export default {
        components: {
            Page
        }
    }
</script>
<style lang="less">
    @import '../static/css/reset.css';
    @import '../static/css/swiper.css';
    html,
    body {
        width: 100%;
        height: 100%;
    }
    .app {
        width: 100%;
        height: 100%;
        background: url(../static/img/timg.jpg) no-repeat center center;
        background-size: 100% 100%;
    }
</style>
