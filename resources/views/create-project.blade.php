<x-layout>

	<div class="container">
		<h1 class="mt-5">Create new poject</h1>

		<form action="/projects" method='post'>
			@csrf
			<div class="mb-3">
				<input name="title" type="text" class="form-control" placeholder="Project title">
			</div>
			<div class="mb-3">
				<textarea class="form-control" name="description" rows="3" placeholder="Description"></textarea>
			</div>
			<div class="mb-3">
				<select name="source_lang" class="form-select" aria-label="Default select example">
					<option selected>Select a source language</option>
					<option value="en">English</option>
				  </select>
			</div>
			<button type="submit" class="btn btn-primary">Create project</button>
		</form>
	</div>

</x-layout>