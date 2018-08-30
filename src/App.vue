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
    .app {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100vw;
        height: 100vh;
        min-width: 1280px;
        min-height: 720px;
        background: #eee url(../static/img/timg.jpg) no-repeat center center;
    }

</style>
