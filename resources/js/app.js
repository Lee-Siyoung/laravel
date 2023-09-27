import "./bootstrap";
import { createApp } from "vue";

import { createRouter, createWebHistory } from "vue-router";
import BoardList from "./components/BoardList.vue";
import App from "./components/App.vue";
import BoardDetail from "./components/BoardDetail.vue";
import PostCreate from "./components/PostCreate.vue";
import PostDetail from "./components/PostDetail.vue";
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "Boards",
            component: BoardList,
        },
        {
            path: "/boards/:boardId",
            name: "BoardDetail",
            component: BoardDetail,
            props: true,
        },
        {
            path: "/boards/:boardId/post",
            name: "PostCreate",
            component: PostCreate,
            props: true,
        },
        {
            path: "/boards/:boardId/post/:postId",
            name: "PostDetail",
            component: PostDetail,
            props: true,
        },
    ],
});
const app = createApp(App);
app.use(router);
app.mount("#app");
