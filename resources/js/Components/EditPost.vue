<script setup lang="ts">
import { useForm, Link } from "@inertiajs/vue3";
import { mdiArrowLeft, mdiContentSave } from "@mdi/js";

type PostForm = {
    title: string;
    content: string;
};

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
});

// Form with initial data
const form = useForm<PostForm>({
    title: props.post.title,
    content: props.post.content,
});

// Submit update request
const submit = () => {
    form.patch(`/post/${props.post.id}/edit`);
};
</script>

<template>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Back Button -->
                    <Link href="/post">
                    <BaseButton color="secondary" variant="tonal" class="mb-4">
                        <v-icon :icon="mdiArrowLeft" start />
                        Back
                    </BaseButton>
                    </Link>

                    <!-- Edit Form -->
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                            <input id="title" type="text" v-model="form.title" placeholder="Enter Title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                       focus:outline-none focus:shadow-outline" />
                            <div v-if="form.errors?.title" class="text-red-500 text-sm mt-1">
                                {{ form.errors.title }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
                            <textarea id="body" v-model="form.content" placeholder="Content Here..." class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                       focus:outline-none focus:shadow-outline"></textarea>
                            <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">
                                {{ form.errors.content }}
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <v-btn @click="submit" color="orange" size="small">
                            <v-icon :icon="mdiContentSave" start />
                            Update
                        </v-btn>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
