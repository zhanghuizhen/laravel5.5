@extends('layouts.app')

@section('title', '社区广场')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="row-fluid" >
    <div class="page-header">
        <h1>社区广场 <small>列表</small></h1>
    </div>
    <table class="table table-bordered" style="text-align: center">
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
                <td> <span class="label label-important">下线</span> </td>
            @elseif ($value->state == 'published')
                <td> <span class="label label-success">发布</span> </td>
            @endif

            <td>
                <div class="btn-group">
                    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if ( $value->state == 'published' )
                            <li><a href="{{url('admin/topic/offline',['id' => $value->id ])}}" role="button"><i class="icon-pencil"></i>offlie </a></li>
                        @elseif ($value->state == 'offline')
                            <li><a href="{{url('admin/topic/publish',['id' => $value->id ])}}" role="button"><i class="icon-pencil"></i>publish </a></li>
                        @endif

                        <li><a href="{{url('admin/notice/index')}}"><i class="icon-pencil"></i> one</a></li>
                        <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                        <li><a href="#"><i class="icon-user"></i> Details</a></li>
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


@endsection