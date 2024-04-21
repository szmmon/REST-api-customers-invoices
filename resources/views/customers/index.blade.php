<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Customers
        </h2>
    </x-slot>
<h1 class="px-6 font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Filters</h1>
<div x-data="{ open: false }">
    <button x-on:click="open = ! open" class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">Toggle Dropdown</button>

    <form method="POST" action="{{ route('customers.filterResult') }}"
        class="px-4 flex flex-col" x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        @csrf
        <div class="flex flex-col py-2">
            <label for="type" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Type:
            </label>
            <select name="type" id="type" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4">
                <option value="" selected="">All</option>
                <option value="I">Individual client</option>
                <option value="B">Business client</option>
            </select>
        </div>
        
        <div class="flex flex-col py-2">
            <label for="name" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Name:
            </label>
            <input type="text" placeholder="Input full name" id="name" name="name" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>

        <div class="flex flex-col py-2">
            <label for="email" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Email:
            </label>
            <input type="text" placeholder="Input full email" id="email" name="email" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>
        <div class="flex flex-col py-2">
            <label for="city" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">City:
            </label>
            <input type="text" placeholder="Input full city" id="city" name="city" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500" value="">
        <div class="flex flex-col py-2">
            <label for="Postal code" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Postal code:
            </label>
            <input type="number" placeholder="Min value" name="postalCodeMin" id="postalCodeMin" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
            <input type="number" placeholder="Max value" name="postalCodeMax" id="postalCodeMax" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>
        <div class="flex flex-col py-2">
            <label for="address" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Address:
            </label>
            <input type="text" placeholder="Input full address" name="address" id="address" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>
        <button type="submit" class=" w-1/4 rounded bg-neutral-100 px-6 py-2 pb-2 pt-2.5 text-xl font-large uppercase leading-normal text-black shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">Filter</button>
    </form>
    </div>
</div>

<div class="container py-10 px-4">
    <table class="min-w-1/2 divide-y divide-gray-200 mx-auto">
        <thead>
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Postal code</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
            </tr>
        </thead>
        <tbody class="bg-gray-100 divide-y divide-gray-200">
        @foreach($customers as $customer)            
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{$customer->id}}
                    <div x-data="{ open: false }">
                    <button x-on:click="open = ! open" class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-black shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">View Invoices</button>
                    <table class="w-1/4 bg-gray-100 divide-y divide-gray-200" 
                        x-show="open"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90">

                        <thead> 
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice Id</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amout</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Billed date</th>
                            <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid date</th>
                        </thead>
                        <tbody class="bg-gray-100 divide-y divide-gray-200">
                            @forelse($invoices as $invoice)
                                @forelse($invoice as $invoiceData)
                                <tr>
                                    @if($invoiceData->customerId == $customer->id)
                                        <td class="px-1 py-1">{{$invoiceData->id}}</td>
                                        <td class="px-1 py-1">{{$invoiceData->amount}}</td>
                                        <td class="px-1 py-1">{{$invoiceData->status}}</td>
                                        <td class="px-1 py-1">{{$invoiceData->billedDate}}</td>
                                        <td class="px-1 py-1">{{$invoiceData->paidDate}}</td>
                                    @endif
                                @empty
                                    <td>No invoices</td>
                                </tr>
                                @endforelse
                            @empty
                            @endforelse
                        </tbody>
                
                        </table>

                </td>
                <td class="px-3 py-4">{{$customer->name}}</td>
                <td class="px-3 py-4">{{$customer->type}}</td>
                <td class="px-3 py-4">{{$customer->email}}</td>
                <td class="px-3 py-4">{{$customer->city}}</td>
                <td class="px-3 py-4">{{$customer->postalCode}}</td>
                <td class="px-3 py-4">{{$customer->address}}</td>
            </tr>
        @endforeach
        </tbody>
    </table> 
    <div class="flex justify-center">
        <ul class="inline-flex py-2">
        @foreach($links as $link)
        <li class="">
            <a href="{{ route('customers.page', $link) }}" class="link-page h-8 px-5 text-gray-400 font-bold transition-colors duration-150 bg-white border border-r-0 border-gray-500 rounded-l-lg focus:shadow-outline hover:bg-indigo-100" value={{$link}} name={{$link}}>{{substr($link, 5)}}</a>
        </li>
        @endforeach
        </ul>
    </div>
</div>
</x-app-layout>