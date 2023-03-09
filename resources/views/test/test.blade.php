<x-layout>

<h1>Test layout</h1>

<div hx-get="/fragmentTest" hx-trigger="load" hx-swap="innerHTML">...</div>
 

<div class="mb-3">
	<div class="row g-2">
		<div class="col-md-6">
			<input 
				type="search" 
				name="language-search"
				hx-post="/languageSearch2" 
				hx-target="#languageSelectContainer"
				hx-swap="innerHTML"
				hx-trigger="keyup changed delay:500ms, search" 
				class="form-control"
				placeholder="Type a language">
		</div>
		<div id="languageSelectContainer" class="col-md-6"></div>
	</div>
</div>

</x-layout>