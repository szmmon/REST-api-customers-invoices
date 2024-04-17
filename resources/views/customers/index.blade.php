<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Customers
        </h2>
    </x-slot>
<div class="container py-10 px-6">
    <table class="min-w-full divide-y divide-gray-200 mx-auto">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Postal code</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
            </tr>
        </thead>
        <tbody class="bg-gray-100 divide-y divide-gray-200">
        @foreach($customers as $customer)            
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->id}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->name}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->type}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->email}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->city}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->postalCode}}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->address    }}</td>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table> 
</div>
</x-app-layout>