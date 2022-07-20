@extends('config.index')

@section('config_content')

<pre>
    {{ print_r($env, 1) }}
</pre>

@endsection
