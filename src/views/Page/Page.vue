<template>
    <div class="page">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <ul class="swiper-slide page_ul">
                    <li class="page_ul_item">
                        <div></div>
                        <p>24℃</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>待办事项</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>笔记</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>历史记录</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>书签</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>5xx</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>天猫</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>京东</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>携程</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>严选</p>
                    </li>
                </ul>
                <ul class="swiper-slide page_ul">
                    <li class="page_ul_item">
                        <div></div>
                        <p>24℃</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>待办事项</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>笔记</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>历史记录</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>书签</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>5xx</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>天猫</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>京东</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>携程</p>
                    </li>
                    <li class="page_ul_item">
                        <div></div>
                        <p>严选</p>
                    </li>
                </ul>
            </div>
            <!-- 如果需要分页器 -->
            <div class="swiper-pagination"></div>
        </div>
        <p class="page_msg">本系列图片均来自网络，如有侵权，请联系作者删除。</p>
    </div>
</template>
<script>
    import Swiper from 'swiper'
    export default {
        mounted () {
        new Swiper('.swiper-container', {
            loop: true,
            // 分页器
            pagination: {
                el: '.swiper-pagination'
                }
            })
        }
    }
</script>
<style lang="less">
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
            background-color: pink;
            border-radius: 50%;
        }
        p {
            margin-top: 1vmax;
            text-align: center;
        }
    }
    .page_msg {
        position: absolute;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%);
        color: #333;
    }
</style>
