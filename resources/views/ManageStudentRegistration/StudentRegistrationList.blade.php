<x-app-layout>
    <div class="h-full mb-5">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Student Registration List
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
            @include('components.searchbar')
            @if(auth()->user()->role === 'KAFAadmin' || auth()->user()->role === 'Parent')
                <a href="{{ route('ManageStudentRegistration.AddStudentRegistrationForm') }}"
                    class="p-2 mx-2 border border-transparent rounded-xl hover:text-gray-600"
                    style="background-color: #00AEA6;">
                    Add Student Registration
                </a>
            @endif
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
            @if(auth()->user()->role === 'MUIPadmin' || auth()->user()->role === 'Teacher' || auth()->user()->role === 'KAFAadmin')
                <form action="{{ route('ManageStudentRegistration.ViewStudentRegistrationReport') }}" method="post">
                    @csrf
                    <!-- Add form inputs here -->
                    <button type="submit" class="p-2 mx-2 border border-transparent rounded-xl hover:text-gray-600"
                        style="background-color: #00AEA6;"> Generate Report</button>
                </form>
            @endif
        </div>
        {{-- Success message if student registration information added successfully --}}
        @if (session('success'))
            <div class="bg-green-500 p-1 mx-1 mb-3 rounded-xl text-white text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-300 rounded-xl w-full px-4 overflow-y-auto h-4/5 mb-5"
            style="max-height: 26rem">
            <table class="table-auto w-full text-center">
                <thead class="sticky top-0 bg-white">
                    <tr>
                        <th class="py-4">NO.</th>
                        <th class="py-4">STUDENT NAME</th>
                        <th class="py-4">STUDENT AGE</th>
                        <th class="py-4">STUDENT IC</th>
                        <th class="py-4">STATUS</th>
                        <th class="py-4">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Retrieve added student registration information --}}
                    @foreach ($students as $student)
                        <tr class="bg-gray-200 border-y-8 border-white">
                            <td class="py-2">{{ $loop->iteration }}</td>
                            <td class="py-2">{{ $student->student_name }}</td>
                            <td class="py-2">{{ $student->student_age }}</td>
                            <td class="py-2">{{ $student->student_ic }}</td>
                            <td class="py-2">{{ $student->student_regStatus }}</td>
                            <td class="flex justify-center">

                                @if(auth()->user()->role === 'KAFAadmin' || auth()->user()->role === 'teacher')
                                    <button class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                                        onclick="openApprovalModal('{{ $student->student_id }}')">Approval</button>
                                @endif


                                <div class="pl-3">
                                    <button class="p-2 bg-green-500 text-white rounded hover:bg-green-600"><a
                                            href="{{ route('ManageStudentRegistration.ViewStudentRegistrationForm', $student->student_id)  }}">View</a></button>
                                </div>

                                @if(auth()->user()->role === 'KAFAadmin' || auth()->user()->role === 'Parent')
                                    <div class="pl-3">
                                        <button class="p-2 bg-yellow-500 text-white rounded hover:bg-yellow-600"> <a
                                                href="{{ route('ManageStudentRegistration.EditStudentRegistrationForm', $student->student_id)  }}"
                                                method="get">Edit</a></button>
                                    </div>
                                @endif

                                {{-- Approval Modal --}}
                                <div id="approvalModal_{{ $student->student_id }}"
                                    class="hidden approval-modal fixed z-10 inset-0 overflow-y-auto">
                                    <div
                                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                        </div>
                                        <div
                                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="sm:flex sm:items-start">
                                                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">
                                                        Approve or Reject Registration</h3>
                                                    <div class="mt-2">
                                                        <p class="text-sm text-gray-500">Do you want to approve or reject
                                                            this student registration?
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse justify-center space-x-5">
                                                {{-- Approve Form --}}
                                                <form
                                                    action="{{ route('approveStudentRegistration', $student->student_id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="p-2 px-3 bg-green-500 text-white rounded hover:bg-green-600"
                                                        onclick="closeApprovalModal()">Approve</button>
                                                </form>
                                                &nbsp;&nbsp;
                                                {{-- Reject Form --}}
                                                <form
                                                    action="{{ route('rejectStudentRegistration', $student->student_id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button type="submit"
                                                        class="p-2 px-3 bg-red-500 text-white rounded hover:bg-red-600"
                                                        onclick="closeApprovalModal()">Reject</button>
                                                </form>
                                                {{-- Cancel Button --}}
                                                <button type="button"
                                                    class="p-2 px-3 bg-gray-500 text-white rounded hover:bg-gray-600"
                                                    onclick="closeApprovalModal()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- Confirmation on student registration information deletion --}}
                                <script>
                                    function confirmDeleteStudentRegistration() {
                                        return confirm('Are you sure you want to delete the student registration information?');
                                    }
                                </script>
                                @if(auth()->user()->role === 'KAFAadmin')
                                    {{-- Delete student registration information --}}
                                    <form action="{{ route('deleteStudentRegistration', $student['student_id']) }}"
                                        method="post">
                                        @csrf
                                        <div class="pl-3"><button class="p-2 bg-red-500 text-white rounded hover:bg-red-600"
                                                type="submit" onclick="return confirmDeleteStudentRegistration()">
                                                Delete
                                            </button></div>
                                    </form>
                                @endif
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- JavaScript to handle modal --}}
    <script>
        function openApprovalModal(studentId) {
            document.getElementById('approvalModal_' + studentId).classList.remove('hidden');
        }

        function closeApprovalModal() {
            document.querySelectorAll('.approval-modal').forEach(modal => {
                modal.classList.add('hidden');
            });
        }
    </script>
</x-app-layout>