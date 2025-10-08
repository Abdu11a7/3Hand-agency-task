import "./bootstrap";
import { createIcons, icons } from "lucide";
createIcons({ icons });
const langCookie =
    document.cookie
        .split("; ")
        .find((row) => row.startsWith("lang="))
        ?.split("=")[1] || "en";

document.documentElement.lang = langCookie;
document.documentElement.dir = langCookie === "ar" ? "rtl" : "ltr";
// Theme Toggle
const themeToggle = document.getElementById("theme-toggle");
themeToggle?.addEventListener("click", () => {
    document.documentElement.classList.toggle("dark");
    localStorage.setItem(
        "theme",
        document.documentElement.classList.contains("dark") ? "dark" : "light"
    );
});

// Lang Toggle
const langToggle = document.getElementById("lang-toggle");
langToggle?.addEventListener("click", () => {
    const currentLang =
        document.cookie
            .split("; ")
            .find((row) => row.startsWith("lang="))
            ?.split("=")[1] || "en";

    const newLang = currentLang === "en" ? "ar" : "en";
    document.documentElement.lang = newLang;
    document.documentElement.dir = newLang === "ar" ? "rtl" : "ltr";
    document.cookie = `lang=${newLang};path=/;max-age=31536000`;
    location.reload();
});

// Bulk Actions & Search
document.addEventListener("DOMContentLoaded", () => {
    const selectAll = document.getElementById("select-all");
    const checkboxes = document.querySelectorAll(".user-checkbox");
    const deleteSelectedBtn = document.querySelector(".bg-red-500"); // Bulk Delete button
    const searchInput = document.getElementById("user-search");

    // Select All toggle
    selectAll?.addEventListener("change", (e) => {
        checkboxes.forEach((cb) => (cb.checked = e.target.checked));
    });

    // Individual Delete
    document.querySelectorAll(".delete-btn").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const row = e.target.closest("tr");
            if (row) row.remove();
        });
    });

    // Bulk Delete
    deleteSelectedBtn?.addEventListener("click", () => {
        checkboxes.forEach((cb) => {
            if (cb.checked) cb.closest("tr").remove();
        });
        selectAll.checked = false; // Reset select all
    });

    // Search Function
    searchInput?.addEventListener("input", (e) => {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll("tbody tr").forEach((row) => {
            const name =
                row
                    .querySelector("td:nth-child(2)")
                    ?.textContent.toLowerCase() || "";
            const email =
                row
                    .querySelector("td:nth-child(3)")
                    ?.textContent.toLowerCase() || "";
            row.style.display =
                name.includes(term) || email.includes(term) ? "" : "none";
        });
    });

    // Optional: Keyboard Shortcut (Alt+U to go to Users)
    document.addEventListener("keydown", (e) => {
        if (e.altKey && e.key.toLowerCase() === "u") {
            window.location.href = "/users";
        }
    });
});

// Modal Elements
const userModal = document.getElementById("user-modal");
const addUserBtn = document.getElementById("add-user-btn");
const closeModal = document.getElementById("close-modal");
const userForm = document.getElementById("user-form");

let editingRow = null;

// Open Add Modal
addUserBtn?.addEventListener("click", () => {
    document.getElementById("modal-title").textContent = "Add User";
    userForm.reset();
    editingRow = null;
    userModal.classList.remove("hidden");
});

// Close Modal
closeModal?.addEventListener("click", () => {
    userModal.classList.add("hidden");
});

// Handle Submit (Add / Edit)
userForm?.addEventListener("submit", (e) => {
    e.preventDefault();

    const name = document.getElementById("user-name").value;
    const email = document.getElementById("user-email").value;
    const role = document.getElementById("user-role").value;

    if (editingRow) {
        // Edit existing user
        editingRow.querySelector("td:nth-child(2)").textContent = name;
        editingRow.querySelector("td:nth-child(3)").textContent = email;
        editingRow.querySelector("td:nth-child(4)").textContent = role;
    } else {
        // Add new user
        const tbody = document.querySelector("tbody");
        const newRow = document.createElement("tr");
        newRow.className =
            "bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700";
        newRow.innerHTML = `
            <td class="p-4">
                <input type="checkbox" class="user-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${name}</td>
            <td class="px-6 py-4">${email}</td>
            <td class="px-6 py-4">${role}</td>
            <td class="px-6 py-4 text-right flex justify-end gap-2">
                <button class="edit-btn bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">Edit</button>
                <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">Delete</button>
            </td>
        `;
        tbody.appendChild(newRow);
    }

    userModal.classList.add("hidden");
});

// Handle Edit Buttons
document.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-btn")) {
        const row = e.target.closest("tr");
        editingRow = row;
        document.getElementById("modal-title").textContent = "Edit User";
        document.getElementById("user-name").value =
            row.querySelector("td:nth-child(2)").textContent;
        document.getElementById("user-email").value =
            row.querySelector("td:nth-child(3)").textContent;
        document.getElementById("user-role").value =
            row.querySelector("td:nth-child(4)").textContent;
        userModal.classList.remove("hidden");
    }
});
