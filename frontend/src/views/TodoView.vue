<script setup>
    import TodoList from '../components/TodoList.vue';
</script>

<template>
    <div class="about">
      <h1>This is a Todo page</h1>
      <TodoList />
      <!-- <div>
        <b-button>Button</b-button>
        <b-button variant="danger">Button</b-button>
        <b-button variant="success">Button</b-button>
        <b-button variant="outline-primary">Button</b-button>
        <button type="button" class="btn btn-primary">Primary</button>
        </div> -->
    </div>
  </template>
  
  <style>
  @media (min-width: 1024px) {
    .about {
      min-height: 100vh;
      display: flex;
      align-items: center;
    }
  }
  </style>
  