<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import api from '../../services/api'

const offres = ref([])
const loading = ref(true)

onMounted(async () => {
    try{
        const response = await api.get('/offres?limit=6')
        offres.value = response.data.data
    } catch {
        offres.value = [
            { id: 1, titre: 'Full Stack Web Developer',  entreprise: { nom: 'TechCorp' },    ville: 'Casablanca', duree: '3 months', domaine: 'Engineering' },
            { id: 2, titre: 'Digital Marketing Intern',  entreprise: { nom: 'MediaGroup' },  ville: 'Rabat',      duree: '2 months', domaine: 'Marketing'   },
            { id: 3, titre: 'Data Analyst Intern',        entreprise: { nom: 'FinanceMA' },   ville: 'Tanger',     duree: '6 months', domaine: 'Finance'     },
            { id: 4, titre: 'UI/UX Design Intern',        entreprise: { nom: 'DesignHub' },   ville: 'Casablanca', duree: '3 months', domaine: 'Design'      },
            { id: 5, titre: 'Mobile Developer Intern',    entreprise: { nom: 'AppFactory' },  ville: 'Rabat',      duree: '4 months', domaine: 'Engineering' },
            { id: 6, titre: 'HR & Recruitment Intern',    entreprise: { nom: 'PeopleFirst' }, ville: 'Tanger',     duree: '2 months', domaine: 'HR'          },
        ]
    } finally {
        loading.value = false
    }
})

const domaineColors = {
    'Engineering': { bg: 'rgba(58,124,165,0.1)',  color: '#3A7CA5' },
    'Marketing':   { bg: 'rgba(22,66,91,0.08)',   color: '#2F6690' },
    'Finance':     { bg: 'rgba(129,195,215,0.15)', color: '#3A7CA5' },
    'Design':      { bg: 'rgba(47,102,144,0.1)',  color: '#2F6690' },
    'HR':          { bg: 'rgba(22,66,91,0.06)',   color: '#16425B' },
}

const getColor = (domaine) => 
    domaineColors[domaine] || { bg: 'rgba(129,195,215,0.1)', color: '#3A7CA5' }

</script>

<template>
    <section class="bg-white font-body py-24">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-4">
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-widest uppercase mb-4"
                          style="background:rgba(129,195,215,0.12); color: #3A7CA5; border: 1px solid rgba(129,195,215,0.25);">
                    >
                    Opportunities
                    </span>
                    <h2 class="text-4xl font-bold" style="font-family: 'Playfair Display', serif; color: #16425B;"
                       >
                       Latest Internships
                    </h2>
                    <p class="mt-2 text-gray-400">Discover the most recent opportunities</p>
                </div>
                <RouterLink to="/login" class="flex items-center gap-2 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all duration-200 hover:-translate-y-0.5"
                            style="border: 1px solid rgba(58,124,165,0.25); color: #3A7CA5;">
                    View All Offers →
                </RouterLink>
            </div>

            <div v-if="loading" class="flex justify-center py-16">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2"
                     style="border-color: #3A7CA5";
                ></div>
            </div>
            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="offre in offres" :key="offre.id"
                     class="rounded-2xl p-6 group hover:-translate-y-1 transition-all duration-300 cursor-pointer"
                     style="border: 1px solid rgba(129,195,215,0.2); box-shadow: 0  2px 12px rgba(22,66,91,0.05);"
                     @mouseenter="$event.currentTarget.style.boxShadow='0 12px 40px rgba(22,66,91,0.12)'"
                     @mouseleave="$event.currentTarget.style.boxShadow='0  2px 12px rgba(22,66,91,0.05)'"
                >
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xs px-3 py-1.5 rounded-full font-semibold"
                          :style="`background: ${getColor(offre.domaine).bg}; color: ${getColor(offre.domaine).color};`"
                        >
                    {{ offre.domaine }}
                    </span>
                    <span class="text-xs px-3 py-1.5 rounded-full "
                          style="background: #F7F9FC; color: #9CA3AF;"
                        >
                    {{ offre.duree }}
                    </span>
                </div>
                 <h3 class="text-lg font-bold mb-3 group-hover:text-brand-medium transition-colors duration-200"
                     style="font-family: 'Playfair Display', serif; color: #16425B;">
                     {{ offre.titre }}
                 </h3>

                 <div class="space-y-1.5 mb-5">
                    <p class="text-sm text-gray-500 flex items-center gap-2">
                        <span style="color:#81C3D7;">🏢</span>
                        {{ offre.entreprise?.nom }}
                    </p>
                    <p class="text-sm text-gray-400 flex items-center gap-2">
                        <span>📍</span> {{ offre.ville }}
                    </p>
                 </div>

                 <div class="border-t mb-5" style="border-color:  rgba(129,195,215,0.15);"></div>

                 <RouterLink to="/login" class="block text-center py-2.5 rounded-xl text-sm font-semibold transition-all duration-200"
                             style="background: #16425B; color: white;"
                             @mouseenter="$event.currentTarget.style.background='#2F6690'"
                             @mouseleave="$event.currentTarget.style.background='#16425B'"
                 >
                    Apply Now →
                </RouterLink>
                </div>
            </div>
        </div>
    </section>
</template>