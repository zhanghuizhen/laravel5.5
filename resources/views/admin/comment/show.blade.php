@extends('layouts.app')

@section('title', '评论')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>评论 <small>详情</small></h1>
        </div>
        <table class="table" style="width: 500px;background: white">
            <tr>
                <th>评论内容</th>
                <td>{{$data->content}}</td>
            </tr>
            <tr>
                <th>根评论id</th>
                <td>{{$data->root_id}}</td>
            </tr>
            <tr>
                <th>父评论id</th>
                <td>{{$data->parent_id}}</td>
            </tr>
            <tr>
                <th>状态</th>
                @if ( $data->state == 'published' )
                    <td> 已发布</td>
                @elseif ($data->state == 'offline')
                    <td> 已下线</td>
                @endif
            </tr>
            <tr>
                <th>创建人id</th>
                <td>{{$data->user_id}}</td>
            </tr>
            <tr>
                <th>社区广场数据id</th>
                <td>{{$data->topic_id}}</td>
            </tr>

            <tr>
                <th>发布时间</th>
                <td>{{$data->published_at}}</td>
            </tr>
            <tr>
                <th>创建时间</th>
                <td>{{$data->created_at}}</td>
            </tr>
            <tr>
                <th>更新时间</th>
                <td>{{$data->updated_at}}</td>
            </tr>
        </table>
    </div>

    <a href="{{url('admin/comment/index')}}" class="btn btn-success">返回列表</a>


@endsection