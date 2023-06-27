<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold">Modifier un utilisateur</h2>
                    
                    <form @submit.prevent="editeUser">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="name" v-model="EditUser.name" placeholder="Nom" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>

                        <div class="mb-4">
                            <label for="pseudo" class="block text-sm font-medium text-gray-700">Pseudo</label>
                            <input type="text" id="pseudo" v-model="EditUser.pseudo" placeholder="Pseudo" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" v-model="EditUser.email" placeholder="Email" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" id="password" v-model="EditUser.password" placeholder="Mot de passe" class="text-gray-700 bg-gray-100 border-2 border-gray-300 rounded py-2 px-4" required>
                        </div>
                        
                        <div class="mt-6">
                            <button type="submit" class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Modifier l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import axios from "axios";

export default {
    async mounted() {
        const token = localStorage.getItem("token");
        const currentURL = window.location.pathname;
        const uuid = currentURL.substring(currentURL.lastIndexOf('/') + 1);
        console.log(uuid);
        
        const responseUser = await axios.get(`http://localhost:3000/api/users/${uuid}`, {
            headers: {
                Authorization: `Bearer ${token}`,
            },
        });
        this.EditUser = responseUser.data;
        console.log(responseUser.data);
    },
  data() {
    return {
        EditUser: {
        name: '',
        pseudo: '',
        email: '',
        password: '',
      },
    };
  },
  methods: {
    async editeUser() {
      try {
        const token = localStorage.getItem("token");
        const currentURL = window.location.pathname;
        const uuid = currentURL.substring(currentURL.lastIndexOf('/') + 1);
        const response = await axios.put(`http://localhost:3000/api/users/${uuid}`, this.EditUser, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        window.location.href = '/user';
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>
