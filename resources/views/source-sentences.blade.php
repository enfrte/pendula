<x-layout>

<h1>Source sentences</h1>

<form>
	<div class="mb-3">
		<input name="page_number" id="page_number" min="1" max="1000" type="number" required>
	</div>

	<button type="button" class="btn btn-success">Load page</button>

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