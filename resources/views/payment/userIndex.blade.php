<x-app-layout>
    <div class="flex flex-col justify-evenly gap-y-3 h-full">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Manage Your Bill
        </div>

        {{-- Content --}}
        <div class="flex flex-col bg-white border border-slate-300 rounded-xl px-5 py-3"
            style="min-height: 83.333333%; max-height:  83.333333%;">
            
            {{-- Message --}}
            @if (session('success'))
                <div class="mt-3 bg-green-200 text-green-800 px-4 py-2 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-3 bg-red-200 text-red-800 px-4 py-2 mb-4 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Bill Amount --}}
            <div>
                @php
                    $test = Auth::user()->name;
                    $payment = $payments->where('userName', $test)->first(); // Example to find payment with ID 1
                @endphp
                <p class="text-xl font-bold">Bill Amount</p>
                <p>{{ Auth::user()->name }}</p>
                @if ($payment)
                <p>{{ $payment->userName }}</p>
                <p>{{ $payment->amountOwed }}</p>
                <p>{{ $payment->amountPayed }}</p>
                @endif
            </div>

            {{-- Payment Form --}}
            <form action="{{ route('payment.userInsert', $payment->userName) }}" method="post" class="mt-5">
                @csrf
                @method('post')
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount to Pay</label>
                    <input type="number" name="amountPay" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Card Number</label>
                    <input type="text" name="cardNum" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Card CVV Number</label>
                    <input type="number" name="cvv" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                    <input type="text" name="holderName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Card Expiration Date</label>
                    <input type="date" name="expiration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Card Bank</label>
                    <select name="category" required class="rounded-xl w-2/5 border border-slate-400">
                                <option value="maybank">Maybank</option>
                                <option value="bankIslam">Bank Islam</option>
                                <option value="RHB">RHB</option>
                            </select>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Make Payment
                </button>
            </form>

            {{-- Messages --}}
            @if (session('success'))
                <div class="mt-3 bg-green-200 text-green-800 px-4 py-2 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-3 bg-red-200 text-red-800 px-4 py-2 mb-4 rounded-md">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>