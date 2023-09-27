<template>
    <div class="app">
        <div class="board-list">
            <h1>게시판 목록</h1>
            <!-- 게시판 이름을 입력할 폼 필드 -->
            <input
                v-model="state.newBoardName"
                type="text"
                placeholder="게시판 이름"
            />
            <button @click="createBoard">게시판 생성</button>
            <ul>
                <li v-for="board in state.boards" :key="board.id">
                    <div v-if="!board.isEditing">
                        <router-link :to="'/boards/' + board.id">{{
                            board.name
                        }}</router-link>
                        <div class="button-group">
                            <button @click="startEditing(board)">수정</button>
                            <button @click="deleteBoard(board.id)">삭제</button>
                        </div>
                    </div>
                    <div v-else>
                        <input
                            v-model="board.editedName"
                            type="text"
                            placeholder="수정된 게시판 이름"
                        />
                        <button @click="saveEdit(board)">저장</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <router-view></router-view>
</template>

<script>
import { onMounted, reactive } from "vue";
import axios from "axios";

export default {
    setup() {
        const state = reactive({
            boards: [],
            newBoardName: "",
        });

        const fetchBoards = async () => {
            await axios
                .get("/boards")
                .then((res) => {
                    state.boards = res.data;
                })
                .catch((error) => {
                    console.error("Error fetching boards:", error);
                });
        };

        const createBoard = async () => {
            await axios
                .post("/boards", {
                    name: state.newBoardName,
                })
                .then((res) => {
                    state.boards.push(res.data);
                    state.newBoardName = "";
                })
                .catch((error) => {
                    console.error("Error creating board:", error);
                    console.log(state.boards);
                });
        };

        const deleteBoard = async (boardId) => {
            await axios
                .delete(`/boards/${boardId}`)
                .then(() => {
                    state.boards = state.boards.filter(
                        (board) => board.id !== boardId
                    );
                })
                .catch((error) => {
                    console.error("Error deleting board:", error);
                });
        };

        const startEditing = (board) => {
            board.isEditing = true;
            board.editedName = board.name;
        };

        const saveEdit = async (board) => {
            await axios
                .put(`/boards/${board.id}`, {
                    name: board.editedName,
                })
                .then(() => {
                    board.name = board.editedName;
                    board.isEditing = false;
                })
                .catch((error) => {
                    console.error("Error saving board edit:", error);
                });
        };

        onMounted(() => {
            fetchBoards();
        });

        return {
            state,
            createBoard,
            deleteBoard,
            startEditing,
            saveEdit,
        };
    },
};
</script>

<style>
.app {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
}

.board-list {
    flex: 1;
    max-width: 250px;
    height: 100vh;
    overflow-y: auto;
    border: 1px solid #000000;
    padding: 20px;
    margin-right: 20px;
    background-color: #f0f0f0;
}

.board-list h1 {
    font-size: 20px;
    margin-bottom: 10px;
}

.board-list ul {
    list-style: none;
    padding: 0;
}

.board-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.board-list a {
    text-decoration: none;
    color: #000000;
}

.post-list {
    flex: 1;
    padding: 20px;
    border: 1px solid #000000;
    height: 100vh;
    background-color: #ffffff;
}

.post-list h1,
.board-list h1 {
    font-size: 26px;
    margin-bottom: 20px;
}

button {
    background-color: #696df2;
    color: #ffffff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
}

button:hover {
    background-color: #45478f;
}

.post-list ul {
    list-style: none;
    padding: 0;
}

.post-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.post-list a {
    text-decoration: none;
    color: #000000;
}

.button-group {
    display: flex;
    gap: 10px;
    align-items: center;
}
</style>
