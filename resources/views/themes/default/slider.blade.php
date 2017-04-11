<script src="https://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.min.js"></script>
<link href="https://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">

<!-- slider start -->
<div class="slider-body none">
    <div class="container-fluid">
        <div class="row">
            <img src="/assets/blog/bg/single-2.jpg" alt="img" class="img-responsive">
        </div>
    </div>
</div>
<div class="swiper-container">
    <div class="swiper-wrapper">
        @foreach($thumb as $t)
            <div class="swiper-slide" style="margin:0 auto;background-image: url('{{ $t }}')"></div>
        @endforeach
    </div><!-- /.swiper-wrapper -->

    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>

    <!-- 如果需要导航按钮 -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- 如果需要滚动条 -->
    <div class="swiper-scrollbar"></div>

</div>
<!-- slider end -->
<script>
    var mySwiper = new Swiper('.swiper-container', {
        paginationClickable: '.swiper-pagination',
        loop: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false,
        spaceBetween: 30,
        effect: 'fade',
        slidesPerView: 'auto',
        centeredSlides: true,

        // 如果需要分页器
        pagination: '.swiper-pagination',

        // 如果需要前进后退按钮
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',

    })
</script>