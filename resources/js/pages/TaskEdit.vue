<template>
  <div>
    <h2>Edit Task</h2>
    <form @submit.prevent="updateTask">
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
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      task: {
        title: '',
        description: '',
        status: 'incomplete',
      },
    };
  },
  async created() {
    const taskId = this.$route.params.id;
    try {
      const response = await axios.get(`/api/tasks/${taskId}`);
      this.task = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async updateTask() {
      const taskId = this.$route.params.id;
      try {
        await axios.put(`/api/tasks/${taskId}`, this.task);
        this.$router.push('/tasks'); // Redirect ke halaman task setelah update
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>
/* CSS custom untuk form */
</style>
