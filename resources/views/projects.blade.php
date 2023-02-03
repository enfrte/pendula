<x-layout>

@foreach ($projects as $project)
	<div class="card mt-5" id="project_container_{{ $project->id }}">
		<div class="card-body">
			<h5 class="card-title">{{ $project->title }}</h5>
			@if ($project->description)
				<p class="card-text">{{ $project->description }}</p>
			@endif
		</div>
		<div class="card-body">
			<a href="translate-sentences/{{ $project->id }}" class="card-link text-nowrap">Translate</a>
			<a href="/add-sentences/{{ $project->id }}" class="card-link text-nowrap">Add sentences</a>
			<a href="projects/{{ $project->id }}/edit" class="card-link text-nowrap">Edit project</a>
			<button 
				hx-delete="/projects/{{ $project->id }}" 
				hx-target="#project_container_{{ $project->id }}"
				hx-swap="outerHTML"
				class="card-link text-nowrap btn btn-link">
				Delete project
			</button>
		</div>
	</div>
@endforeach

</x-layout>