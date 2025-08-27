<script setup lang="ts">
import EditPost from '@/Components/EditPost.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue'
import { mdiPlus, mdiPencil, mdiDelete, mdiMessageReplyText, mdiCommentMultiple } from '@mdi/js';
import CommentPostModal from '@/Components/CommentPostModal.vue';
import CommentsPostModal from '@/Components/CommentsPostModal.vue';

interface Post {
    id: number,
    title: string,
    content: string
    user: {
        name: string,
        email: string
    }
}

const props = defineProps<{
    posts: Post[]
}>();

const form = useForm({});
const showDeleteModal = ref(false)
const showEditModal = ref(false)
const showCommentModal = ref(false)
const showCommentsModal = ref(false)
const postIdToDelete = ref(null)
const editCopy = ref<Post>()
const commentPostCopy = ref<Post>()
const commentsCopy = ref()

const editPost = (post: Post) => {
    showEditModal.value = !showEditModal.value
    editCopy.value = post
}

const viewComments = (post: Post) => {
    showCommentsModal.value = !showCommentsModal.value
    commentsCopy.value = post
}

const commentPost = (post: Post) => {
    showCommentModal.value = !showCommentModal.value
    commentPostCopy.value = post
}

const deletePost = (id: number) => {
    form.delete(`/post/${id}`);
};

function openDeleteModal(id: number) {
    postIdToDelete.value = id
    showDeleteModal.value = true
}

function cancelDelete() {
    postIdToDelete.value = null
    showDeleteModal.value = false
}

function confirmDelete() {
    deletePost(postIdToDelete.value)
    showDeleteModal.value = false
}

</script>

<template>

    <Head title="Manage Posts" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Posts</h2>
        </template>
        <div class="py-12">
            <div class="bg-white flex overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <Link href="/post/create">
                    <v-btn color="primary" class="my-3" size="small">
                        <v-icon :icon="mdiPlus" start />
                        Create
                    </v-btn>
                    </Link>
                    <div>
                        <div v-for="(post, index) in posts" :key="post.id" class="flex flex-col justify-between">
                            <v-card class="m-2" max-width="400">
                                <v-img class="align-end text-white" height="200"
                                    src="https://cdn.vuetifyjs.com/images/cards/docks.jpg" cover>
                                    <v-card-title>{{ post.title }}</v-card-title>
                                </v-img>
                                <v-card-subtitle class="pt-4">
                                    by {{ post.user.name }}
                                </v-card-subtitle>
                                <v-card-text>
                                    <div>{{ post.title }}</div>

                                    <div>{{ post.content }}</div>
                                </v-card-text>

                                <v-card-actions>
                                    <v-btn color="primary" size="small" @click="editPost(post)">
                                        <v-icon :icon="mdiPencil" start />
                                        Edit
                                    </v-btn>
                                    <v-btn class="mr-12" color="error" size="small" @click="openDeleteModal(post.id)">
                                        <v-icon :icon="mdiDelete" start />
                                        Delete
                                    </v-btn>
                                    <div class="ml-16">
                                        <v-btn color="purple" size="small" @click="commentPost(post)">
                                            <v-icon :icon="mdiMessageReplyText" end />
                                        </v-btn>
                                         <v-btn color="orange" size="small" @click="viewComments(post)">
                                            <v-icon :icon="mdiCommentMultiple" end/>
                                        </v-btn>
                                    </div>
                                </v-card-actions>
                            </v-card>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <!-- Edit Post Modal -->
    <div v-if="showEditModal" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
        <EditPost :post="editCopy" />
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-md w-full max-w-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Confirm Deletion</h2>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this post?</p>
            <div class="flex justify-end space-x-2">
                <v-btn variant="tonal" @click="cancelDelete">Cancel</v-btn>
                <v-btn color="error" @click="confirmDelete">Yes, Delete</v-btn>
            </div>
        </div>
    </div>
    <!-- Comment to Post Modal -->
    <div v-if="showCommentModal" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
        <CommentPostModal :post="commentPostCopy" />
    </div>

    <!-- View Comments Modal -->
    <div v-if="showCommentsModal" class="fixed inset-0 flex items-center justify-center z-50 backdrop-blur-sm">
        <CommentsPostModal :post="commentsCopy" />
    </div>
</template>
