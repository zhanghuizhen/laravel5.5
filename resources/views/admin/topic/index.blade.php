@extends('layouts.app')

@section('title', '社区广场')

@section('sidebar')
    @parent
@endsection

@section('content')

<div class="row-fluid">
    <div class="page-header">
        <h1>社区广场 <small>列表</small></h1>
    </div>
    <table class="table table-bordered">
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

            @if ( $value->state == 'published' )
                {{--<td> <span class="label label-success">发布</span> </td>--}}
                {{--<td><button class="btn btn-primary" type="button">发布</button></td>--}}
                <td>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        发布
                    </button>
                </td>
            @elseif ($value->state == 'offline')
                {{--<td> <span class="label label-important">下线</span> </td>--}}
                <td>
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        下线
                    </button>
                </td>
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

                {{--<div class="dropdown">--}}
                    {{--<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">--}}
                        {{--Dropdown--}}
                        {{--<span class="caret"></span>--}}
                    {{--</button>--}}
                    {{--<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>


</div>


@endsection