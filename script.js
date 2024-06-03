const API_KEY = "6d2eb17ad9ea49de82f9e0cb860cca2b";
const url = "https://newsapi.org/v2/everything?";

// Fungsi untuk mengambil data dari API berita berdasarkan query
async function fetchData(query) {
    try {
        const res = await fetch(`${url}q=${query}&apiKey=${API_KEY}`);
        
        if (!res.ok) {
            throw new Error(`HTTP error! status: ${res.status}`);
        }

        const data = await res.json();
        console.log('API Response:', data);

        return data;
    } catch (error) {
        console.error('Fetch error:', error);

        return null;
    }
}

// Mengambil data dengan query "all" saat halaman dimuat
fetchData("all").then(data => {
    if (data && data.articles) {

        renderMain(data.articles);
    } else {
        console.error('No data received or data format is incorrect');
    }
});

// Fungsi untuk merender konten utama dengan artikel yang diambil
function renderMain(arr) {
    if (!arr) {
        console.error('Array is undefined or null');
        return;
    }

    // Inisialisasi string HTML untuk konten utama
     let mainHTML = '';

    // Loop melalui array artikel
    for (let i = 0; i < arr.length; i++) {
        if (arr[i].urlToImage) {
            // Membuat HTML untuk setiap kartu artikel
            mainHTML += ` <div class="card">
                            <a href="${arr[i].url}">
                            <img src="${arr[i].urlToImage}" loading="lazy" />
                            <h4>${arr[i].title}</h4>
                            <div class="publishbyDate">
                                <p>${arr[i].source.name}</p>
                                <span>•</span>
                                <p>${new Date(arr[i].publishedAt).toLocaleDateString()}</p>
                            </div>
                            <div class="desc">
                               ${arr[i].description}
                            </div>
                            </a>
                         </div>`;
        }
    }

    // Memperbarui innerHTML elemen utama dengan HTML yang dibuat
    document.querySelector("main").innerHTML = mainHTML;
}

// Mengatur klik tombol menu untuk perangkat mobile
let mobilemenu = document.querySelector(".mobile");
let menuBtn = document.querySelector(".menuBtn");
let menuBtnDisplay = true;

menuBtn.addEventListener("click", () => {
    mobilemenu.classList.toggle("hidden");
});

// Mengatur pengiriman form pencarian untuk desktop
const searchBtn = document.getElementById("searchForm");
const searchBtnMobile = document.getElementById("searchFormMobile");
const searchInputMobile = document.getElementById("searchInputMobile");
const searchInput = document.getElementById("searchInput");

searchBtn.addEventListener("submit", async (e) => {
    e.preventDefault();  // Mencegah perilaku default pengiriman form
    console.log(searchInput.value);  // Mencetak nilai input pencarian untuk debugging

    // Mengambil dan merender data berdasarkan nilai input pencarian
    const data = await fetchData(searchInput.value);
    renderMain(data.articles);
});

// Mengatur pengiriman form pencarian untuk perangkat mobile
searchBtnMobile.addEventListener("submit", async (e) => {
    e.preventDefault();  // Mencegah perilaku default pengiriman form

    // Mengambil dan merender data berdasarkan nilai input pencarian di perangkat mobile
    const data = await fetchData(searchInputMobile.value);
    renderMain(data.articles);
    console.log(searchInputMobile.value);  // Mencetak nilai input pencarian untuk debugging
});

// Fungsi untuk mengambil dan merender data berdasarkan query pencarian
async function Search(query) {
    const data = await fetchData(query);
    renderMain(data.articles);
}