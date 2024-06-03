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