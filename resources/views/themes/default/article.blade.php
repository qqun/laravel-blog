@extends('themes.default.layouts')

@section('content')
    @include('themes.default.header')
    <div class="row bottom"></div>


    <div class="container">


        <div class="row article-detail">
            <div class="col-md-8">
                <div class="article-body">
                    <h1 class="title">{{ $article->title }}</h1>
                    <h6>
                        <span><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                            {{ $article->created_at->format('Y-m-d') }}</span>
                        @inject('homePresenter', '\App\Presenters\HomePresenter')
                        {!! $homePresenter->showTags($article) !!}
                    </h6>
                    <hr>
                    <p>{!! $article->content !!}</p>

                    <div class="article-footer">
                        <div class="article-like">
                            <i class="fa fa-fw fa-thumbs-up fa-3x" id="like" data-id="{{ $article->id }}"></i>
                        </div>
                    </div>

                    <div class="article-share">
                        <div class="social-share" data-mobile-sites="weibo,qq,qzone,tencent"
                             data-disabled="google,twitter,facebook"></div>
                    </div>

                    <div class="article-related">
                        @if($next['next'])
                            <span>上一篇: <a
                                        href="{{ url('article/'.$next['next']->id) }}"> {{$next['next']->title}}</a> </span>
                        @endif
                        @if($next['previous'])
                            <span>下一篇: <a
                                        href="{{ url('article/'.$next['previous']->id) }}"> {{$next['previous']->title}}</a></span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @include('themes.default.article_right')
            </div>


        </div>
    </div>
    @include('themes.default.footer')

    <script type="text/javascript">
        $('#like').on('click', function () {
            var id = $(this).data('id');
            var url = "{{ url('/article/') }}";
            console.log(id);
            $.get(url + '/' + id, {type: 'like'}, function (data) {
                if (data.status == 0) {
                    console.log('操作完成');

                } else {
                    console.log('操作失败，请联系管理员');
                }
            });

        });
    </script>
    <!-- share.css -->
    <link rel="stylesheet" href="/assets/blog/plugins/share/css/share.min.css">
    <!-- share.js -->
    <script src="/assets/blog/plugins/share/js/social-share.min.js"></script>
@endsection




