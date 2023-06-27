<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">User</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Liste des utilisateurs</h3>
                            <button class="bg-purple-700 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded">
                                Nouvel utilisateur
                            </button>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pseudo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IsAdmin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                                <!-- Utilisez une boucle pour afficher les utilisateurs ici -->
                            <tbody>
                                <tr v-for="user in users">
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.image }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.pseudo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">. . .</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">{{ user.isAdmin }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                    <button class="bg-blue-500 hover:bg-blue-400 text-white font-semibold py-2 px-4 rounded mr-2">
                                        Modifier
                                    </button>
                                    <button class="bg-red-500 hover:bg-red-400 text-white font-semibold py-2 px-4 rounded">
                                        Supprimer
                                    </button>
                                    </td>
                                </tr>
                            </tbody>
                                <!-- Répétez cette structure pour chaque utilisateur dans votre liste -->
                        </table>
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

    axios
      .get("http://localhost:3000/api/users", {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      })
      .then((response) => {
        this.users = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
  data() {
    return {
      users: [],
    };
  },
};
</script>
