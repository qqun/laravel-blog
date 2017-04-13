@extends('themes.default.layouts')

@section('content')
@include('themes.default.header')
@include('themes.default.slider')


        <!-- main-wrapper start -->
<div class="main-wrapper">
    <div class="padding-80">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @if( count($data) >0)
                        @foreach($data as $a)
                            <article class="post-single post-style-1 post-without-masonary">
                                @inject('homePresenter', '\App\Presenters\HomePresenter')
                                {!! $homePresenter->indexThumb($a) !!}
                                <div class="post-wrapper-skw ps-rel">
                                    <div class="post-wrapper">

                                        <div class="post-title">
                                            <h2><a href="{{ url('article/'.$a->id) }}">{{ $a->title }}</a></h2>
                                        </div>
                                        <div class="post-meta-data">
                                            <div>
                                                @if($a->type==1)
                                                    <span class="label label-default">置顶</span>
                                                @endif
                                                <span class="post-date">
                                            <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                                                    {{ $a->created_at->diffForHumans() }}</span>

                                            <span class="post-category">
                                                <i class="fa fa-fw fa-folder" aria-hidden="true"></i><a
                                                        href="{{url('category/'.$a->cat_id)}}">{{ $a->cat_id }}</a></span>

                                            <span class="post-tags">
                                                <i class="fa fa-fw fa-tag" aria-hidden="true"></i>
                                                @foreach($a->getTags as $tag)<a
                                                        href="{{ url('search/tag',['tag'=>urlencode($tag->name)]) }}">{{ $tag->name }}</a> @endforeach
                                            </span>

                                            <span class="post-tags none">
                                                @foreach($a->getTags as $tag)<a href="">
                                                    <div class="label label-tag">
                                                        <i class="fa fa-fw fa-tag"
                                                           aria-hidden="true"></i>{{ $tag->name }}
                                                    </div>
                                                </a>@endforeach
                                            </span>

                                            <span class="comments-no">
                                                <i class="fa fa-eye"></i> {{ $a->hits }}</span>
                                            <span class="post-impress">
                                                <i class="fa fa-heart"></i> {{ $a->heart }}</span>

                                            </div>
                                        </div>

                                        <div class="post-entry">
                                            <p>{{ $a->description }}</p>
                                        </div>

                                        <div class="blog-footer">
                                            <div class="blog-footer-content blog-btn">
                                                <a href="{{ url('article/'.$a->id) }}" class="read-more-btn">Read
                                                    More</a>
                                            </div>

                                            <div class="blog-footer-content post-comment-meta none">
                                                <span class="comments-no"><i
                                                            class="fa fa-eye"></i> {{ $a->hits }}</span>
                                            <span class="post-impress"><i
                                                        class="fa fa-heart"></i> {{ $a->heart }}</span>
                                            </div>
                                        </div>
                                    </div><!-- /.post-wrapper -->
                                </div>
                            </article><!-- /.post-single -->

                        @endforeach

                        <div class="text-center pagination-area">
                            <?php echo $data->render(); ?>
                        </div><!-- /.pagination-area -->
                    @else
                        <article class="list-single">
                            还没有文章, 赶快去发表一篇吧.
                        </article>
                    @endif

                </div><!-- /.col-md-8 -->
                <div class="col-md-4">
                    @include('themes.default.right')
                </div><!-- /.col-md-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->

    </div>
</div>
<!-- main-wrapper end -->


@include('themes.default.footer')
@endsection
