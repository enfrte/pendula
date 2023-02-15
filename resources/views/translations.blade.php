

<x-layout>

<h1 class="pt-3">Translations</h2>

<div class="row align-items-center pt-3 pb-5">
	<p>Change pages</p>
	<div class="col-md-2">
		<input 
			hx-post="/translation-upload/{{ $project_id }}" 
			hx-target="#translation-upload"
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
				hx-target="#source_lang"
				hx-swap="outerHTML"
				hx-trigger="keyup changed delay:500ms, search" 
				class="form-control"
				placeholder="Filter language selection">
		</div>
		<div class="col-md-6">
			@fragment('language-select')
			<select 
				name="source_lang" 
				id="source_lang" 
				class="form-select form-control" aria-label="Default select example">
				<option value selected>Select a translation language</option>
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

@fragment('translation-upload')
<div id="translation-upload" class="row g-2 pt-5">
@if ( $sourcePageExists )
@foreach ($sourcePageTranslations as $translation)
<hr>
<div class="col-md-6">
	<p>{{ $translation->sentence_text }}</p>
</div>

<div class="col-md-6">
	<form>
		<input type="hidden" name="{{ $landingPage }}">

		<textarea 
			class="form-control"
			name="translation" 
			rows="3">@if(!empty($translation->translation)){{ $translation->translation }}@endif</textarea>
		
		<button 
			hx-post="/translations/{{ $translation->id }}" 
			hx-target="none"
			hx-include="#source_lang"
			class="btn btn-success mt-3 mb-2">
			Save
		</button>
	</form>
</div>

@endforeach
@else
<p>No source page found.</p> 
<p>Create a source text for this page before trying to translate it.</p> 
@endif
</div>
@endfragment

</x-layout>