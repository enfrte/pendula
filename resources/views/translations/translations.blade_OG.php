<x-layout>

	<h1 class="pt-3">Translations</h2>
		@fragment('error')
		@if (!empty($errorMessage))<p style="color:red;">{{ $errorMessage }}</p> @endif
		@endfragment

		@if ( $sourcePageExists )
		<div class="row align-items-center pt-3 pb-5">
			<p>Change pages</p>
			<div class="col-md-2">
				<input hx-post="/translation-upload/{{ $project_id }}" hx-target="#translation-upload" hx-swap="outerHTML" hx-trigger="change" name="page_num" class="form-control" min="1" max="1000" type="number" value="{{ $landingPage }}" required>
			</div>
		</div>

		<div class="mb-3">
			<div class="row g-2">
				<div class="col-md-6">
					<input type="search" name="language-search" hx-post="/languageSearch/translations" hx-target="#lang" hx-swap="outerHTML" hx-trigger="keyup changed delay:500ms, search" class="form-control" placeholder="Filter language selection">
				</div>
				<div class="col-md-6">
					@fragment('language-select')
					<select name="lang" id="languageSelect" class="form-select form-control" aria-label="Default select example">
						<option value>Select a translation language</option>
						@isset($languages)
						@foreach ($languages as $iso => $language)
						@if (!empty($saved_translation_lang) && $iso == $saved_translation_lang)
						<option selected value="{{ $iso}}">{{ $language }}</option>
						@else
						<option value="{{ $iso }}">{{ $language }}</option>
						@endif
						@endforeach
						@endisset
					</select>
					@endfragment
				</div>
			</div>
		</div>
		{{-- <pre>
	{{ print_r($sourcePageTranslations) }}
		</pre> --}}

		@fragment('translation-iteration')
		<div id="translation-upload" class="row g-2 pt-5">
			@foreach ($sourcePageTranslations as $translation)
			<hr>
			<div class="col-md-6">
				<p>{{ $translation->sentence_text }}</p>
			</div>

			<div class="col-md-6">
				<form>
					<input type="hidden" name="source_sentence_id" value="{{ $translation->source_sentence_id }}">

					<textarea class="form-control" name="translation" rows="3">@if(!empty($translation->translation)){{ $translation->translation }}@endif</textarea>

					@fragment('translation-upload')
					<button @if (!empty($translation->translation_id))
						hx-put="/translations/{{ $translation->translation_id }}"
						@elseif (!empty($translation_id))
						hx-put="/translations/{{ $translation_id }}"
						@else
						hx-post="/translations"
						@endif
						hx-include="#lang"
						hx-swap="outerHTML"
						hx-target="this"
						class="btn btn-success mt-3 mb-2">
						Save
					</button>
					@endfragment
				</form>
			</div>
			@endforeach
		</div>
		@endfragment
		@else
		<div class="pt-5">
			<p>No source page found.</p>
			<p>Create a source text for this page before trying to translate it.</p>
		</div>
		@endif
</x-layout>