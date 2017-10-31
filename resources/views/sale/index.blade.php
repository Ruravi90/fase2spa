@extends('layouts.app')
@section('content')
	@role('admin')
	   @include('sale.admin')
	@else
	   @include('sale.user')
	@endrole
@endsection
@section('scripts')
  <script src="{{ asset('controllers/SalesController.js') }}"></script>
@endsection