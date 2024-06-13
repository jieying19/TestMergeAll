<x-app-layout>
    {{-- Title --}}
    <div class="font-extrabold text-xl mt-2">
        Add Kafa Activity
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('storeKafaActivity') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="activity_name" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   required autofocus/>
                            @error('activity name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="desc" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                            <textarea name="activity_desc" id="activity_desc" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                                      rows="4" required></textarea>
                            @error('activity desc')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Date and Time:</label>
                            <input type="datetime-local" name="activity_dateTime" id="activity_dateTime" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    required autofocus/>
                            @error('activity_dateTime')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="age" class="block text-gray-700 text-sm font-bold mb-2">Age:</label>
                            <input type="number" name="activity_studentAge" id="age" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('age') }}" required autofocus min="1" max="120"/>
                            @error('age')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>                        
                        <div class="mb-4">
                            <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment:</label>
                            <textarea name="activity_comment" id="comment" class="form-textarea rounded-md shadow-sm mt-1 block w-full"
                                      rows="4" required></textarea>
                            @error('comment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-end px-4 py-2">
                            <div class="px-4">
                                <input type="reset" value="Reset" class="btn border border-slate-400 bg-gray-400 px-3 py-2 rounded-xl hover:bg-gray-300">
                            </div>
                            <div class="px-4">
                                <input type="submit" value="Save" class="btn btn-success border border-slate-300 bg-emerald-500/80 px-3 py-2 rounded-xl hover:bg-emerald-400/80">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
