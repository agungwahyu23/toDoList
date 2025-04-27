<template>
    <div class="container">
        <h2>Task List</h2>
        <router-link to="task/create" class="btn btn-primary btn-sm">Add</router-link>
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
                <tr v-for="item in task" :key="item.id">
                    <td>{{ task.indexOf(item) + 1 }}</td>
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
            task: [],
            loading: false,
            error: '',
        };
    },
    mounted() {
        this.fetchTasks();
    },
    methods: {
        async fetchTasks() {
            try {
                const response = await axios.get('/tasks');
                console.log(response.data);

                this.task = Array.isArray(response.data) ? response.data : response.data.data;
                this.$nextTick(() => {
                    if ($.fn.DataTable.isDataTable('#task-table')) {
                        $('#task-table').DataTable().destroy();
                    }
                    $('#task-table').DataTable();
                });
            } catch (error) {
                console.error(error);
            }
        },
        async deleteTask(id) {
            if (confirm('Are you sure to delete this task?')) {
                try {
                    this.destroyDataTable();

                    await axios.delete(`/tasks/${id}`);
                    this.fetchTasks();
                } catch (error) {
                    console.error(error);
                }
            }
        },
        async destroyDataTable() {
            if ($.fn.DataTable.isDataTable('#task-table')) {
                $('#task-table').DataTable().destroy();
            }
        },
    },
};
</script>