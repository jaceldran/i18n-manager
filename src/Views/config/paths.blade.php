@extends('config.index')

@section('config_content')
    <form class="px-2 sm:px-0">

        {{-- <p class="py-4">
           <kbd class="font-semibold font-mono inline-block px-2 py-1 bg-gray-200">{{ APP_PATH  }}</kbd>
        </p> --}}

        @include('components.input', [
                'id' => 'app_path',
                'name' => 'app_path',
                'label' => 'APP_PATH',
                'value' => APP_PATH,
				//'input_class' => 'font-semibold font-mono',
                'disabled' => true,
            ])

        @foreach ($paths as $key => $value)
            @include('components.input', [
                'id' => $key,
                'name' => $key,
                'label' => $key,
                'placeholder' => $key,
                'value' => $value,
				//'input_class' => 'font-semibold font-mono',
                'disabled' => false,
            ])
        @endforeach

        <p class="flex gap-2">
            @include('components.button', [
                'label' => 'Create',
            ])

            @include('components.button', [
                'label' => 'Update',
            ])

        </p>

    </form>
@endsection

{{-- <p class="p-2 font-thin">font-thin</p>
	<p class="p-2 font-extralight">font-extralight</p>
	<p class="p-2 font-light">font-light</p>
	<p class="p-2 font-medium">font-medium</p>
	<p class="p-2 font-semibold">font-semibold</p>
	<p class="p-2 font-bold">font-bold</p>
	<p class="p-2 font-extrabold">font-extrablod</p>
	<p class="p-2 font-black">font-black</p>
	<p class="p-2 font-normal">normal</p> --}}
