<!-- myUsers.blade.php -->

@extends('theme.default')


@section('content')

@if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif

<div class="row">

    <div class="col-lg-12">

        <h3 class="page-header">All Users</h3>

    </div>

    <!-- /.col-lg-12 -->

</div>

<!-- /.row -->


<table class="table table-striped table-bordered table-hover">

    <thead>

        <tr>

            <th>Id</th>

            <th>Name</th>
             <th>Username</th>
             <th>Csv download count</th>
             <th>Status</th>
             <th>Type</th>
             <th>Edit</th>
             <th>Delete User</th>

        </tr>

    </thead>

    <tbody>

@foreach($users as $usr)
        <tr>

            <td>{{$usr->id}}</td>
            <td>{{$usr->name}}</td>
            <td>{{$usr->email}}</td>
            <td>{{$usr->download_count}}</td>
            <td>{{$usr->status}}</td>
            <td>{{$usr->type}}</td>
            <td><a href="{{ route('user.edit',$usr->id)}}" class="btn btn-primary">Edit</a></td>
             <td>@if($usr->type=="default")
                <form action="{{ route('user.delete', $usr->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit"><i class="fa fa-sign-out fa-fw"></i>Delete</button>
                </form>
            @endif
            </td>
            <!-- <td><a href="#"><i class="fa fa-sign-out fa-fw"></i>Delete</a></td> -->
        </tr>
@endforeach  
       
    </tbody>

</table>


@endsection