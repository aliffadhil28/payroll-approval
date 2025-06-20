<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="notRead">
        @if ($notRead > 0)
            <span
                class="absolute top-0 right-0 block h-4 w-4 transform translate-x-1/2 -translate-y-1/2 rounded-full bg-red-600 text-white text-xs leading-tight text-center">
                {{ $notRead }}
            </span>
        @else
            <span
                class="absolute top-0 right-0 block h-4 w-4 transform translate-x-1/2 -translate-y-1/2 rounded-full bg-gray-500 text-white text-xs leading-tight text-center">
                {{ $notRead }}
            </span>
        @endif
    </x-slot>

    <x-slot name="notification_list">
        @foreach ($notifications as $notification)
            <div
                class="block max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $notification->title }}</h5>
                <p class="font-normal text-gray-700 dark:text-gray-400">{{ $notification->message }}</p>
                <div class="flex justify-end">
                    <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            Mark as read
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
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
