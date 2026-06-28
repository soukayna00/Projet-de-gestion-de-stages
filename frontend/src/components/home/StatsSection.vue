<script setup>
import {ref , onMounted} from 'vue'

const stats = [
    { target: 500, suffix: '+', label: 'Internships Available' },
    { target: 200, suffix: '+', label: 'Companies Partner' },
    { target: 95,  suffix: '%', label: 'Placement Rate' },
]

const counts = ref([0,0,0])

function animationCount(index, target, duration = 3000){
    const start = performance.now()
    const update = (now) =>{
        const elapsed = now - start
        const progress = Math.min(elapsed / duration, 1)
        const ease = 1 - Math.pow(1 - progress, 3)
        counts.value[index] = Math.floor(ease * target)
        if(progress < 1) requestAnimationFrame(update)
        else counts.value[index] = target
    }
    requestAnimationFrame(update)
}

onMounted(() =>{
    stats.forEach((stat, i) =>{
        setTimeout(() => animationCount(i, stat.target), i * 200)
    })
})
</script>

<template>
    <section class="bg-white font-body py-10">
        <div class="max-w-7xl mx-auto px-8">
            <div 
                 class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x rounded-3xl overflow-hidden"
                 style="border: 1px solid rgba(129,195,215,0.25) ; box-shadow: 0 8px 40px rgba(22,66,91,0.08); divide-color: rgba(129,195,215,0.2);">
            
                <div v-for="(stat, i) in stats" :key="i"
                    class="flex flex-col items-center justify-center py-14 px-8 transition-all duration-300"
                    style="background: white;"
                    @mouseenter="$event.currentTarget.style.background='#F0F7FB'"
                    @mouseleave="$event.currentTarget.style.background='white'"
                    >

                 <p class="text-6xl font-bold mb-2 tabular-nums"
                    style="font-family: 'Playfair Display', serif; color: #16425B;">
                    {{ counts[i] }} <span style="color: #81C3D7;">{{ stat.suffix }}</span>
                </p>
                <div class="w-8 h-px my-3" style="background: rgba(129,195,215,0.5);"
                ></div>
                <p class="text-xs font-semibold tracking-widest uppercase"
                    style="color: #3A7CA5;">
                    {{ stat.label }}
                </p>
            </div>
        </div>
  </div>
    </section>
</template>