<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <title>Login Page</title>
  <style>
    .form-panel {
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.5s ease;
      backface-visibility: hidden;
      transform-style: preserve-3d;
    }

    .form-panel.active {
      opacity: 1;
      pointer-events: auto;
      z-index: 10;
    }

    .card-container {
      perspective: 1500px;
      position: relative;
      width: 100%;
      height: 100%;
    }

    .flip-wrapper {
      transition: transform 0.8s ease-in-out;
      transform-style: preserve-3d;
      position: relative;
      width: 100%;
      height: 100%;
    }

    .form-panel {
      backface-visibility: hidden;
      position: absolute;
      width: 100%;
      height: 100%;
      border-radius: 1rem;
      top: 0;
      left: 0;
    }

    .user-panel { z-index: 5; transform: rotateY(0deg); }
    .signup-panel { transform: rotateY(180deg); }
    .forgot-panel { transform: rotateY(-180deg); }
    .rotate-y-right { transform: rotateY(180deg); }
    .rotate-y-left { transform: rotateY(-180deg); }
  </style>
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
          <form method="POST" action="{{ route('login') }}" class="space-y-4">
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
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold mt-2">
              Sign In
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
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
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
          <button type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold">
            Create Account
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
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <input type="email" name="email" placeholder="Enter your email" required
            class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
          <button type="submit" class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold mt-4">
            Send Reset Link
          </button>
        </form>
        <div class="text-center text-sm pt-6">
          <button onclick="flipTo('user')" class="text-red-600 hover:underline">Back to Login</button>
        </div>
      </div>

    </div>
  </div>

  <script>
    const wrapper = document.getElementById('flipWrapper');
    const panels = document.querySelectorAll('.form-panel');

    function flipTo(target) {
      wrapper.classList.remove('rotate-y-left', 'rotate-y-right');
      panels.forEach(p => p.classList.remove('active'));

      if (target === 'signup') {
        wrapper.classList.add('rotate-y-right');
      } else if (target === 'forgot') {
        wrapper.classList.add('rotate-y-left');
      }

      setTimeout(() => {
        document.querySelector(`.panel-${target === 'user' ? 'user' : target}`).classList.add('active');
      }, 400);
    }

    function togglePassword(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      input.type = input.type === "password" ? "text" : "password";
      icon.classList.toggle("fa-eye");
      icon.classList.toggle("fa-eye-slash");
    }
  </script>

</body>
</html>
