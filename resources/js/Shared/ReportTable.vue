<template>
    <table>
        <tr v-for="(head, index) in tableHead" :key="index">
            <th>{{ head }}</th>
        </tr>
        <tr v-for="(body, index) in tableBody" :key="index">
            <td>{{ body }}</td>
        </tr>
    </table>
</template>

<script setup>
defineProps({
    tableHead: Array,
    tableBody: Array,
});
</script>

<style scoped>
table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
</style>
