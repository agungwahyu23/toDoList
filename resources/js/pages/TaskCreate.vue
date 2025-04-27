<template>
    <div>
        <h2>Create Data</h2>
        <form @submit.prevent="createTask">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" v-model="task.title" required />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" v-model="task.description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" v-model="task.status">
                    <option value="completed">Completed</option>
                    <option value="incomplete">Incomplete</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default{
    data(){
        return {
            task: {
                title: '',
                description: '',
                status: '0',
            },
        };
    },
    methods: {
        async createTask(){
            try {
                await axios.post('tasks', this.task);
                this.$router.push('/tasks');
            } catch (error) {
                console.error();
            }
        },
    },
}
</script>
