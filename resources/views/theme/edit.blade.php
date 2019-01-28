 @extends('theme.default')


@section('content')

 <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <div class="row">

    <div class="col-lg-12">

        <h3 class="page-header">Edit User {{$user->name }}</h3>

    </div>

    <!-- /.col-lg-12 -->

</div>

      <form method="post" action="{{ route('user.update', $user->id) }}">
      
        @csrf
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value={{ $user->name }} />
        </div>
        <div class="form-group">
          <label for="price">Username:</label>
          <input type="text" class="form-control" name="email" value={{ $user->email }} />
        </div>

        <div class="form-group">
          <label for="status" >Status:</label>
           <select  class="form-control"  name="status">
              @php $type_arr = ['active','inactive']; @endphp

                @foreach($type_arr as $item)
                   <option value="{{ $item }}" @if($user->status=== $item) selected='selected' @endif> {{ strtoupper($item) }}</option>
                @endforeach

        </select>
        </div>

        <div class="form-group">
          <label for="type" >Type:</label>
           <select  class="form-control"  name="type">
      
        @php $type_arr = ['admin','default']; @endphp

          @foreach($type_arr as $item)
             <option value="{{ $item }}" @if($user->type=== $item) selected='selected' @endif> {{ strtoupper($item) }}</option>
          @endforeach


        
      </select>
         <!--  <input type="text" class="form-control" name="type" value={{ $user->type }} /> -->
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>

@endsection