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