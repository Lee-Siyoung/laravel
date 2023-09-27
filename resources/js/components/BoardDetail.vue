<template>
    <div class="app">
        <div class="post-list">
            <h2>{{ state.board.name }}</h2>
            <router-link
                :to="'/boards/' + state.board.id + '/post'"
                v-slot="{ navigate }"
            >
                <button @click="navigate" role="link">포스트 생성</button>
            </router-link>
            <ul>
                <li v-for="post in state.board.posts" :key="post.id">
                    <router-link
                        :to="'/boards/' + state.board.id + '/post/' + post.id"
                        >{{ post.name }}</router-link
                    >
                    (조회수: {{ post.check }})
                    <button @click="deletePost(post.id)">삭제</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";

export default {
    setup() {
        const state = reactive({
            board: {
                id: "",
                name: "",
                posts: [],
            },
        });
        const route = useRoute();

        const fetchPost = async () => {
            const boardId = route.params.boardId;
            axios
                .get(`/boards/${boardId}`)
                .then((res) => {
                    state.board.id = res.data.id;
                    state.board.posts = res.data.posts;
                    state.board.name = res.data.name;
                })
                .catch((error) => {
                    console.error("Error fetching posts:", error);
                });
        };

        const deletePost = async (postId) => {
            const boardId = route.params.boardId;
            await axios
                .delete(`/boards/${boardId}/post/${postId}`)
                .then(() => {
                    state.board.posts = state.board.posts.filter(
                        (post) => post.id !== postId
                    );
                })
                .catch((error) => {
                    console.error("Error deleting post:", error);
                });
        };

        onMounted(() => {
            fetchPost();
        });

        return {
            state,
            deletePost,
        };
    },
};
</script>

<style></style>
