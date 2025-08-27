<script setup lang="ts">
import { useForm, Link } from "@inertiajs/vue3";
import { mdiArrowLeft, mdiCommentCheck } from "@mdi/js";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
});

</script>

<template>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Back Button -->
                    <Link href="/post">
                    <BaseButton color="secondary" variant="tonal" class="mb-4">
                        <v-icon :icon="mdiArrowLeft" start />
                        Back
                    </BaseButton>
                    </Link>

                    <div>
                        <div class="shadow-lg mt-2 rounded-md p-6" v-for="comment in props.post.comments">
                            <v-input disabled>
                                {{ comment.content }}
                            </v-input>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
