<template>
  <section class="font-body py-24 bg-white">
    <div class="max-w-7xl mx-auto px-8">

      <!-- Header -->
      <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
        <div>
          <span
            class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-4"
            style="background: rgba(22,66,91,0.06); color: #2F6690; border: 1px solid rgba(22,66,91,0.1);"
          >
            How It Works
          </span>
          <h2
            class="text-4xl md:text-5xl font-bold"
            style="font-family: 'Playfair Display', serif; color: #16425B;"
          >
            Get Started in<br/>
            <span style="color: #3A7CA5;">3 Simple Steps</span>
          </h2>
        </div>
        <p class="text-gray-400 max-w-xs text-sm leading-relaxed md:text-right">
          Simple, fast, and effective.<br/>
          Find your internship in minutes.
        </p>
      </div>

      <!-- Steps — layout horizontal avec ligne -->
      <div class="relative">

        <!-- Steps -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

          <!-- Step 1 -->
          <div
            class="relative rounded-3xl p-8 group hover:-translate-y-1 transition-all duration-300"
            style="background: #F0F7FB; border: 1px solid rgba(129,195,215,0.2);"
          >
            <!-- Numéro grand en arrière-plan -->
            <span
              class="absolute top-4 right-6 text-8xl font-bold opacity-5 select-none"
              style="font-family: 'Playfair Display', serif; color: #16425B;"
            >1</span>

            <!-- Icone -->
            <div
              class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl mb-6"
              style="background: #16425B;"
            >
              👤
            </div>

            <!-- Badge numéro -->
            <span
              class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-4"
              style="background: rgba(22,66,91,0.08); color: #16425B;"
            >
              Step 01
            </span>

            <h3
              class="text-xl font-bold mb-3"
              style="font-family: 'Playfair Display', serif; color: #16425B;"
            >
              Create Your Account
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
              Sign up as an intern or company in less than 2 minutes.
              Choose your profile and get started immediately.
            </p>

            <!-- Flèche vers next -->
            <div
              class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full items-center justify-center z-10 text-sm font-bold"
              style="background: white; border: 2px solid rgba(129,195,215,0.4); color: #3A7CA5; box-shadow: 0 4px 12px rgba(22,66,91,0.08);"
            >
              →
            </div>
          </div>

          <!-- Step 2 -->
          <div
            class="relative rounded-3xl p-8 group hover:-translate-y-1 transition-all duration-300"
            style="background: linear-gradient(145deg, #16425B, #2F6690); border: none;"
          >
            <span
              class="absolute top-4 right-6 text-8xl font-bold opacity-10 select-none text-white"
              style="font-family: 'Playfair Display', serif;"
            >2</span>

            <div
              class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl mb-6"
              style="background: rgba(129,195,215,0.2);"
            >
              🔍
            </div>

            <span
              class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-4"
              style="background: rgba(129,195,215,0.15); color: #81C3D7;"
            >
              Step 02
            </span>

            <h3
              class="text-xl font-bold mb-3 text-white"
              style="font-family: 'Playfair Display', serif;"
            >
              Browse & Apply
            </h3>
            <p class="text-sm leading-relaxed" style="color: rgba(217,220,214,0.7);">
              Explore hundreds of internship offers, filter by domain,
              city or duration and apply with one click.
            </p>

            <div
              class="hidden md:flex absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full items-center justify-center z-10 text-sm font-bold"
              style="background: white; border: 2px solid rgba(129,195,215,0.4); color: #3A7CA5; box-shadow: 0 4px 12px rgba(22,66,91,0.08);"
            >
              →
            </div>
          </div>

          <!-- Step 3 -->
          <div
            class="relative rounded-3xl p-8 group hover:-translate-y-1 transition-all duration-300"
            style="background: #F0F7FB; border: 1px solid rgba(129,195,215,0.2);"
          >
            <span
              class="absolute top-4 right-6 text-8xl font-bold opacity-5 select-none"
              style="font-family: 'Playfair Display', serif; color: #16425B;"
            >3</span>

            <div
              class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl mb-6"
              style="background: #3A7CA5;"
            >
              🎉
            </div>

            <span
              class="inline-block px-3 py-1 rounded-full text-xs font-bold mb-4"
              style="background: rgba(58,124,165,0.08); color: #3A7CA5;"
            >
              Step 03
            </span>

            <h3
              class="text-xl font-bold mb-3"
              style="font-family: 'Playfair Display', serif; color: #16425B;"
            >
              Land Your Internship
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
              Track your applications in real time, receive responses
              and start your internship with confidence.
            </p>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>