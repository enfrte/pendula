<x-layout>

<h1 class="pt-3">Translations</h2>

@if (!empty($errorMessage))<p style="color:red;">{{ $errorMessage }}</p> @endif 

@if ( $sourcePageExists )
	<div class="row align-items-center pt-3 pb-5">
		<p>Change pages</p>
		<div class="col-md-2">
			<input 
				hx-post="/translation-upload/{{ $project_id }}" 
				hx-target="#sentenceTranslationComponent"
				hx-swap="outerHTML"
				hx-trigger="change" 
				name="page_num" 
				class="form-control" 
				min="1" max="1000" 
				type="number" 
				value="{{ $landingPage }}"
				required>
		</div>
	</div>

	<div class="mb-3">
		<div class="row g-2">
			<div class="col-md-6">
				<input 
					type="search" 
					name="language-search"
					hx-post="/languageSearch" 
					hx-target="#languageSelectContainer"
					hx-swap="innerHTML"
					hx-trigger="keyup changed delay:500ms, search" 
					class="form-control"
					placeholder="Filter language selection">
			</div>
			<div id="languageSelectContainer" class="col-md-6"></div>
		</div>
	</div>
	{{-- <pre>
		{{ print_r($sourcePageTranslations) }}
	</pre> --}}

	@include('components.translation.sentenceTranslationComponent')

@else
	<div class="pt-5">
		<p>No source page found.</p> 
		<p>Create a source text for this page before trying to translate it.</p> 
	</div>
@endif

</x-layout>