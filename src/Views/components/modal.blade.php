<div id="modal" class="absolute top-12 left-0 bottom-0 right-0 flex flex-col justify-center items-center bg-black/25">

	<div class="w-full mx-4 sm:m-0 sm:max-w-md border border-black shadow-lg bg-white">

		<div class="flex justify-between w-full bg-gray-200 border-b shadow-sm mb-2">
			<span class="py-2 px-4 font-medium">@yield('modal-title')</span>
			<button class="py-2 px-4 outline-none" onclick="Element.destroy('#modal')">
				<i class="fas fa-xmark"></i>
			</button>
		</div>

		<div class="overflow-auto max-h-[80vh]">
			@yield('modal-content')
		</div>
	</div>

</div>
