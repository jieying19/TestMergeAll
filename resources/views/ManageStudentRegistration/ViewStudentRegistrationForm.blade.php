<x-app-layout>
    <div class="w-full">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            View Student Registration
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
            @include('components.searchbar')
        </div>
        <div class="bg-white border border-slate-300 rounded-xl w-full p-3">
            <form action="{{ route('ManageStudentRegistration.ViewStudentRegistrationForm', $student['student_id']) }}"
                method="post">
                @csrf
                <table class="rounded-xl px-4 w-full">
                    <tbody>
                        <tr>
                            <td class="px-4 py-2"><label>Student Name</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_name }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Age</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_age }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Gender</label></td>
                            <td class="px-4 py-2"
                                class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_gender }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Registration Number</label></td>
                            <td class="px-4 py-2"
                                class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_birthRegNo }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student IC</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_ic }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Health</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_health }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Place</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_birthPlace }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birthday</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ \Carbon\Carbon::createFromFormat('ymd', substr($student->student_ic, 0, 6))->format('d/m/Y') }}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Home Address</label></td>
                            <td class="px-4 py-2">
                                <p class="form-control px-2 py-2 rounded-xl w-full bg-white border border-slate-400">
                                    {{ $student->student_homeAddress }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end px-4 py-2">
                    <div class="px-4">
                        <a href="{{ route('ManageStudentRegistration.StudentRegistrationList') }}"
                            class="btn border border-slate-400 bg-gray-400 px-3 py-2 rounded-xl hover:bg-gray-300">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>