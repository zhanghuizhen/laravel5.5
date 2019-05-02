@extends('layouts.app')

@section('title', '报修')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header" style="color: gray">
            <h1>报修 <small>列表</small></h1>
        </div>

        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                根据状态筛选
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{url('admin/repair/index')}}"><i class="icon-trash"></i> 全部</a></li>
                <li><a href="{{url('admin/repair',['state' => 'finish'])}}"><i class="icon-trash"></i> 完成</a></li>
                <li><a href="{{url('admin/repair',['state' => 'unfinished'])}}"><i class="icon-trash"></i> 未完成</a></li>
            </ul>

            <form class="form-search"  action="{{ url('admin/repair/part') }}" method="POST" style="margin-left: 150px" >
                <input type="text" class="input-medium search-query" name="part">
                <button type="submit" class="btn">根据分类筛选</button>
            </form>
        </div>

        <table class="table table-bordered" style="background: white;">
            <thead>
            <tr>
                <th>序号</th>
                <th>地址</th>
                <th>分类</th>
                <th>维修时间</th>
                <th>用户id</th>
                <th>相关图片</th>
                <th>描述</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->address}}</td>
                    <td>{{$value->part}}</td>
                    <td>{{$value->repair_time}}</td>
                    <td>{{$value->user_id}}</td>
                    <td><img style="width:80px; height:50px" src="{{ $value->image }}" alt=""> </td>
                    <td>{{$value->description}}</td>

                    @if ( $value->state == 'unfinished' )
                        <td> <span class="label label-important">未完成</span> </td>
                    @elseif ($value->state == 'finish')
                        <td> <span class="label label-success">完成</span> </td>
                    @endif

                    <td>
                        <div class="btn-group">
                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/repair/show', ['id' => $value->id])}}"><i class="icon-user"></i> 详情</a></li>
                                <li><a href="{{url('admin/repair/delete', ['id' => $value->id])}}" onclick="deleteData(this); return false;"><i class="icon-trash"></i> 删除</a></li>
                                @if ( $value->state == 'unfinished' )
                                    <li><a href="{{url('admin/repair/finish', ['id' => $value->id])}}" onclick="finishData(this); return false;"><i class="icon-pencil"></i> 完成</a></li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    {{ $list->links() }}

    <script>
        function deleteData(obj)
        {
            target = obj;
            if(confirm('您确认要删除该条数据吗？')){
                $.ajax({
                    url:$(obj).attr('href'),
                    type:"DELETE",
                    success:function(data){
                        if(data=="ok"){
                            alert('删除成功');
                            //在页面中删除这个记录
                            //target.parentNode.parentNode.parentNode.removeChild( target.parentNode.parentNode);
                            window.location.reload();
                        }else{
                            alert('删除失败');
                        }
                    }
                });
            }
        }

        function finishData(obj)
        {
            target = obj;
            if(confirm('您确认要点击完成吗？')){
                $.ajax({
                    url:$(obj).attr('href'),
                    type:"PUT",
                    success:function(data){
                        if(data=="ok"){
                            alert('点击成功');
                            //刷新页面
                            window.location.reload();
                        }else{
                            alert('点击失败');
                        }
                    }
                });
            }
        }
    </script>

@endsection