<x-app-layout>
    <div class="w-full">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Edit Student Registration
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
         
        </div>
        <div class="bg-white border border-slate-300 rounded-xl w-full p-3">
            <form action="{{ route('ManageStudentRegistration.UpdateStudentRegistrationForm', $student['student_id']) }}" method="post">
                @csrf
                <table class="rounded-xl px-4 w-full p-2">
                    <tbody >
                        <tr>
                        <td class="px-6 py-2 w-2/6"><label>Student Name</label></td>
                        <td class="px-11 py-2"><input type="text" name="student_name" value="{{ $student->student_name}}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-6 py-2 w-2/6"><label>Student Age</label></td>
                            <td class="px-11 py-2"><input type="number" name="student_age" value="{{ $student->student_age}}" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-6 py-2 w-2/6"><label>Student Gender</label></td>
                            <td class="px-11 py-2"><select name="student_gender" id="student_gender" value="{{ $student->student_gender}}"  required class="rounded-xl w-full bg-gray-200 border border-slate-400">
                            <option value="" disabled>--Select Gender--</option>
                            <option value="Male" {{ $student->student_gender === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $student->student_gender === 'Female' ? 'selected' : '' }}>Female</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td class="px-5 py-2 pr-0"><label>Student Birth Registration Number</label></td>
                            <td class="px-11 py-2"><input type="text" name="student_birthRegNo" value="{{ $student->student_birthRegNo}}" class="form-control w-full rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student IC</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_ic" value="{{ $student->student_ic}}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Health</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_health" value="{{ $student->student_health}}"   class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Place</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_birthPlace" value="{{ $student->student_birthPlace}}"  class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Home Address</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_homeAddress" value="{{ $student->student_homeAddress}}"   class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-end px-4 py-2">
                    <div class="px-4">
                        <input type="submit" value="Submit" class="btn btn-success border border-slate-300 bg-emerald-500/80 px-3 py-2 rounded-xl hover:bg-emerald-400/80">
                    </div>
                    <div class="px-4">
                        <button class="btn border border-slate-400 bg-gray-400 px-3 py-2 rounded-xl hover:bg-gray-300" formaction="{{route('ManageStudentRegistration.StudentRegistrationList')}}">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
