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


        <div id="calendar-3" class="widget widget_calendar">
            <div id="calendar_wrap" class="calendar_wrap">
                <table id="wp-calendar">
                    <caption>2017年四月</caption>
                    <thead>
                    <tr>
                        <th scope="col" title="星期日">日</th>
                        <th scope="col" title="星期一">一</th>
                        <th scope="col" title="星期二">二</th>
                        <th scope="col" title="星期三">三</th>
                        <th scope="col" title="星期四">四</th>
                        <th scope="col" title="星期五">五</th>
                        <th scope="col" title="星期六">六</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <td colspan="3" id="prev"><a href="http://www.poloo.org/?m=201703">&laquo;
                                3月</a></td>
                        <td class="pad">&nbsp;</td>
                        <td colspan="3" id="next" class="pad">&nbsp;</td>
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr>
                        <td colspan="6" class="pad">&nbsp;</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td id="today">17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                        <td>22</td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                    </tr>
                    <tr>
                        <td>30</td>
                        <td class="pad" colspan="6">&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
            </div>
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


        <div id="archives-3" class="widget widget_archive"><h3>月度存档</h3>        <label
                    class="screen-reader-text" for="archives-dropdown-3">月度存档</label>
            <select id="archives-dropdown-3" name="archive-dropdown"
                    onchange='document.location.href=this.options[this.selectedIndex].value;'>

                <option value="">选择月份</option>
                <option value='http://www.poloo.org/?m=201703'> 2017年三月 &nbsp;(1)</option>
                <option value='http://www.poloo.org/?m=201612'> 2016年十二月 &nbsp;(2)</option>
                <option value='http://www.poloo.org/?m=201609'> 2016年九月 &nbsp;(2)</option>
            </select>
        </div>


    </div><!--/.sidebar-content-->

</div><!--/.sidebar-->

<script type="text/javascript">
    $('.search_btn').on('click', function () {
        var key = $('.search').val();
        console.log(key);
        window.location.href = "{{ url('search/keyword') }}/" + key;
    });
</script>