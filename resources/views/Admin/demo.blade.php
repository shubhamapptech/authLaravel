@extends('layouts.app')

@section('content')

<div class="container">
	@foreach($images as $img)		
		@foreach($img as $i)
	<div><img class="img-thumbnail" src="{{ asset('/images/'.$i) }}" width="100" height="100"></div>
	    @endforeach
	@endforeach
</div>

@endsection