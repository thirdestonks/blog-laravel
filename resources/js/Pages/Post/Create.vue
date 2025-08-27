<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, Link } from "@inertiajs/vue3"
import { mdiCheck } from '@mdi/js'
import { mdiArrowLeft  } from '@mdi/js'

const form = useForm({
    title: "",
    content: "",
})

const submit = () => {
    form.post("/post")
}
</script>

<template>

    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-h6 font-weight-medium">Create Post</h2>
        </template>

        <v-container class="py-8" fluid>
            <v-row justify="center">
                <v-col cols="12" md="8" lg="6">
                    <v-card elevation="2" class="pa-6">

                        <Link href="/post">
                        <v-btn color="grey" variant="flat" class="mb-4">
                            <v-icon :icon="mdiArrowLeft  ">
                            </v-icon>
                            Back
                        </v-btn>
                        </Link>

                        <v-form @submit.prevent="submit">
                            <v-text-field v-model="form.title" label="Title" variant="outlined" density="comfortable"
                                :error-messages="form.errors.title" required />

                            <v-textarea v-model="form.content" label="Content" variant="outlined" rows="5"
                                density="comfortable" :error-messages="form.errors.content" required />

                            <v-btn type="submit" color="primary" class="mt-4"
                                :loading="form.processing">
                                <v-icon :icon="mdiCheck ">
                                </v-icon>
                                Submit
                            </v-btn>
                        </v-form>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>
