@extends('layouts.app')

@section('title', '小区公告')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="well hero-unit">
        <h1>Welcome, Admin</h1>
        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. </p>
        <p><a class="btn btn-success btn-large" href="users.html">Manage Users &raquo;</a></p>
    </div>
    <div class="row-fluid">
        <div class="span3">
            <h3>Total Users</h3>
            <p><a href="users.html" class="badge badge-inverse">563</a></p>
        </div>
        <div class="span3">
            <h3>New Users Today</h3>
            <p><a href="users.html" class="badge badge-inverse">8</a></p>
        </div>
        <div class="span3">
            <h3>Pending</h3>
            <p><a href="users.html" class="badge badge-inverse">2</a></p>
        </div>
        <div class="span3">
            <h3>Roles</h3>
            <p><a href="roles.html" class="badge badge-inverse">3</a></p>
        </div>
    </div>
    <br />
    <div class="row-fluid">
        <div class="page-header">
            <h1>Pending Users <small>Approve or Reject</small></h1>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Phone</th>
                <th>City</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr class="pending-user">
                <td>564</td>
                <td>John S. Schwab</td>
                <td>johnschwab@provider.com</td>
                <td>402-xxx-xxxx</td>
                <td>Bassett, NE</td>
                <td>User</td>
                <td><span class="label label-important">Inactive</span></td>
                <td><span class="user-actions"><a href="javascript:void(0);" class="label label-success">Approve</a> <a href="javascript:void(0);" class="label label-important">Reject</a></span></td>
            </tr>
            <tr class="pending-user">
                <td>565</td>
                <td>Juliana M. Sheffield</td>
                <td>julianasheffield@provider.com</td>
                <td>803-xxx-xxxx</td>
                <td>Columbia, SC</td>
                <td>User</td>
                <td><span class="label label-important">Inactive</span></td>
                <td><span class="user-actions"><a href="javascript:void(0);" class="label label-success">Approve</a> <a href="javascript:void(0);" class="label label-important">Reject</a></span></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection