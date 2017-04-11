<!-- header start -->
<header id="home">
    <div class="navbar-default  fixed-menu">
        <!-- Main-nav -->
        <nav class="navbar navbar-home">
            <div class="container">
                <!-- Navbar Brand -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#matblog-navbar-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-logo">
                    {{--<img src="http://blog.dev/assets/blog/1.png">--}}
                    <a href="/">Blog</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="matblog-navbar-1">
                    <ul class="nav navbar-nav">
                        <li><a href="/">Home</a></li>
                        @foreach($nav as $n)
                            <li><a href="{{ $n->url }}"> {{ $n->name }}</a></li>
                        @endforeach
                    </ul>


                </div><!-- /.navbar-collapse -->


            </div><!-- /.container-fluid -->
        </nav><!-- /.main-nav -->
    </div>
</header>
<!-- header end -->


