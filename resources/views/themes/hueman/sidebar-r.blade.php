<div class="sidebar s2">

    <a class="sidebar-toggle" title="Expand Sidebar"><i class="fa icon-sidebar-toggle"></i></a>

    <div class="sidebar-content">

        <div class="sidebar-top group">
            <p>More</p>
        </div>


        @if( count($category)>0 )



            <div id="categories-5" class="widget widget_categories"><h3>分类目录</h3>
                <ul>
                    @foreach($category as $c)
                        <li class="cat-item cat-item-13"><a href="{{ url('category/'.$c->id) }}">{{ $c->title }}</a>
                            ({{ $c->number }})
                        </li>
                    @endforeach
                </ul>
            </div>

        @endif

        @if( count($tags)>0 )



            <div id="tag_cloud-4" class="widget widget_tag_cloud"><h3>标签</h3>
                <div class="tagcloud">
                    @foreach($tags as $t)
                        <a href="{{ url('search/tag',['tag'=>urlencode($t->name)]) }}">{{ $t->name }}
                            ({{ $t->number }})</a>
                    @endforeach
                </div>
            </div>
        @endif


    </div><!--/.sidebar-content-->

</div><!--/.sidebar-->