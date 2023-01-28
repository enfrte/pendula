<x-layout>

	<div class="container">
		<h1 class="mt-5">Create new poject</h1>

		<form action="/projects" method='post'>
			@csrf
			<div class="mb-3">
				<input name="title" type="text" class="form-control" placeholder="Project title">
			</div>
			<div class="mb-3">
				<textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
			</div>
			<div class="mb-3">
				<div class="row g-2">
					<div class="col-md-6">
						@fragment('language-select')
						<select name="source_lang" id="source_lang" class="form-select form-control" aria-label="Default select example">
							<option selected>Select a source language</option>
							@foreach ($languages as $iso => $language)
								<option value="{{ $iso }}">{{ $language }}</option>
							@endforeach
						</select>
						@endfragment
					</div>
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
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Create project</button>
		</form>
	</div>

</x-layout>