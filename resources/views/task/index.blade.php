@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<!-- Page Heading -->
<header>
    <p class="mb-2 text-sm font-semibold text-blue-600">Task Manager</p>
</header>
<!-- End Page Heading -->

<!-- Card Section -->
<div class="container mx-auto">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('tasks.create') }}" class="py-2 px-3 mr-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    Create Task
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" /></svg>
                </a>
            </div>
            <div class="py-2 px-6 text-gray-900 dark:text-gray-100">
                <select name="projects"
                    class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                    <option value="">Select project</option>
                    @foreach ($projects as $key => $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
            </div>
            
            @session('success')
            <div class="px-6">
                <p class="text-md font-bold" style="color: green;">{{ $value }}</p>
            </div>
            @endsession

            <div class="grid grid-cols-12 p-6">
                <div class="col-span-12 h-52">
                    <div class="flex flex-col bg-white shadow-sm rounded-md dark:bg-slate-900 dark:border-gray-700">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-sm font-medium text-gray-500 uppercase">Task</th>
                                                <th scope="col" class="px-6 py-3 text-start text-sm font-medium text-gray-500 uppercase">Project</th>
                                                <th scope="col" colspan="2" class="px-6 py-3 text-right text-sm font-medium text-gray-500 uppercase">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 tasks" id="sortable">
                                            @foreach ($tasks as $key => $task)
                                            <tr data-task-id="{{ $task->id }}" data-project-id="{{ $task->project ? $task->project->id : '' }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $task->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                    <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">
                                                        {{ $task->project->name }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium flex justify-end gap-x-3">
                                                    <a href="{{ route('tasks.edit', ['id' => $task->id]) }}" 
                                                        class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" 
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('tasks.destroy', ['id' => $task->id]) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" 
                                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-600 hover:text-red-800 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:hover:text-red-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                                            style="color: red">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Card Section -->
<script src="{{ asset('assets/js/drag-drop.js?v=3.0.2') }}"></script>
  
<script>
    $("#sortable").sortable({
        stop: function( event, ui ) {
            var $e        = $(ui.item);
            var $prevItem = $e.prev();
            var $nextItem = $e.next();

            $.ajax({
                url: "{{ route('task.reOrderTask') }}",
                method: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    task_id: $e.data('task-id'),
                    prev_id: $prevItem ? $prevItem.data('task-id') : null,
                    next_id: $nextItem ? $nextItem.data('task-id') : null
                } 
            });
        }
    });

    $('[name="projects"]').on('change', function(){
        var $this = $(this);
        
        if( $this.val() ){
            $('.tasks tr').hide();

            $('.tasks tr')
                .filter( $(`[data-project-id="${$this.val()}"]`) )
                .show();

            return;
        } else {
            $('.tasks tr').show();
        }

    });
    
</script>
@endsection
