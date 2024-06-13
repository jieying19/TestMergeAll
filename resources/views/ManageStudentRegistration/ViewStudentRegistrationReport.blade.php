<x-app-layout>

    {{-- Define printable object --}}
    <style>
        @media print {
            .print:last-child {
                page-break-after: auto;
            }

            html {
                height: auto;
            }

            body *,
            #afterTable,
            div {
                visibility: hidden;
            }

            #printable-section1,
            #printable-section1 * {
                visibility: visible;
                overflow: visible;
            }

            #printable-section1 {
                position: absolute;
                top: 15;
                margin: 0;
                padding: 5;
                right: 0;
                left: 0;
                height: 100%;
                /* max-width: 100%; */
            }

            #barchart {
                /* position: absolute; */
                height: 100%;
                top: 15;
                margin: 0;
                padding: 0;
                right: 0;
                left: 0;
            }

            #buttonP {
                display: none;
            }
        }
    </style>


    <div class="flex flex-col">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Student Registration Report
        </div>

        {{-- Content --}}

        <div class="flex justify-end w-full mb-5 relative right-0 items-center">

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">

                    <button
                        class="p-2 mx-2 inline-flex items-center border border-transparent rounded-xl hover:text-gray-600"
                        style="background-color: #00AEA6;">
                        Select Range
                        <svg class="ml-2 -mr-0.5 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                </x-slot>

                <x-slot name="content">

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Select Time Range') }}
                    </div>

                    <form action="{{ route('studentRegistrationReport') }}" method="post">
                        @csrf
                        <!-- Weekly Slot -->
                        <button type="submit" class="w-full">
                            <x-dropdown-link id="weeklySelect">
                                {{ __('Weekly') }}
                            </x-dropdown-link>
                            <input type="hidden" name="range" value="weekly">
                        </button>
                    </form>

                    <form action="{{ route('studentRegistrationReport') }}" method="post">
                        @csrf
                        <!-- Monthly Slot -->
                        <button type="submit" class="w-full">
                            <x-dropdown-link id="monthlySelect">
                                {{ __('Monthly') }}
                            </x-dropdown-link>
                            <input type="hidden" name="range" value="monthly">
                        </button>
                    </form>

                    <form action="{{ route('studentRegistrationReport') }}" method="post">
                        @csrf
                        <!-- Yearly Slot -->
                        <button type="submit" class="w-full">
                            <x-dropdown-link id="yearlySelect">
                                {{ __('Yearly') }}
                            </x-dropdown-link>
                            <input type="hidden" name="range" value="yearly">
                        </button>
                    </form>

                    <div class="border-t border-[#00AEA6]"></div>
                </x-slot>
            </x-dropdown>

            {{-- Buttons --}}
            {{-- Print dialog --}}
            <script>
                function printPage() {
                    window.print();
                }
            </script>

            <a href="{{ route('student.csv') }}"
                class="p-2 mx-2 inline-flex items-center border border-transparent rounded-xl hover:text-gray-600"
                style="background-color: #00AEA6;">
                Export .csv
                <img class="ml-1 hover:text-gray-600" src="{{ asset('images/Export CSV.svg') }}"
                    style="min-height: 40%; max-height:  65%;" /></a>

            <a href="#" class="p-2 mx-2 inline-flex items-center border border-transparent rounded-xl hover:text-gray-600"
                style="background-color: #00AEA6;" onclick="printPage()">
                Export .pdf
                <img class="ml-1 hover:text-gray-600" src="{{ asset('images/Export Pdf.svg') }}"
                    style="min-height: 40%; max-height:  65%;" />
            </a>
        </div>

        <div id="printable-section1" class="flex flex-col justify-between bg-white border border-slate-300 rounded-xl px-5 py-3 gap-y-11 mt-10 juj"
            style="min-height: 60%; max-height:  80%;">

            <div class="flex justify-between">
                <div class="font-bold text-lg">
                    Student Registration Overview
                </div>
                <div class="font-bold text-lg">
                    {{ $currentDate }}
                </div>
            </div>

            <div id="barchart" class="w-full h-full">

                <head>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        var ageDataUrl = '{{ route('ManageStudentAgeData', $range) }}';

                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function updateChart(range) {
                            var url = '{{ route('ManageStudentAgeData', ':range') }}';
                            url = url.replace(':range', range);

                            $.get(url, function(ageData) {
                                console.log('Age Data:', ageData); // Log the ageData

                                if (!ageData || ageData.length === 0) {
                                    // Handle empty or undefined ageData
                                    console.error('No data available.');
                                    return;
                                }

                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'Age');
                                data.addColumn('number', 'Count');

                                // Add rows for each age group
                                ageData.forEach(function(ageGroup) {
                                    data.addRow([ageGroup.age, ageGroup.count]);
                                });

                                var options = {
                                    chart: {
                                        title: 'Student Age Distribution',
                                        subtitle: 'Number of Students by Age Group',
                                    },
                                    bars: 'vertical'
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }).fail(function() {
                                console.error('Failed to retrieve data.');
                            });
                        }

                        function drawChart() {
                            // Add an event listener to the range dropdown
                            $('#weeklySelect, #monthlySelect, #yearlySelect').on('click', function() {
                                event.preventDefault();

                                var selectedRange = $(this).siblings
                                ('input[name="range"]').val();
                                updateChart(selectedRange);
                            });

                            // Load the default chart using the initial range
                            var initialRange = $('#weeklySelect').siblings('input[name="range"]').val();
                            updateChart(initialRange);
                        }
                    </script>
                </head>

                <div id="columnchart_material" class="w-full h-full p">
                </div>

            </div>

        </div>


        <div id="printable-section2" class="mb-5">
            <div class="font-bold text-lg my-2">
                Student Details
            </div>
            <div class="bg-white border border-slate-300 rounded-xl w-full px-4 overflow-y-auto h-4/5 max-h-80 mb-5">
                <table class="table-auto w-full text-center">
                    <thead class="sticky top-0 bg-white">
                        <tr>
                            <th class="py-4">Student ID</th>
                            <th class="py-4">Name</th>
                            <th class="py-4">Age</th>
                            <th class="py-4">Gender</th>
                            <th class="py-4">Birth Reg No</th>
                            <th class="py-4">IC</th>
                            <th class="py-4">Health Condition</th>
                            <th class="py-4">Birth Place</th>
                            <th class="py-4">Home Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr class="bg-gray-200 border-y-8 border-white">
                                <td class="py-2">{{ $student->student_id }}</td>
                                <td class="py-2">{{ $student->student_name }}</td>
                                <td class="py-2">{{ $student->student_age }}</td>
                                <td class="py-2">{{ $student->student_gender }}</td>
                                <td class="py-2">{{ $student->student_birthRegNo }}</td>
                                <td class="py-2">{{ $student->student_ic }}</td>
                                <td class="py-2">{{ $student->student_health }}</td>
                                <td class="py-2">{{ $student->student_birthPlace }}</td>
                                <td class="py-2">{{ $student->student_homeAddress }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</x-app-layout>