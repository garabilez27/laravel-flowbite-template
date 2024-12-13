import 'flowbite';

if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark')
}

const sidebar = document.getElementById('sidebar');

if (sidebar) {
    const toggleSidebarMobile = (sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose) => {
        sidebar.classList.toggle('hidden');
        sidebarBackdrop.classList.toggle('hidden');
        toggleSidebarMobileHamburger.classList.toggle('hidden');
        toggleSidebarMobileClose.classList.toggle('hidden');
    }

    const toggleSidebarMobileEl = document.getElementById('toggleSidebarMobile');
    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    const toggleSidebarMobileHamburger = document.getElementById('toggleSidebarMobileHamburger');
    const toggleSidebarMobileClose = document.getElementById('toggleSidebarMobileClose');
    const toggleSidebarMobileSearch = document.getElementById('toggleSidebarMobileSearch');

    toggleSidebarMobileSearch.addEventListener('click', () => {
        toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
    });

    toggleSidebarMobileEl.addEventListener('click', () => {
        toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
    });

    sidebarBackdrop.addEventListener('click', () => {
        toggleSidebarMobile(sidebar, sidebarBackdrop, toggleSidebarMobileHamburger, toggleSidebarMobileClose);
    });
}

const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

const themeToggleBtn = document.getElementById('theme-toggle');

let event = new Event('dark-mode');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }

    document.dispatchEvent(event);

});

// Get all elements with the 'delete' class
let selectedDeleteBtns = document.getElementsByClassName('delete');
for (let i = 0; i < selectedDeleteBtns.length; i++) {
    selectedDeleteBtns[i].addEventListener('click', function() {
        let deleteBtn = document.getElementById('delete');
        deleteBtn.value = this.value;
    });
}
selectedDeleteBtns = document.getElementById('e-delete');
selectedDeleteBtns.addEventListener('click', function() {
    let deleteBtn = document.getElementById('delete');
    deleteBtn.value = this.value;
});

// Get all elements with the 'delete' class
const selectedUpdateBtns = document.getElementsByClassName('menu-form');
for (let i = 0; i < selectedUpdateBtns.length; i++) {
    selectedUpdateBtns[i].addEventListener('click', async function() {
        const url = 'http://127.0.0.1:8000/api/v1/menus/' + this.value;
        const data = await fetchData(url);

        // Fill the menu update form
        document.getElementById('e-prefix').value = data['prefix'];
        document.getElementById('e-detail').value = data['detail'];
        document.getElementById('e-icon').value = data['icon'];
        document.getElementById('e-reference').value = data['reference'];
        document.getElementById('e-sequence').value = data['sequence'];
        document.getElementById('e-branched').value = data['branched'];
        document.getElementById('update').value = data['id'];
        document.getElementById('e-delete').value = data['id'];
    });
}

// Modify fetchData to return a Promise
function fetchData(apiUrl) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', apiUrl, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    const data = JSON.parse(xhr.responseText);
                    resolve(data.data); // Resolve the Promise with the fetched data
                } else {
                    reject('Failed to load data'); // Reject the Promise if there's an error
                }
            }
        };

        xhr.send();
    });
}
