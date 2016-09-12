<div class="sidebar">

    <!-- search -->
    <div class="widget widget-search">
        <input type="text" name="keyword" value="" class="search_box">
        <button class="search_btn"><i class="fa fa-fw fa-search fa-1x" aria-hidden="true"></i></button>
    </div><!-- /.widget -->

    <!-- widget categories -->
    @if( count($category)>0 )
        <div class="widget widget_categories">
            <div class="widget-title">
                <h5>CATEGORIES</h5>
            </div>
            <ul>
                @foreach($category as $c)
                    <li class="categorie-item">
                        <a href="{{ url('category/'.$c->id) }}">{{ $c->title }}</a>
                        <span>15</span>
                        <div class="clearfix"></div>
                    </li>
                @endforeach

            </ul>
        </div><!-- /.widget -->
        @endif


                <!-- widget recent-stories -->
        @if( count($artHot)>0 )
            <div class="widget widget_recent_stories">
                <div class="widget-title">
                    <h5>Hot Article</h5>
                </div>
                <ul>
                    @foreach($artHot as $a)
                        <li>
                            @if( !empty($a->thumb) )
                                <div class="widget-img">
                                    <a href="{{ url('article/'.$a->id) }}">
                                        <img src="{{ $a->thumb }}" alt="image">
                                        <div class="widget-overlay"></div>
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @endif
                            <div class="widget-content">
                                <h5><a href="{{ url('article/'.$a->id) }}">{{ $a->title }}</a></h5>
                                <span>{{ $a->created_at->format('d M Y') }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div><!-- /.widget -->
            @endif

                    <!-- widget instagram -->
            <div class="widget widget_instagram none">
                <div class="widget-title">
                    <h5>INSTAGRAM</h5>
                </div>
                <ul>
                    <li><a href="#"><img src="#" alt="image"></a></li>
                    <li><a href="#"><img src="#" alt="image"></a></li>
                    <li><a href="#"><img src="#" alt="image"></a></li>
                    <li><a href="#"><img src="#" alt="image"></a></li>
                    <li><a href="#"><img src="#" alt="image"></a></li>
                    <li><a href="#"><img src="#" alt="image"></a></li>

                </ul>
            </div>



            <!-- widget tags -->
            @if( count($tags)>0 )
                <div class="widget widget_tags ">
                    <div class="widget-title">
                        <h5>TAG CLOUD</h5>
                    </div>
                    <ul>
                        @foreach($tags as $t)
                            <li><a href="{{ url('search/tag',['tag'=>urlencode($t->name)]) }}">{{ $t->name }}
                                    ({{ $t->number }})</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif


                        <!-- widget links -->
                @if( count($links)>0 )
                    <div class="widget widget_recent_stories">
                        <div class="widget-title">
                            <h5>Links</h5>
                        </div>
                        <ul>
                            @foreach($links as $l)
                                <li><a href="{{ $l->url }}" target="_blank">{{ $l->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="widget widget_link">
                    <a href="{{ url('/rss') }}"> <i class="fa fa-fw fa-rss fa-3x" aria-hidden="true"></i></a>
                    <a href="#"> <i class="fa fa-fw fa-weibo fa-3x" aria-hidden="true"></i></a>
                    <a href="#"> <i class="fa fa-fw fa-wechat fa-3x" aria-hidden="true"></i></a>
                </div>

</div>


<script type="text/javascript">
    $('.search_btn').on('click', function () {
        var key = $('.search_box').val();
        console.log(key);
        window.location.href = "{{ url('search/keyword') }}/" + key;
    });
</script>




