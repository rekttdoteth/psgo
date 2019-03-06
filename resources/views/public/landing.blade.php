@extends('base')

@section('head')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
	html {
		background: url('/images/background.png') no-repeat center center fixed;
    	background-size: cover;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
	}

	p span{
		display: inline-block;
	}
</style>
@endsection


@section('content')
@include('layouts.nav')
<div class="py-6 flex flex-col justify-center">
	<img class="mx-auto hidden md:block" src="/images/travel-ai.png">
	<p class="pt-4 text-center text-xl md:text-4xl this-black font-bold">You've earned your vacation. <span>Let us help you Protect it.</span></p>
	<p class="pt-1 text-center text-xs md:text-xl text-grey-dark md:this-black font-bold">Get your travel insurance <span> quotation in 10 seconds.</span></p>
	<div class="flex justify-center">
		<form class="flex flex-col text-center md:text-left md:flex-row bg-white shadow-1 rounded md:py-2 mt-6" id="quote_form" action="{{ route('getplans') }}" method="post">
			@csrf
			<div class="flex">
				<div>
					<p class="px-4 p-2 font-bold text-sm this-grey">Travelling to</p>
					<input class="-my-2 pl-4 py-1 bg-white rounded-l-lg font-bold input-color text-xl text-center md:text-left" type="text" name="destination" id="destination">
				</div>
				<img class="py-5 px-3" src="/images/location-ic.png">
			</div>
			<div class="border border-grey-light"></div>
			<div class="flex">
				<div class="w-full md:w-auto">
					<p class="px-4 p-2 font-bold text-sm this-grey">Depart date</p>
					<input class="-my-2 pl-4 bg-white font-bold input-color text-xl text-center md:text-left datepicker" type="text" name="depart_date" id="depart" placeholder="dd-mm-yyyy">
				</div>
				<img class="py-5 px-3" src="/images/calendar-ic.png">
			</div>
			<div class="border border-grey-light"></div>
			<div class="flex">
				<div class="w-full md:w-auto">
					<p class="px-4 p-2 font-bold text-sm this-grey">Return date</p>
					<input class="-my-2 pl-4 bg-white font-bold input-color text-xl rounded-r-lg text-center md:text-left datepicker" type="text" name="return_date" id="return" placeholder="dd-mm-yyyy">
				</div>
				<img class="py-5 px-3" src="/images/calendar-ic.png">
			</div>
			<div class="border border-grey-light"></div>
			<div class="flex mx-auto md:mx-0">
				<img class="py-4 px-2 cursor-pointer" src="/images/minus-ic.png" id="minus-btn">
				<div class="">
					<p class="px-4 p-2 font-bold text-sm this-grey">Traveller</p>
					<input class="-my-2 pl-4 py-1 bg-white font-bold input-color text-xl rounded-r-lg w-32" type="text" disabled value="1" name="traveller">
				</div>
				<div class="flex flex-row md:flex-row-reverse">
					<img class="py-4 px-2 cursor-pointer" src="/images/plus-ic.png" id="plus-btn">
					<img class="py-5 ml-5 md:ml-0" src="/images/traveller.png">
				</div>
			</div>
			<button id="submit-btn" class="p-4 py-5 rounded-b w-full md:w-auto md:p-6 md:mx-2 self-center md:rounded font-bold whatsapp-btn" type="submit">Get Quotation</button>
		</form>
	</div>
</div>
@endsection


@section('script')
<script>
$(document).ready(function(){
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	today = yyyy+'-'+mm+'-'+dd;
	$( function() {
		$( ".datepicker" ).datepicker({
			dateFormat:'dd-mm-yy',
			changeYear: true,
			changeMonth: true,
			minDate: 0,
		});
	} );
	console.log(today);
	document.getElementById("depart").setAttribute('min', today);
	document.getElementById("return").setAttribute('min', today);
	$('input[name=destination]').focus();
	$('#submit-btn').on('click', function(e){
		e.preventDefault();
		$("input[name=traveller]").removeAttr("disabled");;
		$("#quote_form").submit();
	});
	$('#minus-btn').on('click', function(){
		if($("input[name=traveller]").val() == 1){
			return;
		}
		var traveller = Number($("input[name=traveller]").val()) - 1;
		$("input[name=traveller]").val(traveller);
	});
	$('#plus-btn').on('click', function(){
		var traveller = Number($("input[name=traveller]").val()) + 1;
		$("input[name=traveller]").val(traveller);
	});
});

function initMap(){
	var input = document.getElementById('destination');
    var autocomplete = new google.maps.places.Autocomplete(input);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMh6XVDcpIrX2uQs4KMpjr_bapHqya4SU&libraries=places&callback=initMap"
        async defer></script>
@endsection

