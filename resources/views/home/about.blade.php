@extends('../blog')

@section('content')
    @include('../home/header')
    <div class="row bottom"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">


                <div class="article-body">
                    <h1 class="title">About</h1>
                    <hr>
                    <div class="user-thumb text-center">
                    <img src="{{ $user->avatar }}">
                    </div>
                    <p>{!! $user->remark !!}</p>

                    <div class="article-footer">
                        Contact: {{ $user->email }}
                    </div>

                    <div class="article-share">
                        <div class="social-share" data-mobile-sites="weibo,qq,qzone,tencent"
                             data-disabled="google,twitter,facebook"></div>
                    </div>


                </div>

            </div>
            <div class="col-md-4">
                @include('../home/right')
            </div>




        </div>
    </div>
@endsection




