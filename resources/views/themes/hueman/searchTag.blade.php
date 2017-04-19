@extends('themes.hueman.layouts')

@section('content')
<body class="home blog col-3cm full-width chrome">
<div id="wrapper">

@include('themes.hueman.header')


<div class="container" id="page">
        <div class="container-inner">
            <div class="main">
                <div class="main-inner group">
                    <section class="content" style="overflow: hidden;">

                        <div class="page-title pad group">

                            <h2><i class="fa fa-fw fa-home"></i>Tags 搜索 :{{ $tag }}</h2>


                        </div><!--/.page-title-->


                        <div class="pad group">




                            <div class="post-list group">

@if(count($data) >0)
<?php $item = 1; ?>
                                    @foreach($data as $a)
@if($item %2 == 1)
                                <div class="post-row">
@endif
                                    <article
                                             class="group post-1100 post type-post status-publish format-standard has-post-thumbnail hentry category-Note">
                                        <div class="post-inner post-hover">

                                            <div class="post-thumbnail">
                                                <a href="{{ url('article/'.$a->id) }}" title="{{ $a->title }}">
												@if($a->thumb)
												<img src="{{ $a->thumb }}" />
												@else
												<img src="/theme/hueman/img/thumb-medium.png" />
												@endif
                                                </a>
                                            </div><!--/.post-thumbnail-->

                                            <div class="post-meta group">
                                                <p class="post-category"><a href="http://www.poloo.org/?cat=5"
                                                                            rel="category">Note</a></p>
                                                <p class="post-date">{{ $a->created_at->diffForHumans() }}</p>
                                            </div><!--/.post-meta-->

                                            <h2 class="post-title">
                                                <a href="{{ url('article/'.$a->id) }}" rel="bookmark"
                                                   title="{{ $a->title }}">{{ $a->title }}</a>
                                            </h2><!--/.post-title-->

                                            <div class="entry excerpt">
                                                <p>{{ $a->description }}</p>
                                            </div><!--/.entry-->

                                        </div><!--/.post-inner-->
                                    </article><!--/.post-->
@if($item %2 == 0 || $item == count($data))
</div>
@endif
<?php $item++; ?>
                                    @endforeach
@endif
                                <div class="post-row"></div>
                            </div><!--/.post-list-->



                            <nav class="pagination group">
                            </nav>


                        </div><!--/.pad-->


                        <script type="text/javascript">
                            /*640*60  2016/10/24*/
                            var cpro_id = "u2796545";
                        </script>
                        <script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>


                    </section><!--/.content-->


                    @include('themes.hueman.sidebar-l')
                    @include('themes.hueman.sidebar-r')


                </div><!--/.main-inner-->
            </div><!--/.main-->
        </div><!--/.container-inner-->
    </div><!--/.container-->







@include('themes.hueman.footer')
@endsection