@if (Session::has('fail'))
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> 提示</h4>
        {{ Session::get('fail') }}
    </div>

@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> 警告！</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
            <!-- 弹窗提示 -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.alert').slideDown(800).delay(5000).slideUp(800);
        });
    </script>
    <!-- 弹窗提示 -->