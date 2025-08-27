<script setup lang="ts">
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { mdiMenu, mdiClose } from '@mdi/js'
import { mdiAccount } from '@mdi/js'

const showingNavigationDropdown = ref(false)
</script>

<template>
    <v-app>
        <!-- Top Navigation -->
        <v-app-bar app color="primary" dark flat>
            <Link :href="route('dashboard')">
            <ApplicationLogo class="h-8 w-auto" />
            </Link>

            <v-spacer />
            <div class="hidden sm:flex items-center">
                <v-btn variant="text" :class="{ 'v-btn--active': route().current('dashboard') }"
                    :href="route('dashboard')" tag="a">
                    Dashboard
                </v-btn>

                <v-btn variant="text" :class="{ 'v-btn--active': route().current('post.index') }"
                    :href="route('post.index')" tag="a">
                    Posts
                </v-btn>
            </div>

            <!-- Hamburger -->
            <v-btn class="sm:hidden" icon @click="showingNavigationDropdown = !showingNavigationDropdown">
                <v-icon :icon="showingNavigationDropdown ? mdiClose : mdiMenu" />
            </v-btn>
        </v-app-bar>

        <!-- Mobile Menu -->
        <v-expand-transition>
            <v-sheet v-if="showingNavigationDropdown" class="sm:hidden" color="grey-lighten-4" rounded="0">
                <v-list>
                    <v-list-item :href="route('dashboard')" tag="a">
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </v-list-item>
                    <v-list-item :href="route('profile.edit')" tag="a">
                        <v-list-item-title>Profile</v-list-item-title>
                    </v-list-item>
                    <v-list-item :href="route('logout')" method="post" as="button">
                        <v-list-item-title>Log Out</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-sheet>
        </v-expand-transition>

        <!-- Header -->
        <v-main>
            <v-container fluid>
                <v-sheet v-if="$slots.header" class="pa-4 mb-4" color="grey-lighten-3" rounded>
                    <slot name="header" />
                </v-sheet>

                <!-- Main Content -->
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>
