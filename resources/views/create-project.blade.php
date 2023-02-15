<x-layout>

	<h1 class="mt-5">Create new poject</h1>

	<form action="/projects/{{ $project->id ?? '' }}" method="POST">
		@csrf
		@empty($project->id)
			@method('POST')
		@else
			@method('PUT')
		@endempty 
		<div class="mb-3">
			<input name="title" value="{{ $project->title ?? '' }}" type="text" class="form-control" placeholder="Project title">
		</div>
		<div class="mb-3">
			<textarea class="form-control" name="description" rows="3" placeholder="Description">{{ $project->description  ?? '' }}</textarea>
		</div>
		@empty($project)
		<div class="mb-3">
			<div class="row g-2">
				<div class="col-md-6">
					<input 
						type="search" 
						name="language-search"
						hx-post="/languageSearch" 
						hx-target="#source_lang"
						hx-swap="outerHTML"
						hx-trigger="keyup changed delay:500ms, search" 
						class="form-control"
						placeholder="Filter language selection">
				</div>
				<div class="col-md-6">
					@fragment('language-select')
					<select name="source_lang" id="source_lang" class="form-select form-control" aria-label="Default select example">
						<option value ="" selected>Select a source language</option>
						@isset($languages)
						@foreach ($languages as $iso => $language)
						<option value="{{ $iso }}">{{ $language }}</option>
						@endforeach
						@endisset
					</select>
					@endfragment
				</div>
			</div>
		</div>
		@endempty
		<button type="submit" class="btn btn-primary">@isset($project) Update @else Create @endisset project</button>
	</form>

</x-layout>