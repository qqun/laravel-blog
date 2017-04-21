<div class="sidebar s1">

    <a class="sidebar-toggle" title="Expand Sidebar"><i class="fa icon-sidebar-toggle"></i></a>


    <div class="sidebar-content">

        <div class="sidebar-top group">
            <p>Follow:</p>
        </div>


        <div style="padding:30px 30px 0;">
            <script type="text/javascript">
                /*180*38 search 2017/1/17*/
                var cpro_id = "u2878999";
            </script>
            <script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>
        </div>


        <div id="search-3" class="widget widget_search"><h3>Search</h3>
            <div class="searchform themeform">
                <input type="text" name="keyword" value="" class="search">
                <button class="search_btn"><i class="fa fa-fw fa-search fa-1x" aria-hidden="true"></i></button>

            </div>
        </div>

        @if( count($artHot)>0 )


            <div id="recent-posts-3" class="widget widget_recent_entries"><h3>近期文章</h3>
                <ul>
                    @inject('homePresenter', '\App\Presenters\HomePresenter')
                    @foreach($artHot as $a)
                        <li>
                            <a href="{{ url('article/'.$a->id) }}">{{ $a->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif





    </div><!--/.sidebar-content-->

</div><!--/.sidebar-->

<script type="text/javascript">
    $('.search_btn').on('click', function () {
        var key = $('.search').val();
        console.log(key);
        window.location.href = "{{ url('search/keyword') }}/" + key;
    });
</script>