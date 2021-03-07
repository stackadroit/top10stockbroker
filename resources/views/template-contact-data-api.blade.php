{{--
  Template Name: Contact Data Api
--}}
@php
header("Content-Type: application/json; charset=UTF-8");
	echo json_encode($response_data);
@endphp
