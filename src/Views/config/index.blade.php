@extends('layout.master')

@section('navigation-main')
    @include('navigation')
@endsection

@section('main')
    <h1 class="text-2xl mb-4">config</h1>

	<pre>
		{{ print_r($all, 1) }}
	</pre>
@endsection
