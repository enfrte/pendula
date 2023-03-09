<div id="sentenceTranslationComponent" class="row g-2 pt-5">
	@foreach ($sourcePageTranslations as $translation)
		<hr>
		<div class="col-md-6">
			<p>{{ $translation->sentence_text }}</p>
		</div>

		<div class="col-md-6">
			<form>
				<input 
					type="hidden" 
					name="source_sentence_id" 
					value="{{ $translation->source_sentence_id }}">

				<textarea 
					class="form-control"
					name="translation" 
					rows="3">@if(!empty($translation->translation)){{ $translation->translation }}@endif</textarea>
				
				<button 
					id="translationUploadButton_{{ $translation->source_sentence_id }}"
					@if (!empty($translation->translation_id))
					hx-put="/translations/{{ $translation->translation_id }}" 
					@else
					hx-post="/translations" 
					@endif
					hx-include="#languageSelect"
					hx-swap="outerHTML"
					hx-target="this"
					class="btn btn-success mt-3 mb-2">
					Save
				</button>
			</form>
		</div>
	@endforeach
</div>