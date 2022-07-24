<div id="modal" class="fixed top-14 sm:top-10 w-full h-full flex flex-col justify-center items-center bg-black/25">

	<div class="w-full h-full sm:h-auto sm:max-w-md border border-black shadow-lg bg-white">
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
