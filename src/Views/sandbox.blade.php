@extends('layout.master')

@section('navigation-main')
    @include('navigation.main')
@endsection

@section('main')
    <h1 class="text-2xl mb-4">sandbox</h1>
    <h2 class="text-xl mb-4">$all</h2>
	<pre>
		{{ print_r($all, 1) }}
	</pre>
@endsection
