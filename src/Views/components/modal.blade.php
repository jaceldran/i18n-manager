<div id="modal" class="h-full w-full absolute top-0  flex flex-col justify-center items-center bg-black/25">

	<div class="w-full mx-4 sm:m-0 sm:max-w-md border border-black shadow-md">

		<div class="flex justify-between w-full bg-gray-300 border-b shadow-md">
			<span class="p-4 font-medium">@yield('modal-title')</span>
			<button class="p-4 outline-none" onclick="Element.destroy('#modal')">
				<i class="fas fa-xmark"></i>
			</button>
		</div>

		<div class="bg-white overflow-auto max-h-80">
			@yield('modal-content')
		</div>
	</div>

</div>
