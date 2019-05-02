@extends('layouts.app')

@section('title', '小区公告')

@section('sidebar')
    @parent
@endsection

@section('content')

    <div class="row-fluid">
        <div class="page-header">
            <h1>小区公告 <small>创建</small></h1>
        </div>
        <form class="form-horizontal" action="{{ url('admin/notice/store') }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="title">标题</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="title" />
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="content">内容</label>
                    <div class="controls">
                        <textarea class="input-xlarge" name="content" rows="3"></textarea>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="address">地址</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" name="address" />
                    </div>
                </div>

                <form action="{{ url('admin/notice/upload') }}" method="POST">
                    <div class="control-group">
                        <label class="control-label" for="cover">图片</label>
                        <div class="controls">
                            <input type="file" name="cover" />
                        </div>
                    </div>
                </form>

                <div class="form-actions">
                    <input type="submit" class="btn btn-success btn-large" value="创建" /> <a class="btn" href="{{url('admin/notice/index')}}">取消</a>
                </div>
            </fieldset>
        </form>
    </div>

@endsection