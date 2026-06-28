<template>
  <section class="font-body py-24 bg-white">
    <div class="max-w-7xl mx-auto px-8">

      <!-- Card principale -->
      <div
        class="relative rounded-3xl overflow-hidden p-16 text-center"
        style="background: linear-gradient(135deg, #16425B 0%, #2F6690 50%, #3A7CA5 100%);"
      >

        <!-- Cercles décoratifs -->
        <div
          class="absolute -top-16 -left-16 w-64 h-64 rounded-full opacity-10"
          style="background: #81C3D7;"
        ></div>
        <div
          class="absolute -bottom-16 -right-16 w-80 h-80 rounded-full opacity-10"
          style="background: #D9DCD6;"
        ></div>
        <div
          class="absolute top-8 right-32 w-20 h-20 rounded-full opacity-5"
          style="background: white;"
        ></div>
        <div
          class="absolute bottom-8 left-32 w-12 h-12 rounded-full opacity-5"
          style="background: white;"
        ></div>

        <!-- Grille décorative subtile -->
        <div
          class="absolute inset-0 opacity-5"
          style="
            background-image: radial-gradient(circle, #81C3D7 1px, transparent 1px);
            background-size: 32px 32px;
          "
        ></div>

        <!-- Contenu -->
        <div class="relative z-10">

          <!-- Badge -->
          <span
            class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-6"
            style="background: rgba(129,195,215,0.15); color: #81C3D7; border: 1px solid rgba(129,195,215,0.25);"
          >
            Get Started Today
          </span>

          <!-- Titre -->
          <h2
            class="text-4xl md:text-6xl font-bold text-white mb-6"
            style="font-family: 'Playfair Display', serif; text-shadow: 0 2px 20px rgba(0,0,0,0.15);"
          >
            Ready to Find Your <br />
            <span style="color: #81C3D7;">Perfect Internship?</span>
          </h2>

          <!-- Sous-titre -->
          <p
            class="text-lg mb-10 max-w-xl mx-auto"
            style="color: rgba(217,220,214,0.75);"
          >
            Join thousands of students and companies already using
            GestionStages to connect and grow together.
          </p>

          <!-- Boutons -->
          <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">

            
           <a   href="/register"
              class="group flex items-center justify-center gap-3 px-10 py-4 rounded-2xl font-bold text-base transition-all duration-300 hover:-translate-y-1"
              style="background: #81C3D7; color: #16425B; box-shadow: 0 8px 30px rgba(129,195,215,0.35);"
              @mouseenter="$event.currentTarget.style.background='white'; $event.currentTarget.style.boxShadow='0 12px 40px rgba(255,255,255,0.25)'"
              @mouseleave="$event.currentTarget.style.background='#81C3D7'; $event.currentTarget.style.boxShadow='0 8px 30px rgba(129,195,215,0.35)'"
            >
              Start as Intern
              <span class="group-hover:translate-x-1 transition-transform duration-200">→</span>
            </a>

            
           <a   href="/register"
              class="flex items-center justify-center gap-3 px-10 py-4 rounded-2xl font-bold text-base transition-all duration-300 hover:-translate-y-1"
              style="background: rgba(255,255,255,0.08); color: white; border: 2px solid rgba(255,255,255,0.2);"
              @mouseenter="$event.currentTarget.style.background='rgba(255,255,255,0.15)'"
              @mouseleave="$event.currentTarget.style.background='rgba(255,255,255,0.08)'"
            >
              Post an Internship
            </a>

          </div>

          <!-- Trust badges -->
          <div
            class="flex flex-wrap justify-center items-center gap-8 pt-8"
            style="border-top: 1px solid rgba(255,255,255,0.1);"
          >
            <div class="flex items-center gap-2">
              <div
                class="w-5 h-5 rounded-full flex items-center justify-center text-xs"
                style="background: rgba(129,195,215,0.2); color: #81C3D7;"
              >✓</div>
              <span class="text-sm" style="color: rgba(217,220,214,0.7);">Free to use</span>
            </div>
            <div class="w-px h-4" style="background: rgba(255,255,255,0.1);"></div>
            <div class="flex items-center gap-2">
              <div
                class="w-5 h-5 rounded-full flex items-center justify-center text-xs"
                style="background: rgba(129,195,215,0.2); color: #81C3D7;"
              >✓</div>
              <span class="text-sm" style="color: rgba(217,220,214,0.7);">500+ active offers</span>
            </div>
            <div class="w-px h-4" style="background: rgba(255,255,255,0.1);"></div>
            <div class="flex items-center gap-2">
              <div
                class="w-5 h-5 rounded-full flex items-center justify-center text-xs"
                style="background: rgba(129,195,215,0.2); color: #81C3D7;"
              >✓</div>
              <span class="text-sm" style="color: rgba(217,220,214,0.7);">No experience required</span>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>