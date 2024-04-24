<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Invoices
        </h2>
    </x-slot>
<div class="px-6 font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-justify">Filters | <a href="{{route('invoices.createInvoice')}}">Create Invoice</a></div>
<div x-data="{ open: false }">
    <button x-on:click="open = ! open" class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">Toggle Dropdown</button>

    <form method="POST" action="{{ route('invoices.filterResult') }}
        class="px-4 flex flex-col" x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        @csrf
        <div class="flex flex-col py-2">
            <label for="status" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Status:
            </label>
            <select name="status" id="status" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4">
                <option value="" selected="">All</option>
                <option value="P">Paid</option>
                <option value="B">Billed</option>
                <option value="V">Void</option>
            </select>
        </div>
        
        <div class="flex flex-col py-2">
            <label for="id" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Id:
            </label>
            <input type="number" placeholder="Input invoice id" id="id" name="id" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>
        <div class="flex flex-col py-2">
            <label for="customerId" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Customer Id:
            </label>
            <input type="number" placeholder="Input full Customer Id" name="customerId" id="customerId" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>
        <div class="flex flex-col py-2">
            <label for="paidDate" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Paid Date:
            </label>
            <input type="text" placeholder="Input full Paid Date" id="paidDate" name="paidDate" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
        </div>
        <div class="flex flex-col py-2">
            <label for="billedDate" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Billed Date:
            </label>
            <input type="text" placeholder="Input full Billed Date" id="billedDate" name="billedDate" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500" value="">
        <div class="flex flex-col py-2">
            <label for="amount" class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Amount:
            </label>
            <input type="number" placeholder="Min value" name="amountMin" id="amountMin" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
            <input type="number" placeholder="Max value" name="amountMax" id="amountMax" class="md:w-80 px-3 h-10 rounded-l border-2 border-sky-500 focus:outline-none focus:border-sky-500 w-1/4" value="">
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
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">customerId</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Billed Date</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid date</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="bg-gray-100 divide-y divide-gray-200">
        @foreach($invoices as $invoice)            
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{$invoice->id}}</td>
                <td class="px-3 py-4">{{$invoice->customerId}}</td>
                <td class="px-3 py-4">{{$invoice->amount}}</td>
                <td class="px-3 py-4">{{$invoice->status}}</td>
                <td class="px-3 py-4">{{$invoice->billedDate}}</td>
                <td class="px-3 py-4">{{$invoice->paidDate}}</td>
                <td class="px-3 py-4">
                <a href="{{route('invoices.editInvoice', $invoice->id) }}"><button class="btn btn-secondary sm">edit</button></a>
                <a href="{{route('invoices.generateInvoice', $invoice->id) }}"><button class="btn btn-success sm">generate pdf</button></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table> 
    <div class="flex justify-center">
        <ul class="inline-flex py-2">
        @foreach($links as $link)
        <li class="">
            <a href="{{ route('invoices.page', $link) }}" class="link-page h-8 px-5 text-gray-400 font-bold transition-colors duration-150 bg-white border border-r-0 border-gray-500 rounded-l-lg focus:shadow-outline hover:bg-indigo-100" value={{$link}} name={{$link}}>{{substr($link, 5)}}</a>
        </li>
        @endforeach
        </ul>
    </div>
</div>
</x-app-layout>