const search = document.querySelector('.search');
const go = document.querySelector('.go');
const books = document.querySelector('.books');
const genre = document.querySelector('.genre');
const favoris = document.querySelector('.favoris');


go.addEventListener('click', async (event) => {
    event.preventDefault();
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
                <img class="poster" src="${imageLinks.thumbnail}" alt="poster">
                <p class="author">Auteur : ${authors}</p> 
                <p class="title">${truncatedTitle}</p>
                <form action="" method="post">
                <button class=addfavorite" type="button" name=addfavorite onclick="getButtonData()">Ajoutez aux favoris</button>
                </form>
            `;

            const bookElement = document.createElement('div');
            bookElement.innerHTML = html;
            books.appendChild(bookElement);

            
        });
    } catch (error) {
        console.error(error);
    }
});


function getButtonData() {
    try {
        const response = axios.get(`https://www.googleapis.com/books/v1/volumes/${bookId}`);
        const bookId = response.data.items.id;
        console.log(bookId);
    } catch (error) {
        console.error(error);
    }
}




// go.addEventListener('click', async () => {
//     const bookgenre = genre.value;
//     console.log(bookgenre);
//     try {
//         const response = await axios.get(`https://www.googleapis.com/books/v1/volumes?q=subject:${bookgenre}&langRestrict=fr`);
//         const book = response.data.items;
//         books.innerHTML = '';

//         book.forEach(book => {
//             const { title, authors, imageLinks } = book.volumeInfo;
//             let truncatedTitle = title;
//             if (title.length > 20) {
//                 truncatedTitle = title.substring(0, 45) + '...';
//             }
//             const html = `
//                 <img src="${imageLinks.thumbnail}" alt="poster">
//                 <p>Auteur : ${authors}</p> 
//                 <p class="title">${truncatedTitle}</p>
//                 <form action="" method="post">
//                 <input type="submit" name=addfavorite value="Add to Favorite">
//                 </form>
//             `;
//             const bookElement = document.createElement('div');
//             bookElement.innerHTML = html;
//             books.appendChild(bookElement);
//         });
//     } catch (error) {
//         console.error(error);
        
//     }
// }
// );



