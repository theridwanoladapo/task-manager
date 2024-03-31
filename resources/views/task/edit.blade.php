@extends('layouts.app')

@section('title', 'Create Task')

@section('content')

<!-- Card Section -->
<div class="container mx-auto">
    <div class="max-w-2xl px-4 py-4 sm:px-6 lg:px-8 lg:py-4 mx-auto">
        <!-- Card -->
        <div class="bg-white border rounded-xl p-4 sm:p-7 dark:bg-slate-900">
            <form action="{{ route('tasks.update', ['id' => $task->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <!-- Section -->
                <div class="py-6 first:pt-0 last:pb-0 first:border-transparent border-gray-200 dark:border-gray-700 dark:first:border-transparent">
                    <h3 class="inline-block text-md font-medium dark:text-white">
                        Edit Task
                    </h3>

                    @session('success')
                    <div class="py-4">
                        <p class="text-md font-bold my-6" style="color: green;">{{ $value }}</p>
                    </div>
                    @endsession

                    <div class="mt-4 space-y-3">
                        <label for="project_id" class="block text-sm font-medium mb-2 dark:text-white">Project</label>
                        <select name="project_id"
                            class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                            <option selected>Select project</option>
                            @foreach ($projects as $key => $project)
                                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? "selected" : "" }}>{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id')
                        <p class="text-sm mt-2" style="color: #dc2626;">{{ $message }}</p>
                        @enderror

                        <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Name</label>
                        <input type="text" name="name" id="name"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" 
                            value="{{ $task->name }}" placeholder="Task Name">
                        @error('name')
                        <p class="text-sm mt-2" style="color: #dc2626;">{{ $message }}</p>
                        @enderror
                        
                        <label for="priority" class="block text-sm font-medium mb-2 dark:text-white">Priority</label>
                        <input type="text" name="priority" id="priority"
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" 
                            value="{{ $task->priority }}" placeholder="Task priority">
                        @error('priority')
                        <p class="text-sm mt-2" style="color: #dc2626;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- End Section -->
                <div class="mt-3 flex justify-end gap-x-2">
                    <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
        <!-- End Card -->
    </div>
</div>
<!-- End Card Section -->
@endsection