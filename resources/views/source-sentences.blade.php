<x-layout>

<h1 class="mt-5">Source sentences</h1>

<form class="mt-5">

	<p>Show some visualisation here. Like from github with the date squares.</p>

	<h2>Pages</h2>
	<p>If a project has no pages, show a button to add a page with the number 1 as default. If the user starts at 50, show all the previous as empty in the graphic.</p>

	<div class="row g-3 align-items-center pb-3">
		<div class="col-md-2">
			<label for="page_number" class="col-form-label">Page:</label>
		</div>
		<div class="col-md-2">
			<input name="page_number" id="page_number" class="form-control" min="1" max="1000" type="number" required>
		</div>
		<div class="col-md-8">
			<span class="form-text">Select page number of the translation.</span>
		</div>
	</div>

	<div class="row g-3 align-items-center pb-3">
		<div class="offset-md-2 col-md-9">
			<button type="button" class="btn btn-success">Load page</button>
		</div>
	</div>

	<div id="sentences" class="mb-3"></div>

</form>


<script>

	if (localStorage.page_number) {
		document.getElementById("page_number").value = localStorage.page_number + 1;		
	} else {
		localStorage.setItem("page_number", 1);
	}

	document.getElementById("page_number").addEventListener( 'change', (el) => {
		localStorage.setItem("page_number", el.target.value);
	} );

</script>

</x-layout>