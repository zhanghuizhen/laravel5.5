@extends('layouts.app')

@section('title', '生活服务')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>生活服务 <small>列表</small></h1>
        </div>

        <div class="btn-group">
            <div style="float: left">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    根据状态筛选
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{url('admin/service/index')}}"><i class="icon-trash"></i> 全部</a></li>
                    <li><a href="{{url('admin/service',['state' => 'finish'])}}"><i class="icon-trash"></i> 完成</a></li>
                    <li><a href="{{url('admin/service',['state' => 'unfinished'])}}"><i class="icon-trash"></i> 未完成</a></li>
                </ul>
            </div>

            <div style="margin-left: 180px">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#" >
                    根据类型筛选
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" style="margin-left: 180px">
                    <li><a href="{{url('admin/service/index')}}"><i class="icon-trash"></i> 全部</a></li>
                    <li><a href="{{url('admin/service',['type' => 'express'])}}"><i class="icon-trash"></i> 代取快递</a></li>
                    <li><a href="{{url('admin/service',['type' => 'car_wash'])}}"><i class="icon-trash"></i> 上门洗车</a></li>
                    <li><a href="{{url('admin/service',['type' => 'house_clean'])}}"><i class="icon-trash"></i> 家庭保洁</a></li>
                </ul>
            </div>
        </div>

        <table class="table table-bordered" style="background: white;  margin-top: 18px">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>类型</th>
                    <th>用户地址</th>
                    <th>服务到达时间</th>
                    <th>创建人id</th>
                    <th>描述</th>
                    <th>状态</th>

                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>

                    @if ( $value->type == 'house_clean' )
                        <td>家庭保洁</td>
                    @elseif ($value->type == 'car_wash')
                        <td>上门洗车 </td>
                    @elseif ($value->type == 'express')
                        <td>代取快递 </td>
                    @endif

                    <td>{{$value->user_address}}</td>
                    <td>{{$value->arrived_at}}</td>
                    <td>{{$value->user_id}}</td>
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
                                <li><a href="{{url('admin/service/show', ['id' => $value->id])}}"><i class="icon-user"></i> 详情</a></li>
                                <li><a href="{{url('admin/service/delete', ['id' => $value->id])}}" onclick="deleteData(this); return false;"><i class="icon-trash"></i> 删除</a></li>
                                @if ( $value->state == 'unfinished' )
                                    <li><a href="{{url('admin/service/finish', ['id' => $value->id])}}" onclick="finishData(this); return false;"><i class="icon-pencil"></i> 完成</a></li>
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