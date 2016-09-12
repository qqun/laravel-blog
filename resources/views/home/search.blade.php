@extends('../blog')

@section('content')
    @include('../home/header')
    <div class="row bottom"></div>


    <div class="container">

        <div class="row">
            <div class="col-md-8">

                <div class="list-style">

                    <div class="title"><i class="fa fa-fw fa-home"></i>文章搜索关键字:{{ $key }}</div>
                </div>


                @if( count($data) >0 )
                    @foreach($data as $a)
                        <article class="list-single">


                            <div class="time">{{ $a->created_at->diffForHumans() }}</div>
                            <h2 class="title"><a href="{{ url('article/'.$a->id) }}">{{ $a->title }}</a></h2>

                            <div class="list-desc">{{ $a->description }}</div>
                            <div class="blog-footer list-block">
                                <div class="blog-footer-content blog-btn">
                                    <a href="{{ url('article/'.$a->id) }}" class="read-more-btn">Read More</a>
                                </div>
                                <div class="blog-footer-content post-comment-meta">
                                    <span class="comments-no"><i class="fa fa-eye"></i> {{ $a->hits }}</span>
                                    <span class="post-impress"><i class="fa fa-heart"></i> {{ $a->heart }}</span>
                                </div>
                            </div>

                        </article>
                    @endforeach
                    <div class="text-center pagination-area">
                        <?php echo $data->render(); ?>
                    </div>

                @else

                    <article class="list-single">
                        暂无信息
                    </article>

                @endif

            </div>
            <div class="col-md-4">
                @include('../home/right')
            </div>


        </div>
    </div>
@endsection




