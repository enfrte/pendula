<x-layout>

<h1 class="mt-5">Source sentences</h1>

<form action="/sourceSentences" method="POST" class="mt-5">
	@csrf
	<p>Show some visualisation here. Like from github with the date squares.</p>

	<h2>Pages</h2>
	<p>If a project has no pages, show a button to add a page with the number 1 as default. If the user starts at 50, show all the previous as empty in the graphic.</p>

	<div class="row g-3 align-items-center pb-3">
		<div class="col-md-2">
			<label for="page_number" class="col-form-label">Page:</label>
		</div>
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
				required>
		</div>
		<div class="col-md-8">
			<span class="form-text">Select page number of the translation.</span>
		</div>
	</div>

	<div class="row g-3 align-items-center pb-3">
		{{-- <div class="offset-md-2 col-md-9">
			<button hx-get="/sentence-upload" type="button" class="btn btn-success">Load page</button>
		</div> --}}
	</div>

	@fragment('sentence-upload')
	<div id="sentences">
		<input type="hidden" name="project_id" value="{{ $project_id ?? '' }}">
			{{--<input type="hidden" name="page_num">--}}
			<textarea class="form-control mb-3" name="sentences" rows="3" placeholder="Description"></textarea>
		<button type="submit" class="btn btn-primary">Upload sentences</button>
	</div>
	@endfragment

</form>


<script>

/* 	if (localStorage.page_number) {
		document.getElementById("page_number").value = localStorage.page_number + 1;		
	} else {
		localStorage.setItem("page_number", 1);
	}

	document.getElementById("page_number").addEventListener( 'change', (el) => {
		localStorage.setItem("page_number", el.target.value);
	} ); */

</script>

</x-layout>