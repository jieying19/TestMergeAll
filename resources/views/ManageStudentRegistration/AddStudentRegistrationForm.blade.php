<x-app-layout>
    <div class="w-full">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Add Student Registration 
        </div>
        <div class="flex justify-end w-full mb-5 relative right-0">
            @include('components.searchbar')
        </div>
        {{-- Error message if there is exsiting product id --}}
        @if (session('error'))
            <div class="bg-red-500 p-1 mx-1 mb-3 rounded-xl text-white text-center">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white border border-slate-300 rounded-xl w-full p-3">
            <form action="{{ route('storeStudentRegistration') }}" method="post">
                @csrf
                <table class="rounded-xl px-4 w-6/6">
                    <tbody>
                        <tr>
                            <td class="px-4 py-2"><label>Student Name</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_name" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Age</label></td>
                            <td class="px-4 py-2"><input type="number" name="student_age" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                       <tr></tr>
                            <td class="px-4 py-2"><label>Student Gender</label></td>
                            <td class="px-4 py-2"><select name="student_gender" id="student_gender" required class="rounded-xl w-full bg-gray-200 border border-slate-400">
                                <option value="" disabled>--Select Gender--</diabledoption>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Registration Number</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_birthRegNo" class="form-control rounded-xl bg-gray-200 border border-slate-400" required></td>
                        </tr>
                   
                   
                        <tr>
                            <td class="px-4 py-2"><label>Student IC</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_ic" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Health</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_health" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Birth Place</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_birthPlace" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2"><label>Student Home Address</label></td>
                            <td class="px-4 py-2"><input type="text" name="student_homeAddress" class="form-control rounded-xl w-full bg-gray-200 border border-slate-400" required></td>
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
