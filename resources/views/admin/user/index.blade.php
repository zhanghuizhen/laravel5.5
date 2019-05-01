@extends('layouts.app')

@section('title', '用户管理')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>用户管理 <small>列表</small></h1>
        </div>
        <table class="table table-striped table-bordered table-condensed">
            <thead>
            <tr>
                <th>序号</th>
                <th>用户名</th>
                <th>手机号</th>
                <th>头像</th>
                <th>地址</th>
                {{--<th>背景图</th>--}}
                <th>是否为管理员</th>
                <th>简介</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->phone}}</td>
                    <td><img style="width:80px; height:50px" src="{{ $value->avatar_url }}" alt=""> </td>
                    <td>{{$value->address}}</td>
                    {{--<td><img style="width:80px; height:50px" src="{{ $value->cover }}" alt=""> </td>--}}

                    @if ( $value->admin == 'no' )
                        <td> <span class="label label-important">非管理员</span> </td>
                    @elseif ($value->admin == 'yes')
                        <td> <span class="label label-success">管理员</span> </td>
                    @endif

                    <td>{{$value->introduction}}</td>

                    <td>
                        <div class="btn-group">
                            <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/user/show', ['id' => $value->id])}}"><i class="icon-user"></i>详情</a></li>
                                @if ( $value->admin == 'yes' )
                                    <li><a href="{{url('admin/user/cancel', ['id' => $value->id])}}" onclick="cancelData(this); return false;"><i class="icon-pencil"></i> 取消管理员</a></li>
                                @elseif ($value->admin == 'no')
                                    <li><a href="{{url('admin/user/set', ['id' => $value->id])}}" onclick="setData(this); return false;"><i class="icon-pencil"></i> 设为管理员</a></li>
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
        function setData(obj)
        {
            target = obj;
            if(confirm('您确认要把该用户设置为管理员吗？')){
                $.ajax({
                    url:$(obj).attr('href'),
                    type:"PUT",
                    success:function(data){
                        if(data=="ok"){
                            alert('设置成功');
                            //在页面中删除这个记录
                            //target.parentNode.parentNode.parentNode.removeChild( target.parentNode.parentNode);
                            window.location.reload();
                        }else{
                            alert('设置失败');
                        }
                    }
                });
            }
        }

        function cancelData(obj)
        {
            target = obj;
            if(confirm('您确认要把该用户取消管理员吗？')){
                $.ajax({
                    url:$(obj).attr('href'),
                    type:"PUT",
                    success:function(data){
                        if(data=="ok"){
                            alert('取消成功');
                            //刷新页面
                            window.location.reload();
                        }else{
                            alert('取消失败');
                        }
                    }
                });
            }
        }

    </script>

@endsection