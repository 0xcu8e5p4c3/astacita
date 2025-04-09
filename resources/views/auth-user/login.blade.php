<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{ asset('css/loginflip.css') }}">
  <script src="{{ asset('js/loginflip.js') }}" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <title>Login Page</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

  <div class="card-container w-full max-w-md h-[550px] relative">
    <div id="flipWrapper" class="flip-wrapper">

      {{-- LOGIN PANEL --}}
      <div class="form-panel panel-user user-panel bg-white shadow-lg rounded-2xl p-8 flex flex-col justify-between active">
        <div>
          <div class="flex justify-center mb-6">
            <img src="{{ asset('images/astacitalogo.png') }}" alt="Logo" class="w-auto h-12" />
          </div>
          <p class="mt-2 pb-6 text-sm sm:text-base text-center text-gray-600">
            Please sign in to your account
          </p>
          <form id="loginForm" method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
              <input type="email" name="email" required
                class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
              <div class="relative">
                <input id="loginPassword" name="password" type="password" required
                  class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none pr-10" />
                <span onclick="togglePassword('loginPassword', 'eyeLogin')" class="absolute right-3 top-2.5 text-gray-500 cursor-pointer">
                  <i id="eyeLogin" class="fas fa-eye"></i>
                </span>
              </div>
            </div>
            <div class="flex items-center justify-between text-sm mt-1">
              <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-red-500" />
                <span class="ml-2 text-gray-700">Remember me</span>
              </label>
              <button type="button" onclick="flipTo('forgot')" class="text-red-600 hover:underline">Forgot password?</button>
            </div>
            <button id="loginSubmitBtn" type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold mt-2 flex items-center justify-center">
              <span class="spinner hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
              <span class="btn-text">Sign In</span>
            </button>

          </form>
        </div>

        <p class="text-center text-sm text-gray-700 mt-6">
          Don't have an account?
          <button onclick="flipTo('signup')" class="text-red-600 font-medium hover:underline">Sign up now</button>
        </p>
      </div>

      {{-- REGISTER PANEL --}}
      <div class="form-panel panel-signup signup-panel bg-white shadow-lg rounded-2xl p-8">
        <div class="flex justify-center mb-6 pt-2">
          <img src="{{ asset('images/astacitalogo.png') }}" alt="Logo" class="w-auto h-12" />
        </div>
        <h2 class="text-lg font-semibold text-center text-red-600 mb-4 pt-5">Create Account</h2>
        <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-4">
          @csrf
          <input type="text" name="name" placeholder="Full Name" required
            class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
          <input type="email" name="email" placeholder="Email address" required
            class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
          <div class="relative">
            <input id="signupPassword" name="password" type="password" placeholder="Password" required
              class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none pr-10" />
            <span onclick="togglePassword('signupPassword', 'eyeSignup')" class="absolute right-3 top-2.5 text-gray-500 cursor-pointer">
              <i id="eyeSignup" class="fas fa-eye"></i>
            </span>
          </div>
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required
            class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
            <button id="registerSubmitBtn" type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold flex items-center justify-center">
              <span class="spinner hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
              <span class="btn-text">Create Account</span>
            </button>

        </form>
        <div class="text-center text-sm pt-6">
          <button onclick="flipTo('user')" class="text-red-600 hover:underline">Back to Login</button>
        </div>
      </div>

      {{-- FORGOT PASSWORD PANEL --}}
      <div class="form-panel panel-forgot forgot-panel bg-white shadow-lg rounded-2xl p-8">
        <div class="flex justify-center mb-6 pt-2">
          <img src="{{ asset('images/astacitalogo.png') }}" alt="Logo" class="w-auto h-12" />
        </div>
        <h2 class="text-lg font-semibold text-center text-red-600 mb-4 pt-5">Forgot Password</h2>
        <form id="forgotForm" method="POST" action="{{ route('password.email') }}">
          @csrf
          <input type="email" name="email" placeholder="Enter your email" required
            class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
            <button id="forgotSubmitBtn" type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold mt-4 flex items-center justify-center">
              <span class="spinner hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
              <span class="btn-text">Send Reset Link</span>
            </button>

        </form>
        <div class="text-center text-sm pt-6">
          <button onclick="flipTo('user')" class="text-red-600 hover:underline">Back to Login</button>
        </div>
      </div>

    </div>
  </div>


</body>
</html>
