@extends('components.modal')

@section('modal-title')
	{{ $title }}
@endsection

@section('modal-content')
    @foreach ($exports as $group => $files)
        <h2 class="font-semibold uppercase p-2 bg-gray-100">{{ $group }}</h2>
        @foreach ($files as $file)
            <p class="p-2">{{ $file }}</p>
        @endforeach
    @endforeach
@endsection
