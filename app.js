const search = document.querySelector('.search');
const go = document.querySelector('.go');
const books = document.querySelector('.books');

go.addEventListener('click', async () => {
    const booktitle = search.value;
    try {
        const response = await axios.get(`https://www.googleapis.com/books/v1/volumes?q=${booktitle}`);
        const book = response.data.items;
        books.innerHTML = '';

        book.forEach(book => {
            const { title, authors, imageLinks } = book.volumeInfo;
            let truncatedTitle = title;
            if (title.length > 20) {
                truncatedTitle = title.substring(0, 45) + '...';
            }
            const html = `
                <img src="${imageLinks.thumbnail}" alt="poster">
                <p>Auteur : ${authors}</p> 
                <p class="title">${truncatedTitle}</p>
            `;
            const bookElement = document.createElement('div');
            bookElement.innerHTML = html;
            books.appendChild(bookElement);
        });
    } catch (error) {
        console.error(error);
        
    }
});

