<template>
    <div class="post-create">
        <h2>포스트 생성</h2>
        <input
            class="name"
            v-model="state.newPostName"
            type="text"
            placeholder="포스트 제목"
        />
        <textarea
            class="detail"
            v-model="state.newPostDetail"
            placeholder="포스트 내용"
        ></textarea>
        <div class="button-container">
            <button @click="createPost" class="create-button">생성</button>
            <button @click="backContent" class="cancel-button">취소</button>
        </div>
    </div>
</template>

<script>
import { reactive } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

export default {
    setup() {
        const route = useRoute();
        const router = useRouter();
        const state = reactive({
            board: {
                posts: [],
            },
            newPostName: "",
            newPostDetail: "",
        });

        const createPost = () => {
            const boardId = route.params.boardId;
            axios
                .post(`/boards/${boardId}/post`, {
                    name: state.newPostName,
                    detail: state.newPostDetail,
                })
                .then((res) => {
                    state.board.posts.push(res.data);
                    state.newPostName = "";
                    state.newPostDetail = "";
                    router.go(-1);
                })
                .catch((error) => {
                    console.error("Error creating post:", error);
                });
        };

        const backContent = () => {
            router.go(-1);
        };

        return {
            backContent,
            createPost,
            state,
        };
    },
};
</script>

<style>
.post-create {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}
.detail,
.name {
    width: 96%;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
    resize: vertical;
}

.detail {
    height: 400px;
}

.button-container {
    display: flex;
    justify-content: space-between;
}
</style>
