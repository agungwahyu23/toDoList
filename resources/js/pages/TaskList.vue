<template>
    <div class="container">
        <h2>Task List</h2>
        <router-link to="task/create" class="btn btn-primary btn-sm">Add</router-link>

        <div class="row mt-2">
            <h6>Filter</h6>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" v-model="selectedStatus" @change="filterTasks">
                        <option value="">Semua</option>
                        <option value="1">Selesai</option>
                        <option value="0">Belum Selesai</option>
                    </select>
                </div>
            </div>
        </div>

        <table id="task-table" class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in filteredTasks" :key="item.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.description }}</td>
                    <td>{{ item.status == '0' ? 'Belum Selesai' : 'Selesai' }}</td>
                    <td>
                        <router-link :to="`/task/edit/${item.id}`" class="btn btn-warning btn-sm">Edit</router-link>
                        <button @click="deleteTask(item.id)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            tasks: [], 
            filteredTasks: [], 
            selectedStatus: '', 
        };
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        async fetchTasks() {
            try {
                const response = await axios.get('/tasks'); 
                this.tasks = response.data; 
                this.filteredTasks = this.tasks; 
            } catch (error) {
                console.error('Error fetching tasks:', error);
            }
        },
        filterTasks() {
            if (this.selectedStatus === '') {
                this.filteredTasks = this.tasks; 
            } else {
                this.filteredTasks = this.tasks.filter(task => task.status == this.selectedStatus);
            }
        },
        async deleteTask(id) {
            if (confirm('Are you sure to delete this task?')) {
                try {
                    await axios.delete(`/tasks/${id}`);
                    this.fetchTasks();
                } catch (error) {
                    console.error('Error deleting task:', error);
                }
            }
        },
    },
};
</script>
