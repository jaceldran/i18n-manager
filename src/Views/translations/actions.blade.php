<div class="flex text-sm items-center justify-between my-2">
    <p class="flex whitespace-nowrap">
        <span class="toggle-all-open cursor-pointer py-4 text-gray-700 hover:text-black">
            <i class="p-1 rounded shadow-md fas fa-plus"></i>
            <span>Open All</span>
        </span>
        <span class="toggle-all-close cursor-pointer py-4 text-gray-700 hover:text-black ml-4">
            <i class="p-1 rounded shadow-md fas fa-minus"></i>
            <span>Close All</span>
        </span>

		{{-- @include('components.button', [
			'label' => 'Open All',
			'icon' =>  '<i class="fas fa-plus"></i>',
			'button_class' => 'capitalize',
		])
		@include('components.button', [
			'label' => 'Close All',
			'icon' => '<i class="fas fa-minus"></i>',
			'button_class' => 'capitalize',
		]) --}}
    </p>

    <p class="flex-shrink">
		@include('components.button', [
			'label' => 'Add group',
			'icon' => null,
			'button_class' => 'add-group capitalize text-sm text-gray-700',
		])
    </p>
</div>
