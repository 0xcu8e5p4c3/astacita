<!-- Required Libraries -->
<script src="https://unpkg.com/alpinejs" defer></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile</title>
</head>

<section x-data="{ 
    editMode: false,
    isSubmitting: false,
    notification: {
        show: false,
        message: '',
        type: 'success'
    },
    showNotification(type, message) {
        this.notification.type = type;
        this.notification.message = message;
        this.notification.show = true;
        
        setTimeout(() => {
            this.notification.show = false;
        }, 4000);
    }
}" class="w-full bg-white dark:bg-gray-900">
    <!-- Notification Component -->
    <div x-show="notification.show" 
         x-transition:enter="animate__animated animate__fadeInDown"
         x-transition:leave="animate__animated animate__fadeOutUp"
         :class="notification.type === 'success' ? 'bg-green-50 border-green-400 text-green-700' : 'bg-red-50 border-red-400 text-red-700'"
         class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 flex items-center p-4 mb-4 border-l-4 rounded-r shadow-md max-w-md w-full">
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg" 
             :class="notification.type === 'success' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500'">
            <template x-if="notification.type === 'success'">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            </template>
            <template x-if="notification.type === 'error'">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </template>
        </div>
        <div class="ml-3 text-sm font-medium" x-text="notification.message"></div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 rounded-lg p-1.5 inline-flex h-8 w-8 hover:bg-gray-100 dark:hover:bg-gray-700" 
                :class="notification.type === 'success' ? 'text-green-500 bg-green-50 hover:bg-green-100' : 'text-red-500 bg-red-50 hover:bg-red-100'"
                @click="notification.show = false">
            <span class="sr-only">Close</span>
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>

    <div class="bg-white dark:bg-gray-900">
        <!-- Cover Image with Overlay -->
        <div class="relative w-full">
            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw5fHxjb3ZlcnxlbnwwfDB8fHwxNzEwNzQxNzY0fDA&ixlib=rb-4.0.3&q=80&w=1080"
                alt="User Cover"
                class="w-full h-64 sm:h-72 md:h-80 lg:h-96 object-cover hidden sm:block" />
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-30 hidden sm:block"></div>
        </div>

        <!-- Profile Content -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="relative -mt-24 sm:-mt-16 flex flex-col items-center sm:items-start">
                <!-- Profile Image with Upload Option -->
                <div class="relative group z-10">
                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full overflow-hidden ring-4 ring-white dark:ring-gray-900 bg-white">
                        <img id="profileImage" src="{{ $profile->foto_profile ? $profile->foto_profile : 'https://picsum.photos/seed/'.$profile->id.'/400/250' }}"
                            alt="User Profile"
                            class="w-full h-full object-cover" />
                    </div>
                    
                    <div x-show="editMode" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full cursor-pointer" 
                        onclick="document.getElementById('profilePhotoInput').click()">
                        <div class="text-white text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- User Info Header -->
                <div class="w-full flex flex-col sm:flex-row items-center sm:items-end justify-between mt-4 sm:mt-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $profile->user->name ?? 'No Name' }}
                        </h1>
                        <p class="text-gray-600 dark:text-gray-300 mt-1">{{ ucfirst($role) }}</p>
                    </div>
                    
                    <!-- Edit Button -->
                    <button @click="editMode = !editMode" type="button"
                        class="mt-4 sm:mt-0 inline-flex items-center justify-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
                        :class="editMode ? 
                            'bg-gray-100 text-gray-700 hover:bg-gray-200 focus:ring-gray-500' : 
                            'bg-indigo-600 text-white hover:bg-indigo-700 focus:ring-indigo-500'">
                        <template x-if="!editMode">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </template>
                        <span x-text="editMode ? 'Cancel' : 'Edit Profile'"></span>
                    </button>
                </div>
            </div>

            <!-- Profile Form -->
            <form method="POST" action="{{ route('profile.update', $profile->id) }}" enctype="multipart/form-data" 
                class="mt-10"
                x-on:submit.prevent="
                    isSubmitting = true;
                    const form = $event.target;
                    const formData = new FormData(form);
                    
                    fetch(form.action, {
                        method: form.method,
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        isSubmitting = false;
                        if (data.success) {
                            showNotification('success', data.message || 'Profile updated successfully');
                            editMode = false;
                            
                            // Update profile image if a new one was uploaded
                            if (data.profile && data.profile.foto_profile) {
                                document.getElementById('profileImage').src = data.profile.foto_profile;
                            }
                        } else {
                            showNotification('error', data.message || 'Failed to update profile');
                        }
                    })
                    .catch(error => {
                        isSubmitting = false;
                        console.error('Error:', error);
                        showNotification('error', 'Something went wrong. Please try again.');
                    });
                ">
                @csrf
                @method('PUT')

                <!-- Hidden file input for profile photo -->
                <input type="file" id="profilePhotoInput" name="foto_profile" class="hidden" accept="image/*"
                    @change="
                        const file = $event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                document.getElementById('profileImage').src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        }
                    " />

                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <!-- Personal Information Section -->
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Personal Information</h2>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                <div x-show="!editMode" class="mt-1 text-gray-900 dark:text-white">{{ $profile->user->name }}</div>
                                <input x-show="editMode" type="text" name="name" value="{{ $profile->user->name }}"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm" />
                            </div>
                            
                            <!-- Birthdate -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Birth Date</label>
                                <div x-show="!editMode" class="mt-1 text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($profile->tgl_lahir)->format('d/m/Y') }}</div>
                                <input x-show="editMode" type="date" name="tgl_lahir" value="{{ $profile->tgl_lahir }}"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm" />
                            </div>
                            
                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender</label>
                                <div x-show="!editMode" class="mt-1 text-gray-900 dark:text-white">{{ ucfirst($profile->gender) }}</div>
                                <select x-show="editMode" name="gender"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm">
                                    <option value="male" @selected($profile->gender === 'male')>Male</option>
                                    <option value="female" @selected($profile->gender === 'female')>Female</option>
                                </select>
                            </div>
                            
                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                                <div x-show="!editMode" class="mt-1 text-gray-900 dark:text-white">{{ $profile->user->email }}</div>
                                <input x-show="editMode" type="email" name="email" value="{{ $profile->user->email }}"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm" />
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Information Section -->
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Contact Information</h2>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                                <div x-show="!editMode" class="mt-1 text-gray-900 dark:text-white">{{ $profile->nomor_telepon }}</div>
                                <input x-show="editMode" type="text" name="nomor_telepon" value="{{ $profile->nomor_telepon }}"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm" />
                            </div>
                            
                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                                <div x-show="!editMode" class="mt-1 text-gray-900 dark:text-white whitespace-pre-line">{{ $profile->alamat }}</div>
                                <textarea x-show="editMode" name="alamat" rows="3"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white text-sm">{{ $profile->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Save Button -->
                    <div x-show="editMode" class="px-6 py-4 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 text-right">
                        <button type="submit"
                            class="inline-flex justify-center items-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 relative"
                            :class="{'opacity-75 cursor-not-allowed': isSubmitting}"
                            :disabled="isSubmitting">
                            <template x-if="isSubmitting">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </template>
                            <span x-text="isSubmitting ? 'Saving...' : 'Save Changes'"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>