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
        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>序号</th>
                    <th>类型</th>
                    <th>地址</th>
                    <th>到达时间</th>
                    <th>用户id</th>
                    <th>描述</th>
                    <th>状态</th>

                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($list as $value)
                <tr class="list-users">
                    <td>{{$value->id}}</td>
                    <td>{{$value->type}}</td>
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
                                <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
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