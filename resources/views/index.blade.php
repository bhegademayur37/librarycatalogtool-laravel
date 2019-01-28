@extends('layouts.app')

@section('content')

@if (\Session::has('msg'))
    <div class="alert alert-success" style="margin-top:-25px">
        {!! \Session::get('msg') !!}
    </div>
@endif
<div class="wrapper">
<div class ="content">
</div>
<br/>

<div class="slider" id="main-slider"><!-- outermost container element -->
	<div class="slider-wrapper"><!-- innermost wrapper element -->
		<img src="images/Slider-5.jpg" alt="First" class="slide" /><!-- slides -->
		<img src="images/Slider-6.jpg" alt="Second" class="slide" />
		<img src="images/Slider-7.jpg" alt="third" class="slide" />
         <img src="images/Slider-8-r.jpg" alt="forth" class="slide" />
	<!--	<img src="images/referensi.jpg"alt="Third" class="slide" />		
		<img src="images/books_library_old_111388_2048x1152.jpg" alt="Four" class="slide" />-->
	</div>
</div>	

<ul class="tab">
  



<!--for csv list -->
<script type="text/javascript">
	
function submit_form(){
$("#DownloadCSVform").submit();
setTimeout(function(){ window.location.href="index.php"; }, 3000);

//alert("hii");
	}

function login(){
	window.location.href="login.php";
}



</script>

<!--for csv list end -->


<!--for display tables for isbn and title -->
	
	</div>
	</div>
</ul>
<div id="footer " class ="footer">

<h4>Developed & Maintained by <a style="color:#fe9900" href="http://www.Knowbees.in">Knowbees Consulting</a>, Pune</h4>
</div>
</div>
<!--for display table end -->



<script type="text/javascript">
$('#form').submit(function() {
    $('.loader').css('visibility', 'visible');
});
</script>

<script type="text/javascript">
$('#Link').click(function() {
    $('.loader').css('visibility', 'visible');
});
</script>

<script>
$(window).load(function() {
                $('.loader').css('visibility', 'visible');
});

</script>
<script>
eventFire(document.getElementById('firsttab'), 'click');



function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>



@endsection
