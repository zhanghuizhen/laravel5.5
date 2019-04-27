@extends('layouts.app')

@section('title', '评论')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>评论 <small>列表</small></h1>
        </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>序号</th>
                <th>评论内容</th>
                <th>用户id</th>
                <th>社区广场数据id</th>
                <th>根评论id</th>
                <th>父评论id</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->content}}</td>
                    <td>{{$value->user_id}}</td>
                    <td>{{$value->topic_id}}</td>
                    <td>{{$value->root_id}}</td>
                    <td>{{$value->parent_id}}</td>

                    @if ( $value->state == 'published' )
                        <td> <span class="label label-success">已发布</span> </td>
                    @elseif ($value->state == 'offline')
                        <td> <span class="label label-important">已下线</span> </td>
                    @endif

                    <td>
                        <div class="btn-group">
                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/comment/show', ['id' => $value->id])}}"><i class="icon-user"></i> 详情</a></li>
                                <li><a href="{{url('admin/comment/delete', ['id' => $value->id])}}" onclick="deleteData(this); return false;"><i class="icon-trash"></i> 删除</a></li>
                                <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <script>
        function deleteData(obj)
        {
            target = obj;
            if(confirm('您确认要删除该条信息吗？')){
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
    </script>

@endsection