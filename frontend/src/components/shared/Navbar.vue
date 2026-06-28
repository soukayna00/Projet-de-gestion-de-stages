<script setup>
import { ref, onMounted , onUnmounted} from 'vue'
import { RouterLink } from 'vue-router'

const menuOuvert = ref(false)
const scrolled = ref(false)

function handleScroll() {
  scrolled.value = window.scrollY > 50
}

onMounted(()=> {
  window.addEventListener('scroll', handleScroll)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
})
</script>


<template>
    <nav class="absolute fixed top-0 left-0 w-full z-50 transition-all duration-500 shadow-lg shadow-gray-900/20 backdrop-filter backdrop-blur-lg "
         :style="scrolled ? 'background: linear-gradient(135deg, rgba(22,66,91,0.97) 0%,  rgba(47,102,144,0.97) 100%); backdrop-filter: blur(12px); box-shadow: 0 2px rgba(0,0,0,0.3);'
                          : 'background: linear-gradient(135deg, rgba(22,66,91,0.4) 0%, rgba(47,102,144,0.2) 60%, rgba(58,124,165,0.05) 100%); backdrop-filter: blur(4px);'"
        >

        <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">

            <!--------  LOGO  ------->
            <RouterLink to="/" class="flex items-center gap-2 group ">
                <span class="text-2xl font-bold tracking-tight text-white transition-all duration-300" 
                      style="font-family: 'Playfair Display', serif; text-shadow: 0 2px 8px rgba(0,0,0,0.3);"
                    >
                    TalentBridge
                    </span>
            </RouterLink>

            <!--------  MENU  ------->
            <div class="hidden md:flex items-center gap-2">
                <RouterLink to="/" class="relative px-4 py-2 text-sm font-medium tracking-widest uppercase transition-all duration-200 group"
                            style="color: rgba(217,220,214,0.9); font-family: 'DM Sans', snans-serif; letter-spacing: 0.1em;"
                >
                    <span class="group-hover:text-white transition-colors duration-200">Home</span>
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-brand-light group-hover:w-4 transition-all duration-300 rounded-full"></span>
                </RouterLink>

                <span style="color: rgba(129,195,215,0.4);" class="text-lg">|</span>

                <RouterLink to="/stagiaire/offres" class="relative px-4 py-2 text-sm font-medium tracking-widest uppercase transition-all duration-200 group"
                            style="color: rgba(217,220,214,0.9); font-family: 'DM Sans', snans-serif; letter-spacing: 0.1em;"
                >
                    <span class="group-hover:text-white transition-colors duration-200">Explore</span>
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-brand-light group-hover:w-4 transition-all duration-300 rounded-full"></span>
                </RouterLink>

                <span style="color: rgba(129,195,215,0.4);" class="text-lg">|</span>

                <RouterLink to="/a-propos" class="relative px-4 py-2 text-sm font-medium tracking-widest uppercase transition-all duration-200 group"
                            style="color: rgba(217,220,214,0.9); font-family: 'DM Sans', snans-serif; letter-spacing: 0.1em;"
                >
                    <span class="group-hover:text-white transition-colors duration-200">About Us</span>
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-brand-light group-hover:w-4 transition-all duration-300 rounded-full"></span>
                </RouterLink>

                <span style="color: rgba(129,195,215,0.4);" class="text-lg">|</span>

                <RouterLink to="/contact" class="relative px-4 py-2 text-sm font-medium tracking-widest uppercase transition-all duration-200 group"
                            style="color: rgba(217,220,214,0.9); font-family: 'DM Sans', snans-serif; letter-spacing: 0.1em;"
                >
                    <span class="group-hover:text-white transition-colors duration-200">Contact</span>
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-brand-light group-hover:w-4 transition-all duration-300 rounded-full"></span>
                </RouterLink>

                <RouterLink to="/register" class="ml-6 px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 relative overflow-hidden group"
                            style="background: linear-gradient(135deg, #81C3D7 0%, #3A7CA5 100%); color: #16425B ; font-family: 'DM Sans', snans-serif; box-shadow: 0 4px 15px rgba(129,195,215,0.4);"
                >
                    <span class="relative z-10 font-bold">Hire Talent</span>
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                         style="background: linear-gradient(135deg, #ffffff 0%, #81C3D7 100%);"
                    ></div>
                </RouterLink>

            </div>

            <!--------- Mobile menu button --------->
            <button @click="menuOuvert = !menuOuvert" class="md:hidden text-white text-2xl p-2">
                {{ menuOuvert ? '✕' : '☰' }}
            </button>
        </div>

        <!--------- Mobile menu --------->
        <div
            v-if="menuOuvert"
            class="md:hidden px-8 py-6 flex flex-col gap-4"
            style="background: linear-gradient(105deg, #16425B 0%, rgba(22,66,91,0.85) 50%); backdrop-filter: blur(12px);"
        >
           
           <RouterLink to="/" class="text-white text-sm tracking-widest uppercase font-medium hover:text-brand-light transition" @click="menuOuvert = false">Home</RouterLink>
           <RouterLink to="/stagiaire/offres" class="text-white text-sm tracking-widest uppercase font-medium hover:text-brand-light transition" @click="menuOuvert = false">Explore</RouterLink>
           <RouterLink to="/a-propos" class="text-white text-sm tracking-widest uppercase font-medium hover:text-brand-light transition" @click="menuOuvert = false">About Us</RouterLink>
           <RouterLink to="/contact" class="text-white text-sm tracking-widest uppercase font-medium hover:text-brand-light transition" @click="menuOuvert = false">Contact</RouterLink>
           <RouterLink to="/register" 
                        class="text-center px-6 py-3 rounded-xl font-bold text-sm shadow-lg transition-all duration-300"
                        style="background:  linear-gradient(135deg, #ffffff 0%, #81C3D7 100%); color: #16425B;"
                        @click="menuOvert = false"
            >
              Hire Talent
            </RouterLink>
        </div>
    
    </nav>
</template>