<x-app-layout>
    <div class="w-full" id="confetti" x-init="setTimeout(() => showConfetti(), 500)">
        <div class="min-h-screen h-full flex flex-col items-center justify-center bg-gray-100">
          <div class="max-w-md mx-auto text-center">
            <div class="flex items-center justify-center mb-6">
              <img src="https://static.vecteezy.com/system/resources/previews/017/177/933/original/round-check-mark-symbol-with-transparent-background-free-png.png" alt="" class="h-1/2 w-1/2">
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Survey Submitted - Thank You!</h1>
            <p class="text-lg text-gray-600 mb-8">We appreciate you taking the time to share your thoughts with us. Your feedback will help us improve our services and better serve you in the future.</p>
            <a href="/survey" class="inline-block px-6 py-3 bg-indigo-500 hover:bg-indigo-600 text-white rounded-lg font-semibold transition duration-200">Back to Home</a>
          </div>
        </div>
      </div>

      <script>
        function showConfetti() {        
            party.confetti(document.getElementById("confetti"), {
                count: 50,
            });
        }
      </script>
</x-app-layout>
