<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test work</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1">
                <div class="p-6">
                    <div class="flex justify-around">
                        <div class="flex justify-center">
                            <div class="mb-3 w-96">
                                <form action="{{ route('employees.upload') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input onchange="this.form.submit();"
                                           class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal
                                            text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid
                                            border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700
                                            focus:bg-white focus:border-blue-600 focus:outline-none"
                                           type="file" name="file">
                                </form>
                            </div>
                        </div>

                        <div class="mb-3 xl:w-96">
                            <select onchange="window.location.assign('{{ url()->route('employees.index') . '/' }}' + this.value)"
                                    class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal
                                        text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid
                                        border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700
                                        focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Department">
                                <option {{ request()->department == null ? 'selected' : '' }} value="">All</option>
                                @foreach ($departments as $department)
                                    <option {{ request()->department == $department->id ? 'selected' : '' }}
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 xl:w-14">
                            <select  onchange="window.location.assign('{{ url()->current() . '?limit=' }}' + this.value)"
                                     class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal
                                        text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid
                                        border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700
                                        focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Limit">
                                <option {{ request()->limit == 10 ? 'selected' : '' }} value="10">10</option>
                                <option {{ request()->limit == 25 ? 'selected' : '' }} value="25">25</option>
                                <option {{ request()->limit == 50 ? 'selected' : '' }} value="50">50</option>
                                <option {{ request()->limit == 100 ? 'selected' : '' }} value="100">100</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="min-w-full">
                                        <thead class="border-b">
                                        <tr>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                #
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Name
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Birthday
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Position
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Payment type
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Payment
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                                Department
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($employees as $employee)
                                            <tr class="border-b">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    {{ $employee->id }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $employee->name }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $employee->birthday }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $employee->position }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $employee->payment_type === \App\Models\Employee::STATUS_RATE ? 'Rate' : 'Hourly rate' }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $employee->payment_type === \App\Models\Employee::STATUS_HOURLY_RATE
                                                        ? $employee->payment * \App\Models\Employee::DEFAULT_WORK_HOURS
                                                        : $employee->payment }}
                                                </td>
                                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                    {{ $employee->department->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    {{ $employees->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
