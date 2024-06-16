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
        <button type="submit" class="p-2 mx-2 border border-transparent rounded-xl hover:text-gray-600">
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

                            @if( auth()->user()->hasRole('admin') || auth()->user()->hasRole('teacher'))
                           <button class="btn btn-primary" onclick="openApprovalModal('{{$student_id}}')">Approval</button>
                           @endif
                           <button><a href="{{ route('ManageStudentRegistration.ViewStudentRegistrationForm', $student->student_id)  }}">
                                   View
                                </a></button>
                               <button> <a href="{{ route('ManageStudentRegistration.EditStudentRegistrationForm', $student->student_id)  }}"method="get">
                                   Edit
                                </a></button>
                                 {{-- Approval Modal --}}
                                 <div id="approvalModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                        </div>
                                        <span class="hidden sm:inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:ma-w-lg sm:w-full">
                                            <div><div class="mt-3 text-center sm:mt-5">
                                                <h3 class="text-lg leading-6 front-medium text-gray-900" id="modalTitle">Approve or Reject Registration</h3>
                                                <div class="mt-2"><p class="text-sm text-gray-500">Do you want to approve or reject this student registration?</p></div>
                                            </div></div>
                                            <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                                                <button type="button" class="btn btn-green w-full sm:ml-3 sm:w-auto sm:text-sm" onclick="updateRegistrationStatus('approved')">Approve</button>
                                                <button type="button" class="btn btn-red mt-3 w-full sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="updateRegistrationStatus('rejected')">Reject</button>
                                                <button type="button" class="btn btn-gray mt-3 w-full sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeApprovalModal()">Cancel</button>
                                            </div>
                            
                                        </span>

                                    </div>
                                 </div>

                                 <script>
                                    let currentStudentId=null;

                                    function openApprovalModal(student_id){
                                    currentStudentId = student_id;
                                    

                                    document.getElementById('approvalModal').classList,add('hidden');
                                    }

                                    function closeApprovalModal(){
                                        document.getElementById('approvalModal').classList.add('hidden');

                                    }

                                    function updateRegistrationStatus(status){
                                        if(!currentStudentId) return;
                                        fetch('/student-registration/update-status',{method:'POST', headers;{'Content-Type':'application/json', 'X-CRSF-TOKEN':'{{csrf_token()}}' }, body: JSON.stringify({student_id:currentStudentId, status:status})}).then(response => respinse.json()).then(data => { (data.success){location.reload();

                                        }else{
                                            alert('Failed to update status'); });
                                        
                                           closeApprovalModal(); 
                                    }
                                 </script>


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
