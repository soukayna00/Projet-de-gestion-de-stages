<script setup>
const testimonials = [
  {
    name: 'Sarah M.',
    role: 'Web Development Intern',
    company: 'TechCorp',
    avatar: '👩‍💻',
    rating: 5,
    text: 'GestionStages made my internship search so much easier. I found my dream position in less than a week. The platform is intuitive and the companies are top quality.',
    tag: 'Intern',
  },
  {
    name: 'Youssef K.',
    role: 'HR Manager',
    company: 'MediaGroup',
    avatar: '👨‍💼',
    rating: 5,
    text: 'As a company, we found the perfect intern through this platform. The selection process is smooth and the candidates are well-prepared. Highly recommended!',
    tag: 'Company',
  },
  {
    name: 'Amina R.',
    role: 'Data Analyst Intern',
    company: 'FinanceMA',
    avatar: '👩‍🔬',
    rating: 5,
    text: 'The dashboard makes it super easy to track all my applications. I love how everything is organized in one place. Got hired after my very first application!',
    tag: 'Intern',
  },
]
</script>

<template>
  <section class="font-body py-24" style="background: #F7F9FC;">
    <div class="max-w-7xl mx-auto px-8">

      <!-- Header -->
      <div class="text-center mb-16">
        <span
          class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-5"
          style="background: rgba(22,66,91,0.06); color: #2F6690; border: 1px solid rgba(22,66,91,0.1);"
        >
          Testimonials
        </span>
        <h2
          class="text-4xl md:text-5xl font-bold mb-4"
          style="font-family: 'Playfair Display', serif; color: #16425B;"
        >
          What Our Users Say
        </h2>
        <p class="text-gray-400 text-lg">
          Trusted by hundreds of interns and companies
        </p>
      </div>

      <!-- Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div
          v-for="(t, i) in testimonials"
          :key="i"
          class="relative rounded-3xl p-8 group hover:-translate-y-1 transition-all duration-300"
          style="background: white; box-shadow: 0 2px 20px rgba(22,66,91,0.06); border: 1px solid rgba(129,195,215,0.15);"
          @mouseenter="$event.currentTarget.style.boxShadow='0 16px 40px rgba(22,66,91,0.1)'"
          @mouseleave="$event.currentTarget.style.boxShadow='0 2px 20px rgba(22,66,91,0.06)'"
        >
          <!-- Quote décoratif -->
          <span
            class="absolute top-6 right-8 text-6xl font-bold opacity-5 select-none leading-none"
            style="font-family: 'Playfair Display', serif; color: #16425B;"
          >"</span>

          <!-- Tag + Etoiles -->
          <div class="flex justify-between items-center mb-5">
            <span
              class="text-xs px-3 py-1 rounded-full font-semibold"
              :style="t.tag === 'Intern'
                ? 'background: rgba(129,195,215,0.12); color: #3A7CA5;'
                : 'background: rgba(22,66,91,0.06); color: #16425B;'"
            >
              {{ t.tag }}
            </span>
            <div class="flex gap-0.5">
              <span
                v-for="s in t.rating"
                :key="s"
                class="text-sm"
                style="color: #81C3D7;"
              >★</span>
            </div>
          </div>

          <!-- Texte -->
          <p class="text-gray-500 text-sm leading-relaxed mb-8">
            "{{ t.text }}"
          </p>

          <!-- Auteur -->
          <div class="flex items-center gap-4 pt-5" style="border-top: 1px solid rgba(129,195,215,0.15);">
            <div
              class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl flex-shrink-0"
              style="background: #F0F7FB;"
            >
              {{ t.avatar }}
            </div>
            <div>
              <p
                class="font-bold text-sm"
                style="font-family: 'Playfair Display', serif; color: #16425B;"
              >
                {{ t.name }}
              </p>
              <p class="text-xs text-gray-400">
                {{ t.role }} · {{ t.company }}
              </p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>