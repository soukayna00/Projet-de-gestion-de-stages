<script setup>
import { RouterLink } from 'vue-router';
import hero from '../../assets/images/Hero.jpg'
</script>

<template>
    <section class="relative bg-brand-darkest overflow-hidden min-h-screen flex items-center">
        <div class="absolute inset-0 z-0">
            <img v-bind:src="hero" alt="Hero" class="w-full h-full object-cover opacity-40"/>

            <div class="absolute inset-0" style="background: linear-gradient(105deg, #16425B 0%, rgba(22,66,91,0.85) 10%, rgba(47,102,144,0.5) 40%, rgba(58,124,165,0.1) 50%) ;"
            ></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-8 py-32 w-full">
             <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium mb-8 border"
                    style="background: rgba(129,195,215,0.1); border-color: rgba(129,195,215,0.3); color: #81C3D7; font-family:'DM Sans', sans-serif;"
                    >
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background: #81C3D7;"></span>
                    University Internship Platform
                </div>

                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6 text-white"
                    style="font-family: 'Playfair Display', serif; text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                            Find Your Perfect <span style="color:#81C3D7;">Internship</span>
                </h1>

                <p class="text-lg md:text-xl leading-relaxed mb-10" 
                   style="color: #D9DCD6; font-family:'DM Sans', sans-serif; font-weight: 300;"
                >
                     The smarter way to find, apply,<br/>
                     and land your dream internship.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <RouterLink to="/register" class="group flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-semibold text-base transition-all duration-300 " 
                                style="background: rgba(129,195,215,0.25); border: 1.5px solid rgba(129,195,215,0.6); color: white; font-family:'DM Sans', sans-serif; backdrop-filter: blur(8px); box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                Find Internships
                                <span class="group-hover:translate-x-1 transition-transform duration-300">→</span>
                    </RouterLink>

                    <RouterLink to="/register" class="flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-semibold text-base transition-all duration-300 " 
                                style="background: rgba(255,255,255,0.08); border: 1.5px solid rgba(217,220,214,0.3); color: #D9DCD6; font-family:'DM Sans', sans-serif; backdrop-filter: blur(8px);">
                                Post a Role
                                <span class="group-hover:translate-x-1 transition-transform duration-300">→</span>
                    </RouterLink>
                </div>
            </div>
        </div>
    </section>
</template>