<script src="https://cdn.tailwindcss.com"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Wrapper untuk posisi tengah + animasi -->
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
  <!-- Tambahkan class animate-fadeIn -->
  <div class="form-panel panel-verification bg-white shadow-lg rounded-2xl p-8 max-w-md w-full animate-fadeIn">
    <div class="flex justify-center mb-6 pt-2">
      <img src="{{ asset('images/astacitalogo.png') }}" alt="Logo" class="w-auto h-12" />
    </div>

    <h2 class="text-lg font-semibold text-center text-red-600 mb-4">Check Your Email</h2>

    <p class="text-center text-gray-700 mb-6">
      A verification link has been sent to your email address. <br>
      Please check your inbox and click the link to activate your account.
    </p>

    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
      @csrf
      <button type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold flex items-center justify-center">
        <span class="spinner hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
        <span class="btn-text">Resend Verification Email</span>
      </button>
    </form>

    <div class="text-center text-sm pt-6 text-gray-500">
      Didn't receive the email? Click the button above to resend.
    </div>
  </div>
</div>


