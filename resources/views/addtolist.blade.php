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
	 <form method="post" id="form" action={{ route('Isbn.downloadcsv') }}>
	   @csrf
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
	   		<td><input type="checkbox" name="addtolist[]" value={{$az_data->isbn_10}}></td>
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
 @if($user_status=="active")
 <button type="submit" name="submit" value="List" class="orange_btn" onclick="submit_form();">Download CSV</button>
 <!-- <input type="submit" name="submit"  class="orange_btn" value ="downloadcsv"> -->
@else
<span class="orange_btn" style="color:red;font-weight:bold">You are not able to download csv. Please subscribe on <a href="mailto:catalog@knowbees.in">catalog@knowbees.in</a></span>
</form>
@endif
</div></div></ul>


<script type="text/javascript">
	function submit_form(){
$("#DownloadCSVform").submit();
setTimeout(function(){ window.location.href="/"; }, 3000);

//alert("hii");
        }


</script>
  
@endsection