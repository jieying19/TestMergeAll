<x-app-layout>
    <div class="flex flex-col justify-evenly gap-y-3 h-full">
        {{-- Title --}}
        <div class="font-extrabold text-xl mt-2">
            Manage Users Payment
        </div>
        {{-- Content --}}
        <div class="flex flex-col bg-white border border-slate-300 rounded-xl px-5 py-3"
            style="min-height: 83.333333%; max-height:  83.333333%;">
            <div class="font-bold text-lg">
                List of Payments
            </div>

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

            <div class="flex justify-end w-full mb-5 relative right-0">
            <a href="{{ route('payment.create') }}"
                class="p-3 mx-3 border border-transparent rounded-xl hover:text-gray-600"
                style="background-color: #00AEA6;">
                Add New Payment
            </a>
            </div>

            {{-- Table --}}
            <div class="mt-5">
                <div class="mx-2 overflow-y-auto" style="max-height: 30rem;">
                    <table class="min-w-full table-auto">
                        <thead class="sticky top-0 bg-white">
                            <tr>
                                <th class="text-left py-2 px-2">User Name</th>
                                <th class="text-left py-2 px-2">amountOwed</th>
                                <th class="text-left py-2 px-2">amountPayed</th>
                                <th class="text-left py-2 px-2">paymentMethod</th>
                                <th class="text-left py-2 px-2">lastPayment</th>
                                <th class="text-left py-2 px-2">paymentStatus</th>
                                <th class="text-left py-2 px-2">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr class="border-t border-slate-400 bg-gray-100">
                                <td class="py-2 px-2">{{ $payment->userName }}</td>
                                <td class="py-2 px-2">{{ $payment->amountOwed }}</td>
                                <td class="py-2 px-2">{{ $payment->amountPayed }}</td>
                                <td class="py-2 px-2">{{ $payment->paymentMethod }}</td>
                                <td class="py-2 px-2">{{ $payment->lastPayment }}</td>
                                <td class="py-2 px-2">{{ $payment->paymentStatus }}</td>
                                <td class="py-2 px-2">
                                    <div class="flex space-x-4">
                                        <div id="myModal{{ $payment->id }}" class="modal">
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                <span class="close" data-id="{{ $payment->id }}">&times;</span>
                                                <h1>Card Number</h1>
                                                <p>{{ $payment->cardNumber }}</p>
                                                <h1>Card Bank Name</h1>
                                                <p>{{ $payment->bankName }}</p>
                                                <h1>Card Expiration Date</h1>
                                                <p>{{ $payment->cardExpDate }}</p>
                                                <h1>Card Holder Name</h1>
                                                <p>{{ $payment->cardHolderName }}</p>
                                            </div>
                                        </div>
                                        
                                        <button id="myBtn{{ $payment->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400 m-2"
                                                fill="none" viewBox="0 0 24 24" stroke="grey" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                            </svg>
                                        </button>

                                        <a href="{{ route('payment.edit', $payment->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400 m-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>

                                        <script>
                                        function confirmDeleteProduct() {
                                            return confirm('Are you sure you want to delete the product?');
                                        }
                                        </script>

                                        <form action="{{ route('payment.delete', $payment->id) }}" method="post">
                                            @csrf
                                            <button type="submit" onclick="return confirmDeleteProduct()">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 m-2"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        

<style type="text/css">
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal h1{
    font-weight: bold;
    color: #e5e7eb;
}

.modal p{
    margin-bottom: 20px;
    color: #e5e7eb;
}

/* Modal Content/Box */
.modal-content {
  background-color: #0c1446;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 20%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #00aea6;
  text-decoration: none;
  cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all the buttons and modals
    var buttons = document.querySelectorAll('[id^="myBtn"]');
    var modals = document.querySelectorAll('[id^="myModal"]');
    var spans = document.querySelectorAll('.close');

    // Add event listeners to each button
    buttons.forEach(function(button) {
        button.onclick = function() {
            var modalId = this.id.replace('myBtn', 'myModal');
            var modal = document.getElementById(modalId);
            modal.style.display = "block";
        }
    });

    // Add event listeners to each close span
    spans.forEach(function(span) {
        span.onclick = function() {
            var modalId = 'myModal' + this.getAttribute('data-id');
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }
    });

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        modals.forEach(function(modal) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }
});
</script>

</x-app-layout>