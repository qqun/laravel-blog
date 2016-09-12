<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height:auto;">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ Auth::user()->avatar }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
              {{--<input type="text" name="q" class="form-control" placeholder="Search..."/>--}}
              {{--<span class="input-group-btn">--}}
                {{--<button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>--}}
              {{--</span>--}}
            {{--</div>--}}
          {{--</form>--}}
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">主导航栏</li>


            @foreach(Config::get('menu.admin') as $m)
            <li class="treeview {{ isset($parent_active[$m['tag']]) ? $parent_active[$m['tag']] : '' }}">
              <a href="#">
                <i class="fa {{ icon($m['icon'],'fa-dashboard') }} "></i> <span>{{ $m['title'] }}</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              @if(is_array($m['children']))
              <ul class="treeview-menu">
                @foreach($m['children'] as $sub)
                <li class="{{ isset($active[$sub['tag']]) ? $active[$sub['tag']] : '' }}"><a href="{{ $sub['href'] }}"><i class="fa {{ icon($sub['icon'],'fa-circle-o') }}"></i> {{ $sub['title'] }}</a></li>
                @endforeach
              </ul>
              @endif
            </li>
            @endforeach


            {{--<li class="treeview">--}}
              {{--<a href="#">--}}
                {{--<i class="fa fa-files-o"></i>--}}
                {{--<span>Layout Options</span>--}}
                {{--<span class="label label-primary pull-right">4</span>--}}
              {{--</a>--}}
              {{--<ul class="treeview-menu">--}}
                {{--<li><a href="#"><i class="fa fa-circle-o"></i> Top Navigation</a></li>--}}
                {{--<li><a href="#l"><i class="fa fa-circle-o"></i> Boxed</a></li>--}}
                {{--<li><a href="#"><i class="fa fa-circle-o"></i> Fixed</a></li>--}}
              {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
              {{--<a href="#">--}}
                {{--<i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>--}}
              {{--</a>--}}
            {{--</li>--}}



            {{--<li><a href="#"><i class="fa fa-book"></i> <span>Documentation</span></a></li>--}}
            {{--<li class="header">LABELS</li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>--}}
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

<script type="text/javascript">
  (function () {
    var r = '/<?php echo Request::path(); ?>';
    var i=0, d=document.querySelector('.sidebar-menu').querySelectorAll('a') ;

    while( i<d.length  ){
        var href = d[i].getAttribute('href');

        if( href == r.substr(0,href.length) && r.length == href.length){
            var li = $(d[i]).closest('li');
            li.addClass('active');
            var ul = $(d[i]).closest('ul').closest('li');
            ul.addClass('active');
        }
        i++;
    }
})();
</script>