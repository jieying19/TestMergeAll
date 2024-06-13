<x-app-layout>
    <div class="h-full mb-5">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Student Registration List
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
            @include('components.searchbar')
            <a href="{{ route('ManageStudentRegistration.AddStudentRegistrationForm') }}"
                class="p-2 mx-2 border border-transparent rounded-xl hover:text-gray-600"
                style="background-color: #00AEA6;">
                Add Student Registration
            </a>
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
        <form action="{{ route('ManageStudentRegistration.ViewStudentRegistrationReport') }}" method="post">
                @csrf
        <!-- Add form inputs here -->
        <button type="submit" class="p-2 mx-2 border border-transparent rounded-xl hover:text-gray-600"
        style="background-color: #00AEA6;"> Generate Report</button>
        </form>
        </div>
        {{-- Success message if student registration information added successfully --}}
        @if (session('success'))
            <div class="bg-green-500 p-1 mx-1 mb-3 rounded-xl text-white text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-slate-300 rounded-xl w-full px-4 overflow-y-auto h-4/5 mb-5" style="max-height: 26rem">
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
                            <button onclick="confirmAction({{ $student->id }})"> Approval</button>
                            <a href="{{ route('ManageStudentRegistration.ViewStudentRegistrationForm', $student->student_id)  }}">
                                   View
                                </a>
                                <a href="{{ route('ManageStudentRegistration.EditStudentRegistrationForm', $student->student_id)  }}"method="get">
                                   Edit
                                </a>
                                 {{-- Confirmation on student registration information approval --}}




                                {{-- Confirmation on student registration information deletion --}}
                                <script>
                                    function confirmDeleteStudentRegistration() {
                                        return confirm('Are you sure you want to delete the student registration information?');
                                    }
                                </script>
                                {{-- Delete student registration information --}}
                                <form action="{{ route('deleteStudentRegistration', $student['student_id']) }}" method="post">
                                    @csrf
                                    <button type="submit" onclick="return confirmDeleteStudentRegistration()">
                                        Delete
                                    </button>
                                </form>
                            </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{-- Confirmation dialog for approval --}}
<script>
        function confirmAction(student_id) {
            const result = confirm("Do you want to approve or reject the student?");
            if (result) {
                const action = prompt("Type 'approve' to approve or 'reject' to reject:");
                if (action === 'approve' || action === 'reject') {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/students/${student_id}/update-status`;
                    form.style.display = 'none';

                    const tokenInput = document.createElement('input');
                    tokenInput.name = '_token';
                    tokenInput.value = '{{ csrf_token() }}';
                    form.appendChild(tokenInput);

                    const statusInput = document.createElement('input');
                    statusInput.name = 'status';
                    statusInput.value = action === 'approve' ? 'approved' : 'rejected';
                    form.appendChild(statusInput);

                    document.body.appendChild(form);
                    form.submit();
                } else {
                    alert("Invalid action. Please type 'approve' or 'reject'.");
                }
            }
        }
</script>
    
</x-app-layout>
