<script setup>
const socials = [
    { label: 'LinkedIn', icon: '💼' },
    { label: 'Twitter', icon: '🐦' },
    { label: 'Instagram', icon: '📸' },
]

const navLinks = [
    { label: 'Home' },
    { label: 'Browse Internships' },
    { label: 'For Companies' },
    { label: 'Sign In' },
    { label: 'Create Account' },
]

const legalLinks = [
    'Privacy Policy',
    'Terms of Service',
    'Cookie Policy'
]
</script>

<template>
    <footer class="font-body" style="background: #16425B;">
        <div class="max-w-7xl mx-auto px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

                <div class="md:col-span-2">
                    <p class="text-2xl font-bold mb-4"
                       style="font-family: 'Playfair Display', serif; color: white;"
                    >
                        TalentBridge
                    </p>
                    <p class="text-sm leading-relaxed mb-6 max-w-sm"
                       style="color: rgba(217,220,214,0.6);"
                       >
                        The smarter way to find, apply, and land your dream internship.
                        Connecting students with the best companies since 2024.
                    </p>

                    <div class="flex imtes-center gap-3">
                        <a v-for="social in socials" :key="social.label" href="#"
                           class="w-9 h-9 rounded-xl flex items-center justify-center text-sm transition-all duration-200 hover:-translate-y-0.5"
                           style="background: rgba(129,195,215,0.1);color: #81C3D7;border: 1px solid rgba(129,195,215,0.15);"
                           @mouseenter="$event.currentTarget.style.background='rgba(129,195,215,0.2)'"
                           @mouseleave="$event.currentTarget.style.background='rgba(129,195,215,0.1)'"
                        > {{ social.icon }}
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-semibold tracking-widest uppercase mb-5" style="color: #81C3D7;">
                        Navigation
                    </p>
                    <div class="space-y-3">
                        <a v-for="link in navLinks" :key="link.label" href="#"
                           class="block text-sm transition-colors duration-200"
                           style="color: rgba(217,220,214,0.55);"
                           @mouseenter="$event.currentTarget.style.color='#D9DCD6'"
                           @mouseleave="$event.currentTarget.style.color='rgba(217,220,214,0.55)'"
                        > {{ link.label }}
                        </a>
                    </div>
                </div>

                <div>
                    <p class="text-xs font-seimibold tracking-widest uppercase mb-5" style="color: #81C3D7;"
                    >Contact
                    </p>

                    <div class="space-y-3">
                        <p class="text-sm flex items-center gap-2" style="color: rgba(217,220,214,0.55);">
                            <span>📧</span> contact@talentBridge.ma
                        </p>
                         <p class="text-sm flex items-center gap-2" style="color: rgba(217,220,214,0.55);">
                            <span>📍</span> Morocco
                        </p>
                         <p class="text-sm flex items-center gap-2" style="color: rgba(217,220,214,0.55);">
                            <span>📞</span> +212 6XX XXX XXX
                        </p>
                    </div>

                    <div class="mt-6">
                        <p class="text-xs font-semibold tracking-widest uppercase mb-3"
                           style="color: #81C3D7;"
                        > Stay Updated
                        </p>
                        <div class="flex gap-2">
                            <input type="email" placeholder="Your Email" class="flex-1 px-3 py-2 rounded-xl text-sm outline-none"
                                   style="background: rgba(255,255,255,0.05); border: 1px solid rgba(129,195,215,0.2); color: white;"
                                   />
                            <button class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200"
                                    style="background: #81C3D7; color: #16425B;"
                                    @mouseenter="$event.currentTarget.style.background='#3A7CA5'; $event.currentTarget.style.color='white'"
                                    @mouseleave="$event.currentTarget.style.background='#81C3D7'; $event.currentTarget.style.color='#16425B'"
                                    > →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="border-top: 1px solid rgba(129,195,215,0.1);"></div>

        <div class="max-w-7xl mx-auto px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-3">
            <p class="text-xs" style="color: rgba(217,220,214,0.35);">
                &copy; 2026 TalentBridge — All rights reserved
            </p>
            <div class="flex items-center gap-6">
                <a v-for="legal in legalLinks" :key="legal" href="#"
                   class="text-xs transition-colors duration-200"
                   style="color: rgba(217,220,214,0.35);"
                   @mouseenter="$event.currentTarget.style.color='#81C3D7'"
                   @mouseleave="$event.currentTarget.style.color='rgba(217,220,214,0.35)'"
                >  {{ legal }}
                </a>
            </div>
        </div>
    </footer>
</template>