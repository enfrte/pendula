<x-layout>

<h1 class="pt-5">Source sentences</h1>

	<h2 class="pt-3">Page {{ $nextPageNum ?? $page_num }}</h2>

	<div class="row align-items-center pt-3">
		<div class="col-md-2">
			<input 
				hx-post="/sentence-upload/{{ $project_id ?? '' }}" 
				hx-target="#sentences"
				hx-swap="outerHTML"
				hx-trigger="change" 
				name="page_num" 
				class="form-control" 
				min="1" max="1000" 
				type="number" 
				value="{{ $nextPageNum ?? 1 }}"
				required>
		</div>
		<div class="col-md-8">
			<span class="form-text">Select page number of the translation.</span>
		</div>
	</div>

@fragment('sentence-upload')
<div id="sentences">

		<form action="/sourceSentences" method="POST" class="mt-5">
			@csrf
			<input type="hidden" name="project_id" value="{{ $project_id ?? '' }}">
			<input type="hidden" name="page_num" value="{{ $nextPageNum ?? $page_num }}">
			<p>Separate sentences with a new line.</p>
			<textarea class="form-control mb-3" name="sentences" rows="3" placeholder="Page sentences">{{ $sentences ?? '' }}</textarea>
			<button class="btn btn-primary">
				@if( !isset($sentences) || empty($sentences) )
					Upload sentences
				@else
					Edit sentences
				@endif
			</button>
		</form>

		<form class="" action="/delete-project-page/{{ $project_id }}/{{ $nextPageNum ?? $page_num }}" method="post">
			@csrf
			@method('DELETE')
			<input type="hidden" name="page_num" value="{{ $nextPageNum ?? $page_num }}">
			<button class="btn btn-danger">Delete sentences</button>
		</form>

</div>
@endfragment

</x-layout>