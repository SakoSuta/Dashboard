<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Category</h2>
        </template>



        <div class="py-12" v-if="CreateON">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Créer une nouvelle catégorie</h2>
                    
                    <form @submit.prevent="createCategory">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="newCategory.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Créer la category
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
                    <h2 class="text-lg font-semibold">Modifier la category</h2>
                    
                    <form @submit.prevent="editeCategory">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="EditCategory.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Modifier la category
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
                            <h3 class="text-lg font-semibold">Liste des categories</h3>
                            <button @click="newCreateON()" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Nouvel Categories
                            </button>
                        </div>

                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">slug</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Create At</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="categorie in categories">
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ categorie.id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ categorie.name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ categorie.slug }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ categorie.createdAt }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ categorie.updatedAt }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                            <button @click="setEditCategoryslug(categorie.slug)" class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded mr-2">
                                                Modifier
                                            </button>
                                            <button class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 rounded" @click="deleteCategory(categorie.slug)">
                                                Supprimer
                                            </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <Pagination :total="totalPages" :current.sync="currentPage" @page-change="fetchCategory"/>
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
    this.fetchCategory();
  },  
  methods: {
    async fetchCategory() { 
        const token = localStorage.getItem("token");

        const response = await axios
            .get("http://localhost:3000/api/categories", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
                params: {
                    page: this.currentPage,
                    perPage: this.perPage,
                },
            })
            .then((response) => {
                this.categories = response.data;
                this.totalCategories = response.data.total;
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async getEditCategory(slug) {
        const token = localStorage.getItem("token");
        // const currentURL = window.location.pathname;
        // const slug = currentURL.substring(currentURL.lastIndexOf('/') + 1);
        
        const responseCategory = await axios.get(`http://localhost:3000/api/categories/${this.EditCategoryslug}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        this.EditCategory = responseCategory.data;
        console.log(responseCategory.data);
    },
    async editeCategory() {
        const token = localStorage.getItem("token");
        await axios.put(`http://localhost:3000/api/categories/${this.EditCategoryslug}`, this.EditCategory, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        window.location.href = '/categories';
        this.EditON = false;
    },
    async createCategory() {
      try {
        const token = localStorage.getItem("token");
        const response = await axios.post("http://localhost:3000/api/categories", this.newCategory, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        window.location.href = '/categories';
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
    async deleteCategory(Categoryslug) {
        try {
        const token = localStorage.getItem("token");
        await axios.delete(`http://localhost:3000/api/categories/${Categoryslug}`, {
            headers: {
            Authorization: `Bearer ${token}`,
            },
        });
        this.fetchCategory();
        } catch (error) {
            console.log(error);
        }
    },
    setEditCategoryslug(slug) {
        this.EditCategoryslug = slug;
        if(this.EditON == false){
            this.EditON = true;
        }else{
            this.EditON = false;
        }
        this.getEditCategory();
    },
    newCreateON() {
        
  this.CreateON = !this.CreateON;
  console.log(this.CreateON);
    },
  },

  computed: {
    totalPages() {
      return Math.ceil(this.totalCategories / this.perPage);
    },
  },

  data() {
    return {
      CreateON: false,
      EditON: ref(false),
      EditCategoryslug: null,
      categories: [],
      EditCategory: {
        name: '',
      },
      newCategory: {
        name: '',
      },
      currentPage: 1,
      perPage: 10,
      totalCategories: 0,
    };
  },
};
</script>
