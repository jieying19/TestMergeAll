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
            <form action="{{ route('ManageStudentRegistration.ViewStudentRegistrationForm', $student['student_id']) }}" method="post">
                @csrf
                <table class="rounded-xl px-4 w-6/6">
                    <tbody >
                        <tr>
                        <td class="px-4 py-2"><label>Student Name</label></td>
                        <td class="px-4 py-2"><disabled type="text" name="student_id" value="{{ $student->student_name}}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" ></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Age</label></td>
                            <td class="px-4 py-2"><disabled type="number" name="student_age" value="{{ $student->student_age}}" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Gender</label></td>
                            <td class="px-4 py-2"><disabled type="text" id="student_gender" name="student_gender" value="{{ $student->student_gender}}"  class="rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Registration Number</label></td>
                            <td class="px-4 py-2"><disabled type="text" name="student_birthRegNo" value="{{ $student->student_birthRegNo}}" class="form-control rounded-xl bg-gray-200 border border-slate-400"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student IC</label></td>
                            <td class="px-4 py-2"><disabled type="text" name="student_ic" value="{{ $student->student_ic}}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Health</label></td>
                            <td class="px-4 py-2"><disabled type="text" name="student_health" value="{{ $student->student_health}}"   class="form-control rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Place</label></td>
                            <td class="px-4 py-2"><disabled type="text" name="student_birthPlace" value="{{ $student->student_birthPlace}}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birthday</label></td>
                            <td class="px-4 py-2"><disabled type="text" name="student_birthday" value="{{ \Carbon\Carbon::createFromFormat('ymd', substr($student->student_ic, 0, 6))->format('d/m/Y') }}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>

                        <tr>
                            <td class="px-4 py-2"><label>Student Home Address</label></td>
                            <td class="px-4 py-2"><disabled type="text" name="student_homeAddress" value="{{ $student->student_homeAddress}}"   class="form-control rounded-xl w-full bg-gray-200 border border-slate-400"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex justify-end px-4 py-2">
                    <div class="px-4">
                        <button class="btn border border-slate-400 bg-gray-400 px-3 py-2 rounded-xl hover:bg-gray-300" formaction="{{route('ManageStudentRegistration.StudentRegistrationList')}}">Back</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
