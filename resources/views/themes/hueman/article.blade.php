@extends('themes.hueman.layouts')

@section('content')
<body class="single single-post postid-1123 single-format-standard col-2cr full-width chrome">
<div id="wrapper">

@include('themes.hueman.header')


<div class="container" id="page">
        <div class="container-inner">
            <div class="main">
                <div class="main-inner group">
                    <section class="content">

                        <div class="page-title pad group">

                            <ul class="meta-single group">
                                <li class="category"><a href="http://www.poloo.org/?cat=9" rel="category">DB</a>
                                    <span>/</span> <a href="http://www.poloo.org/?cat=17" rel="category">Linux</a></li>

                            </ul>


                        </div><!--/.page-title-->
                        <div class="pad group">

                            <article
                                    class="post-1123 post type-post status-publish format-standard has-post-thumbnail hentry category-DB category-Linux tag-mysql tag-ubuntu">
                                <div class="post-inner group">

                                    <h1 class="post-title">在Ubuntu下的MySQL更改数据库存储位置</h1>
                                    <p class="post-byline">
                                        <span class="post-tags">
                                        <span>Tags:</span> <a href="http://www.poloo.org/?tag=mysql" rel="tag">mysql</a><a
                                                href="http://www.poloo.org/?tag=ubuntu" rel="tag">ubuntu</a>
                                            </span>
                                        <span class="post-byline">
                                        by <a href="http://www.poloo.org/?author=1" title="由群群发布"
                                              rel="author">群群</a> &middot; 03/01/2017
                                            </span>
                                    </p>

                                    <div class="clear"></div>

                                    <div class="entry">
                                        <div class="entry-inner">
                                            <p class="p1">系统版本：ubuntu 14<br/>
                                                MySQL版本：5.7.14</p>
<pre class="brush:shell">数据库位置： /var/lib/mysql/

配置文件位置： /etc/mysql/mysql.conf.d/mysqld.cnf

服务脚本位置：/etc/init.d/mysql</pre>
                                            <p class="p1">Done</p>
                                        </div>
                                        <div class="clear"></div>
                                    </div><!--/.entry-->

                                </div><!--/.post-inner-->
                            </article><!--/.post-->

                            <div class="clear"></div>






                            <h4 class="heading">
                                <i class="fa fa-hand-o-right"></i>You may also like...</h4>

                            <ul class="related-posts group">

                                <li class="related post-hover">
                                    <article
                                            class="post-590 post type-post status-publish format-standard hentry category-Linux">

                                        <div class="post-thumbnail">
                                            <a href="http://www.poloo.org/?p=590"
                                               title="U盘 安装 CentOS 5.4 / Fefora 10/11/12">
                                                <img src="http://www.poloo.org/wp-content/themes/hueman/img/thumb-medium.png"
                                                     alt="U盘 安装 CentOS 5.4 / Fefora 10/11/12"/>
                                            </a>
                                        </div><!--/.post-thumbnail-->

                                        <div class="related-inner">

                                            <h4 class="post-title">
                                                <a href="http://www.poloo.org/?p=590" rel="bookmark"
                                                   title="U盘 安装 CentOS 5.4 / Fefora 10/11/12">U盘 安装 CentOS 5.4 / Fefora
                                                    10/11/12</a>
                                            </h4><!--/.post-title-->

                                            <div class="post-meta group">
                                                <p class="post-date">12 1月, 2011</p>
                                            </div><!--/.post-meta-->

                                        </div><!--/.related-inner-->

                                    </article>
                                </li><!--/.related-->
                                <li class="related post-hover">
                                    <article
                                            class="post-903 post type-post status-publish format-standard hentry category-DB category-Program tag-mysql tag-143 tag-64">

                                        <div class="post-thumbnail">
                                            <a href="http://www.poloo.org/?p=903" title="MySQL开发进阶一">
                                                <img src="http://www.poloo.org/wp-content/themes/hueman/img/thumb-medium.png"
                                                     alt="MySQL开发进阶一"/>
                                            </a>
                                        </div><!--/.post-thumbnail-->

                                        <div class="related-inner">

                                            <h4 class="post-title">
                                                <a href="http://www.poloo.org/?p=903" rel="bookmark" title="MySQL开发进阶一">MySQL开发进阶一</a>
                                            </h4><!--/.post-title-->

                                            <div class="post-meta group">
                                                <p class="post-date">12 10月, 2012</p>
                                            </div><!--/.post-meta-->

                                        </div><!--/.related-inner-->

                                    </article>
                                </li><!--/.related-->
                                <li class="related post-hover">
                                    <article
                                            class="post-331 post type-post status-publish format-standard hentry category-Linux">

                                        <div class="post-thumbnail">
                                            <a href="http://www.poloo.org/?p=331"
                                               title="Ubuntu 9.10下安装JDK1.6.0_18和tomcat6.0.24">
                                                <img src="http://www.poloo.org/wp-content/themes/hueman/img/thumb-medium.png"
                                                     alt="Ubuntu 9.10下安装JDK1.6.0_18和tomcat6.0.24"/>
                                            </a>
                                        </div><!--/.post-thumbnail-->

                                        <div class="related-inner">

                                            <h4 class="post-title">
                                                <a href="http://www.poloo.org/?p=331" rel="bookmark"
                                                   title="Ubuntu 9.10下安装JDK1.6.0_18和tomcat6.0.24">Ubuntu
                                                    9.10下安装JDK1.6.0_18和tomcat6.0.24</a>
                                            </h4><!--/.post-title-->

                                            <div class="post-meta group">
                                                <p class="post-date">13 4月, 2010</p>
                                            </div><!--/.post-meta-->

                                        </div><!--/.related-inner-->

                                    </article>
                                </li><!--/.related-->

                            </ul><!--/.post-related-->


                            <section id="comments" class="themeform">


                                <!-- comments closed, no comments -->


                            </section><!--/#comments-->


                        </div><!--/.pad-->


                    </section><!--/.content-->


                    @include('themes.hueman.sidebar')


                </div><!--/.main-inner-->
            </div><!--/.main-->
        </div><!--/.container-inner-->
    </div><!--/.container-->


@include('themes.hueman.footer')
@endsection
