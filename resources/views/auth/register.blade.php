<x-guest-layout>
    <div class="flex min-h-screen bg-[#e8d8c4] p-4 lg:p-8">
        
        <div class="flex w-full bg-white rounded-[2rem] shadow-2xl overflow-hidden max-w-7xl mx-auto">
            
            <div class="hidden lg:block lg:w-1/2 p-6">
                <div class="w-full h-full rounded-[1.5rem] overflow-hidden shadow-inner">
                    <img src="{{ asset('images/login.jpg') }}" alt="Register Image" class="w-full h-full object-cover transform hover:scale-105 transition duration-700">
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-12">
                <div class="w-full max-w-md">
                    
                    <h2 class="text-4xl font-light text-[#561c24] mb-2 tracking-tight">Register</h2>
                    <p class="text-[#c7b7a3] mb-8">Join us! Please fill in the details to create your account.</p>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <div class="rounded-2xl border-2 border-[#e8d8c4] p-3 bg-white focus-within:border-[#6d2932] transition-all">
                            <label class="block text-[10px] font-bold text-[#6d2932] uppercase tracking-widest mb-1">Full Name</label>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                                   class="w-full border-none p-0 focus:ring-0 text-[#561c24] text-base placeholder-[#e8d8c4]" 
                                   placeholder="Ahmed Benjelloun">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />

                        <div class="rounded-2xl border-2 border-[#e8d8c4] p-3 bg-white focus-within:border-[#6d2932] transition-all">
                            <label class="block text-[10px] font-bold text-[#6d2932] uppercase tracking-widest mb-1">Email Address</label>
                            <input id="email" type="email" name="email" :value="old('email')" required 
                                   class="w-full border-none p-0 focus:ring-0 text-[#561c24] text-base placeholder-[#e8d8c4]" 
                                   placeholder="ahmed@example.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />

                        <div class="rounded-2xl border-2 border-transparent p-3 bg-[#e8d8c4]/30 focus-within:bg-white focus-within:border-[#c7b7a3] transition-all">
                            <label class="block text-[10px] font-bold text-[#c7b7a3] uppercase tracking-widest mb-1">Password</label>
                            <input id="password" type="password" name="password" required 
                                   class="w-full border-none p-0 bg-transparent focus:ring-0 text-[#561c24] text-base" 
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />

                        <div class="rounded-2xl border-2 border-transparent p-3 bg-[#e8d8c4]/30 focus-within:bg-white focus-within:border-[#c7b7a3] transition-all">
                            <label class="block text-[10px] font-bold text-[#c7b7a3] uppercase tracking-widest mb-1">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required 
                                   class="w-full border-none p-0 bg-transparent focus:ring-0 text-[#561c24] text-base" 
                                   placeholder="••••••••">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />

                        <div class="pt-4">
                            <button type="submit" class="w-full py-4 bg-[#561c24] hover:bg-[#6d2932] text-[#e8d8c4] font-bold rounded-2xl shadow-xl shadow-[#561c24]/20 transition-all uppercase tracking-widest text-sm">
                                Create Account
                            </button>
                        </div>

                        <div class="mt-8 text-center border-t border-[#e8d8c4] pt-6">
                            <p class="text-[#c7b7a3]">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-[#6d2932] font-bold hover:underline ml-1">
                                    Login here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>