<select 
	name="lang" 
	id="languageSelect" 
	class="form-select form-control" 
	aria-label="Default select example">
	<option value>Select a language</option>
	@isset($languages)
	@foreach ($languages as $iso => $language)
	@if (!empty($saved_translation_lang) && $iso == $saved_translation_lang)
	<option selected value="{{ $iso }}">{{ $language }}</option>
	@else
	<option value="{{ $iso }}">{{ $language }}</option>
	@endif
	@endforeach
	@endisset
</select>
