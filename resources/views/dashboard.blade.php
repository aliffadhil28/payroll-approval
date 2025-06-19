<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if (Auth::user()->role != 'director')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Welcome to the dashboard!') }}
                    </div>
                @else
                    @foreach ($payrollRequests as $data)
                        <div
                            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <div class="flex gap-2 justify-between mb-2">
                                <div>
                                    <label for="request_for"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                        For</label>
                                    <input type="text" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ $data->payroll->user->name }}" />
                                </div>
                                <div>
                                    <label for="request_by"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Request
                                        By</label>
                                    <input type="text" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ $data->user->name }}" />
                                </div>
                            </div>
                            <div class="flex gap-2 justify-between mb-2">
                                <div>
                                    <label for="request_for"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                                    <input type="text" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ $data->payroll->basic_salary }}" />
                                </div>
                                <div>
                                    <label for="request_by"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Net
                                        Pay</label>
                                    <input type="text" disabled
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ $data->net_pay }}" />
                                </div>
                            </div>
                            <div class="border rounded p-3">
                                <label for="request_by"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment
                                    Slip</label>
                                <img src="{{ asset('storage/payment_slips/' . $data->payment_slip) }}"
                                    class="object-cover" height="1000" width="750" alt="">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
