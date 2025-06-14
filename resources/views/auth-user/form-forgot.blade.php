<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .spinner {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="form-panel panel-reset reset-panel bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <div class="flex justify-center mb-6 pt-2">
            <img src="{{ asset('images/astacitalogo.png') }}" alt="Logo" class="w-auto h-12" />
        </div>

        <h2 class="text-lg font-semibold text-center text-red-600 mb-4 pt-5">Reset Password</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Session Status (for other messages) -->
        @if (session('status') && session('status') != 'passwords.reset')
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form id="resetForm" method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <input type="email" 
                       name="email" 
                       placeholder="Enter your email" 
                       value="{{ old('email', $email ?? request()->email) }}"
                       required 
                       readonly
                       class="px-3 py-2 w-full border border-gray-300 rounded-md bg-gray-50 focus:ring-2 focus:ring-red-300 outline-none" />
            </div>

            <!-- New Password -->
            <div class="mb-4">
                <input type="password" 
                       name="password" 
                       placeholder="Enter new password" 
                       required 
                       minlength="8"
                       class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <input type="password" 
                       name="password_confirmation" 
                       placeholder="Confirm new password" 
                       required 
                       minlength="8"
                       class="px-3 py-2 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-red-300 outline-none" />
            </div>

            <!-- Submit Button -->
            <button id="resetSubmitBtn" 
                    type="submit" 
                    class="w-full bg-red-600 hover:bg-red-700 transition text-white py-2 rounded-lg font-semibold flex items-center justify-center">
                <span class="spinner hidden w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin mr-2"></span>
                <span class="btn-text">Reset Password</span>
            </button>
        </form>

        <div class="text-center text-sm pt-6">
            <a href="{{ route('login') }}" class="text-red-600 hover:underline">Back to Login</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('resetForm');
            const submitBtn = document.getElementById('resetSubmitBtn');
            const spinner = submitBtn.querySelector('.spinner');
            const btnText = submitBtn.querySelector('.btn-text');

            // Spinner and button disable on submit
            form.addEventListener('submit', function(e) {
                spinner.classList.remove('hidden');
                btnText.textContent = 'Resetting Password...';
                submitBtn.disabled = true;
            });

            // Password confirmation validation
            const password = document.querySelector('input[name="password"]');
            const confirmPassword = document.querySelector('input[name="password_confirmation"]');

            function validatePasswords() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords don't match");
                } else {
                    confirmPassword.setCustomValidity('');
                }
            }

            password.addEventListener('input', validatePasswords);
            confirmPassword.addEventListener('input', validatePasswords);
        });
    </script>
</body>
</html>
