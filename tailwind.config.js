module.exports = {
    content: [
        "./public/**/*.html",
        "./public/**/*.php"
    ],
    theme: {
        extend: []
    },
    plugins: [
	require("@tailwindcss/forms")
    ]
}
