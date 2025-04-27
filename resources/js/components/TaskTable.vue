<template>
  <div>
    <!-- Form Task -->
    <form @submit.prevent="saveTask" class="mb-4">
      <input v-model="form.title" type="text" class="form-control mb-2" placeholder="Title" required>
      <textarea v-model="form.description" class="form-control mb-2" placeholder="Description" required></textarea>
      <div class="form-check mb-2">
        <input v-model="form.status" class="form-check-input" type="checkbox" id="status">
        <label class="form-check-label" for="status">Selesai</label>
      </div>
      <button class="btn btn-success" type="submit">{{ form.id ? 'Update' : 'Add' }}</button>
      <button v-if="form.id" @click="resetForm" class="btn btn-secondary ms-2" type="button">Cancel</button>
    </form>

    <!-- Table Task -->
    <table class="table" id="taskTable">
      <thead>
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="task in tasks" :key="task.id">
          <td>{{ task.title }}</td>
          <td>{{ task.description }}</td>
          <td>{{ task.status ? 'Selesai' : 'Belum' }}</td>
          <td>
            <button @click="editTask(task)" class="btn btn-sm btn-warning">Edit</button>
            <button @click="deleteTask(task.id)" class="btn btn-sm btn-danger ms-2">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import $ from 'jquery';
import 'datatables.net-bs5';

export default {
  data() {
    return {
      tasks: [],
      form: {
        id: null,
        title: '',
        description: '',
        status: false,
      }
    }
  },
  methods: {
    fetchTasks() {
      axios.get('/api/v1/tasks')
        .then(res => {
          this.tasks = res.data;
          this.$nextTick(() => {
            if (!$.fn.DataTable.isDataTable('#taskTable')) {
              $('#taskTable').DataTable();
            }
          });
        });
    },
    saveTask() {
      if (this.form.id) {
        axios.put(`/api/v1/tasks/${this.form.id}`, this.form).then(() => {
          this.resetForm();
          this.fetchTasks();
        });
      } else {
        axios.post('/api/v1/tasks', this.form).then(() => {
          this.resetForm();
          this.fetchTasks();
        });
      }
    },
    editTask(task) {
      this.form = { ...task };
    },
    deleteTask(id) {
      if (confirm('Yakin mau hapus?')) {
        axios.delete(`/api/v1/tasks/${id}`).then(() => {
          this.fetchTasks();
        });
      }
    },
    resetForm() {
      this.form = {
        id: null,
        title: '',
        description: '',
        status: false
      };
    }
  },
  mounted() {
    axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;
    this.fetchTasks();
  }
}
</script>
