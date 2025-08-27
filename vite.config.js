// vite.config.js
// vim: set sts=4 sw=4 et:
import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [tailwindcss()],
})
