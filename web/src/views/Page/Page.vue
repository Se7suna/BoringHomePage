<template>
    <div class="swiper-container page">
        <div class="swiper-wrapper">
            <ul class="swiper-slide page_ul">
                <li class="page_ul_item">
                    <div></div>
                    <p>24℃</p>
                </li>
            </ul>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
</template>
<script>
    import Swiper from 'swiper'
    export default {
        mounted () {
            setTimeout(() => {
                new Swiper('.swiper-container', {
                    loop: true,
                    // 如果需要分页器
                    pagination: {
                        el: '.swiper-pagination'
                    }
                })
            }, 1000)
        }
    }
</script>
<style lang="less">
    .page_ul {
        vertical-align: middle;
        width: 1335px;
        height: 364px;
        margin: 0 auto;
    }
    .page_ul_item {
        div {
            width: 150px;
            height: 150px;
            background-color: pink;
            border-radius: 50%;
        }
        p {
            margin-top: 18px;
        }
    }
</style>
