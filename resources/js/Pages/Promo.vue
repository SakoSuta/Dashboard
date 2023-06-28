<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Promo" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Promo</h2>
        </template>



        <div class="py-12" v-if="CreateON">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Créer une nouvelle catégorie</h2>
                    
                    <form @submit.prevent="createPromo">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="newPromo.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                            <input type="text" id="code" v-model="newPromo.code" placeholder="Code" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-sm font-medium text-gray-700">Discount</label>
                            <input type="number" id="discount" v-model="newPromo.discount" placeholder="Discount" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Créer le Code Promo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>

        <div class="py-12" v-else-if="EditON">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Modifier la Code Pormo</h2>
                    
                    <form @submit.prevent="editePromo">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="EditPromo.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                            <input type="text" id="code" v-model="EditPromo.code" placeholder="Code" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-sm font-medium text-gray-700">Discount</label>
                            <input type="number" id="discount" v-model="EditPromo.discount" placeholder="Discount" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Modifier le Code Pormo
                            </button>
                        </div>
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12" v-else>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Liste des Codes Promos</h3>
                            <button @click="newCreateON()" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Nouveau Code Promo
                            </button>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="promo in promos">
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ promo.id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ promo.name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ promo.code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ promo.discount }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ promo.startDate }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ promo.EndDate }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                            <button @click="setEditPromoUuid(promo.uuid)" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded mr-2">
                                                Modifier
                                            </button>
                                            <button class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 rounded" @click="deletePromo(promo.uuid)">
                                                Supprimer
                                            </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <Pagination :total="totalPages" :current.sync="currentPage" @page-change="fetchPromo"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import axios from "axios";
import { ref } from 'vue';

export default {
  async mounted() {
    this.fetchPromo();
  },  
  methods: {
    async fetchPromo() { 
        const token = localStorage.getItem("token");

        const response = await axios
            .get("http://localhost:3000/api/promo", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
                params: {
                    page: this.currentPage,
                    perPage: this.perPage,
                },
            })
            .then((response) => {
                this.promos = response.data;
                this.totalPromo = response.data.total;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async getEditPromo(uuid) {
        const token = localStorage.getItem("token");
        // const currentURL = window.location.pathname;
        // const uuid = currentURL.substring(currentURL.lastIndexOf('/') + 1);
        
        const responsePromo = await axios.get(`http://localhost:3000/api/promo/${this.EditPromoUuid}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        this.EditPromo = responsePromo.data;
        console.log(responsePromo.data);
    },
    async editePromo() {
        const token = localStorage.getItem("token");
        await axios.put(`http://localhost:3000/api/promo/${this.EditPromoUuid}`, this.EditPromo, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        window.location.href = '/promo_code';
        this.EditON = false;
    },
    async createPromo() {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.post("http://localhost:3000/api/promo", this.newPromo, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        window.location.href = '/promo_code';
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
    async deletePromo(PromoUuid) {
        try {
        const token = localStorage.getItem("token");
        await axios.delete(`http://localhost:3000/api/promo/${PromoUuid}`, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        this.fetchPromo();
        } catch (error) {
            console.log(error);
        }
    },
    setEditPromoUuid(uuid) {
        this.EditPromoUuid = uuid;
        if(this.EditON == false){
            this.EditON = true;
        }else{
            this.EditON = false;
        }
        this.getEditPromo();
    },
    newCreateON() {
        
  this.CreateON = !this.CreateON;
  console.log(this.CreateON);
    },
  },

  computed: {
    totalPages() {
      return Math.ceil(this.totalPromos / this.perPage);
    },
  },

  data() {
    return {
      CreateON: false,
      EditON: ref(false),
      EditPromoUuid: null,
      promos: [],
      EditPromo: {
        name: '',
      },
      newPromo: {
        name: '',
      },
      currentPage: 1,
      perPage: 10,
      totalPromos: 0,
    };
  },
};
</script>
