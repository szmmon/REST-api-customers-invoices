<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Users
        </h2>
    </x-slot>
<div class="container py-10">
    <table class="min-w-full divide-y divide-gray-200 mx-auto">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{$user->id}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$user->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$user->email}}</td>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table> 
</div>
</x-app-layout>