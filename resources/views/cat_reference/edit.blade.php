@extends('layouts.app')

@section('content')
	@include('layouts._errors')
	@include('cat_reference._form',['reference' => $reference])
@endsection