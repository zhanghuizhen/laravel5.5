@extends('layouts.app')

@section('title', '社区动态')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="row-fluid" >
    <div class="page-header" style="color: gray">
        <h1>社区动态 <small>列表</small></h1>
    </div>

    <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            根据状态筛选
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="{{url('admin/topic/index')}}"><i class="icon-home"></i> 全部</a></li>
            <li><a href="{{url('admin/topic',['state' => 'published'])}}"><i class="icon-edit"></i> 发布</a></li>
            <li><a href="{{url('admin/topic',['state' => 'offline'])}}"><i class="icon-edit"></i> 下线</a></li>
        </ul>

        <form class="form-search"  action="{{ url('admin/topic/content') }}" method="POST" style="margin-left: 150px" >
            <input type="text" class="input-medium search-query" name="description">
            <button type="submit" class="btn">根据内容筛选</button>
        </form>
    </div>

    <table class="table table-bordered" style="background: white;">
        <thead>
            <tr>
                <th>序号</th>
                <th>内容</th>
                <th>图片</th>
                <th>用户id</th>
                <th>发布时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($list as $value)
        <tr class="list-users">
            <td>{{$value->id}}</td>
            <td>{{$value->content}}</td>
            <td><img style="width:80px; height:50px" src="{{ $value->cover }}" alt=""> </td>
            <td>{{$value->user_id}}</td>
            <td>{{$value->published_at}}</td>

            @if ( $value->state == 'offline' )
                <td> <span class="label label-important">已下线</span> </td>
            @elseif ($value->state == 'published')
                <td> <span class="label label-success">已发布</span> </td>
            @endif

            <td>
                <div class="btn-group">
                    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/topic/show', ['id' => $value->id])}}"><i class="icon-user"></i> 详情</a></li>
                        <li><a href="{{url('admin/topic/delete', ['id' => $value->id])}}" onclick="deleteData(this); return false;"><i class="icon-trash"></i> 删除</a></li>

                        @if ( $value->state == 'published' )
                            <li><a href="{{url('admin/topic/offline', ['id' => $value->id])}}" onclick="offlineData(this); return false;"><i class="icon-pencil"></i> 下线</a></li>
                        @elseif ($value->state == 'offline')
                            <li><a href="{{url('admin/topic/publish', ['id' => $value->id])}}" onclick="publishData(this); return false;"><i class="icon-pencil"></i> 发布</a></li>
                        @endif

                    </ul>
                </div>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{--{{ $list->links() }}--}}

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

    function offlineData(obj)
    {
        target = obj;
        if(confirm('您确认要下线该条数据吗？')){
            $.ajax({
                url:$(obj).attr('href'),
                type:"PUT",
                success:function(data){
                    if(data=="ok"){
                        alert('下线成功');
                        //刷新页面
                        window.location.reload();
                    }else{
                        alert('下线失败');
                    }
                }
            });
        }
    }

    function publishData(obj)
    {
        target = obj;
        if(confirm('您确认要发布该条数据吗？')){
            $.ajax({
                url:$(obj).attr('href'),
                type:"PUT",
                success:function(data){
                    if(data=="ok"){
                        alert('发布成功');
                        //刷新页面
                        window.location.reload();
                    }else{
                        alert('发布失败');
                    }
                }
            });
        }
    }
</script>
@endsection