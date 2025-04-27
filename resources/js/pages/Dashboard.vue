<template>
  <div class="container mt-5">
    <h2>Dashboard</h2>
    <TaskTable />
  </div>
</template>

<script>
import TaskTable from '../components/TaskTable.vue';

export default {
  components: { TaskTable }
}
</script>
