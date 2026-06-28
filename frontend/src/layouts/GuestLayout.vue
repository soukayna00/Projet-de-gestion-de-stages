<script setup>
import Navbar from '../components/shared/Navbar.vue'
import Footer from '../components/shared/Footer.vue'
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Navbar/>
        <main class="flex-1">
            <slot />
        </main>
        <Footer/>
    </div>
</template>