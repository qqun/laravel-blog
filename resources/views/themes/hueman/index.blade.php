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

                            <h2>夏雪飘飞</h2>


                        </div><!--/.page-title-->


                        <div class="pad group">


                            <div class="featured none">
                                <article id="post-1123"
                                         class="group post-1123 post type-post status-publish format-standard has-post-thumbnail hentry category-DB category-Linux tag-mysql tag-ubuntu">
                                    <div class="post-inner post-hover">

                                        <div class="post-thumbnail">
                                            <a href="http://www.poloo.org/?p=1123" title="在Ubuntu下的MySQL更改数据库存储位置">
                                                <img width="720" height="340"
                                                     src="http://www.poloo.org/uploads//2017/03/mysql-720x340.jpeg"
                                                     class="attachment-thumb-large size-thumb-large wp-post-image"
                                                     alt="mysql"
                                                     srcset="http://www.poloo.org/uploads/2017/03/mysql-520x245.jpeg 520w, http://www.poloo.org/uploads/2017/03/mysql-720x340.jpeg 720w"
                                                     sizes="(max-width: 720px) 100vw, 720px"/> </a>
                                        </div><!--/.post-thumbnail-->

                                        <div class="post-meta group">
                                            <p class="post-category"><a href="http://www.poloo.org/?cat=9"
                                                                        rel="category">DB</a> / <a
                                                    href="http://www.poloo.org/?cat=17" rel="category">Linux</a></p>
                                            <p class="post-date">1 3月, 2017</p>
                                        </div><!--/.post-meta-->

                                        <h2 class="post-title">
                                            <a href="http://www.poloo.org/?p=1123" rel="bookmark"
                                               title="在Ubuntu下的MySQL更改数据库存储位置">在Ubuntu下的MySQL更改数据库存储位置</a>
                                        </h2><!--/.post-title-->

                                        <div class="entry excerpt">
                                            <p>系统版本：ubuntu 14 MySQL版本：5.7.14 数据库位&#46;&#46;&#46;</p>
                                        </div><!--/.entry-->

                                    </div><!--/.post-inner-->
                                </article><!--/.post-->
                            </div><!--/.featured-->


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
                            	<div class="wp-pagenavi"><span class="pages">总{{ $data->total() }}条记录</span></div>
                            	{!! with(new App\Foundations\Pagination\CustomerPresenter($data))->render() !!}
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