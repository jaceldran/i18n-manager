@extends('config.index')

@section('config_content')
    <form class="px-2 sm:px-0">

        {{-- <p class="py-4">
            <kbd class="font-semibold font-mono inline-block px-2 py-1 bg-gray-200">{{ APP_PATH }}</kbd>
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
                'label' => strtoupper($key),
                'placeholder' => $key,
                'value' => $value,
                //'input_class' => 'font-semibold font-mono',
                'disabled' => false,
            ])
        @endforeach


        {{-- <p class="flex gap-2">
            @include('components.button', [
                'id' => 'create-folders',
                'label' => 'Create',
            ])

            @include('components.button', [
                'id' => 'update-paths',
                'label' => 'Update',
            ])
        </p> --}}

    </form>


@endsection

@section('script')
    <script>
        document.querySelectorAll('button').forEach(element => {
            element.addEventListener('click', evt => {
                alert('** en desarrollo ' + evt.target.id + ' - ' + element.id + ' **');
            });
        });
    </script>
@endsection
