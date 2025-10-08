@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center gap-2 flex-wrap mb-6">
        <h2 class="text-2xl font-bold">{{ __('users.title') }}</h2>
        <div class="flex gap-2  flex-wrap">
            <button id="add-user-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                {{ __('users.add_user') }}
            </button>
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                {{ __('users.delete_selected') }}
            </button>
        </div>
    </div>

    <!-- Search -->
    <div class="relative mb-4">
        <input
            type="text"
            id="user-search"
            class="block w-full ps-10 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="{{ __('users.search_placeholder') }}"
        >
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
        </div>
    </div>

    <!-- Table -->
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
  

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th class="p-4">
                    <input id="select-all" type="checkbox" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </th>
                <th class="px-6 py-3">{{ __('users.name') }}</th>
                <th class="px-6 py-3">{{ __('users.email') }}</th>
                <th class="px-6 py-3">{{ __('users.role') }}</th>
                <th class="px-6 py-3 text-right">{{ __('users.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr data-user-id="{{ $loop->index }}" class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="p-4">
                    <input type="checkbox" class="user-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user['name'] }}
                </td>
                <td class="px-6 py-4">{{ $user['email'] }}</td>
                <td class="px-6 py-4">{{ $user['role'] ?? 'User' }}</td>
                <td class="px-6 py-4 text-right flex justify-end gap-2">
                    <button class="edit-btn bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                        {{ __('users.edit') }}
                    </button>
                    <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                        {{ __('users.delete') }}
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div id="user-modal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-96 relative">
        <h2 id="modal-title" class="text-xl font-bold mb-4">{{ __('users.add_user') }}</h2>

        <form id="user-form" class="flex flex-col gap-3">
            <input type="text" id="user-name" placeholder="{{ __('users.name') }}"
                class="border rounded p-2 dark:bg-gray-700 dark:text-white" required>
            <input type="email" id="user-email" placeholder="{{ __('users.email') }}"
                class="border rounded p-2 dark:bg-gray-700 dark:text-white" required>
            <select id="user-role" class="border rounded p-2 dark:bg-gray-700 dark:text-white">
                <option value="User">User</option>
                <option value="Admin">Admin</option>
            </select>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" id="close-modal"
                    class="px-4 py-2 rounded bg-gray-400 hover:bg-gray-500 text-white">
                    {{ __('users.cancel') }}
                </button>
                <button type="submit"
                    class="px-4 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white">
                    {{ __('users.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
