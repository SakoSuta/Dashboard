<script setup>
import { ref } from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-900 flex">
            
                <nav class="w-80">
                    <div class="h-full flex flex-col justify-around">
                        <div class="flex justify-center"><img src="/Logo/Very_long_item.svg" alt="Logo" class="w-36"></div>
                        <ul class="list-none p-0 m-0">
                            <li class="p-4 flex"><img src="/Icone/user.svg" alt="icone" class="px-6"><a href="/user" class="text-white no-underline">User</a></li>
                            <li class="p-4 flex"><img src="/Icone/Subscription.svg" alt="icone" class="px-6"><a href="/sub" class="text-white no-underline">Subscriptions</a></li>
                            <li class="p-4 flex"><img src="/Icone/News.svg" alt="icone" class="px-6"><a href="/post" class="text-white no-underline">Post</a></li>
                            <li class="p-4 flex"><img src="/Icone/Subscription.svg" alt="icone" class="px-6"><a href="/plan" class="text-white no-underline">Plan</a></li>
                            <li class="p-4 flex"><img src="/Icone/Discount.svg" alt="icone" class="px-6"><a href="/promo_code" class="text-white no-underline">Promo Code</a></li>
                            <li class="p-4 flex"><img src="/Icone/Folder.svg" alt="icone" class="px-6"><a href="/categories" class="text-white no-underline">Categories</a></li>
                            <li class="p-4 flex"><img src="/Icone/Controller.svg" alt="icone" class="px-6"><a href="/games" class="text-white no-underline">Games</a></li>
                        </ul>
                        <div class="flex justify-center">
                            <button class="bg-purple-700 hover:bg-purple-600 text-gray-100 font-semibold py-2 px-4 ">
                                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </button>
                        </div>
                    </div>
                </nav>

            <!-- Page Heading -->
            <div class="w-full">
                <header class="bg-gray-800 shadow" v-if="$slots.header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex flex-col">
                        <slot name="header" />
                    </div>
                </header>
                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
