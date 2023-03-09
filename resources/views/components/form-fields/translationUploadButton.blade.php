<button 
	id="translationUploadButton_{{ $source_sentence_id }}"
	hx-put="/translations/{{ $translation_id }}" 
	hx-include="#lang"
	hx-swap="outerHTML"
	hx-target="this"
	class="btn btn-success mt-3 mb-2">
	Save
</button>
