import { API_CONFIG } from './api.js';

const BASE_URL = `${API_CONFIG.EXPRESS}/tasks`;

export async function getTodos() {
    const res = await fetch(BASE_URL);
    if (!res.ok) return [];
    return res.json();
}

export async function createTodo(data) {
    const defaultData = {
        title: data.title,
        concluida: false
    };

    const res = await fetch(BASE_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(defaultData)
    });
    return res.json();
}

export async function toggleTodo(id) {
    // First, find current to toggle
    const todos = await getTodos();
    const todo = todos.find(t => t.id === id);
    if (!todo) return null;

    const res = await fetch(`${BASE_URL}/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ concluida: !todo.concluida })
    });
    return res.json();
}

export async function deleteTodo(id) {
    await fetch(`${BASE_URL}/${id}`, { method: 'DELETE' });
}

export async function getStats() {
    const todos = await getTodos();
    const total = todos.length;
    const completed = todos.filter(t => t.concluida).length; // Prisma boolean is `concluida`

    return { total, completed };
}