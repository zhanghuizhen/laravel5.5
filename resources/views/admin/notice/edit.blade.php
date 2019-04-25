@extends('layouts.app')

@section('title', '小区公告')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>小区公告 <small>更新</small></h1>
        </div>
        <form class="form-horizontal" action="{{ url('admin/notice/update',['id' => $data->id]) }}" method="POST">
            {{csrf_field()}}
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="title">标题</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="title" value="{{$data->title}}"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="content">内容</label>
                    <div class="controls">
                        <textarea class="input-xlarge" name="content" rows="3" >{{$data->content}}</textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="address">地址</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="address"  value="{{$data->address}}"/>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="cover">图片</label>
                    <div class="controls">
                        <input type="file" name="cover" value="{{$data->cover}}">
                    </div>
                </div>

                <div class="form-actions">
                    <input type="submit" class="btn btn-success btn-large" value="更新" /> <a class="btn" href="{{url('admin/notice/index')}}">取消</a>
                </div>
            </fieldset>
        </form>
    </div>

@endsection