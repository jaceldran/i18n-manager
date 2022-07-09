<section class="
	rounded-full
	flex
	justify-between
	gap-2
	items-center
	font-semibold
	bg-slate-200
	shadow-sm
	py-2
	px-4
	my-4
	uppercase
	cursor-pointer">
	<div
		class="cursor-pointer flex-grow"
		onclick="alert('EN DESARROLLO\nplegar/desplegar grupo *{{ $group }}* ')">
		<button class="bg-slate-50 rounded-full h-8 w-8">
			<i class="fas fa-angle-up"></i>
		</button>
		<span>{{ $group }}</span>
	</div>
	<button class="cursor-pointer bg-slate-50 rounded-full h-8 w-8" onclick="alert('EN DESARROLLO\nAñadir entrada al grupo *{{ $group }}* ')">
		<i class="fas fa-plus "></i>
	</button>
</section>

@foreach ($words as $id => $entry)
<div class="flex border-b mb-1 pb-1">

	<span class="px-1 py-2">

	</span>

	<label class="
		text-slate-600
		cursor-pointer
		px-1
		py-2
		w-40
		overflow-hidden
		overflow-ellipsis
		font-semibold
		whitespace-nowrap">
		<input type="checkbox" class="cursor-pointer accent-pink-500">
		{{-- <input type="checkbox" class="bg-red-100 border-red-300 text-green-500 focus:ring-red-200 --accent-green-500"> --}}
		{{ $id }}
	</label>

	<div class="
		grid
		w-full
		sm:grid-cols-2
		md:grid-cols-4">

		@foreach ($langs as $lang)
		<p class="mr-1">
			{{-- <label class="block text-xs font-bold text-purple-500 uppercase lg:hidden">{{$lang}}</label> --}}

			<input class="
				rounded-md
				bg-transparent
				outline-none
				hover:bg-slate-100
				focus:bg-slate-200
				cursor-pointer
				w-full
				px-2
				py-2"
				value="{{ $entry[$lang] ?? '' }}"
				placeholder="Translate to {{ strtoupper($lang) }}"
				data-group="{{ $group }}"
				data-id="{{ $id }}"
				data-lang="{{ $lang }}">
		</p>
		@endforeach
	</div>

	{{-- <button class="cursor-pointer p-4">
		<i class="fas fa-trash-can text-slate-400"></i>
	</button> --}}
</div>
@endforeach