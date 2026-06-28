<script setup>
import GestLayout from '../layouts/GuestLayout.vue'
import HeroSection from '../components/home/HeroSection.vue'
import StatsSection from '../components/home/StatsSection.vue';
import FeaturesSection from '../components/home/FeaturesSection.vue';
import OffresRecentes from '../components/home/OffresRecentes.vue';
import HowItWorks from '../components/home/HowItWorks.vue';
import Testimonials from '../components/home/Testimonials.vue';
import CtaBanner from '../components/home/CtaBanner.vue';

</script>

<template>
    <GestLayout >
            <HeroSection />
            <StatsSection/>
            <FeaturesSection/>
            <OffresRecentes/>
            <HowItWorks/>
            <CtaBanner/>
            <Testimonials/>
            
    </GestLayout>

  
</template>