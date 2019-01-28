@extends('layouts.app')

@section('content')


@if (\Session::has('msg'))
    <div class="alert alert-success" style="margin-top:-25px">
        {!! \Session::get('msg') !!}
    </div>
@endif


<ul class="tab">
	<li><a href="#" class="tablinks" >Selected Results For CSV</a></li>
	<div id="contentwrapper">
	<div id="Doag" class="tabcontent">
	<!--<h5 style="color:#003366">Results From DatabaseResources</h5>-->
	<h5 style="color:#003366">Please select following results to generate CSV</h5>	
	 <form method="get" id="form" action={{ route('Isbn.addtolist') }}>
	   
	<table><thead>
	<tr>
		<th><input type="checkbox" onclick="toggle(this);"/></th>
		<th>ISBN10</th>
		<th>ISBN13</th>
		<th>TITLE</th>
		<th>AUTHOR</th>
		<th>PUBLISHER</th>
		<th>LANGUAGE</th>
		<th>SUBJECT</th>
		<th>SUMMARY</th>
	</tr>
	</thead>
	   <tbody>
	   	<tr>
	   	
	   	@foreach($amazon_data as $az_data)
	   		<td><input type="checkbox" id="list_check" name="addtolist[]" value={{$az_data->isbn_10}}></td>
			<td>{{$az_data->isbn_10}}</td>
            <td>{{$az_data->isbn_13}}</td>
            <td>{{$az_data->title}}</td>
            <td>{{$az_data->author}}</td>
            <td>{{$az_data->publisher}}</td>
            <td>{{$az_data->language}}</td>
             <td>{{$az_data->Subjectdb}}</td>
             <td>{{substr($az_data->Details, 0, 100)}}</td>
         </tr>
  
@endforeach

   </tbody>
 </table>
 <!-- <input type="submit" name="submit"  class="orange_btn" value ="addtolist"> -->
 <button type="submit" name="submit"  value="List" class="orange_btn" onclick="return empty()">Add To List</button>
</form>

</div></div></ul>




@endsection


