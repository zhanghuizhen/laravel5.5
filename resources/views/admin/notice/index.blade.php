@extends('layouts.app')

@section('title', '小区公告')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>小区公告 <small>列表</small></h1>
        </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>标题</th>
                    <th>内容</th>
                    {{--<th>用户id</th>--}}
                    <th>地址</th>
                    <th>图片</th>
                    <th>状态</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->title}}</td>
                    <td>{{$value->content}}</td>
                    {{--<td>{{$value->user_id}}</td>--}}
                    <td>{{$value->address}}</td>
                    <td><img style="width:80px; height:50px" src="{{ $value->cover }}" alt=""> </td>

                    @if ( $value->state == 'published' )
                        <td> <span class="label label-success">发布</span> </td>
                    @elseif ($value->state == 'offline')
                        <td> <span class="label label-important">下线</span> </td>
                    @endif

                    <td>{{$value->published_at}}</td>

                    <td>
                        <div class="btn-group">
                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/notice/edit', ['id' => $value->id])}}"><i class="icon-pencil"></i> 更新</a></li>
                                <li><a href="{{url('admin/notice/show', ['id' => $value->id])}}"><i class="icon-user"></i> 详情</a></li>
                                <li><a href="{{url('admin/notice/delete', ['id' => $value->id])}}" onclick="deleteData(this); return false;"><i class="icon-trash"></i> 删除</a></li>
                                <li class="nav-header">Permissions</li>
                                <li><a href="#"><i class="icon-lock"></i> Make <strong>Admin</strong></a></li>
                                <li><a href="#"><i class="icon-lock"></i> Make <strong>Moderator</strong></a></li>
                                <li><a href="#"><i class="icon-lock"></i> Make <strong>User</strong></a></li>
                            </ul>
                        </div>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $list->links() }}

    {{--<div class="pagination">--}}
        {{--<ul>--}}
            {{--<li><a href="#">Prev</a></li>--}}
            {{--<li class="active">--}}
                {{--<a href="#">1</a>--}}
            {{--</li>--}}
            {{--<li><a href="#">2</a></li>--}}
            {{--<li><a href="#">3</a></li>--}}
            {{--<li><a href="#">4</a></li>--}}
            {{--<li><a href="#">Next</a></li>--}}
        {{--</ul>--}}

    {{--</div>--}}

    <a href="{{url('admin/notice/create')}}" class="btn btn-success">New Notice</a>

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